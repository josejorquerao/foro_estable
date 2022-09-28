<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table='favorite';
    protected $primaryKey = 'id';
    protected $fillable=[
        'post_id','users_id'
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
