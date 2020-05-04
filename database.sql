-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2020 at 09:44 PM
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
  `poster_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image`, `isPublic`, `poster_name`) VALUES
(1, 1, 'Hello my friends', NULL, 1, NULL),
(2, 1, 'A private post just for my FRIENDS.', NULL, 0, NULL);

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
  `profile_picture` varchar(2000) DEFAULT NULL,
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
(1, 'Omar', 'Emara', 'Omaremara99@yahoo.com', '0000', '2003-11-22', NULL, NULL, NULL, NULL, 'Male', NULL),
(2, 'Mayar', 'Adel', 'Mayar_Adel@gmail.com', '1111', '1998-6-7', 'female.png', NULL, NULL, NULL, 'female', NULL),
(3, 'Omar', 'Shalaby', 'ramo_24@outlook.com', '000', '1999-9-24', 'male.png', 'El-Dekhela', 'Single', 'My bio...', 'male', '01211626853'),
(4, 'Raghda', 'Sallam', 'Raghda.Sallam@gmail.com', '123', '2015-6-6', NULL, NULL, NULL, NULL, 'Female', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
