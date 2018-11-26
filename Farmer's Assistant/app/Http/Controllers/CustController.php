<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustController extends Controller
{
    public function index()
    {
        return view('customer-dash');
    }
}
