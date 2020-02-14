<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Shopcoupon extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
