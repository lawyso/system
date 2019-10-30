-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2019 at 01:14 PM
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
-- Table structure for table `course_durations`
--

DROP TABLE IF EXISTS `course_durations`;
CREATE TABLE IF NOT EXISTS `course_durations` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `duration_name` varchar(30) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_durations`
--

INSERT INTO `course_durations` (`uid`, `duration_name`, `status`) VALUES
(1, '1 Year', 1),
(2, '2 Years', 1),
(3, '3 Years', 1),
(4, '4 Years', 1),
(5, '5 Years', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_courses`
--

DROP TABLE IF EXISTS `d_courses`;
CREATE TABLE IF NOT EXISTS `d_courses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(245) NOT NULL,
  `department_tag` int(11) DEFAULT NULL,
  `school_tag` int(11) DEFAULT NULL,
  `course_duration` int(11) NOT NULL COMMENT 'course duration in years',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_id` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_courses`
--

INSERT INTO `d_courses` (`uid`, `course_name`, `department_tag`, `school_tag`, `course_duration`, `status`) VALUES
(4, 'Master of Education (Educational Administrations)', 16, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_defense`
--

DROP TABLE IF EXISTS `d_defense`;
CREATE TABLE IF NOT EXISTS `d_defense` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(245) NOT NULL,
  `department` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `defender` int(11) NOT NULL,
  `defense_date` date NOT NULL,
  `added_date` date NOT NULL,
  `scheduled_date` datetime DEFAULT NULL,
  `defense_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_title` (`project_title`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_defense`
--

INSERT INTO `d_defense` (`uid`, `project_title`, `department`, `faculty`, `defender`, `defense_date`, `added_date`, `scheduled_date`, `defense_status`) VALUES
(2, 'Social Impact on Mental Status in Educational Behaviourial Enhancements.', '16', '5', 13, '2019-10-18', '2019-10-27', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `d_defense_statuses`
--

DROP TABLE IF EXISTS `d_defense_statuses`;
CREATE TABLE IF NOT EXISTS `d_defense_statuses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_defense_statuses`
--

INSERT INTO `d_defense_statuses` (`uid`, `name`) VALUES
(1, 'Pending Approval'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `d_departments`
--

DROP TABLE IF EXISTS `d_departments`;
CREATE TABLE IF NOT EXISTS `d_departments` (
  `uid` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `status` int(1) DEFAULT '2',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store departments e.g. public law,private law';

--
-- Dumping data for table `d_departments`
--

INSERT INTO `d_departments` (`uid`, `department_name`, `status`) VALUES
(12, 'Department of Electrical & Electronic Engineering', 1),
(13, 'Department of Agricultural and Biosystems Engineering', 1),
(14, 'Department of Educational Psychology', 1),
(15, 'Department of Educational Management Policy & Curriculum Studies', 1),
(16, 'Department of Educational Foundations', 1),
(17, 'Department of Library & Information Science', 1),
(18, 'Department of Early Childhood & Special Needs Education', 1),
(19, 'Department of Hospitality and Tourism Management', 1),
(20, 'Department of Recreation and Sports Management', 1),
(21, 'Department of Public Law', 1),
(22, 'Department of Private Law', 1),
(23, 'Department of Medical Surgical Nursing and Pre-clinical Services', 1),
(24, 'Department of Community and Reproductive Health Nursing', 1),
(25, 'Department ofCommunity Health and Epidemiology', 1),
(26, 'Department of Environmental & Occupational Health', 1),
(27, 'Department of Health Management and Informatics', 1),
(28, 'Department of Population, Reproductive Health & Community Resource Management', 1),
(30, 'Department of Food, Nutrition And Dietetics', 1),
(31, 'Department of Physical Education, Exercise & Sports Science ', 1),
(32, 'Department of Biochemistry, Microbiology and Biotechnology', 1),
(33, 'Department of Chemistry', 1),
(34, 'Department of Mathematics and Actuarial Science', 1),
(35, 'Department of Plant Sciences', 1),
(36, 'Department of Physics ', 1),
(37, 'Department of Zoological Sciences', 1),
(38, 'Department of Architecture and interior design', 1),
(39, 'Department of Spatial Planning and Urban Management', 1),
(40, 'Department of Construction and Real estate Management', 1),
(41, 'Department of Communication, Media, Film & Theatre Studies', 1),
(42, 'Department of Fine Art and Design', 1),
(43, 'Department of Music and Dance', 1),
(44, 'Department of Fashion Design & Marketing ', 1),
(45, 'Department of Applied Economics', 1),
(46, 'Department of Econometrics & Statistics', 1),
(47, 'Department of Economic Theory', 1),
(48, 'Department of Environmental Planning and Management', 1),
(49, 'Department of Environmental Science and Education', 1),
(50, 'Department of Environmental Studies and Community Development', 1),
(51, 'Department of Literature Languages And Linguistics', 1),
(52, 'Department of Geography', 1),
(53, 'Department of Sociology Gender & Development Studies', 1),
(54, 'Department of History & Political Studies', 1),
(55, 'Department of Kiswahili and African Language', 1),
(56, 'Department of Philosophy and Religious Studies', 1),
(57, 'Department of Psychology', 1),
(58, 'Department of Public Policy and Administration (PPA)', 1),
(59, 'Department of Human Anatomy', 1),
(60, 'Department of Pathology', 1),
(61, 'Department of Medical Physiology', 1),
(62, 'Department of Medical Laboratory Sciences', 1),
(63, 'Department of Paediatrics and Child Health', 1),
(64, 'Department of Obstetrics and Gynaecology', 1),
(65, 'Department of Medicine, Therapeutics Psychiatry and Dermatology', 1),
(66, 'Department of Surgery and Orthopaedic', 1),
(67, 'Department of Pharmacognosy, Pharmaceutical Chemistry And Pharmaceutics & Industrial Pharmacy', 1),
(68, 'Department Of Pharmacology And Clinical Pharmacy', 1),
(69, 'Department of Conflict Resolution And International Relations', 1),
(70, 'epartment of Security and Correction Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_emails`
--

DROP TABLE IF EXISTS `d_emails`;
CREATE TABLE IF NOT EXISTS `d_emails` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` varchar(105) DEFAULT NULL,
  `to_user` varchar(105) DEFAULT NULL,
  `subject` varchar(245) DEFAULT NULL,
  `message` mediumtext,
  `attachment` varchar(105) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_email_statuses`
--

DROP TABLE IF EXISTS `d_email_statuses`;
CREATE TABLE IF NOT EXISTS `d_email_statuses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_email_statuses`
--

INSERT INTO `d_email_statuses` (`uid`, `status_name`) VALUES
(1, 'inbox'),
(2, 'sent'),
(3, 'draft'),
(4, 'trash'),
(5, 'deleted');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_passes`
--

INSERT INTO `d_passes` (`uid`, `user`, `pass`, `pass_reset_token`, `expDate`, `reset_status`) VALUES
(1, 1, 'p1f5>Zl}TVUcw6l@^Suh:P_EBU11w5!(', '768e78024aa8fdb9b8fe87be86f647459b9f56b3d0', '2019-10-19 09:26:48', 1),
(14, 14, '|u>ZlpuCdBFa}SwrflEdi7%h!HYN<un~', NULL, NULL, 0),
(13, 13, '.0(^0Bg6{%crA<mj1IR3Cw-B822V*yZC', NULL, NULL, 0),
(12, 12, 'x~:Bc:d0<eg@ZHRA#CNl[|R;GF~Vy1[j', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_proposals`
--

DROP TABLE IF EXISTS `d_proposals`;
CREATE TABLE IF NOT EXISTS `d_proposals` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `area_study` varchar(255) DEFAULT NULL,
  `proposal_upload` varchar(105) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `supervisor_1` varchar(105) DEFAULT NULL,
  `added_date` varchar(25) DEFAULT NULL,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `comments` mediumtext,
  `remarks` mediumtext,
  `system_action` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_proposals`
--

INSERT INTO `d_proposals` (`uid`, `user`, `title`, `area_study`, `proposal_upload`, `status`, `supervisor_1`, `added_date`, `date_modified`, `comments`, `remarks`, `system_action`) VALUES
(11, 13, ' Let your women keep silence in the churches: for it is not permitted to them to speak; but they are commanded to be under obedience as also said the law.', 'But every woman that prayeth or prophesieth with her head uncovered dishonoureth her head: for that is even all one as if she were shaven.', 'lawrenceIDfront.pdf', 2, '12', '2019-10-23 11:27:33', '2019-10-23 11:28:15', 'Proposal Pushed to The respective Supervisors for Review by [System] on [2019-10-23 13:33:13].<br/>Proposal Document [Approved] by [caro.radull] on 2019-10-23 13:52:56 ', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_proposal_statuses`
--

DROP TABLE IF EXISTS `d_proposal_statuses`;
CREATE TABLE IF NOT EXISTS `d_proposal_statuses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_proposal_statuses`
--

INSERT INTO `d_proposal_statuses` (`uid`, `name`) VALUES
(1, 'Pending Approval'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'Closed'),
(5, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `d_schools`
--

DROP TABLE IF EXISTS `d_schools`;
CREATE TABLE IF NOT EXISTS `d_schools` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(245) NOT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `schoolName_UNIQUE` (`school_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Store schools e.g. science, agriculture';

--
-- Dumping data for table `d_schools`
--

INSERT INTO `d_schools` (`uid`, `school_name`, `status`) VALUES
(2, 'School of Business', 1),
(4, 'School of Engineering And Technology', 1),
(5, 'School of Education', 1),
(6, 'School of Hospitality Tourism and Leisure Stu', 1),
(7, 'School of Law', 1),
(8, 'School of Nursing', 1),
(9, 'School of Public Health and Applied Human Sci', 1),
(10, 'School of Pure And Applied Sciences', 1),
(11, 'School of Architecture and the Built Environm', 1),
(12, 'School of Creative and Performing Arts, Film ', 1),
(13, 'School of Economics', 1),
(14, 'School of Environmental Studies', 1),
(15, 'School of Humanities & Social Sciences', 1),
(16, 'School of Medicine', 1),
(17, 'School of Pharmacy ', 1),
(18, 'School of Security,Diplomacy and Peace Studie', 1),
(19, 'School of Thoughts', 2);

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
-- Table structure for table `d_users_courses`
--

DROP TABLE IF EXISTS `d_users_courses`;
CREATE TABLE IF NOT EXISTS `d_users_courses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  `admission_date` datetime NOT NULL,
  `department` int(11) DEFAULT NULL,
  `school` int(11) DEFAULT NULL,
  `course_duration` int(11) NOT NULL COMMENT 'course duration in years',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `Unique_id` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users_courses`
--

INSERT INTO `d_users_courses` (`uid`, `user`, `course`, `admission_date`, `department`, `school`, `course_duration`, `status`) VALUES
(10, 13, 4, '2019-10-28 00:00:00', 16, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_users_primary`
--

DROP TABLE IF EXISTS `d_users_primary`;
CREATE TABLE IF NOT EXISTS `d_users_primary` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `title` int(2) DEFAULT NULL,
  `profile_upload` varchar(105) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL COMMENT '0-Unspecified, 1-Male, 2-Female ',
  `primary_phone` varchar(20) NOT NULL,
  `primary_email` varchar(85) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `department` int(11) DEFAULT NULL,
  `faculty` int(11) DEFAULT NULL,
  `supervisor` varchar(105) DEFAULT NULL,
  `user_group` int(2) NOT NULL,
  `pass` varchar(245) NOT NULL,
  `added_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `proposal_status` int(1) NOT NULL DEFAULT '0',
  `pass_change` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `primary_phone_UNIQUE` (`primary_phone`) USING BTREE,
  UNIQUE KEY `UNIQUE_username` (`user_name`) USING BTREE,
  UNIQUE KEY `UNIQUE_email` (`primary_email`) USING BTREE,
  UNIQUE KEY `UNIQUE_uid` (`uid`),
  UNIQUE KEY `UNIQUE_nationalId` (`national_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users_primary`
--

INSERT INTO `d_users_primary` (`uid`, `title`, `profile_upload`, `first_name`, `last_name`, `national_id`, `gender`, `primary_phone`, `primary_email`, `user_name`, `department`, `faculty`, `supervisor`, `user_group`, `pass`, `added_date`, `added_by`, `status`, `proposal_status`, `pass_change`) VALUES
(1, 1, 'logo.png', 'Lawrence', 'Owuor', '29595733', 1, '254704028120', 'lawrence.owuor@gmail.com', 'lawrence.owuor', NULL, NULL, NULL, 1, 'fa95e1b2a1b9f1aadf2964f54aa9976a8265ca0ccac5bcd64930ba1e5fa4666b', '2019-06-04 16:50:03', 1, 1, 0, 0),
(12, 4, NULL, 'Carol', 'Radull', '28565425', 2, '254704032201', 'caro_dni@gmail.com', 'caro.radull', 16, 5, NULL, 3, 'b8298a1c9a2b1aad68a7f2bd0e1ca6636bf1c03dc3b3d7020a4e1539bbefc235', '2019-10-23 10:33:50', 1, 1, 0, 0),
(13, 1, NULL, 'Masese', 'Juma', '12345678', 1, '254715204028', 'masesejuma@gmail.com', 'masese.juma', 16, 5, '12', 2, 'eed647b128524f02d2d1fbfa6c706d1248890d3b1c28ef8e8270a257e8b7d9df', '2019-10-23 10:35:22', 1, 1, 2, 0),
(14, 4, NULL, 'Betty', 'Korir', '26989264', 2, '254701486720', 'betty_korir@mymail.com', 'betty.korir', 16, 5, NULL, 4, '8e730cf2b57294fa20e80a0483ec6ae4cd39051aa89788e557d2655653df9bdb', '2019-10-28 11:29:04', 1, 1, 0, 0);

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
(1, 'Super Admin', 1),
(2, 'Student', 1),
(3, 'Supervisor', 1),
(4, 'HOD', 1),
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
