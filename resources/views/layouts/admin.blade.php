<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CIB | Activity Planner</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/extra.css" rel="stylesheet">
    <link href="{{ asset('Datatables/tables/datatables.min.css') }}" rel='stylesheet'>
    



    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  style="background:url(/img/bg.jpg); background-size:cover;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        ACTIVITY PLANNER
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                                <ul class="nav navbar-nav navbar-right">
                                    <!-- Authentication Links -->
                                    @if (Auth::guest())
                                        <li><a href="{{ url('/login') }}">Login</a></li>

                                        @else

                                          <li><a href="/admin">Dashboard</a></li>
                                          <li><a href="/admin/requests">Budget Requests</a></li>
                                          <li><a href="/admin/users">Users</a></li>
                                          <li><a href="/admin/limits">Amount Limits</a></li>
                                          <li><a href="/admin/branches">Branches</a></li>
                                          <li><a href="/admin/reports" >Reports</a></li>

                                        <li>
                                            <a href="#"><i>Logged in as
                                                {{ Auth::user()->name }}
                                            </i></a>
                                        </li>


                                      <li>
                                            <a href="{{ url('/logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
<div class = "container">
        @yield('content')</div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>



    <!-- Summation Script -->
    <script>
        $(function () {
          $("#id-1, #id-2, #id-3, #id-4, #id-5").keyup(function () {
            $("#id-3").val(+$("#id-1").val() + +$("#id-2").val());
          });
        });
    </script>


    <!--  For data table    -->
<script>
    $(document).ready(function() {
    $('#clemtable').DataTable();
} );
</script>

<script src="{{ asset('Datatables/tables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('JQUERY/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>

</body>
</html>
