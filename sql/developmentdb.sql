-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 06, 2025 at 08:22 PM
-- Server version: 11.7.2-MariaDB-ubu2404
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'shooter'),
(2, 'strategy'),
(3, 'puzzle'),
(4, 'adventure');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `image`, `category_id`) VALUES
(1, 'Counter-Strike 2', 'Find your dream squad to hit Global Elite', 'https://en.wikipedia.org/wiki/Counter-Strike#/media/File:Counter-Strike_vertical_logo_(2023).svg', 1),
(2, 'Fortnite', 'You better get that 4-stack on, we need to crank some 90s in Fortnite OG Season 4', 'https://en.wikipedia.org/wiki/Fortnite#/media/File:FortniteLogo.svg', 1),
(3, 'Valorant ', 'Find a team with the perfect strategy to push to the top this season', 'https://en.wikipedia.org/wiki/Valorant#/media/File:Valorant_logo_-_pink_color_version.svg', 1),
(4, 'Yu-Gi-Oh! Master Duel', 'Find your sparring partnet to test out your deck', 'https://en.wikipedia.org/wiki/Yu-Gi-Oh!_Master_Duel#/media/File:Yu_Gi_Oh_Master_Duel_cover_art_full.jpg', 2),
(5, 'The Binding of Isaac Repentance+', 'Time to get those unlocks in Isaac multiplayer', 'https://en.wikipedia.org/wiki/The_Binding_of_Isaac:_Rebirth#/media/File:The_Binding_of_Issac_Rebirth_cover.jpg', 3),
(6, 'Portal 2', 'Find the perfect puzzle solving mind to pair up with', 'https://en.wikipedia.org/wiki/Portal_2#/media/File:Portal2cover.jpg', 3),
(7, 'Split Fiction', 'Zoe? Mia? let your partner know which one you prefer', 'https://en.wikipedia.org/wiki/Split_Fiction#/media/File:Split_Fiction_cover_art.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `is_read`) VALUES
(1, 1, 2, 'Hey there! How are you?', '2025-04-05 13:44:41', 0),
(4, 3, 1, 'Hello! I’m new here.', '2025-04-05 13:44:41', 0),
(5, 2, 3, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:22:25', 0),
(6, 2, 3, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:46:42', 0),
(8, 3, 1, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:47:51', 0),
(9, 4, 1, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:47:57', 0),
(10, 5, 1, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:48:02', 0),
(11, 1, 4, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:48:11', 0),
(12, 1, 3, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:48:18', 0),
(13, 1, 5, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', '2025-04-06 16:48:26', 0),
(24, 1, 2, 'yeah sure', '2025-04-06 18:27:28', 0),
(25, 1, 2, 'you too?', '2025-04-06 18:27:37', 0),
(26, 1, 5, 'dam wth', '2025-04-06 18:41:38', 0),
(27, 1, 3, 'are you sure?', '2025-04-06 18:43:06', 0),
(28, 1, 4, 'xD', '2025-04-06 18:43:14', 0),
(29, 1, 2, 'johnny johnny let\'s play counter strike', '2025-04-06 19:38:36', 0),
(30, 2, 1, 'nah', '2025-04-06 19:39:01', 0),
(31, 1, 5, 'yes i\'m ready add me discord', '2025-04-06 20:12:17', 0),
(32, 5, 1, 'I\'m down to play some League of Legends instead if you want', '2025-04-06 20:15:18', 0),
(38, 1, 5, 'no way', '2025-04-06 20:20:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `isAdmin`) VALUES
(1, 'username', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'username@password.com', 0),
(2, 'JohnDoe', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'john@user.com', 1),
(3, 'Mike', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'mike@user.com', 0),
(4, 'user1', '$2y$12$Uki9mee.Qk4Kx.C0bGtdgeY9u9s6o9xjS3N6y/4pAxfWZyMqpip8i', 'user3@email.com', 0),
(5, 'username1', '$2y$12$qZYVpsAQmebJL7pbVykfl.E8Y/YhwEtqNqSimcIw7yEXipi//suHm', 'emat@email.com', 0),
(6, '', '$2y$12$i1BaXzW/bbII97vJMV0xW.OK81TcEWqip7Vg/HRRTnGAww0z8q7fK', '', 0),
(7, 'newuser2', '$2y$12$F/fqCWHqk6SUZk8NnJuzUObyPrBJtivsh4x9pmG5X9Mj9P.8Acel6', 'newuser2@users.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_game`
--

CREATE TABLE `user_game` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user_game`
--

INSERT INTO `user_game` (`id`, `user_id`, `game_id`, `description`) VALUES
(13, 2, 3, 'I finally want to finish this game, Chapter 3 start'),
(14, 2, 2, 'anyone want to join with voice chat? i\'m ready to play every evening'),
(15, 2, 1, 'Everybody welcome, we have a nice and welcoming discord server for all'),
(16, 1, 2, 'eEverybody welcome, we have a nice and welcoming discord server for all'),
(17, 1, 3, 'xd'),
(18, 1, 1, 'I AM GOING FOR GLOBAL ELITE, JOIN ME COMRADES'),
(20, 1, 4, 'I AM GOING FOR GLOBAL ELITE, JOIN ME COMRADES'),
(21, 1, 2, 'i love fortnite man');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_sender` (`sender_id`),
  ADD KEY `fk_message_receiver` (`receiver_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_game`
--
ALTER TABLE `user_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_game_user` (`user_id`),
  ADD KEY `fk_user_game_game` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_game`
--
ALTER TABLE `user_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_game`
--
ALTER TABLE `user_game`
  ADD CONSTRAINT `fk_user_game_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
