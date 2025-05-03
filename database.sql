-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Nov 13, 2024 at 03:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28
=======
-- Generation Time: Dec 23, 2024 at 05:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite_songs`
--

CREATE TABLE `favourite_songs` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite_songs`
--

INSERT INTO `favourite_songs` (`id`, `song_id`, `user_id`) VALUES
<<<<<<< HEAD
(6, 3, 1),
(21, 0, 3),
(22, 3, 3),
(31, 10, 3),
(32, 11, 3),
(66, 16, 3),
(67, 23, 3),
(68, 22, 3),
(73, 46, 5),
(86, 2, 3);
=======
(108, 16, 3),
(110, 15, 3),
(356, 57, 3),
(366, 71, 28),
(367, 22, 28),
(368, 21, 28);
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `artist` text DEFAULT NULL,
  `genre` text DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `filePath` text DEFAULT NULL,
  `coverImage` varchar(255) DEFAULT NULL,
  `lyricsPath` text DEFAULT NULL,
  `isPublic` tinyint(1) NOT NULL,
  `language` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musics`
--

<<<<<<< HEAD
INSERT INTO `musics` (`id`, `title`, `artist`, `genre`, `duration`, `releaseDate`, `filePath`, `coverImage`) VALUES
(1, 'Sarangi', 'sushantkc', 'folk', 282, NULL, '/WEB-PROJECT/public/music/Saarangi-Sushant-K.C.mp3', '/WEB-PROJECT/public/images/song-cover/sarangi.jpg'),
(2, 'Kya Kardiya', 'sushantkc', 'pop', 206, '2024-06-04', '/WEB-PROJECT/public/music/Kya-Kardiya-sushant-kc.m4a', '/WEB-PROJECT/public/images/song-cover/kyakardiya.jpg'),
(3, 'Blinding Lights', 'theweekend', 'pop', 200, '2024-06-04', '/WEB-PROJECT/public/music/Blinding-Lights.mp3', '/WEB-PROJECT/public/images/song-cover/blindinglights.jpg'),
(15, 'Bye Bye Bye', 'nsync', 'pop', 201, '2024-08-10', '/WEB-PROJECT/public/music/bye-bye-bye.m4a', '/WEB-PROJECT/public/images/song-cover/bye-bye-bye-cover.png'),
(16, 'Like a Prayer', 'madonna', 'modern', 341, '2024-08-10', '/WEB-PROJECT/public/music/like-a-prayer.m4a', '/WEB-PROJECT/public/images/song-cover/like-a-prayer-cover.png'),
(17, 'Bad Liar', 'imaginedragons', 'Rock', 261, '2024-08-10', '/WEB-PROJECT/public/music/bad-liar.m4a', '/WEB-PROJECT/public/images/song-cover/bad-liar-cover.jpg'),
(18, 'Champion', 'djbravo', 'Modern', 149, '2024-08-10', '/WEB-PROJECT/public/music/champion.m4a', '/WEB-PROJECT/public/images/song-cover/champion-cover.webp'),
(19, 'Ashes (From Deadpool Movie)', 'celinedion', 'pop', 200, '2024-08-12', '/WEB-PROJECT/public/music/ashes-from-deadpool-movie.m4a', '/WEB-PROJECT/public/images/song-cover/ashes-from-deadpool-movie-cover.jpg'),
(21, 'Con Calma', 'daddyyankee', 'Rock', 181, '2024-08-12', '/WEB-PROJECT/public/music/con-calma-music.m4a', '/WEB-PROJECT/public/images/song-cover/con-calma-cover.jpg'),
(22, 'I Don\'t Care', 'edsheerean', 'Modern', 220, '2024-08-12', '/WEB-PROJECT/public/music/i-dont-care-music.m4a', '/WEB-PROJECT/public/images/song-cover/i-dont-care-cover.png'),
(55, 'Lean On', 'majorlazer', 'Rock', 177, '2024-08-24', '/WEB-PROJECT/public/music/lean-on-music.m4a', '/WEB-PROJECT/public/images/song-cover/music.jpg'),
(56, 'Liggi', 'ritviz', 'Indian', 181, '2024-08-24', '/WEB-PROJECT/public/music/liggi-music.m4a', '/WEB-PROJECT/public/images/song-cover/liggi-cover.jpg'),
(57, 'Bardali', 'sushantkc', 'Folk', 213, '2024-08-24', '/WEB-PROJECT/public/music/bardali-shusant-kc.mp3', '/WEB-PROJECT/public/images/song-cover/bardali.jpg');
=======
INSERT INTO `musics` (`id`, `title`, `artist`, `genre`, `duration`, `releaseDate`, `filePath`, `coverImage`, `lyricsPath`, `isPublic`, `language`, `description`) VALUES
(1, 'Sarangi', 'sushantkc', 'folk', 282, NULL, '/public/music/Saarangi-Sushant-K.C.mp3', '/public/images/song-cover/sarangi.jpg', '/public/lyrics/saarangi-lyrics.lrc', 0, '', ''),
(2, 'Kya Kardiya', 'sushantkc', 'pop', 206, '2024-06-04', '/public/music/Kya-Kardiya-sushant-kc.m4a', '/public/images/song-cover/kyakardiya.jpg', '/public/lyrics/kya-kardiya-lyrics.lrc', 0, '', ''),
(3, 'Blinding Lights', 'theweekend', 'pop', 200, '2024-06-04', '/public/music/Blinding-Lights.mp3', '/public/images/song-cover/blindinglights.jpg', '/public/lyrics/blinding-lights-lyrics.lrc', 0, '', ''),
(15, 'Bye Bye Bye', 'nsync', 'pop', 201, '2024-08-10', '/public/music/bye-bye-bye.m4a', '/public/images/song-cover/bye-bye-bye-cover.png', '/public/lyrics/bye-bye-bye-lyrics.lrc', 0, '', ''),
(16, 'Like a Prayer', 'madonna', 'modern', 341, '2024-08-10', '/public/music/like-a-prayer.m4a', '/public/images/song-cover/like-a-prayer-cover.png', '/public/lyrics/like-a-prayer-lyrics.lrc', 0, '', ''),
(17, 'Bad Liar', 'imaginedragons', 'Rock', 261, '2024-08-10', '/public/music/bad-liar.m4a', '/public/images/song-cover/bad-liar-cover.jpg', '/public/lyrics/bad-liar-lyrics.lrc', 0, '', ''),
(18, 'Champion', 'djbravo', 'Modern', 149, '2024-08-10', '/public/music/champion.m4a', '/public/images/song-cover/champion-cover.webp', '/public/lyrics/champion-lyrics.lrc', 0, '', ''),
(19, 'Ashes (From Deadpool Movie)', 'celinedion', 'pop', 200, '2024-08-12', '/public/music/ashes-from-deadpool-movie.m4a', '/public/images/song-cover/ashes-from-deadpool-movie-cover.jpg', '/public/lyrics/ashes-lyrics.lrc', 0, '', ''),
(21, 'Con Calma (Ft. Katy Pary)', 'daddyyankee', 'Rock', 181, '2024-08-12', '/public/music/con-calma-music.m4a', '/public/images/song-cover/con-calma-cover.jpg', '/public/lyrics/con-calma.lrc', 0, '', ''),
(22, 'I Don\'t Care (Ft. Justin Bieber)', 'edsheerean', 'Modern', 220, '2024-08-12', '/public/music/i-dont-care-music.m4a', '/public/images/song-cover/i-dont-care-cover.png', '/public/lyrics/i-dont-care-lyrics.lrc', 0, '', ''),
(55, 'Lean On (Ft. MØ)', 'majorlazer', 'Rock', 177, '2024-08-24', '/public/music/lean-on-music.m4a', '/public/images/song-cover/music.jpg', '/public/lyrics/lean-on-lyrics.lrc', 0, '', ''),
(56, 'Liggi', 'ritviz', 'Indian', 181, '2024-08-24', '/public/music/liggi-music.m4a', '/public/images/song-cover/liggi-cover.jpg', '', 0, '', ''),
(57, 'Bardali', 'sushantkc', 'Folk', 213, '2024-08-24', '/public/music/bardali-shusant-kc.mp3', '/public/images/song-cover/bardali.jpg', '/public/lyrics/bardali-lyrics.lrc', 0, '', ''),
(58, 'Raiya Chadiko', 'aakashdhakal', 'Dohori', 0, '2024-12-15', 'public/music/raiya-chadiko-music.mp3', '/public/images/song-cover/music.jpg', NULL, 1, 'Nepali', ''),
(71, 'My Music', 'dhakalaakash', 'Dohori', 0, '2024-12-22', 'public/music/my-music-music.mp3', '/public/images/song-cover/my-music-cover.jpg', NULL, 1, 'Nepali', 'my desc');
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `music_history`
--

CREATE TABLE `music_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `music_history`
--

INSERT INTO `music_history` (`id`, `user_id`, `music_id`) VALUES
<<<<<<< HEAD
(279, 1, 57),
(280, 1, 1),
(281, 1, 57),
(282, 1, 15),
(283, 1, 3),
(284, 1, 16),
(285, 1, 19),
(286, 1, 56),
(287, 1, 2),
(288, 1, 22),
(289, 1, 56),
(290, 1, 57),
(291, 1, 55),
(292, 1, 15),
(293, 1, 57),
(294, 1, 57),
(295, 1, 57),
(296, 1, 57),
(297, 1, 57),
(298, 1, 57),
(299, 1, 57),
(300, 1, 57),
(301, 1, 57),
(302, 1, 57),
(303, 1, 56),
(304, 1, 1),
(305, 1, 1),
(306, 1, 1),
(307, 1, 1),
(308, 1, 56),
(309, 1, 57),
(310, 1, 15),
(311, 1, 55),
(312, 1, 22),
(313, 1, 2),
(314, 1, 19),
(315, 1, 16),
(316, 1, 3),
(317, 1, 17),
(318, 1, 18),
(319, 1, 21),
(320, 1, 21),
(321, 1, 18),
(322, 1, 17),
(323, 1, 57),
(324, 1, 57),
(325, 1, 57),
(326, 1, 22),
(327, 1, 57),
(328, 1, 57),
(329, 1, 57),
(330, 1, 57),
(331, 1, 57),
(332, 1, 57),
(333, 1, 57),
(334, 1, 57),
(335, 1, 57),
(336, 1, 57),
(337, 1, 57),
(338, 1, 57),
(339, 1, 57),
(340, 1, 57),
(341, 1, 57),
(342, 1, 19),
(343, 1, 57),
(344, 3, 57),
(345, 3, 21),
(346, 3, 21),
(347, 3, 57),
(348, 3, 57),
(349, 3, 57),
(350, 3, 57),
(351, 3, 57),
(352, 3, 57),
(353, 3, 57);
=======
(457, 3, 55),
(458, 3, 55),
(464, 3, 55),
(465, 3, 55),
(466, 3, 55),
(467, 3, 55),
(468, 3, 55),
(469, 3, 55),
(470, 3, 55),
(471, 3, 55),
(472, 3, 55),
(473, 3, 55),
(474, 3, 55),
(475, 3, 55),
(476, 3, 3),
(477, 3, 17),
(478, 3, 17),
(479, 3, 17),
(480, 3, 17),
(481, 3, 17),
(482, 3, 17),
(483, 3, 18),
(484, 3, 55),
(485, 3, 55),
(486, 3, 2),
(487, 3, 57),
(488, 3, 2),
(489, 3, 1),
(490, 3, 2),
(491, 3, 56),
(494, 3, 55),
(496, 3, 55),
(497, 3, 2),
(498, 3, 2),
(499, 3, 2),
(500, 3, 2),
(501, 3, 2),
(502, 3, 2),
(503, 3, 56),
(504, 3, 56),
(505, 3, 55),
(506, 3, 1),
(507, 3, 17),
(508, 3, 17),
(510, 3, 57),
(512, 3, 2),
(514, 3, 15),
(516, 3, 3),
(517, 3, 56),
(518, 3, 56),
(519, 3, 19),
(520, 3, 56),
(521, 3, 18),
(522, 3, 17),
(523, 3, 18),
(524, 3, 56),
(525, 3, 18),
(526, 3, 55),
(527, 3, 1),
(528, 3, 55),
(529, 3, 1),
(530, 3, 1),
(531, 3, 18),
(532, 3, 21),
(533, 3, 18),
(534, 3, 18),
(535, 3, 21),
(536, 3, 55),
(537, 3, 21),
(538, 3, 55),
(539, 3, 2),
(540, 3, 15),
(541, 3, 17),
(542, 3, 15),
(543, 3, 17),
(544, 3, 15),
(545, 3, 17),
(546, 3, 18),
(547, 3, 1),
(548, 3, 56),
(550, 3, 57),
(552, 3, 57),
(554, 3, 19),
(555, 3, 3),
(556, 3, 19),
(557, 3, 15),
(558, 3, 21),
(560, 3, 55),
(561, 3, 21),
(562, 3, 21),
(563, 3, 19),
(564, 3, 55),
(565, 3, 1),
(567, 3, 2),
(568, 3, 58),
(569, 3, 58),
(573, 3, 58),
(574, 3, 2),
(575, 3, 1),
(576, 3, 2),
(577, 3, 2),
(578, 3, 58),
(579, 3, 2),
(580, 3, 18),
(581, 3, 1),
(582, 3, 57),
(584, 3, 3),
(585, 3, 17),
(586, 3, 17),
(587, 3, 1),
(588, 3, 19),
(589, 3, 17),
(590, 3, 17),
(591, 3, 17),
(592, 3, 17),
(593, 3, 17),
(594, 3, 15),
(597, 3, 55),
(598, 3, 55),
(599, 3, 17),
(600, 17, 16),
(601, 3, 17),
(603, 3, 1),
(604, 3, 18),
(605, 3, 3),
(614, 3, 18),
(616, 3, 18),
(617, 3, 2),
(619, 3, 15),
(620, 3, 19),
(621, 3, 1),
(623, 3, 18),
(625, 3, 1),
(626, 3, 19),
(627, 3, 15),
(629, 3, 2),
(631, 3, 15),
(632, 3, 19),
(633, 3, 1),
(635, 3, 18),
(637, 3, 1),
(638, 3, 19),
(639, 3, 15),
(641, 3, 2),
(642, 3, 19),
(643, 3, 58),
(644, 3, 21),
(645, 3, 17),
(648, 3, 19),
(649, 3, 19),
(650, 3, 1),
(652, 3, 18),
(653, 3, 19),
(654, 3, 15),
(656, 3, 2),
(657, 3, 18),
(658, 3, 57),
(659, 3, 57),
(660, 3, 57),
(661, 3, 57),
(662, 3, 57),
(663, 3, 57),
(664, 3, 57),
(665, 3, 57),
(666, 3, 57),
(667, 3, 57),
(668, 3, 57),
(669, 3, 57),
(670, 3, 57),
(671, 3, 18),
(672, 3, 57),
(673, 3, 57),
(674, 3, 55),
(675, 3, 55),
(677, 3, 55),
(679, 3, 55),
(680, 3, 17),
(683, 3, 17),
(685, 3, 17),
(686, 3, 57),
(688, 3, 17),
(689, 3, 55),
(691, 3, 2),
(692, 3, 55),
(693, 3, 17),
(694, 3, 2),
(696, 3, 55),
(697, 3, 3),
(698, 3, 2),
(700, 3, 55),
(701, 3, 55),
(706, 28, 55),
(707, 28, 17),
(708, 28, 2),
(710, 28, 21),
(711, 28, 71),
(713, 28, 21),
(715, 28, 17);
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `creation_date` date NOT NULL,
  `cover` text NOT NULL,
  `description` text NOT NULL,
  `isPublic` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

<<<<<<< HEAD
INSERT INTO `playlists` (`id`, `user_id`, `name`, `creation_date`, `cover`, `description`, `visibility`) VALUES
(50, 3, 'Aakash\'s Playlist', '2024-07-29', '/WEB-PROJECT/public/images/playlist-cover/3-Aakash\'s Playlist948726.jpeg', '', 'private'),
(52, 3, 'Aakash Dhakal', '2024-08-10', '/WEB-PROJECT/public/images/playlist-cover/3-Aakash Dhakal987246.jpg', '', '');
=======
INSERT INTO `playlists` (`id`, `user_id`, `name`, `creation_date`, `cover`, `description`, `isPublic`) VALUES
(50, 3, 'Aakash\'s Playlist', '2024-07-29', '/public/images/playlist-cover/playlist-cover.png', 'This playlist features a curated selection of the best tracks from various genres, perfect for any mood or occasion. Enjoy a mix of classic hits and new releases, handpicked to provide an exceptional listening experience. Whether you\'re looking to relax, get energized, or discover new music, this playlist has something for everyone. Dive in and let the music take you on a journey', 1),
(52, 3, 'Aakash Dhakal', '2024-08-10', '/public/images/playlist-cover/test.jpg', 'This is a test playlist description', 0),
(88, 28, 'My playlist', '2024-12-22', '/public/images/playlist-cover/28-My playlist280161.jpg', 'My playlist desc', 1);
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_songs`
--

INSERT INTO `playlist_songs` (`id`, `music_id`, `playlist_id`) VALUES
(53, 2, 50),
(56, 2, 52),
(57, 16, 50),
(58, 15, 50),
<<<<<<< HEAD
(59, 19, 50),
=======
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee
(60, 1, 50),
(62, 15, 52),
(63, 18, 50),
(64, 22, 50),
(65, 16, 52),
<<<<<<< HEAD
(66, 19, 52);
=======
(70, 57, 52),
(75, 55, 88),
(76, 2, 88);
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_picture` text NOT NULL,
  `bio` text NOT NULL,
  `is_artist` tinyint(1) NOT NULL,
  `isVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `dob`, `gender`, `email`, `profile_picture`, `bio`, `is_artist`, `isVerified`) VALUES
<<<<<<< HEAD
(1, 'sushantkc', 'kjhekajhksjdhak', 'Shusant', 'K.C', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/sushantkc.jpg', '', 1, 1),
(2, 'theweekend', 'kjhekajhksjdhak', 'The', 'Weekend', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/theweekend.jpg', '', 1, 1),
(3, 'aakashdhakal', 'helloworld', 'Aakash', 'Dhakal', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/profile.jpeg', '', 0, 1),
(4, 'diwashmainali', 'diwashmainali', 'Diwash', 'Mainali', '2014-08-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/diwashmainali.jpg', '', 0, 1),
(5, 'admin', 'admin', 'Admin', 'Pandey', '2014-08-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/sushankpandey.jpg', '', 0, 1),
(6, 'celinedion', 'kjhekajhksjdhak', 'Celine', 'Dion', '1997-01-01', 'female', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/celinedion.jpg', '', 1, 1),
(7, 'nsync', 'kjhekajhksjdhak', 'Nsync', '', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/nsync.jpg', '', 1, 1),
(8, 'madonna', 'diwashmainali', 'Madonna', '', '2014-08-01', 'female', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/madonna.jpg', '', 1, 1),
(9, 'imaginedragons', 'kjhekajhksjdhak', 'Imagine', 'Dragons', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/imaginedragons.jpg', '', 1, 1),
(10, 'djbravo', 'diwashmainali', 'DJ', 'Bravo', '2014-08-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/djbravo.jpg', '', 1, 1),
(11, 'ritviz', 'diwashmainali', 'Ritviz', '', '2014-08-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/ritviz.jpg', '', 1, 1),
(12, 'majorlazer', 'kjhekajhksjdhak', 'Major', 'Lazer', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/majorlazer.jpg', '', 1, 1),
(13, 'edsheerean', 'admin', 'Ed', 'Sheerean', '2014-08-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/edsheeran.jpg', '', 1, 1),
(14, 'daddyyankee', 'kjhekajhksjdhak', 'Daddy', 'Yankee', '1997-01-01', 'male', 'helloworld@gmail.com', '/WEB-PROJECT/public/images/profile-pics/daddyyankee.jpg', '', 1, 1);
=======
(1, 'sushantkc', 'kjhekajhksjdhak', 'Shusant', 'K.C', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/sushantkc.jpg', '', 1, 1),
(2, 'theweekend', 'kjhekajhksjdhak', 'The', 'Weekend', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/theweekend.jpg', '', 1, 1),
(3, 'aakashdhakal', 'helloworld', 'Aakash', 'Dhakal', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/profile.jpeg', '', 0, 1),
(4, 'diwashmainali', 'diwashmainali', 'Diwash', 'Mainali', '2014-08-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/default.jpg', '', 0, 1),
(6, 'celinedion', 'kjhekajhksjdhak', 'Celine', 'Dion', '1997-01-01', 'female', 'helloworld@gmail.com', '/public/images/profile-pics/celinedion.jpg', '', 1, 1),
(7, 'nsync', 'kjhekajhksjdhak', 'Nsync', '', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/nsync.jpg', '', 1, 1),
(8, 'madonna', 'diwashmainali', 'Madonna', '', '2014-08-01', 'female', 'helloworld@gmail.com', '/public/images/profile-pics/madonna.jpg', '', 1, 1),
(9, 'imaginedragons', 'kjhekajhksjdhak', 'Imagine', 'Dragons', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/imaginedragons.jpg', '', 1, 1),
(10, 'djbravo', 'diwashmainali', 'DJ', 'Bravo', '2014-08-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/djbravo.jpg', '', 1, 1),
(11, 'ritviz', 'diwashmainali', 'Ritviz', '', '2014-08-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/ritviz.jpg', '', 1, 1),
(12, 'majorlazer', 'kjhekajhksjdhak', 'Major', 'Lazer', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/majorlazer.jpg', '', 1, 1),
(13, 'edsheerean', 'admin', 'Ed', 'Sheerean', '2014-08-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/edsheeran.jpg', '', 1, 1),
(14, 'daddyyankee', 'kjhekajhksjdhak', 'Daddy', 'Yankee', '1997-01-01', 'male', 'helloworld@gmail.com', '/public/images/profile-pics/daddyyankee.jpg', '', 1, 1),
(16, 'donnoone', 'Hello@123', 'Hello', 'World', '2001-01-12', '', 'slsmets@otpku.com', '/public/images/profile-pics/default.jpg', '', 0, 0),
(17, 'hilubabz', 'Yunika@12', 'Utsarga', 'Manandhar', '2004-11-29', '', 'utsargam44@gmail.com', '/public/images/profile-pics/default.jpg', '', 0, 0),
(28, 'dhakalaakash', 'A@kash123', 'Aakash', 'Dhakal', '2002-12-01', '', 'anamoldhakal22@gmail.com', 'public/images/profile-pics/default.jpg', '', 0, 0);
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `id` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `email` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify_email`
--

<<<<<<< HEAD
INSERT INTO `verify_email` (`id`, `otp`, `username`, `time`) VALUES
(38, 264362, 'aakashdhakal', '2024-11-11 16:59:39'),
(39, 491098, 'aaasdasdasd', '2024-11-12 15:42:06'),
(40, 299002, 'aaasdasdasd', '2024-11-12 15:43:12'),
(41, 300596, 'aaasdasdasd', '2024-11-12 16:00:11'),
(42, 852020, 'aaasdasdasd', '2024-11-12 16:00:47'),
(43, 188165, 'aaasdasdasd', '2024-11-12 16:41:30'),
(44, 888602, 'aaasdasdasd', '2024-11-12 16:42:24'),
(45, 327146, 'aaasdasdasd', '2024-11-12 16:44:07'),
(46, 747292, 'aaasdasdasd', '2024-11-12 16:52:42'),
(47, 585751, 'aaasdasdasd', '2024-11-12 16:55:13'),
(48, 316981, 'aaasdasdasd', '2024-11-12 16:55:47'),
(49, 557918, 'aaasdasdasd', '2024-11-12 16:57:18'),
(50, 146508, 'aaasdasdasd', '2024-11-12 16:58:47'),
(51, 619672, 'aaasdasdasd', '2024-11-12 17:10:22'),
(52, 396798, 'aaasdasdasd', '2024-11-12 17:13:19'),
(53, 704914, 'aaasdasdasd', '2024-11-12 17:16:07'),
(54, 889431, 'aaasdasdasd', '2024-11-12 17:16:15'),
(55, 927197, 'aaasdasdasd', '2024-11-12 17:17:06');
=======
INSERT INTO `verify_email` (`id`, `otp`, `email`, `time`) VALUES
(84, 766468, 'slsmets@otpku.com', '2024-11-21 15:40:09'),
(85, 798115, 'newnoobik@hieuclone.com', '2024-11-21 16:17:59'),
(87, 193010, 'newnoobik@hieuclone.com', '2024-11-21 16:23:59'),
(88, 893635, 'newnoobik@hieuclone.com', '2024-11-21 16:26:18'),
(89, 743085, 'newnoobik@hieuclone.com', '2024-11-21 16:29:01'),
(91, 797223, 'newnoobik@hieuclone.com', '2024-11-21 16:31:40'),
(92, 787291, 'newnoobik@hieuclone.com', '2024-11-21 16:37:00'),
(95, 285024, 'anamoldhakal22@gmail.com', '2024-11-22 01:27:58'),
(96, 744171, 'null', '2024-11-22 01:31:03'),
(97, 818138, 'null', '2024-11-22 01:31:07'),
(98, 772658, 'null', '2024-11-22 01:31:16'),
(102, 325131, 'anamoldhakal22@gmail.com', '2024-11-22 02:58:16'),
(107, 816297, 'ehsonfors@suksesboss.com', '2024-11-28 15:46:54'),
(109, 707731, 'anamoldhakal22@gmail.com', '2024-12-22 18:31:17'),
(111, 947430, 'anamoldhakal22@gmail.com', '2024-12-22 18:35:36'),
(116, 805952, 'anamoldhakal22@gmail.com', '2024-12-22 18:48:01');
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite_songs`
--
ALTER TABLE `favourite_songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music_history`
--
ALTER TABLE `music_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_music_id` (`music_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_playlist_id` (`playlist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite_songs`
--
ALTER TABLE `favourite_songs`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `music_history`
--
ALTER TABLE `music_history`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=716;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee

--
-- Constraints for dumped tables
--

--
-- Constraints for table `music_history`
--
ALTER TABLE `music_history`
  ADD CONSTRAINT `fk_music_id` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `fk_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
