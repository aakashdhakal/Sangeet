document.addEventListener("click", (e) => {
	// Check if the clicked element or its ancestor has the ID 'nextInContainer'
	if (e.target.closest("#nextInContainer")) {
		// Find the song card container within the parent element
		let cardContainer = e.target
			.closest("#nextInContainer")
			.parentElement.querySelector(".song-card-container");
		// Scroll the container to the right by its own width
		cardContainer.scrollLeft += cardContainer.offsetWidth;
	}

	// Check if the clicked element or its ancestor has the ID 'prevInContainer'
	if (e.target.closest("#prevInContainer")) {
		// Find the song card container within the parent element
		let cardContainer = e.target
			.closest("#prevInContainer")
			.parentElement.querySelector(".song-card-container");
		// Scroll the container to the left by its own width
		cardContainer.scrollLeft -= cardContainer.offsetWidth;
	}
});

document.addEventListener("submit", (e) => {
	// Check if the clicked element or its ancestor has the ID 'searchForm'

});

