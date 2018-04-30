<?php

header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "***REMOVED***";
$password = "***REMOVED***";
$dbname = "santosforum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Old Broken Method:
/*$sql = "SELECT member_group_id, count(*) AS count
FROM core_members
WHERE num=14
GROUP BY NUM;";
$result0 = $conn->query($sql);

echo $result0;*/

foreach($conn->query('SELECT COUNT(*) FROM core_members WHERE member_group_id=14') as $row) {

$primary = $row['COUNT(*)'];

}

foreach($conn->query('SELECT COUNT(*) FROM core_members WHERE FIND_IN_SET(14, mgroup_others)') as $row) {

$secondary = $row['COUNT(*)'];

}

$full = $primary + $secondary;

echo $full;

$conn->close();


?>
