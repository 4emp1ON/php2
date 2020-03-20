-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: localhost    Database: gbphp
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `info` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Раскривушка','Очень хороший товар',250.00),(3,'Товар 3','Еще лучше',40.00),(9,'Test','Наш товар, ваш купец',120.00),(10,'Tests','Наш товар, ваш купец',120.00),(11,'Test','Наш товар, ваш купец',120.00),(12,'Test','Наш товар, ваш купец',120.00),(17,'Превосходного качества товар','Лучшие мастера трудились над этим чудом',500.00),(18,'Товар 30','Инфо товара 30',120.00),(19,'Тот еще товар','Очень хороший товар',700.00);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `goods` varchar(500) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `orderDate` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1},\"3\":{\"name\":\"Товар 3\",\"price\":\"40.00\",\"count\":1}}','fsdf','fsdf','2020-03-21 00:38:34',340.00),(3,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1},\"3\":{\"name\":\"Товар 3\",\"price\":\"40.00\",\"count\":1}}','fsdf','fsdf','2020-03-21 00:40:55',340.00),(4,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1},\"11\":{\"name\":\"Test\",\"price\":\"120.00\",\"count\":1},\"18\":{\"name\":\"Товар 30\",\"price\":\"120.00\",\"count\":1}}','fsdf','fsdf','2020-03-21 00:42:47',540.00),(5,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1},\"10\":{\"name\":\"Tests\",\"price\":\"120.00\",\"count\":1},\"11\":{\"name\":\"Test\",\"price\":\"120.00\",\"count\":1}}','faihundin@mail.ru','Кулакова 25','2020-03-21 00:56:30',540.00),(6,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":2},\"11\":{\"name\":\"Test\",\"price\":\"120.00\",\"count\":1}}','faihundin@mail.ru','Кулакова 25','2020-03-21 00:57:27',720.00),(7,0,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1}}','4emp1on@mail.ru','Кулакова 25','2020-03-21 01:12:47',300.00),(8,1,'{\"1\":{\"name\":\"Раскривушка\",\"price\":\"300.00\",\"count\":1},\"10\":{\"name\":\"Tests\",\"price\":\"120.00\",\"count\":1},\"18\":{\"name\":\"Товар 30\",\"price\":\"120.00\",\"count\":1}}','valeriy-olyunin@yandex.ru','ул. Лермонтова 25','2020-03-21 01:56:41',540.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `isAdmin` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$FKCMqpMG8Ap6Qm0hQZGv4uBhjdmDjuvn0h.0ymD5jpnNtzfNDZGNK',1),(2,'guest',NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21  2:02:00
