<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name', 'photo', 'price', 'description', 'kategori'
    ];

    public function getPhotoAttribute()
    {
        return url('') . Storage::url($this->attributes['photo']);
    }
}
