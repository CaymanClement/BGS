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
<body style="background:url(/img/bg.jpg); background-size:cover;">
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top" style="background:url(/img/slide-02.jpg); background-size:cover; color: white;">
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
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/logo.png') }}" height="30" width="130" alt="ACTIVITY PLANNER">
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
                                        <li class="hover" ><a style="color: white;" href="{{ url('/login') }}">Login</a></li>

                                        @else

                                      <li class="hover" ><a style="color: white;" href="/home")">Dashboard</a></li>
                                          
                                      <li class="hover"><a style="color: white;"  href=""
                                                onclick="event.preventDefault();
                                                         document.getElementById('add-form').submit();">
                                                Add Request
                                            </a>

                                            <form id="add-form" action="{{ url('/add') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                      </li>




                                          <li class="hover" >
                                            <form action="/add" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" name="submit" style="display: none;"><p style="color: white;">Add Request</p></button>

                                            </form>
                                          </li>
                                          <li class="hover" ><a style="color: white;" href="/requests">My Requests</a></li>
                                          <li class="hover" ><a style="color: white;" href="/report" >Reports</a></li>


                                      <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;"><i>Logged in as {{ Auth::user()->name }}</i>
                                        <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <p style="color: black;" align="center"><b>Balance:</b>{{Auth::user()->balance }}</p>
                                          <li><a href="/change-password">Changed Password</a></li>
                                      </ul>
                                      </li>


                                      <li class="hover" style="background: red;"><a style="color: white;"  href="{{ url('/logout') }}"
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
<br><br><br>
<div class = "container">
        @yield('content')
        <br>
    </div>

<footer class="navbar-fixed-bottom" style="background-color: #003300; color: white; text-align: center; height: 20px; opacity: 0.8;">
    <p>CRDB INSUARANCE BROKER © 2018</p>
</footer>
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
<script src="{{ asset('DataTables/tables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('JQUERY/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
</body>
</html>
