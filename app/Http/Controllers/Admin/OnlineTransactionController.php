<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OnlineTransactionController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaction::with(['user'])
                        ->whereDate('created_at', $request->from_date)
                        ->where('status_pembayaran', 'UNPAID')
                        ->where('isAccepted', 1)
                        ->latest();
                } else {
                    $query  = Transaction::with(['user'])
                        ->whereBetween('created_at', [$request->from_date, $request->to_date])
                        ->where('status_pembayaran', 'UNPAID')
                        ->latest();
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaction::with(['user'])
                    ->whereDate('created_at', $today)
                    ->where('isAccepted', 1)
                    ->latest();
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('order-online.detail', $item->id) . '" class="btn-sm btn-info"><i class="fas fa-eye"></i>Detail</a>';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d-m-Y');
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.order-online.index');
    }

    public function detail($id)
    {
        if (request()->ajax()) {
            $query  = TransactionDetail::with(['food', 'transaction'])
                ->where('transaction_id', $id)
                ->latest();

            return DataTables::of($query)
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d-m-Y');
                })
                ->make();
        }
        $transaction_id = $id;
        return view('admin.order-online.detail', compact('transaction_id'));
    }

    public function indexPending()
    {
        $transactions = Transaction::where('isAccepted',0)->get();
        return view('admin.order-online.index-pending', compact('transactions'));
    }

    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->isAccepted = 1;
        $transaction->status = 'ON PROGRESS';
        $transaction->save();

        return redirect()->back()->with('success','Berhasil di Terima');
    }

    public function reject($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'CANCELLED';
        $transaction->save();

        return redirect()->back()->with('success','Berhasil di Tolak');
    }

}
