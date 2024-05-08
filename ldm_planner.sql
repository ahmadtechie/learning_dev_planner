-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ld_planner2
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `competency`
--

DROP TABLE IF EXISTS `competency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competency` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `competency_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competency_name` (`competency_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competency`
--

LOCK TABLES `competency` WRITE;
/*!40000 ALTER TABLE `competency` DISABLE KEYS */;
INSERT INTO `competency` VALUES (1,'Project management',NULL,'2024-04-20 07:23:30','2024-04-20 07:23:30',NULL),(2,'Communication Skills','2024-02-22 15:07:06','2024-04-19 05:39:07',NULL,'Must possess good English communication skills'),(3,'Problem-solving','2024-02-24 02:47:23','2024-02-24 02:47:23',NULL,'Must be a great problem-solver'),(4,'Data Structure & Algo','2024-04-02 14:33:02','2024-04-02 14:33:02',NULL,'Deep knowledge of data structures and algorithms'),(5,'AWS','2024-04-02 14:34:11','2024-04-02 14:34:11',NULL,'Technical know-how of deploying and managing products on AWS'),(6,'Strategic thinking','2024-04-12 02:38:38','2024-04-12 02:38:38',NULL,'The need to have a clear vision of the organization\'s goals, values, and culture, and how they align with the current and future needs of the workforce'),(7,'Communication and collaboration','2024-04-12 02:39:16','2024-04-12 02:39:16',NULL,'You need to be able to communicate and collaborate effectively with various stakeholders, such as senior leaders, managers, employees, and external partners.'),(8,'Analytical and critical thinking','2024-04-12 02:40:02','2024-04-12 02:40:02',NULL,'You need to be able to use analytical and critical thinking skills to identify patterns, trends, gaps, and opportunities, and to evaluate the effectiveness and impact of talent management and succession planning initiatives'),(9,'Debugging Skills','2024-04-14 09:31:50','2024-04-14 09:31:50',NULL,'Must possess strong debugging skills'),(10,'Troubleshooting ','2024-04-26 19:59:56','2024-04-26 19:59:56',NULL,'Must possess strong troubleshooting skills');
/*!40000 ALTER TABLE `competency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competency_descriptor`
--

DROP TABLE IF EXISTS `competency_descriptor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competency_descriptor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `competency_id` int unsigned NOT NULL,
  `descriptor_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competency_descriptor_competency_id_foreign` (`competency_id`),
  CONSTRAINT `competency_descriptor_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competency_descriptor`
--

LOCK TABLES `competency_descriptor` WRITE;
/*!40000 ALTER TABLE `competency_descriptor` DISABLE KEYS */;
/*!40000 ALTER TABLE `competency_descriptor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(355) NOT NULL,
  `group_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_group_id_foreign` (`group_id`),
  CONSTRAINT `department_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (7,'FixamS',NULL,'2024-03-20 12:40:00','2024-04-02 07:53:20','2024-04-02 07:53:20'),(8,'Technical',NULL,'2024-04-02 07:53:14','2024-04-02 07:53:14',NULL),(9,'Finance',NULL,NULL,'2024-04-20 07:55:35','2024-04-20 07:55:35'),(10,'Human Resources',NULL,'2024-04-13 19:48:24','2024-04-13 19:48:24',NULL),(11,'Investment',3,'2024-04-26 19:15:08','2024-04-26 19:15:08',NULL);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `development_cycle`
--

DROP TABLE IF EXISTS `development_cycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `development_cycle` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `max_competencies` int unsigned NOT NULL DEFAULT '0',
  `cycle_year` int unsigned NOT NULL,
  `start_month` tinyint unsigned NOT NULL DEFAULT '1',
  `end_month` tinyint unsigned NOT NULL DEFAULT '1',
  `descriptor_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `development_cycle`
--

LOCK TABLES `development_cycle` WRITE;
/*!40000 ALTER TABLE `development_cycle` DISABLE KEYS */;
INSERT INTO `development_cycle` VALUES (1,2,2024,2,6,'',NULL,'2024-04-11 20:24:55',NULL,0),(6,4,2025,3,9,'','2024-04-11 19:19:28','2024-04-24 14:15:52',NULL,0),(8,4,2026,2,11,'','2024-04-14 09:35:22','2024-04-26 20:03:55',NULL,0),(9,3,2027,1,10,'',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `development_cycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `development_rating`
--

DROP TABLE IF EXISTS `development_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `development_rating` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned NOT NULL,
  `competency_id` int unsigned NOT NULL,
  `self_rating` int unsigned NOT NULL DEFAULT '0',
  `line_manager_rating` int unsigned NOT NULL DEFAULT '0',
  `cycle_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `development_rating_employee_id_foreign` (`employee_id`),
  KEY `development_rating_competency_id_foreign` (`competency_id`),
  KEY `development_rating_cycle_id_foreign` (`cycle_id`),
  CONSTRAINT `development_rating_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE,
  CONSTRAINT `development_rating_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  CONSTRAINT `development_rating_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `development_rating`
--

LOCK TABLES `development_rating` WRITE;
/*!40000 ALTER TABLE `development_rating` DISABLE KEYS */;
INSERT INTO `development_rating` VALUES (1,36,5,8,0,1,'2024-04-03 12:25:15','2024-04-03 12:25:15',NULL),(2,36,3,10,0,1,'2024-04-03 12:25:15','2024-04-03 12:25:15',NULL),(3,46,3,9,0,1,'2024-04-11 11:40:25','2024-04-11 11:40:25',NULL),(4,46,2,10,0,1,'2024-04-11 11:40:25','2024-04-11 11:40:25',NULL),(5,46,8,8,7,6,'2024-04-12 02:46:01','2024-04-13 19:23:38',NULL),(6,46,7,6,8,6,'2024-04-12 02:46:01','2024-04-13 19:23:38',NULL),(7,46,6,7,9,6,'2024-04-12 02:46:01','2024-04-13 19:23:38',NULL),(8,46,3,9,10,6,'2024-04-12 02:46:01','2024-04-13 19:23:38',NULL),(9,159,8,9,9,6,'2024-04-13 19:22:01','2024-04-13 19:23:38',NULL),(10,159,7,10,7,6,'2024-04-13 19:22:01','2024-04-13 19:23:38',NULL),(11,159,6,8,10,6,'2024-04-13 19:22:01','2024-04-13 19:23:38',NULL),(12,159,3,10,9,6,'2024-04-13 19:22:01','2024-04-13 19:23:38',NULL),(13,157,8,9,0,6,'2024-04-13 19:34:19','2024-04-13 19:34:19',NULL),(14,157,5,6,0,6,'2024-04-13 19:34:19','2024-04-13 19:34:19',NULL),(15,157,4,10,0,6,'2024-04-13 19:34:19','2024-04-13 19:34:19',NULL),(16,157,3,8,0,6,'2024-04-13 19:34:19','2024-04-13 19:34:19',NULL),(17,203,9,9,5,8,'2024-04-14 09:37:51','2024-04-22 09:01:06',NULL),(18,203,8,8,7,8,'2024-04-14 09:37:51','2024-04-22 09:01:06',NULL),(19,203,5,10,6,8,'2024-04-14 09:37:51','2024-04-22 09:01:06',NULL),(20,203,4,10,8,8,'2024-04-14 09:37:51','2024-04-22 09:01:06',NULL),(21,203,3,9,10,8,'2024-04-14 09:37:51','2024-04-22 09:01:06',NULL),(22,46,8,10,9,8,'2024-04-14 09:46:41','2024-04-22 09:01:06',NULL),(23,46,7,9,10,8,'2024-04-14 09:46:41','2024-04-22 09:01:06',NULL),(24,46,6,9,10,8,'2024-04-14 09:46:41','2024-04-22 09:01:06',NULL),(25,46,3,10,9,8,'2024-04-14 09:46:41','2024-04-22 09:01:06',NULL),(26,46,2,10,10,8,'2024-04-14 09:46:41','2024-04-22 09:01:06',NULL),(27,36,3,9,9,8,'2024-04-20 17:11:00','2024-04-22 09:01:06',NULL),(28,36,4,9,8,8,'2024-04-20 17:11:00','2024-04-22 09:01:06',NULL),(29,36,5,7,10,8,'2024-04-20 17:11:00','2024-04-22 09:01:06',NULL),(30,36,8,9,9,8,'2024-04-20 17:11:00','2024-04-22 09:01:06',NULL),(31,36,3,8,5,9,'2024-04-24 14:27:06','2024-04-26 20:24:06',NULL),(32,36,7,10,5,9,'2024-04-24 14:27:06','2024-04-26 20:24:06',NULL),(33,36,9,9,6,9,'2024-04-24 14:27:06','2024-04-26 20:24:06',NULL);
/*!40000 ALTER TABLE `development_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `division`
--

DROP TABLE IF EXISTS `division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `division` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `division_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `division`
--

LOCK TABLES `division` WRITE;
/*!40000 ALTER TABLE `division` DISABLE KEYS */;
INSERT INTO `division` VALUES (1,'Digital Marketing','2024-02-01 01:58:31','2024-02-20 11:32:00','2024-02-20 11:32:00'),(2,'Digital Services','2024-02-01 02:00:07','2024-02-01 02:10:35','2024-02-01 02:10:35'),(3,'Digital Services','2024-02-01 02:04:08','2024-02-20 10:10:00','2024-02-20 10:10:00'),(4,'Technology Solutions and Platforms','2024-02-01 02:16:49','2024-02-20 10:45:53','2024-02-20 10:45:53'),(5,'Digital Services','2024-02-20 10:10:09','2024-02-20 11:12:44','2024-02-20 11:12:44'),(6,'Technology Solutions and Platform','2024-02-20 10:47:40','2024-02-20 11:15:29',NULL),(7,'Technical','2024-02-20 11:01:02','2024-02-20 11:02:44','2024-02-20 11:02:44'),(8,'Digital Marketings','2024-02-20 11:03:02','2024-02-20 11:15:41','2024-02-20 11:15:41'),(9,'EPV','2024-02-20 11:04:20','2024-02-20 11:04:27','2024-02-20 11:04:27'),(10,'Digital Services','2024-02-20 16:03:50','2024-02-20 16:35:01','2024-02-20 16:35:01'),(11,'Digital Services','2024-02-20 16:35:11','2024-04-20 08:04:52','2024-04-20 08:04:52'),(12,'BDC','2024-03-20 12:13:30','2024-03-20 12:13:30',NULL),(13,'Finance','2024-03-20 12:37:20','2024-03-20 12:37:20',NULL),(14,'Technical','2024-04-26 19:13:50','2024-04-26 19:13:50',NULL);
/*!40000 ALTER TABLE `division` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_logs`
--

DROP TABLE IF EXISTS `email_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` enum('success','failed') NOT NULL DEFAULT 'success',
  `created_at` datetime DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intervention_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_logs`
--

LOCK TABLES `email_logs` WRITE;
/*!40000 ALTER TABLE `email_logs` DISABLE KEYS */;
INSERT INTO `email_logs` VALUES (118,'ahmad.sharafudeen@gmail.com','success','2024-04-14 12:57:24','cycle_invite','2024-04-14 11:57:24',NULL,NULL),(119,'uambursa.It@buk.edu.ng','success','2024-04-14 12:57:24','cycle_invite','2024-04-14 11:57:24',NULL,NULL),(120,'muneer@gmail.com','success','2024-04-14 12:57:25','cycle_invite','2024-04-14 11:57:25',NULL,NULL),(121,'jumai@gmail.com','success','2024-04-14 12:57:25','cycle_invite','2024-04-14 11:57:25',NULL,NULL),(122,'asharafudeenraji@gmail.com','success','2024-04-14 12:57:25','cycle_invite','2024-04-14 11:57:25',NULL,NULL),(123,'anike@gmail.com','success','2024-04-14 12:57:26','cycle_invite','2024-04-14 11:57:26',NULL,NULL),(124,'jamiu@gmail.com','success','2024-04-14 12:57:26','cycle_invite','2024-04-14 11:57:26',NULL,NULL),(125,'hkakudi.cs@buk.edu.ng','success','2024-04-14 12:57:27','cycle_invite','2024-04-14 11:57:27',NULL,NULL),(126,'yusuff.taiwo@gmail.com','success','2024-04-14 12:57:27','cycle_invite','2024-04-14 11:57:27',NULL,NULL),(127,'jane45@example.com','success','2024-04-14 12:57:27','cycle_invite','2024-04-14 11:57:27',NULL,NULL),(128,'jane46@example.com','success','2024-04-14 12:57:28','cycle_invite','2024-04-14 11:57:28',NULL,NULL),(129,'john47@example.com','success','2024-04-14 12:57:28','cycle_invite','2024-04-14 11:57:28',NULL,NULL),(130,'john27@example.com','success','2024-04-14 12:57:28','cycle_invite','2024-04-14 11:57:28',NULL,NULL),(131,'smith28@example.com','success','2024-04-14 12:57:29','cycle_invite','2024-04-14 11:57:29',NULL,NULL),(132,'john29@example.com','success','2024-04-14 12:57:29','cycle_invite','2024-04-14 11:57:29',NULL,NULL),(133,'jane30@example.com','success','2024-04-14 12:57:29','cycle_invite','2024-04-14 11:57:29',NULL,NULL),(134,'john31@example.com','success','2024-04-14 12:57:30','cycle_invite','2024-04-14 11:57:30',NULL,NULL),(135,'jane32@example.com','success','2024-04-14 12:57:30','cycle_invite','2024-04-14 11:57:30',NULL,NULL),(136,'smith33@example.com','success','2024-04-14 12:57:30','cycle_invite','2024-04-14 11:57:30',NULL,NULL),(137,'jane34@example.com','success','2024-04-14 12:57:30','cycle_invite','2024-04-14 11:57:30',NULL,NULL),(138,'jane35@example.com','success','2024-04-14 12:57:31','cycle_invite','2024-04-14 11:57:31',NULL,NULL),(139,'smith48@example.com','success','2024-04-14 12:57:31','cycle_invite','2024-04-14 11:57:31',NULL,NULL),(140,'smith49@example.com','success','2024-04-14 12:57:32','cycle_invite','2024-04-14 11:57:32',NULL,NULL),(141,'john1@example.com','success','2024-04-14 12:57:32','cycle_invite','2024-04-14 11:57:32',NULL,NULL),(142,'john2@example.com','success','2024-04-14 12:57:32','cycle_invite','2024-04-14 11:57:32',NULL,NULL),(143,'john3@example.com','success','2024-04-14 12:57:33','cycle_invite','2024-04-14 11:57:33',NULL,NULL),(144,'john4@example.com','success','2024-04-14 12:57:33','cycle_invite','2024-04-14 11:57:33',NULL,NULL),(145,'jane5@example.com','success','2024-04-14 12:57:33','cycle_invite','2024-04-14 11:57:33',NULL,NULL),(146,'john6@example.com','success','2024-04-14 12:57:34','cycle_invite','2024-04-14 11:57:34',NULL,NULL),(147,'smith7@example.com','success','2024-04-14 12:57:34','cycle_invite','2024-04-14 11:57:34',NULL,NULL),(148,'jane8@example.com','success','2024-04-14 12:57:34','cycle_invite','2024-04-14 11:57:34',NULL,NULL),(149,'smith9@example.com','success','2024-04-14 12:57:35','cycle_invite','2024-04-14 11:57:35',NULL,NULL),(150,'john10@example.com','success','2024-04-14 12:57:35','cycle_invite','2024-04-14 11:57:35',NULL,NULL),(151,'john11@example.com','success','2024-04-14 12:57:35','cycle_invite','2024-04-14 11:57:35',NULL,NULL),(152,'john12@example.com','success','2024-04-14 12:57:36','cycle_invite','2024-04-14 11:57:36',NULL,NULL),(153,'jane13@example.com','success','2024-04-14 12:57:36','cycle_invite','2024-04-14 11:57:36',NULL,NULL),(154,'jane14@example.com','success','2024-04-14 12:57:36','cycle_invite','2024-04-14 11:57:36',NULL,NULL),(155,'jane15@example.com','success','2024-04-14 12:57:37','cycle_invite','2024-04-14 11:57:37',NULL,NULL),(156,'smith16@example.com','success','2024-04-14 12:57:37','cycle_invite','2024-04-14 11:57:37',NULL,NULL),(157,'john17@example.com','success','2024-04-14 12:57:37','cycle_invite','2024-04-14 11:57:37',NULL,NULL),(158,'smith18@example.com','success','2024-04-14 12:57:37','cycle_invite','2024-04-14 11:57:37',NULL,NULL),(159,'jane19@example.com','success','2024-04-14 12:57:38','cycle_invite','2024-04-14 11:57:38',NULL,NULL),(160,'jane20@example.com','success','2024-04-14 12:57:38','cycle_invite','2024-04-14 11:57:38',NULL,NULL),(161,'john21@example.com','success','2024-04-14 12:57:38','cycle_invite','2024-04-14 11:57:38',NULL,NULL),(162,'jane22@example.com','success','2024-04-14 12:57:39','cycle_invite','2024-04-14 11:57:39',NULL,NULL),(163,'jane23@example.com','success','2024-04-14 12:57:39','cycle_invite','2024-04-14 11:57:39',NULL,NULL),(164,'jane24@example.com','success','2024-04-14 12:57:39','cycle_invite','2024-04-14 11:57:39',NULL,NULL),(165,'jane25@example.com','success','2024-04-14 12:57:40','cycle_invite','2024-04-14 11:57:40',NULL,NULL),(166,'jane26@example.com','success','2024-04-14 12:57:40','cycle_invite','2024-04-14 11:57:40',NULL,NULL),(167,'jane36@example.com','success','2024-04-14 12:57:40','cycle_invite','2024-04-14 11:57:40',NULL,NULL),(168,'john37@example.com','success','2024-04-14 12:57:41','cycle_invite','2024-04-14 11:57:41',NULL,NULL),(169,'jane38@example.com','success','2024-04-14 12:57:41','cycle_invite','2024-04-14 11:57:41',NULL,NULL),(170,'smith39@example.com','success','2024-04-14 12:57:41','cycle_invite','2024-04-14 11:57:41',NULL,NULL),(171,'jane40@example.com','success','2024-04-14 12:57:42','cycle_invite','2024-04-14 11:57:42',NULL,NULL),(172,'john41@example.com','success','2024-04-14 12:57:42','cycle_invite','2024-04-14 11:57:42',NULL,NULL),(173,'smith42@example.com','success','2024-04-14 12:57:42','cycle_invite','2024-04-14 11:57:42',NULL,NULL),(174,'smith43@example.com','success','2024-04-14 12:57:43','cycle_invite','2024-04-14 11:57:43',NULL,NULL),(175,'jane44@example.com','success','2024-04-14 12:57:43','cycle_invite','2024-04-14 11:57:43',NULL,NULL),(176,'jane45@example.com','success','2024-04-21 22:08:19','employee_intervention_invite','2024-04-21 21:08:19',NULL,NULL),(177,'jane46@example.com','success','2024-04-21 22:08:19','employee_intervention_invite','2024-04-21 21:08:19',NULL,NULL),(178,'john47@example.com','success','2024-04-21 22:08:20','employee_intervention_invite','2024-04-21 21:08:20',NULL,NULL),(179,'john27@example.com','success','2024-04-21 22:08:20','employee_intervention_invite','2024-04-21 21:08:20',NULL,NULL),(180,'smith28@example.com','success','2024-04-21 22:08:20','employee_intervention_invite','2024-04-21 21:08:20',NULL,NULL),(181,'john41@example.com','success','2024-04-21 22:08:21','employee_intervention_invite','2024-04-21 21:08:21',NULL,NULL),(182,'smith43@example.com','success','2024-04-21 22:08:21','employee_intervention_invite','2024-04-21 21:08:21',NULL,NULL),(183,'jane44@example.com','success','2024-04-21 22:08:21','employee_intervention_invite','2024-04-21 21:08:21',NULL,NULL),(184,'isa.chamo@buk.edu.ng','success','2024-04-21 22:08:22','employee_intervention_invite','2024-04-21 21:08:22',NULL,NULL),(185,'ahmad.sharafudeen@gmail.com','success','2024-04-21 22:18:49','employee_intervention_invite','2024-04-21 21:18:49',NULL,NULL),(186,'mbabagana.cs@buk.edu.ng','success','2024-04-21 22:18:49','employee_intervention_invite','2024-04-21 21:18:49',NULL,NULL),(187,'uambursa.It@buk.edu.ng','success','2024-04-21 22:18:49','employee_intervention_invite','2024-04-21 21:18:49',NULL,NULL),(188,'muneer@gmail.com','success','2024-04-21 22:18:50','employee_intervention_invite','2024-04-21 21:18:50',NULL,NULL),(189,'jumai@gmail.com','success','2024-04-21 22:18:50','employee_intervention_invite','2024-04-21 21:18:50',NULL,NULL),(190,'asharafudeenraji@gmail.com','success','2024-04-21 22:23:58','employee_intervention_invite','2024-04-21 21:23:58',NULL,NULL),(191,'muideen@gmail.com','success','2024-04-21 22:23:59','employee_intervention_invite','2024-04-21 21:23:59',NULL,NULL),(192,'ojo@gmail.com','success','2024-04-21 22:23:59','employee_intervention_invite','2024-04-21 21:23:59',NULL,NULL),(193,'anike@gmail.com','success','2024-04-21 22:23:59','employee_intervention_invite','2024-04-21 21:23:59',NULL,NULL),(194,'jamiu@gmail.com','success','2024-04-21 22:24:00','employee_intervention_invite','2024-04-21 21:24:00',NULL,NULL),(195,'hkakudi.cs@buk.edu.ng','success','2024-04-21 22:24:00','employee_intervention_invite','2024-04-21 21:24:00',NULL,NULL),(196,'asharafudeenraji@gmail.com','success','2024-04-21 22:24:01','line_manager_intervention_notification','2024-04-21 21:24:01',NULL,NULL),(197,'muneer@gmail.com','success','2024-04-21 22:24:01','line_manager_intervention_notification','2024-04-21 21:24:01',NULL,NULL),(198,'yusuff.taiwo@gmail.com','success','2024-04-21 22:30:31','employee_intervention_invite','2024-04-21 21:30:31',NULL,NULL),(199,'jane45@example.com','success','2024-04-21 22:30:31','employee_intervention_invite','2024-04-21 21:30:31',NULL,NULL),(200,'jane46@example.com','success','2024-04-21 22:30:31','employee_intervention_invite','2024-04-21 21:30:31',NULL,NULL),(201,'john47@example.com','success','2024-04-21 22:30:32','employee_intervention_invite','2024-04-21 21:30:32',NULL,NULL),(202,'john27@example.com','success','2024-04-21 22:30:32','employee_intervention_invite','2024-04-21 21:30:32',NULL,NULL),(203,'smith28@example.com','success','2024-04-21 22:30:33','employee_intervention_invite','2024-04-21 21:30:33',NULL,NULL),(204,'john29@example.com','success','2024-04-21 22:30:33','employee_intervention_invite','2024-04-21 21:30:33',NULL,NULL),(205,'jane30@example.com','success','2024-04-21 22:30:34','employee_intervention_invite','2024-04-21 21:30:34',NULL,NULL),(206,'jane30@example.com','success','2024-04-21 22:30:34','line_manager_intervention_notification','2024-04-21 21:30:34',NULL,NULL),(207,'jamiu@gmail.com','success','2024-04-21 22:30:34','line_manager_intervention_notification','2024-04-21 21:30:34',NULL,NULL),(208,'asharafudeenraji@gmail.com','success','2024-04-21 22:30:35','line_manager_intervention_notification','2024-04-21 21:30:35',NULL,NULL),(209,'ahmad.sharafudeen@gmail.com','success','2024-04-21 23:01:00','employee_intervention_invite','2024-04-21 22:01:00',NULL,NULL),(210,'mbabagana.cs@buk.edu.ng','success','2024-04-21 23:01:01','employee_intervention_invite','2024-04-21 22:01:01',NULL,NULL),(211,'uambursa.It@buk.edu.ng','success','2024-04-21 23:01:01','employee_intervention_invite','2024-04-21 22:01:01',NULL,NULL),(212,'muneer@gmail.com','success','2024-04-21 23:01:01','employee_intervention_invite','2024-04-21 22:01:01',NULL,NULL),(213,'jumai@gmail.com','success','2024-04-21 23:01:02','employee_intervention_invite','2024-04-21 22:01:02',NULL,NULL),(214,'asharafudeenraji@gmail.com','success','2024-04-21 23:01:02','employee_intervention_invite','2024-04-21 22:01:02',NULL,NULL),(215,'muideen@gmail.com','success','2024-04-21 23:01:02','employee_intervention_invite','2024-04-21 22:01:02',NULL,NULL),(216,'ojo@gmail.com','success','2024-04-21 23:01:03','employee_intervention_invite','2024-04-21 22:01:03',NULL,NULL),(217,'anike@gmail.com','success','2024-04-21 23:01:03','employee_intervention_invite','2024-04-21 22:01:03',NULL,NULL),(218,'jamiu@gmail.com','success','2024-04-21 23:01:04','employee_intervention_invite','2024-04-21 22:01:04',NULL,NULL),(219,'hkakudi.cs@buk.edu.ng','success','2024-04-21 23:01:04','employee_intervention_invite','2024-04-21 22:01:04',NULL,NULL),(220,'yusuff.taiwo@gmail.com','success','2024-04-21 23:01:05','employee_intervention_invite','2024-04-21 22:01:05',NULL,NULL),(221,'asharafudeenraji@gmail.com','success','2024-04-21 23:01:05','line_manager_intervention_notification','2024-04-21 22:01:05',NULL,NULL),(222,'uambursa.It@buk.edu.ng','success','2024-04-21 23:01:06','line_manager_intervention_notification','2024-04-21 22:01:06',NULL,NULL),(223,'jumai@gmail.com','success','2024-04-21 23:01:06','line_manager_intervention_notification','2024-04-21 22:01:06',NULL,NULL),(224,'muneer@gmail.com','success','2024-04-21 23:01:07','line_manager_intervention_notification','2024-04-21 22:01:07',NULL,NULL),(225,'jane30@example.com','success','2024-04-21 23:01:07','line_manager_intervention_notification','2024-04-21 22:01:07',NULL,NULL),(226,'ahmad.sharafudeen@gmail.com','success','2024-04-21 23:17:06','employee_intervention_invite','2024-04-21 22:17:06',NULL,'19'),(227,'mbabagana.cs@buk.edu.ng','success','2024-04-21 23:17:07','employee_intervention_invite','2024-04-21 22:17:07',NULL,'19'),(228,'uambursa.It@buk.edu.ng','success','2024-04-21 23:17:07','employee_intervention_invite','2024-04-21 22:17:07',NULL,'19'),(229,'muneer@gmail.com','success','2024-04-21 23:17:07','employee_intervention_invite','2024-04-21 22:17:07',NULL,'19'),(230,'jumai@gmail.com','success','2024-04-21 23:17:08','employee_intervention_invite','2024-04-21 22:17:08',NULL,'19'),(231,'asharafudeenraji@gmail.com','success','2024-04-21 23:17:08','employee_intervention_invite','2024-04-21 22:17:08',NULL,'19'),(232,'muideen@gmail.com','success','2024-04-21 23:17:09','employee_intervention_invite','2024-04-21 22:17:09',NULL,'19'),(233,'ojo@gmail.com','success','2024-04-21 23:17:09','employee_intervention_invite','2024-04-21 22:17:09',NULL,'19'),(234,'anike@gmail.com','success','2024-04-21 23:17:09','employee_intervention_invite','2024-04-21 22:17:09',NULL,'19'),(235,'jamiu@gmail.com','success','2024-04-21 23:17:10','employee_intervention_invite','2024-04-21 22:17:10',NULL,'19'),(236,'hkakudi.cs@buk.edu.ng','success','2024-04-21 23:17:10','employee_intervention_invite','2024-04-21 22:17:10',NULL,'19'),(237,'yusuff.taiwo@gmail.com','success','2024-04-21 23:17:11','employee_intervention_invite','2024-04-21 22:17:11',NULL,'19'),(238,'asharafudeenraji@gmail.com','success','2024-04-21 23:17:11','line_manager_intervention_notification','2024-04-21 22:17:11',NULL,NULL),(239,'uambursa.It@buk.edu.ng','success','2024-04-21 23:17:12','line_manager_intervention_notification','2024-04-21 22:17:12',NULL,NULL),(240,'jumai@gmail.com','success','2024-04-21 23:17:12','line_manager_intervention_notification','2024-04-21 22:17:12',NULL,NULL),(241,'muneer@gmail.com','success','2024-04-21 23:17:13','line_manager_intervention_notification','2024-04-21 22:17:13',NULL,NULL),(242,'jane30@example.com','success','2024-04-21 23:17:14','line_manager_intervention_notification','2024-04-21 22:17:14',NULL,NULL),(243,'ahmad.sharafudeen@gmail.com','success','2024-04-22 00:11:00','employee_intervention_invite','2024-04-21 23:11:00',NULL,'15'),(244,'ahmad.sharafudeen@gmail.com','success','2024-04-22 00:21:11','employee_intervention_invite','2024-04-21 23:21:11',NULL,'19'),(245,'mbabagana.cs@buk.edu.ng','success','2024-04-22 00:21:11','employee_intervention_invite','2024-04-21 23:21:11',NULL,'19'),(246,'uambursa.It@buk.edu.ng','success','2024-04-22 00:21:12','employee_intervention_invite','2024-04-21 23:21:12',NULL,'19'),(247,'muneer@gmail.com','success','2024-04-22 00:21:12','employee_intervention_invite','2024-04-21 23:21:12',NULL,'19'),(248,'jumai@gmail.com','success','2024-04-22 00:21:12','employee_intervention_invite','2024-04-21 23:21:12',NULL,'19'),(249,'asharafudeenraji@gmail.com','success','2024-04-22 00:21:13','employee_intervention_invite','2024-04-21 23:21:13',NULL,'19'),(250,'muideen@gmail.com','success','2024-04-22 00:21:13','employee_intervention_invite','2024-04-21 23:21:13',NULL,'19'),(251,'ojo@gmail.com','success','2024-04-22 00:21:13','employee_intervention_invite','2024-04-21 23:21:13',NULL,'19'),(252,'anike@gmail.com','success','2024-04-22 00:21:14','employee_intervention_invite','2024-04-21 23:21:14',NULL,'19'),(253,'jamiu@gmail.com','success','2024-04-22 00:21:14','employee_intervention_invite','2024-04-21 23:21:14',NULL,'19'),(254,'hkakudi.cs@buk.edu.ng','success','2024-04-22 00:21:14','employee_intervention_invite','2024-04-21 23:21:14',NULL,'19'),(255,'yusuff.taiwo@gmail.com','success','2024-04-22 00:21:15','employee_intervention_invite','2024-04-21 23:21:15',NULL,'19'),(256,'asharafudeenraji@gmail.com','success','2024-04-22 00:21:15','line_manager_intervention_notification','2024-04-21 23:21:15',NULL,NULL),(257,'uambursa.It@buk.edu.ng','success','2024-04-22 00:21:15','line_manager_intervention_notification','2024-04-21 23:21:15',NULL,NULL),(258,'jumai@gmail.com','success','2024-04-22 00:21:16','line_manager_intervention_notification','2024-04-21 23:21:16',NULL,NULL),(259,'muneer@gmail.com','success','2024-04-22 00:21:16','line_manager_intervention_notification','2024-04-21 23:21:16',NULL,NULL),(260,'jane30@example.com','success','2024-04-22 00:21:17','line_manager_intervention_notification','2024-04-21 23:21:17',NULL,NULL),(261,'ahmad.sharafudeen@gmail.com','success','2024-04-24 15:20:54','cycle_invite','2024-04-24 14:20:54',NULL,NULL),(262,'mbabagana.cs@buk.edu.ng','success','2024-04-24 15:20:54','cycle_invite','2024-04-24 14:20:54',NULL,NULL),(263,'uambursa.It@buk.edu.ng','success','2024-04-24 15:20:55','cycle_invite','2024-04-24 14:20:55',NULL,NULL),(264,'muneer@gmail.com','success','2024-04-24 15:20:55','cycle_invite','2024-04-24 14:20:55',NULL,NULL),(265,'jumai@gmail.com','success','2024-04-24 15:20:55','cycle_invite','2024-04-24 14:20:55',NULL,NULL),(266,'asharafudeenraji@gmail.com','success','2024-04-24 15:20:56','cycle_invite','2024-04-24 14:20:56',NULL,NULL),(267,'muideen@gmail.com','success','2024-04-24 15:20:56','cycle_invite','2024-04-24 14:20:56',NULL,NULL),(268,'ojo@gmail.com','success','2024-04-24 15:20:56','cycle_invite','2024-04-24 14:20:56',NULL,NULL),(269,'anike@gmail.com','success','2024-04-24 15:20:57','cycle_invite','2024-04-24 14:20:57',NULL,NULL),(270,'jamiu@gmail.com','success','2024-04-24 15:20:57','cycle_invite','2024-04-24 14:20:57',NULL,NULL),(271,'hkakudi.cs@buk.edu.ng','success','2024-04-24 15:20:57','cycle_invite','2024-04-24 14:20:57',NULL,NULL),(272,'yusuff.taiwo@gmail.com','success','2024-04-24 15:20:57','cycle_invite','2024-04-24 14:20:57',NULL,NULL),(273,'jane45@example.com','success','2024-04-24 15:20:58','cycle_invite','2024-04-24 14:20:58',NULL,NULL),(274,'jane46@example.com','success','2024-04-24 15:20:58','cycle_invite','2024-04-24 14:20:58',NULL,NULL),(275,'john47@example.com','success','2024-04-24 15:20:59','cycle_invite','2024-04-24 14:20:59',NULL,NULL),(276,'john27@example.com','success','2024-04-24 15:20:59','cycle_invite','2024-04-24 14:20:59',NULL,NULL),(277,'smith28@example.com','success','2024-04-24 15:21:00','cycle_invite','2024-04-24 14:21:00',NULL,NULL),(278,'john29@example.com','success','2024-04-24 15:21:00','cycle_invite','2024-04-24 14:21:00',NULL,NULL),(279,'jane30@example.com','success','2024-04-24 15:21:01','cycle_invite','2024-04-24 14:21:01',NULL,NULL),(280,'john31@example.com','success','2024-04-24 15:21:01','cycle_invite','2024-04-24 14:21:01',NULL,NULL),(281,'jane32@example.com','success','2024-04-24 15:21:02','cycle_invite','2024-04-24 14:21:02',NULL,NULL),(282,'smith33@example.com','success','2024-04-24 15:21:02','cycle_invite','2024-04-24 14:21:02',NULL,NULL),(283,'jane34@example.com','success','2024-04-24 15:21:03','cycle_invite','2024-04-24 14:21:03',NULL,NULL),(284,'jane35@example.com','success','2024-04-24 15:21:03','cycle_invite','2024-04-24 14:21:03',NULL,NULL),(285,'smith48@example.com','success','2024-04-24 15:21:03','cycle_invite','2024-04-24 14:21:03',NULL,NULL),(286,'smith49@example.com','success','2024-04-24 15:21:04','cycle_invite','2024-04-24 14:21:04',NULL,NULL),(287,'john1@example.com','success','2024-04-24 15:21:04','cycle_invite','2024-04-24 14:21:04',NULL,NULL),(288,'john2@example.com','success','2024-04-24 15:21:05','cycle_invite','2024-04-24 14:21:05',NULL,NULL),(289,'john3@example.com','success','2024-04-24 15:21:05','cycle_invite','2024-04-24 14:21:05',NULL,NULL),(290,'john4@example.com','success','2024-04-24 15:21:05','cycle_invite','2024-04-24 14:21:05',NULL,NULL),(291,'jane5@example.com','success','2024-04-24 15:21:06','cycle_invite','2024-04-24 14:21:06',NULL,NULL),(292,'john6@example.com','success','2024-04-24 15:21:06','cycle_invite','2024-04-24 14:21:06',NULL,NULL),(293,'smith7@example.com','success','2024-04-24 15:21:06','cycle_invite','2024-04-24 14:21:06',NULL,NULL),(294,'jane8@example.com','success','2024-04-24 15:21:07','cycle_invite','2024-04-24 14:21:07',NULL,NULL),(295,'smith9@example.com','success','2024-04-24 15:21:08','cycle_invite','2024-04-24 14:21:08',NULL,NULL),(296,'john10@example.com','success','2024-04-24 15:21:08','cycle_invite','2024-04-24 14:21:08',NULL,NULL),(297,'john11@example.com','success','2024-04-24 15:21:09','cycle_invite','2024-04-24 14:21:09',NULL,NULL),(298,'john12@example.com','success','2024-04-24 15:21:10','cycle_invite','2024-04-24 14:21:10',NULL,NULL),(299,'jane13@example.com','success','2024-04-24 15:21:10','cycle_invite','2024-04-24 14:21:10',NULL,NULL),(300,'jane14@example.com','success','2024-04-24 15:21:11','cycle_invite','2024-04-24 14:21:11',NULL,NULL),(301,'jane15@example.com','success','2024-04-24 15:21:11','cycle_invite','2024-04-24 14:21:11',NULL,NULL),(302,'smith16@example.com','success','2024-04-24 15:21:12','cycle_invite','2024-04-24 14:21:12',NULL,NULL),(303,'john17@example.com','success','2024-04-24 15:21:12','cycle_invite','2024-04-24 14:21:12',NULL,NULL),(304,'smith18@example.com','success','2024-04-24 15:21:12','cycle_invite','2024-04-24 14:21:12',NULL,NULL),(305,'jane19@example.com','success','2024-04-24 15:21:13','cycle_invite','2024-04-24 14:21:13',NULL,NULL),(306,'jane20@example.com','success','2024-04-24 15:21:13','cycle_invite','2024-04-24 14:21:13',NULL,NULL),(307,'john21@example.com','success','2024-04-24 15:21:14','cycle_invite','2024-04-24 14:21:14',NULL,NULL),(308,'jane22@example.com','success','2024-04-24 15:21:14','cycle_invite','2024-04-24 14:21:14',NULL,NULL),(309,'jane23@example.com','success','2024-04-24 15:21:14','cycle_invite','2024-04-24 14:21:14',NULL,NULL),(310,'jane24@example.com','success','2024-04-24 15:21:15','cycle_invite','2024-04-24 14:21:15',NULL,NULL),(311,'jane25@example.com','success','2024-04-24 15:21:15','cycle_invite','2024-04-24 14:21:15',NULL,NULL),(312,'jane26@example.com','success','2024-04-24 15:21:15','cycle_invite','2024-04-24 14:21:15',NULL,NULL),(313,'jane36@example.com','success','2024-04-24 15:21:16','cycle_invite','2024-04-24 14:21:16',NULL,NULL),(314,'john37@example.com','success','2024-04-24 15:21:16','cycle_invite','2024-04-24 14:21:16',NULL,NULL),(315,'jane38@example.com','success','2024-04-24 15:21:16','cycle_invite','2024-04-24 14:21:16',NULL,NULL),(316,'smith39@example.com','success','2024-04-24 15:21:17','cycle_invite','2024-04-24 14:21:17',NULL,NULL),(317,'jane40@example.com','success','2024-04-24 15:21:17','cycle_invite','2024-04-24 14:21:17',NULL,NULL),(318,'john41@example.com','success','2024-04-24 15:21:18','cycle_invite','2024-04-24 14:21:18',NULL,NULL),(319,'smith43@example.com','success','2024-04-24 15:21:18','cycle_invite','2024-04-24 14:21:18',NULL,NULL),(320,'jane44@example.com','success','2024-04-24 15:21:18','cycle_invite','2024-04-24 14:21:18',NULL,NULL),(321,'isa.chamo@buk.edu.ng','success','2024-04-24 15:21:19','cycle_invite','2024-04-24 14:21:19',NULL,NULL),(322,'jane46@example.com','success','2024-04-24 15:35:32','employee_intervention_invite','2024-04-24 14:35:32',NULL,'19'),(323,'john47@example.com','success','2024-04-24 15:35:32','employee_intervention_invite','2024-04-24 14:35:32',NULL,'19'),(324,'john27@example.com','success','2024-04-24 15:35:32','employee_intervention_invite','2024-04-24 14:35:32',NULL,'19'),(325,'smith28@example.com','success','2024-04-24 15:35:33','employee_intervention_invite','2024-04-24 14:35:33',NULL,'19'),(326,'john29@example.com','success','2024-04-24 15:35:33','employee_intervention_invite','2024-04-24 14:35:33',NULL,'19'),(327,'jane30@example.com','success','2024-04-24 15:35:33','employee_intervention_invite','2024-04-24 14:35:33',NULL,'19'),(328,'john31@example.com','success','2024-04-24 15:35:34','employee_intervention_invite','2024-04-24 14:35:34',NULL,'19'),(329,'jane32@example.com','success','2024-04-24 15:35:34','employee_intervention_invite','2024-04-24 14:35:34',NULL,'19'),(330,'smith33@example.com','success','2024-04-24 15:35:35','employee_intervention_invite','2024-04-24 14:35:35',NULL,'19'),(331,'jane34@example.com','success','2024-04-24 15:35:35','employee_intervention_invite','2024-04-24 14:35:35',NULL,'19'),(332,'jane35@example.com','success','2024-04-24 15:35:35','employee_intervention_invite','2024-04-24 14:35:35',NULL,'19'),(333,'smith48@example.com','success','2024-04-24 15:35:36','employee_intervention_invite','2024-04-24 14:35:36',NULL,'19'),(334,'smith49@example.com','success','2024-04-24 15:35:37','employee_intervention_invite','2024-04-24 14:35:37',NULL,'19'),(335,'john1@example.com','success','2024-04-24 15:35:39','employee_intervention_invite','2024-04-24 14:35:39',NULL,'19'),(336,'john2@example.com','success','2024-04-24 15:35:40','employee_intervention_invite','2024-04-24 14:35:40',NULL,'19'),(337,'jamiu@gmail.com','success','2024-04-24 15:35:40','line_manager_intervention_notification','2024-04-24 14:35:40',NULL,NULL),(338,'jane30@example.com','success','2024-04-24 15:35:41','line_manager_intervention_notification','2024-04-24 14:35:41',NULL,NULL),(339,'asharafudeenraji@gmail.com','success','2024-04-24 15:35:41','line_manager_intervention_notification','2024-04-24 14:35:41',NULL,NULL);
/*!40000 ALTER TABLE `email_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_template` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email_type` varchar(100) NOT NULL,
  `email_subject` varchar(150) NOT NULL,
  `email_body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email_from` varchar(100) DEFAULT NULL,
  `email_from_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_template`
--

LOCK TABLES `email_template` WRITE;
/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
INSERT INTO `email_template` VALUES (1,'staff_created','Welcome to {siteName} Learning and Development Planner App','<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\n    <title>Welcome to LD Planner</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .login-details {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\\\"container\\\">\n    <h1>Welcome to LD Planner</h1>\n    <p>Greetings {first_name},</p>\n    <p>Welcome!!! {user_roles} account was created for you on LD Planner, find below your login details:</p>\n    <div class=\\\"login-details\\\">\n        <p><strong>Login Username:</strong> {username}</p>\n        <p><strong>Login Email Address:</strong>  {email}</p>\n        <p><strong>Login Password:</strong>  {password}</p>\n        <p><strong>For security purposes, please change your password on first login.</strong></p>\n    </div>\n    <p><a href=\"{login_url}\" class=\\\"button\\\">LOGIN PAGE</a></p>\n</div>\n</body>\n</html>\n',NULL,NULL,NULL,'aas1800216.com@buk.edu.ng','Ahmad Sharafudeen'),(2,'validate_rating_notify','Notification: Self-Rating Ready for Validation: {first_name} {last_name}','<!DOCTYPE html>\n<html lang=\\\"en\\\">\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\n    <title>Notification: Self-Rating Ready for Validation</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .notification-content {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\\\"container\\\">\n    <h1>Notification: Self-Rating Ready for Validation</h1>\n    <div class=\\\"notification-content\\\">\n        <p>Hello {line_manager_name},</p>\n        <p>This is to inform you that {employee_name} has completed their self-rating for the cycle year {cycle_year}.</p>\n        <p>Please click the button below to validate their rating:</p>\n        <p><a href=\"{validation_url}\" class=\\\"button\\\">Validate Rating</a></p>\n    </div>\n</div>\n</body>\n</html>\n',NULL,NULL,NULL,'aas1800216.com@buk.edu.ng','Ahmad Sharafudeen'),(3,'sef_rating_invite','Notification: Self-Rating Invitation {first_name} {last_name}','<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Notification: Self-Rating Invitation</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .notification-content {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\"container\">\n    <h1>Notification: Self-Rating Invitation</h1>\n    <div class=\"notification-content\">\n        <p>Hello {employee_name},</p>\n        <p>This is to invite you that it\'s time to start your self-rating for the new {cycle_year} development contracting cycle.</p>\n        <p>Please click the button below to begin your self-rating:</p>\n        <p><a href=\"{self_rating_url}\" class=\"button\">Start Self-Rating</a></p>\n    </div>\n</div>\n</body>\n</html>\n',NULL,NULL,NULL,'aas1800216.com@buk.edu.ng','Ogochimelu Ejike'),(4,'employee_intervention_invite','Notification: {site_name} Intervention Invitation: {cycle_year}','<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Notification: Intervention Invitation</title>\r\n    <style>\r\n        body {\r\n            font-family: Arial, sans-serif;\r\n            margin: 0;\r\n            padding: 0;\r\n            background-color: #f4f4f4;\r\n        }\r\n        .container {\r\n            max-width: 600px;\r\n            margin: 20px auto;\r\n            padding: 20px;\r\n            background-color: #fff;\r\n            border-radius: 5px;\r\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\r\n        }\r\n        h1 {\r\n            color: #333;\r\n        }\r\n        .notification-content {\r\n            margin-top: 20px;\r\n        }\r\n        .button {\r\n            display: inline-block;\r\n            padding: 10px 20px;\r\n            background-color: #007bff;\r\n            color: #fff;\r\n            text-decoration: none;\r\n            border-radius: 5px;\r\n        }\r\n        .class-details {\r\n            margin-bottom: 15px;\r\n            border: 1px solid #ccc;\r\n            padding: 10px;\r\n            border-radius: 5px;\r\n        }\r\n    </style>\r\n</head>\r\n<body>\r\n<div class=\"container\">\r\n    <h1>Notification: Intervention Invitation</h1>\r\n    <div class=\"notification-content\">\r\n        <p>Hello {employee_name},</p>\r\n        <p>You are invited to participate in the following intervention:</p>\r\n        <p><strong>Intervention Name:</strong> {intervention_name}</p>\r\n<p><strong>Trainer/Provider:</strong {trainer}</p>\r\n        {class_details}\r\n        <p>Please let us know if you have any questions.</p>\r\n        <p>Best regards,<br>{site_name}</p>\r\n    </div>\r\n</div>\r\n</body>\r\n</html>',NULL,NULL,NULL,'aas1800216.com@buk.edu.ng','Ahmad Sharafudeen'),(5,'line_manager_intervention_notification','{site_name} Intervention Notification for Direct Reports: {cycle_year}','<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Intervention Notification</title>\r\n    <style>\r\n        body {\r\n            font-family: Arial, sans-serif;\r\n            margin: 0;\r\n            padding: 0;\r\n            background-color: #f4f4f4;\r\n        }\r\n        .container {\r\n            max-width: 600px;\r\n            margin: 20px auto;\r\n            padding: 20px;\r\n            background-color: #fff;\r\n            border-radius: 5px;\r\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\r\n        }\r\n        h1 {\r\n            color: #333;\r\n        }\r\n        .notification-content {\r\n            margin-top: 20px;\r\n        }\r\n        .button {\r\n            display: inline-block;\r\n            padding: 10px 20px;\r\n            background-color: #007bff;\r\n            color: #fff;\r\n            text-decoration: none;\r\n            border-radius: 5px;\r\n        }\r\n        ul {\r\n            list-style-type: none;\r\n            padding: 0;\r\n        }\r\n        ul li {\r\n            margin-bottom: 10px;\r\n        }\r\n.class-details {\r\n            margin-bottom: 15px;\r\n            border: 1px solid #ccc;\r\n            padding: 10px;\r\n            border-radius: 5px;\r\n        }\r\n\r\n    </style>\r\n</head>\r\n<body>\r\n<div class=\"container\">\r\n    <h1>Intervention Notification</h1>\r\n    <div class=\"notification-content\">\r\n        <p>Hello {line_manager_name},</p>\r\n        <p>This is to inform you about the upcoming intervention titled \"{intervention_name}\".</p>\r\n        <p>Below are the details:</p>\r\n        <p><strong>Class Details:</strong></p>\r\n        {class_details}\r\n        <p><strong>Direct Reports Participating:</strong></p>\r\n        <ul>\r\n            {direct_reports}\r\n        </ul>\r\n<p><strong>Trainer/Provider:</strong> {trainer}</p>\r\n        <p><strong>Cycle Year:</strong> {cycle_year}</p>\r\n        <p>Thank you.</p>\r\n    </div>\r\n</div>\r\n</body>\r\n</html>\r\n',NULL,NULL,NULL,'aas1800216.com@buk.edu.ng','Ahmad Sharafudeen');
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `job_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `line_manager_id` int unsigned DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `unit_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_job_id_foreign` (`job_id`),
  CONSTRAINT `employee_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (27,36,4,'2024-03-25 10:58:43','2024-04-26 19:43:30',NULL,29,8,4),(28,37,4,'2024-03-25 12:56:05','2024-04-02 11:56:03',NULL,29,3,0),(29,38,4,'2024-03-25 13:35:19','2024-04-14 18:21:59',NULL,0,0,0),(30,39,5,'2024-03-25 13:36:27','2024-04-14 17:25:54','2024-04-01 10:31:54',0,3,1),(31,40,5,'2024-03-25 13:37:30','2024-04-26 19:44:19',NULL,36,NULL,NULL),(32,41,5,'2024-03-26 11:46:46','2024-04-26 19:44:19',NULL,NULL,NULL,NULL),(36,45,4,'2024-03-31 09:20:26','2024-04-26 19:44:19',NULL,36,NULL,NULL),(37,46,4,'2024-03-31 12:44:00','2024-04-26 19:43:30',NULL,29,NULL,NULL),(38,47,5,'2024-04-01 09:55:21','2024-04-26 19:51:11',NULL,NULL,11,0),(41,50,5,'2024-04-11 06:14:49','2024-04-26 19:50:39',NULL,NULL,10,8),(42,51,4,'2024-04-11 10:20:20','2024-04-11 10:20:20',NULL,36,NULL,NULL),(43,52,4,'2024-04-11 10:39:13','2024-04-26 19:50:39',NULL,36,10,8),(46,55,5,'2024-04-11 10:54:55','2024-04-26 19:43:30',NULL,29,NULL,NULL),(47,56,5,'2024-04-12 07:44:38','2024-04-14 18:45:33',NULL,203,NULL,NULL),(151,163,9,'2024-04-13 19:13:08','2024-04-13 19:13:08',NULL,0,9,6),(152,164,10,'2024-04-13 19:13:08','2024-04-13 19:13:08',NULL,36,9,7),(153,165,9,'2024-04-13 19:13:09','2024-04-13 19:13:09',NULL,NULL,9,NULL),(154,166,9,'2024-04-13 19:13:09','2024-04-13 19:13:09',NULL,NULL,NULL,7),(155,167,9,'2024-04-13 19:13:10','2024-04-13 19:13:10',NULL,NULL,NULL,6),(156,168,10,'2024-04-13 19:13:11','2024-04-13 19:13:11',NULL,NULL,NULL,7),(157,169,4,'2024-04-13 19:13:11','2024-04-13 19:31:51',NULL,36,9,7),(158,170,9,'2024-04-13 19:13:12','2024-04-13 19:13:12',NULL,NULL,NULL,NULL),(159,171,5,'2024-04-13 19:13:12','2024-04-13 19:20:41',NULL,36,NULL,7),(160,172,9,'2024-04-13 19:13:13','2024-04-13 19:13:13',NULL,NULL,NULL,7),(161,173,10,'2024-04-13 19:13:13','2024-04-13 19:13:13',NULL,NULL,NULL,6),(162,174,9,'2024-04-13 19:13:14','2024-04-13 19:13:14',NULL,NULL,NULL,NULL),(163,175,11,'2024-04-13 19:13:15','2024-04-13 19:13:15',NULL,NULL,NULL,6),(164,176,11,'2024-04-13 19:13:16','2024-04-13 19:13:16',NULL,NULL,9,7),(165,177,9,'2024-04-13 19:13:17','2024-04-13 19:13:17',NULL,NULL,9,NULL),(166,178,9,'2024-04-13 19:13:17','2024-04-13 19:13:17',NULL,NULL,NULL,6),(167,179,9,'2024-04-13 19:13:18','2024-04-13 19:13:18',NULL,NULL,NULL,NULL),(168,180,9,'2024-04-13 19:13:19','2024-04-13 19:13:19',NULL,NULL,9,6),(169,181,10,'2024-04-13 19:13:20','2024-04-13 19:13:20',NULL,NULL,9,7),(170,182,11,'2024-04-13 19:13:21','2024-04-13 19:13:21',NULL,NULL,NULL,6),(171,183,9,'2024-04-13 19:13:22','2024-04-13 19:13:22',NULL,NULL,NULL,7),(172,184,11,'2024-04-13 19:13:22','2024-04-13 19:13:22',NULL,NULL,NULL,7),(173,185,9,'2024-04-13 19:13:23','2024-04-13 19:13:23',NULL,NULL,9,NULL),(174,186,10,'2024-04-13 19:13:24','2024-04-13 19:13:24',NULL,NULL,9,6),(175,187,11,'2024-04-13 19:13:25','2024-04-13 19:13:25',NULL,NULL,NULL,6),(176,188,11,'2024-04-13 19:13:26','2024-04-13 19:13:26',NULL,NULL,NULL,7),(177,189,11,'2024-04-13 19:13:27','2024-04-13 19:13:27',NULL,NULL,9,NULL),(178,190,9,'2024-04-13 19:13:27','2024-04-13 19:13:27',NULL,NULL,9,NULL),(179,191,11,'2024-04-13 19:13:28','2024-04-13 19:13:28',NULL,NULL,NULL,6),(180,192,10,'2024-04-13 19:13:28','2024-04-13 19:13:28',NULL,NULL,NULL,7),(181,193,11,'2024-04-13 19:13:29','2024-04-13 19:13:29',NULL,NULL,NULL,7),(182,194,9,'2024-04-13 19:13:30','2024-04-13 19:13:30',NULL,NULL,NULL,6),(183,195,10,'2024-04-13 19:13:31','2024-04-13 19:13:31',NULL,NULL,NULL,6),(184,196,9,'2024-04-13 19:13:31','2024-04-13 19:13:31',NULL,NULL,9,NULL),(185,197,9,'2024-04-13 19:13:32','2024-04-13 19:13:32',NULL,NULL,NULL,NULL),(186,198,11,'2024-04-13 19:13:33','2024-04-13 19:13:33',NULL,NULL,9,7),(187,199,10,'2024-04-13 19:13:33','2024-04-13 19:13:33',NULL,NULL,9,6),(188,200,11,'2024-04-13 19:13:34','2024-04-13 19:13:34',NULL,NULL,NULL,7),(189,201,11,'2024-04-13 19:13:35','2024-04-13 19:13:35',NULL,NULL,NULL,6),(190,202,11,'2024-04-13 19:13:36','2024-04-13 19:13:36',NULL,NULL,NULL,NULL),(191,203,10,'2024-04-13 19:13:36','2024-04-13 19:13:36',NULL,NULL,NULL,6),(192,204,10,'2024-04-13 19:13:37','2024-04-13 19:13:37',NULL,NULL,NULL,7),(193,205,11,'2024-04-13 19:13:38','2024-04-13 19:13:38',NULL,NULL,NULL,6),(194,206,11,'2024-04-13 19:13:39','2024-04-13 19:13:39',NULL,NULL,9,6),(195,207,11,'2024-04-13 19:13:39','2024-04-13 19:13:39',NULL,NULL,NULL,7),(196,208,11,'2024-04-13 19:13:40','2024-04-13 19:13:40',NULL,NULL,NULL,6),(197,209,10,'2024-04-13 19:13:40','2024-04-14 18:26:39',NULL,NULL,9,7),(198,210,9,'2024-04-13 19:13:41','2024-04-14 18:19:37',NULL,43,9,7),(199,211,11,'2024-04-13 19:13:42','2024-04-13 19:13:42',NULL,NULL,9,7),(200,212,11,'2024-04-14 09:15:00','2024-04-14 09:15:00',NULL,NULL,NULL,6),(201,213,10,'2024-04-14 09:15:04','2024-04-14 09:15:04',NULL,NULL,NULL,7),(202,214,11,'2024-04-14 09:15:05','2024-04-14 18:45:33',NULL,203,NULL,7),(203,215,4,'2024-04-14 09:15:05','2024-04-14 18:39:47',NULL,36,NULL,6),(204,216,10,'2024-04-14 09:15:06','2024-04-14 09:15:06',NULL,NULL,NULL,6),(205,217,9,'2024-04-14 09:15:06','2024-04-14 18:45:33',NULL,NULL,9,NULL),(206,218,9,'2024-04-14 09:15:07','2024-04-14 18:19:37',NULL,NULL,NULL,NULL),(207,219,11,'2024-04-14 09:15:07','2024-04-14 09:15:07',NULL,NULL,9,7),(208,220,10,'2024-04-14 09:15:08','2024-04-14 09:15:08',NULL,NULL,9,6),(209,221,9,'2024-04-14 09:20:48','2024-04-14 18:39:47',NULL,36,9,6),(210,222,10,'2024-04-14 09:20:49','2024-04-14 18:39:47',NULL,36,9,7),(211,223,9,'2024-04-14 09:20:49','2024-04-14 18:45:33',NULL,NULL,9,NULL),(212,224,9,'2024-04-14 09:20:50','2024-04-14 09:20:50',NULL,NULL,NULL,7),(213,225,9,'2024-04-14 09:20:50','2024-04-14 18:45:33',NULL,203,NULL,6),(214,226,10,'2024-04-14 09:20:51','2024-04-14 18:45:33',NULL,NULL,NULL,7),(215,227,10,'2024-04-14 09:20:51','2024-04-14 18:45:33',NULL,NULL,9,7),(216,228,9,'2024-04-14 09:20:52','2024-04-14 18:21:59',NULL,32,NULL,NULL),(217,229,9,'2024-04-14 09:20:52','2024-04-14 09:20:52',NULL,NULL,NULL,7),(218,230,9,'2024-04-14 09:20:53','2024-04-14 18:45:33',NULL,203,NULL,7),(219,231,10,'2024-04-14 09:20:53','2024-04-14 18:45:33',NULL,203,NULL,6),(220,232,9,'2024-04-14 09:20:53','2024-04-14 18:26:39',NULL,NULL,NULL,NULL),(221,233,11,'2024-04-14 09:20:54','2024-04-14 09:20:54',NULL,NULL,NULL,6),(222,234,11,'2024-04-14 09:20:54','2024-04-14 09:20:54',NULL,NULL,9,7),(223,235,9,'2024-04-14 09:20:55','2024-04-14 09:20:55',NULL,NULL,9,NULL),(224,236,9,'2024-04-14 09:20:55','2024-04-14 09:20:55',NULL,NULL,NULL,6),(225,237,9,'2024-04-14 09:20:56','2024-04-14 09:20:56',NULL,NULL,NULL,NULL),(226,238,9,'2024-04-14 09:20:56','2024-04-14 09:20:56',NULL,NULL,9,6),(227,239,10,'2024-04-14 09:20:57','2024-04-14 18:26:19',NULL,NULL,9,7),(228,240,11,'2024-04-14 09:20:57','2024-04-14 09:20:57',NULL,NULL,NULL,6),(229,241,9,'2024-04-14 09:20:57','2024-04-14 09:20:57',NULL,NULL,NULL,7),(230,242,11,'2024-04-14 09:20:58','2024-04-14 18:26:19',NULL,NULL,NULL,7),(231,243,9,'2024-04-14 09:20:58','2024-04-14 18:26:19',NULL,NULL,9,NULL),(232,244,10,'2024-04-14 09:20:59','2024-04-14 18:26:19',NULL,NULL,9,6),(233,245,11,'2024-04-14 09:20:59','2024-04-14 09:20:59',NULL,NULL,NULL,6),(234,246,11,'2024-04-14 09:21:00','2024-04-14 09:21:00',NULL,NULL,NULL,7),(235,247,11,'2024-04-14 09:21:00','2024-04-14 09:21:00',NULL,NULL,9,NULL),(236,248,9,'2024-04-14 09:21:00','2024-04-14 09:21:00',NULL,NULL,9,NULL),(237,249,11,'2024-04-14 09:21:01','2024-04-14 09:21:01',NULL,NULL,NULL,7),(238,250,11,'2024-04-14 09:21:01','2024-04-14 09:21:01',NULL,NULL,NULL,6),(239,251,11,'2024-04-14 09:21:02','2024-04-14 18:25:19',NULL,NULL,NULL,NULL),(240,252,10,'2024-04-14 09:21:02','2024-04-14 09:21:02',NULL,NULL,NULL,6),(241,253,10,'2024-04-14 09:21:03','2024-04-14 09:21:03',NULL,NULL,NULL,7),(242,254,11,'2024-04-14 09:21:03','2024-04-14 23:28:05',NULL,0,NULL,6),(243,255,11,'2024-04-14 09:21:04','2024-04-20 08:57:34','2024-04-20 08:57:34',NULL,9,6),(244,256,11,'2024-04-14 09:21:04','2024-04-14 18:25:19',NULL,NULL,NULL,7),(245,257,11,'2024-04-14 09:21:04','2024-04-14 09:21:04',NULL,NULL,NULL,6),(246,258,5,'2024-04-14 12:28:06','2024-04-14 23:27:39',NULL,36,NULL,NULL),(247,259,5,'2024-04-18 16:22:54','2024-04-24 14:39:31',NULL,36,10,8),(248,260,9,'2024-04-26 19:21:41','2024-04-26 19:25:05','2024-04-26 19:25:05',36,NULL,NULL),(249,261,11,'2024-04-26 20:31:56','2024-04-26 20:31:56',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_interventions`
--

DROP TABLE IF EXISTS `employee_interventions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_interventions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `intervention_id` int unsigned DEFAULT NULL,
  `class_id` int unsigned DEFAULT NULL,
  `cycle_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_interventions`
--

LOCK TABLES `employee_interventions` WRITE;
/*!40000 ALTER TABLE `employee_interventions` DISABLE KEYS */;
INSERT INTO `employee_interventions` VALUES (327,27,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,12,8),(328,27,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,13,8),(329,28,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,12,8),(330,28,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,13,8),(331,29,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,12,8),(332,29,'2024-04-22 00:21:11','2024-04-22 00:21:11',NULL,19,13,8),(333,31,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,12,8),(334,31,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,13,8),(335,32,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,12,8),(336,32,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,13,8),(337,36,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,12,8),(338,36,'2024-04-22 00:21:12','2024-04-22 00:21:12',NULL,19,13,8),(339,37,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,12,8),(340,37,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,13,8),(341,38,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,12,8),(342,38,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,13,8),(343,41,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,12,8),(344,41,'2024-04-22 00:21:13','2024-04-22 00:21:13',NULL,19,13,8),(345,43,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,12,8),(346,43,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,13,8),(347,46,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,12,8),(348,46,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,13,8),(349,47,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,12,8),(350,47,'2024-04-22 00:21:14','2024-04-22 00:21:14',NULL,19,13,8),(351,198,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,12,8),(352,198,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,13,8),(353,199,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,12,8),(354,199,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,13,8),(355,200,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,12,8),(356,200,'2024-04-24 15:35:32','2024-04-24 15:35:32',NULL,19,13,8),(357,201,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,12,8),(358,201,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,13,8),(359,202,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,12,8),(360,202,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,13,8),(361,203,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,12,8),(362,203,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,13,8),(363,204,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,12,8),(364,204,'2024-04-24 15:35:33','2024-04-24 15:35:33',NULL,19,13,8),(365,205,'2024-04-24 15:35:34','2024-04-24 15:35:34',NULL,19,12,8),(366,205,'2024-04-24 15:35:34','2024-04-24 15:35:34',NULL,19,13,8),(367,206,'2024-04-24 15:35:34','2024-04-24 15:35:34',NULL,19,12,8),(368,206,'2024-04-24 15:35:34','2024-04-24 15:35:34',NULL,19,13,8),(369,207,'2024-04-24 15:35:35','2024-04-24 15:35:35',NULL,19,12,8),(370,207,'2024-04-24 15:35:35','2024-04-24 15:35:35',NULL,19,13,8),(371,208,'2024-04-24 15:35:35','2024-04-24 15:35:35',NULL,19,12,8),(372,208,'2024-04-24 15:35:35','2024-04-24 15:35:35',NULL,19,13,8),(373,209,'2024-04-24 15:35:35','2024-04-24 15:35:35',NULL,19,12,8),(374,209,'2024-04-24 15:35:36','2024-04-24 15:35:36',NULL,19,13,8),(375,210,'2024-04-24 15:35:36','2024-04-24 15:35:36',NULL,19,12,8),(376,210,'2024-04-24 15:35:36','2024-04-24 15:35:36',NULL,19,13,8),(377,211,'2024-04-24 15:35:37','2024-04-24 15:35:37',NULL,19,12,8),(378,211,'2024-04-24 15:35:38','2024-04-24 15:35:38',NULL,19,13,8),(379,212,'2024-04-24 15:35:39','2024-04-24 15:35:39',NULL,19,12,8),(380,212,'2024-04-24 15:35:39','2024-04-24 15:35:39',NULL,19,13,8);
/*!40000 ALTER TABLE `employee_interventions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_roles`
--

DROP TABLE IF EXISTS `employee_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_roles_employee_id_foreign` (`employee_id`),
  KEY `employee_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `employee_roles_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_roles`
--

LOCK TABLES `employee_roles` WRITE;
/*!40000 ALTER TABLE `employee_roles` DISABLE KEYS */;
INSERT INTO `employee_roles` VALUES (52,29,8,'2024-03-25 13:35:19','2024-03-25 13:35:26','2024-03-25 13:35:26',38),(53,29,9,'2024-03-25 13:35:19','2024-03-25 13:35:26','2024-03-25 13:35:26',38),(57,31,8,'2024-03-25 13:37:30','2024-03-25 14:06:01','2024-03-25 14:06:01',40),(58,31,11,'2024-03-25 13:37:30','2024-03-25 14:06:01','2024-03-25 14:06:01',40),(88,32,8,'2024-04-01 11:10:26','2024-04-01 11:10:26',NULL,41),(89,32,9,'2024-04-01 11:10:26','2024-04-01 11:10:26',NULL,41),(90,32,11,'2024-04-01 11:10:26','2024-04-01 11:10:26',NULL,41),(91,36,8,'2024-04-01 11:33:07','2024-04-01 11:33:07',NULL,45),(92,36,9,'2024-04-01 11:33:07','2024-04-01 11:33:07',NULL,45),(93,36,11,'2024-04-01 11:33:07','2024-04-01 11:33:07',NULL,45),(99,41,8,'2024-04-11 06:14:49','2024-04-11 06:14:49',NULL,50),(100,41,11,'2024-04-11 06:14:49','2024-04-11 06:14:49',NULL,50),(101,42,8,'2024-04-11 10:20:20','2024-04-11 10:20:20',NULL,51),(102,42,10,'2024-04-11 10:20:20','2024-04-11 10:20:20',NULL,51),(103,42,11,'2024-04-11 10:20:20','2024-04-11 10:20:20',NULL,51),(104,43,8,'2024-04-11 10:39:13','2024-04-11 10:39:13',NULL,52),(105,43,11,'2024-04-11 10:39:13','2024-04-11 10:39:13',NULL,52),(113,46,8,'2024-04-12 02:40:57','2024-04-12 02:40:57',NULL,55),(114,46,11,'2024-04-12 02:40:57','2024-04-12 02:40:57',NULL,55),(118,47,10,'2024-04-12 07:45:40','2024-04-12 07:45:40',NULL,56),(119,47,11,'2024-04-12 07:45:40','2024-04-12 07:45:40',NULL,56),(150,151,9,'2024-04-13 19:13:08','2024-04-13 19:13:08',NULL,163),(151,152,11,'2024-04-13 19:13:08','2024-04-13 19:13:08',NULL,164),(152,152,8,'2024-04-13 19:13:08','2024-04-13 19:13:08',NULL,164),(153,153,11,'2024-04-13 19:13:09','2024-04-13 19:13:09',NULL,165),(154,154,11,'2024-04-13 19:13:09','2024-04-13 19:13:09',NULL,166),(155,155,11,'2024-04-13 19:13:10','2024-04-13 19:13:10',NULL,167),(156,155,8,'2024-04-13 19:13:10','2024-04-13 19:13:10',NULL,167),(157,156,11,'2024-04-13 19:13:11','2024-04-13 19:13:11',NULL,168),(158,160,11,'2024-04-13 19:13:13','2024-04-13 19:13:13',NULL,172),(159,165,11,'2024-04-13 19:13:17','2024-04-13 19:13:17',NULL,177),(160,165,8,'2024-04-13 19:13:17','2024-04-13 19:13:17',NULL,177),(161,171,11,'2024-04-13 19:13:22','2024-04-13 19:13:22',NULL,183),(162,171,8,'2024-04-13 19:13:22','2024-04-13 19:13:22',NULL,183),(163,175,11,'2024-04-13 19:13:25','2024-04-13 19:13:25',NULL,187),(164,175,8,'2024-04-13 19:13:25','2024-04-13 19:13:25',NULL,187),(165,183,11,'2024-04-13 19:13:31','2024-04-13 19:13:31',NULL,195),(166,184,11,'2024-04-13 19:13:31','2024-04-13 19:13:31',NULL,196),(167,185,11,'2024-04-13 19:13:32','2024-04-13 19:13:32',NULL,197),(168,187,11,'2024-04-13 19:13:33','2024-04-13 19:13:33',NULL,199),(169,189,11,'2024-04-13 19:13:35','2024-04-13 19:13:35',NULL,201),(170,190,11,'2024-04-13 19:13:36','2024-04-13 19:13:36',NULL,202),(173,159,8,'2024-04-13 19:20:41','2024-04-13 19:20:41',NULL,171),(174,159,11,'2024-04-13 19:20:41','2024-04-13 19:20:41',NULL,171),(175,157,11,'2024-04-13 19:31:51','2024-04-13 19:31:51',NULL,169),(176,204,11,'2024-04-14 09:15:06','2024-04-14 09:15:06',NULL,216),(177,205,11,'2024-04-14 09:15:06','2024-04-14 09:15:06',NULL,217),(178,206,11,'2024-04-14 09:15:07','2024-04-14 09:15:07',NULL,218),(179,208,11,'2024-04-14 09:15:08','2024-04-14 09:15:08',NULL,220),(180,209,9,'2024-04-14 09:20:48','2024-04-14 09:20:48',NULL,221),(181,210,11,'2024-04-14 09:20:49','2024-04-14 09:20:49',NULL,222),(182,210,8,'2024-04-14 09:20:49','2024-04-14 09:20:49',NULL,222),(183,211,11,'2024-04-14 09:20:49','2024-04-14 09:20:49',NULL,223),(184,212,11,'2024-04-14 09:20:50','2024-04-14 09:20:50',NULL,224),(185,213,11,'2024-04-14 09:20:50','2024-04-14 09:20:50',NULL,225),(186,213,8,'2024-04-14 09:20:50','2024-04-14 09:20:50',NULL,225),(187,214,11,'2024-04-14 09:20:51','2024-04-14 09:20:51',NULL,226),(188,218,11,'2024-04-14 09:20:53','2024-04-14 09:20:53',NULL,230),(189,223,11,'2024-04-14 09:20:55','2024-04-14 09:20:55',NULL,235),(190,223,8,'2024-04-14 09:20:55','2024-04-14 09:20:55',NULL,235),(191,229,11,'2024-04-14 09:20:57','2024-04-14 09:20:57',NULL,241),(192,229,8,'2024-04-14 09:20:57','2024-04-14 09:20:57',NULL,241),(193,233,11,'2024-04-14 09:20:59','2024-04-14 09:20:59',NULL,245),(194,233,8,'2024-04-14 09:20:59','2024-04-14 09:20:59',NULL,245),(195,238,11,'2024-04-14 09:21:01','2024-04-14 09:21:01',NULL,250),(196,239,11,'2024-04-14 09:21:02','2024-04-14 09:21:02',NULL,251),(201,203,8,'2024-04-14 09:30:28','2024-04-14 09:30:28',NULL,215),(202,203,11,'2024-04-14 09:30:28','2024-04-14 09:30:28',NULL,215),(205,246,8,'2024-04-14 23:27:39','2024-04-14 23:27:39',NULL,258),(206,246,10,'2024-04-14 23:27:39','2024-04-14 23:27:39',NULL,258),(207,246,11,'2024-04-14 23:27:39','2024-04-14 23:27:39',NULL,258),(208,27,8,'2024-04-14 23:27:49','2024-04-14 23:27:49',NULL,36),(209,27,10,'2024-04-14 23:27:49','2024-04-14 23:27:49',NULL,36),(210,27,11,'2024-04-14 23:27:49','2024-04-14 23:27:49',NULL,36),(211,242,10,'2024-04-14 23:28:05','2024-04-14 23:28:05',NULL,254),(218,249,10,'2024-04-26 20:31:56','2024-04-26 20:31:56',NULL,261);
/*!40000 ALTER TABLE `employee_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(355) NOT NULL,
  `division_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_division_id_foreign` (`division_id`),
  CONSTRAINT `group_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (3,'Backend engineering',6,'2024-02-20 11:37:24','2024-02-20 16:36:33',NULL);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_attendance`
--

DROP TABLE IF EXISTS `intervention_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_attendance` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `intervention_id` int unsigned NOT NULL,
  `employee_id` int unsigned DEFAULT NULL,
  `attendance_date` varchar(35) DEFAULT NULL,
  `attendance_status` varchar(50) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `intervention_attendance_intervention_id_foreign` (`intervention_id`),
  KEY `intervention_attendance_employee_id_foreign` (`employee_id`),
  CONSTRAINT `intervention_attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `intervention_attendance_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_attendance`
--

LOCK TABLES `intervention_attendance` WRITE;
/*!40000 ALTER TABLE `intervention_attendance` DISABLE KEYS */;
INSERT INTO `intervention_attendance` VALUES (1,19,27,'21/04/2024','present','',NULL,'2024-04-24 14:31:30',NULL),(2,19,28,'22/04/2024','present','',NULL,'2024-04-24 14:31:30',NULL),(3,19,29,'21/04/2024','present','',NULL,'2024-04-24 14:31:30',NULL),(4,19,31,'21/04/2024','absent','',NULL,'2024-04-24 14:31:30',NULL),(5,19,32,'21/04/2024','present','',NULL,'2024-04-24 14:31:30',NULL),(6,19,36,NULL,'absent',NULL,NULL,NULL,NULL),(7,19,37,NULL,'absent',NULL,NULL,NULL,NULL),(8,19,38,NULL,'absent',NULL,NULL,NULL,NULL),(9,19,41,NULL,'absent',NULL,NULL,NULL,NULL),(10,19,43,NULL,'absent',NULL,NULL,NULL,NULL),(11,19,46,NULL,'absent',NULL,NULL,NULL,NULL),(12,19,47,NULL,'absent',NULL,NULL,NULL,NULL),(13,19,198,NULL,'absent',NULL,'2024-04-24 14:35:32','2024-04-24 14:35:32',NULL),(14,19,199,NULL,'absent',NULL,'2024-04-24 14:35:32','2024-04-24 14:35:32',NULL),(15,19,200,NULL,'absent',NULL,'2024-04-24 14:35:33','2024-04-24 14:35:33',NULL),(16,19,201,NULL,'absent',NULL,'2024-04-24 14:35:33','2024-04-24 14:35:33',NULL),(17,19,202,NULL,'absent',NULL,'2024-04-24 14:35:33','2024-04-24 14:35:33',NULL),(18,19,203,NULL,'absent',NULL,'2024-04-24 14:35:33','2024-04-24 14:35:33',NULL),(19,19,204,NULL,'absent',NULL,'2024-04-24 14:35:34','2024-04-24 14:35:34',NULL),(20,19,205,NULL,'absent',NULL,'2024-04-24 14:35:34','2024-04-24 14:35:34',NULL),(21,19,206,NULL,'absent',NULL,'2024-04-24 14:35:35','2024-04-24 14:35:35',NULL),(22,19,207,NULL,'absent',NULL,'2024-04-24 14:35:35','2024-04-24 14:35:35',NULL),(23,19,208,NULL,'absent',NULL,'2024-04-24 14:35:35','2024-04-24 14:35:35',NULL),(24,19,209,NULL,'absent',NULL,'2024-04-24 14:35:36','2024-04-24 14:35:36',NULL),(25,19,210,NULL,'absent',NULL,'2024-04-24 14:35:37','2024-04-24 14:35:37',NULL),(26,19,211,NULL,'absent',NULL,'2024-04-24 14:35:39','2024-04-24 14:35:39',NULL),(27,19,212,NULL,'absent',NULL,'2024-04-24 14:35:40','2024-04-24 14:35:40',NULL);
/*!40000 ALTER TABLE `intervention_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_class`
--

DROP TABLE IF EXISTS `intervention_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_class` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `intervention_id` int unsigned DEFAULT NULL,
  `class_name` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `intervention_class_intervention_id_foreign` (`intervention_id`),
  CONSTRAINT `intervention_class_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_class`
--

LOCK TABLES `intervention_class` WRITE;
/*!40000 ALTER TABLE `intervention_class` DISABLE KEYS */;
INSERT INTO `intervention_class` VALUES (6,15,'Negotiation 101','2024-04-20','2024-04-24','Great Hall, Lugbe','2024-04-18 20:03:05','2024-04-20 09:57:07','2024-04-20 09:57:07'),(7,17,'AWS Lambda Basics','2024-04-19','2024-04-22','Tech Hub, Gwarinpa','2024-04-18 20:04:17','2024-04-20 09:54:57','2024-04-20 09:54:57'),(8,15,'Negotiation 103','2024-04-19','2024-04-25','Life Camp','2024-04-18 20:05:11','2024-04-18 20:05:11',NULL),(9,15,'Negotiation 101','2024-04-21','2024-04-24','Tech Hub, Gwarinpa','2024-04-20 09:58:13','2024-04-20 09:58:13',NULL),(10,16,'HRM 101','2024-04-22','2024-04-22','Tech Hub, Gwarinpa','2024-04-21 16:09:20','2024-04-21 16:09:20',NULL),(11,16,'HRM 102','2024-04-25','2024-04-23','Tech Hub, Gwarinpa','2024-04-21 16:09:42','2024-04-21 16:09:42',NULL),(12,19,'AWS 101','2024-04-23','2024-04-23','Lugbe, Kapwa','2024-04-21 21:17:40','2024-04-21 21:17:40',NULL),(13,19,'AWS 105','2024-04-22','2024-04-23','Great Hall, Lugbe','2024-04-21 21:18:14','2024-04-21 21:18:14',NULL);
/*!40000 ALTER TABLE `intervention_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_content`
--

DROP TABLE IF EXISTS `intervention_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `intervention_id` int unsigned NOT NULL,
  `module_title` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sub_topics` text,
  `objectives` text,
  PRIMARY KEY (`id`),
  KEY `intervention_content_intervention_id_foreign` (`intervention_id`),
  CONSTRAINT `intervention_content_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_content`
--

LOCK TABLES `intervention_content` WRITE;
/*!40000 ALTER TABLE `intervention_content` DISABLE KEYS */;
INSERT INTO `intervention_content` VALUES (8,15,'Basics of Negotiation','2024-04-18 21:12:07','2024-04-18 21:31:34','2024-04-18 21:31:34','<ol style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style-position: initial; list-style-image: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Introduction to Negotiation</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Types of Negotiation (Distributive vs. Integrative)</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Key Concepts in Negotiation (BATNA, Reservation Point, ZOPA)</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">The Negotiation Process</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Preparation and Planning for Negotiation</span></li></ol>                                    ','<ol style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style-position: initial; list-style-image: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Introduction to Negotiation:</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Define negotiation and its importance in various contexts.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Identify the parties involved in negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Understand the basic principles and goals of negotiation.</span></font></li></ul></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Types of Negotiation (Distributive vs. Integrative):</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Differentiate between distributive and integrative negotiation approaches.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Describe the characteristics and objectives of distributive negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Explain the benefits and challenges of integrative negotiation.</span></font></li></ul></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Key Concepts in Negotiation (BATNA, Reservation Point, ZOPA):</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Define and explain BATNA (Best Alternative to a Negotiated Agreement).</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Understand the concept of Reservation Point and its significance in negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Explain the Zone of Possible Agreement (ZOPA) and how it affects negotiation outcomes.</span></font></li></ul></li></ol>                                  '),(9,15,'Basics of Negotiation','2024-04-18 21:12:46','2024-04-18 21:18:37','2024-04-18 21:18:37','                    <ol style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style-position: initial; list-style-image: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Introduction to Negotiation</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Types of Negotiation (Distributive vs. Integrative)</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Key Concepts in Negotiation (BATNA, Reservation Point, ZOPA)</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">The Negotiation Process</span></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Preparation and Planning for Negotiation</span></li></ol>                                                    ','                    <ol style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style-position: initial; list-style-image: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Introduction to Negotiation:</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Define negotiation and its importance in various contexts.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Identify the parties involved in negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Understand the basic principles and goals of negotiation.</span></font></li></ul></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Types of Negotiation (Distributive vs. Integrative):</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Differentiate between distributive and integrative negotiation approaches.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Describe the characteristics and objectives of distributive negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Explain the benefits and challenges of integrative negotiation.</span></font></li></ul></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0.375em; list-style-position: inside;\"><p style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; display: inline;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Key Concepts in Negotiation (BATNA, Reservation Point, ZOPA):</span></font></p><ul style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; list-style: disc; margin-right: 0px; margin-left: 1rem; padding: 0px 0px 0px 1rem;\"><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Define and explain BATNA (Best Alternative to a Negotiated Agreement).</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Understand the concept of Reservation Point and its significance in negotiation.</span></font></li><li style=\"border: 0px solid rgb(227, 227, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; margin-bottom: 0px; margin-top: 0px; padding-left: 0px;\"><font color=\"#000000\" style=\"\"><span style=\"font-family: &quot;Segoe UI&quot;;\">Explain the Zone of Possible Agreement (ZOPA) and how it affects negotiation outcome.</span></font></li></ul></li></ol>                                                '),(10,17,'Getting started with cloud','2024-04-19 07:34:19','2024-04-19 07:34:19',NULL,'                                        Getting started with cloud&nbsp;Getting started with cloud&nbsp;Getting started with cloud                                ','                                        Getting started with cloud&nbsp;Getting started with cloud&nbsp;Getting started with cloud                            ');
/*!40000 ALTER TABLE `intervention_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_type`
--

DROP TABLE IF EXISTS `intervention_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_type`
--

LOCK TABLES `intervention_type` WRITE;
/*!40000 ALTER TABLE `intervention_type` DISABLE KEYS */;
INSERT INTO `intervention_type` VALUES (1,'Virtual','2024-04-14 19:03:38','2024-04-14 19:21:00','2024-04-14 19:21:00'),(2,'Virtual','2024-04-14 19:48:10','2024-04-14 19:48:10',NULL),(3,'In-Person','2024-04-14 19:48:30','2024-04-20 10:11:58','2024-04-20 10:11:58'),(4,'Asynchronous E-Learning','2024-04-14 19:49:02','2024-04-14 19:49:02',NULL),(5,'Blended Learning','2024-04-14 19:49:19','2024-04-18 20:40:44',NULL),(6,'In-Person','2024-04-20 10:12:11','2024-04-20 10:12:11',NULL);
/*!40000 ALTER TABLE `intervention_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervention_vendor`
--

DROP TABLE IF EXISTS `intervention_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervention_vendor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intervention_id` int unsigned DEFAULT NULL,
  `service_provided` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention_vendor`
--

LOCK TABLES `intervention_vendor` WRITE;
/*!40000 ALTER TABLE `intervention_vendor` DISABLE KEYS */;
INSERT INTO `intervention_vendor` VALUES (1,'Ahmad Sharafudeen','Rofee\'ah AbdurRahman','asharafudeenraji@gmail.com','07066402941',NULL,'2024-04-20 10:29:14','2024-04-20 10:29:14',NULL,NULL),(2,'Kamilu','Sadeeq','kamilu@gmail.com','08030735791','2024-04-14 20:11:11','2024-04-14 20:13:42','2024-04-14 20:13:42',NULL,NULL),(3,'KhemShield','Kareem Adamu','kareem.adamu@buk.edu.ng','08030735791','2024-04-15 00:00:35','2024-04-15 00:03:26',NULL,4,'Cyber Security Services'),(4,'KhemShieldss','Mansur Babagana','mbabagana.cs@buk.edu.ng','08030735791','2024-04-15 00:04:01','2024-04-19 06:02:20','2024-04-19 06:02:20',4,'Security Services');
/*!40000 ALTER TABLE `intervention_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `job_title` varchar(100) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (4,'Software Engineer','- Bachelor\'s degree in Computer Science or Software Engineering','2024-02-25 06:53:01','2024-02-25 06:53:01',NULL),(5,'Talent Manager','- Human Resources Management\r\n- Communocation skills','2024-02-26 14:50:55','2024-02-26 14:50:55',NULL),(9,'Admin','','2024-04-13 18:55:20','2024-04-13 18:55:20',NULL),(10,'Staff','','2024-04-13 18:55:26','2024-04-13 18:55:26',NULL),(11,'Manager','','2024-04-13 18:55:32','2024-04-13 18:55:32',NULL),(12,'Backend Engineer','','2024-04-26 19:58:06','2024-04-26 19:58:06',NULL);
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_competencies`
--

DROP TABLE IF EXISTS `job_competencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_competencies` (
  `job_id` int unsigned NOT NULL,
  `competency_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `job_competencies_job_id_foreign` (`job_id`),
  KEY `job_competencies_competency_id_foreign` (`competency_id`),
  CONSTRAINT `job_competencies_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_competencies_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_competencies`
--

LOCK TABLES `job_competencies` WRITE;
/*!40000 ALTER TABLE `job_competencies` DISABLE KEYS */;
INSERT INTO `job_competencies` VALUES (5,3,'2024-03-14 17:15:11','2024-04-12 02:44:55','2024-04-12 02:44:55'),(5,2,'2024-03-14 17:15:11','2024-04-12 02:44:55','2024-04-12 02:44:55'),(4,5,'2024-04-02 14:34:43','2024-04-13 19:33:01','2024-04-13 19:33:01'),(4,4,'2024-04-02 14:34:43','2024-04-13 19:33:01','2024-04-13 19:33:01'),(4,3,'2024-04-02 14:34:43','2024-04-13 19:33:01','2024-04-13 19:33:01'),(5,8,'2024-04-12 02:44:55','2024-04-14 09:43:48','2024-04-14 09:43:48'),(5,7,'2024-04-12 02:44:55','2024-04-14 09:43:48','2024-04-14 09:43:48'),(5,6,'2024-04-12 02:44:55','2024-04-14 09:43:48','2024-04-14 09:43:48'),(5,3,'2024-04-12 02:44:55','2024-04-14 09:43:48','2024-04-14 09:43:48'),(4,8,'2024-04-13 19:33:01','2024-04-14 09:32:11','2024-04-14 09:32:11'),(4,5,'2024-04-13 19:33:01','2024-04-14 09:32:11','2024-04-14 09:32:11'),(4,4,'2024-04-13 19:33:01','2024-04-14 09:32:11','2024-04-14 09:32:11'),(4,3,'2024-04-13 19:33:01','2024-04-14 09:32:11','2024-04-14 09:32:11'),(11,7,'2024-04-13 19:52:10','2024-04-13 19:52:10',NULL),(11,2,'2024-04-13 19:52:10','2024-04-13 19:52:10',NULL),(9,8,'2024-04-13 19:52:24','2024-04-20 07:11:51','2024-04-20 07:11:51'),(10,1,'2024-04-13 19:52:39','2024-04-13 19:52:39',NULL),(4,9,'2024-04-14 09:32:11','2024-04-24 14:11:43','2024-04-24 14:11:43'),(4,8,'2024-04-14 09:32:11','2024-04-24 14:11:43','2024-04-24 14:11:43'),(4,5,'2024-04-14 09:32:11','2024-04-24 14:11:43','2024-04-24 14:11:43'),(4,4,'2024-04-14 09:32:11','2024-04-24 14:11:43','2024-04-24 14:11:43'),(4,3,'2024-04-14 09:32:11','2024-04-24 14:11:43','2024-04-24 14:11:43'),(5,8,'2024-04-14 09:43:48','2024-04-20 07:02:46','2024-04-20 07:02:46'),(5,7,'2024-04-14 09:43:48','2024-04-20 07:02:46','2024-04-20 07:02:46'),(5,6,'2024-04-14 09:43:48','2024-04-20 07:02:46','2024-04-20 07:02:46'),(5,3,'2024-04-14 09:43:48','2024-04-20 07:02:46','2024-04-20 07:02:46'),(5,2,'2024-04-14 09:43:48','2024-04-20 07:02:46','2024-04-20 07:02:46'),(5,9,'2024-04-20 07:03:28','2024-04-20 07:03:28',NULL),(5,8,'2024-04-20 07:03:28','2024-04-20 07:03:28',NULL),(5,7,'2024-04-20 07:03:28','2024-04-20 07:03:28',NULL),(5,6,'2024-04-20 07:03:28','2024-04-20 07:03:28',NULL),(4,9,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(4,8,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(4,7,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(4,5,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(4,4,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(4,3,'2024-04-24 14:11:43','2024-04-24 14:11:43',NULL),(12,9,'2024-04-26 20:00:35','2024-04-26 20:00:54','2024-04-26 20:00:54'),(12,8,'2024-04-26 20:00:35','2024-04-26 20:00:54','2024-04-26 20:00:54'),(12,6,'2024-04-26 20:00:35','2024-04-26 20:00:54','2024-04-26 20:00:54'),(12,3,'2024-04-26 20:00:35','2024-04-26 20:00:54','2024-04-26 20:00:54'),(12,9,'2024-04-26 20:00:54','2024-04-26 20:00:54',NULL),(12,8,'2024-04-26 20:00:54','2024-04-26 20:00:54',NULL);
/*!40000 ALTER TABLE `job_competencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learning_intervention`
--

DROP TABLE IF EXISTS `learning_intervention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `learning_intervention` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cycle_id` int unsigned NOT NULL,
  `intervention_type_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cost` float DEFAULT '0',
  `trainer_id` int unsigned DEFAULT NULL,
  `competency_id` int unsigned DEFAULT NULL,
  `intervention_name` varchar(255) DEFAULT NULL,
  `intervention_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `learning_intervention_cycle_id_foreign` (`cycle_id`),
  KEY `learning_intervention_intervention_type_id_foreign` (`intervention_type_id`),
  CONSTRAINT `learning_intervention_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  CONSTRAINT `learning_intervention_intervention_type_id_foreign` FOREIGN KEY (`intervention_type_id`) REFERENCES `intervention_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learning_intervention`
--

LOCK TABLES `learning_intervention` WRITE;
/*!40000 ALTER TABLE `learning_intervention` DISABLE KEYS */;
INSERT INTO `learning_intervention` VALUES (15,8,5,'2024-04-18 19:59:51','2024-04-21 21:16:40',NULL,100000,242,2,'Negotiation Workshop','INT71248'),(16,8,2,'2024-04-18 20:00:36','2024-04-21 15:05:26',NULL,980000,246,7,'Human Resources Management','INT18042'),(17,6,4,'2024-04-18 20:01:36','2024-04-18 20:01:36',NULL,200000,27,5,'Cloud Computing (AWS)','INT37129'),(18,6,3,'2024-04-19 06:38:47','2024-04-20 10:53:43','2024-04-20 10:53:43',450000000,47,1,'Design Basics','INT61432'),(19,8,4,'2024-04-21 21:17:10','2024-04-21 21:17:10',NULL,8900000,27,5,'AWS Learning','INT10823'),(20,6,4,'2024-04-24 14:32:45','2024-04-24 14:32:45',NULL,560000,47,3,'Human Resources Management','INT65249');
/*!40000 ALTER TABLE `learning_intervention` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2023-11-14-084158','App\\Database\\Migrations\\AddJob','default','App',1706745206,1),(2,'2023-11-14-083901','App\\Database\\Migrations\\AddEmployee','default','App',1706745213,2),(3,'2023-11-14-073745','App\\Database\\Migrations\\AddUser','default','App',1706745238,3),(4,'2023-11-15-023348','App\\Database\\Migrations\\AddCompetency','default','App',1706745329,4),(5,'2023-11-15-023646','App\\Database\\Migrations\\AddCompetencyDescriptor','default','App',1706745349,5),(6,'2023-11-17-015400','App\\Database\\Migrations\\AddDevelopmentCycle','default','App',1706745364,6),(7,'2023-11-17-022717','App\\Database\\Migrations\\AlterUserTable','default','App',1706745377,7),(8,'2023-11-17-023137','App\\Database\\Migrations\\AlterEmployeeTable','default','App',1706745388,8),(9,'2023-11-17-023308','App\\Database\\Migrations\\AlterCompetencyTable','default','App',1706745402,9),(10,'2023-11-17-023456','App\\Database\\Migrations\\AlterCompetencyDescriptorTable','default','App',1706745415,10),(11,'2023-11-17-023623','App\\Database\\Migrations\\AlterJobTable','default','App',1706745430,11),(12,'2023-11-17-023814','App\\Database\\Migrations\\AddDevelopmentRating','default','App',1706745444,12),(13,'2023-11-17-025557','App\\Database\\Migrations\\AddInterventionVendor','default','App',1706745465,13),(14,'2023-11-17-030418','App\\Database\\Migrations\\AddInterventionType','default','App',1706745476,14),(15,'2023-11-17-032438','App\\Database\\Migrations\\AddLearningIntervention','default','App',1706745486,15),(16,'2023-11-17-032618','App\\Database\\Migrations\\AddInterventionAttendance','default','App',1706745501,16),(17,'2023-11-17-034201','App\\Database\\Migrations\\AlterEmployeeAddField','default','App',1706745592,17),(18,'2023-11-17-034732','App\\Database\\Migrations\\AddUserRole','default','App',1706745605,18),(19,'2023-11-17-040151','App\\Database\\Migrations\\AlterInterventionAttendance','default','App',1706745618,19),(20,'2023-11-17-040424','App\\Database\\Migrations\\AlterUserRole','default','App',1706745640,20),(21,'2023-11-17-040555','App\\Database\\Migrations\\AddParticipantFeedback','default','App',1706745662,21),(22,'2023-11-17-041447','App\\Database\\Migrations\\AddSelectionIntervention','default','App',1706745676,22),(23,'2024-01-06-014326','App\\Database\\Migrations\\DivisionsMigration','default','App',1706745703,23),(24,'2024-01-06-014356','App\\Database\\Migrations\\GroupMigration','default','App',1706745716,24),(25,'2024-01-06-014411','App\\Database\\Migrations\\DepartmentMigration','default','App',1706745729,25),(27,'2024-01-06-014428','App\\Database\\Migrations\\UnitMigration','default','App',1708194911,26),(28,'2024-02-17-143630','App\\Database\\Migrations\\AlterUserTable','default','App',1708195120,27),(29,'2024-02-18-072348','App\\Database\\Migrations\\RemoveEmployeeIDColumnFromUser','default','App',1708241128,28),(31,'2024-02-19-081454','App\\Database\\Migrations\\AlterUserAddusername','default','App',1708330669,30),(32,'2024-02-18-115208','App\\Database\\Migrations\\UnitCompetency','default','App',1708415405,31),(33,'2024-02-20-140803','App\\Database\\Migrations\\CreateJobCompetenciesTable','default','App',1708438154,32),(34,'2024-02-20-171216','App\\Database\\Migrations\\AlterGroupTableAddUniqueTogether','default','App',1708449458,33),(35,'2024-02-20-171230','App\\Database\\Migrations\\AlterDepartmentTableAddUniqueTogether','default','App',1708449458,33),(36,'2024-02-20-171238','App\\Database\\Migrations\\AlterUnitTableAddUniqueTogether','default','App',1708449458,33),(37,'2024-02-20-181425','App\\Database\\Migrations\\AlterJobAddUnitID','default','App',1708454106,34),(38,'2024-02-20-182327','App\\Database\\Migrations\\AlterJobAddDepartmentID','default','App',1708454106,34),(39,'2024-02-20-183238','App\\Database\\Migrations\\AlterCompetencyAddDescription','default','App',1708454106,34),(40,'2024-02-24-013701','App\\Database\\Migrations\\AlterJobControllerAddTimeStamps','default','App',1708738719,35),(41,'2024-02-25-080911','App\\Database\\Migrations\\AlterUserRoleTable','default','App',1708849167,36),(42,'2024-02-25-082012','App\\Database\\Migrations\\CreateEmployeeRolesTable','default','App',1708849297,37),(43,'2024-02-25-082535','App\\Database\\Migrations\\AlterRoleRemoveUserID','default','App',1708849755,38),(44,'2024-02-25-084139','App\\Database\\Migrations\\AlterEmployeeRoleAddTimeStamp','default','App',1708850579,39),(45,'2024-02-25-091714','App\\Database\\Migrations\\AlterEmployeeRoleTableAddUserID','default','App',1708852887,40),(46,'2024-03-25-135838','App\\Database\\Migrations\\ModifyEmployee','default','App',1711375453,41),(47,'2024-04-01-124619','App\\Database\\Migrations\\AlterEmployeeAddDeptId','default','App',1711981168,42),(48,'2024-04-02-140525','App\\Database\\Migrations\\AlterDevCycleTable','default','App',1712066980,43),(49,'2024-04-03-173245','App\\Database\\Migrations\\EmailTemplateMigration','default','App',1712652195,44),(50,'2024-04-03-173245','App\\Database\\Migrations\\EmailTemplateMigrationSetup','default','App',1712652684,45),(51,'2024-04-09-085750','App\\Database\\Migrations\\SiteSettingsMigration','default','App',1712653600,46),(52,'2024-04-09-090804','App\\Database\\Migrations\\AlterEmailTemplate','default','App',1712653779,47),(53,'2024-04-09-090818','App\\Database\\Migrations\\AlterSiteSettings','default','App',1712653779,47),(54,'2024-04-03-173245','App\\Database\\Migrations\\EmailTemplate','default','App',1712661927,48),(55,'2024-04-09-085750','App\\Database\\Migrations\\SiteSettings','default','App',1712661927,48),(56,'2024-04-09-141155','App\\Database\\Migrations\\AlterEmailTemplateAddFrom','default','App',1712672053,49),(57,'2024-04-12-084041','App\\Database\\Migrations\\AlterEmailTemplateAddFromName','default','App',1712911303,50),(58,'2024-04-14-092431','App\\Database\\Migrations\\EmailLogsTable','default','App',1713086729,51),(59,'2024-04-14-093215','App\\Database\\Migrations\\EmailLogsTableAlter','default','App',1713087282,52),(60,'2024-04-14-115727','App\\Database\\Migrations\\AlterEmailLogAddUpdatedAt','default','App',1713096334,53),(61,'2024-04-14-232250','App\\Database\\Migrations\\InterventionClasses','default','App',1713137557,54),(62,'2024-04-14-232449','App\\Database\\Migrations\\AlterInterventionTable','default','App',1713137558,54),(63,'2024-04-14-233621','App\\Database\\Migrations\\AlterInterventionTableAddCost','default','App',1713137982,55),(64,'2024-04-14-234002','App\\Database\\Migrations\\AlterInterventionClasses','default','App',1713138054,56),(65,'2024-04-14-234623','App\\Database\\Migrations\\InterventionContentNew','default','App',1713138488,57),(66,'2024-04-15-000415','App\\Database\\Migrations\\AlterInterventionTableRenameVendor','default','App',1713139968,58),(67,'2024-04-15-004045','App\\Database\\Migrations\\AlterInterventionVendor','default','App',1713141742,59),(68,'2024-04-15-005414','App\\Database\\Migrations\\AlterInterventionVendorAddField','default','App',1713142563,60),(69,'2024-04-16-012559','App\\Database\\Migrations\\AlterLearningInterventionAddField','default','App',1713230977,61),(70,'2024-04-16-015140','App\\Database\\Migrations\\EmployeeInterventionMappingTable','default','App',1713232594,62),(71,'2024-04-16-030019','App\\Database\\Migrations\\AlterLearningInterventionAddName','default','App',1713236501,63),(72,'2024-04-16-030337','App\\Database\\Migrations\\AlterLearningInterventionAddInterventionName','default','App',1713236678,64),(73,'2024-04-16-034137','App\\Database\\Migrations\\AlterEmployeeInterventionModifyIntervention','default','App',1713239191,65),(74,'2024-04-17-004252','App\\Database\\Migrations\\AlterInterventionContent','default','App',1713314721,66),(75,'2024-04-17-022413','App\\Database\\Migrations\\AlterEmployeeInterventionsMapping','default','App',1713320891,67),(76,'2024-04-17-024235','App\\Database\\Migrations\\AlterEmployeeInterventionAddCycleId','default','App',1713321892,68),(77,'2024-04-18-144112','App\\Database\\Migrations\\AlterLearningInterventionAddInterventionId','default','App',1713454147,69),(78,'2024-04-21-224455','App\\Database\\Migrations\\EmailLogModifyAddInterventionId','default','App',1713739660,70),(79,'2024-04-21-233330','App\\Database\\Migrations\\AttendanceTableAlter','default','App',1713743085,71),(80,'2024-04-22-001451','App\\Database\\Migrations\\AddInterventionTableAgain','default','App',1713745038,72),(81,'2024-04-22-001813','App\\Database\\Migrations\\AddInterventionTableReCreate','default','App',1713745170,73),(82,'2024-04-22-025253','App\\Database\\Migrations\\PersonalDevPlanTable','default','App',1713776185,74),(83,'2024-04-22-025311','App\\Database\\Migrations\\AnnualDevPlanTable','default','App',1713776185,74),(84,'2024-04-22-085414','App\\Database\\Migrations\\PasswordReset','default','App',1713776185,74),(85,'2024-04-22-090732','App\\Database\\Migrations\\CreatePersonalDevelopmentPlansTable','default','App',1713776928,75);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participant_feedback`
--

DROP TABLE IF EXISTS `participant_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participant_feedback` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `intervention_id` int unsigned NOT NULL,
  `employee_id` int unsigned NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `participant_feedback_intervention_id_foreign` (`intervention_id`),
  KEY `participant_feedback_employee_id_foreign` (`employee_id`),
  CONSTRAINT `participant_feedback_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participant_feedback_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participant_feedback`
--

LOCK TABLES `participant_feedback` WRITE;
/*!40000 ALTER TABLE `participant_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `participant_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_development_plan`
--

DROP TABLE IF EXISTS `personal_development_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_development_plan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned NOT NULL,
  `cycle_id` int unsigned NOT NULL,
  `competency_id` int unsigned NOT NULL,
  `average_rating` float NOT NULL,
  `employee_signed_off` tinyint(1) NOT NULL DEFAULT '0',
  `line_manager_signed_off` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_development_plan_employee_id_foreign` (`employee_id`),
  KEY `personal_development_plan_cycle_id_foreign` (`cycle_id`),
  KEY `personal_development_plan_competency_id_foreign` (`competency_id`),
  CONSTRAINT `personal_development_plan_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personal_development_plan_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personal_development_plan_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_development_plan`
--

LOCK TABLES `personal_development_plan` WRITE;
/*!40000 ALTER TABLE `personal_development_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_development_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (8,'LineManager',NULL,NULL,NULL),(9,'LDM',NULL,NULL,NULL),(10,'Trainer',NULL,NULL,NULL),(11,'Employee',NULL,NULL,NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selected_intervention`
--

DROP TABLE IF EXISTS `selected_intervention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `selected_intervention` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `intervention_id` int unsigned NOT NULL,
  `employee_id` int unsigned NOT NULL,
  `competency_id` int unsigned NOT NULL,
  `cycle_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `selected_intervention_intervention_id_foreign` (`intervention_id`),
  KEY `selected_intervention_employee_id_foreign` (`employee_id`),
  KEY `selected_intervention_competency_id_foreign` (`competency_id`),
  KEY `selected_intervention_cycle_id_foreign` (`cycle_id`),
  CONSTRAINT `selected_intervention_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE,
  CONSTRAINT `selected_intervention_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  CONSTRAINT `selected_intervention_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `selected_intervention_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selected_intervention`
--

LOCK TABLES `selected_intervention` WRITE;
/*!40000 ALTER TABLE `selected_intervention` DISABLE KEYS */;
/*!40000 ALTER TABLE `selected_intervention` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `logo` varchar(350) DEFAULT NULL,
  `company_address` text NOT NULL,
  `primary_color` varchar(10) DEFAULT NULL,
  `secondary_color` varchar(10) DEFAULT NULL,
  `background_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'AFIL',NULL,'Central Busines District, Abuja',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(355) NOT NULL,
  `department_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_department_id_foreign` (`department_id`),
  CONSTRAINT `unit_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (4,'Project Management',8,'2024-04-02 07:54:36','2024-04-02 07:55:50',NULL),(5,'Interior Decor',8,'2024-04-02 07:55:06','2024-04-20 12:09:14','2024-04-20 12:09:14'),(6,'recruitment',9,NULL,'2024-04-20 12:07:41','2024-04-20 12:07:41'),(7,'Accounting',9,NULL,'2024-04-20 12:05:15','2024-04-20 12:05:15'),(8,'Compliance',10,'2024-04-13 19:48:43','2024-04-13 19:48:43',NULL),(9,'Zoology',8,'2024-04-13 19:49:12','2024-04-13 19:49:12',NULL);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_competency`
--

DROP TABLE IF EXISTS `unit_competency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit_competency` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `unit_id` int unsigned NOT NULL,
  `competency_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_competency_unit_id_foreign` (`unit_id`),
  KEY `unit_competency_competency_id_foreign` (`competency_id`),
  CONSTRAINT `unit_competency_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unit_competency_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_competency`
--

LOCK TABLES `unit_competency` WRITE;
/*!40000 ALTER TABLE `unit_competency` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_competency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (36,'ahmad.sharafudeen@gmail.com','$2y$10$mzXvq7F5RM3h3vA0hy0mzu4wMjW25iUbfwAVwyi7r3fB/kp2bR07i','Ahmad','Sharafudeen','2024-03-25 10:58:43','2024-04-14 23:27:49',NULL,'LD328136'),(37,'mbabagana.cs@buk.edu.ng','$2y$10$ZEDwHMO75zSQgMnyxYF6.e2KB1ZHPKXnVkDEdTlEt49jVySIP0VdK','Mansur','Babagana','2024-03-25 12:56:05','2024-04-01 10:28:31',NULL,'LD694592'),(38,'uambursa.It@buk.edu.ng','$2y$10$aSUSJxub4uVFRTXbIA3WdOduQhltade38xEXhIkHpcJsnfteSZIi6','Faruk','Ambursa','2024-03-25 13:35:19','2024-03-25 14:05:54',NULL,'LD757956'),(39,'rofeeah@gmail.com','$2y$10$AS/8BGnQkjzDHR1/B/zgXOpUEd8L1ZM0.7NM60EEg.q2ZYcuRdcJy','Rofee\'ah','Juwon','2024-03-25 13:36:27','2024-04-01 10:31:54','2024-04-01 10:31:54','LD414153'),(40,'muneer@gmail.com','$2y$10$ZtSmXGCzq8DvSvV8kUc.WeyH6dlfIfCvJnqc96GripTmI8l6QEKd2','Muneeru','Kaamil','2024-03-25 13:37:30','2024-04-01 10:28:51',NULL,'LD009074'),(41,'jumai@gmail.com','$2y$10$UPkoL7kAmyRSn1cShaBzruxnWJMvG1dOFIazmoUT5vhWvP0NxlFM2','Jumai','Usman','2024-03-26 11:46:46','2024-04-01 11:10:26',NULL,'LD095206'),(45,'asharafudeenraji@gmail.com','$2y$10$QHmL3q2cJf//LlrhPmqkuOhMEf0HPAsntqv0ona03D6/Wz4nTO1W6','Adeniyi','Sharafudeen','2024-03-31 09:20:26','2024-04-22 07:41:11',NULL,'LD229330'),(46,'muideen@gmail.com','$2y$10$VjNFPMZKbM.7NTwN03BeMeptbkAGdt93VHAlXI1WAcz1VzhL8GFvG','Muideen','Ojo','2024-03-31 12:44:00','2024-04-16 02:57:12',NULL,'LD815879'),(47,'ojo@gmail.com','$2y$10$LTt2uHnb7O5.eW8sJbQ5WOo4mDQALVpQVi2po9TIuqClpbVCX8HGi','Ojo','Abimbola','2024-04-01 09:55:21','2024-04-16 02:57:27',NULL,'LD660182'),(50,'anike@gmail.com','$2y$10$YYPjQ61lhxlUYeTqJFV8C.mCfM2cve/XTllvePmwynoBPk5fs4ntS','Anike','Rahman','2024-04-11 06:14:49','2024-04-11 06:14:49',NULL,'LD053369'),(52,'jamiu@gmail.com','$2y$10$rXCNts2HnyOmqI3IIMV4m.tuIl3EzZSHoNk4qkXWBCKSE.NHPEt6i','Jamiu','Adepate','2024-04-11 10:39:12','2024-04-11 10:39:12',NULL,'LD866656'),(55,'hkakudi.cs@buk.edu.ng','$2y$10$SK6gv.IurlrW.5Ahb8rW5uq3SMV4sD9mjamzg5tkzC9uB80BmYryy','Habeebah','Kakudi','2024-04-11 10:54:55','2024-04-12 02:40:57',NULL,'LD588545'),(56,'yusuff.taiwo@gmail.com','$2y$10$4PPEmXBAygaHYLR5be/OSOrv7T8rHC8Hdnuzu6Tboyk9GhJEjoZAK','Yusuf','Taiwo','2024-04-12 07:44:38','2024-04-12 07:45:40',NULL,'LD936279'),(261,'gbitse@gmail.com','$2y$10$5iOphCl1wdLwk0eiZCD/6OhVhCwYffZ9lJick9gRZ14mNXzQ6PM/C','Gbitse','Barrow','2024-04-26 20:31:56','2024-04-26 20:31:56',NULL,'LD254826');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-28  8:22:26
