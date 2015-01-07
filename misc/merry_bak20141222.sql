-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2014 at 06:14 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `merry`
--

-- --------------------------------------------------------

--
-- Table structure for table `choises`
--

CREATE TABLE IF NOT EXISTS `choises` (
  `user_id` varchar(20) NOT NULL DEFAULT '0',
  `part_id` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choises`
--

INSERT INTO `choises` (`user_id`, `part_id`) VALUES
('1', 1),
('10', 1),
('100', 1),
('2', 3),
('3', 3),
('chii', 1),
('sasa', 1),
('test', 1),
('zenno', 2);

-- --------------------------------------------------------

--
-- Table structure for table `entrys`
--

CREATE TABLE IF NOT EXISTS `entrys` (
  `entry_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hair_id` int(1) NOT NULL,
  `part_id` int(1) NOT NULL,
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`entry_timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrys`
--

INSERT INTO `entrys` (`entry_timestamp`, `hair_id`, `part_id`, `user_id`) VALUES
('2014-12-01 11:21:07', 2, 2, 'zenno'),
('2014-12-13 11:37:29', 2, 2, 'zenno'),
('2014-12-14 11:22:53', 2, 2, 'zenno'),
('2014-12-14 11:22:59', 2, 2, 'zenno'),
('2014-12-14 11:23:02', 2, 2, 'zenno'),
('2014-12-14 11:23:05', 2, 2, 'zenno'),
('2014-12-14 11:23:18', 2, 2, 'zenno'),
('2014-12-14 11:23:21', 2, 2, 'zenno'),
('2014-12-14 11:23:29', 2, 2, 'zenno'),
('2014-12-14 11:23:31', 2, 2, 'zenno'),
('2014-12-14 11:23:34', 2, 2, 'zenno'),
('2014-12-14 11:23:36', 2, 2, 'zenno'),
('2014-12-14 11:23:37', 2, 2, 'zenno'),
('2014-12-14 11:23:38', 2, 2, 'zenno'),
('2014-12-14 11:23:40', 2, 2, 'zenno'),
('2014-12-14 16:01:42', 3, 2, 'zenno'),
('2014-12-14 16:01:44', 1, 2, 'zenno'),
('2014-12-14 16:01:46', 2, 2, 'zenno'),
('2014-12-14 16:01:48', 3, 2, 'zenno'),
('2014-12-14 16:01:52', 2, 2, 'zenno'),
('2014-12-14 16:01:53', 3, 2, 'zenno'),
('2014-12-14 16:01:55', 1, 2, 'zenno'),
('2014-12-14 16:01:58', 3, 2, 'zenno'),
('2014-12-14 16:02:04', 1, 2, 'zenno');

-- --------------------------------------------------------

--
-- Table structure for table `hairs`
--

CREATE TABLE IF NOT EXISTS `hairs` (
  `hair_id` int(1) NOT NULL AUTO_INCREMENT,
  `hair_length` int(1) NOT NULL,
  PRIMARY KEY (`hair_id`),
  UNIQUE KEY `hair_length` (`hair_length`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hairs`
--

INSERT INTO `hairs` (`hair_id`, `hair_length`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `part_id` int(1) NOT NULL AUTO_INCREMENT,
  `part_name` varchar(30) NOT NULL,
  PRIMARY KEY (`part_id`),
  UNIQUE KEY `part_name` (`part_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`part_id`, `part_name`) VALUES
(3, 'あし'),
(2, 'うで'),
(1, 'わき');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_pw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_cryptodate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_pw`, `user_cryptodate`) VALUES
('1', 'xFKbViIp1BM', '2014-12-13 08:31:46'),
('10', 'o4A4hgCvJyU', '2014-12-18 02:00:32'),
('100', 'xFKbViIp1BM', '2014-12-13 08:37:17'),
('2', 'xE6022Wl/7k', '2014-12-13 08:32:26'),
('3', '8lPkB2Y/gEE', '2014-12-21 08:52:14'),
('chii', 'xFKbViIp1BM', '2014-12-13 08:33:39'),
('sasa', 'xFKbViIp1BM', '2014-12-13 08:35:11'),
('test', 'xFKbViIp1BM', '2014-12-13 08:36:55'),
('zenno', 'Ym8Qj/zqgEc', '2014-12-13 09:03:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
