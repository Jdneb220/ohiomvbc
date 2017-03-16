-- MySQL dump 10.13  Distrib 5.5.19, for Linux (x86_64)
--
-- Host: 68.178.143.102    Database: ohiomvbc
-- ------------------------------------------------------
-- Server version	5.5.43-37.2-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Sports Express Cincinnati','Sports Express, 5280 Ohio 741, Mason, OH 45040','www.sportsexpressvb.com/');
INSERT INTO `locations` VALUES (2,'BVC','709 Miles Point Way Lexington KY','www.bluegrassvolleyball.com');
INSERT INTO `locations` VALUES (3,'WHBC Washington Heights','5650 Far Hills Ave Dayton, Ohio','www.whbc.org/');
INSERT INTO `locations` VALUES (4,'TBA','Dayton, Ohio','http://www.ohiomvbc.org');
INSERT INTO `locations` VALUES (5,'Gametime Sports Center','5151 Bogles Run Rd Urbana, Ohio','https://www.facebook.com/Game-Time-Sports-Center-267977823255503/');
INSERT INTO `locations` VALUES (7,'Stivers School','1313 E 5th St, Dayton, OH 45402','www.stivers.org');
INSERT INTO `locations` VALUES (8,'Washington Heights Baptist Church','5650 Far Hills Ave, Dayton, OH 45429','www.whbc.org');
INSERT INTO `locations` VALUES (9,'Rivers Edge Montessori School','108 Linwood St.  Dayton Ohio 45405','www.dps.k12.oh.us/rivers-edge');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Venue` varchar(100) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `Details` varchar(450) DEFAULT NULL,
  `Format` varchar(100) DEFAULT NULL,
  `Level` varchar(100) DEFAULT NULL,
  `Cost` varchar(20) DEFAULT NULL,
  `Payout` varchar(20) DEFAULT NULL,
  `teams` varchar(2000) DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (11,'Mens A & B/BB','Rivers Edge Montessori School','2015-12-13 00:00:00','2015-12-13 00:00:00','Pool play will run 2 str8 games to 25 with a 27 point cap.  If there are 6 teams,  we will take the top 4, if there is only 5, will take the top 3.  Pool play will start at 830 Sharp, should be done before 6.  If I get 6 teams in each division, ill pay out 120, if I get 5 teams in each division ill pay back the entry.  Also, there is no window issue here.  :)','Mens','A & B/BB','70.00','120.00','');
INSERT INTO `tournaments` VALUES (10,'Mens A & B/BB','Rivers Edge Montessori School','2015-12-06 00:00:00','2015-12-06 00:00:00','Pool play will run 2 str8 games to 25 with a 27 point cap.  If there are 6 teams,  we will take the top 4, if there is only 5, will take the top 3.  Pool play will start at 830 Sharp, should be done before 6.  If I get 6 teams in each division, ill pay out 120, if I get 5 teams in each division ill pay back the entry.  Also, no window issue either.  :)','Mens','A & B/BB','70.00','120.00','');
INSERT INTO `tournaments` VALUES (12,'Mens B & BB','Rivers Edge Montessori School','2015-12-20 00:00:00','2015-12-20 00:00:00','Pool play will run 2 str8 games to 25 with a 27 point cap.  If there are 6 teams,  we will take the top 4, if there is only 5, will take the top 3.  Pool play will start at 830 Sharp, should be done before 6.  If I get 6 teams in each division, ill pay out 120, if I get 5 teams in each division ill pay back the entry.  Also, no window issue.  :)','Mens','B & BB','70.00','120.00','');
INSERT INTO `tournaments` VALUES (13,'Co-Ed High & Low Benefit Tournament','Gametime Sports Center','2015-12-27 00:00:00','2015-12-27 00:00:00','Cancer Benefit Tournament.  This tournament is a benefit for the cancer society.  After the cost of the tournament, 100% of the balance is paid to the Cancer Society.','Co-Ed','High & Low','200.00','','');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-18  6:01:51
