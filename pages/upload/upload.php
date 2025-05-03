<?php
require_once 'modules/extraFunctions.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: /404');
}
?>
<section id="uploadMusic">
    <form id="uploadMusicForm" action="#" method="post">
        <div class="uploads-container">
            <div class="music-upload-area">
                <p class="music-upload-text">
                    <iconify-icon icon="bytesize:upload"></iconify-icon>
                    Drag and drop your music file here
                    <span>or</span>
                </p>
                <div class="custom-file-upload">
                    <input type="file" id="musicFile" name="musicFile" accept="audio/*">
                    <label for="musicFile">
                        Click to upload
                    </label>
                </div>
            </div>
            <div class="image-upload-area">
                <p>Song Cover </p>
                <div class="custom-image-upload" style="background-image: url('/public/images/song-cover/music.jpg');">
                    <input type="file" id="coverImage" name="coverImage" class="image-upload" accept="image/*">
                    <label for="coverImage">Browse Files</label>
                </div>
            </div>
            <div class="lyrics-upload-area">
                <p>Lyrics </p>
                <div class="custom-file-upload">
                    <input type="file" id="lyricsFile" name="lyricsFile" accept=".lrc">
                    <label for="lyricsFile" class="music-upload-text">
                        Browse Files
                    </label>
                </div>
                <p class="info-text">
                    The lyrics file should be in .lrc format.
                    To generate a .lrc file, you can use the online tool
                    <a href="https://lrcgenerator.com/" target="_blank">LRC Generator</a>
                </p>
            </div>
        </div>
        <div class="details-container">
            <div class="form-group">
                <input type="text" id="title" name="title" placeholder="Blinding Lights">
                <label for="title">Title*</label>
            </div>
            <div class="form-group">
                <p class="input-title">Description</p>
                <textarea type="text" id="description" name="description"
                    placeholder="A short description about your music" rows="5"></textarea>
            </div>
            <div class="form-group">
                <p class="input-title">Visibility*</p>
                <div class="custom-select">
                    <div class="select-display-container">
                        <p class="select-display"><iconify-icon icon="fluent:globe-28-regular"></iconify-icon>Public</p>
                        <iconify-icon icon="mage:caret-down"></iconify-icon>
                    </div>
                    <input type="hidden" name="visibility" id="visibility" value="1">
                    <ul class="select-options">
                        <li class="select-option" data-value="1"><iconify-icon
                                icon="fluent:globe-28-regular"></iconify-icon>Public
                        </li>
                        <li class="select-option" data-value="0"><iconify-icon
                                icon="icon-park-outline:lock"></iconify-icon>Private
                        </li>
                    </ul>

                </div>
            </div>
            <div class="form-group">
                <p class="input-title">Genre*</p>
                <div class="custom-select type-input">
                    <div class="select-display-container">
                        <input type="text" name="genre" id="genre" value="" placeholder="Pop">
                    </div>
                    <ul class="select-options">
                        <?php
                        require_once 'modules/extraFunctions.php';
                        $genreList = getGenreList();
                        foreach ($genreList as $genre) {
                            echo "<li class='select-option' data-value='$genre'>$genre</li>";
                        }
                        ?>
                    </ul>

                </div>
            </div>
            <div class="form-group">
                <p class="input-title">Language*</p>
                <div class="custom-select type-input">
                    <div class="select-display-container">
                        <input type="text" name="language" id="language" value="" placeholder="English">
                    </div>
                    <ul class="select-options">
                        <?php
                        $languageList = getLanguageList();
                        foreach ($languageList as $language) {
                            echo "<li class='select-option' data-value='$language'>$language</li>";
                        }
                        ?>
                    </ul>

                </div>
            </div>
            <button type="submit" class="btn primary-btn">Upload</button>
        </div>
    </form>
</section>