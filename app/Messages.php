<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'user_id');
    }
}
