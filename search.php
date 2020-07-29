<?php

	include("config.php");
	include("classes/SiteResultsProvider.php");

	if(isset($_GET["query"])) {
		$query = $_GET["query"];
	}
	else {
		exit("You must enter a search query");
	}

	$type  = isset($_GET["type"]) ? $_GET["type"] : "sites";
?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Doodle</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

	<div class="wrapper">
	
		<div class="header">


			<div class="headerContent">

				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/logo.PNG">
					</a>
				</div>

				<div class="searchContainer">

					<form action="search.php" method="GET">

						<div class="searchBarContainer">

							<input class="searchBox" type="text" name="query" value="<?php echo $query;?>">
							<button class="searchButton">
								<img src="assets/images/icons/icons_search.png">
							</button>
						</div>

					</form>

				</div>

			</div>


			<div class="tabsContainer">

				<ul class="tabList">

					<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?query=$query&type=sites"; ?>'>
							Sites
						</a>
					</li>

					<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?query=$query&type=images"; ?>'>
							Images
						</a>
					</li>

				</ul>


			</div>

		</div>


		<div class="mainResultsSection">

			<?php
			
				$resultsProvider = new SiteResultsProvider($con);

				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'> $numResults results found</p>";

				echo $resultsProvider->getResultsHtml(1, 20, $query);

			?>
			
			
		</div>


	</div>

	

</body>
</html>