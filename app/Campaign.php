<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Campaign extends Model
{

    public function appeals(){
        return $this->belongsToMany(Appeal::class);
    }
    
}
