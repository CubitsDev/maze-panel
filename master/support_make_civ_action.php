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


if (isset($_GET["url"]))
{
    $url = $_GET["url"];
}

$insertUrl = $conn->real_escape_string($url);


if ($identity == "0") {
  header("location: support_make_civ.php?invalidID=1");
}

$sql67 = "SELECT member_group_id FROM core_members WHERE member_id = ".$identity.";";
$result67 = mysqli_query($conn, $sql67);
$row67 = mysqli_fetch_array($result67);

$userExecute = htmlspecialchars($_SESSION['username']);

if (in_array($row67['member_group_id'], $cannotbeModified)) {

header("location: support_make_civ.php?noPermission=1");

} else {


    $sqlciv = "UPDATE core_members SET member_group_id='12' WHERE member_id=".$identity.";";

    if ($conn->query($sqlciv) === TRUE) {


     $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to Civilian via make Civilian', '$insertUrl');";

        if ($conn->query($sqlLog) === TRUE) {
          echo "successful";
        header("location: support_make_civ.php?successful=1");

        } else {

          echo "Error updating record: " . $conn->error;

        }

    }
}
 ?>
