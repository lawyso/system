-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2019 at 02:03 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

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
-- Table structure for table `d_courses`
--

DROP TABLE IF EXISTS `d_courses`;
CREATE TABLE IF NOT EXISTS `d_courses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `course_duration` int(11) NOT NULL COMMENT 'course duration in years',
  `course_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_id` (`uid`),
  UNIQUE KEY `UNIQUE_course_name` (`course_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_courses`
--

INSERT INTO `d_courses` (`uid`, `course_name`, `course_duration`, `course_status`) VALUES
(1, 'Master of Education (Educational Administration)', 2, 1),
(2, 'Master of Education (Educational Planning)', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_defense`
--

DROP TABLE IF EXISTS `d_defense`;
CREATE TABLE IF NOT EXISTS `d_defense` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `defender` varchar(100) NOT NULL,
  `defense_date` date NOT NULL,
  `added_date` date NOT NULL,
  `defense_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_title` (`project_title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_defense`
--

INSERT INTO `d_defense` (`uid`, `project_title`, `department`, `faculty`, `defender`, `defense_date`, `added_date`, `defense_status`) VALUES
(1, 'Mumias Sugar Budget Approval System', '8', '4', 'Sharon Atieno', '2019-06-30', '2019-06-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_departments`
--

DROP TABLE IF EXISTS `d_departments`;
CREATE TABLE IF NOT EXISTS `d_departments` (
  `uid` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_tag` int(11) NOT NULL,
  `department_status` int(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `department_name_UNIQUE` (`department_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store departments e.g. public law,private law';

--
-- Dumping data for table `d_departments`
--

INSERT INTO `d_departments` (`uid`, `department_name`, `department_tag`, `department_status`) VALUES
(1, 'Department of Agricultural Economics ', 1, 1),
(2, 'Department of Animal Science ', 1, 1),
(3, 'Agricultural Sciences and Technology', 1, 1),
(4, 'Department of Business Administration', 2, 1),
(5, 'Department of Management Science', 2, 1),
(6, 'Department of Accounting and Finance', 2, 1),
(7, 'Department of Virtual and Open Learning', 3, 1),
(8, 'Department of Computing & Information Technology', 4, 1),
(9, 'Department of Mechanical Engineering', 4, 1),
(10, 'Department of Energy Engineering', 4, 1),
(11, 'Department of Civil Engineering', 4, 1),
(12, 'Department of Electrical & Electronic Engineering', 4, 1),
(13, 'Department of Agricultural and Biosystems Engineering', 4, 1),
(14, 'Department of Educational Psychology', 5, 1),
(15, 'Department of Educational Management Policy & Curriculum Studies', 5, 1),
(16, 'Department of Educational Foundations', 5, 1),
(17, 'Department of Library & Information Science', 5, 1),
(18, 'Department of Early Childhood & Special Needs Education', 5, 1),
(19, 'Department of Hospitality and Tourism Management', 6, 1),
(20, 'Department of Recreation and Sports Management', 6, 1),
(21, 'Department of Public Law', 7, 1),
(22, 'Department of Private Law', 7, 1),
(23, 'Department of Medical Surgical Nursing and Pre-clinical Services', 8, 1),
(24, 'Department of Community and Reproductive Health Nursing', 8, 1),
(25, 'Department ofCommunity Health and Epidemiology', 9, 1),
(26, 'Department of Environmental & Occupational Health', 9, 1),
(27, 'Department of Health Management and Informatics', 9, 1),
(28, 'Department of Population, Reproductive Health & Community Resource Management', 9, 1),
(30, 'Department of Food, Nutrition And Dietetics', 9, 1),
(31, 'Department of Physical Education, Exercise & Sports Science ', 9, 1),
(32, 'Department of Biochemistry, Microbiology and Biotechnology', 10, 1),
(33, 'Department of Chemistry', 10, 1),
(34, 'Department of Mathematics and Actuarial Science', 10, 1),
(35, 'Department of Plant Sciences', 10, 1),
(36, 'Department of Physics ', 10, 1),
(37, 'Department of Zoological Sciences', 10, 1),
(38, 'Department of Architecture and interior design', 11, 1),
(39, 'Department of Spatial Planning and Urban Management', 11, 1),
(40, 'Department of Construction and Real estate Management', 11, 1),
(41, 'Department of Communication, Media, Film & Theatre Studies', 12, 1),
(42, 'Department of Fine Art and Design', 12, 1),
(43, 'Department of Music and Dance', 12, 1),
(44, 'Department of Fashion Design & Marketing ', 12, 1),
(45, 'Department of Applied Economics', 13, 1),
(46, 'Department of Econometrics & Statistics', 13, 1),
(47, 'Department of Economic Theory', 13, 1),
(48, 'Department of Environmental Planning and Management', 14, 1),
(49, 'Department of Environmental Science and Education', 14, 1),
(50, 'Department of Environmental Studies and Community Development', 14, 1),
(51, 'Department of Literature Languages And Linguistics', 15, 1),
(52, 'Department of Geography', 15, 1),
(53, 'Department of Sociology Gender & Development Studies', 15, 1),
(54, 'Department of History & Political Studies', 15, 1),
(55, 'Department of Kiswahili and African Language', 15, 1),
(56, 'Department of Philosophy and Religious Studies', 15, 1),
(57, 'Department of Psychology', 15, 1),
(58, 'Department of Public Policy and Administration (PPA)', 15, 1),
(59, 'Department of Human Anatomy', 16, 1),
(60, 'Department of Pathology', 16, 1),
(61, 'Department of Medical Physiology', 16, 1),
(62, 'Department of Medical Laboratory Sciences', 16, 1),
(63, 'Department of Paediatrics and Child Health', 16, 1),
(64, 'Department of Obstetrics and Gynaecology', 16, 1),
(65, 'Department of Medicine, Therapeutics Psychiatry and Dermatology', 16, 1),
(66, 'Department of Surgery and Orthopaedic', 16, 1),
(67, 'Department of Pharmacognosy, Pharmaceutical Chemistry And Pharmaceutics & Industrial Pharmacy', 17, 1),
(68, 'Department Of Pharmacology And Clinical Pharmacy', 17, 1),
(69, 'Department of Conflict Resolution And International Relations', 18, 1),
(70, 'epartment of Security and Correction Science', 18, 1);

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
  `reset_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_user` (`user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_passes`
--

INSERT INTO `d_passes` (`uid`, `user`, `pass`, `pass_reset_token`, `reset_status`) VALUES
(1, 1, 'MfnveWN*LE1}Uk2>:)Q(AX!Oqk(N}R%M', NULL, 0),
(2, 2, '3|Ngg6W*yogIXTBvhN1KRpw.^6xFvZGh', NULL, 0),
(3, 3, 'Z(Hpq2#H:VD8qaNoU_7wvSynaU_[^~aP', NULL, 0),
(4, 4, 'kB@dyE57BA1t<@hO3]0LPQJsWU]{DGLF', NULL, 0),
(5, 5, '<!P2{gtJ(H<arP<g#xwKlyB<N8<O%S;<', NULL, 0);

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
  `supervisor_1` int(10) DEFAULT NULL,
  `supervisor_2` int(10) DEFAULT NULL,
  `supervisor_3` int(10) DEFAULT NULL,
  `added_date` varchar(25) DEFAULT NULL,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `comments` mediumtext,
  `system_action` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE_title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_proposals`
--

INSERT INTO `d_proposals` (`uid`, `user`, `title`, `area_study`, `proposal_upload`, `status`, `supervisor_1`, `supervisor_2`, `supervisor_3`, `added_date`, `date_modified`, `comments`, `system_action`) VALUES
(5, 2, 'Racial Homogeneity in Portland, Oregon', 'Thank you for using Firefox! We think itâ€™s time to take this relationship to the next level.', 'cnNE7FK2j8.docx', 3, 3, 0, 0, '2019-06-08 11:37:01', '2019-06-11 08:18:17', NULL, 1),
(6, 2, 'Racial Homogeneity in Portland, Oregon2', 'Thank you for using Firefox! We think itâ€™s time to take this relationship to the next level.', 'iRN3txnmP2.pdf', 2, 3, 0, 0, '2019-06-11 08:27:20', '2019-06-11 08:05:21', 'Proposal Pushed to The respective Supervisors for Review by [System] on [2019-06-11 10:29:05].', 1);

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
(5, 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `d_schools`
--

DROP TABLE IF EXISTS `d_schools`;
CREATE TABLE IF NOT EXISTS `d_schools` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(45) NOT NULL,
  `school_status` int(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `school_name_UNIQUE` (`school_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='Store schools e.g. science, agriculture';

--
-- Dumping data for table `d_schools`
--

INSERT INTO `d_schools` (`uid`, `school_name`, `school_status`) VALUES
(1, 'School of Agriculture And Enterprise Developm', 1),
(2, 'School of Business', 1),
(3, 'Digital School of Virtual and Open Learning', 1),
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
(18, 'School of Security,Diplomacy and Peace Studie', 1);

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
  `admission_date` date NOT NULL,
  `department` int(11) DEFAULT NULL,
  `school` int(11) DEFAULT NULL,
  `course_duration` int(11) NOT NULL COMMENT 'course duration in years',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `Unique_id` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users_courses`
--

INSERT INTO `d_users_courses` (`uid`, `user`, `course`, `admission_date`, `department`, `school`, `course_duration`, `status`) VALUES
(1, 2, 1, '2019-06-01', 16, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_users_primary`
--

DROP TABLE IF EXISTS `d_users_primary`;
CREATE TABLE IF NOT EXISTS `d_users_primary` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `title` int(2) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL COMMENT '0-Unspecified, 1-Male, 2-Female ',
  `primary_phone` varchar(20) NOT NULL,
  `primary_email` varchar(85) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `department` int(11) DEFAULT NULL,
  `faculty` int(11) DEFAULT NULL,
  `user_group` int(2) NOT NULL,
  `pass` varchar(245) NOT NULL,
  `added_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `proposal_status` int(1) NOT NULL DEFAULT '0',
  `supervisor_1` int(10) DEFAULT NULL,
  `supervisor_2` int(10) DEFAULT NULL,
  `supervisor_3` int(10) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `primary_phone_UNIQUE` (`primary_phone`) USING BTREE,
  UNIQUE KEY `UNIQUE_username` (`user_name`) USING BTREE,
  UNIQUE KEY `UNIQUE_email` (`primary_email`) USING BTREE,
  UNIQUE KEY `UNIQUE_uid` (`uid`),
  UNIQUE KEY `UNIQUE_nationalId` (`national_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users_primary`
--

INSERT INTO `d_users_primary` (`uid`, `title`, `first_name`, `last_name`, `national_id`, `gender`, `primary_phone`, `primary_email`, `user_name`, `department`, `faculty`, `user_group`, `pass`, `added_date`, `added_by`, `status`, `proposal_status`, `supervisor_1`, `supervisor_2`, `supervisor_3`) VALUES
(1, 1, 'Lawrence', 'Owuor', '29595733', 1, '254704028120', 'lawrence.owuor@gmail.com', 'lawrence.owuor', NULL, NULL, 1, 'a655a9bc5ac68c69aaca037bc6bbb1ccaf42242300bf756486b3030f01ff34b8', '2019-06-04 16:50:03', 1, 1, 0, NULL, NULL, NULL),
(2, 3, 'Sharon', 'Atieno', '30124521', 2, '254706048624', 'sharonotieno78@gmail.com', 'sharon.otieno', 34, 10, 2, '475b36ff9ef320671ccd18a9eb8460cdc5f989e6833a23b62b461653c9bb4a34', '2019-06-04 17:04:06', 1, 1, 2, 3, 0, 0),
(3, 5, 'John', 'Lonyangapuo', '12546872', 1, '254704028121', 'john@g.com', 'john.lonyangapuo', 34, 10, 3, 'addd29945b4dc39844d2792804fbfa2b43079a291165e90f373150090e1c9788', '2019-06-08 09:04:42', 1, 1, 0, NULL, NULL, NULL),
(4, 5, 'Maurice', 'Okoth', '23565492', 1, '254704028123', 'okoth_maurice@gmail.com', 'maurice.okoth', 32, 10, 3, 'a458f36215c0f38b142f54d11f2faf3faa45684d9d202bd206db631389c92777', '2019-06-08 10:31:48', 1, 1, 0, NULL, NULL, NULL),
(5, 4, 'Betty', 'Korir', '24567893', 2, '254717131987', 'betty_korir@yahoo.com', 'betty.korir', 11, 4, 4, 'eb8c2edc097588fcdb0a4161cba49f99e91f4bd4798093de50fe95b694005fc7', '2019-06-11 14:34:59', 1, 1, 0, NULL, NULL, NULL);

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
