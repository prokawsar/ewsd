<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Idea Posting</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition skin-white sidebar-mini" >
<div class="wrapper">
    <header class="main-header">
        <a href="{{ route('shome') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>td</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Student</b></span>
        </a>
       
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- <a class="navbar-brand" href="{{ route('shome') }}">
                {{ config('app.name', 'Laravel') }}
            </a> -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
            <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if( !Auth::user()->hasRole('student'))
                        <li><a href="{{ route('login') }}">Login</a></li>
                        {{----}}

                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                My Account <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

        </nav>
    </header>
    @if( Auth::user()->hasRole('student'))
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"></li>

                <li><a href="{{ route('shome')}}"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
                <li><a href="{{ route('sideas')}}"><i class="fa fa-book"></i> <span>My Ideas</span></a></li>
                <li><a href="{{ route('categories')}}"><i class="fa fa-tree"></i> <span>Category wise</span></a></li>


            </ul>
        </section>
    <!-- /.sidebar -->
    </aside>


        @endif
        
        @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
