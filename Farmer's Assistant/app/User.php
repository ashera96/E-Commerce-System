<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable

{

    use notifiable;

    protected $fillable=[
        'email','password','role_id'
    ];

    protected $hidden = [
        'password','remember_token'
    ];
}
