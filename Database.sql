-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: eSportsManager
-- ------------------------------------------------------
-- Server version	5.7.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idManager` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `logoURL` varchar(200) COLLATE utf8_spanish2_ci DEFAULT 'img/team_placeholder.png',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaBaja` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
INSERT INTO `equipos` VALUES (1,3,'Equipo Prueba 001','Este es un equipo de prueba!!','img/team_placeholder.png','2020-10-15 16:23:27',NULL);
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos_invitaciones`
--

DROP TABLE IF EXISTS `equipos_invitaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `equipos_invitaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipo` int(11) NOT NULL,
  `idJugador` int(11) NOT NULL,
  `respuesta` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaEnvio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaRespuesta` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos_invitaciones`
--

LOCK TABLES `equipos_invitaciones` WRITE;
/*!40000 ALTER TABLE `equipos_invitaciones` DISABLE KEYS */;
INSERT INTO `equipos_invitaciones` VALUES (1,1,2,'N','2020-10-15 17:55:22','2020-10-15 18:23:39'),(2,1,2,'N','2020-10-15 17:55:47','2020-10-15 18:23:39'),(3,1,2,'N','2020-10-15 17:56:58','2020-10-15 18:15:50'),(4,1,2,'N','2020-10-15 17:56:58','2020-10-15 18:23:39'),(5,1,2,'S','2020-10-15 18:03:28','2020-10-15 18:23:39'),(6,1,2,'N','2020-10-15 18:03:28','2020-10-15 18:23:39'),(7,1,2,'N','2020-10-15 18:15:50','2020-10-15 18:23:39'),(8,1,2,'N','2020-10-15 18:15:50','2020-10-15 18:23:39');
/*!40000 ALTER TABLE `equipos_invitaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos_jugadores`
--

DROP TABLE IF EXISTS `equipos_jugadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `equipos_jugadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipo` int(11) NOT NULL,
  `idJugador` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaBaja` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos_jugadores`
--

LOCK TABLES `equipos_jugadores` WRITE;
/*!40000 ALTER TABLE `equipos_jugadores` DISABLE KEYS */;
INSERT INTO `equipos_jugadores` VALUES (1,1,1,'2020-10-15 16:46:56',NULL),(2,1,2,'2020-10-15 16:46:56','2020-10-15 17:37:25'),(3,1,2,'2020-10-15 18:23:39',NULL);
/*!40000 ALTER TABLE `equipos_jugadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `avatarURL` varchar(200) COLLATE utf8_spanish2_ci DEFAULT 'img/player_placeholder.png',
  `nickname` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `steamID` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `psnID` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `xboxID` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `discordID` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `facebookURL` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `instagramURL` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `twitterURL` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sobreMi` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idPersona_UNIQUE` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugadores`
--

LOCK TABLES `jugadores` WRITE;
/*!40000 ALTER TABLE `jugadores` DISABLE KEYS */;
INSERT INTO `jugadores` VALUES (1,1,'img/player_placeholder.png','snowburn','https://steamcommunity.com/id/snowburn','https://psn.com/profile/ph_snowburn','https://xbox.live/snowburn','snowburn#6346','https://facebook.com/hernanbrega','https://instagram.com/hernanbrega','https://twitter.com/hbrega','Admin y Jugador del sitio'),(2,2,'img/player_placeholder.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `jugadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `linkedinID` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index2` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES (1,3,'https://ar.linkedin.com/in/juanlopez');
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoPersona` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `documento` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaNacimiento` datetime NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaBaja` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,1,'Hernan','Brega','test01@test.com','81dc9bdb52d04dc20036dbd8313ed055','29501053','1982-05-15 00:00:00','2020-10-15 03:00:00',NULL),(2,1,NULL,NULL,'test02@test.com','81dc9bdb52d04dc20036dbd8313ed055',NULL,'1980-01-01 00:00:00','2020-10-15 03:00:00',NULL),(3,2,'Juan','Lopez','manager01@test.com','81dc9bdb52d04dc20036dbd8313ed055','32632531','1980-01-01 00:00:00','2020-10-15 15:14:47',NULL);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposPersona`
--

DROP TABLE IF EXISTS `tiposPersona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tiposPersona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposPersona`
--

LOCK TABLES `tiposPersona` WRITE;
/*!40000 ALTER TABLE `tiposPersona` DISABLE KEYS */;
INSERT INTO `tiposPersona` VALUES (1,'Jugador'),(2,'Manager');
/*!40000 ALTER TABLE `tiposPersona` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-15 15:24:18
