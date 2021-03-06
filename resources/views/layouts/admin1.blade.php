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
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} : Admin
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>

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
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"></li>

                <li><a href="{{ route('ahome')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('adddepart')}}"><i class="fa fa-plus-square"></i> <span>Add Department</span></a></li>
                <!-- <li><a href="{{ route('ideas') }}"><i class="fa fa-files-o"></i> All Ideas</a></li> -->

                <li class="treeview">
                    <a href="{{ url('#')}}">
                        <i class="fa fa-navicon"></i>
                        <span>Details</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="{{ url('#')}}"><i class="fa fa-circle-o"></i> Closer Date of Academic Year</a></li>
                        <li><a href="{{ route('stdetails')}}"><i class="fa fa-circle-o"></i> Staff Details</a></li>
                        <li><a href="{{ route('sdetails')}}"><i class="fa fa-circle-o"></i> Student Details</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-indent"></i>
                        <span>Statistics</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('mostviewed')}}"><i class="fa fa-circle-o"></i>Most Viewd Ideas</a>
                        <li><a href="{{ route('departcat')}}"><i class="fa fa-circle-o"></i>Ideas of each Catagories</a>
                        <li><a href="{{ route('ideasdepart')}}"><i class="fa fa-circle-o"></i>Ideas Per Department</a></li>
                        <li><a href="{{ route('departcont')}}"><i class="fa fa-circle-o"></i>Contributors Per Department</a></li>


                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ url('#')}}">
                        <i class="fa fa-indent"></i>
                        <span>Further Statistics</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="{{ route('mostliked')}}"><i class="fa fa-circle-o"></i> Most liked 5 IDEA</a></li>
                        <li><a href="{{ route('mostcommented')}}"><i class="fa fa-circle-o"></i> Most commented 5 IDEA</a>
                        </li>
                        <li><a href="{{ route('withoutcomment')}}"><i class="fa fa-circle-o"></i> Ideas without
                                like/comment</a></li>
                        <li><a href="{{ route('anonymous')}}"><i class="fa fa-circle-o"></i> Anonymous Ideas</a></li>
                        </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
