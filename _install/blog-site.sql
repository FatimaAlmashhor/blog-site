-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 07:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(11) NOT NULL,
  `auth_email` varchar(255) NOT NULL,
  `auth_password` varchar(255) NOT NULL,
  `auth_type` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `auth_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`auth_id`, `auth_email`, `auth_password`, `auth_type`, `is_active`, `auth_name`) VALUES
(2, 'fatima@gmail.com', '$2y$10$qviSFcUsMJ5S7r1KOfZ2lOfgGwe/92ixkJcLu6mWim3C5wjzLHcW.', 0, 0, 'Fatima');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_body` text NOT NULL,
  `created_at` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `auth_keys` text NOT NULL,
  `blog_des` text NOT NULL,
  `blog_image` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_body`, `created_at`, `is_active`, `category_id`, `auth_keys`, `blog_des`, `blog_image`, `tags`) VALUES
(10, 'othe blog', 'I am doing great job', '0000-00-00', 1, 3, '', 'this is the other blog as well', '', ''),
(11, 'here somthing', '<p>dfdfdfsdf</p>', '2022-03-21', 1, 3, '', 'dfsdfsdf', '', ''),
(12, 'Test', '<p style=\"text-align:center\"><span style=\"color:#e67e22\"><span style=\"font-size:48px\"><strong>Fatima Amin</strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#16a085\">This is just for test and so on </span></p>', '2022-03-22', 1, 3, '', 'here something I need to show', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `category_sub_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `is_active`, `category_sub_id`) VALUES
(3, 'Web', 1, NULL),
(4, 'mobile app', 1, NULL),
(7, 'React', 1, 3),
(8, 'Vue', 1, 3),
(9, 'UI/UX', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_sub_id` (`category_sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`category_sub_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
