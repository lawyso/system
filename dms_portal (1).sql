-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2019 at 01:39 PM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dms_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_comments`
--

DROP TABLE IF EXISTS `d_comments`;
CREATE TABLE IF NOT EXISTS `d_comments` (
  `comment_id` int(20) NOT NULL AUTO_INCREMENT,
  `u_code` varchar(20) DEFAULT NULL,
  `comment` longtext,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `directed_to` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `id_UNIQUE` (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_passes`
--

DROP TABLE IF EXISTS `d_passes`;
CREATE TABLE IF NOT EXISTS `d_passes` (
  `uid` int(20) NOT NULL AUTO_INCREMENT,
  `user` int(20) NOT NULL,
  `pass` varchar(245) NOT NULL,
  `pass_reset_token` varchar(245) DEFAULT NULL,
  `expDate` datetime DEFAULT NULL,
  `reset_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_user` (`user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_passes`
--

INSERT INTO `d_passes` (`uid`, `user`, `pass`, `pass_reset_token`, `expDate`, `reset_status`) VALUES
(1, 1, 'H.*iZX)[CnO>LUZfuspWYl[l<}S7.i9{', '768e78024aa8fdb9b8fe87be86f647459b9f56b3d0', '2019-10-19 09:26:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_progress_stages`
--

DROP TABLE IF EXISTS `d_progress_stages`;
CREATE TABLE IF NOT EXISTS `d_progress_stages` (
  `uid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_progress_stages`
--

INSERT INTO `d_progress_stages` (`uid`, `name`) VALUES
(1, 'Progressing'),
(2, 'Completed'),
(3, 'Delayed');

-- --------------------------------------------------------

--
-- Table structure for table `d_title`
--

DROP TABLE IF EXISTS `d_title`;
CREATE TABLE IF NOT EXISTS `d_title` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `Unique_name` (`name`),
  UNIQUE KEY `Unique_id` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_title`
--

INSERT INTO `d_title` (`uid`, `name`, `status`) VALUES
(1, 'Mr', 1),
(2, 'Mrs', 1),
(3, 'Miss', 1),
(4, 'Doctor', 1),
(5, 'Professor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_topics`
--

DROP TABLE IF EXISTS `d_topics`;
CREATE TABLE IF NOT EXISTS `d_topics` (
  `topic_id` int(20) NOT NULL AUTO_INCREMENT,
  `topic_name` mediumtext,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `id_UNIQUE` (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_topic_statuses`
--

DROP TABLE IF EXISTS `d_topic_statuses`;
CREATE TABLE IF NOT EXISTS `d_topic_statuses` (
  `uid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `uid_2` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_topic_statuses`
--

INSERT INTO `d_topic_statuses` (`uid`, `name`) VALUES
(0, 'Pending Approval'),
(1, 'Approved'),
(2, 'Rejected'),
(3, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `d_uni_codes`
--

DROP TABLE IF EXISTS `d_uni_codes`;
CREATE TABLE IF NOT EXISTS `d_uni_codes` (
  `u_code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`u_code`),
  UNIQUE KEY `u_code_UNIQUE` (`u_code`),
  UNIQUE KEY `name_UNIQUE` (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_uni_codes`
--

INSERT INTO `d_uni_codes` (`u_code`, `name`, `status`) VALUES
('DMS/001', 'University of Eldoret', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_uploads`
--

DROP TABLE IF EXISTS `d_uploads`;
CREATE TABLE IF NOT EXISTS `d_uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_code` varchar(20) DEFAULT NULL,
  `filename` varchar(150) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `directed_to` int(20) DEFAULT NULL,
  `upload_path` varchar(105) DEFAULT NULL,
  PRIMARY KEY (`upload_id`),
  UNIQUE KEY `upload_id` (`upload_id`),
  UNIQUE KEY `upload_id_2` (`upload_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_users_primary`
--

DROP TABLE IF EXISTS `d_users_primary`;
CREATE TABLE IF NOT EXISTS `d_users_primary` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `u_code` varchar(20) DEFAULT NULL,
  `title` int(2) DEFAULT NULL,
  `profile_upload` varchar(105) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL COMMENT '0-Unspecified, 1-Male, 2-Female ',
  `primary_phone` varchar(20) NOT NULL,
  `primary_email` varchar(85) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `Reg_No` varchar(50) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT '0',
  `user_group` int(2) NOT NULL,
  `pass` varchar(245) NOT NULL,
  `registerDate` datetime DEFAULT NULL,
  `added_by` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `topic_id` int(50) DEFAULT '0',
  `progress_stage` int(11) DEFAULT '0',
  `pass_change` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `primary_phone_UNIQUE` (`primary_phone`) USING BTREE,
  UNIQUE KEY `UNIQUE_username` (`user_name`) USING BTREE,
  UNIQUE KEY `UNIQUE_email` (`primary_email`) USING BTREE,
  UNIQUE KEY `UNIQUE_uid` (`uid`),
  UNIQUE KEY `UNIQUE_nationalId` (`national_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users_primary`
--

INSERT INTO `d_users_primary` (`uid`, `u_code`, `title`, `profile_upload`, `first_name`, `last_name`, `national_id`, `gender`, `primary_phone`, `primary_email`, `user_name`, `Reg_No`, `supervisor_id`, `user_group`, `pass`, `registerDate`, `added_by`, `status`, `topic_id`, `progress_stage`, `pass_change`) VALUES
(1, 'DMS/001', 1, 'logo.png', 'Lawrence', 'Owuor', '29595733', 1, '254704028120', 'lawrence.owuor@gmail.com', 'lawrence.owuor', 'UOE2046/356', 0, 1, '761c99c2c843986bca57b27bd641ba90d25abe36b3fc5c810f7863c3ab7038d6', '2019-06-04 16:50:03', 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_user_groups`
--

DROP TABLE IF EXISTS `d_user_groups`;
CREATE TABLE IF NOT EXISTS `d_user_groups` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  `group_status` int(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_id` (`uid`),
  UNIQUE KEY `UNIQUE_group_name` (`group_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_user_groups`
--

INSERT INTO `d_user_groups` (`uid`, `group_name`, `group_status`) VALUES
(1, 'System Administrator', 1),
(2, 'Student', 1),
(3, 'Lecturer', 1),
(4, 'University Administrator', 1),
(5, 'Registrar Academics', 1),
(6, 'DVC Graduate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_user_status`
--

DROP TABLE IF EXISTS `d_user_status`;
CREATE TABLE IF NOT EXISTS `d_user_status` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_user_status`
--

INSERT INTO `d_user_status` (`uid`, `status_name`, `status`) VALUES
(1, 'Active', 1),
(2, 'Blocked', 1),
(3, 'Former', 1),
(4, 'Inactive', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
