<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'nic', 'address', 'contact', 'role_id','assigned_stock', 'publication_status'];
}
