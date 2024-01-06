<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Berisi 4 Data awal Transaksi pembelian dan penjualan
     */
    public function run(): void
    {
        $list =[
            [
                'date' => '2021-01-01',
                'description' => 'Pembelian',
                'qty' => 40,
                'cost' => 100,
                'price' => 100,
                'total_cost' => 4000,
                'qty_balance' => 40,
                'value_balance' => 4000,
                'hpp' => 100,
                'created_at'=> '2021-01-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-01-01',
                'qty' => -20,
                'cost' => 100,
                'price' => 200,
                'total_cost' => -2000,
                'qty_balance' => 20,
                'value_balance' => 2000,
                'hpp' => 100,
                'created_at'=> '2021-02-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-02-01',
                'qty' => -10,
                'cost' => 100,
                'price' => 200,
                'total_cost' => -1000,
                'qty_balance' => 10,
                'value_balance' => 1000,
                'hpp' => 100,
                'created_at'=> '2021-02-01'
            ],
            [
                'description' => 'Pembelian',
                'date' => '2021-03-01',
                'qty' => 20,
                'cost' => 120,
                'price' => 120,
                'total_cost' => 2400,
                'qty_balance' => 30,
                'value_balance' => 3400,
                'hpp' => 113.3333,
                'created_at'=> '2021-03-01'
            ]
        ];

        foreach($list as $key=> $row){
            DB::table('transactions')->insert($row);
       }
    }
}
