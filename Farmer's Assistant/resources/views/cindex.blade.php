<html>
<head>
    <title>CRUD Application</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class = "card-panel teal lighten-2"><h3 style="text-align: center">CRUD Application</h3></div>


    <div class = "card-panel center">
        <div style="float: left">
            <a class="btn-floating btn-large waves-effect waves-light red" href="{{url('customer/create')}}"><i class="material-icons float-left green">add</i></a>
        </div>
        <br>
        <table class="striped" style="margin-top: 50px">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Action</th>
            </tr>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->firstname }}</td>
                    <td>{{ $customer->lastname }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->tp }}</td>
                    <td>
                        <div class="row"><div class="col">
                                <a href="{{url('customer/'.$customer->id.'/edit')}}"><button class="btn btn-small blue">Edit</button></a>
                            </div>
                            <div class="col">
                                <form  action="{{route('customer.destroy',$customer->id)}}" method="post" >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-small red">Delete</button>
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
</body>
</html>
