
<?php
session_cache_expire(30);
session_start();
include_once('database/dbEvents.php');
include 'calenderTemp.php';
$calendar = new Calender(date("Y-m-d"));
/*
$con = connect();   
                        $query = "SELECT * FROM dbevents";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Access the row's values using associative array syntax
                            //echo $row['event_name'];
                            
                            $futureCheck = fix_date($row['event_date']);
                            if ($futureCheck){
                                echo ('<tr><td class="searchResults">' .$row['event_date']. '</td>' . 
                                '<td class="searchResults">' . $row['event_name'] . '</td></tr>');
                            }*/
$con = connect();
$query = "SELECT * FROM dbevents";
$resultsEvents = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($resultsEvents)) {
    $thisMonthCheck = monthCeck($row['event_date']);
    if($thisMonthCheck){
        $calendar->add_event($row['event_name'], $row['event_date'], 1, 'green');
    }
}

$calendar->add_event('Birthday', '2023-02-03', 1, 'green');
$calendar->add_event('Doctors', '2023-02-04', 1, 'red');
$calendar->add_event('Holiday', '2023-02-16', 7);
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
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>