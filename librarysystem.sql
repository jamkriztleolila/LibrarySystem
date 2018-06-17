-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 12:08 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_data`
--

CREATE TABLE `book_data` (
  `id` varchar(50) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` longtext NOT NULL,
  `editor` longtext NOT NULL,
  `language` varchar(100) NOT NULL,
  `schoolId` varchar(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `stocks` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_record`
--

CREATE TABLE `book_record` (
  `id` varchar(10) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'in',
  `dateAcquired` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acquisitionMode` varchar(50) NOT NULL,
  `suppliedBy` varchar(10) NOT NULL,
  `schoolId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_transaction`
--

CREATE TABLE `book_transaction` (
  `id` varchar(10) NOT NULL,
  `accessionID` varchar(10) NOT NULL,
  `borrowerID` varchar(10) NOT NULL,
  `librarianID` varchar(10) NOT NULL,
  `schoolId` varchar(20) NOT NULL,
  `daysAllowed` int(2) NOT NULL,
  `dateReserved` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateBorrowed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateReturned` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_violations`
--

CREATE TABLE `book_violations` (
  `id` varchar(10) NOT NULL,
  `transactionID` varchar(10) NOT NULL,
  `schoolId` varchar(20) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `fine` float NOT NULL,
  `totalFine` float NOT NULL,
  `dateIssued` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_record`
--

CREATE TABLE `email_record` (
  `id` varchar(10) NOT NULL,
  `receiverId` varchar(10) NOT NULL,
  `receiverEmail` varchar(100) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `validityPeriod` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_record`
--

INSERT INTO `email_record` (`id`, `receiverId`, `receiverEmail`, `purpose`, `validityPeriod`, `status`) VALUES
('2018E00001', '2018U00001', 'test', 'registration', '2018-06-11 22:26:02', 'new'),
('2018E00004', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 04:02:00', 'new'),
('2018E00005', '2018U00004', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 07:36:29', 'new'),
('2018E00006', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 07:57:28', 'new'),
('2018E00007', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 07:59:15', 'new'),
('2018E00008', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 08:02:01', 'new'),
('2018E00009', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 08:05:12', 'new'),
('2018E00010', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 08:07:10', 'new'),
('2018E00011', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 08:10:53', 'new'),
('2018E00012', '2018U00003', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-12 08:13:42', 'used'),
('2018E00013', '2018U00004', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-17 05:03:58', 'new'),
('2018E00014', '2018U00004', 'megrianne.bautista32@gmail.com', 'registration', '2018-06-17 05:09:27', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `contact`) VALUES
('CS-VAL', 'Corinthian School of Valenzuela City', 'Valenzuela City', NULL),
('FIT', 'FEU Institute of Technology', 'Manila City', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `schoolId` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL DEFAULT 'newUser',
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `userLevel` int(2) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `school` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `schoolId`, `email`, `password`, `firstName`, `middleName`, `lastName`, `userType`, `userLevel`, `status`, `school`) VALUES
('2018U00001', '201410060', '201410060@fit.edu.ph', 'newUser', 'Meg', 'Rianne', 'Castro', 'student', 0, 'new', 'FIT'),
('2018U00002', '201802449', 'megrianne.bautista32@gmail.com', 'witchblade32', 'Meg Rianne', 'Castro', 'Bautista', 'admin', 1, 'active', 'admin'),
('2018U00003', '201410066', 'megrianne.bautista32@gmail.com', 'newUser', 'Celine', '', 'Castro', 'teacher', 0, 'for approval', 'CS-VAL'),
('2018U00004', '201410065', 'megrianne.bautista32@gmail.com', 'password1234', 'Meg Rianne', 'Castro', 'Bautista', 'teacher', 0, 'new', 'FIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_record`
--
ALTER TABLE `email_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
