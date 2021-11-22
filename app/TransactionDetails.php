<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    protected $fillable = [
        'transaction_id','food_id','price','quantity'
    ];



    public function food() {
        return $this->belongsTo(Food::class, 'food_id','id');
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id','id');
    }
}
