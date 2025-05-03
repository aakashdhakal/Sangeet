// Event listener for click events
document.addEventListener("click", (e) => {
	// Show the login form modal when the login button is clicked
	if (e.target.closest(".login-form-show-btn")) {
		document.querySelector("#loginForm").showModal();
	}

	// Switch to the signup form modal when the signup link is clicked
	if (e.target.closest("#signupFromLogin")) {
		document.querySelector("#loginForm").close();
		document.querySelector("#signupForm").showModal();
	}
});

// Event listener for form submissions
document.addEventListener("submit", async (e) => {
	// Handle login form submission
	if (e.target.matches(".login-form")) {
		e.preventDefault();
		let btn = e.target.querySelector("button[type='submit']");
		setBtnStatus(btn, "loading", "Logging in");
		let username = e.target.querySelector("#username").value;
		let password = e.target.querySelector("#password").value;

		// Validate form fields
		if (username === "" || password === "") {
			showError(e.target, "Please fill in all the fields");
			setBtnStatus(btn, "normal", "Login");

		} else {
			if (await loginUser(e.target))
				setBtnStatus(btn, "normal", "Login");
		}
	}
});
