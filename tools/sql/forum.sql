-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 08:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `forumcomments`
--

CREATE TABLE `forumcomments` (
  `cID` int(11) NOT NULL,
  `cOwner` int(11) NOT NULL,
  `cBody` varchar(1000) NOT NULL,
  `cPost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forumposts`
--

CREATE TABLE `forumposts` (
  `p_id` int(20) NOT NULL,
  `p_title` varchar(200) NOT NULL,
  `p_body` varchar(7520) NOT NULL,
  `p_owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumposts`
--

INSERT INTO `forumposts` (`p_id`, `p_title`, `p_body`, `p_owner`) VALUES
(13, 'Nice Title here', 'The body is near', 1),
(16, '4876484548654865418634851846531', 'BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT BE GONE THOT ', 9),
(17, 'gdfsedgsdfgsdfgsd', 'fgsdfgsdfgsdhgdfghdfgh', 9),
(18, 'hjbnkm ,er4dfstwzbuhjkirfgbesblerg', 'hbyjadgssfblj.hk sdfzbhg jlsgdhbf j,.', 9),
(19, 'Nice Title here', 'gdsfgsfgh', 9),
(20, 'hfgfgdhghfd', 'hdfgdhfgfhgfgdh', 9),
(21, 'fdghfghdhfgdfhdg', 'gfhfdghfdgh', 9),
(22, 'gsdgfsdgfsdfg', 'sdfgsdgfgsdfsdgf', 9),
(23, 'Najs', 'Najssjsjsjsj\r\n', 9),
(24, 'öjkbngdölkdjbfglökjbdflkgbj', 'öghjbslökdjfbglsökdöjfbglksdjbfglksjdfbglksdjbfgk', 2),
(25, 'Free Pussy', 'Come get some free pussy right now at pornhub.com', 10),
(26, 'Pedro´s Drug Store', 'I sell coke, marijuana, methamphetamine, yes', 11),
(30, 'gsdfgsdfgsdfgsdfg', 'gefgsdfgsdf', 12),
(31, 'sdfgsdfg', 'sdfgsdfgsdfg', 12),
(32, 'gsdsdfgsdf', 'gsdfgsdfgsdfg', 12),
(33, 'Nice Title here', 'GGG', 13),
(34, 'gdfsedgsdfgsdfgsd', 'dsfgdgfssdgf', 13),
(35, '123', '123', 13),
(37, '123', '1231', 13),
(38, '321123132321132', '1321233213122131231231231', 14),
(39, 'GOOONE', 'GOOOONE', 12);

-- --------------------------------------------------------

--
-- Table structure for table `forumusers`
--

CREATE TABLE `forumusers` (
  `uID` int(21) NOT NULL,
  `uFName` varchar(64) NOT NULL,
  `uLName` varchar(64) NOT NULL,
  `uName` varchar(64) NOT NULL,
  `uMail` varchar(64) NOT NULL,
  `uAdress` varchar(128) NOT NULL,
  `uPhone` varchar(16) NOT NULL,
  `uPass` varchar(256) NOT NULL,
  `uRole` int(3) NOT NULL,
  `uDisabled` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumusers`
--

INSERT INTO `forumusers` (`uID`, `uFName`, `uLName`, `uName`, `uMail`, `uAdress`, `uPhone`, `uPass`, `uRole`, `uDisabled`) VALUES
(12, 'Emil2', 'Warelius', 'admin', 'emilwarelius@gmail.com', 'Rydgatan, 42', '0723247558', '$2y$10$8mYzu6rE/ZkO0NDZrGu49uIRFCVvheDUlzS61bwYSoEVav543Uxje', 1, 0),
(15, 'Emil', 'Warelius', 'admin3', 'albinwarre@gmail.com', 'Simons Garage', '0723247558', '$2y$10$xD0jAyCh6Vg7gWXOZVcz/ObICtuyCXauiTmlwQw7wPk1VARtquqRa', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forumcomments`
--
ALTER TABLE `forumcomments`
  ADD PRIMARY KEY (`cID`);

--
-- Indexes for table `forumposts`
--
ALTER TABLE `forumposts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `forumusers`
--
ALTER TABLE `forumusers`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forumcomments`
--
ALTER TABLE `forumcomments`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forumposts`
--
ALTER TABLE `forumposts`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `forumusers`
--
ALTER TABLE `forumusers`
  MODIFY `uID` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
