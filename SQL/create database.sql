-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2021 at 09:04 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asset_and_maintenance_management_system`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `UpdateNextServiceDue`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateNextServiceDue` (IN `assetId` VARCHAR(20))  BEGIN
	DECLARE serviceInt DECIMAL(18,0);
    DECLARE performedDate date;    
    DECLARE nextDate date;
	SELECT `serviceInterval` INTO serviceInt FROM noncurrentasset WHERE asset_id = assetId;
    SELECT `serviceDue` INTO performedDate FROM noncurrentasset WHERE asset_id = assetId; 
    IF performedDate is null THEN
		SELECT `purchaseDate` INTO performedDate FROM noncurrentasset WHERE asset_id = assetId;
	ELSE
		SELECT `serviceDue` INTO performedDate FROM noncurrentasset WHERE asset_id = assetId;
	END IF;
    SET nextDate = DATE_ADD(performedDate, INTERVAL serviceInt YEAR);
    UPDATE `noncurrentasset` SET serviceDue = nextDate WHERE asset_id = assetId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assettype`
--

DROP TABLE IF EXISTS `assettype`;
CREATE TABLE IF NOT EXISTS `assettype` (
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assettype`
--

INSERT INTO `assettype` (`type`) VALUES
('Computer'),
('Fire Extinguisher'),
('Heater'),
('Lift'),
('Lighting'),
('Network Device'),
('Phone'),
('Plumbing Device'),
('Printer/Scanner'),
('Sanitation Device'),
('Sink');

-- --------------------------------------------------------

--
-- Table structure for table `disposal`
--

DROP TABLE IF EXISTS `disposal`;
CREATE TABLE IF NOT EXISTS `disposal` (
  `disposedDate` date NOT NULL,
  `disposedValue` decimal(18,0) NOT NULL,
  `asset_id` varchar(20) NOT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposal`
--

INSERT INTO `disposal` (`disposedDate`, `disposedValue`, `asset_id`) VALUES
('2022-02-15', '6000', 'ASS-HEATER-1'),
('2021-11-25', '123', 'dsf3'),
('2021-12-02', '1000', 'dummy-light-1'),
('2021-12-09', '20000', 'tret43');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryitem`
--

DROP TABLE IF EXISTS `inventoryitem`;
CREATE TABLE IF NOT EXISTS `inventoryitem` (
  `inventoryCode` varchar(20) NOT NULL,
  `inventoryName` varchar(20) NOT NULL,
  `inventoryType` varchar(20) DEFAULT NULL,
  `threshold` int(11) NOT NULL DEFAULT '0',
  `currentQuantity` int(11) NOT NULL DEFAULT '0',
  `CurrentCost` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`inventoryCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventoryitem`
--

INSERT INTO `inventoryitem` (`inventoryCode`, `inventoryName`, `inventoryType`, `threshold`, `currentQuantity`, `CurrentCost`) VALUES
('INV-BRASS-001', 'Brass', 'Raw Materials', 150, 106, '200'),
('INV-PVC-001', 'PVC', 'Raw Materials', 500, 15, '150'),
('INV-TUNGSTEN -001', 'Tungsten', 'Raw Materials', 250, 160, '100');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryorder`
--

DROP TABLE IF EXISTS `inventoryorder`;
CREATE TABLE IF NOT EXISTS `inventoryorder` (
  `orderTime` datetime NOT NULL,
  `inventoryCode` varchar(20) NOT NULL,
  `orderedQuantity` bigint(20) NOT NULL,
  `dueDate` date DEFAULT NULL,
  `supplierID` varchar(20) NOT NULL,
  `plant` varchar(20) NOT NULL,
  `responsiblePerson` varchar(20) DEFAULT NULL,
  `received` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`orderTime`),
  KEY `inventoryCode` (`inventoryCode`),
  KEY `supplierID` (`supplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventoryorder`
--

INSERT INTO `inventoryorder` (`orderTime`, `inventoryCode`, `orderedQuantity`, `dueDate`, `supplierID`, `plant`, `responsiblePerson`, `received`) VALUES
('2021-08-19 19:30:04', 'INV-PVC-001', 11, '2021-08-21', 'SUPP-PVC-1', 'Minuwangoda', 'Nimal', b'1'),
('2021-08-19 20:11:52', 'INV-PVC-001', 11, '2021-08-26', 'SUPP-PVC-1', 'Minuwangoda', 'Sunil', b'0'),
('2021-08-19 20:13:17', 'INV-PVC-001', 1, '2021-08-26', 'SUPP-PVC-1', 'Minuwangoda', 'Sunimal', b'1'),
('2021-12-01 17:05:57', 'INV-PVC-001', 5, '2021-12-03', 'SUPP-PVC-1', 'Minuwangoda', 'Nimal', b'1'),
('2021-12-01 17:11:45', 'INV-TUNGSTEN -001', 20, '2021-12-15', 'SUPP-TUNGSTEN-1', 'Minuwangoda', 'Sunil', b'0'),
('2021-12-01 17:13:13', 'INV-BRASS-001', 15, '2021-12-22', 'SUPP-BRASS-1', 'Minuwangoda', 'Wimal', b'0'),
('2021-12-01 17:15:21', 'INV-TUNGSTEN -001', 10, '2021-12-22', 'SUPP-TUNGSTEN-1', 'Minuwangoda', 'Wimal', b'1'),
('2021-12-02 14:37:36', 'INV-BRASS-001', 25, '2021-12-09', 'SUPP-BRASS-1', 'Minuwangoda', 'Nimal', b'1'),
('2021-12-02 16:49:26', 'INV-PVC-001', 20, '2021-12-03', 'SUPP-PVC-1', 'Minuwangoda', 'Sunil', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `noncurrentasset`
--

DROP TABLE IF EXISTS `noncurrentasset`;
CREATE TABLE IF NOT EXISTS `noncurrentasset` (
  `asset_id` varchar(20) NOT NULL,
  `lifetime` tinyint(4) DEFAULT NULL,
  `depreciationRate` decimal(18,0) DEFAULT NULL,
  `currentCondition` varchar(10) NOT NULL,
  `manufacturer` varchar(20) DEFAULT NULL,
  `plant` varchar(20) DEFAULT NULL,
  `serialNumber` varchar(20) DEFAULT NULL,
  `depreciationMethod` varchar(20) NOT NULL,
  `costOfPurchase` decimal(18,0) NOT NULL,
  `serviceInterval` decimal(18,0) DEFAULT NULL,
  `state` varchar(10) NOT NULL,
  `assetType` varchar(20) NOT NULL,
  `purchaseDate` date DEFAULT NULL,
  `warrantyCode` varchar(20) DEFAULT NULL,
  `serviceDue` date DEFAULT NULL,
  `disposed` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`asset_id`),
  KEY `warrantyCode` (`warrantyCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `noncurrentasset`
--

INSERT INTO `noncurrentasset` (`asset_id`, `lifetime`, `depreciationRate`, `currentCondition`, `manufacturer`, `plant`, `serialNumber`, `depreciationMethod`, `costOfPurchase`, `serviceInterval`, `state`, `assetType`, `purchaseDate`, `warrantyCode`, `serviceDue`, `disposed`) VALUES
('ASS-COMP-1', 1, '10', 'Working', 'testManu', 'Minuwangoda', 'jbbbh4v4', 'reducing-balance', '50000', '12', 'Working', 'Computer', '2020-06-15', 'test', '2021-11-15', b'0'),
('ASS-HEATER-1', 2, '5', 'in-use', 'Philips', 'Minuwangoda', 'bfhbh3j2v', 'reducing-balance', '5000', '1', 'Working', 'Heater', '2021-08-21', 'dasd3', '2021-11-30', b'1'),
('ASS-SINK-1', 5, '10', 'working', 'Rocelle', 'Minuwangoda', 'dhsadgh34b', 'straight-line', '15000', '2', 'working', 'Sink', '2021-08-17', 'gdvgh2bh', '2023-11-30', b'0'),
('dsf3', 5, '12', 'Working', 'Rocelle', 'Minuwangoda', '456sd84', 'straight-line', '15000', '1', 'Disposed', 'Sink', '2021-08-08', 'dasd3', '2024-11-08', b'1'),
('dummy-light-1', 1, '12', 'Working', 'Philips', 'Minuwangoda', 'test-serial-1', 'Reducing-Balance', '1222', '0', 'In use', 'Computer', '2021-11-30', 'test-warr', '2021-11-30', b'1'),
('tret43', 5, '12', 'Working', 'Rocelle', 'Minuwangoda', '456sd8423', 'straight-line', '15000', '1', 'Disposed', 'Sink', '2021-08-08', 'sfert', '2021-11-09', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplierID` varchar(20) NOT NULL,
  `supplierName` varchar(20) NOT NULL,
  `supplierEmail` varchar(20) DEFAULT NULL,
  `Product` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`supplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `supplierEmail`, `Product`) VALUES
('SUPP-BRASS-1', 'Lanka Brass', NULL, 'Brass'),
('SUPP-PVC-1', 'Anton PVC', 'anton@antonmail.com', 'PVC'),
('SUPP-TUNGSTEN-1', 'Shanthis Stores', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `EmpCategory` varchar(10) NOT NULL,
  `registered_by` varchar(25) NOT NULL,
  `avatarPath` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`FirstName`, `LastName`, `Username`, `Password`, `EmpCategory`, `registered_by`, `avatarPath`) VALUES
('demo', 'demo', 'demo', 'demo', 'demo', 'demo', NULL),
('Draco', 'Malfoy', 'draco', '$2a$12$85qctpekEIfYgINLN9Pw4uLPZ/rFytsSg69ICdHsW4sHcQf6D3s5e', 'Worker', 'root', './assets/img/avatars/61a8c8816001c2.02599072.jpg'),
('Albus', 'Dumbledore', 'dumbledore', '$2y$10$2YIG1fAu/ldm52rWuSwtZOaZblpDyl6fVCdNNklCczFeyd8xugJOi', 'Manager', 'root', './assets/img/avatars/61a846b331eb02.80440334.jpeg'),
('test', 'test', 'jonny', 'password', 'test', 'root', NULL),
('test', 'test', 'test123', '$2y$10$a7BMhgCuNLOUWImMz/2l/.ai.q93BnjX.etR66Gpe90K6dWZ8qxka', 'Manager', 'dumbledore', 'assets/img/avatars/avatar1.jpeg'),
('Test', 'User', 'testuser', '$2y$10$MJ6GkbVE99Ri/py9B620FODsK68XM.k9TFe5W1/a4UAEnLggcYjDu', 'Manager', 'dumbledore', NULL),
('Test', 'User', 'user_test', '$2y$10$zM78LPx3J7N/4phCry9auuylV3y.X5f8sCcR6ZN1Z0RytygBtM.0.', 'Manager', 'dumbledore', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

DROP TABLE IF EXISTS `warranty`;
CREATE TABLE IF NOT EXISTS `warranty` (
  `warrantyCode` varchar(20) NOT NULL,
  `invoiceNum` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  PRIMARY KEY (`warrantyCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`warrantyCode`, `invoiceNum`, `type`, `startDate`, `endDate`) VALUES
('dasd3', 'cs3f', 'Limited', '2021-08-19', '2021-08-29'),
('gdvgh2bh', 'fdfwe', 'on-site', '2021-08-04', '2021-09-29'),
('sfert', 'etr', 'Limited', '2021-08-19', '2021-08-19'),
('sfertqq2', 'etr3', 'Limited', '2021-08-19', '2021-08-19'),
('sfertqq22', 'etr3', 'Limited', '2021-08-19', '2021-08-19'),
('test', 'test', 'test', '2021-11-29', '2021-11-29'),
('test-warr', 'ewqe123', 'Limited', '2021-11-30', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `workerreports`
--

DROP TABLE IF EXISTS `workerreports`;
CREATE TABLE IF NOT EXISTS `workerreports` (
  `username` varchar(20) NOT NULL,
  `reported_date` date NOT NULL,
  `asset_id` varchar(20) NOT NULL,
  `plant` varchar(20) NOT NULL,
  `criticality_machineOperations` varchar(10) NOT NULL,
  `criticality_activityConstraints` varchar(10) NOT NULL,
  `managerRespoded` bit(1) NOT NULL DEFAULT b'0',
  `service_date_schedule` date DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `performed` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`username`,`reported_date`,`asset_id`),
  KEY `asset_id` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workerreports`
--

INSERT INTO `workerreports` (`username`, `reported_date`, `asset_id`, `plant`, `criticality_machineOperations`, `criticality_activityConstraints`, `managerRespoded`, `service_date_schedule`, `message`, `performed`) VALUES
('draco', '2021-11-25', 'ASS-COMP-1', 'Minuwangoda', 'Low', 'Low', b'0', NULL, NULL, b'1'),
('draco', '2021-11-25', 'ASS-HEATER-1', 'Minuwangoda', 'Extreme', 'Extreme', b'0', NULL, NULL, b'1'),
('draco', '2021-11-25', 'ASS-SINK-1', 'Minuwangoda', 'High', 'High', b'0', NULL, NULL, b'1'),
('draco', '2021-11-30', 'ASS-COMP-1', 'Minuwangoda', 'High', 'High', b'0', NULL, 'this is just a test message', b'1'),
('draco', '2021-11-30', 'ASS-HEATER-1', 'Minuwangoda', 'Low', 'Low', b'0', NULL, 'this is another test message', b'0'),
('draco', '2021-11-30', 'ASS-SINK-1', 'Minuwangoda', 'Low', 'Low', b'0', NULL, 'this is a test message', b'1'),
('draco', '2021-12-02', 'ASS-COMP-1', 'Minuwangoda', 'Moderate', 'Moderate', b'0', NULL, NULL, b'0'),
('draco', '2021-12-02', 'ASS-SINK-1', 'Minuwangoda', 'High', 'Moderate', b'0', NULL, 'sdsasff', b'0'),
('dumbledore', '2021-08-21', 'ASS-SINK-1', 'Minuwangoda', 'low', 'low', b'0', '2021-08-28', 'Sink Leakage', b'1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventoryorder`
--
ALTER TABLE `inventoryorder`
  ADD CONSTRAINT `inventoryorder_ibfk_1` FOREIGN KEY (`inventoryCode`) REFERENCES `inventoryitem` (`inventoryCode`),
  ADD CONSTRAINT `inventoryorder_ibfk_2` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `noncurrentasset`
--
ALTER TABLE `noncurrentasset`
  ADD CONSTRAINT `noncurrentasset_ibfk_1` FOREIGN KEY (`warrantyCode`) REFERENCES `warranty` (`warrantyCode`);

--
-- Constraints for table `workerreports`
--
ALTER TABLE `workerreports`
  ADD CONSTRAINT `workerreports_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `noncurrentasset` (`asset_id`),
  ADD CONSTRAINT `workerreports_ibfk_2` FOREIGN KEY (`username`) REFERENCES `userinfo` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
