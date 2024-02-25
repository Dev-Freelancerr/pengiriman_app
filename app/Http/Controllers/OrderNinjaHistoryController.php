<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreateOrderNinja as OrderNinja;
use App\Models\CreateBatchOrderNinja as BatchOrderNinja;
use App\Models\OrderTrackNinja;
use Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class OrderNinjaHistoryController extends Controller
{
    public function index()
    {
        return view('ninja.order.history');
    }

    public function getBatch(Request $request)
    {
        $data = BatchOrderNinja::with('orders')
            ->where('seller_id', getAccount(Auth::user()->id)->seller_id)
            ->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('order_count', function ($row) {
                return $row->orders->count(); // Menampilkan jumlah pesanan dalam batch
            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y H:i');
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . url('/ninja/order/list/' . $row->batch_id) . '" class="btn btn-info btn-sm font-weight-normal text-xs detail-link">Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);


    }

    public function order_list($id)
    {
        return view('ninja.order.order_list', [
            'id' => $id
        ]);
    }

    public function getOrder($id)
    {
        $data = OrderNinja::where('batch_id', $id)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y H:i');
            })
            ->addColumn('last_status', function ($row) {
                return optional($row->lastStatus)->status;
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . url('/ninja/order/' . $row->id) . '" class="btn btn-info btn-sm font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Detail">
                        Detail
                    </a>

                    <form action="' . url('/ninja/order/cancel/' . $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-warning btn-sm font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Cancel Order" onclick="return confirm(\'Are you sure you want to cancel this order?\')">Cancel Order</button>
                    </form>
                ';
            })

            ->rawColumns(['action'])
            ->make(true);
    }


    public function show($id)
    {

        $data = OrderNinja::where('seller_id', getAccount(Auth::user()->id)->seller_id)
            ->where('id', $id)
            ->first();

        $tracking = OrderTrackNinja::where('tracking_id', $data->tracking_number)->get();

        return view('ninja.order.show', [
            'order' => $data,
            'tracking' => $tracking
        ]);
    }

    public function getCancel($id) {
        $data = OrderNinja::where('id', $id)->first();
        $cek_track = OrderTrackNinja::where('tracking_id', $data->tracking_number)->latest()->first();

        $accessToken = getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        if ($cek_track !== null && $cek_track->status == 'Pending Pickup') {
            try {
                DB::beginTransaction();
                $response = Http::withHeaders($headers)
                    ->delete(urlCancelOrder("sg", $data->tracking_number));

                // Memeriksa apakah permintaan berhasil
                if ($response->successful()) {

                    $track = new OrderTrackNinja();
                    $track->status = 'Cancelled';
                    $track->tracking_id = $data->tracking_number;
                    $track->previous_status = $data->status;
                    $track->reason_cancel = 'cancelled by the system owner';
                    $track->save();
                    $update = [
                        'status' => "canceled",
                        'previous_status' => $data->status
                    ];
                    OrderNinja::where('id', $id)->update($update);
                    DB::commit();
                    return redirect('/ninja/order/list/'.$data->batch_id)->with('status', 'Cancelled success');
                }

            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
            }
        }
        else {
            return redirect('/ninja/order/list/'.$data->batch_id)->with('status', 'cannot cancel status not pending pickup');
        }
    }
}
