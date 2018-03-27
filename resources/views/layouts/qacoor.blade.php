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
<body class="hold-transition skin-white sidebar-mini">
<div class="wrapper" id="app">
    <header class="main-header">
        <a href="{{ route('qahome') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Q</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>QA</b>Coordinator</span>
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
                    @if( !Auth::user()->hasRole('coordinator'))
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
    @if( Auth::user()->hasRole('coordinator'))
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"></li>
                    <li>
                        <a href="{{ route('chome')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>

                    </li>

                    <li><a href="{{ route('coorideas') }}"><i class="fa fa-book"></i> <span>Pending Ideas</span></a></li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Statistics</span>
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('mostviewed')}}"><i class="fa fa-circle-o"></i>Most Viewd Ideas</a>
                            <li><a href="{{ route('departcat')}}"><i class="fa fa-circle-o"></i>Ideas of each Catagories</a>
                            <li><a href="{{ route('ideasdepart')}}"><i class="fa fa-circle-o"></i>Ideas Per
                                    Department</a></li>
                            <li><a href="{{ route('departcont')}}"><i class="fa fa-circle-o"></i>Contributors Per
                                    Department</a></li>

                        </ul>
                    </li>
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
