-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2014 at 11:08 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Unibox`
--

-- --------------------------------------------------------

--
-- Table structure for table `degreeCourse`
--

CREATE TABLE IF NOT EXISTS `degreeCourse` (
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degreeCourse`
--

INSERT INTO `degreeCourse` (`name`, `department`) VALUES
('Ingegneria Informatica', 'DISIM'),
('Ingegneria Meccanica', '');

-- --------------------------------------------------------

--
-- Table structure for table `degreeCourses_Subjects`
--

CREATE TABLE IF NOT EXISTS `degreeCourses_Subjects` (
  `degreeCourse` varchar(50) NOT NULL,
  `subjectCode` int(11) NOT NULL,
  PRIMARY KEY (`degreeCourse`,`subjectCode`),
  KEY `degreeCourses_Subjects_ibfk_2` (`subjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degreeCourses_Subjects`
--

INSERT INTO `degreeCourses_Subjects` (`degreeCourse`, `subjectCode`) VALUES
('Ingegneria Informatica', 1),
('Ingegneria Meccanica', 1),
('Ingegneria Informatica', 2),
('Ingegneria Meccanica', 2),
('Ingegneria Informatica', 3),
('Ingegneria Informatica', 4),
('Ingegneria Informatica', 5),
('Ingegneria Meccanica', 6),
('Ingegneria Meccanica', 7);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `subjectCode` int(11) NOT NULL,
  `uploaderUsername` varchar(50) NOT NULL,
  `type` varchar(200) NOT NULL,
  `difficultyScore` float NOT NULL,
  `qualityScore` float NOT NULL,
  `path` varchar(500) NOT NULL,
  `uploadingDate` datetime NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `downloadsNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_ibfk_1` (`uploaderUsername`),
  KEY `resource_ibfk_2` (`subjectCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `resources_difficultyScores`
--

CREATE TABLE IF NOT EXISTS `resources_difficultyScores` (
  `resourceId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `difficultyScore` int(11) NOT NULL,
  PRIMARY KEY (`resourceId`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources_scores`
--

CREATE TABLE IF NOT EXISTS `resources_scores` (
  `resourceId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`resourceId`,`username`),
  KEY `resourceId` (`resourceId`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`code`, `name`) VALUES
(1, 'Analisi 1'),
(2, 'Fisica 1'),
(3, 'Analisi 2'),
(4, 'Fisica 2'),
(5, 'Fondamenti di Informatica'),
(6, 'Chimica'),
(7, 'Meccanica dei Fluidi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `degreeCourse` varchar(50) DEFAULT NULL,
  `reliability` float NOT NULL,
  PRIMARY KEY (`username`),
  KEY `user_ibfk_1` (`degreeCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `surname`, `password`, `email`, `degreeCourse`, `reliability`) VALUES
('dav', 'davide', 'cristini', 'asd', 'dav@mail.it', 'Ingegneria Informatica', 0),
('davcri', 'Davide', 'Cristini', 'asd', 'dav@mail.it', 'Ingegneria Informatica', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `degreeCourses_Subjects`
--
ALTER TABLE `degreeCourses_Subjects`
  ADD CONSTRAINT `degreeCourses_Subjects_ibfk_1` FOREIGN KEY (`degreeCourse`) REFERENCES `degreeCourse` (`name`),
  ADD CONSTRAINT `degreeCourses_Subjects_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`);

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`uploaderUsername`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `resource_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`);

--
-- Constraints for table `resources_difficultyScores`
--
ALTER TABLE `resources_difficultyScores`
  ADD CONSTRAINT `resources_difficultyScores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `resources_difficultyScores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`);

--
-- Constraints for table `resources_scores`
--
ALTER TABLE `resources_scores`
  ADD CONSTRAINT `resources_scores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `resources_scores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`degreeCourse`) REFERENCES `degreeCourse` (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
