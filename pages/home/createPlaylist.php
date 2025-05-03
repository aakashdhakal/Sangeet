<!-- filepath: /c:/xampp/htdocs /pages/home/createPlaylist.php -->
<dialog id="createPlaylistDialog">
    <div class="max-width">
        <button class="close-dialog-btn" id="closeCreatePlaylistForm">
            <iconify-icon icon="system-uicons:cross"></iconify-icon>
        </button>
        <h2>Create Playlist</h2>
        <div class="error-container">
            <p class="error-text">Error message here</p>
        </div>
        <div class="forms-container">
            <form action="#" method="POST" id="createPlaylistForm">
                <div class="form-group">
                    <label for="playlistName">Playlist Name</label>
                    <input type="text" name="playlistName" id="playlistName" placeholder="My Playlist">
                </div>
                <div class="form-group">
                    <p class="input-title">Playlist Description </p>
                    <textarea name="playlistDescription" id="playlistDescription" placeholder="Describe your playlist"
                        rows="4"></textarea>
                </div>
                <div class="form-group">
                    <div class="image-upload-area">
                        <p class="input-title">Playlist Cover</p>
                        <div class="custom-image-upload"
                            style="background-image: url('/public/images/playlist-cover/playlist-cover.png');">
                            <input type="file" id="playlistCover" name="playlistCover" class="image-upload"
                                accept="image/*">
                            <label for="playlistCover">Browse Files</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p class="input-title">Visibility*</p>
                    <div class="custom-select">
                        <div class="select-display-container">
                            <p class="select-display"><iconify-icon icon="fluent:globe-28-regular"></iconify-icon>Public
                            </p>
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
                <button type="submit" class="primary-btn">Create Playlist</button>
            </form>
        </div>
    </div>
</dialog>