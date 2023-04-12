<?php
// source code for calender.css, calenderExample.php, calenderTemp.php https://codeshack.io/event-calendar-php/
session_cache_expire(30);
session_start();

include_once('database/dbEvents.php');
include_once('database/dbCampaigns.php');
include 'calenderTemp.php';
$con = connect();

if(isset($_POST['nextMonth'])){
	//echo('||||'.$_POST['nextMonth'].'');
	$d = $_POST['nextMonth'];
	//echo('--'.$d);
	$newDate = date('Y-m-d', strtotime($d. ' + 1 months'));
	$calendar = new Calender($newDate);
}
elseif(isset($_POST['prevMonth'])){
	$date = $_POST['prevMonth'];
	$newDate = date('Y-m-d', strtotime($date. ' - 1 months'));
	$calendar = new Calender($newDate);
}
else{
	$calendar = new Calender(date("Y-m-d"));
}


//add the events to the calender for the given month
$query = "SELECT * FROM dbevents";
$resultsEvents = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($resultsEvents)) {
    $thisMonthCheck =  $calendar->monthCheck($row['event_date']);
    if($thisMonthCheck){
        $calendar->add_event($row['event_name'], $row['event_date'], 1, 'green', $row['event_id']);
    }
}

//add the campaigns to the calender for the given month
$query = "SELECT * FROM dbcampaigns";
$resultsEvents = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($resultsEvents)) {
    $thisMonthCheckOne = $calendar->monthCheck($row['campaign_start_date']);
	$thisMonthCheckTwo = $calendar->monthCheck($row['campaign_end_date']);
    if($thisMonthCheckOne or $thisMonthCheckTwo){
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
		<title>Calender</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calender.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <div class="title">
	    	Calender
		</div>
		<div class="calendar">
        <div class="header">
        <div class="month-year">
		
		<FORM method='POST'>

		<?PHP 
		$date = $calendar->get_calender_date();
		$d = $date[0][0] ."-". $date[0][1] . "-" . $date[0][2];
		//echo('======'.$d);
		?>

		<button class="button" type="submit" name="prevMonth" 
				value=<?PHP echo($d); ?>>&#129052;</button>
        
		<?PHP
		echo(date('F Y', strtotime($date[0][0] . '-' . $date[0][1] . '-' . $date[0][2]))); 
		?>

		<button class="button" type="submit" name="nextMonth" 
				value=<?PHP echo($d); ?>>&#129054;</button>
</FORM>

			</div>
    	</div>
			<?=$calendar?>
		</div>
		
		<br/><br/><br/>
		<?PHP include('footer.inc'); ?>
	</body>
</html>