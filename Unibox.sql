-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Lug 18, 2014 alle 10:01
-- Versione del server: 5.6.16
-- PHP Version: 5.5.11

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
-- Struttura della tabella `degreeCourse`
--

CREATE TABLE IF NOT EXISTS `degreeCourse` (
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `degreeCourse`
--

INSERT INTO `degreeCourse` (`name`, `department`) VALUES
('Ingegneria Informatica', 'DISIM'),
('Ingegneria Meccanica', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `degreeCourses_Subjects`
--

CREATE TABLE IF NOT EXISTS `degreeCourses_Subjects` (
  `degreeCourse` varchar(50) NOT NULL,
  `subjectCode` int(11) NOT NULL,
  PRIMARY KEY (`degreeCourse`,`subjectCode`),
  KEY `degreeCourses_Subjects_ibfk_2` (`subjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `degreeCourses_Subjects`
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
-- Struttura della tabella `resource`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `resource`
--

INSERT INTO `resource` (`id`, `name`, `category`, `subjectCode`, `uploaderUsername`, `type`, `difficultyScore`, `qualityScore`, `path`, `uploadingDate`, `visible`, `downloadsNumber`, `description`) VALUES
(1, 'Sviluppi di taylor', 'teoria', 1, 'filreg', 'pdf', 6, 7, '/public/Unibox-Ajax/Resources/Taylor.pdf', '2014-07-17 16:31:14', 0, 1, 'sviluppi di taylor utili per la risoluzione dei limiti'),
(2, 'numeri complessi', 'teoria', 1, 'gasby', 'pdf', 0, 0, '/public/Unibox-Ajax/Resources/richiami_teoria_numcompl.pdf', '2014-07-17 18:36:57', 0, 0, 'teoria sui numeri complessi');

-- --------------------------------------------------------

--
-- Struttura della tabella `resources_difficultyScores`
--

CREATE TABLE IF NOT EXISTS `resources_difficultyScores` (
  `resourceId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `difficultyScore` int(11) NOT NULL,
  PRIMARY KEY (`resourceId`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `resources_difficultyScores`
--

INSERT INTO `resources_difficultyScores` (`resourceId`, `username`, `difficultyScore`) VALUES
(1, 'filreg', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `resources_scores`
--

CREATE TABLE IF NOT EXISTS `resources_scores` (
  `resourceId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`resourceId`,`username`),
  KEY `resourceId` (`resourceId`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `resources_scores`
--

INSERT INTO `resources_scores` (`resourceId`, `username`, `score`) VALUES
(1, 'filreg', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `subject`
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
-- Struttura della tabella `user`
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

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `name`, `surname`, `password`, `email`, `degreeCourse`, `reliability`) VALUES
('davcri', 'davide', 'cristini', '$2y$10$6U2VG4iEnn5VZs.KiOTC6.ytPuPGPIlTLLWpCvyrq3.g8LxqGaCb6', 'dav@cri.it', 'Ingegneria Informatica', 3.33333),
('filreg', 'filippo', 'reggimenti', '$2y$10$PSBMn8WTe5OiriSHkX.j2uX9LfhSVtCzfb.t6ZEhIIZBHzMzWQ.Se', 'reggimenti.filippo@gmail.com', 'Ingegneria Informatica', 4),
('gasby', 'simone', 'gasbarre', '$2y$10$2HeVWzAqa6o9WNQDfl63QeI0o0aGiMnwcSslFkr7rbrDkQh418aNW', 'asd@asd.it', 'Ingegneria Informatica', 3.5),
('pasq', 'pasquale', 'salvati', '$2y$10$kLj6h19eBiKi5HZ4o9qnM.0MliH9XVTZQWlKcRqdjiGKwo0Xz2YoS', 'asd@asd.com', 'Ingegneria Informatica', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users_scores`
--

CREATE TABLE IF NOT EXISTS `users_scores` (
  `username_voted` varchar(50) NOT NULL,
  `username_voter` varchar(50) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`username_voted`,`username_voter`),
  KEY `username_voter` (`username_voter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users_scores`
--

INSERT INTO `users_scores` (`username_voted`, `username_voter`, `vote`) VALUES
('davcri', 'filreg', 2),
('davcri', 'gasby', 3),
('davcri', 'pasq', 5),
('filreg', 'gasby', 3),
('filreg', 'pasq', 5),
('gasby', 'filreg', 5),
('gasby', 'pasq', 3);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `degreeCourses_Subjects`
--
ALTER TABLE `degreeCourses_Subjects`
  ADD CONSTRAINT `degreeCourses_Subjects_ibfk_1` FOREIGN KEY (`degreeCourse`) REFERENCES `degreeCourse` (`name`),
  ADD CONSTRAINT `degreeCourses_Subjects_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`);

--
-- Limiti per la tabella `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`uploaderUsername`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `resource_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`);

--
-- Limiti per la tabella `resources_difficultyScores`
--
ALTER TABLE `resources_difficultyScores`
  ADD CONSTRAINT `resources_difficultyScores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_difficultyScores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `resources_scores`
--
ALTER TABLE `resources_scores`
  ADD CONSTRAINT `resources_scores_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_scores_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`degreeCourse`) REFERENCES `degreeCourse` (`name`);

--
-- Limiti per la tabella `users_scores`
--
ALTER TABLE `users_scores`
  ADD CONSTRAINT `users_scores_ibfk_1` FOREIGN KEY (`username_voted`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_scores_ibfk_2` FOREIGN KEY (`username_voter`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
