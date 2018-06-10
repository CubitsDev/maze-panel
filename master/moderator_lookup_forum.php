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

$userExecute = htmlspecialchars($_SESSION['username']);

function toSteamID($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return 'STEAM_0:' . $y . ':' . floor($z);
}


$sqlQuery = "SELECT name FROM core_members WHERE member_id = ".$identity."";
$resultQuery = mysqli_query($conn, $sqlQuery);
$sqlRow = mysqli_fetch_array($resultQuery);

$sqlQuery1 = "SELECT steamid FROM core_members WHERE member_id = ".$identity."";
$resultQuery1 = mysqli_query($conn, $sqlQuery1);
$sqlRow1 = mysqli_fetch_array($resultQuery1);

$steam64ID = $sqlRow1['steamid'];

$steam32 = toSteamID($steam64ID);

session_start();
$_SESSION['modLookupResult'] = $sqlRow['name'];
$_SESSION['modLookupResult1'] = $steam32;
header("location: moderator_lookup.php?successful=1");

?>
