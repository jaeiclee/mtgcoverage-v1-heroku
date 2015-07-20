<?php
$dbstreams = mysql_connect("localhost", "db_username", "db_password");
mysql_select_db("database_name", $dbstreams);


$formattype = $_GET['formattype'];
$eventid = $_GET['eventid'];
$whichevent = $_GET['whichevent'];
$SD = $_GET['SD'];
$searchquery = $_GET['searchquery'];
$querystring = basename($_SERVER["PHP_SELF"]);
$min_length = 3;
$searchquery = htmlspecialchars($searchquery); 

$online = 'images/online.png';     // Set online image here
$offline = 'images/offline.png';   // Set offline image here
?>

<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Magic Coverage</title>


<!-- Script for expand/collapse -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">

	
</head>
<body>
<div id="container">
<div id="header" style="margin:auto; width:800px;">

<div id="header-left" style="width:540px; float:left;">

<?php include 'menu/horizontal.php' ?>



</div>

<div id="header-right" style="width:260px; float: left;" align="right">

<form action="index.php" method="GET">
        <input type="text" value="Search for events" onfocus="if(this.value == 'Search for events'){this.value = '';}" name="searchquery" />
        <input type="submit" value="Search" />
    </form>

</div>

</div>







<br><br>

<!-- BREAKING NEWS -->

<div id="main" style="margin:auto; width:800px;">
<div id="empty" style="height:20px; width:800px; float:left; background-color:#bdbdbd;">
<font color="#990000"><center><?php include 'news.php'; ?></center></font>
</div></div>
<br><br>
