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

$userExecute = htmlspecialchars($_SESSION['username']);

if (in_array($identity, $cannotbeModified)) {

header("location: user_forums.php?noPermission=1");

} else {

  if ($group == "civ") {

    $sqlciv = "UPDATE core_members SET member_group_id='12' WHERE member_id=".$identity.";";

    if ($conn->query($sqlciv) === TRUE) {


     $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to Civilian', NULL);";

        if ($conn->query($sqlLog) === TRUE) {
          echo "successful";
        header("location: user_forums.php?successful=1&id=".$identity."");

        } else {

          echo "Error updating record: " . $conn->error;

        }

    } else {

    echo "Error updating record: " . $conn->error;
    }
  } elseif ($group == "pd") {
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

    echo "Error updating record: " . $conn->error;
    }
  } elseif ($group == "fd") {
    $sqlciv = "UPDATE core_members SET member_group_id='31' WHERE member_id=".$identity.";";

    if ($conn->query($sqlciv) === TRUE) {


     $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to FD', NULL);";

        if ($conn->query($sqlLog) === TRUE) {
          echo "successful";
        header("location: user_forums.php?successful=1&id=".$identity."");

        } else {

          echo "Error updating record: " . $conn->error;

        }

    } else {

    echo "Error updating record: " . $conn->error;
    }

} elseif ($group == "ems") {
  $sqlciv = "UPDATE core_members SET member_group_id='14' WHERE member_id=".$identity.";";

  if ($conn->query($sqlciv) === TRUE) {


   $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to EMS', NULL);";

      if ($conn->query($sqlLog) === TRUE) {
        echo "successful";
      header("location: user_forums.php?successful=1&id=".$identity."");

      } else {

        echo "Error updating record: " . $conn->error;

      }

  } else {

  echo "Error updating record: " . $conn->error;
  }

} elseif ($group == "ss") {
  $sqlciv = "UPDATE core_members SET member_group_id='51' WHERE member_id=".$identity.";";

  if ($conn->query($sqlciv) === TRUE) {


   $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to Secret Service', NULL);";

      if ($conn->query($sqlLog) === TRUE) {
        echo "successful";
      header("location: user_forums.php?successful=1&id=".$identity."");

      } else {

        echo "Error updating record: " . $conn->error;

      }

  } else {

  echo "Error updating record: " . $conn->error;
  }

} elseif ($group == "banned") {
  $sqlciv = "UPDATE core_members SET member_group_id='20' WHERE member_id=".$identity.";";

  if ($conn->query($sqlciv) === TRUE) {


   $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Banned ".$identity."', NULL);";

      if ($conn->query($sqlLog) === TRUE) {
        echo "successful";
      header("location: user_forums.php?successful=1&id=".$identity."");

      } else {

        echo "Error updating record: " . $conn->error;

      }

  } else {

  echo "Error updating record: " . $conn->error;
  }

} elseif ($group == "member") {
  $sqlciv = "UPDATE core_members SET member_group_id='3' WHERE member_id=".$identity.";";

  if ($conn->query($sqlciv) === TRUE) {


   $sqlLog = "INSERT INTO panel_logs VALUES (NULL, '".$userExecute." Set ".$identity." to Member', NULL);";

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
 ?>
