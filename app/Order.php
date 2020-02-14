<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    public function raceId()
    {
         return $this->hasOne('App\Race', 'id', 'race_id');
    }

    public function races()
    {
        return $this->belongsTo('App\Race');
    }
}
