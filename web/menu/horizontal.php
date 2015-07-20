

  <script type="text/javascript" src="menu/dropdownMenuKeyboard.js"></script>
  <ul id="navigation" class="horizontal">
    <li><?php
if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?SD=1">Home</a>'; }
else { echo '<a href="index.php?SD=0">Home</a>'; }
?>
</li>
    <li><a href='calendar.php'>Calendar</a>
		<ul>
		<li><a href='calendar.php?whichevent=1'>Past events</a></li>
		<li><a href='calendar.php?whichevent=0'>Future events</a></li>
		<li><a href='calendar.php'>All events</a></li>
		</ul>
		</li>
	<li><a href ='decksearch.php'>Advanced search</a></li>
    
    <li><?php
if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?SD=1">Formats</a>'; }
else { echo '<a href="index.php?SD=0">Formats</a>'; }
?>
      <ul>
        
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=standard&SD=1">Standard</a>'; }
else { echo '<a href="index.php?formattype=standard&SD=0">Standard</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=modern&SD=1">Modern</a>'; }
else { echo '<a href="index.php?formattype=modern&SD=0">Modern</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=legacy&SD=1">Legacy</a>'; }
else { echo '<a href="index.php?formattype=legacy&SD=0">Legacy</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=vintage&SD=1">Vintage</a>'; }
else { echo '<a href="index.php?formattype=vintage&SD=0">Vintage</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=limited&SD=1">Limited</a>'; }
else { echo '<a href="index.php?formattype=limited&SD=0">Limited</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=block&SD=1">Block</a>'; }
else { echo '<a href="index.php?formattype=block&SD=0">Block</a>'; } ?></li>
<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=mixed&SD=1">Mixed</a>'; }
else { echo '<a href="index.php?formattype=mixed&SD=0">Mixed</a>'; } ?></li>
      </ul>
    </li>
	
	<li><?php
if ($searchquery != '') {
	if ($SD == '1' OR $SD == '') { echo '<a href ="search.php?searchquery='. $searchquery . '&SD=0">Details are On</a>'; }
	else { echo '<a href ="search.php?searchquery='. $searchquery . '&SD=1">Details are Off</a>'; }
} 	
elseif ($formattype != '') {
	if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype='. $formattype . '&SD=0">Details are On</a>'; }
	else { echo '<a href ="index.php?formattype='. $formattype . '&SD=1">Details are Off</a>'; }
} else {
	if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?SD=0">Details are On</a>'; }
	else { echo '<a href ="index.php?SD=1">Details are Off</a>'; }
	}
?></li>
	
	
	<li><?php
if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?SD=1">Streams</a>'; }
else { echo '<a href="index.php?SD=0">Streams</a>'; }
?>
	<ul>
<li><?php
 
$resultscg = mysql_query("SELECT * FROM streams WHERE streamname = 'scglive'");
$datascg = mysql_fetch_assoc($resultscg);
if ($datascg['online'] == '1') {
     echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive is <img src='$online' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive is <img src='$offline' alt='Offline' /></a>";
}

?></li>

<li><?php
 
$resultmagic = mysql_query("SELECT * FROM streams WHERE streamname = 'magic'");
$datamagic = mysql_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='$online' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='$offline' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysql_query("SELECT * FROM streams WHERE streamname = 'magic2'");
$datamagic = mysql_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='$online' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='$offline' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysql_query("SELECT * FROM streams WHERE streamname = 'channelfireball'");
$datamagic = mysql_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='$online' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='$offline' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysql_query("SELECT * FROM streams WHERE streamname = 'tcgplayer'");
$datamagic = mysql_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='$online' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='$offline' alt='Offline' /></a>";
}
 
?></li>
	  </ul></li>
	
  </ul>
