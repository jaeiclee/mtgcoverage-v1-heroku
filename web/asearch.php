<?php
    mysql_connect("localhost", "db_username", "db_password") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("database_name") or die(mysql_error());
    /* tutorial_search is the name of database we've created */
?>
 
<?php include 'header.php'; ?>
<?php 
$overviewformattypestandard == 0;
$overviewformattypemodern == 0;
$overviewformattypelegacy == 0;
$overviewformattypelimited == 0;
$overviewformattypemixed == 0;
 ?>

<div id="main" style="margin:auto; width:800px;">

<?php
    $query = $_GET['deck']; 
    // gets value sent over search form
     
    $min_length = 2;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM events
            WHERE (`round1deck1` LIKE '%".$query."%') OR (`round1deck2` LIKE '%".$query."%') OR 
			(`round1deck1` LIKE '%".$query."%') OR (`round1deck2` LIKE '%".$query."%') OR 
			(`round2deck1` LIKE '%".$query."%') OR (`round2deck2` LIKE '%".$query."%') OR 
			(`round3deck1` LIKE '%".$query."%') OR (`round3deck2` LIKE '%".$query."%') OR 
			(`round4deck1` LIKE '%".$query."%') OR (`round4deck2` LIKE '%".$query."%') OR 
			(`round5deck1` LIKE '%".$query."%') OR (`round5deck2` LIKE '%".$query."%') OR 
			(`round6deck1` LIKE '%".$query."%') OR (`round6deck2` LIKE '%".$query."%') OR 
			(`round7deck1` LIKE '%".$query."%') OR (`round7deck2` LIKE '%".$query."%') OR 
			(`round8deck1` LIKE '%".$query."%') OR (`round8deck2` LIKE '%".$query."%') OR 
			(`round9deck1` LIKE '%".$query."%') OR (`round9deck2` LIKE '%".$query."%') OR 
			(`round10deck1` LIKE '%".$query."%') OR (`round10deck2` LIKE '%".$query."%') OR 
			(`round11deck1` LIKE '%".$query."%') OR (`round11deck2` LIKE '%".$query."%') OR 
			(`round12deck1` LIKE '%".$query."%') OR (`round12deck2` LIKE '%".$query."%') OR 
			(`round13deck1` LIKE '%".$query."%') OR (`round13deck2` LIKE '%".$query."%') OR 
			(`round14deck1` LIKE '%".$query."%') OR (`round14deck2` LIKE '%".$query."%') OR 
			(`round15deck1` LIKE '%".$query."%') OR (`round15deck2` LIKE '%".$query."%') OR 
			(`round16deck1` LIKE '%".$query."%') OR (`round16deck2` LIKE '%".$query."%') OR 
			(`round17deck1` LIKE '%".$query."%') OR (`round17deck2` LIKE '%".$query."%') OR 
			(`round18deck1` LIKE '%".$query."%') OR (`round18deck2` LIKE '%".$query."%') OR 
			(`round19deck1` LIKE '%".$query."%') OR (`round19deck2` LIKE '%".$query."%') OR 
			(`round20deck1` LIKE '%".$query."%') OR (`round20deck2` LIKE '%".$query."%') OR 
			(`quarterdeck1` LIKE '%".$query."%') OR (`quarterdeck2` LIKE '%".$query."%') OR 
			(`quarter2deck1` LIKE '%".$query."%') OR (`quarter2deck2` LIKE '%".$query."%') OR 
			(`quarter3deck1` LIKE '%".$query."%') OR (`quarter3deck2` LIKE '%".$query."%') OR 
			(`quarter4deck1` LIKE '%".$query."%') OR (`quarter4deck2` LIKE '%".$query."%') OR 
			(`semideck1` LIKE '%".$query."%') OR (`semideck2` LIKE '%".$query."%') OR 
			(`semi2deck1` LIKE '%".$query."%') OR (`semi2deck2` LIKE '%".$query."%') OR 
			(`finaldeck1` LIKE '%".$query."%') OR (`finaldeck2` LIKE '%".$query."%') 
			ORDER BY formattype DESC, enddate DESC;	
			") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
			 if ($results['formattype'] == 'Standard' && $overviewformattypestandard == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypestandard = 1; }
			 			 if ($results['formattype'] == 'Modern' && $overviewformattypemodern == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypemodern = 1; }
						 if ($results['formattype'] == 'Legacy' && $overviewformattypelegacy == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypelegacy = 1; }
						 if ($results['formattype'] == 'Limited' && $overviewformattypelimited == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypelimited = 1; }
						 if ($results['formattype'] == 'Mixed' && $overviewformattypemixed == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypemixed = 1; }

				// Format dates

$check_format_startdate = date("F", strtotime($results['startdate']));
$check_format_enddate = date("F", strtotime($results['enddate']));

if ($check_format_startdate != $check_format_enddate) {
$nice_format_startdate = date("jS F", strtotime($results['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));

}
elseif ($results['startdate'] == $results['enddate']) {

$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));
}
else {
$nice_format_startdate = date("jS", strtotime($results['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));

}

				
				
			echo "<br><b>";
			echo $results['name'] . ' (' .$nice_format_startdate. ' - ' .$nice_format_enddate. ')';
			echo "</b><br>";
				
				
				
				if (stripos($results['round1deck1'], $query) !==false) {				
					if (strpos($results['round1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round1player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round1player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round1deck2'], $query) !==false) {
					if (strpos($results['round1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round1player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round1player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round2deck1'], $query) !==false) {				
					if (strpos($results['round2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round2deck2'], $query) !==false) {
					if (strpos($results['round2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				
								if (stripos($results['round3deck1'], $query) !==false) {				
					if (strpos($results['round3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round3deck2'], $query) !==false) {
					if (strpos($results['round3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round4deck1'], $query) !==false) {				
					if (strpos($results['round4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round4deck2'], $query) !==false) {
					if (strpos($results['round4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round5deck1'], $query) !==false) {				
					if (strpos($results['round5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round5player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round5player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round5deck2'], $query) !==false) {
					if (strpos($results['round5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round5player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round5player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round6deck1'], $query) !==false) {				
					if (strpos($results['round6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round6player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round6player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round6deck2'], $query) !==false) {
					if (strpos($results['round6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round6player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round6player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round7deck1'], $query) !==false) {				
					if (strpos($results['round7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round7player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round7player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round7deck2'], $query) !==false) {
					if (strpos($results['round7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round7player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round7player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round8deck1'], $query) !==false) {				
					if (strpos($results['round8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round8player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round8player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round8deck2'], $query) !==false) {
					if (strpos($results['round8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round8player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round8player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round9deck1'], $query) !==false) {				
					if (strpos($results['round9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round9player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round9player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round9deck2'], $query) !==false) {
					if (strpos($results['round9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round9player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round9player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round10deck1'], $query) !==false) {				
					if (strpos($results['round10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round10player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round10player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round10deck2'], $query) !==false) {
					if (strpos($results['round10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round10player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round10player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round11deck1'], $query) !==false) {				
					if (strpos($results['round11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round11player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round11player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round11deck2'], $query) !==false) {
					if (strpos($results['round11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round11player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round11player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round12deck1'], $query) !==false) {				
					if (strpos($results['round12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round12player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round12player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round12deck2'], $query) !==false) {
					if (strpos($results['round12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round12player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round12player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round13deck1'], $query) !==false) {				
					if (strpos($results['round13'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round13'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round13"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round13player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round13player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round13deck2'], $query) !==false) {
					if (strpos($results['round13'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round13'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round13"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round13player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round13player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round14deck1'], $query) !==false) {				
					if (strpos($results['round14'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round14'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round14"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round14player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round14player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round14deck2'], $query) !==false) {
					if (strpos($results['round14'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round14'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round14"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round14player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round14player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round15deck1'], $query) !==false) {				
					if (strpos($results['round15'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round15'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round15"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round15player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round15player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round15deck2'], $query) !==false) {
					if (strpos($results['round15'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round15'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round15"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round15player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round15player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round16deck1'], $query) !==false) {				
					if (strpos($results['round16'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round16'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round16"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round16player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round16player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round16deck2'], $query) !==false) {
					if (strpos($results['round16'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round16'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round16"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round16player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round16player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round17deck1'], $query) !==false) {				
					if (strpos($results['round17'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round17'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round17"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round17player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round17player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round17deck2'], $query) !==false) {
					if (strpos($results['round17'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round17'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round17"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round17player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round17player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round18deck1'], $query) !==false) {				
					if (strpos($results['round18'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round18'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round18"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round18player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round18player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round18deck2'], $query) !==false) {
					if (strpos($results['round18'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round18'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round18"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round18player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round18player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round19deck1'], $query) !==false) {				
					if (strpos($results['round19'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round19'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round19"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round19player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round19player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round19deck2'], $query) !==false) {
					if (strpos($results['round19'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round19'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round19"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round19player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round19player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round20deck1'], $query) !==false) {				
					if (strpos($results['round20'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round20'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round20"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round20player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round20player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round20deck2'], $query) !==false) {
					if (strpos($results['round20'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round20'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round20"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round20player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round20player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['quarterdeck1'], $query) !==false) {				
					if (strpos($results['quarter'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarterplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarterplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarterdeck2'], $query) !==false) {
					if (strpos($results['quarter'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarterplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarterplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['quarter2deck1'], $query) !==false) {				
					if (strpos($results['quarter2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter2deck2'], $query) !==false) {
					if (strpos($results['quarter2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['quarter3deck1'], $query) !==false) {				
					if (strpos($results['quarter3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter3deck2'], $query) !==false) {
					if (strpos($results['quarter3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['quarter4deck1'], $query) !==false) {				
					if (strpos($results['quarter4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter4deck2'], $query) !==false) {
					if (strpos($results['quarter4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				
				
				
				
								if (stripos($results['semideck1'], $query) !==false) {				
					if (strpos($results['semi'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semiplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semiplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['semideck2'], $query) !==false) {
					if (strpos($results['semi'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semiplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semiplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['semi2deck1'], $query) !==false) {				
					if (strpos($results['semi2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semi2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semi2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['semi2deck2'], $query) !==false) {
					if (strpos($results['semi2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semi2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semi2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['finaldeck1'], $query) !==false) {				
					if (strpos($results['final'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['final'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["final"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["finalplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["finalplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['finaldeck2'], $query) !==false) {
					if (strpos($results['final'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['final'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["final"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["finalplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["finalplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				
				echo '<br><br>';
				
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum

    }
?>


<?php
    $query = $_GET['player']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
		$raw_results = mysql_query("SELECT * FROM events
            WHERE (`round1player1` LIKE '%".$query."%') OR (`round1player2` LIKE '%".$query."%') OR 
			(`round1player1` LIKE '%".$query."%') OR (`round1player2` LIKE '%".$query."%') OR 
			(`round2player1` LIKE '%".$query."%') OR (`round2player2` LIKE '%".$query."%') OR 
			(`round3player1` LIKE '%".$query."%') OR (`round3player2` LIKE '%".$query."%') OR 
			(`round4player1` LIKE '%".$query."%') OR (`round4player2` LIKE '%".$query."%') OR 
			(`round5player1` LIKE '%".$query."%') OR (`round5player2` LIKE '%".$query."%') OR 
			(`round6player1` LIKE '%".$query."%') OR (`round6player2` LIKE '%".$query."%') OR 
			(`round7player1` LIKE '%".$query."%') OR (`round7player2` LIKE '%".$query."%') OR 
			(`round8player1` LIKE '%".$query."%') OR (`round8player2` LIKE '%".$query."%') OR 
			(`round9player1` LIKE '%".$query."%') OR (`round9player2` LIKE '%".$query."%') OR 
			(`round10player1` LIKE '%".$query."%') OR (`round10player2` LIKE '%".$query."%') OR 
			(`round11player1` LIKE '%".$query."%') OR (`round11player2` LIKE '%".$query."%') OR 
			(`round12player1` LIKE '%".$query."%') OR (`round12player2` LIKE '%".$query."%') OR 
			(`round13player1` LIKE '%".$query."%') OR (`round13player2` LIKE '%".$query."%') OR 
			(`round14player1` LIKE '%".$query."%') OR (`round14player2` LIKE '%".$query."%') OR 
			(`round15player1` LIKE '%".$query."%') OR (`round15player2` LIKE '%".$query."%') OR 
			(`round16player1` LIKE '%".$query."%') OR (`round16player2` LIKE '%".$query."%') OR 
			(`round17player1` LIKE '%".$query."%') OR (`round17player2` LIKE '%".$query."%') OR 
			(`round18player1` LIKE '%".$query."%') OR (`round18player2` LIKE '%".$query."%') OR 
			(`round19player1` LIKE '%".$query."%') OR (`round19player2` LIKE '%".$query."%') OR 
			(`round20player1` LIKE '%".$query."%') OR (`round20player2` LIKE '%".$query."%') OR 
			(`quarterplayer1` LIKE '%".$query."%') OR (`quarterplayer2` LIKE '%".$query."%') OR 
			(`quarter2player1` LIKE '%".$query."%') OR (`quarter2player2` LIKE '%".$query."%') OR 
			(`quarter3player1` LIKE '%".$query."%') OR (`quarter3player2` LIKE '%".$query."%') OR 
			(`quarter4player1` LIKE '%".$query."%') OR (`quarter4player2` LIKE '%".$query."%') OR 
			(`semiplayer1` LIKE '%".$query."%') OR (`semiplayer2` LIKE '%".$query."%') OR 
			(`semi2player1` LIKE '%".$query."%') OR (`semi2player2` LIKE '%".$query."%') OR 
			(`finalplayer1` LIKE '%".$query."%') OR (`finalplayer2` LIKE '%".$query."%') 
			ORDER BY formattype DESC, enddate DESC;	
			") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
			 
			 if ($results['formattype'] == 'Standard' && $overviewformattypestandard == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypestandard = 1; }
			 			 if ($results['formattype'] == 'Modern' && $overviewformattypemodern == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypemodern = 1; }
						 if ($results['formattype'] == 'Legacy' && $overviewformattypelegacy == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypelegacy = 1; }
						 if ($results['formattype'] == 'Limited' && $overviewformattypelimited == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypelimited = 1; }
						 if ($results['formattype'] == 'Mixed' && $overviewformattypemixed == 0) {
                echo "<br><h3> ". $results['formattype']. ":</h3><br> ";
				$overviewformattypemixed = 1; }
				

// Format dates

$check_format_startdate = date("F", strtotime($results['startdate']));
$check_format_enddate = date("F", strtotime($results['enddate']));

if ($check_format_startdate != $check_format_enddate) {
$nice_format_startdate = date("jS F", strtotime($results['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));

}
elseif ($results['startdate'] == $results['enddate']) {

$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));
}
else {
$nice_format_startdate = date("jS", strtotime($results['startdate']));
$nice_format_enddate = date("jS F Y", strtotime($results['enddate']));

}

				
				
			echo "<br><b>";
			echo $results['name'] . ' (' .$nice_format_startdate. ' - ' .$nice_format_enddate. ')';
			echo "</b><br>";
				
				
				if (stripos($results['round1player1'], $query) !==false) {				
					if (strpos($results['round1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round1player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round1player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round1player2'], $query) !==false) {
					if (strpos($results['round1'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round1'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round1"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round1player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round1player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round1deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round2player1'], $query) !==false) {				
					if (strpos($results['round2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round2player2'], $query) !==false) {
					if (strpos($results['round2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				
								if (stripos($results['round3player1'], $query) !==false) {				
					if (strpos($results['round3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round3player2'], $query) !==false) {
					if (strpos($results['round3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round4player1'], $query) !==false) {				
					if (strpos($results['round4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round4player2'], $query) !==false) {
					if (strpos($results['round4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round5player1'], $query) !==false) {				
					if (strpos($results['round5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round5player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round5player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round5player2'], $query) !==false) {
					if (strpos($results['round5'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round5'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round5"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round5player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round5player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round5deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round6player1'], $query) !==false) {				
					if (strpos($results['round6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round6player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round6player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round6player2'], $query) !==false) {
					if (strpos($results['round6'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round6'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round6"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round6player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round6player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round6deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round7player1'], $query) !==false) {				
					if (strpos($results['round7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round7player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round7player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round7player2'], $query) !==false) {
					if (strpos($results['round7'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round7'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round7"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round7player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round7player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round7deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round8player1'], $query) !==false) {				
					if (strpos($results['round8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round8player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round8player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round8player2'], $query) !==false) {
					if (strpos($results['round8'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round8'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round8"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round8player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round8player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round8deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round9player1'], $query) !==false) {				
					if (strpos($results['round9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round9player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round9player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round9player2'], $query) !==false) {
					if (strpos($results['round9'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round9'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round9"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round9player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round9player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round9deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round10player1'], $query) !==false) {				
					if (strpos($results['round10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round10player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round10player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round10player2'], $query) !==false) {
					if (strpos($results['round10'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round10'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round10"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round10player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round10player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round10deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round11player1'], $query) !==false) {				
					if (strpos($results['round11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round11player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round11player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round11player2'], $query) !==false) {
					if (strpos($results['round11'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round11'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round11"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round11player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round11player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round11deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round12player1'], $query) !==false) {				
					if (strpos($results['round12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round12player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round12player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round12player2'], $query) !==false) {
					if (strpos($results['round12'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round12'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round12"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round12player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round12player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round12deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round13player1'], $query) !==false) {				
					if (strpos($results['round13'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round13'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round13"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round13player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round13player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round13player2'], $query) !==false) {
					if (strpos($results['round13'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round13'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round13"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round13player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round13player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round13deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round14player1'], $query) !==false) {				
					if (strpos($results['round14'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round14'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round14"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round14player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round14player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round14player2'], $query) !==false) {
					if (strpos($results['round14'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round14'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round14"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round14player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round14player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round14deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round15player1'], $query) !==false) {				
					if (strpos($results['round15'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round15'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round15"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round15player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round15player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round15player2'], $query) !==false) {
					if (strpos($results['round15'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round15'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round15"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round15player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round15player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round15deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round16player1'], $query) !==false) {				
					if (strpos($results['round16'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round16'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round16"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round16player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round16player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round16player2'], $query) !==false) {
					if (strpos($results['round16'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round16'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round16"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round16player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round16player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round16deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round17player1'], $query) !==false) {				
					if (strpos($results['round17'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round17'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round17"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round17player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round17player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round17player2'], $query) !==false) {
					if (strpos($results['round17'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round17'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round17"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round17player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round17player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round17deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round18player1'], $query) !==false) {				
					if (strpos($results['round18'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round18'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round18"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round18player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round18player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round18player2'], $query) !==false) {
					if (strpos($results['round18'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round18'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round18"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round18player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round18player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round18deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round19player1'], $query) !==false) {				
					if (strpos($results['round19'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round19'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round19"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round19player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round19player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round19player2'], $query) !==false) {
					if (strpos($results['round19'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round19'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round19"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round19player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round19player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round19deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['round20player1'], $query) !==false) {				
					if (strpos($results['round20'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round20'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round20"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round20player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round20player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['round20player2'], $query) !==false) {
					if (strpos($results['round20'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['round20'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["round20"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["round20player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["round20player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["round20deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['quarterplayer1'], $query) !==false) {				
					if (strpos($results['quarter'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarterplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarterplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarterplayer2'], $query) !==false) {
					if (strpos($results['quarter'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarterplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarterplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarterdeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
								if (stripos($results['quarter2player1'], $query) !==false) {				
					if (strpos($results['quarter2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter2player2'], $query) !==false) {
					if (strpos($results['quarter2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['quarter3player1'], $query) !==false) {				
					if (strpos($results['quarter3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter3player2'], $query) !==false) {
					if (strpos($results['quarter3'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter3'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter3"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter3player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter3player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter3deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['quarter4player1'], $query) !==false) {				
					if (strpos($results['quarter4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['quarter4player2'], $query) !==false) {
					if (strpos($results['quarter4'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['quarter4'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["quarter4"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["quarter4player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["quarter4player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["quarter4deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				
				
				
				
								if (stripos($results['semiplayer1'], $query) !==false) {				
					if (strpos($results['semi'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semiplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semiplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['semiplayer2'], $query) !==false) {
					if (strpos($results['semi'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semiplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semiplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semideck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
									if (stripos($results['semi2player1'], $query) !==false) {				
					if (strpos($results['semi2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semi2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semi2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['semi2player2'], $query) !==false) {
					if (strpos($results['semi2'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['semi2'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["semi2"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["semi2player1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["semi2player2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["semi2deck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['finalplayer1'], $query) !==false) {				
					if (strpos($results['final'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['final'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["final"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["finalplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["finalplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				if (stripos($results['finalplayer2'], $query) !==false) {
					if (strpos($results['final'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
					elseif (strpos($results['final'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
				echo '<a href=" ' .htmlentities($results["final"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">Video</a> - ' .htmlentities($results["finalplayer1"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck1"], ENT_QUOTES,"UTF-8"). ') vs ' .htmlentities($results["finalplayer2"], ENT_QUOTES,"UTF-8"). ' (' .htmlentities($results["finaldeck2"], ENT_QUOTES,"UTF-8"). ') <br>' ;}
				

                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum

    }
?>





</div>
<? include 'footer.php' ?>