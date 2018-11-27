@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="container" style="width: 1000px">
        <div class = "card-panel cyan darken-4"  ><h3 style="text-align: center;color: white">Add New Customer</h3></div>



        <div class = "card-panel center">
            <div class="row">
                <form class="col s12" method="POST" action="{{url('/customer')}}">
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="input-field col s6">

                            <!--<i class="material-icons prefix" >account_circle</i>-->
                            <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
                            <label for="firstname">Name</label>

                        </div>
                        <div class="input-field col s6">
                            <!--<i class="material-icons prefix">account_circle</i>-->
                            <input id="email" type="email"   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email">Email</label>


                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <!-- <i class="material-icons prefix">home</i> -->

                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                            <label for="address">Address</label>

                        </div>
                        <div class="input-field col s6">
                            <!--<i class="material-icons prefix">phone</i>-->

                            <input id="telephone" pattern="[0]{1}[1-9]{2}[0-9]{7}" minlength="10" type="text" class="form-control{{ $errors->has('tp') ? ' is-invalid' : '' }}" name="tp" value="{{ old('tp') }}" required autofocus>

                            <label for="telephone">Telephone</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <!-- <i class="material-icons prefix">home</i> -->

                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                            <label for="username">Username</label>

                        </div>
                        <div class="input-field col s6">
                            <!--<i class="material-icons prefix">phone</i>-->

                            <input id="password"  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                            <label for="password">Password</label>

                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn blue right" value="Save">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

@endsection