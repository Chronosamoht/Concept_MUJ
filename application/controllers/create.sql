DROP TABLE IF EXISTS `langue`;
DROP TABLE IF EXISTS `message`;
DROP TABLE IF EXISTS `paragraphe`;
DROP TABLE IF EXISTS `tags`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `langue` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
  
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `message` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_LANG` int(11) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Paragraphes` varchar(500) NOT NULL,
  `Adresse` char(50) NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX (ID_LANG),
  
   FOREIGN KEY (ID_LANG) 
        REFERENCES langue(ID)
        ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `paragraphe` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Message` int(11) unsigned NOT NULL,
  `Tags` varchar(2000) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Message`),
  FOREIGN KEY (ID_Message) 
        REFERENCES message(ID)
        ON DELETE CASCADE
) ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS `tags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
  
) ENGINE=InnoDB;