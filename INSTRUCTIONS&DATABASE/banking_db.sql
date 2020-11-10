-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2020 at 08:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(10) UNSIGNED NOT NULL,
  `FNAME` varchar(100) NOT NULL,
  `MNAME` varchar(100) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `ACC_TYPE` varchar(50) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `BRANCH` varchar(100) NOT NULL,
  `BRANCH_CODE` varchar(50) NOT NULL,
  `LAST_ACCESS` datetime NOT NULL,
  `STATUS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `FNAME`, `MNAME`, `LNAME`, `GENDER`, `DOB`, `ACC_TYPE`, `ADDRESS`, `MOBILE`, `EMAIL`, `PASSWORD`, `BRANCH`, `BRANCH_CODE`, `LAST_ACCESS`, `STATUS`) VALUES
(1, 'CRISTINE', 'DE', 'AGUILA', 'F', '1990-03-27', 'Savings', '34 KALIRAYA ST. TATALON, QUEZON CITY', '9351671560', 'cristina@gmail.com', '47c3e2fcf61282ac0f2baa1a97432278', 'QUEZON CITY', '1121', '2020-04-30 14:41:27', 'ACTIVE'),
(2, 'FREDDIE', 'PASCUAL', 'AGUILAR', 'M', '1953-02-05', 'Savings', '120 TOMAS MORATO AVENUE CORNER KAMUNING ROAD, QUEZON CITY, 1103 METRO MANILA', '9399542804', 'freddie@gmail.com', 'fdc3964a761d17217569f1205f2b963d', 'MAKATI CITY', '1630', '2020-04-30 13:57:45', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(20) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `LAST_ACCESS` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `NAME`, `MOBILE`, `USERNAME`, `PASSWORD`, `LAST_ACCESS`, `STATUS`) VALUES
(1, 'VAN ANTHONY SILLEZA', '09399542804', 'van0219', 'a3db6ace69eb06b43de6a0050da5b67f', '2020-04-30 00:08:29', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `app_credentials`
--

CREATE TABLE `app_credentials` (
  `ID` int(10) UNSIGNED NOT NULL,
  `SHORTCODE_GLOBE` varchar(20) NOT NULL,
  `SHORTCODE_CROSS` varchar(20) NOT NULL,
  `APP_ID` varchar(255) NOT NULL,
  `APP_SECRET` varchar(255) NOT NULL,
  `API_TYPE` varchar(50) NOT NULL,
  `APP_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_credentials`
--

INSERT INTO `app_credentials` (`ID`, `SHORTCODE_GLOBE`, `SHORTCODE_CROSS`, `APP_ID`, `APP_SECRET`, `API_TYPE`, `APP_NAME`) VALUES
(1, '21588846', '225658846', 'g6Xnfq8a8RfA7TxKyxia6zfaz6oqfb9p', '2fab44538cc8c36733f906992d3733ec5838dae28285f81a54a05d33f1471f94', 'SMS', 'BANKO NI DORO');

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `ACCNUM` int(10) UNSIGNED NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `DATE_REQUESTED` datetime DEFAULT NULL,
  `DATE_ISSUED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`ID`, `NAME`, `ACCNUM`, `STATUS`, `DATE_REQUESTED`, `DATE_ISSUED`) VALUES
(1, 'Cristina De Agila', 1, 'ISSUED', '2020-04-30 00:03:26', '2020-04-30 02:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `ID` int(10) UNSIGNED NOT NULL,
  `DATE_APPROVED` datetime NOT NULL,
  `SENDER_ID` int(10) UNSIGNED NOT NULL,
  `SENDER_NAME` varchar(100) NOT NULL,
  `RECEIVER_ID` int(10) UNSIGNED NOT NULL,
  `RECEIVER_NAME` varchar(100) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`ID`, `DATE_APPROVED`, `SENDER_ID`, `SENDER_NAME`, `RECEIVER_ID`, `RECEIVER_NAME`, `STATUS`) VALUES
(1, '2020-04-30 14:04:51', 1, 'CRISTINE DE AGUILA', 2, 'FREDDIE PASCUAL AGUILAR', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `checkbook`
--

CREATE TABLE `checkbook` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `ACCNUM` int(10) UNSIGNED NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `DATE_REQUESTED` datetime DEFAULT NULL,
  `DATE_ISSUED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkbook`
--

INSERT INTO `checkbook` (`ID`, `NAME`, `ACCNUM`, `STATUS`, `DATE_REQUESTED`, `DATE_ISSUED`) VALUES
(1, 'Cristina De Agila', 1, 'ISSUED', '2020-04-30 00:03:52', '2020-04-30 02:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `passbook1`
--

CREATE TABLE `passbook1` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TRANSDATE` datetime DEFAULT NULL,
  `FNAME` varchar(50) DEFAULT NULL,
  `MNAME` varchar(50) DEFAULT NULL,
  `LNAME` varchar(50) DEFAULT NULL,
  `BRANCH` varchar(100) DEFAULT NULL,
  `BRANCH_CODE` varchar(50) DEFAULT NULL,
  `CREDIT` double(22,4) DEFAULT NULL,
  `DEBIT` double(22,4) DEFAULT NULL,
  `AMOUNT` decimal(10,2) DEFAULT NULL,
  `DESCRIPTION` varchar(250) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passbook1`
--

INSERT INTO `passbook1` (`ID`, `TRANSDATE`, `FNAME`, `MNAME`, `LNAME`, `BRANCH`, `BRANCH_CODE`, `CREDIT`, `DEBIT`, `AMOUNT`, `DESCRIPTION`, `STATUS`) VALUES
(1, '2020-04-30 13:53:15', 'CRISTINE', 'DE', 'AGUILA', 'QUEZON CITY', '1121', 1000000.0000, 0.0000, '1000000.00', 'Open Account', 'ACTIVE'),
(2, '2020-04-30 14:09:34', 'CRISTINE', 'DE', 'AGUILA', 'QUEZON CITY', '1121', 0.0000, 2500.0000, '997500.00', 'FOR FREDDIE PASCUAL AGUILAR', 'ACTIVE'),
(3, '2020-04-30 14:17:43', 'CRISTINE', 'DE', 'AGUILA', 'QUEZON CITY', '1121', 0.0000, 5000.0000, '992500.00', 'FOR FREDDIE PASCUAL AGUILAR', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `passbook2`
--

CREATE TABLE `passbook2` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TRANSDATE` datetime DEFAULT NULL,
  `FNAME` varchar(50) DEFAULT NULL,
  `MNAME` varchar(50) DEFAULT NULL,
  `LNAME` varchar(50) DEFAULT NULL,
  `BRANCH` varchar(100) DEFAULT NULL,
  `BRANCH_CODE` varchar(50) DEFAULT NULL,
  `CREDIT` double(22,4) DEFAULT NULL,
  `DEBIT` double(22,4) DEFAULT NULL,
  `AMOUNT` decimal(10,2) DEFAULT NULL,
  `DESCRIPTION` varchar(250) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passbook2`
--

INSERT INTO `passbook2` (`ID`, `TRANSDATE`, `FNAME`, `MNAME`, `LNAME`, `BRANCH`, `BRANCH_CODE`, `CREDIT`, `DEBIT`, `AMOUNT`, `DESCRIPTION`, `STATUS`) VALUES
(1, '2020-04-30 13:57:46', 'FREDDIE', 'PASCUAL', 'AGUILAR', 'MAKATI CITY', '1630', 250000.0000, 0.0000, '250000.00', 'Open Account', 'ACTIVE'),
(2, '2020-04-30 14:09:34', 'FREDDIE', 'PASCUAL', 'AGUILAR', 'MAKATI CITY', '1630', 2500.0000, 0.0000, '252500.00', 'FROM CRISTINE DE AGUILA', 'ACTIVE'),
(3, '2020-04-30 14:17:43', 'FREDDIE', 'PASCUAL', 'AGUILAR', 'MAKATI CITY', '1630', 5000.0000, 0.0000, '257500.00', 'FROM CRISTINE DE AGUILA', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `ID` int(10) UNSIGNED NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `MNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `CIVIL_STATUS` varchar(100) NOT NULL,
  `BRANCH` varchar(100) NOT NULL,
  `DATE_HIRED` date NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `LAST_ACCESS` datetime NOT NULL,
  `STATUS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`ID`, `FNAME`, `MNAME`, `LNAME`, `GENDER`, `DOB`, `CIVIL_STATUS`, `BRANCH`, `DATE_HIRED`, `ADDRESS`, `MOBILE`, `EMAIL`, `PASSWORD`, `LAST_ACCESS`, `STATUS`) VALUES
(1, 'JUSTINE', 'DE', 'BOBBY', 'M', '1992-04-16', 'Married', 'Quezon City', '2015-01-01', '181 DELMO ST. 15TH AVENUE, CUBAO, QUEZON CITY', '9757185261', 'justine@yahoo.com', 'ea6c6aefc414304de21b9e26a877ce63', '0000-00-00 00:00:00', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_info`
--

CREATE TABLE `subscriber_info` (
  `ID` int(10) UNSIGNED NOT NULL,
  `EMP_ID` int(10) UNSIGNED DEFAULT NULL,
  `ACC_ID` int(10) UNSIGNED DEFAULT NULL,
  `FULLNAME` varchar(100) NOT NULL,
  `ACCESS_TOKEN` varchar(255) NOT NULL,
  `SUBSCRIBER_NUM` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriber_info`
--

INSERT INTO `subscriber_info` (`ID`, `EMP_ID`, `ACC_ID`, `FULLNAME`, `ACCESS_TOKEN`, `SUBSCRIBER_NUM`) VALUES
(1, 1, NULL, 'JUSTINE DE BOBBY', 'xHiBE6ZrFkCxRPBUuMVEAf9E81N9GEnZ2uGF1nw8teE', '9757185261'),
(2, NULL, 1, 'CRISTINE DE AGUILA', 'SqnFEwnyM6_p670UftkR_YT1Ycfi-ZkPcvfgYeTHcGM', '9351671560'),
(3, NULL, 2, 'FREDDIE PASCUAL AGUILAR', '6G5zCjT-ECvRR6dbY_wlSbRaTQov1jDeoySTMv4RMuE', '9399542804');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MOBILE` (`MOBILE`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `app_credentials`
--
ALTER TABLE `app_credentials`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `checkbook`
--
ALTER TABLE `checkbook`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `passbook1`
--
ALTER TABLE `passbook1`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `passbook2`
--
ALTER TABLE `passbook2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MOBILE` (`MOBILE`);

--
-- Indexes for table `subscriber_info`
--
ALTER TABLE `subscriber_info`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SUBSCRIBER_NUM` (`SUBSCRIBER_NUM`),
  ADD KEY `EMP_ID` (`EMP_ID`),
  ADD KEY `ACC_ID` (`ACC_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_credentials`
--
ALTER TABLE `app_credentials`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `atm`
--
ALTER TABLE `atm`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiary`
--
ALTER TABLE `beneficiary`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkbook`
--
ALTER TABLE `checkbook`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passbook1`
--
ALTER TABLE `passbook1`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `passbook2`
--
ALTER TABLE `passbook2`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriber_info`
--
ALTER TABLE `subscriber_info`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscriber_info`
--
ALTER TABLE `subscriber_info`
  ADD CONSTRAINT `subscriber_info_ibfk_1` FOREIGN KEY (`EMP_ID`) REFERENCES `personnel` (`ID`),
  ADD CONSTRAINT `subscriber_info_ibfk_2` FOREIGN KEY (`ACC_ID`) REFERENCES `accounts` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
