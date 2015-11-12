-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2015 at 04:42 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticket-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `actorId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`actorId`),
  KEY `actorId` (`actorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `cardNo` int(16) unsigned NOT NULL,
  `cardType` varchar(50) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `expiryDate` date NOT NULL,
  PRIMARY KEY (`cardNo`,`userId`),
  KEY `fk_card` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(50) unsigned NOT NULL,
  `createdDate` date NOT NULL,
  `commentText` varchar(255) NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `createspost`
--

CREATE TABLE IF NOT EXISTS `createspost` (
  `userId` varchar(255) NOT NULL,
  `postId` int(50) unsigned NOT NULL,
  PRIMARY KEY (`userId`,`postId`),
  KEY `fk-createspost2` (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employeeId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) NOT NULL,
  PRIMARY KEY (`employeeId`,`userId`),
  KEY `fk-employee-movieuser` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `likescomment`
--

CREATE TABLE IF NOT EXISTS `likescomment` (
  `userId` varchar(255) NOT NULL,
  `commentId` int(50) unsigned NOT NULL,
  PRIMARY KEY (`userId`,`commentId`),
  KEY `fk-likescomment2` (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likespost`
--

CREATE TABLE IF NOT EXISTS `likespost` (
  `userId` varchar(255) NOT NULL,
  `postId` int(50) unsigned NOT NULL,
  PRIMARY KEY (`userId`,`postId`),
  KEY `fk_likesPost2` (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `makescomment`
--

CREATE TABLE IF NOT EXISTS `makescomment` (
  `userId` varchar(255) NOT NULL,
  `commentId` int(50) unsigned NOT NULL,
  PRIMARY KEY (`userId`,`commentId`),
  KEY `fk-makescomment2` (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `movieId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movieName` varchar(255) NOT NULL,
  `movieLength` int(11) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `movieReleaseYear` int(11) NOT NULL,
  `boxOfficeCollection` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `studio` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`movieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `movieshow`
--

CREATE TABLE IF NOT EXISTS `movieshow` (
  `showId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movieId` int(11) unsigned NOT NULL,
  `screenId` int(11) unsigned NOT NULL,
  `theatreId` int(11) unsigned NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  PRIMARY KEY (`showId`),
  KEY `fk-movieshow-movies` (`movieId`),
  KEY `screenId_2` (`screenId`,`theatreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `movieuser`
--

CREATE TABLE IF NOT EXISTS `movieuser` (
  `emailId` varchar(255) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `creditPoints` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `membershipStatus` varchar(50) NOT NULL,
  PRIMARY KEY (`emailId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movieuser`
--

INSERT INTO `movieuser` (`emailId`, `fName`, `creditPoints`, `password`, `membershipStatus`) VALUES
('bala@gmail.com', 'balaji', 0, 'bala', 'bronze');

-- --------------------------------------------------------

--
-- Table structure for table `movieuseraddress`
--

CREATE TABLE IF NOT EXISTS `movieuseraddress` (
  `userId` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`,`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movieuseraddress`
--

INSERT INTO `movieuseraddress` (`userId`, `address`) VALUES
('bala@gmail.com', 'lkjl;saf');

-- --------------------------------------------------------

--
-- Table structure for table `movieuserphoneno`
--

CREATE TABLE IF NOT EXISTS `movieuserphoneno` (
  `userId` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`,`phoneNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movieuserphoneno`
--

INSERT INTO `movieuserphoneno` (`userId`, `phoneNo`) VALUES
('bala@gmail.com', '341324');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postId` int(50) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdDate` date NOT NULL,
  PRIMARY KEY (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE IF NOT EXISTS `screens` (
  `screenId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `screenName` varchar(50) NOT NULL,
  `theatreId` int(11) unsigned NOT NULL,
  `seatCount` int(11) NOT NULL,
  PRIMARY KEY (`screenId`,`theatreId`),
  KEY `fk-screens-theatres` (`theatreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `specialoffers`
--

CREATE TABLE IF NOT EXISTS `specialoffers` (
  `creditPoints` int(11) unsigned NOT NULL,
  `discountPrice` int(11) unsigned NOT NULL,
  `discountPriceCondition` varchar(50) NOT NULL,
  PRIMARY KEY (`creditPoints`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `starsin`
--

CREATE TABLE IF NOT EXISTS `starsin` (
  `actorId` int(11) unsigned NOT NULL,
  `movieId` int(11) unsigned NOT NULL,
  `role` varchar(255) NOT NULL,
  KEY `actorId` (`actorId`),
  KEY `fk-starsin-2-actor` (`movieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `theatres`
--

CREATE TABLE IF NOT EXISTS `theatres` (
  `theatreId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theatreName` varchar(255) NOT NULL,
  `theatreAddress` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contactPerson` varchar(255) NOT NULL,
  `contactPhoneNo` varchar(20) NOT NULL,
  PRIMARY KEY (`theatreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `ticketId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) NOT NULL,
  `createdDate` date NOT NULL,
  `showId` int(11) NOT NULL,
  `seatNo` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`ticketId`),
  KEY `fk_tickets1` (`showId`),
  KEY `fk_tickets2` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `userId` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`userId`,`role`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workfor`
--

CREATE TABLE IF NOT EXISTS `workfor` (
  `theatreId` int(11) unsigned NOT NULL,
  `employeeId` int(11) unsigned NOT NULL,
  `workType` varchar(255) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  KEY `theatreId` (`theatreId`),
  KEY `employeeId` (`employeeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_card` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `createspost`
--
ALTER TABLE `createspost`
  ADD CONSTRAINT `fk-createspost2` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`),
  ADD CONSTRAINT `fk_createspost1` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk-employee-movieuser` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `likescomment`
--
ALTER TABLE `likescomment`
  ADD CONSTRAINT `fk-likescomment2` FOREIGN KEY (`commentId`) REFERENCES `comments` (`commentId`),
  ADD CONSTRAINT `fk_likescomment1` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `likespost`
--
ALTER TABLE `likespost`
  ADD CONSTRAINT `fk_likesPost2` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`),
  ADD CONSTRAINT `fk_likesPost1` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `makescomment`
--
ALTER TABLE `makescomment`
  ADD CONSTRAINT `fk-makescomment2` FOREIGN KEY (`commentId`) REFERENCES `comments` (`commentId`),
  ADD CONSTRAINT `fk_makescomment1` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `movieshow`
--
ALTER TABLE `movieshow`
  ADD CONSTRAINT `movieshow_ibfk_1` FOREIGN KEY (`screenId`, `theatreId`) REFERENCES `screens` (`screenId`, `theatreId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-movieshow-movies` FOREIGN KEY (`movieId`) REFERENCES `movies` (`movieId`);

--
-- Constraints for table `movieuseraddress`
--
ALTER TABLE `movieuseraddress`
  ADD CONSTRAINT `FK_movieUserAddress` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `movieuserphoneno`
--
ALTER TABLE `movieuserphoneno`
  ADD CONSTRAINT `FK_movieUserPhoneNo` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `screens`
--
ALTER TABLE `screens`
  ADD CONSTRAINT `fk-screens-theatres` FOREIGN KEY (`theatreId`) REFERENCES `theatres` (`theatreId`);

--
-- Constraints for table `starsin`
--
ALTER TABLE `starsin`
  ADD CONSTRAINT `fk-starsin-1-actor` FOREIGN KEY (`actorId`) REFERENCES `actor` (`actorId`),
  ADD CONSTRAINT `fk-starsin-2-actor` FOREIGN KEY (`movieId`) REFERENCES `movies` (`movieId`);

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `FK_userRole` FOREIGN KEY (`userId`) REFERENCES `movieuser` (`emailId`);

--
-- Constraints for table `workfor`
--
ALTER TABLE `workfor`
  ADD CONSTRAINT `fk-workfor-employees` FOREIGN KEY (`employeeId`) REFERENCES `employee` (`employeeId`),
  ADD CONSTRAINT `fk-workfor-theatres` FOREIGN KEY (`theatreId`) REFERENCES `theatres` (`theatreId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
