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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet"
          type="text/css"/>


</head>
<body class="hold-transition skin-white sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ route('qahome') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>QA</b>m</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>QA</b>Manager</span>
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
                    @if( !Auth::user()->hasRole('qamanager'))
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
    @if( Auth::user()->hasRole('qamanager'))
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"></li>

                    <li><a href="{{ route('qahome')}}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li><a href="{{ url('/qamanager/addcat')}}"><i class="fa fa-book"></i> <span>Catagories</span></a>
                    </li>
                    <!-- <li><a href="{{ route('managerideas')}}"><i class="fa fa-book"></i> <span>All Ideas</span></a>
                    </li> -->
                    <li><a href="{{ route('ideasdownload')}}"><i class="fa fa-download"></i>
                            <span>Download Contribution</span></a>
                    </li>

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

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="{{ asset('https://code.jquery.com/ui/1.12.1/jquery-ui.js') }}"></script>

<script>
    $(function () {
        $("#datefrom").datepicker({
            minDate: new Date,
            dateFormat: "yy-mm-dd",
            onSelect: function (date) {
                var date2 = $('#datefrom').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                $('#dateto').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#dateto').datepicker('option', 'minDate', date2);

                $('#finaldate').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#finaldate').datepicker('option', 'minDate', date2);

            }
        });
        $("#dateto").datepicker({
            minDate: new Date,
            dateFormat: "yy-mm-dd",
            onSelect: function (date) {
                var date2 = $('#dateto').datepicker('getDate');
                date2.setDate(date2.getDate());

                $('#finaldate').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#finaldate').datepicker('option', 'minDate', date2);

            }
        });
        $("#finaldate").datepicker({
            minDate: new Date,
            dateFormat: "yy-mm-dd",
        });

    });

</script>


</body>
</html>
