<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/* 
 * Modified by Xun Wang on Feb 25, 2015
 */

/* 
 * Created for Gwyneth's Gift in 2022 using original Homebase code as a guide
 */
session_cache_expire(30);
session_start();
include_once('database/dbCampaigns.php');
include_once('domain/Campaign.php');
?>
<html>
    <head>
        <title>
            View Campaigns
        </title>
        <link rel="stylesheet" href="lib\bootstrap\css\bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
		<link rel="stylesheet" href="lib/jquery-ui.css" />
		
    </head>
    <body style="background-color: rgb(250, 249, 246);">
        <div class="container-fluid" id="container">
            <?PHP include('header.php'); 
            ?>
            <br>
            <h4>List of current and Future Campaigns</h4> 

            <?PHP
            echo("<br>"); 

            $result = get_all_campaigns();
            echo '<div class="overflow-auto" id="target" style="width: variable; height: 400px;">';
            echo '<p><table class="table table-info table-responsive table-striped-columns table-hover 
            table-bordered"> <tr><td><strong> Campaign Name </strong></td> <td> <strong>Description</strong> </td> <td>
            <strong>Start Date (YY-MM-DD)</strong></td>
            <td><strong>End Date </strong></td> 
            </tr>';
            
            foreach ($result as $vol) {
            
            $td = "</td><td>";
            if (fix_camp_date($vol->get_campaign_end()) == True){
                echo("<tr>");
			    echo("<td>" . $vol->get_campaign_name() . $td
            .    $vol->get_description()  . $td . $vol->get_campaign_start()) . $td . $vol->get_campaign_end();
                echo("</tr>");
            }       
                    }
                    echo '</table>';  
                     ?>

            
            <!-- below is the footer that we're using currently-->
                </div>
        </div>
        <?PHP include('footer.inc'); ?>
    </body>
</html>

