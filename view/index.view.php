<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/x-icon" href="/foursquare/view/_IMG/favicon.ico" />
	<title>foursquare App</title>
	<link rel="stylesheet" href="view/_CSS/reset.css">
	<link rel="stylesheet" href="view/_CSS/text.css">
	<link rel="stylesheet" href="view/_CSS/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="view/_CSS/style.css">
</head>
<body>
	
	<div class="grid-container">
		<div class="grid-100">
			<p><img src="/foursquare/view/_IMG/logo.png" alt="foursquare"></p>
		</div>

		<header class="grid-100"><p>Trending</p></header>	

		<?php foreach ($listVenues as $listVenue) : ?>
			<div class="content">
				<div class="grid-30">
					<p><a href="<?= $listVenue['canonical_url'];?>" target="_blank"><?= $listVenue['name'];?></a></p>
					<p>@<?= $listVenue['distance'];?> meters</p>
					<p><?= $listVenue['city'];?></p>
					<p><?= $listVenue['country'];?></p>
				</div>
			</div>
		<?php  endforeach; ?>

		<footer class="grid-100"><p>Jp</p></footer>

	</div>
</body>
</html>
