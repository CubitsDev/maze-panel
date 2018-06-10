<?php
require 'steamauth/steamauth.php';
include ('steamauth/userInfo.php');

if(!isset($_SESSION['steamid'])) {
  header("location: login.php");
} else {
require_once 'config.php';
}

$member_id = $_SESSION['userid'];

$sql = "UPDATE panel_users SET accepted='1' WHERE user_id=".$member_id.";";

$result = mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
    header("location: index.php");
} else {
    echo "Error updating record: " . $conn->error;
}

 ?>
