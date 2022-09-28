<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='post';
    protected $primaryKey = 'id';
    protected $fillable=[
        'title','content','category_id','users_id','likes','dislikes'
    ];

    public function comment(){
        return $this->hasMany('App\Comment');

    }
    public function category()
    {
        return $this->belongsTo('App\Category','category_id');

    }
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
}
