-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2015 at 04:11 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `udbhav`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(30) DEFAULT NULL,
  `PASS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `USERNAME`, `PASS`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `belongs_to`
--

CREATE TABLE IF NOT EXISTS `belongs_to` (
  `PUSN` varchar(15) NOT NULL DEFAULT '',
  `TID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `belongs_to`
--

INSERT INTO `belongs_to` (`PUSN`, `TID`) VALUES
('1MS13IS064', 6),
('1MS13IS067', 7),
('1ms13is069', 9),
('1ms13is097', 10),
('1ms13is064', 12),
('1ms13is069', 12),
('1ms13is097', 13),
('1ms13is068', 15),
('1rv13is067', 16),
('1rv13is064', 17),
('1ms13is064', 18);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `EID` int(11) NOT NULL,
  `ENAME` varchar(50) DEFAULT NULL,
  `ETYPE` varchar(20) DEFAULT NULL,
  `FEE` int(11) DEFAULT NULL,
  `LOCATION` varchar(50) DEFAULT NULL,
  `DT_TM` datetime DEFAULT NULL,
  `MAX_PART` int(11) DEFAULT NULL,
  `MAX_TIME` time DEFAULT NULL,
  `C_USN` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EID`, `ENAME`, `ETYPE`, `FEE`, `LOCATION`, `DT_TM`, `MAX_PART`, `MAX_TIME`, `C_USN`) VALUES
(1, 'ESSAY WRITING', 'literary', 100, 'ESB 2 Seminar Hall', '2015-05-14 11:00:00', 1, '01:00:00', '1MS13IS045'),
(5, 'Western Acoustics', 'music', 200, 'Main Stage', '2015-05-14 14:00:00', 2, '00:00:01', '1MS13IS064'),
(6, 'Sketching', 'arts', 100, 'Auditorium', '2015-05-14 16:00:00', 1, '00:00:01', '1MS13IS065');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `PUSN` varchar(15) NOT NULL DEFAULT '',
  `NAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHNO` varchar(15) DEFAULT NULL,
  `COLLEGE` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`PUSN`, `NAME`, `EMAIL`, `PHNO`, `COLLEGE`) VALUES
('1MS13IS056', 'MILAN', 'milan@gmail.com', '8899889977', 'MSRIT'),
('1MS13IS064', 'NIHAL', 'niha@oo.com', '8989898978', 'msrit'),
('1MS13IS067', 'NITISH', 'niti@yahoo.com', '9988778899', 'MSRIT'),
('1MS13IS068', 'NP', 'npl@gmail.com', '8877887788', 'msrit'),
('1MS13IS069', 'BHARGAV', 'btr@gmail.com', '1234567890', 'MSRIT'),
('1MS13IS097', 'RAMESH', 'ramesh@yahoo.com', '7744112255', 'msrit'),
('1RV13IS064', 'XYZ', 'nihalnayak@gmail.com', '1122334455', 'RVCE'),
('1RV13IS067', 'ABC', 'xxyz@jj.com', '9988778899', 'RVCE');

-- --------------------------------------------------------

--
-- Table structure for table `participates_in`
--

CREATE TABLE IF NOT EXISTS `participates_in` (
  `PUSN` varchar(15) NOT NULL DEFAULT '',
  `EID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participates_in`
--

INSERT INTO `participates_in` (`PUSN`, `EID`) VALUES
('1ms13is068', 1),
('1ms13is097', 1),
('1ms13is064', 5),
('1ms13is069', 5),
('1ms13is064', 6),
('1ms13is097', 6),
('1rv13is064', 6),
('1rv13is067', 6);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `TID` int(11) NOT NULL,
  `TNAME` varchar(30) NOT NULL,
  `eid` int(11) DEFAULT NULL,
  `pays_to` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`TID`, `TNAME`, `eid`, `pays_to`) VALUES
(6, 'NIHAL', 6, '1MS13IS064'),
(7, 'NITISH', 6, '1ms13is064'),
(9, 'BHARGAV', 6, '1ms13is064'),
(10, 'RAMESH', 1, '1ms13is064'),
(12, 'Jim Jam', 5, '1MS13IS064'),
(13, 'RAMESH', 6, '1MS13IS064'),
(15, 'NP', 1, '1MS13IS064'),
(16, 'ABC', 6, NULL),
(17, 'XYZ', 6, NULL),
(18, 'NIHAL', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE IF NOT EXISTS `volunteer` (
  `NAME` varchar(30) DEFAULT NULL,
  `USN` varchar(15) NOT NULL DEFAULT '',
  `EMAIL` varchar(50) DEFAULT NULL,
  `BRANCH` varchar(5) DEFAULT NULL,
  `PHNO` varchar(15) DEFAULT NULL,
  `PWD` varchar(30) DEFAULT NULL,
  `SEM` varchar(2) DEFAULT NULL,
  `SEC` varchar(2) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`NAME`, `USN`, `EMAIL`, `BRANCH`, `PHNO`, `PWD`, `SEM`, `SEC`, `eid`) VALUES
('RINCY', '1MS13IS033', 'kk@hhh.com', 'EC', '1122334455', 'abcd', '3', 'b', 5),
('KETHAKI', '1MS13IS045', 'ketha@me.com', 'IS', '8877889989', 'abc123', '4', 'B', 1),
('milan', '1ms13is056', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('milan', '1ms13is057', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('NIHAL', '1MS13IS064', 'nihalnayak@me.com', 'IS', '9988774455', 'pass123', '4', 'H', 5),
('NIKHIL', '1MS13IS065', 'nikhil@gmail.com', 'IS', '9988556633', 'abcd1234', '4', 'B', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `belongs_to`
--
ALTER TABLE `belongs_to`
  ADD PRIMARY KEY (`PUSN`,`TID`), ADD KEY `TID` (`TID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EID`), ADD KEY `C_USN` (`C_USN`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`PUSN`);

--
-- Indexes for table `participates_in`
--
ALTER TABLE `participates_in`
  ADD PRIMARY KEY (`PUSN`,`EID`), ADD KEY `EID` (`EID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`TID`), ADD KEY `eid` (`eid`), ADD KEY `v_usn` (`pays_to`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`USN`), ADD KEY `eid` (`eid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `belongs_to`
--
ALTER TABLE `belongs_to`
ADD CONSTRAINT `belongs_to_ibfk_1` FOREIGN KEY (`PUSN`) REFERENCES `participant` (`PUSN`) ON DELETE CASCADE,
ADD CONSTRAINT `belongs_to_ibfk_2` FOREIGN KEY (`TID`) REFERENCES `team` (`TID`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`C_USN`) REFERENCES `volunteer` (`USN`);

--
-- Constraints for table `participates_in`
--
ALTER TABLE `participates_in`
ADD CONSTRAINT `participates_in_ibfk_1` FOREIGN KEY (`PUSN`) REFERENCES `participant` (`PUSN`) ON DELETE CASCADE,
ADD CONSTRAINT `participates_in_ibfk_2` FOREIGN KEY (`EID`) REFERENCES `event` (`EID`) ON DELETE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `event` (`EID`) ON UPDATE CASCADE,
ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`pays_to`) REFERENCES `volunteer` (`USN`);

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
ADD CONSTRAINT `fk_eid` FOREIGN KEY (`eid`) REFERENCES `event` (`EID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
