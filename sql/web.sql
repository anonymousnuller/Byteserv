-- MySQL dump 10.19  Distrib 10.2.39-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: deinmusi_byteserv
-- ------------------------------------------------------
-- Server version	10.2.39-MariaDB-1:10.2.39+maria~bionic

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
-- Current Database: `deinmusi_byteserv`
--


--
-- Table structure for table `kvm_os`
--

DROP TABLE IF EXISTS `kvm_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kvm_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `osid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kvm_os`
--

LOCK TABLES `kvm_os` WRITE;
/*!40000 ALTER TABLE `kvm_os` DISABLE KEYS */;
INSERT INTO `kvm_os` VALUES (1,881,'Debian 10','2021-06-28 08:22:39','2021-06-28 08:22:39');
/*!40000 ALTER TABLE `kvm_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kvm_packs`
--

DROP TABLE IF EXISTS `kvm_packs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kvm_packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `cores` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `disc` varchar(255) NOT NULL,
  `laufzeit` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kvm_packs`
--

LOCK TABLES `kvm_packs` WRITE;
/*!40000 ALTER TABLE `kvm_packs` DISABLE KEYS */;
INSERT INTO `kvm_packs` VALUES (1,'Paket 1','Vienna (VIE)',1.00,'2','512','10',30,'2021-06-27 18:32:15','2021-06-27 18:38:49');
/*!40000 ALTER TABLE `kvm_packs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kvmserver`
--

DROP TABLE IF EXISTS `kvmserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kvmserver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `virt_id` int(11) DEFAULT NULL,
  `serv_ip` varchar(255) NOT NULL DEFAULT '-',
  `root_pw` varchar(255) DEFAULT NULL,
  `hostname` varchar(255) DEFAULT NULL,
  `state` enum('active','installing','suspended','deleted') NOT NULL,
  `expire_at` datetime NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kvmserver`
--

LOCK TABLES `kvmserver` WRITE;
/*!40000 ALTER TABLE `kvmserver` DISABLE KEYS */;
/*!40000 ALTER TABLE `kvmserver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_message`
--

DROP TABLE IF EXISTS `ticket_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_message`
--

LOCK TABLES `ticket_message` WRITE;
/*!40000 ALTER TABLE `ticket_message` DISABLE KEYS */;
INSERT INTO `ticket_message` VALUES (1,2,1,'test123','2021-06-28 17:37:27','2021-06-28 17:37:27'),(2,2,1,'test12','2021-06-28 17:39:28','2021-06-28 17:39:28'),(3,3,1,'Heftiiiiige Tickeeeet','2021-06-29 16:31:18','2021-06-29 16:31:18'),(4,3,1,'Test123','2021-06-29 16:31:30','2021-06-29 16:31:30');
/*!40000 ALTER TABLE `ticket_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `last_msg` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,1,'ALLGEMEIN','NORMAL','Test123','CLOSED','CUSTOMER','2021-06-28 17:36:56','2021-06-28 17:43:18'),(2,1,'ALLGEMEIN','NORMAL','Test123','CLOSED','CUSTOMER','2021-06-28 17:37:27','2021-06-28 17:42:58'),(3,1,'ALLGEMEIN','NORMAL','Das echte','CLOSED','SUPPORT','2021-06-29 16:31:18','2021-06-29 16:32:21');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `gateway` enum('Mollie','intern') NOT NULL,
  `state` enum('PENDING','ABORT','DONE') NOT NULL,
  `amount` decimal(43,2) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `tid` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,'Mollie','DONE',2.50,'Guthabenaufladung mit Mollie','tr_hbw4afH9h5','2021-06-28 12:15:18','2021-06-28 13:02:37'),(2,1,'Mollie','PENDING',2.50,'Guthabenaufladung mit Mollie',NULL,'2021-06-28 12:29:17','2021-06-28 13:02:25');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_transactions`
--

DROP TABLE IF EXISTS `user_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `art` enum('INTERN','ORDER','RENEW') NOT NULL,
  `amount` decimal(43,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_transactions`
--

LOCK TABLES `user_transactions` WRITE;
/*!40000 ALTER TABLE `user_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `state` enum('active','pending','disabled','') NOT NULL,
  `role` enum('admin','support','customer','') NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `verify_code` varchar(255) DEFAULT NULL,
  `support_pin` varchar(255) DEFAULT NULL,
  `user_addr` varchar(255) DEFAULT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `plesk_uid` varchar(255) DEFAULT NULL,
  `plesk_password` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'DevCommand','zocherhd15@gmail.com','$2y$10$yj7BFxZPE/N9uXHDsbsaKO2U3Qb.NJGGjNhVPwOI5SYOOrdHoP4wu','active','admin',0.00,'PtNPz3gmuQcHcohS','6867-1149','77.119.157.58','H65MzzyWYNbuGorfQktywFhvAUVzef',NULL,NULL,'2021-06-27 16:18:26','2021-07-03 08:22:29'),(2,'typischluis','luis@overhaus.net','$2y$10$tbzC3JI6KdOdiQlmUqkoKu8hdl9MOgMEtRV/6ZJIv/a8eLgpLPbFm','pending','customer',0.00,'F2ZOnNHwoJYCtauU',NULL,NULL,NULL,NULL,NULL,'2021-06-28 21:07:11','2021-06-28 21:07:11'),(3,'IamElite8TV','IamElite8TV@team-freeze.eu','$2y$10$CaMxQ8B0M74u2HmRAYvfuOqP1HwMkhxQYD2za2FMa1OaPjpyp7BQ.','pending','customer',0.00,'6GeGDPWQc4feVg0Q',NULL,NULL,NULL,NULL,NULL,'2021-06-29 14:50:31','2021-06-29 14:50:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vserver`
--

DROP TABLE IF EXISTS `vserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vserver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `virt_id` int(11) NOT NULL,
  `serv_ip` varchar(255) NOT NULL,
  `root_pw` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `state` enum('active','installing','suspended','deleted') NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `expire_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vserver`
--

LOCK TABLES `vserver` WRITE;
/*!40000 ALTER TABLE `vserver` DISABLE KEYS */;
INSERT INTO `vserver` VALUES (1,'Paket 01',1,1,'127.0.0.1','tester123','test.local','active',1000.00,'2021-07-10 16:37:14','2021-06-29 16:37:37','2021-06-29 17:00:21',NULL);
/*!40000 ALTER TABLE `vserver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vserver_os`
--

DROP TABLE IF EXISTS `vserver_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vserver_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `osid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vserver_os`
--

LOCK TABLES `vserver_os` WRITE;
/*!40000 ALTER TABLE `vserver_os` DISABLE KEYS */;
/*!40000 ALTER TABLE `vserver_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vserver_packs`
--

DROP TABLE IF EXISTS `vserver_packs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vserver_packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `cores` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `disc` varchar(255) NOT NULL,
  `laufzeit` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vserver_packs`
--

LOCK TABLES `vserver_packs` WRITE;
/*!40000 ALTER TABLE `vserver_packs` DISABLE KEYS */;
INSERT INTO `vserver_packs` VALUES (1,'Paket 1','Vienna (VIE)',1.00,'2','512','10',30,'2021-06-27 18:32:15','2021-06-27 18:38:49');
/*!40000 ALTER TABLE `vserver_packs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webspace`
--

DROP TABLE IF EXISTS `webspace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webspace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ftp_name` varchar(255) NOT NULL,
  `ftp_password` varchar(255) NOT NULL,
  `domainName` varchar(255) NOT NULL,
  `webspace_id` int(11) NOT NULL,
  `state` enum('active','suspended','deleted') NOT NULL,
  `expire_at` datetime NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webspace`
--

LOCK TABLES `webspace` WRITE;
/*!40000 ALTER TABLE `webspace` DISABLE KEYS */;
INSERT INTO `webspace` VALUES (1,'Starter',1,'dev','dev123','test.com',1,'active','2021-06-30 19:45:14',12.00,'2021-06-28 19:45:34','2021-06-28 19:45:34',NULL);
/*!40000 ALTER TABLE `webspace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webspace_host`
--

DROP TABLE IF EXISTS `webspace_host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webspace_host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domainName` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webspace_host`
--

LOCK TABLES `webspace_host` WRITE;
/*!40000 ALTER TABLE `webspace_host` DISABLE KEYS */;
INSERT INTO `webspace_host` VALUES (1,'MusterDomain.local','127.0.0.1','xxxxx','xxxxx','2021-06-28 18:18:44','2021-06-28 18:19:28');
/*!40000 ALTER TABLE `webspace_host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webspace_packs`
--

DROP TABLE IF EXISTS `webspace_packs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webspace_packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plesk_id` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `disc` varchar(255) NOT NULL,
  `domains` varchar(255) NOT NULL,
  `subdomains` varchar(255) NOT NULL,
  `databases` varchar(255) NOT NULL,
  `ftp_accounts` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webspace_packs`
--

LOCK TABLES `webspace_packs` WRITE;
/*!40000 ALTER TABLE `webspace_packs` DISABLE KEYS */;
INSERT INTO `webspace_packs` VALUES (1,'Starter',1.00,'5','1','5','5','10','10','2019-11-13 05:17:27','2021-01-28 11:46:09'),(5,'Medium',2.00,'10','5','10','10','10','15','2019-11-13 05:17:27','2021-01-18 21:27:34'),(6,'Premium',3.00,'15','15','20','20','20','20','2019-11-13 05:17:27','2021-01-18 21:27:37');
/*!40000 ALTER TABLE `webspace_packs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-03 10:32:21

