<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionEndSeeder extends Seeder
{
    /**
     * Berisi semua data transaksi lengkap seperti pada contoh soal
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
            ],
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
            [
                'description' => 'Pembelian',
                'date' => '2021-06-01',
                'qty' => 15,
                'cost' => 115,
                'price' => 115,
                'total_cost' => 1725,
                'qty_balance' => 42,
                'value_balance' => 4762.5,
                'hpp' => 113.3929,
                'created_at'=> '2021-07-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-07-01',
                'qty' => -20,
                'cost' => 113.3929,
                'price' => 200,
                'total_cost' => -2267.86,
                'qty_balance' => 22,
                'value_balance' => 2494.643,
                'hpp' => 113.3929,
                'created_at'=> '2021-07-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-07-01',
                'qty' => -15,
                'cost' => 113.3929,
                'price' => 200,
                'total_cost' => -1700.89,
                'qty_balance' => 7,
                'value_balance' => 793.75,
                'hpp' => 113.3929,
                'created_at'=> '2021-07-01'
            ],
            [
                'description' => 'Pembelian',
                'date' => '2021-08-01',
                'qty' => 10,
                'cost' => 110,
                'price' => 110,
                'total_cost' => 1100,
                'qty_balance' => 17,
                'value_balance' => 1893.75,
                'hpp' => 111.3971,
                'created_at'=> '2021-08-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-09-01',
                'qty' => -5,
                'cost' => 111.3971,
                'price' => 210,
                'total_cost' => -556.985,
                'qty_balance' => 12,
                'value_balance' => 1336.765,
                'hpp' => 111.3971,
                'created_at'=> '2021-09-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-10-01',
                'qty' => -6,
                'cost' => 111.3971,
                'price' => 210,
                'total_cost' => -668.382,
                'qty_balance' => 6,
                'value_balance' => 668.3824,
                'hpp' => 111.3971,
                'created_at'=> '2021-10-01'
            ],
            [
                'description' => 'Pembelian',
                'date' => '2021-11-01',
                'qty' => 4,
                'cost' => 125,
                'price' => 125,
                'total_cost' => 500,
                'qty_balance' => 10,
                'value_balance' => 1168.382,
                'hpp' => 116.8382,
                'created_at'=> '2021-11-01'
            ],
            [
                'description' => 'Penjualan',
                'date' => '2021-12-01',
                'qty' => -5,
                'cost' => 116.8382,
                'price' => 210,
                'total_cost' => -584.191,
                'qty_balance' => 5,
                'value_balance' => 584.1912,
                'hpp' => 116.8382,
                'created_at'=> '2021-12-01'
            ],
        ];

        foreach($list as $key=> $row){
            DB::table('transactions')->insert($row);
       }
    }
}
