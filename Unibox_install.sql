-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2014 at 10:12 AM
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
('Ingegneria Automatica', ''),
('Ingegneria Chimica', ''),
('Ingegneria delle Telecomunicazioni', ''),
('Ingegneria Elettronica', ''),
('Ingegneria Gestionale', ''),
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
('Ingegneria Automatica', 1),
('Ingegneria Chimica', 1),
('Ingegneria delle Telecomunicazioni', 1),
('Ingegneria Elettronica', 1),
('Ingegneria Gestionale', 1),
('Ingegneria Informatica', 1),
('Ingegneria Meccanica', 1),
('Ingegneria Automatica', 2),
('Ingegneria Chimica', 2),
('Ingegneria delle Telecomunicazioni', 2),
('Ingegneria Elettronica', 2),
('Ingegneria Gestionale', 2),
('Ingegneria Informatica', 2),
('Ingegneria Meccanica', 2),
('Ingegneria Automatica', 3),
('Ingegneria Chimica', 3),
('Ingegneria delle Telecomunicazioni', 3),
('Ingegneria Elettronica', 3),
('Ingegneria Gestionale', 3),
('Ingegneria Informatica', 3),
('Ingegneria Meccanica', 3),
('Ingegneria Automatica', 4),
('Ingegneria Chimica', 4),
('Ingegneria delle Telecomunicazioni', 4),
('Ingegneria Elettronica', 4),
('Ingegneria Gestionale', 4),
('Ingegneria Informatica', 4),
('Ingegneria Meccanica', 4),
('Ingegneria Automatica', 5),
('Ingegneria delle Telecomunicazioni', 5),
('Ingegneria Elettronica', 5),
('Ingegneria Gestionale', 5),
('Ingegneria Informatica', 5),
('Ingegneria Chimica', 6),
('Ingegneria Gestionale', 6),
('Ingegneria Meccanica', 6),
('Ingegneria Meccanica', 7),
('Ingegneria Automatica', 8),
('Ingegneria delle Telecomunicazioni', 8),
('Ingegneria Elettronica', 8),
('Ingegneria Informatica', 8),
('Ingegneria delle Telecomunicazioni', 9),
('Ingegneria Informatica', 10),
('Ingegneria Informatica', 11),
('Ingegneria Automatica', 12),
('Ingegneria Chimica', 12),
('Ingegneria delle Telecomunicazioni', 12),
('Ingegneria Elettronica', 12),
('Ingegneria Informatica', 12),
('Ingegneria Automatica', 13),
('Ingegneria delle Telecomunicazioni', 13),
('Ingegneria Elettronica', 13),
('Ingegneria Informatica', 13),
('Ingegneria Automatica', 14),
('Ingegneria Chimica', 14),
('Ingegneria delle Telecomunicazioni', 14),
('Ingegneria Elettronica', 14),
('Ingegneria Gestionale', 14),
('Ingegneria Informatica', 14),
('Ingegneria Meccanica', 14),
('Ingegneria Automatica', 15),
('Ingegneria delle Telecomunicazioni', 15),
('Ingegneria Elettronica', 15),
('Ingegneria Informatica', 15),
('Ingegneria Automatica', 16),
('Ingegneria delle Telecomunicazioni', 16),
('Ingegneria Elettronica', 16),
('Ingegneria Informatica', 16),
('Ingegneria Automatica', 17),
('Ingegneria delle Telecomunicazioni', 17),
('Ingegneria Elettronica', 17),
('Ingegneria Informatica', 17),
('Ingegneria Automatica', 18),
('Ingegneria delle Telecomunicazioni', 18),
('Ingegneria Elettronica', 18),
('Ingegneria Informatica', 18),
('Ingegneria Automatica', 19),
('Ingegneria delle Telecomunicazioni', 19),
('Ingegneria Elettronica', 19),
('Ingegneria Informatica', 19),
('Ingegneria Automatica', 20),
('Ingegneria delle Telecomunicazioni', 20),
('Ingegneria Informatica', 20),
('Ingegneria Elettronica', 21),
('Ingegneria Informatica', 22),
('Ingegneria delle Telecomunicazioni', 23),
('Ingegneria Chimica', 24),
('Ingegneria Gestionale', 24),
('Ingegneria Meccanica', 24),
('Ingegneria Chimica', 26),
('Ingegneria Gestionale', 26),
('Ingegneria Meccanica', 26),
('Ingegneria Chimica', 27),
('Ingegneria Gestionale', 27),
('Ingegneria Meccanica', 27),
('Ingegneria Chimica', 28),
('Ingegneria Gestionale', 28),
('Ingegneria Meccanica', 28),
('Ingegneria Chimica', 29),
('Ingegneria Gestionale', 29),
('Ingegneria Meccanica', 29),
('Ingegneria Chimica', 30),
('Ingegneria Gestionale', 30),
('Ingegneria Meccanica', 30),
('Ingegneria Chimica', 32),
('Ingegneria Chimica', 33),
('Ingegneria Gestionale', 33),
('Ingegneria Automatica', 34),
('Ingegneria Chimica', 35),
('Ingegneria Meccanica', 35),
('Ingegneria delle Telecomunicazioni', 36),
('Ingegneria Automatica', 37),
('Ingegneria Elettronica', 37),
('Ingegneria Elettronica', 38),
('Ingegneria Informatica', 39),
('Ingegneria Gestionale', 40),
('Ingegneria Gestionale', 41);

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
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_ibfk_1` (`uploaderUsername`),
  KEY `resource_ibfk_2` (`subjectCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`code`, `name`) VALUES
(1, 'Analisi I'),
(2, 'Fisica I'),
(3, 'Analisi II'),
(4, 'Fisica II'),
(5, 'Fondamenti di Informatica'),
(6, 'Chimica'),
(7, 'Meccanica dei Fluidi'),
(8, 'Programmazione ad Oggetti'),
(9, 'Reti di telecomunicazioni'),
(10, 'Programmazione per il Web'),
(11, 'Basi di Dati'),
(12, 'Geometria'),
(13, 'Calcolo delle probabilita'),
(14, 'Elettrotecnica'),
(15, 'Teoria dei Sistemi'),
(16, 'Analisi ed Elaborazione dei Segnali'),
(17, 'Calcolatori elettronici'),
(18, 'Elettronica I'),
(19, 'Controlli Automatici'),
(20, 'Economia applicata all''ingegneria'),
(21, 'Elettronica II'),
(22, 'Sistemi operativi'),
(23, 'Campi elettromagnetici'),
(24, 'Economia ed Organizzazione Aziendale'),
(25, 'Calcolo numerico'),
(26, 'Chimica II'),
(27, 'Disegno tecnico industriale'),
(28, 'Scienza delle Costruzioni'),
(29, 'Fisica Tecnica'),
(30, 'Meccanica Applicata'),
(31, 'Disegno assistito da calcolatore'),
(32, 'Impianti chimici'),
(33, 'Macchine'),
(34, 'Automazione Industriale a Fluido'),
(35, 'Teoria dello Sviluppo dei Processi Chimici'),
(36, 'Fondamenti di comunicazioni'),
(37, 'Analisi Numerica'),
(38, 'Misure elettroniche'),
(39, 'Reti di calcolatori'),
(40, 'Fondamenti di automatica'),
(41, 'Scienza e tecnologia dei materiali');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `degreeCourse` varchar(50) DEFAULT NULL,
  `reliability` float NOT NULL,
  PRIMARY KEY (`username`),
  KEY `user_ibfk_1` (`degreeCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_scores`
--

CREATE TABLE IF NOT EXISTS `users_scores` (
  `username_voted` varchar(50) NOT NULL,
  `username_voter` varchar(50) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`username_voted`,`username_voter`),
  KEY `username_voter` (`username_voter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `resources_difficultyScores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_difficultyScores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resources_scores`
--
ALTER TABLE `resources_scores`
  ADD CONSTRAINT `resources_scores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_scores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`degreeCourse`) REFERENCES `degreeCourse` (`name`);

--
-- Constraints for table `users_scores`
--
ALTER TABLE `users_scores`
  ADD CONSTRAINT `users_scores_ibfk_1` FOREIGN KEY (`username_voted`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_scores_ibfk_2` FOREIGN KEY (`username_voter`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
