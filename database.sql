-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2020 at 12:57 AM
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
  `likes` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image`, `isPublic`, `likes`, `date_time`) VALUES
(1, 1, 'Happy New Year', NULL, 1, 0, '2020-01-01 00:00:00'),
(2, 1, 'A private post just for my FRIENDS.', NULL, 0, 0, '2020-02-15 11:15:13'),
(7, 3, 'First post for me', 0x666c6f7765722e6a7067, 1, 0, '2020-03-02 07:16:26'),
(8, 3, 'How To Hack NASA!! ', 0x626c61636b686f6c652e6a7067, 1, 0, '2020-03-23 04:50:13'),
(9, 3, 'My First Post', 0x4361742e6a7067, 1, 0, '2020-04-29 23:35:16'),
(10, 3, 'Hi...', 0x4361742e6a7067, 1, 0, '2020-04-20 18:03:08'),
(11, 3, 'Team Work...', 0x4361742e6a7067, 1, 0, '2020-05-07 00:47:28'),
(16, 3, 'Time Test without picture', '', 1, 0, '2020-05-07 00:55:19'),
(17, 3, 'Time \r\nTest\r\nWith\r\nPicture.', 0x68756d737465722e6a7067, 1, 0, '2020-05-07 00:55:43');

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
(3, 'Omar', 'Shalaby', 'ramo_24@outlook.com', '000', '1999-9-24', 'male.png', '', 'Single', '', 'Male', '01211626853'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
