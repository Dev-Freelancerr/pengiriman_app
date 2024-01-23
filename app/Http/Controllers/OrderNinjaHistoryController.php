<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreateOrderNinja as OrderNinja;
use App\Models\CreateBatchOrderNinja as BatchOrderNinja;
use App\Models\OrderTrackNinja;
use Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

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
                <a href="' . url('/ninja/order/cancel/' . $row->id) . '" class="btn btn-sm btn-warning font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Cancel Order">
                    Cancel Order
                </a>';
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
}
