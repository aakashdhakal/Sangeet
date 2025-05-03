-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 03:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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

INSERT INTO `playlists` (`id`, `user_id`, `name`, `creation_date`, `cover`, `description`, `visibility`) VALUES
(50, 3, 'Aakash\'s Playlist', '2024-07-29', '/WEB-PROJECT/public/images/playlist-cover/3-Aakash\'s Playlist948726.jpeg', '', 'private'),
(52, 3, 'Aakash Dhakal', '2024-08-10', '/WEB-PROJECT/public/images/playlist-cover/3-Aakash Dhakal987246.jpg', '', '');

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
(59, 19, 50),
(60, 1, 50),
(62, 15, 52),
(63, 18, 50),
(64, 22, 50),
(65, 16, 52),
(66, 19, 52);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `music_history`
--
ALTER TABLE `music_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
