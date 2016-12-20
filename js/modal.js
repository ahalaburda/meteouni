window.onload = function(){ 
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var btn = document.getElementById("overlay1");

	// var img = document.getElementById('myImg');
	// var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	btn.onclick = function(){
		modal.style.display = "block";
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
};
