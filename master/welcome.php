<?php
session_start();

require 'steamauth/steamauth.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['usergroup']) || empty($_SESSION['usergroup'])){
  header("location: login.php");
  exit;
} else {

  include ('steamauth/userInfo.php');

}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Maze Panel</title>
    <!-- Bootstrap core CSS -->
    <link href="https://mazerp.com/panel/assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://gmod.mazerp.com/forums/bluedog/bluedogtbl.css" rel="stylesheet">
    <!--external css-->
<link href="https://mazerp.com/panel/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://mazerp.com/panel/assets/css/layout.css" rel="stylesheet">
    <link href="https://mazerp.com/panel/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>MAZE PANEL</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

                  <p class="centered"><img src="https://mazerp.com/forums/uploads/<?php echo htmlspecialchars($_SESSION['image']); ?>"></p>
                  <h5 class="centered"><?php echo htmlspecialchars($_SESSION['username']); ?></h5>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> Home</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<center>
                <h2>Hey there <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></h2>
                <p><img src="https://data.whicdn.com/images/142984400/original.gif">
                  <br>
                  Welcome to the MazeRP Panel. This is the new panel that I spent a while redevloping to make all your jobs a lot easier
                  <br>Please Report Any Bugs to myself on Discord and don't attempt to abuse the panel. Everything is logged ;)
                  <br>I Promise I will use the Panel Resposibly and Not Abuse It! If you agree to this, click the Button labeled 'Disagree'
                  <br><br><br>
                  <a href="continue2.php" type="button" class="btn btn-light">Agree</a>    <a href="continue.php" type="button" class="btn btn-danger">Disagree</a>
                </p>
              </center>
          		</div>
          	</div>
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Made with <i class="fa fa-heart" style="color: red;"></i> By <a href="https://tomroman.co.uk">Tom</a>
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>    <script src="https://mazerp.com/panel/assets/js/bootstrap.min.js"></script>
    <script src="https://mazerp.com/panel/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="https://mazerp.com/panel/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="https://mazerp.com/panel/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="https://mazerp.com/panel/assets/js/jquery.scrollTo.min.js"></script>
    <script src="https://mazerp.com/panel/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="https://mazerp.com/panel/assets/js/common-scripts.js"></script>

    <!--script for this page-->
  </body>
</html>
