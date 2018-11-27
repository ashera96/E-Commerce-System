<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();


        return view('Employee',compact('employee'));

    }
    public function view_employee($ID) {
        $employee = Employee::find($ID);
        return $employee;
    }
    public function update_info(Request $request) {
        $data = array();
        if($request->cat!=-1)
            $data['assigned_stock'] = $request->cat;

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['nic'] = $request->nic;
        $data['address'] = $request->address;
        $data['contact'] = $request->contact;

        Employee::where('id',$request->ID)
            ->update($data);



        Session::put('message','Saved Information Successfully');
        return Redirect::back();
    }
    public function published_employee($ID) {

        Employee::find($ID)->update(['publication_status' => 1]);

        return Redirect::to('employee');
    }

    public function unpublished_employee($ID) {
        Employee::find($ID)->update(['publication_status' => 0]);

        return Redirect::to('employee');
    }

    public function save_employee(Request $request) {

        $data = new Employee();

        if($request->cat==-1) {
            Session::put('info', 'Error! please select the assigned stock!');
            return Redirect::to('employee');

        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['nic'] = $request->nic;
        $data['address'] = $request->address;
        $data['contact'] = $request->contact;
        $data['assigned_stock'] = $request->cat;
        $data['publication_status'] = 1;
        $data['role_id']=3;

        $data->save();


        Session::put('message', 'Saved Information Successfully !');
        return Redirect::to('employee');

    }
    public function save_employeeAJAX(Request $request) {

        $data = new Employee();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['nic'] = $request->nic;
        $data['address'] = $request->address;
        $data['contact'] = $request->contact;
        $data['assigned_stock'] = $request->cat;
        $data['publication_status'] = 1;

        $data->save();
    }
    public function getAllemployee(){
        $all_published_Employee = \App\Employee::all()->where('publication_status',1);
        return $all_published_Employee;

    }


}
