<?php
session_start();

require 'steamauth/steamauth.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['usergroup']) || empty($_SESSION['usergroup'])){
  header("location: login.php");
  exit;
} else {

  include ('steamauth/userInfo.php');
  require_once 'config.php';
}

$steam64 = $steamprofile['steamid'];

$sql = "SELECT member_group_id FROM core_members WHERE steamid = " .$steam64. ";";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);


if (!in_array($row['member_group_id'], $allowedGroups)) {
  header("location: kick.php");
}

$sql6 = "SELECT accepted FROM panel_users WHERE user_id = ".$_SESSION['userid'].";";
$result6 = mysqli_query($conn, $sql6);
$row6 = mysqli_fetch_array($result6);

if ($row6['accepted'] == 0) {
  $accepted = false;
} else {
  $accepted = true;
}

if ($accepted == false) {
header("location: welcome.php");
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

                   <li class="mt">
                       <a href="index.php">
                           <i class="fa fa-dashboard"></i>
                           <span>Dashboard</span>
                       </a>
                   </li>

                   <li class="sub-menu">
                       <a class="active" href="javascript:;" >
                           <i class="fa fa-desktop"></i>
                           <span>Users</span>
                       </a>
                       <ul class="sub">
                           <li class="active"><a  href="user_panel.php">Panel</a></li>
                           <li><a  href="user_game.php">Game</a></li>
                           <li><a  href="user_forums.php">Forums</a></li>
                       </ul>
                   </li>

                   <li class="sub-menu">
                       <a href="javascript:;" >
                           <i class="fa fa-life-ring"></i>
                           <span>Support Area</span>
                       </a>
                       <ul class="sub">
                           <li><a href="support_make_civ.php">Make Civ</a></li>
                           <li><a href="support_name_change.php">Name Change</a></li>
                       </ul>
                   </li>

                   <li class="sub-menu">
                       <a href="javascript:;" >
                           <i class="fa fa-superpowers"></i>
                           <span>Moderator Area</span>
                       </a>
                       <ul class="sub">
                           <li><a href="moderator_lookup.php">Player Lookup</a></li>
<li><a href="moderator_name_change.php">Name Change</a></li>
<li><a href="moderator_name_change.php">Name Change</a></li>
                       </ul>
                   </li>

                   <li class="sub-menu">
                       <a href="javascript:;" >
                           <i class="fa fa-ravelry"></i>
                           <span>Senior Admin Area</span>
                       </a>
                       <ul class="sub">
                           <li><a href="sa_compensate.php">Player Compensate</a></li>
<li><a href="sa_server_logs.php">Server Logs</a></li>
                       </ul>
                   </li>
                   <li class="sub-menu">
                       <a href="javascript:;" >
                           <i class="fa fa-grav"></i>
                           <span>Panel</span>
                       </a>
                       <ul class="sub">
                           <li><a href="panel_logs.php">Full Logs</a></li>
                       </ul>
                   </li>
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
           	<h3><i class="fa fa-angle-right"></i> Panel Users</h3>
           	<div class="row mt">
              <div class="col-md-12 mt">
                <div class="content-panel">
                      <table class="table table-hover">
                      <h4><i class="fa fa-angle-right"></i> Panel Users</h4>
                      <hr>
                          <thead>
                          <tr>
                              <th>ID</th>
                              <th>RP Name</th>
                              <th>Link</th>
                              <th>Accepted Terms?</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          $sql7 = "SELECT * FROM panel_users;";
                          $query = mysqli_query($conn, $sql7);

                          while ($row9 = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>".$row9['user_id']."</td>";
                            $sql2 = "SELECT name FROM core_members WHERE member_id = " .$row9['user_id']. ";";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "<td>".$row2['name']."</td>";
                            echo "<td><a href='".$row9['user_link']."'>".$row9['user_link']."</a></td>";
                            echo "<td>".$row9['accepted']."</td>";
                          }
                           ?>
                          </tbody>
                      </table>
                  </div><!--/content-panel -->
              </div><!-- /col-md-12 -->
           	</div>

 		</section><!--/wrapper -->
       </section><!-- /MAIN CONTENT -->

       <!--main content end-->
       <!--footer start-->
       <footer class="site-footer" style="background: #424a5d;">
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
     <script src="https://mazerp.com/panel/assets/js/jquery.js"></script>
     <script src="https://mazerp.com/panel/assets/js/bootstrap.min.js"></script>
     <script src="https://mazerp.com/panel/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
     <script src="https://mazerp.com/panel/assets/js/jquery.ui.touch-punch.min.js"></script>
     <script class="include" type="text/javascript" src="https://mazerp.com/panel/assets/js/jquery.dcjqaccordion.2.7.js"></script>
     <script src="https://mazerp.com/panel/assets/js/jquery.scrollTo.min.js"></script>
     <script src="https://mazerp.com/panel/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


     <!--common script for all pages-->
     <script src="https://mazerp.com/panel/assets/js/common-scripts.js"></script>

     <!--script for this page-->

     <script>
     setTimeout(function(){
        window.location.href = 'timed_out.php';
     }, 300000);
  </script>

   </body>
 </html>
