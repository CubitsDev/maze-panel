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

  header("location: moderator_lookup.php?invalidID=1");

}

function A2S($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $parts = explode(':', $id);
        return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
    } elseif (is_numeric($id) && strlen($id) < 16) {
        return bcadd($id, '76561197960265728');
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
}

$userExecute = htmlspecialchars($_SESSION['username']);

$userSteamID = A2S($identity);

$sqlQuery = "SELECT name FROM core_members WHERE steamid = ".$userSteamID."";
$resultQuery = mysqli_query($conn, $sqlQuery);
$sqlRow = mysqli_fetch_array($resultQuery);

$sqlQuery1 = "SELECT member_id FROM core_members WHERE steamid = ".$userSteamID."";
$resultQuery1 = mysqli_query($conn, $sqlQuery1);
$sqlRow1 = mysqli_fetch_array($resultQuery1);

session_start();
$_SESSION['modLookupResult'] = $sqlRow['name'];
$_SESSION['modLookupResult1'] = $sqlRow1['member_id'];
header("location: moderator_lookup.php?successful=1");

?>
