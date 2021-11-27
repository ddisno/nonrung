-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2017 at 09:32 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(100) NOT NULL,
  `img_link` varchar(100) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `img_name`, `img_link`, `img_path`) VALUES
(7, 'photo8@2x.jpg', 'uploads/photo8@2x.jpg', '1'),
(8, 'photo7.jpg', 'uploads/photo7.jpg', '1'),
(5, 'photo2@2x.jpg', 'uploads/photo2@2x.jpg', '1'),
(10, 'photo3.jpg', 'uploads/photo3.jpg', '1'),
(11, 'photo2@2x.jpg', 'uploads/photo2@2x.jpg', '1'),
(12, 'photo10.jpg', 'uploads/photo10.jpg', '1'),
(13, 'photo10.jpg', 'uploads/photo10.jpg', '1'),
(14, 'photo2@2x.jpg', 'uploads/photo2@2x.jpg', '1'),
(15, 'photo10.jpg', 'uploads/photo10.jpg', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
