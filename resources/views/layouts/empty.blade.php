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
<body style="background:url(/img/bg.jpg); background-size:cover;" style="background:url(/img/slide-02.jpg); background-size:cover; color: white;">
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
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

                            </li>
                    
                        
                    </ul>
                </div>
            </div>
        </nav>
<br><br><br>
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
<script src="{{ asset('DataTables/tables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('JQUERY/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
</body>
</html>
