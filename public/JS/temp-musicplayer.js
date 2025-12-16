// @ts-nocheck
// Select DOM elements
const playPauseBtn = document.querySelector(".play-pause-btn");
const musicControls = document.querySelector("#musicControls");
const seekbar = document.querySelector("#seekbar");
const shuffleBtn = document.querySelector(".shuffle-btn");
const repeatBtn = document.querySelector(".repeat-btn");
const volumeBtn = document.querySelector(".volume-btn");
const volume = document.querySelector("#volume");
const addToPlaylistShowBtn = document.querySelectorAll(".add-to-playlist-btn");
const playlistContainer = document.querySelectorAll(".playlists");
const likeBtn = document.querySelector(".like-btn");
const prevMusicBtn = document.querySelector(".prev-btn");
const nextMusicBtn = document.querySelector(".next-btn");

const playIcon =
	"<iconify-icon icon='solar:play-bold' style='color:#ff7f11'></iconify-icon>";
const pauseIcon =
	"<iconify-icon icon='solar:pause-bold' style='color:#ff7f11'></iconify-icon>";

let isPlaying = false;
let music = new Audio();
let musicId = null;
let loaded = false;
let playedMusicQueue = [];
let nextMusicQueue = [];
let nextMusicQueueCopy = [];
let lyrics = [];
let currentLyric = [];
let nextLyric = [];
let previousLyric = [];
let musicName, artistName;

// Function to parse LRC file text and return an array of time-text objects
function parseLyric(lrc) {
	const lines = lrc.split("\n");
	const regex = /^\[(\d{2}:\d{2}\.\d{2})\](.*)/;
	const output = [];

	lines.forEach((line) => {
		const match = line.match(regex);
		if (match) {
			const [_, time, text] = match;
			output.push({ time: parseTime(time), text: text.trim() });
		}
	});

	// Convert "mm:ss.xx" to total seconds
	function parseTime(time) {
		const [min, sec] = time.split(":");
		return parseInt(min) * 60 + parseFloat(sec);
	}

	return output;
}

function syncLyric(lyrics, time) {
	const scores = lyrics
		.map((lyric) => time - lyric.time)
		.filter((score) => score >= 0);

	if (scores.length === 0) return null;

	const closest = Math.min(...scores);
	return scores.indexOf(closest);
}

function displayLyric(lyrics, time) {
	const lyricContainer = document.querySelector(".lyrics-container");
	const lyricIndex = syncLyric(lyrics, time);
	if (lyricIndex !== null) {
		//get the current lyric and the next lyric and previous lyric
		currentLyric = lyrics[lyricIndex];
		nextLyric = lyrics[lyricIndex + 1];
		previousLyric = lyrics[lyricIndex - 1];

		lyricContainer.innerHTML = `
            <p class="lyric previous">${
							previousLyric ? previousLyric.text : ""
						}</p>
            <p class="lyric current">${currentLyric.text}</p>
            <p class="lyric next">${nextLyric ? nextLyric.text : ""}</p>
        `;
	} else {
		lyricContainer.innerHTML = "";
	}
}

// Check if the given music ID is already loaded
function isMusicLoaded(id) {
	return musicId === id;
}

// Load music by ID
async function loadMusic(id) {
	const musicData = await fetchMusic(id);
	musicId = musicData.id;
	musicName = musicData.title;
	artistName = `${musicData.firstname} ${musicData.lastname}`;
	document.title = musicName + " - " + artistName;
	music.src = musicData.filePath;
	music.load();
	music.addEventListener("loadedmetadata", () => {
		updateMusicControls(musicData);
		loaded = true;
	});
	await addToHistory(musicData.id);
	addToPrevMusic(musicData.id);
	if (await setLikeStatus(musicData.id)) {
		likeBtn.dataset.liked = 1;
		setBtnStatus(likeBtn, "normal", likedIcon);
	} else {
		likeBtn.dataset.liked = 0;
		setBtnStatus(likeBtn, "normal", unlikedIcon);
	}

	// Fetch and display lyrics
	currentLyric = nextLyric = previousLyric = [];
	const lrc = await fetch(musicData.lyricsPath).then((res) => res.text());
	lyrics = parseLyric(lrc);
}

// Format the duration of the music in minutes and seconds
function formatDuration(duration) {
	const minutes = Math.floor(duration / 60);
	const seconds = Math.floor(duration % 60)
		.toString()
		.padStart(2, "0");
	return `${minutes}:${seconds}`;
}

// Update music controls with music data
function updateMusicControls(musicData) {
	const musicTitle = document.querySelector(".music-title");
	const musicArtist = document.querySelector(".music-artist");
	const musicCover = document.querySelector(".music-cover");
	const totalDuration = document.querySelector(".total-duration");

	musicTitle.innerHTML = musicData.title;
	musicArtist.innerHTML = `${musicData.firstname} ${musicData.lastname}`;
	musicCover.src = musicData.coverImage;
	totalDuration.innerHTML = formatDuration(music.duration);
	likeBtn.dataset.musicid = musicData.id;

	if (!loaded) {
		musicControls.animate([{ bottom: "-10%" }, { bottom: "0" }], {
			duration: 500,
			easing: "ease-in-out",
			fill: "forwards",
		});
	}
}

// Function to play the music
async function playMusic() {
	setPageTitle("", musicName + " - " + artistName);
	navigator.mediaSession.playbackState = "playing";
	music.play();
	displayLyric(lyrics, music.currentTime);
	isPlaying = true;
	playPauseBtn.innerHTML = pauseIcon;
}

// Function to pause the music
function pauseMusic() {
	navigator.mediaSession.playbackState = "paused";
	setPageTitle(window.location.href);
	music.pause();
	isPlaying = false;
	playPauseBtn.innerHTML = playIcon;
}

// Function to add current music to the nextMusicQueue list
function addToNextMusic(currentMusicId) {
	if (!nextMusicQueue.includes(currentMusicId)) {
		nextMusicQueue.unshift(currentMusicId);
	}
}

// Function to add current music to the playedMusicQueue list
function addToPrevMusic(currentMusicId) {
	if (!playedMusicQueue.includes(currentMusicId)) {
		playedMusicQueue.push(currentMusicId);
	}
}

prevMusicBtn.addEventListener("click", async () => {
	if (playedMusicQueue.length > 1) {
		// Add current music to nextMusicQueue list
		addToNextMusic(playedMusicQueue.pop());
		// Remove the last played music and load the previous one

		await loadMusic(playedMusicQueue.pop());
		playMusic();
	}
});

nextMusicBtn.addEventListener("click", async () => {
	if (nextMusicQueue.length) {
		// Add current music to playedMusicQueue list
		// Load the next music from the nextMusicQueue list
		await loadMusic(nextMusicQueue.shift());
		playMusic();
	}
});

// Event listener for updating seekbar, current duration, and lyrics
music.addEventListener("timeupdate", () => {
	if (music.duration) {
		const currentDuration = document.querySelector(".current-duration");
		const position = (music.currentTime / music.duration) * 100;
		seekbar.value = position;
		seekbar.style.setProperty("--seek-before-width", `${position}%`);
		currentDuration.innerText = formatDuration(music.currentTime);

		// Update lyrics display
		displayLyric(lyrics, music.currentTime);
	}
});

// Event listener for music end
music.addEventListener("ended", () => {
	if (repeatBtn.getAttribute("data-repeat") === "true") {
		playMusic();
	} else {
		setTimeout(() => {
			nextMusicBtn.click();
		}, 2000);
	}
});

// Event listeners for seekbar
seekbar.addEventListener("mouseout", () =>
	seekbar.style.setProperty("--thumb-display", "none"),
);
seekbar.addEventListener("mousemove", () =>
	seekbar.style.setProperty("--thumb-display", "block"),
);
seekbar.addEventListener(
	"input",
	() => (music.currentTime = music.duration * (seekbar.value / 100)),
);

// Function to toggle button state
function toggleButton(button, attribute, otherButton, otherAttribute) {
	const isActive = button.getAttribute(attribute) === "true";
	button.style.color = isActive ? "var(--text-color-light)" : "#ff7f11";
	button.setAttribute(attribute, isActive ? "false" : "true");

	if (otherButton.getAttribute(otherAttribute) === "true") {
		otherButton.click();
	}
}

// Event listeners for shuffle and repeat buttons
shuffleBtn.addEventListener("click", function () {
	toggleButton(shuffleBtn, "data-shuffle", repeatBtn, "data-repeat");

	for (let i = nextMusicQueue.length - 1; i > 0; i--) {
		const j = Math.floor(Math.random() * (i + 1));
		[nextMusicQueue[i], nextMusicQueue[j]] = [
			nextMusicQueue[j],
			nextMusicQueue[i],
		];
	}
});
repeatBtn.addEventListener("click", () =>
	toggleButton(repeatBtn, "data-repeat", shuffleBtn, "data-shuffle"),
);

// Event listener for play/pause button
playPauseBtn.addEventListener("click", () =>
	isPlaying ? pauseMusic() : playMusic(),
);

// Function to mute the music
function mute() {
	localStorage.setItem("volume", volume.value);
	volumeBtn.innerHTML = '<iconify-icon icon="mage:volume-mute"></iconify-icon>';
	volume.value = 0;
	music.volume = 0;
	volume.style.setProperty("--volume-before-width", `${volume.value}px`);
}

// Function to adjust the volume
function adjustVolume(volumeValue) {
	volume.style.setProperty("--volume-before-width", `${volumeValue}px`);
	music.volume = volumeValue / 100;
	volume.value = volumeValue;

	if (volumeValue <= 0) {
		volumeBtn.innerHTML =
			'<iconify-icon icon="mage:volume-mute"></iconify-icon>';
	} else if (volumeValue < 50) {
		volumeBtn.innerHTML =
			'<iconify-icon icon="mage:volume-down"></iconify-icon>';
	} else {
		volumeBtn.innerHTML = '<iconify-icon icon="mage:volume-up"></iconify-icon>';
	}
}

// Event listener for volume button
volumeBtn.addEventListener("click", () => {
	if (volume.value <= 0) {
		adjustVolume(localStorage.getItem("volume"));
	} else {
		mute();
	}
});

// Event listener for volume input
volume.addEventListener("input", () => {
	if (volume.value <= 0) {
		mute();
		localStorage.setItem("volume", 20);
	} else {
		localStorage.setItem("volume", volume.value);
		adjustVolume(volume.value);
	}
	volume.title = `${Math.floor(volume.value)}%`;
});

// Event listeners for volume input mouse events
volume.addEventListener("mouseout", () =>
	volume.style.setProperty("--thumb-display", "none"),
);
volume.addEventListener("mousemove", () =>
	volume.style.setProperty("--thumb-display", "block"),
);

// Event listener for keydown events
document.addEventListener("keydown", (e) => {
	if (e.target.matches("input") || e.target.matches("textarea")) return;

	switch (e.key) {
		case " ":
			e.preventDefault();
			isPlaying ? pauseMusic() : playMusic();
			break;
		case "ArrowRight":
			music.currentTime += 5;
			break;
		case "ArrowLeft":
			music.currentTime -= 5;
			break;
		case "m":
			volumeBtn.click();
			break;
		case "f":
			likeBtn.click();
			break;
		case "r":
			repeatBtn.click();
			break;
		case "s":
			shuffleBtn.click();
			break;
		case "p":
			addToPlaylistBtn.click();
			break;
	}
});

// Function to display playlists
async function displayPlaylists() {
	const data = await fetchPlaylists();
	playlistContainer.forEach((container) => {
		container.innerHTML = data;
	});
}

// Event listener for document clicks
document.addEventListener("click", async (e) => {
	const startPlayBtn = e.target.closest(".start-play-music");
	if (startPlayBtn) {
		let musicId = startPlayBtn.dataset.musicid;

		if (isMusicLoaded(musicId)) {
			isPlaying ? pauseMusic() : playMusic();
		} else {
			await loadMusic(musicId);
			let playlistId = startPlayBtn.dataset.playlistid;
			if (playlistId) {
				nextMusicQueue = (
					await fetchMusicQueue(musicId, "playlist", playlistId)
				).map((music) => music.music_id);
			} else {
				nextMusicQueue = (await fetchMusicQueue(musicId)).map(
					(music) => music.id,
				);
			}
			nextMusicQueueCopy = [...nextMusicQueue];
			playMusic();
		}
	}

	if (e.target.closest(".expand-current-song")) {
		const currentSongContainer = e.target.closest("#musicControls");
		currentSongContainer.classList.toggle("expanded");
		if (currentSongContainer.classList.contains("expanded")) {
			document.documentElement.requestFullscreen();
			document.body.style.overflow = "hidden";
		} else {
			document.body.style.overflow = "auto";
			document.exitFullscreen();
		}
	}
});

// Event listener for fullscreen change
document.addEventListener("fullscreenchange", () => {
	const currentSongContainer = document.querySelector("#musicControls");
	if (!document.fullscreenElement) {
		currentSongContainer.classList.remove("expanded");
		document.body.style.overflow = "auto";
	}
});

music.addEventListener("seeked", () => {
	displayLyric(lyrics, music.currentTime);
});

document.addEventListener("click", (e) => {
	if (e.target.closest(".add-to-playlist-btn")) {
		//show playlists just below the btn
		let addToPlaylistDialog = document.querySelector("#addToPlaylistModal");
		let playListBtns = document.querySelectorAll(
			"#addToPlaylistModal .playlist-btn",
		);
		playListBtns.forEach((btn) => {
			btn.dataset.musicid = e.target.closest(
				".add-to-playlist-btn",
			).dataset.musicid;
		});
		addToPlaylistDialog.show();
		addToPlaylistDialog.style.top = `${
			getElementPosition(e.target).top + 30
		}px`;
		addToPlaylistDialog.style.left = `${
			getElementPosition(e.target).left - 170
		}px`;
	} else if (document.querySelector("#addToPlaylistModal").open) {
		closeDialog(document.querySelector("#addToPlaylistModal"));
	}
});

function getElementPosition(element) {
	const rect = element.getBoundingClientRect();
	return {
		top: rect.top + window.scrollY,
		left: rect.left + window.scrollX,
		right: rect.right + window.scrollX,
		bottom: rect.bottom + window.scrollY,
	};
}
