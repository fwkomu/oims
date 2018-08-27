-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2018 at 06:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oims`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `checked` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `DATE` date NOT NULL,
  `ENTRY` text NOT NULL,
  PRIMARY KEY (`DATE`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`checked`, `username`, `DATE`, `ENTRY`) VALUES
(0, 'frank', '2017-10-18', 'Testing of input today'),
(0, 'frank', '2017-10-19', '1 smiling student on his way to graduation'),
(0, 'frank', '2017-10-20', '1 smiling student on his way to graduation'),
(0, 'frank', '2017-10-25', '1 smiling student on his way to graduation'),
(0, '', '2017-12-06', 'Supervision by trainer and supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `username` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `ID` int(10) NOT NULL,
  `gender` binary(6) NOT NULL,
  `DOB` date NOT NULL,
  `PA` varchar(15) NOT NULL,
  `PC` int(10) NOT NULL,
  `town` varchar(10) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kin` varchar(30) NOT NULL,
  `Relationship` varchar(10) NOT NULL,
  `ktel` varchar(20) NOT NULL,
  `School` varchar(50) NOT NULL,
  `SPA` varchar(15) NOT NULL,
  `SPC` int(10) NOT NULL,
  `Stown` varchar(10) NOT NULL,
  `Stel` varchar(20) NOT NULL,
  `Semail` varchar(30) NOT NULL,
  `Dept` varchar(40) NOT NULL,
  `HOD` varchar(30) NOT NULL,
  `CC` varchar(10) NOT NULL,
  `Company` varchar(40) NOT NULL,
  `CPA` varchar(10) NOT NULL,
  `CPC` int(10) NOT NULL,
  `Ctown` varchar(10) NOT NULL,
  `Ctel` varchar(20) NOT NULL,
  `Cemail` varchar(30) NOT NULL,
  `trainer` varchar(40) NOT NULL,
  `position` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`username`, `name`, `ID`, `gender`, `DOB`, `PA`, `PC`, `town`, `tel`, `email`, `kin`, `Relationship`, `ktel`, `School`, `SPA`, `SPC`, `Stown`, `Stel`, `Semail`, `Dept`, `HOD`, `CC`, `Company`, `CPA`, `CPC`, `Ctown`, `Ctel`, `Cemail`, `trainer`, `position`) VALUES
('komu', 'Fran', 31346714, '1\0\0\0\0\0', '0000-00-00', '39376', 623, 'Nairobi', '0705513035', 'fwkomu@gmail.com', 'Gits', 'Brother', '0723261621', 'The Catholic University Of Eastern Africa', '00000', 0, 'Nairobi', '0700000000', 'cuea@gmail.com', 'Maths', 'Mirugi', 'CMT', 'Ipsos', '5525', 52, 'Nairobi', '0755454545', 'ipsos@gmail.com', 'Abedi', 'IT manager');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `username` varchar(20) NOT NULL,
  `documentation` int(1) NOT NULL,
  `organization` int(1) NOT NULL,
  `adaptability` int(1) NOT NULL,
  `teamwork` int(1) NOT NULL,
  `assignments` int(1) NOT NULL,
  `presence` int(1) NOT NULL,
  `communication` int(1) NOT NULL,
  `mannerism` int(1) NOT NULL,
  `understanding` int(1) NOT NULL,
  `oral` int(1) NOT NULL,
  `total` int(3) NOT NULL,
  `comments` text NOT NULL,
  `rated_by` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `assigned_student` varchar(20) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `supervision_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `user_role` varchar(10) NOT NULL DEFAULT 'student',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `hashed_password`, `user_role`) VALUES
('Abedi', 'abedi@ipsos.com', '$2y$10$MzQzYTlhNzhlOWFkNGI2YOsDuc1UvnfvnrNePb3g7G.9J5a7n77pm', 'trainer'),
('frank', 'francis@cuea.edu', '$2y$10$MTk5ODU0ZmJhYTgyMjE1Z.pVuXu2uiQTJyK5oGJM6YSY2DTjAu.7W', 'admin'),
('Kioko', 'kioko@cuea.edu', '$2y$10$YjkwYzFhZmY1ODNjODFkMO8WoTBlmtVJjuazquEjZQbPDKpjBURB.', 'supervisor'),
('Komu', 'fwkomu@gmail.com', '$2y$10$OGRkMjliM2RiZGI2MzdiZe2dv6TLAhqElhqzlUI1tHGugh9aUdL5q', 'student'),
('peter', 'peet@gmail.com', '$2y$10$MjljMTk2ZWQ1YjY0OTA3ZOfOVbkqAIuLD8qv9l4Nh8yz8nsRyNdE.', 'student'),
('Sironic', 'sironic@cuea.edu', '$2y$10$MjIxZjY1ZjZjYTMyZWZjMOJp2C6lVG5ujQkQYap0R39ZXWJ9Chlw6', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
