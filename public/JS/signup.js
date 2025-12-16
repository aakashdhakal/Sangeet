document.addEventListener("DOMContentLoaded", () => {
	const signupFormElement = document.querySelector("#signupForm");
	const loginFormElement = document.querySelector("#loginForm");

	const otpInputs = document.querySelectorAll(".otp-group input");
	const otpPattern = /^[0-9]{1}$/;
	let email;
	var datepicker = new Datepicker("#datepicker");

	document.addEventListener("click", async (e) => {
		if (e.target.closest(".signup-form-show-btn")) {
			signupFormElement.showModal();
		}
		if (e.target.closest("#loginFromSignup")) {
			signupFormElement.close();
			loginFormElement.showModal();
		}
		if (e.target.closest("#sendOtp")) {
			let formsContainer = getParentElement(e.target, 2);
			setBtnStatus(e.target, "loading", "Sending OTP");
			let username = e.target.parentElement.querySelector(
				'input[name="username"]',
			).value;
			email = e.target.parentElement.querySelector('input[name="email"]').value;
			let password = e.target.parentElement.querySelector(
				'input[name="password"]',
			).value;

			if (!username || !email || !password) {
				showError(formsContainer, "Please fill in all fields");
				setBtnStatus(e.target, "normal", "Next");
				return;
			} else if (!(await checkUsername(username))) {
				showError(formsContainer, "Username already exists");
				setBtnStatus(e.target, "normal", "Next");
				return;
			} else if (!validateUsername(username)) {
				showError(
					formsContainer,
					"Username must be between 6 and 12 characters and cannot contain special characters",
				);
				setBtnStatus(e.target, "normal", "Next");
			} else if (!validateEmail(email)) {
				showError(formsContainer, "Invalid email address");
				setBtnStatus(e.target, "normal", "Next");
				return;
			} else if (!validatePassword(password)) {
				showError(
					formsContainer,
					"Password must contain at least 8 characters, one uppercase letter and one number",
				);
				setBtnStatus(e.target, "normal", "Next");
				return;
			} else {
				hideError();
				if (await sendOtp(email)) {
					setBtnStatus(e.target, "normal", "Next");
					resendOtpCounter();
					e.target.parentElement.style.display = "none";
					e.target.parentElement.nextElementSibling.style.display = "flex";
				}
			}
		}
		if (e.target.closest("#verifyOtp")) {
			e.preventDefault();
			let formsContainer = getParentElement(e.target, 2);
			let otp = combineOtp(otpInputs);
			setBtnStatus(e.target, "loading", "Verifying OTP");
			if (otp.length !== 6) {
				showError(formsContainer, "Please fill in all fields");
				setBtnStatus(e.target, "normal", "Verify");
				return;
			} else if (!(await checkOtp(otp, email))) {
				showError(formsContainer, "Invalid OTP");
				setBtnStatus(e.target, "normal", "Verify");
				return;
			} else {
				hideError();
				setBtnStatus(e.target, "normal", "Verify");
				e.target.parentElement.style.display = "none";
				e.target.parentElement.nextElementSibling.style.display = "flex";
			}
		}
		if (e.target.closest(".resend")) {
			setBtnStatus(e.target, "loading", "Resending OTP");
			await sendOtp(registerData.get("email"));
			setBtnStatus(e.target, "normal", "");
			resendOtpCounter();
		}
	});

	document.addEventListener("submit", async (e) => {
		e.preventDefault();
		if (e.target.closest(".signup-form")) {
			let btn = e.target.querySelector("button[type='submit']");
			setBtnStatus(btn, "loading", "Signing up");
			let formsContainer = getParentElement(e.target, 0);

			let firstname = e.target.querySelector('input[name="firstName"]').value;
			let lastname = e.target.querySelector('input[name="lastName"]').value;
			let dob = formatDate(e.target.querySelector('input[name="dob"]').value);
			//convert dob from dd/mm/yyyy to yyyy-mm-dd and add 0 if single month or day
			let gender = e.target.querySelector('input[name="gender"]').value;

			if (!firstname || !lastname || !dob || !gender) {
				showError(formsContainer, "Please fill in all fields");
				setBtnStatus(btn, "normal", "Sign up");
				return;
			} else if (!validateDate(dob)) {
				showError(formsContainer, "Invalid date of birth");
				setBtnStatus(btn, "normal", "Sign up");
				return;
			} else {
				let formData = new FormData(e.target);
				formData.set("dob", dob);
				if (await registerUser(formData)) {
					setBtnStatus(btn, "normal", "Sign up");
					loginUser(signupFormElement);
				}
			}
		}
	});

	otpInputs.forEach((input, index) => {
		input.addEventListener("input", (e) => {
			if (!otpPattern.test(e.target.value)) {
				e.target.value = "";
			} else if (index < otpInputs.length - 1) {
				otpInputs[index + 1].focus();
			}
		});

		input.addEventListener("keydown", (e) => {
			if (e.key === "Backspace" && index > 0 && e.target.value.length === 0) {
				otpInputs[index - 1].focus();
			}
			if (e.key === "ArrowRight" && index < otpInputs.length - 1) {
				otpInputs[index + 1].focus();
			}
			if (e.key === "ArrowLeft" && index > 0) {
				otpInputs[index - 1].focus();
			}
		});
	});

	function combineOtp(otpInputs) {
		return Array.from(otpInputs)
			.map((input) => input.value)
			.join("");
	}

	function resendOtpCounter() {
		let counter = 59;
		const resendBtn = document.querySelector(".resend");

		resendBtn.style.color = "gray";
		resendBtn.disabled = true;

		const interval = setInterval(() => {
			counter--;
			resendBtn.innerText = `${counter}s`;

			if (counter === 0) {
				clearInterval(interval);
				resendBtn.style.color = "#ff6a3a";
				resendBtn.innerText = "Resend";
				resendBtn.disabled = false;
			}
		}, 1000);
	}

	function validateDate(date) {
		//validate date format yyyy-mm-dd and dob is not in future
		const pattern = /^\d{4}-\d{2}-\d{2}$/;
		const dob = new Date(date);
		const today = new Date();

		return pattern.test(date) && dob <= today;
	}

	function validatePassword(password) {
		const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
		return pattern.test(password);
	}

	function validateUsername(username) {
		const pattern = /^[a-zA-Z0-9]{6,12}$/;
		return pattern.test(username);
	}

	function validateEmail(email) {
		const pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		return pattern.test(email);
	}

	function formatDate(dob) {
		dob
			.split("/")
			.reverse()
			.map((part) => part.padStart(2, "0"))
			.join("-");
	}
});
