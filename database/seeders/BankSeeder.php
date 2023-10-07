<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = ['Mandiri', 'BCA', 'BNI', 'BRI', 'BTN', 'CIMB'];

        foreach ($banks as $bank) {
            DB::table('mst_bank')->insert([
                'bank_name' => $bank,
            ]);
        }
    }
}
