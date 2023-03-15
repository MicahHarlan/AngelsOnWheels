<?php
session_start();
session_cache_expire(30);
include_once('database/dbCampaigns.php');
include_once('domain/Campaign.php');
$id = str_replace("_"," ",$_GET["id"]);
?>
<html>
    <head>
        <title>
            Create Campaign
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <?PHP include('header.php');?>
    </head>

</div> 
</html>

<?php 
    //If form hasn't been submitted show the form
    if ($_POST['_form_submit'] != 1) {include('campaignForm.inc');}
    else {
        $new_campaign = New Campaign($_POST["name"],$_POST["description"],100);
        //If user didn't provide a name
        if ($new_campaign->get_campaign_name() == NULL or $new_campaign->get_description() == NULL){
            
            echo("<ul><li><strong><font color=\"red\"> Please fill out all fields. </font></strong></li></ul>\n");
            include('campaignForm.inc');
           
        } else {
            add_campaign($new_campaign);
            echo("<ul><li><strong><font color=\"green\">Your new Campaign has been added succeesfully!</font></strong></li></ul>\n");
            include('campaignForm.inc');
        }
        
        echo($test_campaign->get_campaign_name());
        echo("<br>");
        echo($test_campaign->get_description());
    }


?>