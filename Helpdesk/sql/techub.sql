-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Role` varchar(50) NOT NULL,
  `ContactNo` varchar(255) NOT NULL,
  `RegNo` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `Email`, `Role`, `ContactNo`, `RegNo`, `AdminPassword`) VALUES
(1, 'Admin', 'admin@email.com', 'Admin', '0771234567', 'A/19/891', 'admin123'),
(2, 'Engineer', 'engineer@gmail.com', 'Engineer', '0789990090', 'A/12/122', 'engineer123'),
(3, 'Director', 'director@gmail.com', 'Director', '0723567856', 'E/12/132', 'director123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ContactNo` varchar(255) NOT NULL,
  `RegNo` varchar(255) NOT NULL,
  `CustPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `InvoiceDes` varchar(255) NOT NULL,
  `InvoiceStatus` varchar(255) NOT NULL,
  `TicketId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `techofficer`
--

CREATE TABLE `techofficer` (
  `TechOfficerID` int(11) NOT NULL,
  `TechOfficerName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ContactNo` varchar(255) NOT NULL,
  `RegNo` varchar(255) NOT NULL,
  `TOPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `techofficer`
--

INSERT INTO `techofficer` (`TechOfficerID`, `TechOfficerName`, `Email`, `ContactNo`, `RegNo`, `TOPassword`) VALUES
(1, 'Tech Officer 1', 'to1@email.com', '0781231221', 'M/20/210', 'to123'),
(6, 'Tech Officer 2', 'to2@email.com', '0785556121', 'E/12/122', 'to123');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `TicketId` int(11) NOT NULL,
  `OpenDateTime` datetime DEFAULT current_timestamp(),
  `ClosedDateTime` date DEFAULT NULL,
  `TStatus` varchar(255) NOT NULL,
  `TPriority` int(11) NOT NULL,
  `TicketDes` varchar(255) NOT NULL,
  `customerEmail` varchar(255) DEFAULT NULL,
  `IssueType` varchar(255) DEFAULT NULL,
  `Telephone` varchar(255) DEFAULT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `TechOfficerId` int(11) DEFAULT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `AcceptDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `AdminPassword` (`AdminPassword`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `CustPassword` (`CustPassword`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `foreign key` (`TicketId`);

--
-- Indexes for table `techofficer`
--
ALTER TABLE `techofficer`
  ADD PRIMARY KEY (`TechOfficerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`TicketId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `TechOfficerId` (`TechOfficerId`),
  ADD KEY `InvoiceId` (`InvoiceId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `techofficer`
--
ALTER TABLE `techofficer`
  MODIFY `TechOfficerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `TicketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`TicketId`) REFERENCES `ticket` (`TicketId`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`TechOfficerId`) REFERENCES `techofficer` (`TechOfficerID`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`InvoiceId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
