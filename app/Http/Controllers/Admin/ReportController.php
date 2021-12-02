<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\TransactionDataTable;
use App\TransactionDetail;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaction::with(['user'])
                        ->where('user_id', Auth::user()->id)
                        ->whereDate('created_at', $request->from_date)
                        ->where('status_pembayaran', 'PAID')
                        ->latest();
                } else {
                    $query  = Transaction::with(['user'])
                        ->where('user_id', Auth::user()->id)
                        ->whereBetween('created_at', [$request->from_date, $request->to_date])
                        ->latest();
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaction::with(['user'])
                    ->where('user_id', Auth::user()->id)
                    ->whereDate('created_at', $today)
                    ->where('status_pembayaran', 'PAID')
                    ->latest();
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('report.detail', $item->id) . '" class="btn-sm btn-info"><i class="fas fa-eye"></i>Detail</a>';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d-m-Y');
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.laporan.index');
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
        return view('admin.laporan.detail', compact('transaction_id'));
    }
}
