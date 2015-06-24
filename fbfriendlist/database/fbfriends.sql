-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2015 at 05:06 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fbfriends`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFriends`(IN userid INT(11))
BEGIN
 SELECT name,oauth_fid
 FROM `fbfriends`.`friendslist`
 WHERE uid = userid;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `friendslist`
--

CREATE TABLE IF NOT EXISTS `friendslist` (
  `fid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `oauth_fid` varchar(200) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `friendslist`
--

INSERT INTO `friendslist` (`fid`, `uid`, `name`, `oauth_fid`) VALUES
(5, 34, 'Vasan Devpurpose', '111297065875526');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `oauth_uid` varchar(200) NOT NULL,
  `oauth_provider` varchar(200) NOT NULL,
  `facebookurl` varchar(255) NOT NULL,
  `total_friends` bigint(20) NOT NULL,
  `app_shared_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `name`, `email`, `created`, `last_activity`, `oauth_uid`, `oauth_provider`, `facebookurl`, `total_friends`, `app_shared_by`) VALUES
(34, 'Seeni Vasan', 'Seeni Vasan', 'rsv0309@gmail.com', '2015-06-23 02:58:07', '2015-06-23 03:38:49', '858422174244613', 'facebook', 'https://www.facebook.com/app_scoped_user_id/858422174244613/', 152, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
