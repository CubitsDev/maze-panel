<?php

require 'steamauth/steamauth.php';

$failshow = "0";
$logoutShow = "0";

if (isset($_GET["failed"]))
{
    $failshow = $_GET["failed"];
} else {
  $failshow = "0";
}

if (isset($_GET["signout"]))
{
    $logoutShow = $_GET["signout"];
} else {
  $logoutShow = "0";
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

    <title>MazeRP Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="https://mazerp.com/panel/assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://gmod.mazerp.com/forums/bluedog/bluedogtbl.css" rel="stylesheet">
    <!--external css-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
		      <form class="form-login" action="index.html">
		        <h2 class="form-login-heading">Maze Panel</h2>
		        <div class="login-wrap">
              <?php  if ($failshow == "1") {
                echo "<div class='alert alert-danger' role='alert'>
                  You're Not Whitelisted!
                </div>";
              } ?>
              <?php  if ($logoutShow == "1") {
                echo "<div class='alert alert-success' role='alert'>
                  Logged Out Successfully
                </div>";
              } ?>
		            <center><?php loginbutton("rectangle"); ?></center>
		            <hr>
		        </div>
		      </form>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("https://i.imgur.com/mVgNE5C.jpg", {speed: 500});
    </script>


  </body>
</html>
