<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Race extends Model
{
    public function orders() 
    {
        return $this->hasMany('App\Order');
    }
    
    public function donations() 
    {
        return $this->hasMany('App\Order');
    }

    public function coupons(){
        return $this->belongsToMany('App\Coupon');
    }

}
