<?php
// source code for calender.css, calenderExample.php, calenderTemp.php https://codeshack.io/event-calendar-php/
session_cache_expire(30);
session_start();

include_once('database/dbEvents.php');
include_once('database/dbCampaigns.php');
include 'calenderTemp.php';
$con = connect();

$calendar = new Calender(date("Y-m-d"));

//add the events to the calender for the given month
$query = "SELECT * FROM dbevents";
$resultsEvents = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($resultsEvents)) {
    $thisMonthCheck = monthCheckEvent($row['event_date']);
    if($thisMonthCheck){
        $calendar->add_event($row['event_name'], $row['event_date'], 1, 'green', $row['event_id']);
    }
}

//add the campaigns to the calender for the given month
$query = "SELECT * FROM dbcampaigns";
$resultsEvents = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($resultsEvents)) {
    $thisMonthCheck = monthCheckCampaign($row['campaign_start_date'], $row['campaign_end_date']);
    if($thisMonthCheck){
        $days_between = dayCheckCampaign($row['campaign_start_date'], $row['campaign_end_date']);
        $calendar->add_event($row['campaign_name'], $row['campaign_start_date'], $days_between, 'blue', $row['campaign_id']);
    }
}


?>
<!DOCTYPE html>
<html>
	<head>
    <?PHP include('header.php'); ?>
		<meta charset="utf-8">
		<title>Event Calender</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calender.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Event Calender</h1>
	    	</div>
	    </nav>
		
			<?=$calendar?>
		</div>
	</body>
</html>