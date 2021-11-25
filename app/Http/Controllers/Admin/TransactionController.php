<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Food;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        $carts = Cart::with(['user', 'food'])->where('user_id', Auth::user()->id)->get();

        $invoice = 'KB-' . date('dmy') . mt_rand(0000, 9999);


        return view('admin.transaction.index', compact('foods', 'carts', 'invoice'));
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                'food_id' => $request->food_id,
                'price' => $request->price,
                'qty' => $request->qty,
                'user_id' => Auth::user()->id,
            ];
            $cart = Cart::with(['user', 'food'])->where('food_id', $request->food_id)->first();
            if ($cart != null) {
                $qty = $cart->qty += $request->qty;
                $price = $cart->food->price;
                $cart->price = $price * $qty;
                $cart->save();
            } else {
                Cart::create($data);
            }
        }
    }

    public function deleteCart(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->delete();
    }

    public function deleteAllCart(Request $request)
    {
        DB::table('carts')->delete();
    }


    public function loadDataCart(Request $request)
    {
        $carts = Cart::with(['user', 'food'])->where('user_id', Auth::user()->id)->get();
        return view('admin.transaction.data-cart', compact('carts'));
    }

    public function createTransaction(Request $request)
    {
        $carts = Cart::with(['user', 'food'])->where('user_id', Auth::user()->id)->get();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'invoice' => $request->invoice,
            'total_price' => $request->total_price,
            'status'    => $request->status,
            'type_payment' => 'CASH',
            'cash' => $request->cash,
            'kembalian' => $request->kembalian,
            'notes' => '',
        ]);

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'food_id' => $cart->food->id,
                'price'   => $cart->food->price,
                'qty'   => $cart->qty,
            ]);
        }

        Cart::with(['user', 'food'])
            ->where('user_id', Auth::user()->id)
            ->delete();

        $params = [
            'success' => true,
            'transaction_id' => $transaction->id,
        ];
        echo json_encode($params);
        //pdf

    }

    public function printBon($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $detail = TransactionDetail::where('transaction_id', $transaction_id);
        $data = $detail->get();
        $total_qty = $detail->sum('qty');
        $pdf = PDF::loadView('struk.struk', compact('transaction','data','total_qty'));
        $pdf->setPaper('A6','potrait');
        return $pdf->stream('my.pdf',array('Attachment'=> 0));
        exit(0);
    }
}
