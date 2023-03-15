<?php
session_start();
session_cache_expire(30);
include_once('database/dbCampaigns.php');
include_once('domain/Campaign.php');
//Make a sort function
?>