<?php

namespace App;
use App\User;
use App\Image;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $fillable = [
		'user_id', 'tittle', 'description', 'ubication'
	];


    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class,"post_id");
    }
}
