<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Post;

class Category extends Model
{
    public function posts() {
    	return $this->hasMany(Post::class);
	}
}