let email = "";
document.addEventListener("submit", async (e) => {
	// Handle email form submission for password reset
	if (e.target.matches(".get-email")) {
		e.preventDefault();
		email = e.target.querySelector("#resetPasswordEmail").value;

		// Validate email field
		if (email === "") {
			showError(e.target, "Please fill in all the fields");
		} else if (await checkEmail(email)) {
			showError(e.target, "The email is not registered");
		} else {
			sendOtp(email, "resetPassword");
			e.target.style.display = "none";
			e.target.nextElementSibling.style.display = "flex";
			hideError();
		}
	}
	if (e.target.matches(".otp-verify")) {
		e.preventDefault();
		let otp = combineOtp(e.target.querySelectorAll(".otp-group input"));
		if (otp === "") {
			showError(e.target, "Please fill in all the fields");
		} else if (!(await checkOtp(otp, email))) {
			showError(e.target, "Invalid OTP");
		} else {
			e.target.style.display = "none";
			e.target.nextElementSibling.style.display = "flex";
			hideError();
		}
	}
	if (e.target.matches(".reset-password")) {
		e.preventDefault();
		let password = e.target.querySelector("#resetPassword").value;
		let confirmPassword = e.target.querySelector("#resetConfirmPassword").value;

		if (password == "" || confirmPassword == "") {
			showError(e.target, "Please fill in all the fields");
		} else if (password !== confirmPassword) {
			showError(e.target, "Passwords do not match");
		} else if (!validatePassword(password)) {
			showError(
				e.target,
				"Password must contain at least 8 characters, one uppercase letter and one number",
			);
		} else {
			if (await resetPassword(email, password)) {
				document.querySelector("#resetPassword").close();
			} else {
				showError(e.target, "An error occurred. Please try again later");
			}
		}
	}
});

document.addEventListener("click", (e) => {
	if (e.target.closest(".forgot-password-show")) {
		closeDialog(document.querySelector("#loginForm"));
		document.querySelector("#resetPassword").showModal();
	}
});
