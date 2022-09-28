<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='likes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'like','post_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }
    public function post()
    {
        return $this->belongsTo('App\Post','post_id');

    }
}
