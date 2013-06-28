<?php 
require 'foursquare-venues.php';

class App {
	public $trending;
	public $connection;

	public function connectToFoursquare()
	// creates token pass and established connection with a returned associative array
	{
		$token = array(
		'token'  => '&oauth_token=3J14VLJCRWE0KBTPDUJKSA24JHAKXSLBUBUAR1K151ABNZJG&v=20130613',
		'lat'    => '40.7',
		'lon'    => '-74',
		);

		$venues = new FoursquareVenues($token['token']);
		$this->trending = $venues->getTrending($token['lat'], $token['lon']);
		return ($this->trending) ? $this->trending : false;
	}
	

	public function connectToDatabase()
	// connects to MonsterHost database via PDO
	{
		$config = array(
			'username' => 'root',
			'password' => 'battosai',
			'database' => 'foursquare'
		);

		try {
			$this->connection = new PDO('mysql:host=localhost;dbname=' .
								  $config['database'],
								  $config['username'],
								  $config['password']);

			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			return ($this->connection) ? true : false;

		} catch(Exception $e) {
			return 'Error' . $e->getMessage();
		}

	}


	public function truncateTable($tableName)
	// delete all information from table before insertion
	{
		try {
			$query = $this->connection->query("TRUNCATE TABLE $tableName");
			return true;
		} catch(Exception $e) {
			return 'Error' . $e->getMessage();
		}
	}


	public function queryTable($limit)
	// prepare Insert statement for query insertion
	{
		try {

			$statement = $this->connection->prepare('INSERT INTO venues(name,distance,city,country,venue_id,canonical_url) 
										       VALUES(:name,:distance,:city,:country,:venue_id,:canonical_url)');

			$statement->bindParam(':name', $name);
			$statement->bindParam(':distance', $distance);
			$statement->bindParam(':city', $city);
			$statement->bindParam(':country', $country);
			$statement->bindParam(':venue_id', $venue_id);
			$statement->bindParam(':canonical_url', $canonical_url);

			// bind and execute data -limit of five items default
			$count = 0;
			foreach($this->trending as $venues)
			{
				$name = $venues['name'];
				$distance = $venues['location']['distance'];
				$city = $venues['location']['city'];
				$country = $venues['location']['country'];
				$venue_id = $venues['id'];
				$canonical_url = $venues['canonicalUrl'];
				if($count == $limit) return true;
				$count++;
				$statement->execute();
			}
		} catch(Exception $e) {
			return 'Error' . $e->getMessage();
		}
	}


	public function get($tableName, $order)
	// get query selection of items from within the database
	{
		try {
			$statement = $this->connection->query("SELECT * FROM $tableName ORDER BY $order");
			if ($statement->rowCount() > 0) {
				return $statement;
			} else {
				echo 'Table Empty!';
			}
		} catch(Exception $e) {
			return 'Error' . $e->getMessage();
		}
	}
}
?>