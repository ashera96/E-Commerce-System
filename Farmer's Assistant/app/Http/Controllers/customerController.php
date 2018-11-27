<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\User;
use Illuminate\Support\Facades\Hash;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = customer::all();
        // dd($students);
        return view('cindex',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "kfkhcgsjf";

        $cnew = new customer;
        $user = new User;
        $cnew -> firstname = $request -> firstname;
        $cnew -> email = $request -> email;
        $cnew -> address = $request -> address;
        $cnew -> tp = $request -> tp;
<<<<<<< HEAD
        $user -> email = $request -> email;
        $user_pw= $request -> password;
        $user -> password = Hash::make($user_pw);
        $user ->role_id=2;
        $user -> save();
=======
        $cnew -> username = $request -> username;
        $cnew -> password = $request -> password;
>>>>>>> c761d606c6569cf4c48bfcb76870966ad217db6d
        $cnew -> save();
        return redirect('customer')->with('status','saved');
    }

    public function reg(Request $request)
    {
        //echo "kfkhcgsjf";

        $cnew = new customer;
        $user = new User;
        $cnew -> firstname = $request -> firstname;
        $cnew -> email = $request -> email;
        $cnew -> address = $request -> address;
        $cnew -> tp = $request -> tp;
        $user -> email = $request -> email;
        $user_pw= $request -> password;
        $user -> password = Hash::make($user_pw);
        $user ->role_id=2;
        $user -> save();
        $cnew -> save();
        return redirect('home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cfind = customer::findOrFail($id);
        return view('cedit',['customer'=>$cfind]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        $cfind = customer::findOrFail($id);
        $cfind -> firstname = $request -> firstname;
        $cfind -> email = $request -> email;
        $cfind -> address = $request -> address;
        $cfind -> tp = $request -> tp;
        $cfind -> username = $request -> username;
        $cfind -> password = $request -> password;
        $cfind -> save();
        return redirect('customer')->with('status','updated');
        //return redirect('customer/'.$cfind->id.'/edit')->with('status','updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cfind = customer::findOrFail($id);
        $cfind -> delete();
        return redirect('/customer');
    }
}
