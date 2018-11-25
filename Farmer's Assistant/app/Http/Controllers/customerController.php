<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;

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
        $cnew = new customer;
        $cnew -> firstname = $request -> firstname;
        $cnew -> lastname = $request -> lastname;
        $cnew -> address = $request -> address;
        $cnew -> tp = $request -> tp;
        $cnew -> save();
        return redirect('customer')->with('status','saved');
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
        $cfind -> lastname = $request -> lastname;
        $cfind -> address = $request -> address;
        $cfind -> tp = $request -> tp;
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
