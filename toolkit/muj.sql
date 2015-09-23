-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2015 at 11:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `muj`
--

-- --------------------------------------------------------

--
-- Table structure for table `langue`
--

CREATE TABLE IF NOT EXISTS `langue` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `langue`
--

INSERT INTO `langue` (`ID`, `Name`) VALUES
(1, 'Français'),
(2, 'Anglais');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_LANG` int(11) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Adresse` char(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_LANG` (`ID_LANG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;


-- --------------------------------------------------------

--
-- Table structure for table `paragraphe`
--

CREATE TABLE IF NOT EXISTS `paragraphe` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_MESSAGE` int(11) unsigned NOT NULL,
  `Text` varchar(5000) NOT NULL,
  `Tags` varchar(2000) NOT NULL,
  PRIMARY KEY (`ID`,`ID_MESSAGE`),
  KEY `ID_message` (`ID_MESSAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;



-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`ID`, `Name`) VALUES
(1, 'Aucun concept'),
(2, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`ID_LANG`) REFERENCES `langue` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `paragraphe`
--
ALTER TABLE `paragraphe`
  ADD CONSTRAINT `ID_message` FOREIGN KEY (`ID_MESSAGE`) REFERENCES `message` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
