<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id','total_price','status','type_payment'
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
