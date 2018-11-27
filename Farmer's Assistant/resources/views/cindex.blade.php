@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="container" style="width: 1000px">
        <div class = "card-panel cyan darken-4"  ><h3 style="text-align: center;color: white">Customers</h3></div>

        <div class = "card-panel center" >
            <div style="float: right">
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{url('customer/create')}}"><i class="material-icons float-left green">add</i></a>
            </div>
            <br>
            <table id="productsTBL" class="table table-hover" style="margin-top: 20px">
                <tr>
                    <th >NAME</th>
                    <th >EMAIL</th>
                    <th >ADDRESS</th>
                    <th>TELEPHONE</th>
                    <th>USERNAME</th>

                    <th style="text-align: center">ACTION</th>
                </tr>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->firstname }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->tp }}</td>
                        <td>{{ $customer->username }}</td>

                        <td>
                            <div class="row"><div class="col">
                                    <a href="{{url('customer/'.$customer->id.'/edit')}}"><button class="btn btn-small blue" style="border-radius: 5px">Edit</button></a>
                                </div>
                                <div class="col">
                                    <form  action="{{route('customer.destroy',$customer->id)}}" method="post" >
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-small red" style="border-radius: 5px">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>


@endsection