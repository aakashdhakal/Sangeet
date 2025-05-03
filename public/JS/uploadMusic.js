document.addEventListener("dragover", function (e) {
	e.preventDefault();
	if (e.target.closest(".music-upload-area")) {
		let dragDropArea = e.target;
		let uploadMusicText = dragDropArea.querySelector(".music-upload-text");
		dragDropArea.style.borderColor = "var(--primary-color) ";
		uploadMusicText.style.color = "var(--primary-color)";
	}
});

document.addEventListener("dragleave", function (e) {
	e.preventDefault();
	if (e.target.closest(".music-upload-area")) {
		let dragDropArea = e.target;
		let uploadMusicText = dragDropArea.querySelector(".music-upload-text");
		dragDropArea.style.borderColor = "#a8a8a8";
		uploadMusicText.style.color = "#a8a8a8";
	}
});

document.addEventListener("drop", function (e) {
	e.preventDefault();
	if (e.target.closest(".music-upload-area")) {
		let dragDropArea = e.target;
		let uploadMusicText = dragDropArea.querySelector(".music-upload-text");
		let input = dragDropArea.querySelector("input[type='file']");
		if (checkMusicFileType(e.dataTransfer.files[0])) {
			uploadedFileName(input, e.dataTransfer.files[0].name);
		} else {
			showAlert("Only music files are allowed", "error");
		}
		dragDropArea.style.borderColor = "#a8a8a8";
		uploadMusicText.style.color = "#a8a8a8";
	}
});

function checkMusicFileType(file) {
	const musicTypes = [
		"audio/mp3",
		"audio/mpeg",
		"audio/mpeg3",
		"audio/x-mpeg-3",
		"audio/mp4",
		"audio/x-m4a",
	];
	const musicExtensions = [
		".mp3",
		".mpeg",
		".mpeg3",
		".mp4",
		".m4a",
	];
	const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
	if (musicTypes.includes(file.type) && musicExtensions.includes(fileExtension)) {
		return true;
	} else {
		return false;
	}
}

function checkLyricsFileType(file) {
	const lyricsExtensions = [
		".lrc",
	];
	const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
	if (lyricsExtensions.includes(fileExtension)) {
		return true;
	} else {
		return false;
	}
}

document.addEventListener("submit", async function (e) {
	if (e.target.closest("#uploadMusicForm")) {
		e.preventDefault();
		let submitBtn = uploadMusicForm.querySelector("button[type='submit");
		setBtnStatus(submitBtn, "loading", "Uploading Music");
		let formData = new FormData(uploadMusicForm);
		let musicFile = uploadMusicForm.querySelector("#musicFile").files[0];
		let lyricsFile = uploadMusicForm.querySelector("#lyricsFile").files[0];
		let coverFile = uploadMusicForm.querySelector("#coverImage").files[0];
		formData.set("musicFile", musicFile);
		if (lyricsFile) {
			formData.set("lyricsFile", lyricsFile);
		}
		if (coverFile) {
			formData.set("coverFile", coverFile);
		}

		let music = new Audio(musicFile);
		formData.set("duration", music.duration);

		if (!validateUploadMusicForm(formData)) {
			setBtnStatus(submitBtn, "normal", "Upload");
			return;
		} else if (await uploadMusic(formData)) {
			showAlert("Music uploaded", "success");
			setBtnStatus(submitBtn, "normal", "Upload");
			loadPageDynamic("/");
		}
	}
});


function validateUploadMusicForm(formData) {
	if (formData.get("title") === "") {
		showAlert("Title is required", "error");
		return false;
	} else if (formData.get("genre") === "") {
		showAlert("Genre is required", "error");
		return false;
	}
	else if (formData.get("language") === "") {
		showAlert("Language is required", "error");
		return false;
	}
	else if (formData.get("musicFile") === null) {
		showAlert("You need to upload music file", "error");
		return false;
	}
	return true;
}

document.addEventListener("change", function (e) {
	if (e.target.closest("#lyricsFile")) {
		let file = e.target.files[0];
		if (checkLyricsFileType(file)) {
			uploadedFileName(e.target, file.name);
		} else {
			showAlert("Only .lrc files are allowed", "error");
		}
	}
	if (e.target.closest("#musicFile")) {
		let fileInput = e.target;
		let file = e.target.files[0];
		if (checkMusicFileType(file)) {
			uploadedFileName(fileInput, file.name);
		} else {
			showAlert("Only music files are allowed", "error");
		}
	}
	if (e.target.closest("#coverFile")) {
		showAlert("Cover file uploaded", "success");
	}
});


// function uploadMusic(fileInput, file) {
// 	if (checkMusicFileType(file)) {
// 		uploadedFileName(fileInput, file.name);
// 	} else {
// 		showAlert("Only music files are allowed", "error");

// 	}
// }