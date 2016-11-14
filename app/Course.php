<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   protected $fillable = ['name', 'description', 'instructor_id'];

   public function instructor()
   {
   		return $this->belongsTo('App\Instructor');
   }
}
