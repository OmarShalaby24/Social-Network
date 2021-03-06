-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 10:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user1`, `user2`) VALUES
(27, 3, 2),
(28, 2, 3),
(29, 1, 1),
(30, 2, 2),
(31, 3, 3),
(32, 4, 4),
(33, 9, 9),
(34, 10, 10),
(35, 3, 10),
(36, 10, 3),
(37, 1, 3),
(38, 3, 1),
(39, 9, 3),
(40, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `caption` text DEFAULT NULL,
  `image` varbinary(2000) DEFAULT NULL,
  `isPublic` tinyint(1) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image`, `isPublic`, `likes`, `date_time`) VALUES
(1, 1, 'Happy New Year', NULL, 1, 0, '2020-01-01 00:00:00'),
(2, 1, 'A private post just for my FRIENDS.', NULL, 0, 0, '2020-02-15 11:15:13'),
(7, 1, 'First post for me', 0x666c6f7765722e6a7067, 1, 0, '2020-03-02 07:16:26'),
(8, 4, 'How To Hack NASA!! ', 0x626c61636b686f6c652e6a7067, 1, 0, '2020-03-23 04:50:13'),
(9, 2, 'My First Post', 0x4361742e6a7067, 1, 0, '2020-04-29 23:35:16'),
(10, 3, 'Hi...', 0x4361742e6a7067, 1, 0, '2020-04-20 18:03:08'),
(11, 4, 'Team Work...', 0x4361742e6a7067, 1, 0, '2020-05-07 00:47:28'),
(16, 2, 'Time Test without picture', '', 1, 0, '2020-05-07 00:55:19'),
(17, 1, 'Time \r\nTest\r\nWith\r\nPicture.', 0x68756d737465722e6a7067, 1, 0, '2020-05-07 00:55:43'),
(18, 3, 'Private Post', '', 0, 0, '2020-05-08 13:05:15'),
(19, 2, '', 0x4361742e6a7067, 1, 0, '2020-05-08 13:09:00'),
(20, 2, 'What?!', 0x6b77616c612e6a7067, 1, 0, '2020-05-08 18:22:28'),
(23, 1, '', 0x68756d73746572322e6a7067, 1, 0, '2020-05-08 21:04:03'),
(28, 3, 'First Post', 0x7371756972656c2e6a7067, 1, 0, '2020-05-09 05:13:38'),
(29, 9, 'Eh el community de?', 0x3833343732352d6c617267652d66756e6e792d616e696d616c2d6465736b746f702d6261636b67726f756e64732d3139323078313230302d346b2e6a7067, 1, 0, '2020-05-09 10:34:23'),
(32, 10, 'New Profile Picture', 0x39323636393835375f333034303035383030393334393239365f363437343939383934393139383433303230385f6e2e6a7067, 0, 0, '2020-05-25 22:01:16'),
(33, 3, 'Zeghlooooooooooooooooooooo', 0x39323636393835375f333034303035383030393334393239365f363437343939383934393139383433303230385f6e2e6a7067, 1, 0, '2020-05-25 22:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requester` int(11) DEFAULT NULL,
  `requestee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(360) NOT NULL,
  `password` varchar(50) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `profile_picture` mediumtext DEFAULT NULL,
  `hometown` varchar(20) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `about_me` varchar(20) DEFAULT NULL,
  `gender` varchar(8) NOT NULL,
  `phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `firstname`, `lastname`, `email`, `password`, `birthdate`, `profile_picture`, `hometown`, `marital_status`, `about_me`, `gender`, `phone`) VALUES
(1, 'Omar', 'Emara', 'Omaremara99@yahoo.com', '0000', '2003-11-22', 'humster.jpg', 'Louran', 'Engaged', 'Omar beeh', 'Male', '0123456789'),
(2, 'Mayar', 'Adel', 'Mayar_Adel@gmail.com', '1111', '2020-1-1', 'female.png', 'EL-Ibrahimia', 'Engaged', 'Super Mero', 'Female', '01111111111'),
(3, 'Omar', 'Shalaby', 'ramo_24@outlook.com', '000', '1999-9-24', 'bEkNy5U.jpg', 'El-Dekhela', 'Single', 'Shalaboka', 'Male', '01211626853'),
(4, 'Raghda', 'Sallam', 'Raghda.Sallam@gmail.com', '123', '2015-6-6', 'female.png', 'Smouha', 'Single', 'It\'s Raghda', 'Female', NULL),
(9, 'Omar', 'Faramawy', 'forma@gmail.com', '555', '1999-10-1', 'male.png', NULL, NULL, NULL, 'Male', NULL),
(10, 'Abdel Rahman', 'Zaghloul', 'zeghlo@gmail.com', '123', '1999-10-25', '92669857_3040058009349296_6474998949198430208_n.jpg', NULL, NULL, NULL, 'Male', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usr1` (`requester`),
  ADD KEY `usr2` (`requestee`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user_data` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user_data` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `usr1` FOREIGN KEY (`requester`) REFERENCES `user_data` (`id`),
  ADD CONSTRAINT `usr2` FOREIGN KEY (`requestee`) REFERENCES `user_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
