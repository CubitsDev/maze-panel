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


if (isset($_GET["gchange"]))
{
    $group = $_GET["gchange"];
} else {
  $group = "0";
}

if ($identity == "0") {
  header("location: user_forums.php?invalidID=1");
}

$sql67 = "SELECT member_group_id FROM core_members WHERE member_id = ".$identity.";";
$result67 = mysqli_query($conn, $sql67);
$row67 = mysqli_fetch_array($result67);


$userExecute = htmlspecialchars($_SESSION['username']);

if (in_array($row67['member_group_id'], $cannotbeModified)) {

header("location: user_forums.php?noPermission=1");

} else {

  if ($group == "0") {

    echo "enter a fucking group";

  } else {
    $sqlciv = "UPDATE core_members SET member_group_id='13' WHERE member_id=".$identity.";";

    if ($conn->query($sqlciv) === TRUE) {


     $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to PD', NULL);";

        if ($conn->query($sqlLog) === TRUE) {
          echo "successful";
        header("location: user_forums.php?successful=1&id=".$identity."");

        } else {

          echo "Error updating record: " . $conn->error;

        }

    } else {

      $sqlPrimary = "UPDATE core_members SET member_group_id='".$group."' WHERE member_id=".$identity.";";

      if ($conn->query($sqlPrimary) === TRUE) {


       $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Changed ".$identity." Primary Group to ".$str."', NULL);";

          if ($conn->query($sqlLog) === TRUE) {
            echo "successful";
          header("location: user_forums.php?successful=1&id=".$identity."");

          } else {

            echo "Error updating record: " . $conn->error;

          }

      } else {

      echo "Error updating record: " . $conn->error;
      }

}

}
}

 ?>
