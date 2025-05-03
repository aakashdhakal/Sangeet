document.addEventListener("click", (e) => {
	// Check if the clicked element or its ancestor has the ID 'closeLoginForm'
	if (e.target.closest(".signup-form-show-btn")) {
		// Close the login form dialog
		document.querySelector("#signupForm").showModal();
	}
	if (e.target.closest("#closeLoginForm")) {
		// Close the login form dialog
		document.querySelector("#loginForm").close();
	}
});

let username;
document.addEventListener("submit", async (e) => {
	if (e.target.closest(".signup-form")) {
		e.preventDefault();
		// Get the form data
		let formData = new FormData(e.target);
		let email = formData.get("email");
		username = formData.get("username");
		sendOtp(email, username);
	}
	if (e.target.closest(".otp-verify")) {
		e.preventDefault();
		let otp = combineOtp();
		if (await checkOtp(otp, username)) {
			alert("OTP verified successfully");
		} else {
			alert("Invalid OTP");
		}
	}
});

document.querySelector("#signupForm").showModal();

const otpInputs = document.querySelectorAll(".otp-group input");
let pattern = /^[0-9]{1}$/;
otpInputs.forEach((input, index) => {
	input.addEventListener("input", (e) => {
		if (!pattern.test(e.target.value)) {
			e.target.value = ""; // Clear the input if it doesn't match the pattern
		} else if (index < otpInputs.length - 1) {
			otpInputs[index + 1].focus(); // Move to the next input if valid
		}
		console.log(combineOtp());
	});

	input.addEventListener("keydown", (e) => {
		if (e.key === "Backspace" && index > 0 && e.target.value.length === 0) {
			otpInputs[index - 1].focus();
		}
	});
});

function combineOtp() {
	let otp = "";
	otpInputs.forEach((input) => {
		otp += input.value;
	});
	return otp;
}
