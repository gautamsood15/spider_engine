<?php 
	
	include("classes/DomDocumentParser.php");
	
	function followLinks($url) {
		
		$parser = new DomDocumentParser($url);	

		$linkList = $parser->getLinks();

		foreach ($linkList as $link) {
			$href = $link->getAttribute("href");
			echo $href . "<br>";

		}

	}

	$startUrl = "https://en.wikipedia.org/wiki/Frontline_(American_TV_program)";
	
	followLinks($startUrl);

?>
