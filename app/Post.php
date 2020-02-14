<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories() {
    	return $this->belongsTo(Category::class);
	}

	public function category() {
    	return $this->belongsTo(Category::class);
	}

    public function author() {
        return $this->belongsTo(User::class);
    }
    
    public function categoryId()
    {
         return $this->hasOne(Voyager::modelClass('Category'), 'id', 'category_id');
    }
}