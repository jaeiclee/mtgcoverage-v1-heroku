<?php require ("common.php"); ?>
<?php include 'header.php'; ?>

<?php

// Pages with up to 10 events



// Get query based on any possible filters

if ($formattype != '') {
	if ($formattype == 'standard') {
		$query = "SELECT * FROM events WHERE standard = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'modern') {
		$query = "SELECT * FROM events WHERE modern = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'legacy') {
		$query = "SELECT * FROM events WHERE legacy = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'vintage') {
		$query = "SELECT * FROM events WHERE vintage = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'limited') {
		$query = "SELECT * FROM events WHERE limited = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'block') {
		$query = "SELECT * FROM events WHERE block = '1' ORDER BY enddate ASC";
		}
	elseif ($formattype == 'mixed') {
		$query = "SELECT * FROM events WHERE formattype = 'mixed' ORDER BY enddate ASC";
		}		
}
// Show events based on past/future events

elseif ($whichevent == '1') {
$query = "SELECT * FROM events WHERE finished = '1' ORDER BY enddate ASC";
}
elseif ($whichevent == '0') {
$query = "SELECT * FROM events WHERE finished = '0' ORDER BY enddate ASC";
}



// Get latest events in case of no filter.


else {
$query = "SELECT * FROM events ORDER BY enddate ASC";

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
<div id="empty" style="height:20px; width:350px; float:left; background-color:#bdbdbd;">
<div id="title" style="height:20px; width:350px; float:left;">
<b>Event name:</b>
</div>
</div>
<div id="date" style="height:20px; width:210px; float:left; background-color:#bdbdbd;">
<b>Date:</b>
</div>
<div id="format" style="height:20px; width:130px; float:left; background-color:#bdbdbd;">
<b>Format:</b>
</div>

<div id="info" style="height:20px; width:50px; float:left; background-color:#bdbdbd;">
<b>Info:</b>
</div>
<div id="results" style="height:20px; width:60px; float:left; background-color:#bdbdbd;">
<b>Results:</b>
</div></div>
<br><br><br>

<!-- MAIN SEGMENT FOR EACH DATABASE ENTRY -->
<?php foreach($rows as $row): ?>
<?php 
$newstartdate = strtotime($row['startdate']);
$startdatepost = date('F d Y', $newstartdate);
$newenddate = strtotime($row['enddate']);
$enddatepost = date('F d Y', $newenddate);

?>

<div id="main" style="margin:auto; width:800px;">
<div id="empty" style="height:20px; width:350px; float:left; background-color:#bdbdbd;">
<div id="title" style="height:20px; width:350px; float:left;">
<? if ($row['finished'] == '1' && $row['visible'] == '1') {
echo ' <a href="index.php?eventid[]= ' .htmlentities($row["id"], ENT_QUOTES, 'UTF-8'). ' ">' .htmlentities($row["name"], ENT_QUOTES, 'UTF-8'). '</a>'; 
} 
else { 
echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8');
}  ?>
</div>
</div>
<div id="date" style="height:20px; width:210px; float:left; background-color:#bdbdbd;">

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
<div id="format" style="height:20px; width:130px; float:left; background-color:#bdbdbd;">
<?php echo htmlentities($row['formattype'], ENT_QUOTES, 'UTF-8'); ?>
</div>
<div id="info" style="height:20px; width:50px; float:left; background-color:#bdbdbd;">
<? if ($row['infolink'] ==! '') {
echo "<a href=" . htmlentities($row['infolink'], ENT_QUOTES, 'UTF-8') . ">Info</a>";
} ?>
</div>
<div id="results" style="height:20px; width:60px; float:left; background-color:#bdbdbd;">
<? if ($row['results'] ==! '') {
echo "<a href=" . htmlentities($row['results'], ENT_QUOTES, 'UTF-8') . ">Results</a>";
} ?>
</div></div>
<br><br>




<?php endforeach; ?>   
<?php include 'footer.php' ?>
