<?php
//enter your last.fm username
$username = 'mariusvoila';
//in seconds, how long to wait until your recently listened tracks are checked for new entries
$time = 300;
//this is the URL of the last.fm xml file of your profile
$lastfmFile = "http://ws.audioscrobbler.com/1.0/user/$username/recenttracks.xml";
//the number of tracks you want to display, this can't be above 9
$numOfTracks = 5;

function getTracks($username, $time, $lastfmFile, $numOfTracks) {
//this will be the local xml file written to your server
$myLocalFile = $username.'.xml';
//if the local xml file doesn't exist or if local xml file is older than the time set
if ((!file_exists($myLocalFile)) || (time()-filemtime($myLocalFile)>$time)) {
        //get the last.fm xml file and place it into the contents variable as a string
        $contents = @file_get_contents($lastfmFile);
        //open the local file or create it if it doesn't exist
        $temp = fopen($myLocalFile, "w");
        //write the contents of the lastfmFile to the local file
        fwrite($temp, $contents);
        //close the file
        fclose($temp);
}
//grab the local xml file and place it into the xml variable
$xml = @simplexml_load_file($myLocalFile);
//create an unordered list of the track name and artist from the local XML file
print "
<ul>";
        for ($t = 0; $t <= $numOfTracks; $t++) {
                print "\n
<li><a href=\"".$xml->track[$t]->url."\" target=\"_blank\">".$xml->track[$t]->name." - ".$xml->track[$t]->artist."</a></li>

";
        }
        print "</ul>

";
}

getTracks($username, $time, $lastfmFile, $numOfTracks);
?>
