-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2014 at 03:07 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ytetonghop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TieuDe` varchar(256) DEFAULT NULL,
  `Video` varchar(256) DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  `ThongtincoquanId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`Id`, `TieuDe`, `Video`, `TrangThai`, `ThongtincoquanId`) VALUES
(1, 'video moi', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 1, 6),
(2, 'ggg', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 1, 6),
(3, 'afsdf', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(4, 'hfhfg', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(5, 'fgjgj', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(6, 'afsdf', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(7, 'afsdf', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(8, 'fghdfg', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(9, 'fghdfg', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(10, 'kkkk', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 0, 6),
(11, 'fadfs', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 1, 6),
(12, 'aaaaaaaaaaaaaaaaa', '', 0, 6),
(13, 'ggggggggg', 'teenage-mutant-ninja-turtles-_-official-tv-spot-_5-(2014)-[hd].mp4', 0, 6),
(14, 'fadfs22222222', NULL, 1, 6),
(15, 'ggggggggg12', NULL, 0, 6),
(16, 'aaaaaaaaaaaaaaaaa191', 'the-flash-_-teaser-_-arrow-meets-the-flash.mp4', 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
