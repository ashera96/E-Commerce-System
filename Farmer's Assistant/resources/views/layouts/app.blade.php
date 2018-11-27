<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

<<<<<<< HEAD
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
=======
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                {{-- <span class="logo-mini"><img src="#" width="50px" height="40px"></span> --}}

                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><strong>Administrator</strong></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">


                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user-circle-o"> Admin</i></a>

                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">

                                    <img src="employee_images/admin_image.png" class="img-circle" alt="User Image">

                                    <p>
                                        Admin
                                        <small><a style="color: #00A6C7;" href="#">Logout</a></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">

                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="pull-right">
                                        {{-- <a href="{{URL::to('/logout')}}" class="btn btn-default btn-flat">Sign out</a> --}}
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <i class="fas fa-user-cog"></i>
                        <img src="employee_images/admin_image.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Admin</p>
                        <small>System Manager</small>

                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">


                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Stock</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                        <ul class="treeview-menu">
                            <li><a href="{{URL::to('/add-stock')}}"><i class="fa fa-clone"></i> Add stock</a></li>
                            <li><a href="{{URL::to('/stock-manage')}}"><i class="fa fa-leaf"></i> Manage stock</a></li>
                        </ul>
                    </li>



                    <li>
                        <a href="{{URL::to('/settings')}}">
                        <i class="fa fa-cogs"></i>
                        <span>Settings</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                    </li>
                    <li>
                        <a href="{{URL::to('/employee')}}">
                            <i class="fa fa-user"></i>
                            <span>Employee</span>
                            <span class="pull-right-container">
                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('/customer')}}">
                            <i class="fa fa-users"></i>
                            <span>Customers</span>
                            <span class="pull-right-container">
                        </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{URL::to('/statistics')}}">
                            <i class="fa fa-cogs"></i>
                            <span>Reports</span>
                            <span class="pull-right-container">
                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('/sendemail')}}">
                            <i class="fa fa-cogs"></i>
                            <span>Complaints</span>
                            <span class="pull-right-container">
                        </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span> Supplyers</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{URL::to('/supplyer')}}"><i class="fa fa-clone"></i> Manage supplyers</a></li>
                            <li><a href="{{URL::to('/supplyerPayment')}}"><i class="fa fa-money"></i> Payment</a></li>
                        </ul>
                    </li>
                </ul>

            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">{{Request::path()}}</li>
>>>>>>> c761d606c6569cf4c48bfcb76870966ad217db6d

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
<<<<<<< HEAD
            </div>
        </nav>
=======
                <br> @yield('content')
            </section>
            <!-- /.content -->
            <div id="snackbar">Data updated successfully.</div>

        </div>



        <!-- /.content-wrapper -->
        <footer class="main-footer">
            {{--<div class="pull-right hidden-xs">--}}
                {{--<b>Version</b> 1.0 Beta--}}
            {{--</div>--}}
            <strong>Copyright &copy; 2018 </strong> All rights reserved.
        </footer>
>>>>>>> c761d606c6569cf4c48bfcb76870966ad217db6d

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
