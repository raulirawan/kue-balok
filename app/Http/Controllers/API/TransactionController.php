<?php

namespace App\Http\Controllers\API;

use App\Transaction;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        // $limit = $request->input('limit', 6);
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::find($id);

            if ($transaction)
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
        }
        if ($status) {
            $transaction = Transaction::where('user_id', Auth::user()->id)->where('status', $status);

            if ($transaction)
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
        }

        $transaction = Transaction::where('user_id', Auth::user()->id);

        if ($transaction->exists()) {
            return ResponseFormatter::success(
                $transaction,
                'Data list transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi tidak ada',
                404
            );
        }
    }

    public function checkout(Request $request)
    {

        $invoice = 'KB-' . date('dmy') . mt_rand(0000, 9999);
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'invoice' => $invoice,
            'total_price' => $request->total_price,
            'status'    => 'PENDING',
            'type_payment' => 'CASH',
            'status_pembayaran' => 'UNPAID',
            'isAccepted' => 0,
        ]);

        foreach ($request->items as $food) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'food_id' => $food['id'],
                'price'   => $food['price'],
                'qty'   => $food['qty'],
            ]);
        }

        if ($transaction != null) {
            return ResponseFormatter::success($transaction->load('detail.food'), 'Transaksi berhasil');
        } else {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
            ], 'Transaksi Gagal', 500);
        }
    }
}
