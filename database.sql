-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 04:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL CHECK (`status` in ('Friends','Pending','Not'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user1`, `user2`, `status`) VALUES
(2, 1, 'Friends'),
(1, 3, 'pending');

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
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image`, `isPublic`, `likes`) VALUES
(1, 1, 'Hello my friends', NULL, 1, 0),
(2, 1, 'A private post just for my FRIENDS.', NULL, 0, 0),
(7, 3, 'First post for me', 0x666c6f7765722e6a7067, 1, 0),
(8, 3, 'How To Hack NASA!! ', 0x626c61636b686f6c652e6a7067, 1, 0),
(9, 3, 'My First Post', 0x4361742e6a7067, 1, 0),
(10, 3, 'Hi...', 0x4361742e6a7067, 1, 0),
(11, 3, 'Team Work...', 0x4361742e6a7067, 1, 0);

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
(1, 'Omar', 'Emara', 'Omaremara99@yahoo.com', '0000', '2003-11-22', 'male.png', 'Louran', 'Engaged', 'Omar beeh', 'Male', NULL),
(2, 'Mayar', 'Adel', 'Mayar_Adel@gmail.com', '1111', '1998-6-7', 'female.png', 'Ibrahimia', 'Single', 'Mero', 'Female', '01111111111'),
(3, 'Omar', 'Shalaby', 'ramo_24@outlook.com', '000', '--', 'male.png', '', 'Single', '', 'Male', '01211626853'),
(4, 'Raghda', 'Sallam', 'Raghda.Sallam@gmail.com', '123', '2015-6-6', 'female.png', 'Smouha', 'Single', 'It\'s Raghda', 'Female', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD KEY `usr1` (`user1`),
  ADD KEY `usr2` (`user2`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `usr1` FOREIGN KEY (`user1`) REFERENCES `user_data` (`id`),
  ADD CONSTRAINT `usr2` FOREIGN KEY (`user2`) REFERENCES `user_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
