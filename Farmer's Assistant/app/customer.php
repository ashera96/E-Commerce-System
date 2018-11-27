<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['id','firstname', 'role_id','lastname','address','tp'];
}
