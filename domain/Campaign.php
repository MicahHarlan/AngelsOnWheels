<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHC-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>, Sam Roberts, Allen Tucker
 * @version 3/28/2008, revised 7/1/2015
 */

/* 
 * Created for Gwyneth's Gift in 2022 using original Homebase code as a guide
 */

 class Campaign {
	private $campaign_name;  // campaign name as a string
	private $description;   // description of the campaign
	private $campaign_id;		// the unique id that is attached to each campaign, is then copied into id, used for editing campaign
	

	function __construct($en ,$description, $ev) {
		$this->campaign_name = $en;
		$this->description = $description;
		$this->campaign_id = $ev;
		
	}

	function get_campaign_name() {
		return $this->campaign_name;
	}

	function get_description() {
		return $this->description;
	}

	function get_campaign_id() {
		return $this->campaign_id;
	}

}
?>