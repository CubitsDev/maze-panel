<?php

require 'steamauth/steamauth.php';
require __DIR__ . '/vendor/autoload.php';

session_start();

if(!isset($_SESSION['steamid'])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>MazeRP Panel - Discord Association</title>

    <!-- Bootstrap core CSS -->
    <link href="https://mazerp.com/panel/assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://gmod.mazerp.com/forums/bluedog/bluedogtbl.css" rel="stylesheet">
    <!--external css-->
    <link href="https://mazerp.com/panel/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://mazerp.com/panel/assets/css/layout.css" rel="stylesheet">
    <link href="https://mazerp.com/panel/assets/css/style-responsive.css" rel="stylesheet">

    <style>
    body {
      background: url(https://img1.picload.org/image/rgdgwrcr/the_first_mingebag__gmod__by_m.png) no-repeat center center fixed;
    }
    </style>
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
		        <h2 class="form-login-heading">Maze Panel - Discord Association</h2>
		        <div class="login-wrap">
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
        $.backstretch("https://img1.picload.org/image/rgdgwrcr/the_first_mingebag__gmod__by_m.png", {speed: 500});
    </script>


  </body>
</html>
<?php
}  else {

include ('steamauth/userInfo.php'); //To access the $steamprofile array
include ('../config.php');
//echo ('Main screen turn on!<br/><br/>');

$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId' => '***REMOVED***',
    'clientSecret' => '***REMOVED***',
    'redirectUri' => 'https://mazerp.com/panel/discord/'
]);

if (!isset($_GET['code'])) {
  $options = [
    'scope' => ['identify', 'email', 'guilds']
];
    // Step 1. Get authorization code
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Step 2. Get an access token using the provided authorization code
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);


    // Step 3. (Optional) Look up the user's profile with the provided token
    try {

        $user = $provider->getResourceOwner($token);

        $userInfoArray = $user->toArray();

        $userID =  $userInfoArray['id'];

        $userSteamID = $steamprofile['steamid'];

      //  echo $userID;
      //  echo "<br>";
      //  echo $steamprofile['steamid'];

        $sql = "SELECT member_id FROM core_members WHERE steamid = " .$userSteamID. ";";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        $userRealID = $row['member_id'];

        $sql2 = "UPDATE core_pfields_content SET field_8='".$userID."' WHERE member_id = " .$userRealID. ";";

        if ($conn->query($sql2) === TRUE) {
          ?>
          <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta name="description" content="">
              <meta name="author" content="Dashboard">
              <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

              <title>MazeRP Panel - Discord Association</title>

              <!-- Bootstrap core CSS -->
              <link href="https://mazerp.com/panel/assets/css/bootstrap.css" rel="stylesheet">
              <link href="https://gmod.mazerp.com/forums/bluedog/bluedogtbl.css" rel="stylesheet">
              <!--external css-->
              <link href="https://mazerp.com/panel/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              <!-- Custom styles for this template -->
              <link href="https://mazerp.com/panel/assets/css/layout.css" rel="stylesheet">
              <link href="https://mazerp.com/panel/assets/css/style-responsive.css" rel="stylesheet">

              <style>
              body {
                background: url(https://img1.picload.org/image/rgdgwrcr/the_first_mingebag__gmod__by_m.png) no-repeat center center fixed;
              }
              </style>
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
          		        <h2 class="form-login-heading">Maze Panel - Discord Association</h2>
          		        <div class="login-wrap">
          		            <center>Discord Successfully Associated. Type !verify <?php echo $userRealID; ?> in the verify channeel to get your tags!<br><a href="logout.php">Logout of Steam</a></center>
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
                  $.backstretch("https://img1.picload.org/image/rgdgwrcr/the_first_mingebag__gmod__by_m.png", {speed: 500});
              </script>


            </body>
          </html>
          <?php
        } else {
          echo "Error updating record: " . $conn->error;
        }


    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');

    }
}

}
?>
