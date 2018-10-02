<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $fillable = [
		'user_id', 'image', 'tittle', 'description', 'ubication'
	];


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
