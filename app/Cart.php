<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'food_id','user_id','price','qty'
    ];

    public function food() {
        return $this->belongsTo(Food::class, 'food_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
