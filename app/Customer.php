<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $fillable = [
        'user_id', 'address', 'city', 'postcode',
        'country', 'phone'
    ];
}
