<?php
$con=mysqli_connect("localhost","db_username","db_password","database_name");

// Check connection
if (mysqli_connect_errno($con))
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
?>
