-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2015 at 10:59 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE IF NOT EXISTS `tutorials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `title`, `created`, `modified`, `status`) VALUES
(3, 'Mobile device detection in PHP', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(4, 'Create custom helper in CodeIgniter', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(5, 'Convert array to XML in PHP', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(6, 'Add Remove input fields dynamically using jQuery', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(7, 'Add page, content and menu in Drupal 7', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(8, 'Like Dislike rating system with jQuery, Ajax and PHP', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(9, 'Upload image and create thumbnail using PHP', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(10, 'Create Custom Shortcode in WordPress Post, Page and Plugin', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(11, 'Alert Dialog Box using jQuery and CSS', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1),
(12, 'CakePHP Tutorial for Beginners', '2015-02-04 00:00:00', '2015-02-04 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
