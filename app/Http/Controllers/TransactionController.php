<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller {
    public function addTransaction(Request $request) {
        $qty = $request->input('qty');
        $price = $request->input('price');
        $date = $request->input('date');
        $type = $request->input('type');

        // Mendapatkan transaksi terakhir
        $previousTransaction = Transaction::orderBy('id', 'desc')->first();

        // Validasi untuk Penjualan: pastikan stok tidak menjadi negatif
        if ($type === 'Penjualan' && $previousTransaction && $previousTransaction->qty_balance - str_replace('-','',$qty) < 0) {
            return response()->json(['message' => 'Stok tidak mencukupi untuk transaksi ini'], 400);
        }

        // Inisialisasi variabel untuk perhitungan
        $cost = 0;
        $totalCost = 0;
        $qtyBalance = $qty;
        $valueBalance = 0;
        $hpp = 0;

        // Jika transaksi sebelumnya ada
        if ($previousTransaction) {
            // Jika jenis transaksi adalah Penjualan
            if ($type === 'Penjualan') {
                $cost = $previousTransaction->hpp; // Gunakan HPP dari transaksi sebelumnya
            } else {
                $cost = $price; // Ambil harga dari inputan jika jenis transaksi adalah Pembelian
            }

            // Hitung Total Cost
            $totalCost = $qty * $cost;

            // Hitung Qty Balance dan Value Balance
            $qtyBalance = $previousTransaction->qty_balance + $qty;
            $valueBalance = $previousTransaction->value_balance + $totalCost;

            // Hitung HPP
            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
        } else {
            // Jika ini transaksi pertama, langsung gunakan harga dari inputan
            $cost = $price;
            $totalCost = $qty * $cost;
        }


        // Buat transaksi baru menggunakan Eloquent ORM
        $transaction = new Transaction();
        $transaction->qty = $qty;
        $transaction->cost = $cost;
        $transaction->price = $price;
        $transaction->total_cost = $totalCost;
        $transaction->qty_balance = $qtyBalance;
        $transaction->value_balance = $valueBalance;
        $transaction->hpp = $hpp;
        $transaction->date = $date;
        $transaction->description = $type;

        $transaction->save();

        return response()->json(['message' => 'Transaksi berhasil ditambahkan'], 201);
    }

    public function updateTransaction(Request $request, $id) {
        $transaction = Transaction::find($id);
        // dd($request);

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $qty = $request->input('qty');
        $price = $request->input('price');
        $date = $request->input('date');
        $type = $request->input('type');

        // Mendapatkan transaksi terakhir
        $latestTransaction = Transaction::orderBy('id', 'desc')->first();

        // Validasi untuk Penjualan: pastikan stok tidak menjadi negatif
        if ($type === 'Penjualan' && $latestTransaction && $latestTransaction->qty_balance - str_replace('-','',$qty) < 0) {
            return response()->json(['message' => 'Stok tidak mencukupi untuk transaksi ini'], 400);
        }

        // Logika perhitungan seperti pada addTransaction
        $cost = 0;
        $totalCost = 0;
        $qtyBalance = $qty;
        $valueBalance = 0;
        $hpp = 0;

        if ($latestTransaction) {
            if ($type === 'Penjualan') {
                $cost = $latestTransaction->hpp;
            } else {
                $cost = $price;
            }

            $totalCost = $qty * $cost;
            $qtyBalance = $latestTransaction->qty_balance + $transaction->qty - $qty;
            $valueBalance = $latestTransaction->value_balance - $transaction->total_cost + $totalCost;
            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
        } else {
            $cost = $price;
            $totalCost = $qty * $cost;
        }

        // Update data transaksi
        $transaction->qty = $qty;
        $transaction->cost = $cost;
        $transaction->price = $price;
        $transaction->total_cost = $totalCost;
        $transaction->qty_balance = $qtyBalance;
        $transaction->value_balance = $valueBalance;
        $transaction->hpp = $hpp;
        $transaction->date = $date;
        $transaction->description = $type;

        $transaction->save();

        return response()->json(['message' => 'Transaksi berhasil diperbarui'], 200);
    }
}
