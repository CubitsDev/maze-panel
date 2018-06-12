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

if (isset($_GET["id"]))
{
    $identity = $_GET["id"];
} else {
  $identity = "0";
}

if(isset($_GET["invalidID"])) {
  $invalidIDShow = $_GET["invalidID"];
} else {
  $invalidIDShow = "0";
}

if(isset($_GET["noPermission"])) {
  $noPermissionShow = $_GET["noPermission"];
} else {
  $noPermissionShow = "0";
}

if(isset($_GET["successful"])) {
  $successShow = $_GET["successful"];
} else {
  $successShow = "0";
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
       <header class="header black-bg" style="background: #27292a;border-bottom: 1px solid #a94442;">
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
                     <li><a href="logout.php" style="	color: #f2f2f2;font-size: 12px;border-radius: 4px;-webkit-border-radius: 4px;border: 1px solid #ffffff !important;padding: 5px 15px;margin-right: 15px;margin-top: 15px;">Logout</a></li>
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
                           <li><a  href="user_panel.php">Panel</a></li>
                           <li><a  href="user_game.php">Game</a></li>
                           <li class="active"><a  href="user_forums.php">Forums</a></li>
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
                       </ul>
                   </li>

                   <li class="sub-menu">
                       <a href="javascript:;" >
                           <i class="fa fa-ravelry"></i>
                           <span>Senior Admin Area</span>
                       </a>
                       <ul class="sub">
                           <li><a href="sa_compensate.php">Player Compensate</a></li>
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
           	<h3><i class="fa fa-angle-right"></i> Forum Users</h3>
           	<div class="row mt">
              <?php
                if ($identity == 0) {
                  if ($invalidIDShow == "1") { ?>
                    <div class="alert alert-danger" role="alert">
                      Forum ID Was Invalid!
                    </div>
                <?php  }
                if ($noPermissionShow == "1") { ?>
                  <div class="alert alert-danger" role="alert">
                    You do not have Permission to edit this user!
                  </div>
              <?php  }
               ?>
               <div class="col-lg-12">
                 <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Forum User Info</h4>
              <form class="form-inline" role="form" method="get" action="https://mazerp.com/panel/user_forums.php">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="id" placeholder="Enter forum ID">
                        <button type="submit" class="btn btn-theme">Submit</button>
                    </div>
              </form>
        </div>
                    </div>
             <?php } else { ?>
                       <div class="col-lg-12">
                           <div class="form-panel">
                             <?php
                             if ($successShow == "1") { ?>
                               <div class="alert alert-success" role="alert">
                                 User Has Been Updated!
                               </div>
                           <?php  } ?>
                           	  <h4 class="mb"><i class="fa fa-angle-right"></i> User Info</h4>
                               <form class="form-horizontal style-form">
                                   <div class="form-group">
                                       <label class="col-sm-2 col-sm-2 control-label">User ID</label>
                                       <div class="col-sm-10">
                                           <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $identity; ?>" disabled="">
                                       </div>
                                       </div>
                                       <?php
                                       $sql10 = "SELECT name FROM core_members WHERE member_id = ".$identity.";";
                                       $result10 = mysqli_query($conn, $sql10);
                                       $row10 = mysqli_fetch_array($result10);
                                        ?>
                                        <div class="form-group">
                                       <label class="col-sm-2 col-sm-2 control-label">Forum Name</label>
                                       <div class="col-sm-10">
                                           <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row10['name']; ?>" disabled="">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-2 col-sm-2 control-label">Primary Group</label>
                                     <div class="col-sm-10">
                                       <?php
                                       $query = "SELECT member_group_id FROM core_members WHERE member_id = ".$identity.";";
                                       $result = mysqli_query($conn,$query);
                                       $row = mysqli_fetch_array($result);
                                       $userGroupID = $row['member_group_id'];

                                       $queryTwo = "SELECT * FROM core_sys_lang_words where word_key = 'core_group_".$userGroupID."';";
                                       $resultTwo = mysqli_query($conn, $queryTwo);
                                       $rowTwo = mysqli_fetch_array($resultTwo);
                                        ?>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rowTwo['word_default']; ?>" disabled="">
                                      </div>
                                   </div>
                                </form>
                              </div>
                            </div>
                            <?php if (!in_array($userGroupID, $cannotbeModified)) { ?>
                              <div class="col-lg-12">
                                  <div class="form-panel">
                                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Update User</h4>
                                      <form class="form-horizontal style-form" method="get" action="user_forums_primary.php">
                                          <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Primary Group</label>
                                            <div class="col-sm-10">
                                              <select name="gchange"class="form-control">
                                  						  <option value="civ">Civilian</option>
                                  						  <option value="pd">Police Department</option>
                                  						  <option value="ems">EMS</option>
                                  						  <option value="fd">Fire Department</option>
                                  						  <option value="ss">Secret Service</option>
                                                <option value="banned">Banned</option>
                                                <option value="member">Member</option>
                                  						</select>
                                              <input name="id" type="hidden" value="<?php echo $identity; ?>">
                                              <br>
                                              <button type="submit" class="btn btn-theme" style="float: right;">Submit</button>
                                             </div>
                                     </div>
                                     </form>
                                   </div>
                                   	  <div class="form-panel">
                                        <h4 class="mb"><i class="fa fa-angle-right"></i> Update User's Secondary Groups</h4>
                                        <form class="form-horizontal style-form" method="post" action="user_forums_secondary.php">
                                            <div class="form-group">
                                              <label class="col-sm-2 col-sm-2 control-label"> User's Secondary Groups</label>
                                              <div class="col-sm-10">
                                                <select name="schange2[]" class="form-control" multiple>
                                                  <?php
                                                    $sql23 = "SELECT g_id FROM core_groups;";

                                                        $rs = mysqli_query($conn, $sql23);

                                                        while($row23 = mysqli_fetch_array($rs))
                                                        {
                                                          $gid = "core_group_".$row23['g_id']."";
                                                          $sql24 = "SELECT word_default FROM core_sys_lang_words WHERE word_key LIKE 'core_group_".$row23['g_id']."';";

                                                          $rs2 = mysqli_query($conn, $sql24);

                                                          while($row24 = mysqli_fetch_array($rs2))
                                                          {
                                                            $sql25 = "SELECT mgroup_others FROM core_members WHERE member_id = ".$identity.";";
                                                            $result25 = mysqli_query($conn, $sql25);
                                                            $row25 = mysqli_fetch_array($result25);
                                                            $allSecondary = $row25['mgroup_others'];
                                                            $secondarys = explode(",", $allSecondary);

                                                            if (in_array($row23['g_id'], $secondarys)) {
                                                              echo "<option value=\"".$row23['g_id']."\" selected>".$row24['word_default']."</option>\n  ";
                                                            } else {
                                                              echo "<option value=\"".$row23['g_id']."\">".$row24['word_default']."</option>\n  ";
                                                            }

                                                          }
                                                        }
                                                    ?>
                                                </select>
                                                <input name="id" type="hidden" value="<?php echo $identity; ?>">
                                                <br>
                                                <button type="submit" class="btn btn-theme" style="float: right;" tabindex="2">Submit</button>
                                               </div>
                                       </div>
                                       </form>
                                    </div>
                          <?php  }  ?>

                          <?php } ?>
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
