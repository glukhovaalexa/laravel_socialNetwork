<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'user_id', 'to_user_id', 'message'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
