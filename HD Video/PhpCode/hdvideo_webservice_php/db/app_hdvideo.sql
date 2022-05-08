-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2015 at 07:57 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app_hdvideo`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_verify`
--

CREATE TABLE IF NOT EXISTS `app_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer` varchar(255) NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_verify`
--

INSERT INTO `app_verify` (`id`, `buyer`, `purchase_code`, `status`) VALUES
(1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'adminq1w2', 'viaviwebtech@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`) VALUES
(17, 'Natural', '52129_natural.jpg'),
(18, 'Baby', '79278_baby.jpg'),
(19, 'Technology', '94991_technology.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `video_duration` varchar(255) NOT NULL,
  `video_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id`, `cat_id`, `video_title`, `video_url`, `video_id`, `video_duration`, `video_description`) VALUES
(83, 17, 'Natural Wonders', 'http://www.youtube.com/watch?v=PiWO-c6mst0', 'PiWO-c6mst0', '2.28', 'From strange alien landscapes to the Gates of Hell, here are 10 natural wonders you might not have heard of.'),
(84, 17, 'Beautiful Nature', 'http://www.youtube.com/watch?v=xI3COCJlmTU', 'xI3COCJlmTU', '2.49', 'Beautiful Nature Video Ever'),
(85, 17, 'Planet Earth', 'http://www.youtube.com/watch?v=6v2L2UGZJAM', '6v2L2UGZJAM', '13.29', 'Natural History Unit. After I have watched all eleven episodes'),
(86, 18, 'Funny Baby ', 'http://www.youtube.com/watch?v=N0TpQ62mcvQ', 'N0TpQ62mcvQ', '3.06', 'Funny Baby Laughing Video Compilation'),
(87, 18, 'Evian Roller Babies', 'http://www.youtube.com/watch?v=XQcVllWpwGs', 'XQcVllWpwGs', '1.01', 'iscover the new evian film baby on'),
(88, 18, 'Baby Playing ', 'http://www.youtube.com/watch?v=O6arYAasPFE', 'O6arYAasPFE', '1.06', 'Enjoy this cute video showing baby playing with ball and baby laughing hysterically at mom.'),
(89, 19, 'Future Technology ', 'http://www.youtube.com/watch?v=cYPqZ_SJCjw', 'cYPqZ_SJCjw', '2.27', 'Top 10 Future Technology That Exist Today'),
(90, 19, 'Wifi hotspot ', 'https://www.youtube.com/watch?v=lxCD6QGfOAc', 'lxCD6QGfOAc', '3.59', 'A hotspot is a site that offers Internet access over a wireless local area network (WLAN) through the use of a router connected to a link to an Internet service provider. Hotspots typically use Wi-Fi technology.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
