-- MySQL dump 10.13  Distrib 5.6.16, for Linux (i686)
--
-- Host: localhost    Database: CONJOURN
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_keys`
--

DROP TABLE IF EXISTS `api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_keys` (
  `email` varchar(100) DEFAULT NULL,
  `accountid` varchar(40) DEFAULT NULL,
  `authtoken` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_keys`
--

LOCK TABLES `api_keys` WRITE;
/*!40000 ALTER TABLE `api_keys` DISABLE KEYS */;
INSERT INTO `api_keys` VALUES ('vgh4uster@gmail.com','AC039eede063a62ee1210452cfd115329b','2a707b93848e765a57cecafaff99e3ab'),('bijilap@gmail.com','AC76bb6d1d2ab5ce21018ec74522e418be','516ea02dd2fe75d17f7f00fd7840a69c');
/*!40000 ALTER TABLE `api_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `emailid` varchar(100) DEFAULT NULL,
  `contact_list` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES ('bijilap@gmail.com','(\'vgh4uster@gmail.com\',\'harsh150791@gmail.com\',\'arulrs2k9@gmail.com\',\'ravijey.psgit@gmail.com\',\'maithreyi.grao@gmail.com\',\'connecttobn@gmail.com\')'),('ravijey.psgit@gmail.com','(\'vgh4uster@gmail.com\',\'arulrs2k9@gmail.com\',\'bijilap@gmail.com\')'),('vgh4uster@gmail.com','(\'bijila@gmail.com\',\'arulrs2k9@gmail.com\',\'ravijey.psgit@gmail.com\')');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gmailids_list`
--

DROP TABLE IF EXISTS `gmailids_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gmailids_list` (
  `user` varchar(100) DEFAULT NULL,
  `friend` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gmailids_list`
--

LOCK TABLES `gmailids_list` WRITE;
/*!40000 ALTER TABLE `gmailids_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `gmailids_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `email` varchar(100) NOT NULL,
  `twiliono` varchar(13) DEFAULT NULL,
  `phno` varchar(13) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `loclat` decimal(8,4) DEFAULT NULL,
  `loclong` decimal(8,4) DEFAULT NULL,
  `ploclat` decimal(8,4) DEFAULT NULL,
  `ploclong` decimal(8,4) DEFAULT NULL,
  `dispname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES ('bijilap@gmail.com','+1 424-279-49','+12132550684',NULL,34.0214,-118.2845,34.0214,-118.2845,'Bijil Philip'),('harsh150791@gmail.com','+919035297135','+918886782108',NULL,12.9667,77.5667,12.9667,77.5667,'Harsha P'),('ravijey.psgit@gmail.com','+1 4242856484','+1 2132559124',NULL,34.0215,-118.2845,34.0215,-118.2845,'Ravikumar Jeyaraman'),('vgh4uster@gmail.com','+1 5103715969','2132842648',NULL,34.0215,-118.2845,34.0215,-118.2845,'Vineet G H');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-09  4:21:37
