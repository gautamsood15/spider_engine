<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spider Engine</title>

	<meta charset="UTF-8">
  	<meta name="description" content="Search the web for sites and images.">
  	<meta name="keywords" content="Search engine, spider, web search">
  	<meta name="author" content="Gautam Sood">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

	<div class="wrapper indexPage">

		<div class="mainSection">

			<div class="logoContainer">
				
				<img src="assets/images/logo.PNG" title="Logo Image" alt="Logo Image">  
				
			</div>

			<div class="searchContainer">

				<form action="search.php" method="GET">
	
					<input type="text" name="query" class="searchBox">
					<input type="submit" value="Search" class="searchButton">
	
				</form>

			</div>
		</div>
	</div>

</body>
</html>