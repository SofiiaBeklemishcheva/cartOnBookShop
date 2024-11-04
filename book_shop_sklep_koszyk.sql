-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: book_shop
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sklep_koszyk`
--

DROP TABLE IF EXISTS `sklep_koszyk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sklep_koszyk` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `produkt_id` int DEFAULT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `cena` decimal(2,0) DEFAULT NULL,
  `ilość` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sklep_koszyk`
--

LOCK TABLES `sklep_koszyk` WRITE;
/*!40000 ALTER TABLE `sklep_koszyk` DISABLE KEYS */;
INSERT INTO `sklep_koszyk` VALUES (1,35,'Miasteczko Salem',40,1),(2,35,'Miasteczko Salem',40,1),(3,32,'To',60,1),(4,35,'Miasteczko Salem',40,1),(5,32,'To',60,1),(6,35,'Miasteczko Salem',40,1),(7,32,'To',60,1),(8,35,'Miasteczko Salem',40,2),(9,32,'To',60,1),(10,32,'To',60,1),(11,32,'To',60,1),(12,34,'Misery',20,1),(13,32,'To',60,1),(14,34,'Misery',20,1),(15,37,'Śmierć na Nilu',79,1),(16,32,'To',60,1),(17,34,'Misery',20,1),(18,37,'Śmierć na Nilu',79,1),(19,35,'Miasteczko Salem',40,1),(20,32,'To',60,1),(21,34,'Misery',20,1),(22,37,'Śmierć na Nilu',79,1),(23,35,'Miasteczko Salem',40,1),(24,32,'To',60,1),(25,34,'Misery',20,2),(26,37,'Śmierć na Nilu',79,1),(27,35,'Miasteczko Salem',40,1),(28,32,'To',60,1),(29,34,'Misery',20,2),(30,37,'Śmierć na Nilu',79,1),(31,35,'Miasteczko Salem',40,2);
/*!40000 ALTER TABLE `sklep_koszyk` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-30 16:54:12
