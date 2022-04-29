CREATE DATABASE  IF NOT EXISTS `monmeta` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `monmeta`;
-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: monmeta
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_id_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan','AF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(2,'Åland Islands','AX','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(3,'Albania','AL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(4,'Algeria','DZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(5,'American Samoa','AS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(6,'Andorra','AD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(7,'Angola','AO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(8,'Anguilla','AI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(9,'Antarctica','AQ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(10,'Antigua and Barbuda','AG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(11,'Argentina','AR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(12,'Armenia','AM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(13,'Aruba','AW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(14,'Australia','AU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(15,'Austria','AT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(16,'Azerbaijan','AZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(17,'Bahamas','BS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(18,'Bahrain','BH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(19,'Bangladesh','BD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(20,'Barbados','BB','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(21,'Belarus','BY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(22,'Belgium','BE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(23,'Belize','BZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(24,'Benin','BJ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(25,'Bermuda','BM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(26,'Bhutan','BT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(27,'Bolivia, Plurinational State of','BO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(28,'Bonaire, Sint Eustatius and Saba','BQ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(29,'Bosnia and Herzegovina','BA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(30,'Botswana','BW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(31,'Bouvet Island','BV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(32,'Brazil','BR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(33,'British Indian Ocean Territory','IO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(34,'Brunei Darussalam','BN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(35,'Bulgaria','BG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(36,'Burkina Faso','BF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(37,'Burundi','BI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(38,'Cambodia','KH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(39,'Cameroon','CM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(40,'Canada','CA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(41,'Cape Verde','CV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(42,'Cayman Islands','KY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(43,'Central African Republic','CF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(44,'Chad','TD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(45,'Chile','CL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(46,'China','CN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(47,'Christmas Island','CX','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(48,'Cocos (Keeling) Islands','CC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(49,'Colombia','CO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(50,'Comoros','KM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(51,'Congo','CG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(52,'Congo, the Democratic Republic of the','CD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(53,'Cook Islands','CK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(54,'Costa Rica','CR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(55,'Côte d\'Ivoire','CI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(56,'Croatia','HR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(57,'Cuba','CU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(58,'Curaçao','CW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(59,'Cyprus','CY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(60,'Czech Republic','CZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(61,'Denmark','DK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(62,'Djibouti','DJ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(63,'Dominica','DM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(64,'Dominican Republic','DO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(65,'Ecuador','EC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(66,'Egypt','EG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(67,'El Salvador','SV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(68,'Equatorial Guinea','GQ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(69,'Eritrea','ER','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(70,'Estonia','EE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(71,'Ethiopia','ET','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(72,'Falkland Islands (Malvinas)','FK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(73,'Faroe Islands','FO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(74,'Fiji','FJ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(75,'Finland','FI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(76,'France','FR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(77,'French Guiana','GF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(78,'French Polynesia','PF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(79,'French Southern Territories','TF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(80,'Gabon','GA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(81,'Gambia','GM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(82,'Georgia','GE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(83,'Germany','DE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(84,'Ghana','GH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(85,'Gibraltar','GI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(86,'Greece','GR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(87,'Greenland','GL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(88,'Grenada','GD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(89,'Guadeloupe','GP','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(90,'Guam','GU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(91,'Guatemala','GT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(92,'Guernsey','GG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(93,'Guinea','GN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(94,'Guinea-Bissau','GW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(95,'Guyana','GY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(96,'Haiti','HT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(97,'Heard Island and McDonald Islands','HM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(98,'Holy See (Vatican City State)','VA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(99,'Honduras','HN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(100,'Hong Kong','HK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(101,'Hungary','HU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(102,'Iceland','IS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(103,'India','IN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(104,'Indonesia','ID','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(105,'Iran, Islamic Republic of','IR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(106,'Iraq','IQ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(107,'Ireland','IE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(108,'Isle of Man','IM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(109,'Israel','IL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(110,'Italy','IT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(111,'Jamaica','JM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(112,'Japan','JP','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(113,'Jersey','JE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(114,'Jordan','JO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(115,'Kazakhstan','KZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(116,'Kenya','KE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(117,'Kiribati','KI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(118,'Korea, Democratic People\'s Republic of','KP','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(119,'Korea, Republic of','KR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(120,'Kuwait','KW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(121,'Kyrgyzstan','KG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(122,'Lao People\'s Democratic Republic','LA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(123,'Latvia','LV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(124,'Lebanon','LB','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(125,'Lesotho','LS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(126,'Liberia','LR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(127,'Libya','LY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(128,'Liechtenstein','LI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(129,'Lithuania','LT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(130,'Luxembourg','LU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(131,'Macao','MO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(132,'Macedonia, the Former Yugoslav Republic of','MK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(133,'Madagascar','MG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(134,'Malawi','MW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(135,'Malaysia','MY','mykad','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(136,'Maldives','MV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(137,'Mali','ML','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(138,'Malta','MT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(139,'Marshall Islands','MH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(140,'Martinique','MQ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(141,'Mauritania','MR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(142,'Mauritius','MU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(143,'Mayotte','YT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(144,'Mexico','MX','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(145,'Micronesia, Federated States of','FM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(146,'Moldova, Republic of','MD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(147,'Monaco','MC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(148,'Mongolia','MN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(149,'Montenegro','ME','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(150,'Montserrat','MS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(151,'Morocco','MA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(152,'Mozambique','MZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(153,'Myanmar','MM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(154,'Namibia','NA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(155,'Nauru','NR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(156,'Nepal','NP','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(157,'Netherlands','NL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(158,'New Caledonia','NC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(159,'New Zealand','NZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(160,'Nicaragua','NI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(161,'Niger','NE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(162,'Nigeria','NG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(163,'Niue','NU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(164,'Norfolk Island','NF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(165,'Northern Mariana Islands','MP','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(166,'Norway','NO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(167,'Oman','OM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(168,'Pakistan','PK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(169,'Palau','PW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(170,'Palestine, State of','PS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(171,'Panama','PA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(172,'Papua New Guinea','PG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(173,'Paraguay','PY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(174,'Peru','PE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(175,'Philippines','PH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(176,'Pitcairn','PN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(177,'Poland','PL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(178,'Portugal','PT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(179,'Puerto Rico','PR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(180,'Qatar','QA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(181,'Réunion','RE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(182,'Romania','RO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(183,'Russian Federation','RU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(184,'Rwanda','RW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(185,'Saint Barthélemy','BL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(186,'Saint Helena, Ascension and Tristan da Cunha','SH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(187,'Saint Kitts and Nevis','KN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(188,'Saint Lucia','LC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(189,'Saint Martin (French part)','MF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(190,'Saint Pierre and Miquelon','PM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(191,'Saint Vincent and the Grenadines','VC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(192,'Samoa','WS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(193,'San Marino','SM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(194,'Sao Tome and Principe','ST','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(195,'Saudi Arabia','SA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(196,'Senegal','SN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(197,'Serbia','RS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(198,'Seychelles','SC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(199,'Sierra Leone','SL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(200,'Singapore','SG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(201,'Sint Maarten (Dutch part)','SX','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(202,'Slovakia','SK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(203,'Slovenia','SI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(204,'Solomon Islands','SB','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(205,'Somalia','SO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(206,'South Africa','ZA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(207,'South Georgia and the South Sandwich Islands','GS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(208,'South Sudan','SS','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(209,'Spain','ES','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(210,'Sri Lanka','LK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(211,'Sudan','SD','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(212,'Suriname','SR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(213,'Svalbard and Jan Mayen','SJ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(214,'Swaziland','SZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(215,'Sweden','SE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(216,'Switzerland','CH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(217,'Syrian Arab Republic','SY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(218,'Taiwan, Province of China','TW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(219,'Tajikistan','TJ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(220,'Tanzania, United Republic of','TZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(221,'Thailand','TH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(222,'Timor-Leste','TL','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(223,'Togo','TG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(224,'Tokelau','TK','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(225,'Tonga','TO','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(226,'Trinidad and Tobago','TT','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(227,'Tunisia','TN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(228,'Turkey','TR','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(229,'Turkmenistan','TM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(230,'Turks and Caicos Islands','TC','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(231,'Tuvalu','TV','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(232,'Uganda','UG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(233,'Ukraine','UA','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(234,'United Arab Emirates','AE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(235,'United Kingdom','GB','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(236,'United States','US','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(237,'United States Minor Outlying Islands','UM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(238,'Uruguay','UY','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(239,'Uzbekistan','UZ','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(240,'Vanuatu','VU','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(241,'Venezuela, Bolivarian Republic of','VE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(242,'Viet Nam','VN','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(243,'Virgin Islands, British','VG','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(244,'Virgin Islands, U.S.','VI','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(245,'Wallis and Futuna','WF','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(246,'Western Sahara','EH','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(247,'Yemen','YE','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(248,'Zambia','ZM','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(249,'Zimbabwe','ZW','passport','2022-04-28 17:42:36','2022-04-28 17:42:36',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_histories`
--

DROP TABLE IF EXISTS `game_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nft_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_season_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `duration` bigint(20) unsigned DEFAULT '0' COMMENT 'in milliseconds',
  `position` bigint(20) unsigned NOT NULL DEFAULT '1',
  `points` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_histories_uuid_unique` (`uuid`),
  KEY `game_histories_nft_id_foreign` (`nft_id`),
  KEY `game_histories_game_id_foreign` (`game_id`),
  KEY `game_histories_room_id_index` (`room_id`),
  KEY `game_histories_game_season_id_index` (`game_season_id`),
  CONSTRAINT `game_histories_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `game_histories_nft_id_foreign` FOREIGN KEY (`nft_id`) REFERENCES `nfts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_histories`
--

LOCK TABLES `game_histories` WRITE;
/*!40000 ALTER TABLE `game_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `games_uuid_index` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2022_04_05_075624_create_activity_log_table',1),(10,'2022_04_13_053722_create_countries_table',1),(11,'2022_04_13_054138_add_columns_in_users_table',1),(12,'2022_04_13_060647_create_tiers_table',1),(13,'2022_04_13_060759_create_nfts_table',1),(14,'2022_04_13_061208_create_nft_tier_table',1),(15,'2022_04_13_061942_create_nft_stars_table',1),(16,'2022_04_13_062411_create_games_table',1),(17,'2022_04_13_062513_create_game_histories_table',1),(18,'2022_04_13_063233_create_transactions_table',1),(19,'2022_04_17_063935_add_uuid_in_game_histories_table',1),(20,'2022_04_19_145419_add_status_in_nft_tier_table',1),(21,'2022_04_20_023057_add_currency_into_transactions_table',1),(22,'2022_04_22_164718_add_game_season_id_in_transactions_table',1),(23,'2022_04_28_120418_add_financial_info_in_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nft_stars`
--

DROP TABLE IF EXISTS `nft_stars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nft_stars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nft_id` bigint(20) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_stars_nft_id_foreign` (`nft_id`),
  CONSTRAINT `nft_stars_nft_id_foreign` FOREIGN KEY (`nft_id`) REFERENCES `nfts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nft_stars`
--

LOCK TABLES `nft_stars` WRITE;
/*!40000 ALTER TABLE `nft_stars` DISABLE KEYS */;
/*!40000 ALTER TABLE `nft_stars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nft_tier`
--

DROP TABLE IF EXISTS `nft_tier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nft_tier` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nft_id` bigint(20) unsigned NOT NULL,
  `tier_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_tier_nft_id_foreign` (`nft_id`),
  KEY `nft_tier_tier_id_foreign` (`tier_id`),
  CONSTRAINT `nft_tier_nft_id_foreign` FOREIGN KEY (`nft_id`) REFERENCES `nfts` (`id`),
  CONSTRAINT `nft_tier_tier_id_foreign` FOREIGN KEY (`tier_id`) REFERENCES `tiers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nft_tier`
--

LOCK TABLES `nft_tier` WRITE;
/*!40000 ALTER TABLE `nft_tier` DISABLE KEYS */;
/*!40000 ALTER TABLE `nft_tier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nfts`
--

DROP TABLE IF EXISTS `nfts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nfts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `token_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nfts_user_id_foreign` (`user_id`),
  KEY `nfts_token_id_index` (`token_id`),
  KEY `nfts_status_index` (`status`),
  CONSTRAINT `nfts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nfts`
--

LOCK TABLES `nfts` WRITE;
/*!40000 ALTER TABLE `nfts` DISABLE KEYS */;
/*!40000 ALTER TABLE `nfts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Monmeta Personal Access Client','Oo5riiMFSqRQ0PyncN2aMwEaYjg3ffLT20O6TDND',NULL,'http://localhost',1,0,0,'2022-04-28 17:43:09','2022-04-28 17:43:09');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2022-04-28 17:43:09','2022-04-28 17:43:09');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiers`
--

DROP TABLE IF EXISTS `tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars_required` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiers`
--

LOCK TABLES `tiers` WRITE;
/*!40000 ALTER TABLE `tiers` DISABLE KEYS */;
INSERT INTO `tiers` VALUES (1,'Spaceflight Participant',0,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(2,'Technical Operator',5,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(3,'Flight Engineer',10,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(4,'Scienctist Cosmonaut',15,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(5,'Pilot Cosmonaut',20,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(6,'Commander',25,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL),(7,'The Administrator',30,'2022-04-28 17:42:36','2022-04-28 17:42:36',NULL);
/*!40000 ALTER TABLE `tiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceable_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) unsigned NOT NULL DEFAULT '0',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimals` int(10) unsigned NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_sourceable_type_sourceable_id_index` (`sourceable_type`,`sourceable_id`),
  KEY `transactions_hash_id_index` (`hash_id`),
  KEY `transactions_type_index` (`type`),
  KEY `transactions_status_index` (`status`),
  KEY `transactions_game_season_id_index` (`game_season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wallet_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality_id` bigint(20) unsigned DEFAULT NULL,
  `personal_id_type` enum('mykad','passport') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_id_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_purchase` bigint(20) unsigned NOT NULL DEFAULT '0',
  `total_prize_claim` bigint(20) unsigned NOT NULL DEFAULT '0',
  `balance` bigint(20) NOT NULL DEFAULT '0',
  `decimals` int(10) unsigned NOT NULL DEFAULT '0',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_wallet_id_index` (`wallet_id`),
  KEY `users_email_index` (`email`),
  KEY `users_contact_no_index` (`contact_no`),
  KEY `users_personal_id_type_index` (`personal_id_type`),
  KEY `users_personal_id_no_index` (`personal_id_no`),
  KEY `users_nationality_id_foreign` (`nationality_id`),
  CONSTRAINT `users_nationality_id_foreign` FOREIGN KEY (`nationality_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2022-04-29  9:46:44
