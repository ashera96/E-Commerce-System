<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-bind="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
   
<div class="container">
    <form method="POST" url="/contactUs/sendEmail"  aria-label="{{ __(' Send_Contact_Us') }}">
        {{csrf_field()}}
        <br>
        <div class="form-group row" style="margin-left: 250px">
            <div class="col-md-8">
                <input id="name" type="text"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus />
                <br>
            </div>
            <div class="col-md-8">
                <input id="email" type="text"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="e-mail" name="e-mail" value="{{ old('email') }}" required autofocus />
                <br>
            </div>
            <div class="col-md-8">
                <input id="phone_num" type="text"  class="form-control{{ $errors->has('phone_num') ? ' is-invalid' : '' }}" placeholder="Phone Number" name="phone_num" value="{{ old('phone_num') }}"required autofocus />
                <br>
            </div>
            <div class="col-md-8">
                <input id="msg" type="text"  class="form-control{{ $errors->has('msg') ? ' is-invalid' : '' }}" placeholder="Message" name="msg" value="{{ old('msg') }}"required autofocus>
                <br>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" style="background-color: deeppink;border:none" id="create1">
                        {{ __('Send Message') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>

</html>
