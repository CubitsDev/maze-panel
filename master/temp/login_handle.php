<?php
require 'steamauth/steamauth.php';
include ('steamauth/userInfo.php');

if(!isset($_SESSION['steamid'])) {
  header("location: login.php");
} else {
require_once 'config.php';
}
$steam64 = $steamprofile['steamid'];

$sql = "SELECT member_group_id FROM core_members WHERE steamid = " .$steam64. ";";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);



/*echo $row['member_group_id'];

echo $steam64;*/

if (in_array($row['member_group_id'], $allowedGroups)) {
  $sql2 = "SELECT name FROM core_members WHERE steamid = " .$steam64. ";";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $sql3 = "SELECT pp_thumb_photo FROM core_members WHERE steamid = " .$steam64. ";";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $sql4 = "SELECT member_id FROM core_members WHERE steamid = " .$steam64. ";";
  $result4 = mysqli_query($conn, $sql4);
  $row4 = mysqli_fetch_assoc($result4);

  $member_id = $row4['member_id'];

  $forumURL = "https://gmod.mazerp.com/forums/index.php?/profile/{$member_id}-panel-user/";

//  $sql5 = mysqli_query("INSERT INTO `panel_users` (`user_id`, `accepted`) VALUES ('$member_id', '0');");
 $sql5 = "INSERT INTO `panel_users` (`user_id`, `accepted`, `user_link`) VALUES ('{$member_id}', '0', '{$forumURL}') ON DUPLICATE KEY UPDATE user_id=user_id;";
  $result5 = mysqli_query($conn, $sql5);

$sql6 = "SELECT accepted FROM panel_users WHERE user_id = ".$member_id.";";
$result6 = mysqli_query($conn, $sql6);
$row6 = mysqli_fetch_array($result6);

if ($row6['accepted'] == 0) {
  $accepted = false;
} else {
  $accepted = true;
}
  session_start();
  $_SESSION['username'] = $row2['name'];
  $_SESSION['usergroup'] = $row['member_group_id'];
  $_SESSION['image'] = $row3['pp_thumb_photo'];
  $_SESSION['userid'] = $row4['member_id'];
echo $accepted;
  if ($accepted == false) {
  header("location: welcome.php");
} else {
  header("location: index.php");
}

} else {

  session_start();

  $_SESSION = array();

  session_destroy();
  header("location: login.php?failed=1");
  exit;
}
 ?>
