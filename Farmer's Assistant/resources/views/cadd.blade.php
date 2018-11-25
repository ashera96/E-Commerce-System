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
        <div class="row">
            <form class="col s12" method="POST" action="{{url('/customer')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="firstname" type="text" class="validate" name="firstname">
                        <label for="firstname">First Name</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="lastname" type="tel" class="validate" name="lastname">
                        <label for="lastname">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">home</i>
                        <input id="address" type="text" class="validate" name="address">
                        <label for="address">Address</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="telephone" type="tel" class="validate" name="tp">
                        <label for="telephone">Telephone</label>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn blue right" value="Save">
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>
</html>
