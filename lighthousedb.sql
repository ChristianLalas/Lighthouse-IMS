-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 04:55 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lighthousedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accID` int(11) NOT NULL,
  `accFN` varchar(45) NOT NULL,
  `accLN` varchar(45) NOT NULL,
  `accType` varchar(45) NOT NULL,
  `accContctNo` varchar(11) NOT NULL,
  `accAd` varchar(45) NOT NULL,
  `accEAd` varchar(45) DEFAULT NULL,
  `accUN` varchar(45) NOT NULL,
  `accPass` varchar(45) NOT NULL,
  `accStat` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accID`, `accFN`, `accLN`, `accType`, `accContctNo`, `accAd`, `accEAd`, `accUN`, `accPass`, `accStat`) VALUES
(9, 'adri', 'adriann', 'MANAGER', '09123456789', 'Baguio, City', NULL, 'adrianna', 'adrianna', 'ENABLED'),
(11, 'amarizz', 'churnado', 'MANAGER', '09123456789', 'Kabanbantayan', NULL, 'amarizz', 'amarizz', 'ENABLED');

-- --------------------------------------------------------

--
-- Table structure for table `actlogs`
--

CREATE TABLE `actlogs` (
  `actLogID` int(11) NOT NULL,
  `aLActivity` varchar(45) NOT NULL,
  `aLDateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actlogs`
--

INSERT INTO `actlogs` (`actLogID`, `aLActivity`, `aLDateTime`, `accID`) VALUES
(614, 'Login', '2017-06-30 10:18:39', 9),
(615, 'Login', '2017-07-05 11:17:40', 9),
(616, 'Logout', '2017-07-05 11:18:29', 9),
(617, 'Login', '2017-07-05 13:40:44', 9),
(618, 'Login', '2017-07-06 15:09:25', 9),
(619, 'Login', '2017-07-06 15:11:08', 9),
(620, 'Login', '2017-07-07 15:43:12', 9),
(621, 'Login', '2017-07-19 09:14:47', 9),
(622, 'Logout', '2017-07-19 09:16:45', 9),
(623, 'Login', '2017-07-19 09:16:50', 10),
(624, 'Logout', '2017-07-19 09:19:10', 10),
(625, 'Login', '2017-07-19 09:19:19', 10),
(626, 'Logout', '2017-07-19 09:20:59', 10),
(627, 'Login', '2017-07-19 15:02:22', 9),
(628, 'Logout', '2017-07-19 15:21:49', 9),
(629, 'Login', '2017-07-20 09:15:34', 9),
(630, 'Login', '2017-07-20 09:18:16', 9),
(631, 'Login', '2017-07-20 09:20:09', 9),
(632, 'Login', '2017-07-20 09:24:26', 9),
(633, 'Login', '2017-07-20 09:24:56', 9),
(634, 'Logout', '2017-07-20 09:26:23', 9),
(635, 'Login', '2017-07-20 09:26:28', 9),
(636, 'Login', '2017-07-20 09:27:35', 9),
(637, 'Login', '2017-07-20 09:28:29', 9),
(638, 'Logout', '2017-07-20 09:28:44', 9),
(639, 'Login', '2017-07-20 09:29:02', 9),
(640, 'Login', '2017-07-20 09:29:44', 9),
(641, 'Login', '2017-07-20 09:31:35', 9),
(642, 'Login', '2017-07-20 09:37:32', 9),
(643, 'Logout', '2017-07-20 09:37:42', 9),
(644, 'Login', '2017-07-20 09:38:00', 9),
(645, 'Logout', '2017-07-20 09:38:05', 9),
(646, 'Login', '2017-07-20 09:44:51', 9),
(647, 'Logout', '2017-07-20 10:15:21', 9),
(648, 'Login', '2017-07-20 10:15:36', 9),
(649, 'Logout', '2017-07-20 10:15:40', 9),
(650, 'Login', '2017-07-20 10:16:41', 9),
(651, 'Logout', '2017-07-20 10:44:36', 9),
(652, 'Login', '2017-07-20 10:44:42', 9),
(653, 'Logout', '2017-07-20 10:44:54', 9),
(654, 'Login', '2017-07-20 10:48:49', 9),
(655, 'Logout', '2017-07-20 10:48:53', 9),
(656, 'Login', '2017-07-20 10:49:49', 9),
(657, 'Logout', '2017-07-20 10:51:51', 9),
(658, 'Login', '2017-07-20 10:52:13', 9),
(659, 'Logout', '2017-07-20 10:56:04', 9),
(660, 'Login', '2017-07-20 10:56:44', 10),
(661, 'Logout', '2017-07-20 10:56:50', 10),
(662, 'Login', '2017-07-20 10:57:42', 11),
(663, 'Login', '2017-07-20 11:20:17', 11),
(664, 'Login', '2017-07-20 11:29:27', 11),
(665, 'Login', '2017-07-20 11:36:42', 11),
(666, 'Logout', '2017-07-20 11:39:01', 9),
(667, 'Login', '2017-07-20 11:39:41', 11),
(668, 'Logout', '2017-07-20 11:40:47', 11),
(669, 'Login', '2017-07-20 11:40:51', 11),
(670, 'Logout', '2017-07-20 11:44:12', 11),
(671, 'Login', '2017-07-20 11:44:38', 11),
(672, 'Logout', '2017-07-20 11:48:07', 11),
(673, 'Login', '2017-07-20 11:48:12', 11),
(674, 'Logout', '2017-07-20 11:50:25', 11),
(675, 'Login', '2017-07-20 11:50:31', 11),
(676, 'Login', '2017-07-20 14:18:30', 11),
(677, 'Activated.11.Account', '2017-07-20 14:18:41', 11),
(678, 'Activated.11.Account', '2017-07-20 14:18:50', 11),
(679, 'Logout', '2017-07-20 14:18:58', 11),
(680, 'Login', '2017-07-20 14:19:09', 11),
(681, 'Logout', '2017-07-20 14:19:19', 11),
(682, 'Login', '2017-07-20 14:30:13', 11),
(683, 'Logout', '2017-07-20 14:30:16', 11),
(684, 'Login', '2017-07-20 14:44:46', 11),
(685, 'Login', '2017-07-20 14:55:59', 11),
(686, 'Login', '2017-07-20 14:56:16', 11),
(687, 'Logout', '2017-07-20 14:56:21', 11),
(688, 'Logout', '2017-07-20 14:56:24', 11),
(689, 'Login', '2017-07-20 14:57:07', 11),
(690, 'Login', '2017-07-20 14:59:54', 11),
(691, 'Logout', '2017-07-20 15:16:42', 11),
(692, 'Login', '2017-07-20 15:23:11', 11),
(693, 'Login', '2017-07-20 15:24:50', 11),
(694, 'Logout', '2017-07-20 15:25:30', 11),
(695, 'Login', '2017-07-20 15:25:35', 11),
(696, 'Login', '2017-07-20 15:26:05', 11),
(697, 'Logout', '2017-07-20 15:49:45', 11),
(698, 'Login', '2017-07-20 15:49:55', 11),
(699, 'Login', '2017-07-20 15:53:59', 11),
(700, 'Logout', '2017-07-20 15:57:19', 11),
(701, 'Login', '2017-07-20 15:58:17', 11),
(702, 'Activated.11.Account', '2017-07-20 16:05:32', 11),
(703, 'Activated.11.Account', '2017-07-20 16:05:37', 11),
(704, 'Activated.11.Account', '2017-07-20 16:05:38', 11),
(705, 'Activated.11.Account', '2017-07-20 16:05:38', 11),
(706, 'Activated.11.Account', '2017-07-20 16:11:20', 11),
(707, 'Login', '2017-08-25 04:10:56', 11),
(708, 'Logout', '2017-08-25 04:13:48', 11),
(709, 'Login', '2017-08-25 20:54:28', 11),
(710, 'Logout', '2017-08-25 21:02:30', 11),
(711, 'Login', '2017-08-25 21:02:41', 11),
(712, 'Logout', '2017-08-25 21:03:20', 11),
(713, 'Login', '2017-08-25 21:03:25', 11),
(714, 'Logout', '2017-08-25 21:03:34', 11),
(715, 'Login', '2017-08-25 21:03:53', 11),
(716, 'Logout', '2017-08-25 21:06:38', 11),
(717, 'Login', '2017-08-25 21:06:45', 11),
(718, 'Logout', '2017-08-25 21:41:03', 11),
(719, 'Login', '2017-08-25 21:41:22', 11),
(720, 'Logout', '2017-08-25 21:42:47', 11),
(721, 'Login', '2017-08-25 21:42:53', 11),
(722, 'Logout', '2017-08-25 21:44:39', 11),
(723, 'Login', '2017-08-25 21:44:45', 11),
(724, 'Logout', '2017-08-25 21:47:52', 11),
(725, 'Login', '2017-08-25 21:49:14', 11),
(726, 'Login', '2017-08-25 21:50:08', 11),
(727, 'Logout', '2017-08-25 21:50:30', 11),
(728, 'Login', '2017-08-25 21:53:06', 11),
(729, 'Login', '2017-08-28 14:42:33', 11),
(730, 'Login', '2017-08-28 17:26:57', 11),
(731, 'Logout', '2017-08-28 17:30:53', 11),
(732, 'Login', '2017-09-02 21:03:33', 11),
(733, 'Login', '2017-09-05 09:25:39', 11),
(734, 'Logout', '2017-09-05 11:19:21', 9),
(735, 'Login', '2017-09-05 12:19:52', 11),
(736, 'Activated.11.Account', '2017-09-05 14:46:46', 11),
(737, 'Activated.11.Account', '2017-09-05 14:46:55', 11),
(738, 'Login', '2017-09-07 21:06:11', 11),
(739, 'Login', '2017-09-08 09:15:25', 11),
(740, 'Login', '2017-09-07 21:12:41', 11),
(741, 'Login', '2017-09-07 22:33:39', 11),
(742, 'Update Profile', '2017-09-07 22:42:49', 11);

-- --------------------------------------------------------

--
-- Table structure for table `convunits`
--

CREATE TABLE `convunits` (
  `convUnitID` int(11) NOT NULL,
  `convUnitName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convunits`
--

INSERT INTO `convunits` (`convUnitID`, `convUnitName`) VALUES
(22, 'WhitelP65E27'),
(23, 'BlackI12W');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `itemCode` int(11) NOT NULL,
  `itemName` varchar(45) NOT NULL,
  `itemQty` int(100) NOT NULL,
  `baseUnit` int(45) NOT NULL,
  `itemRLvl` int(100) NOT NULL,
  `itemStat` varchar(8) NOT NULL,
  `itemTypeID` int(11) NOT NULL,
  `convUnitID` int(11) NOT NULL,
  `bCValue` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`itemCode`, `itemName`, `itemQty`, `baseUnit`, `itemRLvl`, `itemStat`, `itemTypeID`, `convUnitID`, `bCValue`) VALUES
(107, 'A19', 0, 22, 5, 'ENABLED', 5, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemtype`
--

CREATE TABLE `itemtype` (
  `itemTypeID` int(11) NOT NULL,
  `itemTypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtype`
--

INSERT INTO `itemtype` (`itemTypeID`, `itemTypeName`) VALUES
(1, 'LED Lighthings'),
(2, 'Spotlights'),
(3, 'Wall Lights'),
(4, 'Ceiling Fans'),
(5, 'Bulkhead');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supID` int(11) NOT NULL,
  `supCompany` varchar(45) NOT NULL,
  `supAd` varchar(45) NOT NULL,
  `supContactNo` varchar(11) NOT NULL,
  `supContactPer` varchar(45) NOT NULL,
  `supStat` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supID`, `supCompany`, `supAd`, `supContactNo`, `supContactPer`, `supStat`) VALUES
(11, 'ChineseKids', 'Hometown China', '09154168489', 'Amariz', 'ENABLED');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitID` int(11) NOT NULL,
  `unitName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitID`, `unitName`) VALUES
(22, 'WhitelP65E27'),
(23, 'BlackI12W14'),
(24, 'BlackI12W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accID`);

--
-- Indexes for table `actlogs`
--
ALTER TABLE `actlogs`
  ADD PRIMARY KEY (`actLogID`),
  ADD KEY `accID_idx` (`accID`);

--
-- Indexes for table `convunits`
--
ALTER TABLE `convunits`
  ADD PRIMARY KEY (`convUnitID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `itemTypeID_idx` (`itemTypeID`),
  ADD KEY `baseUnit_idx` (`baseUnit`),
  ADD KEY `convUnitID_idx` (`convUnitID`);

--
-- Indexes for table `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`itemTypeID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `actlogs`
--
ALTER TABLE `actlogs`
  MODIFY `actLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=743;
--
-- AUTO_INCREMENT for table `convunits`
--
ALTER TABLE `convunits`
  MODIFY `convUnitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `itemCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `itemtype`
--
ALTER TABLE `itemtype`
  MODIFY `itemTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
