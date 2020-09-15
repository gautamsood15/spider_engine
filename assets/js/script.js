$(document).ready(function(){

	$(".result").on("click", function(){
		
		var id = $(this).attr("data-linkId");
		var url = $(this).attr("href");
		console.log(id);

		return false;
	});

});


function increaseLinkClicks(linkId, url) {

}