<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $role_id = Auth::user()->role->id;
        if($role_id == '2'){
            return view('home'); //role_id 2 is customer.
        }elseif($role_id == '3'){
            return view('Employee'); //employee
        }elseif($role_id == '1'){
            return view('customer-dash'); //admin
        }
    }
}
