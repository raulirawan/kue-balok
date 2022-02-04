<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice','user_id','total_price','status','type_payment','notes','cash','kembalian','status_pembayaran','isAccepted'
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function detail()
    {
         return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    protected $dates = ['created_at'];
}
