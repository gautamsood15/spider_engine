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
	$page  = isset($_GET["page"]) ? $_GET["page"] : 1;
?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spider Engine</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

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

							<input type="hidden" name="type" value="<?php echo  $type; ?>">  
							
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
				$pageSize = 20;

				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'> $numResults results found</p>";

				echo $resultsProvider->getResultsHtml($page, $pageSize, $query);

			?>
			
			
		</div>

		<div class="paginationContainer">

			<div class="pageButtons">


				<div class="pageNumberContainer">
					<img src="assets/images/PageStart.PNG">
				</div>


				<?php 

					$pagesToShow = 10;
					$numPages = ceil($numResults / $pageSize);
					$pagesLeft = min($pagesToShow, $numPages);

					$currentPage = $page - floor($pagesToShow / 2);

					if ($currentPage < 1) {
						$currentPage = 1;
					}

					if ($currentPage + $pagesLeft > $numPages + 1) {
						$currentPage = $numPages + 1 - $pagesLeft;
					}

					while($pagesLeft != 0 && $currentPage <= $numPages) {

						if($currentPage == $page) {
							echo "<div class='pageNumberContainer'>
									<img src='assets/images/PageSelected.PNG'>
									<span class='pageNumber'>$currentPage</span>
								</div>";
						}
						else {

							echo "<div class='pageNumberContainer'>
								<a href='search.php?query=$query&type=$type&page=$currentPage'>
									<img src='assets/images/PageD.PNG'>
									<span class='pageNumber'>$currentPage</span>
								</a>
								</div>";
						}


						$currentPage++;
						$pagesLeft--;
					}

					if($numPages == 0) {
							echo "<div class='pageNumberContainer'>
									<img src='assets/images/PageSelected.PNG'>
									<span class='pageNumber'>$currentPage</span>
								</div>";						

					}



				?>


				<div class="pageNumberContainer">
					<img src="assets/images/PageEnd.PNG">
				</div>


			</div>

		</div>

	</div>

	<script type="text/javascript" src="assets/js/script.js"></script>
	

</body>
</html>