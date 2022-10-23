-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 09:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `card_id` int(11) NOT NULL,
  `card_name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`card_id`, `card_name`, `image`) VALUES
(1, 'pockemon', '42513405 2.png'),
(2, 'example', 'Screenshot_1.png'),
(3, 'pokemon go', 'Screenshot_2.png'),
(4, 'pockemon me', 'Screenshot_3.png'),
(5, 'new card', 'Screenshot_4.png'),
(6, 'Demo card', 'Screenshot_5.png');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `collection_content_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collection_content_id`, `content`) VALUES
(1, 'This is collection content 1'),
(2, 'this is collection content 2');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `info_content_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`info_content_id`, `content`) VALUES
(1, 'This is information');

-- --------------------------------------------------------

--
-- Table structure for table `main_content`
--

CREATE TABLE `main_content` (
  `main_content_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_content`
--

INSERT INTO `main_content` (`main_content_id`, `content`) VALUES
(1, 'This is demo main content'),
(2, 'This is demo second main content'),
(3, 'This is todays main content..'),
(4, 'Hello everyone welcome to card , good afternoon');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `process_content_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`process_content_id`, `content`) VALUES
(1, 'This is Process Content .');

-- --------------------------------------------------------

--
-- Table structure for table `recent_cards`
--

CREATE TABLE `recent_cards` (
  `recent_content_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recent_cards`
--

INSERT INTO `recent_cards` (`recent_content_id`, `content`) VALUES
(1, 'This is recent content cards'),
(2, 'This are some exciting cards added today , please have a look');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `confirm_password` text NOT NULL,
  `is_admin` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_on` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `confirm_password`, `is_admin`, `created_on`) VALUES
(1, 'Admin', 'admin@cms.com', 'Admin@123', 'Admin@123', 'Y', '2022-10-18'),
(2, 'Demo', 'demo@gmail.com', '123456', '123456', 'N', '2022-10-18'),
(3, 'Shovan Ghorai', 'shovan@gmail.com', '123456', '123456', 'N', '2022-10-18'),
(4, 'sarabindu Dhawa', 'sunny@gmail.com', 'Sunny@123', 'Sunny@123', 'N', '2022-10-19'),
(5, 'demo user', 'demo1@gmail.com', 'dEMO@123', 'dEMO@123', 'N', '2022-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `user_card_details`
--

CREATE TABLE `user_card_details` (
  `user_card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `collected_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_card_details`
--

INSERT INTO `user_card_details` (`user_card_id`, `user_id`, `card_id`, `collected_on`) VALUES
(1, 1, 3, '2022-10-19'),
(2, 1, 5, '2022-10-19'),
(3, 3, 5, '2022-10-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_content_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`info_content_id`);

--
-- Indexes for table `main_content`
--
ALTER TABLE `main_content`
  ADD PRIMARY KEY (`main_content_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`process_content_id`);

--
-- Indexes for table `recent_cards`
--
ALTER TABLE `recent_cards`
  ADD PRIMARY KEY (`recent_content_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_card_details`
--
ALTER TABLE `user_card_details`
  ADD PRIMARY KEY (`user_card_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `info_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `main_content`
--
ALTER TABLE `main_content`
  MODIFY `main_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `process_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recent_cards`
--
ALTER TABLE `recent_cards`
  MODIFY `recent_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_card_details`
--
ALTER TABLE `user_card_details`
  MODIFY `user_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
