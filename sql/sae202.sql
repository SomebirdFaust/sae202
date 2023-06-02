-- MySQL dump 10.19  Distrib 10.3.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sae202
-- ------------------------------------------------------
-- Server version	10.3.36-MariaDB-0+deb10u2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(30) NOT NULL,
  `user_prenom` varchar(20) NOT NULL,
  `user_mail` varchar(100) NOT NULL,
  `user_mdp` varchar(20) NOT NULL,
  `user_genre` varchar(10) NOT NULL,
  `user_bio` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Dylan','Bob','bob.dylan@random.com','jzbdiazu `','homme','blabla1'),(2,'Mirabel','Paul','paul.mirabel@random.com','izejhdoi','homme','blabla2'),(3,'Felpin','Laura','laura.felpin@random.com','jehfzenfz','femme','blabla3'),(4,'Newton','Isaac','isaac.newton@random.com','jreobfjzenfo','homme','blabla4'),(5,'John','Jordan','jordan.john@random.com','ihfiob\'iof','homme','blabla5'),(6,'Boss','Hugo','hugo.boss@random.com','irnctuby\'','homme','blabla6'),(7,'Armani','Georgio','georgio.armani@random.com','zr\'ibuczv\'oiunc','homme','blabla7'),(8,'Balavoine','Daniel','daniel.balavoine@random.com','rehriuncb\'cib','homme','blabla8'),(9,'Duru','Mathis','mathis.duru@random.com','iorztynoetkvn','homme','blabla9'),(10,'Salade','Chloe','chloe.salade@random.com','iozertycbzt','femme','blabla10');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-01 14:15:03
