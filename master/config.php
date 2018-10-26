<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$allowedGroups = array('4', '29', '62', '60', '7', '57', '9', '63', '53', '34', '11');

/*$groupNames = array(
  array("Owner", 4)
  array("Community Manager", 29)
  array("Assistant C. Manager", 62)
  array("Senior Administrator", 60)
  array("Administrator", 7)
  array("Head Of Support", 57)
  array("Moderator", 9)
  array("Trial Moderator", 63)
  array("Support Advisor", 53)
  array("Senior Support", 34)
  array("Support Team", 11)
);*/

$cannotbeModified = array('4', '29', '62', '60', '7', '57', '9', '63', '53', '34', '11');

$modAccessArea = array('4', '29', '62', '60', '7', '57', '9', '63');

$adminAccessArea = array('4', '29', '62', '60', '7', '57');

$seniorAccessArea = array('4', '29', '62', '60');

$managementAccessArea = array('4', '29', '62');

$noOneCanModify = array('4', '29', '62');

$gameHost = "";

$gameUser = "";

$gamePass = "";

$gameDb = "";

$gameConn = new mysqli($gameHost, $gameUser, $gamePass, $gameDb);

if ($gameConn->connect_error) {
    die("Connection failed: " . $gameConn->connect_error);
}

$logHost = "";
$logUser = "";
$logPass = "";
$logsLocation = "";

$gameLogsConn = new mysqli($logHost, $logUser, $logPass, $logsLocation);


if ($gameLogsConn->connect_error) {
    die("Connection failed: " . $gameLogsConn->connect_error);
}

 ?>
