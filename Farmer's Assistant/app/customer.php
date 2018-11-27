<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
<<<<<<< HEAD
    protected $table = 'customers';
    protected $fillable = ['id','firstname', 'lastname','address','tp'];
=======
    protected $fillable = ['firstname', 'lastname','address','tp','username','password'];
>>>>>>> c761d606c6569cf4c48bfcb76870966ad217db6d
}
