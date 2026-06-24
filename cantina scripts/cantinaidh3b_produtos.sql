-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: cantinaidh3b
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) DEFAULT 0,
  `ativo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Salgado Assado (Frango com Catupiry)',7.50,40,1,'2026-03-24 16:37:00'),(2,'Salgado Assado (Hamburgão)',8.00,35,1,'2026-03-24 16:37:00'),(3,'Pão de Queijo Grande',5.00,50,1,'2026-03-24 16:37:00'),(4,'Esfiha de Carne',7.00,30,1,'2026-03-24 16:37:00'),(5,'Enroladinho de Presunto e Queijo',7.50,25,1,'2026-03-24 16:37:00'),(6,'Mini Pizza de Muçarela',8.50,20,1,'2026-03-24 16:37:00'),(7,'Sanduíche Natural de Frango',12.00,15,1,'2026-03-24 16:37:00'),(8,'Suco de Lata 350ml (Uva/Laranja)',6.50,45,1,'2026-03-24 16:37:00'),(9,'Suco Natural de Laranja 400ml',9.00,20,1,'2026-03-24 16:37:00'),(10,'Refrigerante Lata 350ml',6.00,60,1,'2026-03-24 16:37:00'),(11,'Água Mineral 500ml',3.50,100,1,'2026-03-24 16:37:00'),(12,'Água de Coco Caixinha',7.00,25,1,'2026-03-24 16:37:00'),(13,'Achocolatado de Caixinha',5.50,40,1,'2026-03-24 16:37:00'),(14,'Barra de Cereal Morango',3.00,50,1,'2026-03-24 16:37:00'),(15,'Pacote de Bolacha Recheada',4.50,30,1,'2026-03-24 16:37:00'),(16,'Batata Chips Pacote Médio',7.00,25,1,'2026-03-24 16:37:00'),(17,'Chocolate em Barra (30g)',4.00,40,1,'2026-03-24 16:37:00'),(18,'Gelatina no Copo',3.50,15,1,'2026-03-24 16:37:00'),(19,'Salada de Frutas Pequena',8.00,12,1,'2026-03-24 16:37:00'),(20,'Bolo de Cenoura (Fatia)',6.00,18,1,'2026-03-24 16:37:00'),(21,'Coxinha',5.00,100,1,'2026-03-24 22:16:23');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-24  8:42:54
