<section id="featuredTrending">
    <div class="featured-banner">
        <div class="banner-content">
            <div class="song-info">
                <h1 class="song-title">Bardali</h1>
                <p class="artist-name">Sushant K.C </p>
            </div>
            <div class="btn-container">
                <button class="primary-btn start-play-music" data-musicId="57"><iconify-icon
                        icon="mingcute:headphone-fill"></iconify-icon>Listen Now</button>
                <button class="add-to-playlist-btn secondary-btn"><iconify-icon
                        icon="tabler:playlist-add"></iconify-icon></button>
            </div>
        </div>
    </div>
    <div class="trending-songs">
        <h2 class="section-title"><iconify-icon icon="fluent:arrow-trending-12-filled"></iconify-icon>Top
            Trending
            Songs
        </h2>
        <div class="song-list-container trending-songs-container">
            <?php include_once "trendingSongs.php" ?>
        </div>
    </div>

</section>
<section id="recentTopArtist">
    <?php if (isset($_SESSION['user_id'])) {
        include "recentlyPlayed.php";
    } else { ?>
        <div class="recommended-songs songs-container">
            <h2 class="section-title"> <iconify-icon icon="fluent:star-emphasis-24-filled"></iconify-icon>Recommended
                Songs
            </h2>
            <button id="prevInContainer"><iconify-icon icon="cuida:caret-left-outline"></iconify-icon></button>
            <div class="recent-songs-container song-card-container">
                <div class="song-card-wrapper">
                    <?php include "recommendedSongs.php" ?>
                </div>
            </div>
            <button id="nextInContainer"><iconify-icon icon="cuida:caret-right-outline"></iconify-icon></button>
        </div>
    <?php } ?>
    <div class="recently-added-songs songs-container">
        <h2 class="section-title"> <iconify-icon icon="mingcute:music-3-line"></iconify-icon>Fresh Tunes
        </h2>
        <button id="prevInContainer"><iconify-icon icon="cuida:caret-left-outline"></iconify-icon></button>
        <div class="recent-songs-container song-card-container">
            <div class="song-card-wrapper">
                <?php include "recentlyAdded.php" ?>
            </div>
        </div>
        <button id="nextInContainer"><iconify-icon icon="cuida:caret-right-outline"></iconify-icon></button>
    </div>
    <div class="featured-artists songs-container">
        <h2 class="section-title"> <iconify-icon icon="akar-icons:star"></iconify-icon>Featured Artists
        </h2>
        <button id="prevInContainer"><iconify-icon icon="cuida:caret-left-outline"></iconify-icon></button>
        <div class="recent-songs-container song-card-container">
            <div class="song-card-wrapper">
                <?php include "featuredArtists.php" ?>
            </div>
        </div>
        <button id="nextInContainer"><iconify-icon icon="cuida:caret-right-outline"></iconify-icon></button>
    </div>
    <div class="top-album">
        <h2 class="section-title"> <iconify-icon icon="solar:soundwave-bold"></iconify-icon>Now Playing
        </h2>
        <div class="top-album-container">
            <?php include "topAlbum.php" ?>
        </div>
    </div>

    </div>
</section>