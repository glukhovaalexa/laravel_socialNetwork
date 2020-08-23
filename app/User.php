<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use App\Contact;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'name', 'email', 'password', 'country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function message()
    {
        // return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        // где 2й аругемент  - название модели + id, 2й аргумент - если поиск по другому столбцу, не по id
        // у меня модель user, поєтому оно само подставит id и соцдется со столбцом в базе, и мне нужно чтобы искало по id, а не, допустим по title, поэтому подходи и без аргументов
        return $this->hasMany('App\Message');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
                    ->merge( $this->friendsOf()->wherePivot('accepted', true)->get() );
    }

    public function getContact(){
        $contacts = Contact::all();
        
        // dd($contacts);
        return $contacts;
    }
}
