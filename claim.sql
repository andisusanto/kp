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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`Id`,`UserName`,`StoredPassword`,`IsActive`,`LockField`) VALUES 
 (25,'testing','202cb962ac59075b964b07152d234b70',1,1),
 (26,'andi','202cb962ac59075b964b07152d234b70',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininbox`
--

/*!40000 ALTER TABLE `admininbox` DISABLE KEYS */;
INSERT INTO `admininbox` (`Id`,`Message`,`ViewDetailLink`,`IsRead`,`Subject`,`LockField`,`ReceivedDate`) VALUES 
 (1,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=23',1,'a request need your approval',7,'1970-01-01 01:00:00'),
 (2,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=26',1,'a request need your approval',1,'0000-00-00 00:00:00'),
 (3,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=23',1,'a request need your approval',0,'0000-00-00 00:00:00'),
 (4,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=23',1,'a request need your approval',1,'0000-00-00 00:00:00'),
 (5,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=27',1,'a request need your approval',1,'0000-00-00 00:00:00'),
 (6,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=28',1,'a request need your approval',1,'0000-00-00 00:00:00'),
 (7,'this request need approval. for more information click viewdetail!','viewclaim.php?Id=29',1,'a request need your approval',1,'0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtransaction`
--

/*!40000 ALTER TABLE `claimtransaction` DISABLE KEYS */;
INSERT INTO `claimtransaction` (`Id`,`Employee`,`ClaimDate`,`Travel`,`Status`,`SubmissionNote`,`ApprovalNote`,`RejectionNote`,`LockField`,`ProcessedDate`) VALUES 
 (1,5,'0000-00-00 00:00:00',2,1,'Test',NULL,NULL,5,NULL),
 (7,5,'0000-00-00 00:00:00',2,1,'asads',NULL,NULL,3,NULL),
 (8,5,'0000-00-00 00:00:00',2,1,'21232',NULL,NULL,1,NULL),
 (9,5,'0000-00-00 00:00:00',2,1,'3123',NULL,NULL,1,NULL),
 (12,5,'0000-00-00 00:00:00',2,2,'rear','just submit it',NULL,2,NULL),
 (13,5,'0000-00-00 00:00:00',2,1,'2132',NULL,NULL,1,NULL),
 (14,5,'0000-00-00 00:00:00',2,1,'lalalala',NULL,NULL,1,NULL),
 (15,5,'0000-00-00 00:00:00',2,1,'1232131',NULL,NULL,1,NULL),
 (17,5,'2014-10-01 00:00:00',2,3,'32434',NULL,'asdasd',2,NULL),
 (18,5,'2014-10-01 00:00:00',2,2,'32434','2432432',NULL,2,NULL),
 (19,11,'2014-10-31 00:00:00',3,2,'just testing','Ok, Checked',NULL,2,NULL),
 (20,5,'2014-10-02 00:00:00',3,2,'CLAIM DIN AMA SIAO','Ok, Checked',NULL,4,NULL),
 (21,5,'2014-10-09 00:00:00',2,3,'claim aja',NULL,'itu amount terlalu gede, koq makannya enak x y',4,NULL),
 (22,15,'2014-11-12 00:00:00',2,3,'lalala',NULL,NULL,3,'2014-11-23 16:27:58'),
 (23,5,'2014-11-05 00:00:00',2,2,'12312','Approve this!!',NULL,2,NULL),
 (25,5,'2014-11-06 00:00:00',2,1,'123123',NULL,NULL,1,NULL),
 (26,5,'2014-11-07 00:00:00',2,2,'312312','I Approved this tranasction',NULL,2,NULL),
 (27,5,'2014-11-21 00:00:00',3,3,'2312',NULL,'re',2,NULL),
 (28,5,'2014-11-04 00:00:00',2,2,'312','312312',NULL,2,NULL),
 (29,5,'2014-11-04 00:00:00',2,3,'31',NULL,'rehj',2,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtransactiondetail`
--

/*!40000 ALTER TABLE `claimtransactiondetail` DISABLE KEYS */;
INSERT INTO `claimtransactiondetail` (`Id`,`ClaimTransaction`,`ClaimType`,`Amount`,`TransDate`,`Note`,`LockField`,`Attachment`) VALUES 
 (2,1,1,'180000.00','2014-04-04 00:00:00','U DO CHI-BYE',0,'77059-berani maju sedikit gue sikatt.jpg'),
 (8,1,2,'9000000.00','2014-05-05 00:00:00','suka hati saya claim',0,'89126-bodo amat.jpg'),
 (12,1,2,'20000.00','2014-05-05 00:00:00','test',0,'2426-bullshit bullshit everywhere.jpg'),
 (13,7,1,'20000.00','2014-04-04 00:00:00','makan siang',0,'47436-bullshit bullshit everywhere.jpg'),
 (14,7,2,'100000.00','2014-05-05 00:00:00','94932841',0,'20755-bisa diam gak kalau masih bacot gua blokir facebook loe.jpg'),
 (18,12,1,'200000.00','2014-04-08 00:00:00','23123',0,'92453-bisa diam gak kalau masih bacot gua blokir facebook loe.jpg'),
 (19,13,1,'2900.00','2014-04-09 00:00:00','90000',0,'35906-Alien 1.bmp'),
 (20,14,2,'400000.00','2014-04-08 00:00:00','testetseetse',0,'92468-Balloon.bmp'),
 (21,15,2,'400000.00','2014-04-08 00:00:00','231231',0,'22964-Da Vinci.bmp'),
 (22,18,2,'2312312.00','2014-04-08 00:00:00','123123123',0,'24435-Earth.bmp'),
 (23,17,1,'123123312312.00','2014-04-08 00:00:00','12312312312',0,'27697-Birthday Cake.bmp'),
 (24,19,1,'20000.00','2014-10-03 00:00:00','makan apa aja',0,'42340-Chocolate Cake.bmp'),
 (25,19,2,'100000.00','2014-10-03 00:00:00','w12123',0,'99618-Beaver.bmp'),
 (26,20,1,'500000.00','2014-10-03 00:00:00','MAKAN LOBSTER',0,'16613-Alien 1.bmp'),
 (27,20,2,'30000.00','2014-10-04 00:00:00','Cuci Kolor',0,'92324-Chocolate Cake.bmp'),
 (28,21,1,'40000.00','2014-04-02 00:00:00','makan steak',0,'95489-Chocolate Cake.bmp'),
 (29,21,2,'30000.00','2014-04-05 00:00:00','Cuci baju batik',0,'25479-Da Vinci.bmp'),
 (30,22,1,'40000.00','2014-11-05 00:00:00','\r\n23',0,'24642-bullshit bullshit everywhere.jpg'),
 (31,25,1,'20000.00','2014-11-05 00:00:00','makan sederhana',0,'33505-Alien 1.bmp'),
 (32,23,1,'10000.00','2014-11-10 00:00:00','12312',0,'88882-Balloon.bmp'),
 (33,26,1,'123123.00','2014-11-04 00:00:00','123123123',0,'38632-Birthday Cake.bmp'),
 (34,27,1,'213123.00','2014-10-02 00:00:00','12312',0,'52822-Da Vinci.bmp'),
 (35,28,2,'12312.00','2014-11-05 00:00:00','21321',0,'85317-Chocolate Cake.bmp'),
 (36,29,1,'3123.00','2014-11-04 00:00:00','312',0,'94558-Birthday Cake.bmp');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claimtype`
--

/*!40000 ALTER TABLE `claimtype` DISABLE KEYS */;
INSERT INTO `claimtype` (`Id`,`Code`,`Name`,`IsActive`,`LockField`) VALUES 
 (1,'001','Makan',1,1),
 (2,'002','Laundry',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`Id`,`Code`,`Name`,`UserName`,`StoredPassword`,`IsActive`,`LockField`,`ChangePasswordOnLogIn`) VALUES 
 (5,'23123','susanto','susanto','caf1a3dfb505ffed0d024130f58c5cfa',1,3,0),
 (10,'123123123123','Antoni','Antoni','caf1a3dfb505ffed0d024130f58c5cfa',1,3,0),
 (11,'231231','Andi','AndiSusanto','caf1a3dfb505ffed0d024130f58c5cfa',1,1,0),
 (15,'123321','123','123','3d186804534370c3c817db0563f0e461',1,1,0),
 (17,'1010','Andi Susanto','andis','202cb962ac59075b964b07152d234b70',1,4,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeinbox`
--

/*!40000 ALTER TABLE `employeeinbox` DISABLE KEYS */;
INSERT INTO `employeeinbox` (`Id`,`Employee`,`Message`,`ViewDetailLink`,`IsRead`,`Subject`,`LockField`,`ReceivedDate`) VALUES 
 (1,5,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=26',1,'approved transaction',8,'1970-01-01 01:00:00'),
 (2,5,'your transaction have been rejected, view detail for more information!','viewclaim.php?Id=27',1,'rejected transaction',2,'1970-01-01 01:00:00'),
 (3,5,'your transaction have been approved, view detail for more information!','viewclaim.php?Id=28',1,'approved transaction',1,'0000-00-00 00:00:00'),
 (4,5,'your transaction have been rejected, view detail for more information!','viewclaim.php?Id=29',1,'rejected transaction',1,'0000-00-00 00:00:00'),
 (5,15,'your transaction have been rejected, view detail for more information!','viewclaim.php?Id=22',0,'rejected transaction',0,'2014-11-23 16:27:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

/*!40000 ALTER TABLE `travel` DISABLE KEYS */;
INSERT INTO `travel` (`Id`,`Name`,`StartDate`,`UntilDate`,`LockField`,`Closed`) VALUES 
 (2,'JKT Trip','2014-11-01 00:00:00','2014-11-29 00:00:00',6,0),
 (3,'SG Trip','2014-10-01 00:00:00','2014-11-01 00:00:00',2,0),
 (4,'123','2014-11-07 00:00:00','2014-11-21 00:00:00',0,1);
/*!40000 ALTER TABLE `travel` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
