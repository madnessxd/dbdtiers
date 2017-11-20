-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2017 at 04:07 PM
-- Server version: 10.1.24-MariaDB-cll-lve
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `KillerPerk`
--

CREATE TABLE `KillerPerk` (
  `Id` int(11) NOT NULL,
  `IconUrl` text NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Killer` text NOT NULL,
  `Tier` char(1) NOT NULL DEFAULT 'C',
  `Rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KillerPerkRatings`
--

CREATE TABLE `KillerPerkRatings` (
  `perkId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `ipaddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Killers`
--

CREATE TABLE `Killers` (
  `Id` int(11) NOT NULL,
  `IconUrl` text NOT NULL,
  `Name` text NOT NULL,
  `Tier` char(1) NOT NULL,
  `Rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KillersRatings`
--

CREATE TABLE `KillersRatings` (
  `KillerId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `ipaddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Strikes`
--

CREATE TABLE `Strikes` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SurvivorPerk`
--

CREATE TABLE `SurvivorPerk` (
  `Id` int(11) NOT NULL,
  `IconUrl` text NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Survivor` text NOT NULL,
  `Tier` char(1) NOT NULL,
  `Rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SurvivorPerkRatings`
--

CREATE TABLE `SurvivorPerkRatings` (
  `perkId` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `ipaddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `KillerPerk`
--
ALTER TABLE `KillerPerk`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `SurvivorPerk`
--
ALTER TABLE `SurvivorPerk`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
