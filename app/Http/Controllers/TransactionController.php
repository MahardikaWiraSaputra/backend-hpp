<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller {

    public function listTransactions() {
        $transactions = Transaction::all();

        if ($transactions->isEmpty()) {
            return response()->json(['message' => 'Tidak ada transaksi yang ditemukan'], 404);
        }

        return response()->json($transactions, 200);
    }

    public function addTransaction(Request $request) {
        $qty = $request->input('qty');
        $price = $request->input('price');
        $date = $request->input('date');
        $type = $request->input('type');

        // Mendapatkan transaksi terakhir
        $previousTransaction = Transaction::orderBy('id', 'desc')->first();

        // Validasi untuk Penjualan: pastikan stok tidak menjadi negatif
        if ($type === 'Penjualan' && $previousTransaction && $previousTransaction->qty_balance - $qty < 0) {
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
                // Hitung Total Cost
                $totalCost = $qty * $cost;
                 // Hitung Qty Balance dan Value Balance
                $qtyBalance = $previousTransaction->qty_balance - $qty;
                $valueBalance = $previousTransaction->value_balance - $totalCost;
            } else {
                $cost = $price; // Ambil harga dari inputan jika jenis transaksi adalah Pembelian
                // Hitung Total Cost
                $totalCost = $qty * $cost;
                 // Hitung Qty Balance dan Value Balance
                $qtyBalance = $previousTransaction->qty_balance + $qty;
                $valueBalance = $previousTransaction->value_balance + $totalCost;
            }

            // Hitung HPP
            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
        } else {
            // Jika ini transaksi pertama, langsung gunakan harga dari inputan
            if($type === 'Penjualan'){
                $cost = $price;
                $totalCost = $qty * $cost;

                // Ambil data transaksi terakhir untuk perhitungan Qty Balance dan Value Balance
                $previousQtyBalance = $previousTransaction ? $previousTransaction->qty_balance : 0;
                $previousValueBalance = $previousTransaction ? $previousTransaction->value_balance : 0;

                // Hitung Qty Balance dan Value Balance
                $qtyBalance = $previousQtyBalance - $qty;
                $valueBalance = $previousValueBalance - $totalCost;
            } else {
                $cost = $price;
                $totalCost = $qty * $cost;

                // Ambil data transaksi terakhir untuk perhitungan Qty Balance dan Value Balance
                $previousQtyBalance = $previousTransaction ? $previousTransaction->qty_balance : 0;
                $previousValueBalance = $previousTransaction ? $previousTransaction->value_balance : 0;

                // Hitung Qty Balance dan Value Balance
                $qtyBalance = $previousQtyBalance + $qty;
                $valueBalance = $previousValueBalance + $totalCost;
            }

            // Hitung HPP
            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
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

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $qty = $request->input('qty');
        $price = $request->input('price');
        $date = $request->input('date');
        $type = $request->input('type');

        // Mendapatkan transaksi terakhir sebelum id yang dituju untuk mengambil data qty untuk keperluan update Jika ada sisipan, maka akan mempengaruhi qty balance, value balance dan hpp setelahnya.
        $latestTransaction = Transaction::where('id', '<', $id)
        ->orderBy('id', 'desc')
        ->first();

        // Validasi untuk Penjualan: pastikan stok tidak menjadi negatif
        if ($type === 'Penjualan' && $latestTransaction && $latestTransaction->qty_balance - $qty < 0) {
            return response()->json(['message' => 'Stok tidak mencukupi untuk transaksi ini'], 400);
        }

        $oldQty = $transaction->qty; // Simpan nilai qty sebelum diubah

        // Logika perhitungan seperti pada addTransaction
        $cost = 0;
        $totalCost = 0;
        $qtyBalance = $qty;
        $valueBalance = 0;
        $hpp = 0;

        if ($latestTransaction) {
            if ($type === 'Penjualan') {
                $cost = $latestTransaction->hpp;
                $qtyBalance = $latestTransaction->qty_balance -  $qty;
                $valueBalance = $latestTransaction->value_balance - $totalCost;
            } else {
                $cost = $price;
                $qtyBalance = $latestTransaction->qty_balance + $qty;
                $valueBalance = $latestTransaction->value_balance + $transaction->total_cost;
                
            }

            $totalCost = $qty * $cost;

            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
        } else {
            if($type === "Penjualan"){
                $cost = $price;
                $totalCost = $qty * $cost;

                // Ambil data transaksi terakhir untuk perhitungan Qty Balance dan Value Balance
                $latestQtyBalance = $latestTransaction ? $latestTransaction->qty_balance : 0;
                $latestValueBalance = $latestTransaction ? $latestTransaction->value_balance : 0;

                // Hitung Qty Balance dan Value Balance
                $qtyBalance = $latestQtyBalance - $qty;
                $valueBalance = $latestValueBalance - $totalCost;
            } else {
                $cost = $price;
                $totalCost = $qty * $cost;

                // Ambil data transaksi terakhir untuk perhitungan Qty Balance dan Value Balance
                $latestQtyBalance = $latestTransaction ? $latestTransaction->qty_balance : 0;
                $latestValueBalance = $latestTransaction ? $latestTransaction->value_balance : 0;

                // Hitung Qty Balance dan Value Balance
                $qtyBalance = $latestQtyBalance + $qty;
                $valueBalance = $latestValueBalance + $totalCost;
            }
            
            // Hitung HPP
            $hpp = $qtyBalance !== 0 ? $valueBalance / $qtyBalance : 0;
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

        //mengambil data sesudah id yang dicari
        $transactionsUpdate = Transaction::where('id', '>', $transaction->id)->get();
        //mengambil data sebelum di yang dicari untuk mengambil hpp, qty balance dan value balance
        foreach($transactionsUpdate as $update){
            $transactionAfter = Transaction::where('id','<',$update->id)
            ->orderBy('id', 'desc')
            ->first();
            if($update->description == 'Penjualan'){
                $cost = $transactionAfter->hpp;
                $totalCost = $update->qty * $cost;
                $update->qty_balance = $transactionAfter->qty_balance - $update->qty;
                $update->value_balance = $transactionAfter->value_balance - $totalCost;
                $update->hpp = $transactionAfter->hpp;
                $update->save();
            } else {
                $totalCost = $update->qty * $update->price;
                $qtyBalance = $transaction_after->qty_balance + $update->qty;
                $update->qty_balance = $qty_balance;
                $update->value_balance = $transactionAfter->value_balance + $totalCost;
                $update->hpp = $transactionAfter->value_balance / $qty_balance;
                $update->save();
            }
        }

        return response()->json(['message' => 'Transaksi berhasil diperbarui'], 200);
    }

    public function removeTransaction($id) {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Validasi untuk stok agar tidak minus
        if ($transaction->qty_balance - $transaction->qty <= 0) {
            return response()->json(['message' => 'Stok Tidak Boleh minus'], 400);
        }

        // Hapus transaksi
        $transaction->delete();

        //cek data qty balance sebelum dan stok sesudah id yang dicari
        $transactionBefore = Transaction::where('id','<',$id)->orderBy('id', 'desc')->first(); // mencari data qty balace sesudah id dicari dan mengambil yang terakhir
        $transactionAfterCek = Transaction::where('id','>',$id)->orderBy('id', 'asc')->first(); // mencari data qty sebelum id yang dicari dan mengambil yang pertama
            if ($transactionBefore->qty_balance - $transactionAfterCek->qty <= 0) {
                // dd($transactionsUpdate);
                return response()->json(['message' => 'Stok Tidak Boleh minus'], 400);
            }

        // Update data hpp, value balance dan qty balance
        $transactionsUpdate = Transaction::where('id', '>=', $id)->get(); //mengambil data sesudah id yang dicari
        foreach($transactionsUpdate as $update){
            $transactionAfter = Transaction::where('id','<',$update->id)  //mengambil data sebelum id yang dicari
            ->orderBy('id', 'desc')
            ->first();
            // dd($transaction_after);
            if($update->description == 'Penjualan'){
                $cost = $transactionAfter->hpp;
                $totalCost = $update->qty * $cost;
                $update->qty_balance = $transactionAfter->qty_balance - $update->qty;
                $update->value_balance = $transactionAfter->value_balance - $totalCost;
                $update->hpp = $transactionAfter->hpp;
                $update->save(); 
            } else {
                $totalCost = $update->qty * $update->price;
                $qtyBalance = $transaction_after->qty_balance + $update->qty;
                $update->qty_balance = $qty_balance;
                $update->value_balance = $transactionAfter->value_balance + $totalCost;
                $update->hpp = $transactionAfter->value_balance / $qty_balance;
                $update->save();
            }
        }

        return response()->json(['message' => 'Transaksi berhasil dihapus'], 200);
    }
}
