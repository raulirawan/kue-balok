<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $sukses = Transaction::where('status_pembayaran','PAID')
                        ->whereDate('created_at', $today)
                        ->count();

        $pending = Transaction::where('status','PENDING')
                        ->whereDate('created_at', $today)
                        ->count();

        $cancelled = Transaction::where('status','CANCELLED')
                        ->whereDate('created_at', $today)
                        ->count();
        return view('admin.dashboard',compact('sukses','pending','cancelled'));
    }
}
