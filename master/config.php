<?php
$servername = "localhost";
$username = "***REMOVED***";
$password = "***REMOVED***";
$dbname = "santosforum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$allowedGroups = array('62', '4');

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


$header_path = "header_side.php";

 ?>