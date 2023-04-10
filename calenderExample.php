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
	<style>
		/* Dropdown Button */
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
	</style>
    <?PHP include('header.php'); ?>
		<meta charset="utf-8">
		<title>Event Calender</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calender.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <div class="title">
	    	Event Calender
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
		<div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
</div>
		<br/><br/><br/>
		<?PHP include('footer.inc'); ?>
	</body>
</html>