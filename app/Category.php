<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $fillable=['name','description'];

    public function posts(){
        return $this->hasMany('App\Post');

    }
    public function user(){
        return $this->belongsTo('App\User');

    }
}
