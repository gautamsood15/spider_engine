<?php

	class ImageResultsProvider {

		private $con;

		public function __construct($con) {
			$this-> con = $con;
		}	

		public function getNumResults($term) {

			$query = $this->con->prepare("SELECT COUNT(*) as total FROM images WHERE (title LIKE :term OR alt LIKE :term) AND broken=0");
		

			$searchTerm = "%". $term ."%";
			$query->bindParam(":term", $searchTerm);
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row["total"];


		}


		public function getResultsHtml($page, $pageSize, $term){

			$fromLimit = ($page - 1) * $pageSize;

			$query = $this->con->prepare("SELECT * FROM images WHERE (title LIKE :term OR alt LIKE :term) AND broken=0 ORDER BY clicks DESC LIMIT :fromLimit, :pageSize");
		

			$searchTerm = "%". $term ."%";
			$query->bindParam(":term", $searchTerm);
			$query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
			$query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
			$query->execute();

			$resultsHtml = "<div class='siteResults'>";

			while($row = $query->fetch(PDO::FETCH_ASSOC)) {

				$id = $row["id"];
				$url = $row["url"];
				$title = $row["title"];
				$description = $row["description"];

				$title = $this->trimField($title, 55);
				$description = $this->trimField($description, 80);

				$resultsHtml .= "<div class='resultsContainer'>

									<h3 class='title'>
										<a class='result' href='$url' data-linkId='$id'>
											$title
										</a>
									</h3>
									<span class='url'>$url</span>
									<span class='description'>$description</span>

									</div>";


				

			}


			$resultsHtml .= "</div>";

			return $resultsHtml;

		}
	}


?>