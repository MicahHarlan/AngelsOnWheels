<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/**
 * @version March 1, 2012
 * @author Oliver Radwan and Allen Tucker
 */

/* 
 * Created for Gwyneth's Gift in 2022 using original Homebase code as a guide
 */


include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Campaign.php');


/*
 * add an event to dbEvents table: if already there, return false
 */

function add_campaign($campaign) {
    if (!$campaign instanceof Campaign)
        die("Error: add_campaign type mismatch");
    $con=connect();
    $query = "SELECT * FROM dbCampaigns WHERE campaign_id = '" . $campaign->get_campaign_id() . "'";
    $result = mysqli_query($con,$query);
    
    $desc = "description";
    $camp_name = "campaign_name";

    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        #$sql = "SELECT MAX(`campaign_id`) FROM `dbCampaigns`";
        #mysqli_query($con,$sql);
        
        $sql = "INSERT INTO `dbCampaigns` (`description`, `campaign_name`,`campaign_start_date`,`campaign_end_date`) VALUES 
        ( '" . $campaign->get_description() . "','" . $campaign->get_campaign_name() . "','" .
        $campaign->get_campaign_start() . "','" . $campaign->get_campaign_end() . "')";

        mysqli_query($con,$sql);
        mysqli_close($con);
        
        return true;
    }
    mysqli_close($con);
    return false;
}

/*
 * remove an event from dbCampaign table.  If already there, return false
 */

function remove_campaign($id) {
    $con=connect();
    $query = 'SELECT * FROM dbCampaigns WHERE campaign_id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM dbCampaigns WHERE campaign_id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}

/*
 * @return an Event from dbEvents table matching a particular id.
 * if not in table, return false
 */
function retrieve_campaign($id) {
    $con=connect();
    $query = "SELECT * FROM dbCampaigns WHERE campaign_id = '" . $id . "'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) !== 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    // var_dump($result_row);
    $theCampaign = make_a_campaign($result_row);
//    mysqli_close($con);
    return $theCampaign;
}



//COULD BE USED FOR A DATE RANGE
// not in use, may be useful for future iterations in changing how events are edited (i.e. change the remove and create new event process)
function update_campaign_date($id, $new_event_date) {
	$con=connect();
	$query = 'UPDATE dbEvents SET event_date = "' . $new_event_date . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}


function make_a_campaign($result_row) {
	/*
	 ($en, $v, $sd, $description, $ev))
	 */
    $theCampaign = new Campaign(
                    $result_row['campaign_name'],                                      
                    $result_row['description'],
                    $result_row['campaign_id'],
                    $result_row['campaign_start_date'],
                    $result_row['campaign_end_date']);  
    return $theCampaign;
}

// retrieve only those events that match the criteria given in the arguments
function get_all_campaigns() {
   
    $con=connect();
    $query = "SELECT * FROM `dbCampaigns`";
    $result = mysqli_query($con,$query);
    $theCampaigns = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        
        $theCampaign = make_a_campaign($result_row);
        $theCampaigns[] = $theCampaign;
    }
    mysqli_close($con);
    return $theCampaigns;
 }   

 function fix_camp_date($wrong_format_date){
    //This function is used to take in the date of an event or campaign and return whether 
    // or not the event/campaign is in the future or not.
    $explodedString = explode("-",$wrong_format_date);
    $year = "20".$explodedString[0];
    $month = $explodedString[1];
    $day = $explodedString[2];
    $fixedTime = $year . "/" . $month . "/" . $day;
    $fixedTimeAsDateTime = strtotime($fixedTime);
    $newDate = getDate($fixedTimeAsDateTime);
    $finalDATE = $newDate['year'] . "/" . $newDate['mon'] . "/" . $newDate['mday'];
    
    //echo($finalDATE);
    
    $finalfinalDate = new Datetime($finalDATE);
    $currentDate = new DateTime('now');
   

    //echo(gettype($finalfinalDate));
    //echo(gettype($currentDate));
    $finalfinalfinalDate = date_format($finalfinalDate,'Y-m-d H:i:s');
    $fixedCurrentDate = date_format($currentDate,'Y-m-d H:i:s');   
    //echo($finalfinalfinalDate);
    //echo($fixedCurrentDate); 
    if ($fixedCurrentDate<$finalfinalfinalDate){
        //echo("True");
        return True;

    }
    else{
        //echo("False");
        return False;
    }
 }
/*
 $result_row['campaign_name'],                                      
 $result_row['description'],
 $result_row['campaign_id'],
 $result_row['campaign_start_date'],
 $result_row['campaign_end_date']); 

 function retrieve_campaign($id) {
    $con=connect();
    $query = "SELECT * FROM dbEvents WHERE campaign_id = '" . $id . "'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) !== 1) {
        //mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    // var_dump($result_row);
    //$theEvent = make_an_event($result_row);
//    mysqli_close($con);
    return $result_row;
 }
*/
 function monthCheckCampaign($event_start_date, $event_end_date){
    $explodedStart = explode("-",$event_start_date);
    $yearStart = "20".$explodedStart[0];
    $monthStart = $explodedStart[1];
    $currentMonth = date("m");
    $currentYear = date("Y");
    $explodedEnd = explode("-",$event_end_date);
    $yearEnd = "20".$explodedEnd[0];
    $monthEnd = $explodedEnd[1];
    if($currentYear == $yearStart && $currentMonth == $monthStart){
        return True;
    }
    elseif($currentYear == $yearEnd && $currentMonth == $monthEnd){
        return True;
    }
    else{
        return False;
    }
}

function dayCheckCampaign($start, $end){
    $diff = strtotime($start) - strtotime($end);
    return abs(round($diff / 86400));
}

// retrieve only those events that match the criteria given in the arguments
/* function getonlythose_dbCampaigns($name, $day, $venue) {
   $con=connect();
   $query = "SELECT * FROM dbEvents WHERE event_name LIKE '%" . $campaign_name . "%'" .
           " AND event_name LIKE '%" . $name . "%'" .
           " AND venue = '" . $venue . "'" . 
           " ORDER BY event_name";
   $result = mysqli_query($con,$query);
   $theEvents = array();
   while ($result_row = mysqli_fetch_assoc($result)) {
       $theEvent = make_an_event($result_row);
       $theEvents[] = $theEvent;
   }
   mysqli_close($con);
   return $theEvents;
} */

?>