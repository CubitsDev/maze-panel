<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="">
     <meta name="author" content="Dashboard">
     <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

     <title>MazeRP Panel - Locked</title>

     <!-- Bootstrap core CSS -->
     <link href="https://mazerp.com/panel/assets/css/bootstrap.css" rel="stylesheet">
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

   <body onload="getTime()">

       <!-- **********************************************************************************************************************************************************
       MAIN CONTENT
       *********************************************************************************************************************************************************** -->

 	  	<div class="container">

 	  		<div id="showtime"></div>
 	  			<div class="col-lg-4 col-lg-offset-4">
 	  				<div class="lock-screen">
              <div class="alert alert-danger" role="alert">
                Session Expired
              </div>
 		  				<h2><a href="login.php"><i class="fa fa-lock"></i></a></h2>
 		  				<p>UNLOCK</p>

 	  				</div><!--/lock-screen -->
 	  			</div><!-- /col-lg-4 -->

 	  	</div><!-- /container -->

     <!-- js placed at the end of the document so the pages load faster -->
     <script src="https://mazerp.com/panel/assets/js/jquery.js"></script>
     <script src="https://mazerp.com/panel/assets/js/bootstrap.min.js"></script>

     <!--BACKSTRETCH-->
     <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
     <script type="text/javascript" src="https://mazerp.com/panel/assets/js/jquery.backstretch.min.js"></script>
     <script>
         $.backstretch("https://i.imgur.com/mVgNE5C.jpg", {speed: 500});
     </script>

     <script>
         function getTime()
         {
             var today=new Date();
             var h=today.getHours();
             var m=today.getMinutes();
             var s=today.getSeconds();
             // add a zero in front of numbers<10
             m=checkTime(m);
             s=checkTime(s);
             document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
             t=setTimeout(function(){getTime()},500);
         }

         function checkTime(i)
         {
             if (i<10)
             {
                 i="0" + i;
             }
             return i;
         }
     </script>

   </body>
 </html>
