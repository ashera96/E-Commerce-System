<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderingControlller extends Controller
{
    public function index(){
        return view('ordering');
    }
}
