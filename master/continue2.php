<?php
/* User will be banned via this route */
session_start();

require 'steamauth/steamauth.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['usergroup']) || empty($_SESSION['usergroup'])){
  header("location: login.php");
  exit;
} else {
  require_once 'config.php';

  include ('steamauth/userInfo.php');

}

$steam64 = $steamprofile['steamid'];

$userExecute = htmlspecialchars($_SESSION['username']);



$sql = "UPDATE core_members SET member_group_id = '20' WHERE member_id = " .$_SESSION['userid']. ";";

if ($conn->query($sql) === TRUE) {
    $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Was a Big Dumb Dumb and Did not read and banned themself', NULL);";
    if ($conn->query($sqlLog) === TRUE) {
    header("location: login.php?failed=1");
  }
} else {
    echo "Error updating record: " . $conn->error;
}

 ?>
