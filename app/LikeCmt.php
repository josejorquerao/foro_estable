<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeCmt extends Model
{
    protected $table='likescmt';
    protected $primaryKey = 'id';
    protected $fillable=[
        'like','comment_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }
    public function comment()
    {
        return $this->belongsTo('App\Comment','comment_id');

    }
}