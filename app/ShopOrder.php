<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ShopOrder extends Model
{
    public function productId()
    {
         return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
