<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = ['name', 'gender'];

    public function courses()
    {
    	return $this->hasMany('App\Course');
    }
}
