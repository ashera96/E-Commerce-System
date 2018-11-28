<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        return view('ordering');
    }

    public function purchase(){
        return view('purchases');
    }
}
