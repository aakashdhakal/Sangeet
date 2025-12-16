let title = document.title;
let userFullName;
const unlikedIcon = "<iconify-icon icon='fe:heart-o'></iconify-icon>";
const likedIcon =
	"<iconify-icon icon='fe:heart'  style='color: #ff6a3a'></iconify-icon>";
const baseUrl =
	document.querySelector('meta[name="base-url"]')?.getAttribute("content") ||
	"";

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
		() => {
			dialog.close();
			hideError();
		};
}

// Event listeners for close buttons
document.querySelectorAll(".close-dialog-btn").forEach((btn) => {
	btn.title = "Close";
	btn.addEventListener("click", (e) => {
		e.stopPropagation();
		closeDialog(btn.closest("dialog"));
	});
});

// Close dialog on Escape key press
document.addEventListener("keydown", (e) => {
	if (e.key === "Escape") {
		e.preventDefault();
		document.querySelectorAll("dialog[open]").forEach(closeDialog);
	}
});

// File upload preview
document.addEventListener("change", (e) => {
	if (e.target.matches(".image-upload")) {
		let previewImage = e.target.parentElement;
		let file = e.target.files[0];
		previewImage.style.backgroundImage = `url(${URL.createObjectURL(file)})`;
	}
});

function uploadedFileName(input, name) {
	let previewText =
		input.parentElement.parentElement.querySelector(".music-upload-text");
	if (previewText) previewText.innerHTML = name;
}

// Append script dynamically
function appendScript(src) {
	console.log(src);
	let dynamicScript = document.querySelector(".dynamic-script");
	if (dynamicScript) {
		console.log("script found");
		if (!dynamicScript.src.includes(src)) {
			console.log("script not same src");
			dynamicScript.remove();
		} else {
			console.log("script same src");
			return;
		}
	} else {
		console.log("script not found");
	}
	let script = document.createElement("script");
	script.src = src;
	script.async = true;
	script.classList.add("dynamic-script");
	document.body.appendChild(script);
}

// Change active button
function changeActiveBtn(btn) {
	let currentActiveBtn = document.querySelector("#sideNav .active");
	if (currentActiveBtn) currentActiveBtn.classList.remove("active");
	if (btn) btn.parentElement.classList.add("active");
}

// Change theme
async function changeTheme() {
	if (await checkLoginStatus()) {
		document.body.classList.toggle("dark");
		localStorage.setItem("darkMode", document.body.classList.contains("dark"));
		document.querySelector(".dark-mode-btn").innerHTML =
			document.body.classList.contains("dark")
				? `<iconify-icon icon="clarity:sun-line"></iconify-icon>`
				: `<iconify-icon icon="flowbite:moon-outline"></iconify-icon>`;
	}
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
if (localStorage.getItem("darkMode") === "true") changeTheme();

// Toggle profile window
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

// Toggle notification window
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
	document
		.querySelector(".notification-btn")
		.style.setProperty(
			"--unreadNotificationMark",
			unreadNotificationCount > 0 ? "flex" : "none",
		);
	document.title =
		unreadNotificationCount > 0
			? `(${unreadNotificationCount}) ${title}`
			: title;
}

// Mark notification as read
async function markAsRead(notificationId) {
	if (await setNotificationReadStatus(notificationId))
		showNotifications(notificationCount);
}

// Mark all notifications as read
async function markAllAsRead() {
	let notifications = await fetchNotifications(-1);
	for (let notification of notifications) {
		if (notification.read_status === 0)
			await setNotificationReadStatus(notification.id);
	}
	showNotifications(notificationCount);
}

// Format time
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

// Remove custom select dropdown
function removeCustomSelectDropdown() {
	document
		.querySelectorAll(".custom-select .select-options.show")
		.forEach((select) => select.classList.remove("show"));
}

// Event listeners for various actions
document.addEventListener("click", async (e) => {
	if (document.getElementById("notificationWindow") !== null) {
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
			if (notificationCard.dataset.readStatus === "0") {
				markAsRead(notificationCard.dataset.notificationId);
				notificationCard.dataset.readStatus = "1";
			}
		}
		if (e.target.matches("#clearNotification *")) {
			deleteNotification(
				e.target.closest(".notification-card").dataset.notificationId,
			);
			showNotifications(notificationCount);
		}
		if (e.target.closest("#seeAllNotifications")) showNotifications(-1);
		if (e.target.closest(".mark-all-as-read")) markAllAsRead();
		if (e.target.closest(".notification-btn")) toggleNotificationWindow();
	}
	if (document.getElementById("profileWindow") !== null) {
		if (!e.target.closest("#profileWindow, .profile-btn")) {
			document
				.querySelector("#profileWindow")
				.classList.remove("openProfileWindow");
		}
		if (e.target.closest(".profile-btn")) toggleProfileWindow();
	}
	if (e.target.closest(".dark-mode-btn")) changeTheme();
	if (e.target.closest(".toggle-password-visibility")) {
		let passwordField = e.target.parentElement.querySelector("input");
		passwordField.type =
			passwordField.type === "password" ? "text" : "password";
		e.target.innerHTML =
			passwordField.type === "password"
				? `<iconify-icon icon="fluent:eye-24-regular"></iconify-icon>`
				: `<iconify-icon icon="fluent:eye-off-20-regular"></iconify-icon>`;
	}
	if (e.target.closest(".custom-select")) {
		let select = e.target.closest(".custom-select");
		select.querySelector(".select-options").classList.toggle("show");
	}
	if (!e.target.closest(".custom-select")) {
		removeCustomSelectDropdown();
	}
	if (e.target.closest(".select-option")) {
		let option = e.target.closest(".select-option");
		let value = option.dataset.value;
		let hiddenInput = option.parentElement.parentElement.querySelector(
			"input[type='hidden']",
		);
		let displayInput =
			option.parentElement.previousElementSibling.querySelector("input");
		if (hiddenInput) {
			let selectDisplay =
				option.parentElement.parentElement.querySelector(".select-display");
			selectDisplay.innerHTML = option.innerHTML;
			hiddenInput.value = value;
		} else if (displayInput) {
			displayInput.value = value;
		}
	}
	if (
		e.target.closest(".custom-file-upload") ||
		e.target.closest(".custom-image-upload")
	) {
		let input = e.target.querySelector("input[type='file']");
		if (input) input.click();
	}
	if (e.target.closest(".page-load-btn")) {
		let btn = e.target.closest(".page-load-btn");
		if (btn.classList.contains("nav-btn")) changeActiveBtn(btn);
		await loadPageDynamic(btn.dataset.path);
		appendScript(btn.dataset.script);
	}
	if (e.target.closest(".like-btn")) {
		let likeBtn = e.target.closest(".like-btn");
		setBtnStatus(likeBtn, "loading", "");
		const musicId = likeBtn.dataset.musicid;
		const action = likeBtn.dataset.liked === "1" ? "unlike" : "like";
		if (await setLikeStatus(musicId, action)) {
			likeBtn.dataset.liked = action === "like" ? "1" : "0";
			setBtnStatus(
				likeBtn,
				"normal",
				action === "like" ? likedIcon : unlikedIcon,
			);
			showAlert(
				`Music ${action === "like" ? "added to" : "removed from"} favourites`,
				"success",
			);
			if (window.location.pathname === "/favourites") {
				setBtnStatus(
					likeBtn,
					"normal",
					action === "like" ? likedIcon : unlikedIcon,
				);
				loadPageDynamic("/favourites");
			}
		} else {
			likeBtn.dataset.liked = 1;
			showAlert("Please login to add to favourites", "info");
			setBtnStatus(likeBtn, "normal", unlikedIcon);
		}
	}
	if (e.target.closest("#createPlaylistDialogShowBtn")) {
		document.querySelector("#createPlaylistDialog").showModal();
	}
	if (e.target.closest(".playlist-btn")) {
		let musicId = e.target.closest(".playlist-btn").dataset.musicid;
		let playlistId = e.target.closest(".playlist-btn").dataset.playlistid;
		if (await addToPlaylist(playlistId, musicId)) {
			updateSidebarPlaylistContainer();
			showAlert("Music added to playlist", "success");
		}
	}
	if (e.target.closest(".delete-from-playlist-btn")) {
		e.preventDefault();
		let musicId = e.target.closest(".delete-from-playlist-btn").dataset.musicid;
		let playlistId = e.target.closest(".delete-from-playlist-btn").dataset
			.playlistid;
		if (await deleteMusicFromPlaylist(musicId, playlistId)) {
			loadPageDynamic("/playlist/" + playlistId);
			updateSidebarPlaylistContainer();
			showAlert("Music removed from playlist", "success");
		}
	}
	if (e.target.closest(".delete-from-history-btn")) {
		e.preventDefault();
		let musicId = e.target.closest(".delete-from-history-btn").dataset.musicid;
		if (await deleteMusicFromHistory(musicId)) {
			loadPageDynamic("/history");
			showAlert("Music removed from history", "success");
		}
	}
});

document.addEventListener("input", (e) => {
	if (e.target.matches(".custom-select input")) {
		let input = e.target;
		let select = input.closest(".custom-select");
		let options = select.querySelectorAll(".select-option");
		let value = input.value.toLowerCase();
		options.forEach((option) => {
			if (option.innerHTML.toLowerCase().indexOf(value) > -1) {
				option.style.display = "flex";
			} else {
				option.style.display = "none";
			}
		});
	}
});

async function updateSidebarPlaylistContainer() {
	let sidebarPlaylistContainer = document.querySelector(
		".sidebar-playlist-container",
	);
	if (sidebarPlaylistContainer) {
		const playlists = await fetchPlaylists();
		sidebarPlaylistContainer.innerHTML = playlists
			.map(
				(playlist) => `
			<div class='playlist-card page-load-btn' data-playlistId='${playlist.id}' data-path='/playlist/${playlist.id}' data-title='${playlist.name} - by ${userFullName}' data-script='/public/JS/playlist.js'>
				<img src='${playlist.cover}' alt=''>
				<div class='playlist-info'>
					<h3 class='playlist-title'>${playlist.name}</h3>
					<p class='song-count'><span class='count'>${playlist.song_count}</span> songs</p>
				</div>
			</div>
		`,
			)
			.join("");
	}
}

// Show notifications on page load if logged in
document.addEventListener("DOMContentLoaded", async () => {
	if (await checkLoginStatus()) showNotifications(notificationCount);
});

function showAlert(message, type) {
	let alertIcons = {
		success: "qlementine-icons:success-16",
		error: "material-symbols:error-outline",
		info: "clarity:help-info-line",
		warning: "qlementine-icons:warning-16",
	};
	let alertTextColors = {
		success: "#4CAF50",
		error: "#f44336",
		info: "#2196F3",
		warning: "#ff9800",
	};
	let alertBgColors = {
		success: "#D4EDDA",
		error: "#F8D7DA",
		info: "#D1ECF1",
		warning: "#FFF3CD",
	};

	let alertContainer = document.querySelector(".alert-container");
	if (!alertContainer) {
		alertContainer = document.createElement("div");
		alertContainer.classList.add("alert-container");
		document.body.appendChild(alertContainer);
	}

	let alert = document.createElement("div");
	alert.classList.add("alert");
	alert.style.backgroundColor = alertBgColors[type];
	alert.innerHTML = `<iconify-icon icon="${alertIcons[type]}" style='color: ${alertTextColors[type]}'></iconify-icon>
		<p class="alert-text" style='color: ${alertTextColors[type]}'>${message}</p>`;

	alertContainer.appendChild(alert);

	// Remove the alert after a certain time
	setTimeout(() => {
		alert.remove();
	}, 5000); // Adjust the timeout duration as needed
}

// Debounce function to limit the rate at which a function can fire
function debounce(func, wait) {
	let timeout;
	return function (...args) {
		const context = this;
		clearTimeout(timeout);
		timeout = setTimeout(() => func.apply(context, args), wait);
	};
}

// Debounced search input handler
const handleSearchInput = debounce(async (e) => {
	// Check if the text on search bar has changed
	if (e.target.id === "search") {
		// Get the search value
		let searchValue = e.target.value;
		// If the search value is empty, load the home page
		if (searchValue === "") {
			await loadPageDynamic("/");
		} else {
			await loadSearchPage(searchValue);
		}
	}
}, 300); // Adjust the debounce delay as needed (300ms in this example)

document.addEventListener("input", handleSearchInput);

document.addEventListener("reset", async (e) => {
	// Check if the clicked element or its ancestor has the id search
	if (e.target.closest(".search-form")) {
		// Prevent the reset event from triggering loadPageDynamic if input event has already handled it
		e.preventDefault();
		document.querySelector("#search").value = "";
		await loadPageDynamic("/");
	}
});
document.addEventListener("submit", async (e) => {
	if (e.target.closest("#createPlaylistForm")) {
		// Prevent the form from submitting
		e.preventDefault();
		let submitBtn = e.target.querySelector("button[type=submit]");
		setBtnStatus(submitBtn, "loading", "Creating Playlist");
		let formData = new FormData(e.target);

		if (validateCreatePlaylistForm(e.target)) {
			// Send a POST request to the server
			fetch(baseUrl + "/createPlaylist", {
				method: "POST",
				body: formData,
			})
				.then((res) => res.json())
				.then((data) => {
					if (data.status == 200) {
						// Redirect to the playlist page
						updateSidebarPlaylistContainer();
						closeDialog(e.target.closest("dialog"));
						loadPageDynamic("/playlist/" + data.playlistId);
						showAlert("Playlist created successfully", "success");
						setBtnStatus(submitBtn, "normal", "Create Playlist");
					} else {
						showError(e.target, data.message);
						setBtnStatus(submitBtn, "normal", "Create Playlist");
					}
				})
				.catch((err) => {
					console.error(err);
					showError(e.target, "An error occurred. Please try again later.");
					setBtnStatus(submitBtn, "normal", "Create Playlist");
				});
		} else {
			setBtnStatus(submitBtn, "normal", "Create Playlist");
		}
	}
});

function validateCreatePlaylistForm(form) {
	let formData = new FormData(form);
	let playlistName = formData.get("playlistName");
	let playlistDesc = formData.get("playlistDescription");
	let playlistVisibility = formData.get("visibility");

	if (playlistName.length < 1) {
		showError(form, "Please enter a playlist name");
		return false;
	}
	if (playlistDesc.length < 1) {
		showError(form, "Please enter a playlist description");
		return false;
	}
	if (playlistVisibility.length < 1) {
		showError(form, "Please select a playlist visibility");
		return false;
	}

	return true;
}

async function loadSearchPage(searchValue) {
	await loadPageDynamic("/search/" + encodeURIComponent(searchValue));
}

function getParentElement(element, levels) {
	let parent = element;
	for (let i = 0; i < levels; i++) {
		if (parent.parentElement) {
			parent = parent.parentElement;
		} else {
			return null; // Return null if there are not enough parent elements
		}
	}
	return parent;
}

//all api calls

//function to change pages
async function loadPage(path) {
	let containerElement = document.querySelector("main");
	// Get base url from meta tag or empty string
	const meta = document.querySelector('meta[name="base-url"]');
	const baseUrl = meta ? meta.getAttribute("content") : "";

	// Ensure path starts with / if not present (though usually it is)
	if (!path.startsWith("/")) path = "/" + path;

	// Construct full path
	const fullPath = baseUrl + path;

	try {
		const response = await fetch(fullPath, {
			method: "POST",
		});
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
		const response = await fetch(baseUrl + "/fetchmusic", {
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
async function setLikeStatus(musicId, action = "check") {
	try {
		const response = await fetch(baseUrl + "/addToFavourite", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(musicId)}&action=${action}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else if (data.status === 401 || data.status === 201) {
			return false;
		} else {
			showAlert("Error", data.message);
		}
	} catch (error) {
		console.error("Error setting like status:", error);
		return false;
	}
}

//Function to add music to playlist
async function addToPlaylist(playlistId, musicId) {
	try {
		const response = await fetch(baseUrl + "/addToPlaylist", {
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

async function deleteMusicFromPlaylist(musicId, playlistId) {
	try {
		const response = await fetch(baseUrl + "/deleteMusicFromPlaylist", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(
				musicId,
			)}&playlistId=${encodeURIComponent(playlistId)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			showAlert("Something went wrong! " + data.message, "error");
			return false;
		}
	} catch (error) {
		console.error("Error deleting music from playlist:", error);
		return false;
	}
}

//Function to create a playlist
async function createPlaylist(formData) {
	try {
		const response = await fetch(baseUrl + "/createPlaylist", {
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
		const response = await fetch(baseUrl + "/getPlaylist", {
			method: "POST",
		});
		const data = await response.json();
		return data;
	} catch (error) {
		console.error("Error fetching playlists:", error);
		return "";
	}
}

//Function to add to history
async function addToHistory(musicId) {
	try {
		const response = await fetch(baseUrl + "/addToHistory", {
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

//Function to delete music from history
async function deleteMusicFromHistory(musicId) {
	try {
		const response = await fetch(baseUrl + "/deleteFromHistory", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `musicId=${encodeURIComponent(musicId)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error deleting music from history:", error);
		return false;
	}
}

async function checkLoginStatus() {
	try {
		const response = await fetch(baseUrl + "/checkLoginStatus", {
			method: "POST",
		});
		const data = await response.json();
		if (data.status === 200) {
			userFullName = data.name;
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
		const response = await fetch(baseUrl + "/fetchNotifications", {
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
		const response = await fetch(baseUrl + "/deleteNotification", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `notificationId=${encodeURIComponent(notificationId)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
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
		const response = await fetch(baseUrl + "/setNotificationReadStatus", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `notificationId=${encodeURIComponent(notificationId)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			return false;
		}
	} catch (error) {
		console.error("Error updating notification read status:", error);
		return false;
	}
}

async function sendOtp(email, purpose = "register") {
	try {
		const response = await fetch(baseUrl + "/otpConfig", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `email=${encodeURIComponent(
				email,
			)}&action=sendOtp&purpose=${purpose}`,
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
		const response = await fetch(baseUrl + "/otpConfig", {
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

async function checkUsername(username) {
	try {
		const response = await fetch(baseUrl + "/checkUsername", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `username=${encodeURIComponent(username)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else if (data.status === 409) {
			return false;
		}
	} catch (error) {
		console.error("Error checking username:", error);
		return false;
	}
}

async function checkEmail(email) {
	try {
		const response = await fetch(baseUrl + "/checkEmail", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `email=${encodeURIComponent(email)}`,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else if (data.status === 409) {
			return false;
		}
	} catch (error) {
		console.error("Error checking email:", error);
		return false;
	}
}

// Function to handle user login
async function loginUser(loginForm) {
	// Create a new FormData object with the login form data
	let data = new FormData(loginForm);

	try {
		// Send a POST request to "/modules/loginUser.php" with the form data
		let response = await fetch(baseUrl + "/loginUser", {
			method: "POST",
			body: data,
		});

		// Parse the response as JSON
		let result = await response.json();

		// Handle the response based on the status code
		if (result.status == 200) {
			window.location.href = "/";
		} else if (result.status == 400) {
			showError(loginForm, "The username or password is invalid");
		}
	} catch (error) {
		console.error("Error logging in:", error);
		showError(loginForm, "An error occurred. Please try again.");
	}
}

async function registerUser(formData) {
	try {
		const response = await fetch(baseUrl + "/registerUser", {
			method: "POST",
			body: formData,
		});
		const data = await response.json();

		if (data.status === 200) {
			return true;
		} else {
			showError(data);
		}
	} catch (error) {
		showError(error.message);
	}
}

async function resetPassword(email, password) {
	try {
		const response = await fetch(baseUrl + "/resetPassword", {
			method: "POST",
			body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(
				password,
			)}`,
		});
		const data = await response.json();

		if (data.status === 200) {
			return true;
		} else {
			showError(data);
		}
	} catch (error) {
		showError(error.message);
	}
}

async function fetchMusicQueue(musicId, mode, queueId) {
	let endpoint;
	switch (mode) {
		case "playlist":
			endpoint = baseUrl + "/getPlaylistQueue";
			break;

		case "trending":
			endpoint = baseUrl + "/getTrendingQueue";
			break;
		case "favourites":
			endpoint = baseUrl + "/getFavouritesQueue";
			break;

		default:
			endpoint = baseUrl + "/getMusicQueue";
			break;
	}

	try {
		const response = await fetch(endpoint, {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `id= ${encodeURIComponent(musicId)}&playlistId=${encodeURIComponent(
				queueId,
			)}`,
		});
		const data = await response.json();
		return Object.values(data);
	} catch (error) {
		console.error("Error fetching music queue:", error);
		return [];
	}
}

async function uploadMusic(formData) {
	try {
		const response = await fetch(baseUrl + "/uploadMusic", {
			method: "POST",
			body: formData,
		});
		const data = await response.json();
		if (data.status === 200) {
			return true;
		} else {
			showAlert(data, "error");
		}
	} catch (error) {
		showAlert(error.message, "error");
	}
}

async function getPlaylistInfo(playlistId) {
	try {
		const response = await fetch(baseUrl + "/getPlaylistInfo", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `playlistId=${encodeURIComponent(playlistId)}`,
		});
		const data = await response.json();
		return data;
	} catch (error) {
		console.error("Error fetching playlist info:", error);
		return {};
	}
}

async function removeMusicFromPlaylist(playlistId, musicId) {
	try {
		const response = await fetch(baseUrl + "/getPlaylistInfo", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: `playlistId=${encodeURIComponent(
				playlistId,
			)}&musicId=${encodeURIComponent(musicId)}`,
		});
		const data = await response.json();
		return data;
	} catch (error) {
		console.error("Error fetching playlist info:", error);
		return {};
	}
}
