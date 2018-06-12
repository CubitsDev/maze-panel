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

if (!in_array($row['member_group_id'], $seniorAccessArea)) {
  echo "quit trying to abuse kid";
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

  header("location: sa_compensate.php?invalidID=1");

}

if (isset($_GET["cash"]))
{
    $cashAmount = $_GET["cash"];

} else {

  header("location: sa_compensate.php?cashNotNumber=1");

}

if ($row['member_group_id'] == 60) {
    if ($cashAmount > 25000) {
      header("location: sa_compensate.php?tooMuch=1");
      exit;
    }
}


if (isset($_GET["reason"]))
{
    $inputReason = $_GET["reason"];

} else {

  header("location: sa_compensate.php?");

}

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

$userExecute = htmlspecialchars($_SESSION['username']);

try {

try {

$sqlQuery = "SELECT steamid FROM core_members WHERE member_id = ".$identity.";";
$resultQuery = mysqli_query($conn, $sqlQuery);
$sqlRow = mysqli_fetch_array($resultQuery);

$steam64ID = $sqlRow['steamid'];

$steam32ID = toSteamID($steam64ID);

} catch (\Exception $e) {
  echo $e;
  exit;
}

try {

$sqlQuery2 = "SELECT id FROM players WHERE steamid = '".$steam32ID."';";
$resultQuery2 = mysqli_query($gameConn, $sqlQuery2);
$sqlRow2 = mysqli_fetch_array($resultQuery2);

$playerGameID = $sqlRow2['id'];

} catch (\Exception $e) {
  echo $e;
  exit;
}

try {

$sqlQuery3 = "UPDATE characters SET money_bank = money_bank + ".$cashAmount." WHERE player_id = ".$playerGameID.";";
$resultQuery3 = mysqli_query($gameConn, $sqlQuery3);
$sqlRow3 = mysqli_fetch_array($resultQuery3);

} catch (\Exception $e) {
  echo "fucked when doing actual compensate gg. maybe you were retarded and put like the word yellow in or something";
  echo $e;
  exit;
}

$logQuery = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Compensated ".$identity." $".$cashAmount."!', '$inputReason');";
$logresult = mysqli_query($conn, $logQuery);
$logRow = mysqli_fetch_array($logresult);



session_start();
header("location: sa_compensate.php?successful=1");

} catch (\Exception $e) {
echo "Error";
}

?>
