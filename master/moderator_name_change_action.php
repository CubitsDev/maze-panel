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

if (!in_array($row['member_group_id'], $modAccessArea)) {
  header("location: moderator_name_change.php");
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


if (isset($_GET["newfirst"]))
{
    $newFirst = $_GET["newfirst"];
}

if (isset($_GET["newsecond"]))
{
    $newSecond = $_GET["newsecond"];
}

if (isset($_GET["gameChange"]))
{
    $gameChange = $_GET["gameChange"];
}

if (isset($_GET["playerCharge"]))
{
    $playerCharge = $_GET["playerCharge"];
}

$insertUrl = $conn->real_escape_string($url);


if ($identity == "0") {
  header("location: support_name_change.php?invalidID=1");
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


$sql67 = "SELECT member_group_id FROM core_members WHERE member_id = ".$identity.";";
$result67 = mysqli_query($conn, $sql67);
$row67 = mysqli_fetch_array($result67);

$userExecute = htmlspecialchars($_SESSION['username']);

if (in_array($row67['member_group_id'], $cannotbeModified)) {

header("location: moderator_name_change.php?noPermission=1");

} else {

    $forumName = $newFirst + " " + $newSecond;

    $sqlForumChange = "UPDATE core_members SET name='".$forumName."' WHERE member_id=".$identity.";";

    if ($conn->query($sqlForumChange) === TRUE) {

      if ($gameChange == "1") {

        $sqlQuery = "SELECT steamid FROM core_members WHERE member_id = ".$identity.";";
        $resultQuery = mysqli_query($conn, $sqlQuery);
        $sqlRow = mysqli_fetch_array($resultQuery);

        $steam64ID = $sqlRow['steamid'];

        $steam32ID = toSteamID($steam64ID);

        $sqlQuery2 = "SELECT id FROM players WHERE steamid = '".$steam32ID."';";
        $resultQuery2 = mysqli_query($gameConn, $sqlQuery2);
        $sqlRow2 = mysqli_fetch_array($resultQuery2);

        $playerGameID = $sqlRow2['id'];

        $sqlGameChange1 = "UPDATE characters SET first_name='".$newFirst."' WHERE player_id = ".$playerGameID.";";
        $sqlGameChange2 = "UPDATE characters SET last_name='".$newSecond."' WHERE player_id = ".$playerGameID.";";

        if ($gameConn->query($sqlGameChange1) === TRUE) {
          if ($gameConn->query($sqlGameChange2) === TRUE) {

            if ($playerCharge == "1") {

              $sqlQuery4 = "UPDATE characters SET money_bank = money_bank - 2500 WHERE player_id = ".$playerGameID.";";
              $resultQuery4 = mysqli_query($gameConn, $sqlQuery4);
              $sqlRow4 = mysqli_fetch_array($resultQuery4);

            }

          }
        }

      }


     $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." Name to ".$forumName."', '$insertUrl');";

        if ($conn->query($sqlLog) === TRUE) {
          echo "successful";
          session_start();
          $_SESSION['modNameResult'] = $forumName;
        header("location: moderator_name_change.php?successful=1");

        } else {

          echo "Error updating record: " . $conn->error;

        }

    }
}
 ?>
