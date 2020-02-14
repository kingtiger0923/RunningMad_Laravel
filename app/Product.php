<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    public function colors(){
        return $this->belongsToMany('App\Color');
    }

    public function sizes(){
        return $this->belongsToMany('App\Size');
    }

    public function orders() 
    {
        return $this->hasMany('App\ShopOrder');
    }
    
    public function shopcoupons(){
        return $this->belongsToMany('App\Shopcoupon');
    }
}
