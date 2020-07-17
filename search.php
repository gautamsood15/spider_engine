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
				$pageSize = 20;

				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'> $numResults results found</p>";

				echo $resultsProvider->getResultsHtml($page, $pageSize, $query);

			?>
			
			
		</div>

		<div class="paginationContainer">

			<div class="pageButtons">


				<div class="pageNumberContainer">
					<img src="assets/images/pageStart.PNG">
				</div>


				<?php 

					$pagesToShow = 10;
					$numPages = ceil($numResults / $pageSize);
					$pagesLeft = min($pagesToShow, $numPages);

					$currentPage = $page - floor($pagesToShow / 2);

					if ($currentPage < 1) {
						$currentPage = 1;
					}

					while($pagesLeft != 0) {

						if($currentPage == $page) {
							echo "<div class='pageNumberContainer'>
									<img src='assets/images/pageSelected.PNG'>
									<span class='pageNumber'>$currentPage</span>
								</div>";
						}
						else {

							echo "<div class='pageNumberContainer'>
								<a href='search.php?query=$query&type=$type&page=$currentPage'>
									<img src='assets/images/page.PNG'>
									<span class='pageNumber'>$currentPage</span>
								</a>
								</div>";
						}


						$currentPage++;
						$pagesLeft--;
					}



				?>


				<div class="pageNumberContainer">
					<img src="assets/images/pageEnd.PNG">
				</div>


			</div>

		</div>

	</div>

	

</body>
</html>