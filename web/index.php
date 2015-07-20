<?php require ("common.php"); ?>
<?php include 'header.php'; ?>

<?php

// Pages with up to 10 events



// Get query based on any possible filters

if ($formattype != '') {
	if ($formattype == 'standard') {
		$query = "SELECT * FROM events WHERE standard = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'modern') {
		$query = "SELECT * FROM events WHERE modern = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'legacy') {
		$query = "SELECT * FROM events WHERE legacy = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'vintage') {
		$query = "SELECT * FROM events WHERE vintage = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'limited') {
		$query = "SELECT * FROM events WHERE limited = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'block') {
		$query = "SELECT * FROM events WHERE block = '1' AND visible = '1' ORDER BY enddate DESC";
		}
	elseif ($formattype == 'mixed') {
		$query = "SELECT * FROM events WHERE formattype = 'mixed' AND visible = '1' ORDER BY enddate DESC";
		}		
}

// Get specific event based on ID number

elseif ($eventid != '') {
$ids = join(',',$eventid); 
$query = "SELECT * FROM events WHERE id IN ($ids) AND visible = '1' ORDER BY enddate DESC";
}

elseif ($searchquery != '') {
	if (strlen($searchquery) <= $min_length) {
	echo "<center>Minimum search length is ".$min_length ."</center>";
	die(mysql_error());
	}
	else {
		if ($searchquery != '') {
		$query = "SELECT * FROM events WHERE visible = '1' AND ((`name` LIKE '%".$searchquery."%') OR (`location` LIKE '%".$searchquery."%')) ORDER BY enddate DESC";
								}
		}
}
// Get latest events in case of no filter.


else {
$query = "SELECT * FROM events WHERE visible = '1' ORDER BY enddate DESC LIMIT 10";

}

    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query");
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>



    
<!-- HEADER WITH SECTION NAMES -->

<div id="main" style="margin:auto; width:800px;">
<div id="empty" style="height:20px; width:100px; float:left; background-color:#bdbdbd;">
</div>
<div id="empty" style="height:20px; width:380px; float:left; background-color:#bdbdbd;">
<div id="title" style="height:20px; width:380px; float:left;">
<b>Event name:</b>
</div>
</div>
<div id="empty" style="height:20px; width:80px; float:left; background-color:#bdbdbd;">
</div>

<div id="format" style="height:20px; width:120px; float:left; background-color:#bdbdbd;">
<b>Format:</b>
</div>
<div id="location" style="height:20px; width:120px; float:left; background-color:#bdbdbd;">
<b>Location:</b>
</div></div>
<br><br><br>

<!-- MAIN SEGMENT FOR EACH DATABASE ENTRY -->

<?php foreach($rows as $row): ?>


<div id="main" style="margin:auto; width:800px;">

<div style="height:100px; width:100px; float:left; background-color:#bdbdbd;">
<br>
<img src='
<?php 
if (strpos ($row['organiser'], 'GP') !== false) { echo 'images/gp.jpg'; }
if (strpos ($row['organiser'], 'SCG') !== false) { echo 'images/scglive.png'; }
if (strpos ($row['organiser'], 'PT') !== false) { echo 'images/pt.jpg'; }
if (strpos ($row['organiser'], 'CFB') !== false) { echo 'images/cfb.png'; }
if (strpos ($row['organiser'], 'TCG') !== false) { echo 'images/tcg.png'; }
if (strpos ($row['organiser'], 'CT') !== false) { echo 'images/cardtitan.png'; }
if (strpos ($row['organiser'], 'SCV') !== false) { echo 'images/scv.png'; }
if (strpos ($row['organiser'], 'WORLDS') !== false) { echo 'images/worlds.png'; }
if (strpos ($row['organiser'], '') !== false) { echo 'images/empty.png'; }
?>
' width="90px"></a>
</div>
<div style="height:100px; width:380px; float:left; background-color:#bdbdbd;">
<div style="height:40px; width:380px; float:left;">
<h3><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
</div>
<div style="height:40px; width:380px; float:left; background-color:#bdbdbd;">

<?php
// Format dates

$check_format_startdate = date("F", strtotime($row['startdate']));
$check_format_enddate = date("F", strtotime($row['enddate']));

if ($check_format_startdate != $check_format_enddate) {
$nice_format_startdate = date("jS F", strtotime($row['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($row['enddate']));

echo htmlentities($nice_format_startdate ." - ". $nice_format_enddate, ENT_QUOTES, 'UTF-8'); 
}
elseif ($row['startdate'] == $row['enddate']) {

$nice_format_enddate = date("jS F Y", strtotime($row['enddate']));
echo htmlentities($nice_format_enddate, ENT_QUOTES, 'UTF-8'); 
}
else {
$nice_format_startdate = date("jS", strtotime($row['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($row['enddate']));

echo htmlentities($nice_format_startdate ." - ". $nice_format_enddate, ENT_QUOTES, 'UTF-8'); 
}

?>

</div>
<div id="empty" style="height:40px; width:380px; float:left; background-color:#bdbdbd;">
</div>
</div>
<div id="empty" style="height:100px; width:80px; float:left; background-color:#bdbdbd;">
</div>
<div id="poster" style="height:100px; width:120px; float:left; background-color:#bdbdbd;">
<br><a href="?formattype=<?php echo htmlentities(strtolower($row['formattype']), ENT_QUOTES, 'UTF-8'); ?>">
<?php echo htmlentities($row['formattype'], ENT_QUOTES, 'UTF-8'); ?></a>
</div>
<div id="location" style="height:100px; width:120px; float:left; background-color:#bdbdbd;">
<br><?php echo htmlentities($row['location'], ENT_QUOTES, 'UTF-8'); ?>
</div>

<!-- POPDOWN FOR EACH EVENT -->


<script type="text/javascript">
$(document).ready(function(){
	$("#expanderHead<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>").click(function(){
		$("#expanderContent<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>").slideToggle();
		if ($("#expanderSign<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>").text() == "+"){
			$("#expanderSign<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>").html("−")
		}
		else {
			$("#expanderSign<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>").text("+")
		}
	});
});
</script>


<div style="height:25px; width:800px; float:left;  background-color:#bdbdbd;">
<center><b><span id="expanderHead<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>" style="cursor:pointer;">
	Click to Expand <span id="expanderSign<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>">+</span></span></b></center>
</div>


<div id="expanderContent<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>" style="display:none; width:800px; float:left; background-color:#bdbdbd;">
<div style="width:100px; float:left; background-color:#bdbdbd;">
&nbsp;
</div>
<div style="width:700px; float:left; background-color:#bdbdbd;">
<br><br>
<div style="width:120px; float:left; background-color:#bdbdbd;">

<?php if ($row['round1'] == '') {echo '';} else { 
if (strpos($row['round1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 1</a><br>' ;}
if ($row['round2'] == '') {echo '';} else { 
if (strpos($row['round2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 2</a><br>' ;}
if ($row['round3'] == '') {echo '';} else { 
if (strpos($row['round3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 3</a><br>' ;}
if ($row['round4'] == '') {echo '';} else { 
if (strpos($row['round4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 4</a><br>' ;}
if ($row['round5'] == '') {echo '';} else { 
if (strpos($row['round5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 5</a><br>' ;}
?>

<?php if ($row['round6'] == '') {echo '';} else { 
if (strpos($row['round6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 6</a><br>' ;}
if ($row['round7'] == '') {echo '';} else { 
if (strpos($row['round7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 7</a><br>' ;}
if ($row['round8'] == '') {echo '';} else { 
if (strpos($row['round8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 8</a><br>' ;}
if ($row['round9'] == '') {echo '';} else { 
if (strpos($row['round9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 9</a><br>' ;}
if ($row['round10'] == '') {echo '';} else { 
if (strpos($row['round10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 10</a><br>' ;}
?>

<?php if ($row['round11'] == '') {echo '';} else { 
if (strpos($row['round11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 11</a><br>' ;}
if ($row['round12'] == '') {echo '';} else { 
if (strpos($row['round12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 12</a><br>' ;}
if ($row['round13'] == '') {echo '';} else { 
if (strpos($row['round13'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round13'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round13"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 13</a><br>' ;}
if ($row['round14'] == '') {echo '';} else { 
if (strpos($row['round14'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round14'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round14"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 14</a><br>' ;}
if ($row['round15'] == '') {echo '';} else { 
if (strpos($row['round15'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round15'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round15"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 15</a><br>' ;}
?>


<?php if ($row['round16'] == '') {echo '';} else { 
if (strpos($row['round16'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round16'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round16"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 16</a><br>' ;}
if ($row['round17'] == '') {echo '';} else { 
if (strpos($row['round17'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round17'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round17"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 17</a><br>' ;}
if ($row['round18'] == '') {echo '';} else { 
if (strpos($row['round18'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round18'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round18"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 18</a><br>' ;}
if ($row['round19'] == '') {echo '';} else { 
if (strpos($row['round19'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round19'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round19"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 19</a><br>' ;}
if ($row['round20'] == '') {echo '';} else { 
if (strpos($row['round20'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['round20'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["round20"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Round 20</a><br>' ;}
?>

<br><br>

<?php if ($row['quarter'] == '') {echo '<br>';} else { 
if (strpos($row['quarter'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['quarter'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["quarter"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Quarter Final</a><br>' ;}

if ($row['quarter2'] == '') {echo '';} else { 
if (strpos($row['quarter2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['quarter2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["quarter2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Quarter 2 Final</a><br>' ;}

if ($row['quarter3'] == '') {echo '';} else { 
if (strpos($row['quarter3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['quarter3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["quarter3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Quarter 3 Final</a><br>' ;}

if ($row['quarter4'] == '') {echo '';} else { 
if (strpos($row['quarter4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['quarter4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["quarter4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Quarter 4 Final</a><br>' ;}


if ($row['semi'] == '') {echo '<br>';} else { 
if (strpos($row['semi'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['semi'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["semi"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Semi Final</a><br>' ;}
if ($row['semi2'] == '') {echo '';} else { 
if (strpos($row['semi2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['semi2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["semi2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Semi 2 Final</a><br>' ;}

if ($row['final'] == '') {echo '<br>';} else { 
if (strpos($row['final'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['final'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["final"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Finals</a><br>' ;}


?>
<br>

<?php 

if ($row['extra1'] == '') {echo '';} else { 
if (strpos($row['extra1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra2'] == '') {echo '';} else { 
if (strpos($row['extra2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra3'] == '') {echo '';} else { 
if (strpos($row['extra3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra4'] == '') {echo '';} else { 
if (strpos($row['extra4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra5'] == '') {echo '';} else { 
if (strpos($row['extra5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra6'] == '') {echo '';} else { 
if (strpos($row['extra6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra7'] == '') {echo '';} else { 
if (strpos($row['extra7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra8'] == '') {echo '';} else { 
if (strpos($row['extra8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra9'] == '') {echo '';} else { 
if (strpos($row['extra9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra10'] == '') {echo '';} else { 
if (strpos($row['extra10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra11'] == '') {echo '';} else { 
if (strpos($row['extra11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

if ($row['extra12'] == '') {echo '';} else { 
if (strpos($row['extra12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
elseif (strpos($row['extra12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
echo '<a href=" ' .htmlentities($row["extra12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Extra</a><br>' ;}

echo '<br>';

if ($row['results'] == '') {echo '<img src="images/empty.png"> Results<br><br>';} else { echo '<img src="images/empty.png"> <a href=" ' .htmlentities($row["results"], ENT_QUOTES,"UTF-8"). '" target="_newtab">Results</a><br><br>' ;}

if ($row['extratext'] == '') {echo '';} else { echo '<img src="images/empty.png"> Info:<br><br>';}



 ?>
<br><br>
</div>

<?php if ($SD == '' OR $SD == '1') {
echo '<div style="width:580px; float:left; background-color:#bdbdbd;">';

if ($row['round1'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round1player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round1deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round1deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round1player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round1deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round1deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round2'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round2player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round2player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round3'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round3player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round3deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round3deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round3player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round3deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round3deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round4'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round4player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round4deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round4deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round4player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round4deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round4deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round5'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round5player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round5deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round5deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round5player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round5deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round5deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round6'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round6player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round6deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round6deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round6player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round6deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round6deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round7'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round7player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round7deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round7deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round7player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round7deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round7deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round8'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round8player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round8deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round8deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round8player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round8deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round8deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round9'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round9player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round9deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round9deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round9player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round9deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round9deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round10'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round10player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round10deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round10deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round10player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round10deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round10deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round11'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round11player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round11deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round11deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round11player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round11deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round11deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round12'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round12player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round12deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round12deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round12player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round12deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round12deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round13'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round13player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round13deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round13deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round13player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round13deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round13deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round14'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round14player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round14deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round14deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round14player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round14deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round14deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round15'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round15player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round15deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round15deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round15player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round15deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round15deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round16'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round16player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round16deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round16deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round16player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round16deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round16deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round17'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round17player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round17deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round17deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round17player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round17deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round17deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round18'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round18player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round18deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round18deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round18player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round18deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round18deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round19'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round19player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round19deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round19deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round19player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round19deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round19deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round20'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["round20player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round20deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round20deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["round20player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["round20deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round20deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

echo '<br><br>';

if ($row['quarter'] == '') {echo '<br>';}
else { echo ' - ' .htmlentities($row["quarterplayer1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarterdeck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarterdeck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["quarterplayer2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarterdeck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarterdeck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter2'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["quarter2player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["quarter2player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter3'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["quarter3player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter3deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter3deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["quarter3player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter3deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter3deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter4'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["quarter4player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter4deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter4deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["quarter4player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["quarter4deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter4deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['semi'] == '') {echo '<br>';}
else { echo ' - ' .htmlentities($row["semiplayer1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["semideck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semideck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["semiplayer2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["semideck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semideck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['semi2'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["semi2player1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["semi2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semi2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["semi2player2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["semi2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semi2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['final'] == '') {echo '<br>';}
else { echo ' - ' .htmlentities($row["finalplayer1"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["finaldeck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["finaldeck1"], ENT_QUOTES,"UTF-8"). '</a>) vs ' .htmlentities($row["finalplayer2"], ENT_QUOTES,"UTF-8"). ' (<a href="asearch.php?deck=' .htmlentities($row["finaldeck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["finaldeck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

echo '<br>';

if ($row['extra1info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra1info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra2info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra2info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra3info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra3info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra4info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra4info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra5info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra5info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra6info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra6info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra7info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra7info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra8info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra8info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra9info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra9info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra10info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra10info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra11info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra11info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra12info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra12info"], ENT_QUOTES,"UTF-8"). '<br>' ;}


echo '<br><br><br>';

if ($row['extratext'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extratext"], ENT_QUOTES,"UTF-8"). '<br>' ;}

echo '</div>'; } 



elseif ($SD == '2') {

echo '<div style="width:580px; float:left; background-color:#bdbdbd;">';

echo '<br><br>';

echo '<br>';
echo '<br>';
echo '<br>';

if ($row['extra1info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra1info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra2info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra2info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra3info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra3info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra4info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra4info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra5info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra5info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra6info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra6info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra7info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra7info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra8info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra8info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra9info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra9info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra10info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra10info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra11info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra11info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra12info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra12info"], ENT_QUOTES,"UTF-8"). '<br>' ;}

echo '<br><br><br>';

if ($row['extratext'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extratext"], ENT_QUOTES,"UTF-8"). '<br>' ;}

echo '</div>'; } 




// Show only decks when in Spoilerfree mode.




else {

echo '<div style="width:580px; float:left; background-color:#bdbdbd;">';

if ($row['round1'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round1deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round1deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round1deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round1deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round2'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round3'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round3deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round3deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round3deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round3deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round4'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round4deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round4deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round4deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round4deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round5'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round5deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round5deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round5deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round5deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round6'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round6deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round6deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round6deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round6deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round7'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round7deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round7deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round7deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round7deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round8'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round8deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round8deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round8deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round8deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round9'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round9deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round9deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round9deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round9deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round10'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round10deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round10deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round10deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round10deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round11'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round11deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round11deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round11deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round11deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round12'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round12deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round12deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round12deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round12deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round13'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round13deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round13deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round13deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round13deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round14'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round14deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round14deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round14deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round14deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round15'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round15deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round15deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round15deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round15deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

if ($row['round16'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round16deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round16deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round16deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round16deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round17'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round17deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round17deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round17deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round17deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round18'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round18deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round18deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round18deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round18deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round19'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round19deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round19deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round19deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round19deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['round20'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["round20deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round20deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["round20deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["round20deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

echo '<br><br>';

if ($row['quarter'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["quarterdeck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarterdeck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["quarterdeck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarterdeck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter2'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["quarter2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["quarter2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter3'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["quarter3deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter3deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["quarter3deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter3deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['quarter4'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["quarter4deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter4deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["quarter4deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["quarter4deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['semi'] == '') {echo '<br>';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["semideck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semideck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["semideck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semideck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['semi2'] == '') {echo '';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["semi2deck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semi2deck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["semi2deck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["semi2deck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}
if ($row['final'] == '') {echo '<br>';}
else { echo ' - (<a href="asearch.php?deck=' .htmlentities($row["finaldeck1"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["finaldeck1"], ENT_QUOTES,"UTF-8"). '</a>) vs (<a href="asearch.php?deck=' .htmlentities($row["finaldeck2"], ENT_QUOTES,"UTF-8"). '">' .htmlentities($row["finaldeck2"], ENT_QUOTES,"UTF-8"). '</a>)<br>' ;}

echo '<br>';

if ($row['extra1info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra1info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra2info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra2info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra3info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra3info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra4info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra4info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra5info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra5info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra6info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra6info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra7info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra7info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra8info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra8info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra9info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra9info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra10info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra10info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra11info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra11info"], ENT_QUOTES,"UTF-8"). '<br>' ;}
if ($row['extra12info'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extra12info"], ENT_QUOTES,"UTF-8"). '<br>' ;}

echo '<br><br><br>';

if ($row['extratext'] == '') {echo '';}
else { echo ' - ' .htmlentities($row["extratext"], ENT_QUOTES,"UTF-8"). '<br>' ;}

echo '</div>'; } 



?> 

</div>

</div>
<div id="empty" style="height:10px; width:800px; float:left;">
</div></div>



<?php endforeach; ?>   
<?php include 'footer.php' ?>
