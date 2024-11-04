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
-- Table structure for table `sklep_produkty`
--

DROP TABLE IF EXISTS `sklep_produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sklep_produkty` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) DEFAULT NULL,
  `cena` decimal(10,0) DEFAULT NULL,
  `linkZdjęcie` varchar(255) DEFAULT NULL,
  `gatunekID` int DEFAULT NULL,
  `autorID` int DEFAULT NULL,
  `stanMagazynowy` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sklep_produkty`
--

LOCK TABLES `sklep_produkty` WRITE;
/*!40000 ALTER TABLE `sklep_produkty` DISABLE KEYS */;
INSERT INTO `sklep_produkty` VALUES (32,'To',60,'Universal/to-stephen-king.jpg',1,10,20),(33,'Lśnienie',100,'Universal/lsnienie-stephen-king.jpg',1,10,5),(34,'Misery',20,'Universal/misery-stephen-king.jpg',2,10,2),(35,'Miasteczko Salem',40,'Universal/miasteczko-salem-stephen-king.jpg',1,10,10),(36,'Morderstwo w Orient Expressie',46,'Universal/morderstwo-w-orient-expressie-agatha-christie.jpg',3,9,16),(37,'Śmierć na Nilu',79,'Universal/smierc-na-nilu-agatha-christie.jpg',3,9,7),(38,'Dziesięciu Murzynków',83,'Universal/dziesieciu-murzynkow-agatha-christie.jpg',4,9,9),(39,'Zabójstwo Rogera Ackroyda',120,'Universal/zabojstwo-rogera-ackroyda-agatha-christie.jpg',3,9,14),(40,'Harry Potter i Kamień Filozoficzny',63,'Universal/harry-potter-and-the-philosopher-stone.jpg',5,8,6),(41,'Harry Potter i Komnata Tajemnic',36,'Universal/harry-potter-i-komnata-tajemnic-jk-rowling.jpg',5,8,7),(42,'Harry Potter i więzień Azkabanu',90,'Universal/harry-potter-i-wiezien-azkabanu-jk-rowling.jpg',5,8,8),(43,'Sto lat samotności',85,'Universal/sto-lat-samotnosci-gabriel-garcia-marquez.jpg',6,7,9),(44,'Miłość w czasach zarazy',72,'Universal/milosc-w-czasach-zarazy-gabriel-garcia-marquez.jpg',7,7,12),(45,'Kronika zapowiedzianej śmierci ',74,'Universal/kronika-zapowiedzianej-smierci-gabriel-garcia-marquez.jpg',4,7,14),(46,'Rok 1984',56,'Universal/rok-1984-george-orwell.jpg',8,6,2),(47,'Folwark zwierzęcy',50,'Universal/folwark-zwierzęcy-george-orwell.jpg',9,6,3),(48,'Brak tchu',200,'Universal/brak-tchu-george-orwell.jpg',10,6,0),(49,'Norwegian Wood',87,'Universal/norwegian-wood-haruki-murakami.jpeg',7,5,18),(50,'Kafka nad morzem',54,'Universal/kafka-nad-morzem-haruki-murakami.jpg',5,5,20),(51,'Kronika ptaka nakręcacza',42,'Universal/kronika-ptaka-nakrecacza-haruki-murakami.jpg',5,5,19),(52,'Fundacja',32,'Universal/fundacja-isaac-asimov.jpg',8,4,8),(53,'Ja, Robot',96,'Universal/ja-robot-isaac-asimov.jpg',8,4,16),(54,'Koniec Wieczności',99,'Universal/koniec-wiecznosci-isaac-asimov.jpg',8,4,2),(55,'Duma i uprzedzenie ',82,'Universal/duma-i-uprzedzenie-jane-austen.webp',11,3,3),(56,'Rozważna i romantyczna',64,'Universal/rozwarzna-i-romantyczna-jane-austen.jpg',11,3,1),(57,'Emma',45,'Universal/emma-jane-austen.jpg',11,3,50),(58,'Komu bije dzwon',77,'Universal/komu-bije-dzwon-ernest-hemingway.jpg',12,2,34),(59,'Stary człowiek i morze',61,'Universal/stary-czlowiek-i-morze-ernest-hemingway.jpg',12,2,9),(60,'Pożegnanie z bronią',94,'Universal/pozegnanie-z-bronia-ernest-hemingway.jpg',12,2,10),(61,'Władca Pierścieni',67,'Universal/władca-pierscieni-j-r-r-tolkien.jpg',5,1,2),(62,'Hobbit, czyli tam i z powrotem',35,'Universal/hobbit-czyli-tam-i-z-powrotem-j-r-r-tolkien.jpg',5,1,3),(63,'Silmarillion',46,'Universal/silmarillion-j-r-r-tolkien.jpg',5,1,4);
/*!40000 ALTER TABLE `sklep_produkty` ENABLE KEYS */;
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
