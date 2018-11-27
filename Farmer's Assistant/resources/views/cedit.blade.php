@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="container" style="width: 1000px">
        <div class = "card-panel cyan darken-4"  ><h3 style="text-align: center;color: white">Edit Customer</h3></div>

        <div class = "card-panel center">
            <div class="row">
                <form class="col s12" method="POST" action="{{ route('customer.update',$customer->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstname" type="text" class="validate" name="firstname" value="{{ $customer->firstname }}">
                            <label for="firstname">First Name</label>
                            @if($errors->has('firstname'))
                                <span class="form-text invalid-feedback" style="color: red">{{$errors->first('firstname')}}</span>
                            @endif
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="email" type="email" class="validate" name="email" value="{{ $customer->email }}">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">home</i>
                            <input id="address" type="text" class="validate" name="address" value="{{ $customer->address }}">
                            <label for="address">Address</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="telephone" type="tel" class="validate" name="tp" value="{{ $customer->tp }}" >
                            <label for="telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">home</i>
                            <input id="username" type="text" class="validate" name="username" value="{{ $customer->username }}" readonly>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="password" type="password" class="validate" name="password" value="{{ $customer->password }}" readonly >
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn blue right" value="Update">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>




@endsection