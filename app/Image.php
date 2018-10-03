<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
		'post_id', 'tittle', 'url'
	];


    public function post(){
    	return $this->belongsTo(Post::class, "post_id");
    }
}
