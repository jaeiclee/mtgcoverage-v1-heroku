<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = "***REMOVED***";
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$con=mysqli_connect($server,$username,$password,$database);

// Check connection
if (mysqli_connect_errno($con))
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
?>
