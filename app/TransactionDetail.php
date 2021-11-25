<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id','food_id','price','qty'
    ];



    public function food() {
        return $this->belongsTo(Food::class, 'food_id','id');
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id','id');
    }
}
