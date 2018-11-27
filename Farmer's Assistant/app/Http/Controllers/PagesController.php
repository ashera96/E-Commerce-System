<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\order;
use Illuminate\Support\Facades\DB;



class PagesController extends Controller
{
    public function statistics(){
        $data=DB::table('ordering')->get(['product','amount']);
        return view('pages.statistics')->with('data',$data);
    }
}
