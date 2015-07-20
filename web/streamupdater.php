<?php
    $con = new mysqli('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');

    if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
    }
 
$channelName = 'scglive';
 
$clientId = '';             // Register your application and get a client ID at http://www.twitch.tv/settings?section=applications
$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);
 
if ($json_array['stream'] != NULL) {
    $channelTitle = $json_array['stream']['channel']['display_name'];
    $streamTitle = $json_array['stream']['channel']['status'];
    $currentGame = $json_array['stream']['channel']['game'];
 
    mysqli_query($con,"UPDATE streams SET Online=1 WHERE streamname='scglive'");
} else {
    mysqli_query($con,"UPDATE streams SET Online=0 WHERE streamname='scglive'");
}

$channelName = 'magic';
 
$clientId = '';             // Register your application and get a client ID at http://www.twitch.tv/settings?section=applications
$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);
 
if ($json_array['stream'] != NULL) {
    $channelTitle = $json_array['stream']['channel']['display_name'];
    $streamTitle = $json_array['stream']['channel']['status'];
    $currentGame = $json_array['stream']['channel']['game'];
 
    mysqli_query($con,"UPDATE streams SET Online=1 WHERE streamname='magic'");
} else {
    mysqli_query($con,"UPDATE streams SET Online=0 WHERE streamname='magic'");
}

$channelName = 'magic2';
 
$clientId = '';             // Register your application and get a client ID at http://www.twitch.tv/settings?section=applications
$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);
 
if ($json_array['stream'] != NULL) {
    $channelTitle = $json_array['stream']['channel']['display_name'];
    $streamTitle = $json_array['stream']['channel']['status'];
    $currentGame = $json_array['stream']['channel']['game'];
 
    mysqli_query($con,"UPDATE streams SET Online=1 WHERE streamname='magic2'");
} else {
    mysqli_query($con,"UPDATE streams SET Online=0 WHERE streamname='magic2'");
}

$channelName = 'channelfireball';
 
$clientId = '';             // Register your application and get a client ID at http://www.twitch.tv/settings?section=applications
$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);
 
if ($json_array['stream'] != NULL) {
    $channelTitle = $json_array['stream']['channel']['display_name'];
    $streamTitle = $json_array['stream']['channel']['status'];
    $currentGame = $json_array['stream']['channel']['game'];
 
    mysqli_query($con,"UPDATE streams SET Online=1 WHERE streamname='channelfireball'");
} else {
    mysqli_query($con,"UPDATE streams SET Online=0 WHERE streamname='channelfireball'");
}

$channelName = 'tcgplayer';
 
$clientId = '';             // Register your application and get a client ID at http://www.twitch.tv/settings?section=applications
$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);
 
if ($json_array['stream'] != NULL) {
    $channelTitle = $json_array['stream']['channel']['display_name'];
    $streamTitle = $json_array['stream']['channel']['status'];
    $currentGame = $json_array['stream']['channel']['game'];
 
    mysqli_query($con,"UPDATE streams SET Online=1 WHERE streamname='tcgplayer'");
} else {
    mysqli_query($con,"UPDATE streams SET Online=0 WHERE streamname='tcgplayer'");
}




?>