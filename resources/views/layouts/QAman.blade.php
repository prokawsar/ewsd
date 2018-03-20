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
    <nav class="navbar navbar-custom-menu navbar-static-top">
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
                <a class="navbar-brand" href="{{ route('qahome') }}">
                    {{ config('app.name', 'Laravel') }} : QA Manager
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if( !Auth::user()->hasRole('qamanager'))
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
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if ( Auth::user()->hasRole('qamanager'))
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"></li>

                    <li><a href="{{ route('qahome')}}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li><a href="{{ url('/qamanager/addcat')}}"><i class="fa fa-book"></i> <span>Catagories</span></a>
                    </li>
                    <li><a href="{{ route('managerideas')}}"><i class="fa fa-book"></i> <span>All Ideas</span></a>
                    </li>

                    <li class="treeview">
                        <a href="{{ url('/statical1')}}">
                            <i class="fa fa-files-o"></i>
                            <span>Statistics</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/ideas')}}"><i class="fa fa-circle-o"></i> Number of Ideas</a></li>
                            <li><a href="{{ url('/contributors')}}"><i class="fa fa-circle-o"></i> Contributors</a></li>
                            <li><a href="{{ url('/percentage')}}"><i class="fa fa-circle-o"></i>Shared Pecentage</a>
                            </li>
                            <li><a href="{{ url('/ideas_catagory')}}"><i class="fa fa-circle-o"></i>Ideas of each
                                    Catagories</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{ url('#')}}">
                            <i class="fa fa-files-o"></i>
                            <span>Further Statistics</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="{{ url('/liked_idea')}}"><i class="fa fa-circle-o"></i> Most liked 10 IDEA</a>
                            </li>
                            <li><a href="{{ url('/commented_idea')}}"><i class="fa fa-circle-o"></i> Most commented 10
                                    IDEA</a></li>

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
