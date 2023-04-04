<?php
/*
 * Copyright 2015 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
session_cache_expire(30);
session_start();

include_once('database/dbEvents.php');
include_once('domain/Event.php');
include_once('database/dbLog.php'); // can be used in later iterations
$id = str_replace("_"," ",$_GET["id"]);

if ($id == 'new') {
    $event = new Event('event', $_SESSION['venue'],  
                    null, null, null, "");
} else {
    $event = retrieve_event($id);
    if (!$event) { // try again by changing blanks to _ in id
        $id = str_replace(" ","_",$_GET["id"]);
        $event = retrieve_event($id);
        if (!$event) {
            echo('<p id="error">Error: there\'s no event with this id in the database</p>' . $id);
            die();
        }
    }
}
$evid = $event->get_event_id()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?PHP echo($event->get_event_name()); ?></title>
    <link rel="stylesheet" href="lib\bootstrap\css\bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="styling\eventView.css" type="text/css" />
</head>
<?php include('header.php'); ?>
<body style="background-color: rgb(250, 249, 246);">
<div class="container" style="padding-bottom: 100px;">
    <h2> <?PHP echo($event->get_event_name()); ?> </h2>

    <div class= "content">
        
    <p><strong>Date: </strong><?PHP echo($event->get_event_date()); ?> </p>
    <p><strong>Venue: </strong> <?PHP echo($event->get_venue()); ?> </p>
    <p><strong>Description: </strong><?PHP echo($event->get_description()); ?> </p>

    </div>
<br>

<!--sign up button not working yet-->
    <button class= "signUpButton">Sign Up for Event</button>

        <!--send event id to the schedule issue page-->
        <?php 
        echo    "<a href=scheduleIssue.php?id=" . 
        str_replace(" ","_",$evid) . ">";
        ?> 
            <button class= "reportButton">Report Schedule Issue</button> 
        </a>
</div>

</body>
<br><br>
<?php include('footer.inc'); ?>
</html>
