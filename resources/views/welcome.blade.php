<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Activity Planner| CIB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
  </head>

  <body>


    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-light">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">CIB | Activity Planner</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
 

        <div class="item">
           <img src="/img/slide-01.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Activity Planner</h1>
              <p class="lead">The most effective way to keep your business - and its finances - on track.</p>
              <a class="btn btn-large btn-primary" href="/login">Login</a>
            </div>
          </div>

        </div>

        <div class="item active">
<img src="{{ asset('img/logo.png') }}" height="30" width="130" alt="ACTIVITY PLANNER">
         
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>


        <div class="item">
          <img src="/img/slide-03.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Activity Planner</h1>
              <p class="lead">The budgeting process forces management to think about why the company is in business, as well as its key assumptions about its business environment.</p>
              <a class="btn btn-large btn-primary" href="/login">Login</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->


 <div align="center"><a href="/login" style="width: 70%; height: 60px;" class="btn btn-success"><h3>Login to Continue</h3></a></div>



      <!-- FOOTER -->
      <footer class="nav navbar-fixed-bottom">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p><b>&copy; 2018 CRDB Insurance Broker, LTD. &middot; </b><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
  </body>
</html>
