<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionInsertSeeder extends Seeder
{
    /**
     * Berisi 3 Data Sisipan Transaksi pembelian dan penjualan
     */
    public function run(): void
    {
        $list =[
            [
                'description' => 'Pembelian',
                'date' => '2021-03-01',
                'qty' => 10,
                'cost' => 110,
                'price' => 110,
                'total_cost' => 1100,
                'qty_balance' => 40,
                'value_balance' => 4500,
                'hpp' => 112.5,
                'created_at'=> '2021-04-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-04-01',
                'qty' => -5,
                'cost' => 112.5,
                'price' => 200,
                'total_cost' => -562.5,
                'qty_balance' => 35,
                'value_balance' => 3937.5,
                'hpp' => 112.5,
                'created_at'=> '2021-05-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-05-01',
                'qty' => -8,
                'cost' => 112.5,
                'price' => 200,
                'total_cost' => -900,
                'qty_balance' => 27,
                'value_balance' => 3037.5,
                'hpp' => 112.5,
                'created_at'=> '2021-06-01'
            ],
        ];

        foreach($list as $key=> $row){
            DB::table('transactions')->insert($row);
       }
    }
}
