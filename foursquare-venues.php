<?php
require_once("foursquare.php");

class FoursquareVenues extends Foursquare {

	public function getTrending($lat,$lon) {
		//get a list of trending venues for a location
		//must return in an assoc array
		return $this->fetchRemote("/venues/trending?",array("ll"=>"ll=".$lat.",".$lon));
	}
}
?>