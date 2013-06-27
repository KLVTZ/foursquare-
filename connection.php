<?php 
# establish connection, query foursquare data, query into SQL database, display results
$connectToFourSq = new App();
$status = $connectToFourSq->connectToFoursquare();
$limit = 6;

if($status)
{
	$connectToFourSq->connectToDatabase();
	$connectToFourSq->truncateTable('venues');
	$connectToFourSq->queryTable($limit);
	$listVenues = $connectToFourSq->get('venues','distance');
	include('view/index.view.php');
} else {
	// if there is no trending data, send user to notification
	header('Location: view/index.view.nodata.php');
}
?>