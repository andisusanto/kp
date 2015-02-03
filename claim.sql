-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema claim
--

CREATE DATABASE IF NOT EXISTS claim;
USE claim;

--
-- Definition of table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `StoredPassword` varchar(100) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `I_admin_username` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`Id`,`UserName`,`StoredPassword`,`IsActive`,`LockField`) VALUES 
 (27,'jenny','e10adc3949ba59abbe56e057f20f883e',1,0);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


--
-- Definition of table `admininbox`
--

DROP TABLE IF EXISTS `admininbox`;
CREATE TABLE `admininbox` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Message` text NOT NULL,
  `ViewDetailLink` varchar(100) DEFAULT NULL,
  `IsRead` tinyint(1) NOT NULL,
  `Subject` varchar(45) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `ReceivedDate` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininbox`
--

/*!40000 ALTER TABLE `admininbox` DISABLE KEYS */;
INSERT INTO `admininbox` (`Id`,`Message`,`ViewDetailLink`,`IsRead`,`Subject`,`LockField`,`ReceivedDate`) VALUES 
 (8,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=30',1,'a request need your approval',7,'2014-11-28 08:17:32'),
 (9,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=32',1,'a request need your approval',1,'2014-12-03 15:30:15'),
 (10,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=32',1,'a request need your approval',3,'2014-12-03 16:28:56'),
 (11,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=33',1,'a request need your approval',8,'2014-12-06 18:46:42'),
 (12,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=34',1,'a request need your approval',2,'2014-12-09 16:07:09'),
 (13,'a request from Andi Susanto at 1419872179 need approval. for more information click open!','viewclaim.php?Id=37',1,'a request need your approval',1,'2014-12-29 17:56:19'),
 (14,'a request from Andi Susanto at 2014-12-29 need approval. for more information click open!','viewclaim.php?Id=37',1,'a request need your approval',3,'2014-12-29 17:58:02');
/*!40000 ALTER TABLE `admininbox` ENABLE KEYS */;


--
-- Definition of table `claimtransaction`
--

DROP TABLE IF EXISTS `claimtransaction`;
CREATE TABLE `claimtransaction` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Employee` int(10) unsigned NOT NULL,
  `ClaimDate` datetime NOT NULL,
  `Travel` int(10) unsigned NOT NULL,
  `Status` int(10) unsigned NOT NULL,
  `SubmissionNote` varchar(150) DEFAULT NULL,
  `ApprovalNote` varchar(150) DEFAULT NULL,
  `RejectionNote` varchar(150) DEFAULT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `ProcessedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_claimtransaction_travel` (`Travel`),
  KEY `FK_claimtransaction_employee` (`Employee`),
  CONSTRAINT `FK_claimtransaction_employee` FOREIGN KEY (`Employee`) REFERENCES `employee` (`Id`),
  CONSTRAINT `FK_claimtransaction_travel` FOREIGN KEY (`Travel`) REFERENCES `travel` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtransaction`
--

/*!40000 ALTER TABLE `claimtransaction` DISABLE KEYS */;
INSERT INTO `claimtransaction` (`Id`,`Employee`,`ClaimDate`,`Travel`,`Status`,`SubmissionNote`,`ApprovalNote`,`RejectionNote`,`LockField`,`ProcessedDate`) VALUES 
 (30,24,'2014-11-28 08:14:22',6,2,'Claim untuk biaya di tanggal 14 November 2014','Ok',NULL,2,'2014-11-28 09:00:45'),
 (32,24,'2014-12-03 08:56:00',5,3,'Biaya dari tanggal 15 Nov 2014 - 16 Nov 2014',NULL,'tidak ada attachment',4,'2014-12-03 16:30:35'),
 (33,24,'2014-12-06 06:54:42',5,0,'Biaya dari tanggal 15 Nov 2014 - 16 Nov 2014',NULL,NULL,2,'1970-01-01 01:00:00'),
 (34,24,'2014-12-09 16:06:44',5,2,'Biaya dari tanggal 15 Nov 2014 - 16 Nov 2014 - Claim ulang,\r\nAttachment tidak diberikan orangnya, kata Pak Robert boleh claim','Ok',NULL,13,'2014-12-23 11:23:37'),
 (35,24,'2014-12-17 16:19:27',5,0,'Test',NULL,NULL,0,'1970-01-01 01:00:00'),
 (36,24,'2014-12-24 18:00:22',5,0,'kejadian',NULL,NULL,0,'1970-01-01 01:00:00'),
 (37,24,'2014-12-29 17:58:02',7,2,'Claim untuk biaya perjalanan',NULL,NULL,6,'2015-01-14 08:44:03');
/*!40000 ALTER TABLE `claimtransaction` ENABLE KEYS */;


--
-- Definition of table `claimtransactiondetail`
--

DROP TABLE IF EXISTS `claimtransactiondetail`;
CREATE TABLE `claimtransactiondetail` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ClaimTransaction` int(10) unsigned NOT NULL,
  `ClaimType` int(10) unsigned NOT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `TransDate` datetime NOT NULL,
  `Note` varchar(100) DEFAULT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `Attachment` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_claimtransactiondetail_claimtype` (`ClaimType`),
  KEY `FK_claimtransactiondetail_claimtransaction` (`ClaimTransaction`),
  CONSTRAINT `FK_claimtransactiondetail_claimtransaction` FOREIGN KEY (`ClaimTransaction`) REFERENCES `claimtransaction` (`Id`),
  CONSTRAINT `FK_claimtransactiondetail_claimtype` FOREIGN KEY (`ClaimType`) REFERENCES `claimtype` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtransactiondetail`
--

/*!40000 ALTER TABLE `claimtransactiondetail` DISABLE KEYS */;
INSERT INTO `claimtransactiondetail` (`Id`,`ClaimTransaction`,`ClaimType`,`Amount`,`TransDate`,`Note`,`LockField`,`Attachment`) VALUES 
 (37,30,5,'12000.00','2014-11-10 00:00:00','Jalan tol dari bandara ke kantor',0,NULL),
 (38,30,9,'80000.00','2014-11-10 00:00:00','Taxi bluebird dari bandara ke kantor',0,NULL),
 (39,30,7,'630000.00','2014-11-10 00:00:00','Tiket pesawat citylink BTM-JKT',0,NULL),
 (40,30,10,'30000.00','2014-11-10 00:00:00','Biaya sikat gigi dan pasta gigi',0,NULL),
 (41,32,3,'32000.00','2014-11-04 00:00:00','cuci baju 3kg',0,NULL),
 (42,33,3,'30000.00','2014-11-05 00:00:00','cuci pakaian 3kg',0,NULL),
 (43,34,3,'32000.00','2014-11-04 00:00:00','cuci baju 3kg',0,NULL),
 (44,37,7,'600000.00','2014-12-26 00:00:00','Tiket pesawat citylink',0,NULL),
 (45,37,9,'90000.00','2014-12-26 00:00:00','Taxi ke bandara di Batam',0,NULL),
 (46,37,9,'100000.00','2014-12-26 00:00:00','Taxi dari bandara ke kantor di Jakarta',0,NULL),
 (47,37,5,'12000.00','2014-12-26 00:00:00','Masuk Tol',0,NULL);
/*!40000 ALTER TABLE `claimtransactiondetail` ENABLE KEYS */;


--
-- Definition of table `claimtype`
--

DROP TABLE IF EXISTS `claimtype`;
CREATE TABLE `claimtype` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `i_claimtype_code` (`Code`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtype`
--

/*!40000 ALTER TABLE `claimtype` DISABLE KEYS */;
INSERT INTO `claimtype` (`Id`,`Code`,`Name`,`IsActive`,`LockField`) VALUES 
 (3,'001','Laundry',1,0),
 (4,'002','Bensin',1,0),
 (5,'003','Jalan Tol',1,0),
 (6,'004','Makan & Minum',1,0),
 (7,'005','Tiket Pesawat',1,0),
 (8,'006','Tiket Kapal',1,0),
 (9,'007','Taxi',1,0),
 (10,'008','Alat kebutuhan sehari-hari',1,0),
 (11,'009','Lain lain',1,0);
/*!40000 ALTER TABLE `claimtype` ENABLE KEYS */;


--
-- Definition of table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `UserName` varchar(45) NOT NULL,
  `StoredPassword` varchar(100) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `ChangePasswordOnLogIn` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `i_employee_code` (`Code`),
  UNIQUE KEY `i_employee_username` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`Id`,`Code`,`Name`,`UserName`,`StoredPassword`,`IsActive`,`LockField`,`ChangePasswordOnLogIn`) VALUES 
 (18,'WFR-001','Hery','Hery','202cb962ac59075b964b07152d234b70',1,0,1),
 (19,'WFR-002','Robert','Robert','202cb962ac59075b964b07152d234b70',1,0,1),
 (20,'WFR-004','Lerianah','Leri','d41d8cd98f00b204e9800998ecf8427e',1,1,1),
 (21,'WFR-005','Jenny Lim','Jenny','202cb962ac59075b964b07152d234b70',1,0,1),
 (22,'WFR-007','Meilindawati','Meilinda','202cb962ac59075b964b07152d234b70',1,0,1),
 (23,'WFR-010','Hito','Hito','202cb962ac59075b964b07152d234b70',1,0,1),
 (24,'WFR-012','Andi Susanto','Andi','1d17c271014fcb24b91a01a993d61afb',1,1,0),
 (25,'WFR-013','Antoni','Antoni','202cb962ac59075b964b07152d234b70',1,0,1),
 (26,'WFR-018','Hery','Hery_2','202cb962ac59075b964b07152d234b70',1,0,1),
 (27,'WFR-025','Wilson','Wilson','202cb962ac59075b964b07152d234b70',1,0,1),
 (28,'WFR-026','Effendy','Effendy','202cb962ac59075b964b07152d234b70',1,0,1),
 (29,'WFR-027','Louis Sudin','Louis','202cb962ac59075b964b07152d234b70',1,0,1),
 (31,'WFR-028','Yanto','Yanto','202cb962ac59075b964b07152d234b70',1,0,1),
 (32,'WFR-029','Anto','Anto','202cb962ac59075b964b07152d234b70',1,0,1),
 (33,'WFR-030','Waila Fitri Sudharyanto','Waila','202cb962ac59075b964b07152d234b70',1,0,1),
 (34,'WFR-032','Tomy Agfianto Wijaya','Tomy','202cb962ac59075b964b07152d234b70',1,0,1),
 (35,'WFR-031','Robin Junior','Robin','202cb962ac59075b964b07152d234b70',1,0,1);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


--
-- Definition of table `employeeinbox`
--

DROP TABLE IF EXISTS `employeeinbox`;
CREATE TABLE `employeeinbox` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Employee` int(10) unsigned NOT NULL,
  `Message` text NOT NULL,
  `ViewDetailLink` varchar(100) DEFAULT NULL,
  `IsRead` tinyint(1) NOT NULL,
  `Subject` varchar(45) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `ReceivedDate` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_employeeinbox_employee` (`Employee`),
  CONSTRAINT `FK_employeeinbox_employee` FOREIGN KEY (`Employee`) REFERENCES `employee` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeinbox`
--

/*!40000 ALTER TABLE `employeeinbox` DISABLE KEYS */;
INSERT INTO `employeeinbox` (`Id`,`Employee`,`Message`,`ViewDetailLink`,`IsRead`,`Subject`,`LockField`,`ReceivedDate`) VALUES 
 (6,24,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=30',1,'approved transaction',8,'2014-11-28 09:00:45'),
 (7,24,'your transaction have been rejected, view detail for more information!','viewclaim.php?Id=32',1,'rejected transaction',1,'2014-12-03 16:30:35'),
 (8,24,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=34',1,'approved transaction',1,'2014-12-17 17:22:13'),
 (9,24,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=34',1,'approved transaction',1,'2014-12-17 17:22:26'),
 (10,24,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=34',1,'approved transaction',1,'2014-12-17 17:22:47'),
 (11,24,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=34',1,'approved transaction',4,'2014-12-23 11:23:37'),
 (12,24,'your transaction at 2014-Dec-29 has been approved, click open for more information!','viewclaim.php?Id=37',1,'approved transaction',2,'2014-12-29 18:00:39'),
 (13,24,'your transaction at 2014-Dec-29 has been approved, click open for more information!','viewclaim.php?Id=37',0,'approved transaction',0,'2015-01-14 08:44:03');
/*!40000 ALTER TABLE `employeeinbox` ENABLE KEYS */;


--
-- Definition of table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE `travel` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  `StartDate` datetime NOT NULL,
  `UntilDate` datetime NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `Closed` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

/*!40000 ALTER TABLE `travel` DISABLE KEYS */;
INSERT INTO `travel` (`Id`,`Name`,`StartDate`,`UntilDate`,`LockField`,`Closed`) VALUES 
 (5,'Pelaksanaan UAT PT Ajinomoto di Mojokerto','2014-11-03 00:00:00','2014-11-07 00:00:00',1,0),
 (6,'Implementasi ESS PT Ajinomoto di Jakarta','2014-11-10 00:00:00','2014-11-14 00:00:00',0,0),
 (7,'RMK Support Trip','2014-12-26 00:00:00','2014-12-31 00:00:00',0,0);
/*!40000 ALTER TABLE `travel` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
