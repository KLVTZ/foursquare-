<?php
class Foursquare {
	public $oauth;
	public $base_url="https://api.foursquare.com/v2";
	public $trending;

 	public function __construct($oauth) 
	{
		$this->oauth = $oauth;
	}


	public function fetchRemote($url,$params) 
	{
		// call out build final URL for server contact
		$finalToken = $this->build_URL($url,$params);

		// grab contents from URL and decode into returning assoc array
		$this->trending = file_get_contents($finalToken);
		$trendingData = json_decode($this->trending, true);
		if($trendingData['response']['venues'])
		{
			return  ($trendingData['response']['venues']);
		}
		return false;
	}
	

	public function build_URL($url, $params)
	{
		// extacts parameter array argument for latitude and longitude
		extract($params);
		return $this->base_url . $url . $ll . $this->oauth;
	}

}
?>