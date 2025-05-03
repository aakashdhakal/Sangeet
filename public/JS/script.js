let baseUrl = "/WEB-PROJECT";
let title = document.title;

//preloader

let preloader = document.querySelector(".preloader");
window.addEventListener("load", () => {
	preloader.style.display = "none";
});

// Close dialog function
function closeDialog(dialog) {
	let form = dialog.querySelector("form");
	if (form) form.reset();
	dialog.animate([{ scale: 1 }, { scale: 0.5 }], 150, "ease-in-out").onfinish =
		() => dialog.close();
}

// Event listeners for close buttons
document.querySelectorAll(".close-dialog-btn").forEach((btn) => {
	btn.title = "Close";
	btn.addEventListener("click", (e) => {
		e.stopPropagation();
		closeDialog(btn.parentElement.parentElement);
	});
});

// Close dialog on Escape key press
document.addEventListener("keydown", (e) => {
	if (e.key === "Escape") {
		e.preventDefault();
		document.querySelectorAll("dialog[open]").forEach(closeDialog);
	}
});

// Event listener for file upload preview
document.addEventListener("change", (e) => {
	if (e.target.matches(".file-upload")) {
		let previewImage = e.target.nextElementSibling.nextElementSibling;
		previewImage.src = URL.createObjectURL(e.target.files[0]);
	}
});

// Append script dynamically
function appendScript(src) {
	let dynamicScript = document.querySelector(".dynamic-script");
	if (dynamicScript) document.body.removeChild(dynamicScript);
	let script = document.createElement("script");
	script.src = src;
	script.classList.add("dynamic-script");
	document.body.appendChild(script);
}

// Append style dynamically
function appendStyle(href) {
	let dynamicStyle = document.querySelector(".dynamic-css");
	if (dynamicStyle) dynamicStyle.href = href;
}

// Change active button
function changeActiveBtn(btn) {
	document.querySelector("#sideNav ul .active").classList.remove("active");
	btn.parentElement.classList.add("active");
}

// Event listeners for navigation buttons
document.querySelectorAll(".nav-btn").forEach((btn) => {
	btn.addEventListener("click", async () => {
		changeActiveBtn(btn);
		await loadPage(
			btn.getAttribute("data-path"),
			document.querySelector("main"),
		);
		appendScript(btn.getAttribute("data-script"));
	});
});

// Change theme function
function changeTheme() {
	console.log("changing theme");
	document.body.classList.toggle("dark");
	localStorage.setItem("darkMode", document.body.classList.contains("dark"));
	document.querySelector(".dark-mode-btn").innerHTML =
		document.body.classList.contains("dark")
			? `<iconify-icon icon="clarity:sun-line"></iconify-icon>`
			: `<iconify-icon icon="flowbite:moon-outline"></iconify-icon>`;
}

// Sidebar collapse/expand
let sidebar = document.querySelector("#sideNav");
if (localStorage.getItem("sidebar") === "collapse")
	sidebar.classList.add("collapse");
document
	.querySelector("#collapseExpandSidebar")
	.addEventListener("click", () => {
		sidebar.classList.toggle("collapse");
		localStorage.setItem(
			"sidebar",
			sidebar.classList.contains("collapse") ? "collapse" : "expand",
		);
	});

// Dark mode toggle
if (localStorage.getItem("darkMode") === "true")
	document.body.classList.add("dark");

function toggleProfileWindow() {
	document
		.querySelector("#profileWindow")
		.classList.toggle("openProfileWindow");
}

// Notification handling
let notificationCount = 5;
setInterval(async () => {
	if (await checkLoginStatus()) showNotifications(notificationCount);
}, 10000);

function toggleNotificationWindow() {
	document
		.querySelector("#notificationWindow")
		.classList.toggle("openNotificationWindow");
}

// Show notifications
async function showNotifications(number) {
	let notifications = await fetchNotifications();
	let notificationBody = document.querySelector(".notification-body");
	notificationBody.innerHTML = "";
	if (notifications.status === 404) {
		notificationBody.innerHTML = `<div class="no-notifications"><iconify-icon icon="mynaui:bell-x"></iconify-icon><p>No new notifications</p></div>`;
		document.querySelector("#seeAllNotifications").style.display = "none";
		return;
	}
	notifications.slice(0, number).forEach((notification) => {
		let iconifyIcon =
			notification.subject === "like"
				? "fluent:thumb-like-16-filled"
				: "si:user-fill";
		let time = formatTime(notification.time);
		notificationBody.innerHTML += `<div class="notification-card" data-readStatus="${notification.read_status}" data-notificationId="${notification.id}"><div class="notification-info"><iconify-icon icon="${iconifyIcon}"></iconify-icon><div class="notification-details"><p class="notification-message">${notification.message}</p><p class="notification-time">${time}</p></div></div><button id="clearNotification"><iconify-icon icon="ic:outline-delete"></iconify-icon></button></div>`;
	});

	let unreadNotificationCount = document.querySelectorAll(
		".notification-card[data-readStatus='0']",
	).length;

	if (unreadNotificationCount > 0) {
		document
			.querySelector(".notification-btn")
			.style.setProperty("--unreadNotificationMark", "flex");
		document.title = "(" + unreadNotificationCount + ") " + title;
	} else {
		document
			.querySelector(".notification-btn")
			.style.setProperty("--unreadNotificationMark", "none");
		document.title = title;
	}
}

async function markAsRead(notificationId) {
	if (await setNotificationReadStatus(notificationId))
		showNotifications(notificationCount);
}

async function markAllAsRead() {
	let notifications = await fetchNotifications(-1);
	notifications.forEach(async (notification) => {
		if (notification.read_status === 0)
			await setNotificationReadStatus(notification.id);
	});
	showNotifications(notificationCount);
}

// Format time function
function formatTime(time) {
	const now = new Date();
	const date = new Date(time);
	const diff = Math.abs(now - date);
	const diffDays = Math.floor(diff / (1000 * 60 * 60 * 24));
	const diffWeeks = Math.floor(diffDays / 7);
	const diffYears = now.getFullYear() - date.getFullYear();
	const diffMonths = diffYears * 12 + now.getMonth() - date.getMonth();

	if (diffYears >= 1)
		return date.toLocaleDateString("en-US", {
			year: "numeric",
			month: "short",
			day: "numeric",
		});
	if (diffMonths >= 1)
		return `${diffMonths} month${diffMonths > 1 ? "s" : ""} ago`;
	if (diffWeeks >= 1) return `${diffWeeks} week${diffWeeks > 1 ? "s" : ""} ago`;
	if (diffDays >= 1) return `${diffDays} day${diffDays > 1 ? "s" : ""} ago`;

	const diffHours = Math.floor(diff / (1000 * 60 * 60));
	const diffMinutes = Math.floor(diff / (1000 * 60));
	if (diffHours >= 1) return `${diffHours} hour${diffHours > 1 ? "s" : ""} ago`;
	return `${diffMinutes} minute${diffMinutes > 1 ? "s" : ""} ago`;
}

document.addEventListener("click", (e) => {
	if (!e.target.closest("#notificationWindow, .notification-btn")) {
		document
			.querySelector("#notificationWindow")
			.classList.remove("openNotificationWindow");
	}
	if (
		e.target.matches(".notification-card *") &&
		!e.target.matches("#clearNotification *")
	) {
		let notificationCard = e.target.closest(".notification-card");
		if (notificationCard.getAttribute("data-readStatus") === "0") {
			markAsRead(notificationCard.getAttribute("data-notificationId"));
			notificationCard.setAttribute("data-readStatus", 1);
		}
	}
	if (e.target.matches("#clearNotification *")) {
		deleteNotification(
			e.target
				.closest(".notification-card")
				.getAttribute("data-notificationId"),
		);
		showNotifications(notificationCount);
	}
	if (!e.target.closest("#profileWindow, .profile-btn")) {
		document
			.querySelector("#profileWindow")
			.classList.remove("openProfileWindow");
	}
	if (e.target.closest(".notification-btn")) toggleNotificationWindow();
	if (e.target.matches("dialog")) closeDialog(e.target);
	if (e.target.closest("#seeAllNotifications")) showNotifications(-1);
	if (e.target.closest(".mark-all-as-read")) markAllAsRead();
	if (e.target.closest(".dark-mode-btn")) changeTheme();
	if (e.target.closest(".profile-btn")) toggleProfileWindow();
	if (e.target.closest(".toggle-password-visibility")) {
		let passwordField = e.target.previousElementSibling.previousElementSibling;
		console.log(passwordField);
		passwordField.type =
			passwordField.type === "password" ? "text" : "password";
		e.target.innerHTML =
			passwordField.type === "password"
				? `<iconify-icon icon="fluent:eye-24-regular"></iconify-icon>`
				: `<iconify-icon icon="fluent:eye-off-20-regular"></iconify-icon>`;
	}
});

document.addEventListener("DOMContentLoaded", async () => {
	if (await checkLoginStatus()) showNotifications(notificationCount);
});

//all api calls

//function to change pages
async function loadPage(path, containerElement) {
	try {
		const response = await fetch(path);
		if (!response.ok) {
			throw new Error("Network response was not ok");
		}
		const html = await response.text();
		containerElement.innerHTML = html;
		return true;
	} catch (error) {
		console.error("There was a problem with the fetch operation:", error);
		return false;
	}
}
//function to fetch music
async function fetchMusic(musicId) {
	try {
		const response = await fetch(baseUrl + "/modules/fetchMusic.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(musicId)}`,
		});
		const data = await response.json();
		return data;
	} catch (error) {
		console.error("Error fetching music:", error);
		return {};
	}
}

//Function to like or dislike a music
async function setLikeStatus(musicId, status) {
	try {
		const response = await fetch(baseUrl + "/modules/addToFavourite.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(musicId)}&action=${status}`,
		});
		const data = await response.json();
		if (data.status === "success") {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error setting like status:", error);
		return false;
	}
}

//Function to add music to playlist
async function addToPlaylist(playlistId, musicId) {
	try {
		const response = await fetch(baseUrl + "/modules/addToPlaylist.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `playlistId=${encodeURIComponent(
				playlistId,
			)}&musicId=${encodeURIComponent(musicId)}`,
		});
		const data = await response.json();
		if (data.status === "success") {
			return true;
		} else if (data.code === 403) {
			showAlert("Music is already in the playlist", "info");
			return false;
		} else {
			showAlert("Something went wrong! " + data.message, "error");
			return false;
		}
	} catch (error) {
		console.error("Error adding to playlist:", error);
		return false;
	}
}

//Function to create a playlist
async function createPlaylist(formData) {
	try {
		const response = await fetch(baseUrl + "/modules/createPlaylist.php", {
			method: "POST",
			body: formData,
		});
		const data = await response.json();
		if (data.status === "success") {
			return true;
		} else {
			showAlert("Something went wrong! " + data.message, "error");
			return false;
		}
	} catch (error) {
		console.error("Error creating playlist:", error);
		return false;
	}
}

//Function to fetch a playlist html
async function fetchPlaylists() {
	try {
		const response = await fetch(baseUrl + "/modules/getPlaylist.php", {
			method: "POST",
		});
		const data = await response.text();
		return data;
	} catch (error) {
		console.error("Error fetching playlists:", error);
		return "";
	}
}

//Function to add to history
async function addToHistory(musicId) {
	try {
		const response = await fetch(baseUrl + "/modules/addToHistory.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(musicId)}`,
		});
		const data = await response.json();
		if (data.status === "success") {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error adding to history:", error);
		return false;
	}
}

async function checkLoginStatus() {
	try {
		const response = await fetch(baseUrl + "/modules/checkLoginStatus.php");
		const data = await response.json();
		if (data) {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error checking login status:", error);
		return {};
	}
}

async function fetchNotifications(numbers = 5) {
	try {
		const response = await fetch(baseUrl + "/modules/fetchNotifications.php", {
			method: "POST",
			body: `numbers=${encodeURIComponent(numbers)}`,
		});
		const data = await response.json();
		return data;
	} catch (error) {
		console.error("Error fetching notifications:", error);
		return [];
	}
}

async function deleteNotification(notificationId) {
	try {
		const response = await fetch(baseUrl + "/modules/deleteNotification.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `notificationId=${encodeURIComponent(notificationId)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			console.log("notification deleted");
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error deleting notification:", error);
		return false;
	}
}

async function setNotificationReadStatus(notificationId) {
	try {
		const response = await fetch(
			baseUrl + "/modules/setNotificationReadStatus.php",
			{
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body: `notificationId=${encodeURIComponent(notificationId)}`,
			},
		);
		const data = await response.json();
		if (data.status === 200) {
			console.log("notification read status updated");
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error updating notification read status:", error);
		return false;
	}
}

async function sendOtp(email, username) {
	try {
		const response = await fetch(baseUrl + "/modules/otpConfig.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `email=${encodeURIComponent(
				email,
			)}&action=sendOtp&username=${encodeURIComponent(username)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error sending OTP:", error);
		return false;
	}
}

async function checkOtp(otp, username) {
	try {
		const response = await fetch(baseUrl + "/modules/otpConfig.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `otp=${encodeURIComponent(
				otp,
			)}&action=verifyOtp&username=${encodeURIComponent(username)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error checking OTP:", error);
		return false;
	}
}
