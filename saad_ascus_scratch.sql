-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: saad_ascus_scratch
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.13.10.2

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
-- Table structure for table `area_of_expertise`
--

DROP TABLE IF EXISTS `area_of_expertise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_of_expertise` (
  `expertise_id` int(11) NOT NULL AUTO_INCREMENT,
  `expertise` varchar(50) NOT NULL,
  PRIMARY KEY (`expertise_id`),
  UNIQUE KEY `expertise` (`expertise`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_of_expertise`
--

LOCK TABLES `area_of_expertise` WRITE;
/*!40000 ALTER TABLE `area_of_expertise` DISABLE KEYS */;
INSERT INTO `area_of_expertise` VALUES (5,'c++'),(3,'DOING THE RESTONS WRIGGLE'),(2,'DOING TRUNDOS MUM'),(1,'DOING YOUR MUM'),(122,'drawing'),(118,'java'),(123,'painting'),(120,'perl'),(121,'photography'),(8,'s'),(23,'saad'),(24,'sdasds'),(25,'sdsdsd'),(10,'ss'),(15,'ss ss'),(19,'ss sss'),(4,'ssdsdsd'),(16,'sss'),(37,'sssd'),(30,'test'),(33,'test`'),(7,'x');
/*!40000 ALTER TABLE `area_of_expertise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collaboration_types`
--

DROP TABLE IF EXISTS `collaboration_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collaboration_types` (
  `collaboration_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `collaboration_type` varchar(55) NOT NULL,
  PRIMARY KEY (`collaboration_type_id`),
  KEY `collaboration_type` (`collaboration_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaboration_types`
--

LOCK TABLES `collaboration_types` WRITE;
/*!40000 ALTER TABLE `collaboration_types` DISABLE KEYS */;
INSERT INTO `collaboration_types` VALUES (1,'No Collaboration'),(3,'Paid Work'),(2,'Volunteer Work');
/*!40000 ALTER TABLE `collaboration_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiences` (
  `experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL,
  `work_project_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`experience_id`),
  KEY `experience_ibfk_1` (`members_id`),
  CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (160,1,'Microsoft','https://www.microsoft.com/en-gb/default.aspx'),(161,1,'Greggs','https://www.greggs.co.uk/'),(163,2,'saadoo2','saadoo2 link');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interests` (
  `interest_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL,
  `interest` varchar(50) NOT NULL,
  PRIMARY KEY (`interest_id`),
  UNIQUE KEY `member_interest_unique` (`members_id`,`interest`),
  KEY `members_id_key` (`members_id`),
  KEY `interest_key` (`interest`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interests`
--

LOCK TABLES `interests` WRITE;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
INSERT INTO `interests` VALUES (1,1,'illusions'),(2,1,'renaissance art'),(6,2,'AI'),(7,2,'gentic algorithms'),(8,2,'illusions');
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_collaboration_types`
--

DROP TABLE IF EXISTS `member_collaboration_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_collaboration_types` (
  `member_collaboration_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `collaboration_type` varchar(55) NOT NULL,
  `members_id` varchar(55) NOT NULL,
  PRIMARY KEY (`member_collaboration_type_id`),
  KEY `collaboration_type` (`collaboration_type`),
  KEY `members_id` (`members_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_collaboration_types`
--

LOCK TABLES `member_collaboration_types` WRITE;
/*!40000 ALTER TABLE `member_collaboration_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_collaboration_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `members_id` int(11) NOT NULL AUTO_INCREMENT,
  `confirmation_key` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `profession` varchar(10) NOT NULL DEFAULT 'Artist',
  `bio` varchar(1000) DEFAULT NULL,
  `collaboration_amount` varchar(50) NOT NULL,
  `profile_pic` varchar(100) NOT NULL DEFAULT 'images/defaultprofile.png',
  PRIMARY KEY (`members_id`),
  UNIQUE KEY `key` (`confirmation_key`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `country` (`country`),
  KEY `city` (`city`),
  KEY `profession` (`profession`),
  KEY `collaboration_amount` (`collaboration_amount`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'N97SqS./eZu8sxT9n0Ta',1,'Edinburgh','Scotland','saadoo','$2y$10$VqoOVJnYPaZyHUu94mTDO.x110M5UW6xuVrgY1qpp/2jjG3DIxKJy','saadarif006@gmail.com','Saad 2','Artist','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer consectetur vel risus sed egestas. Praesent at lorem rhoncus, semper metus non, consequat felis. Maecenas ultrices tincidunt velit quis sollicitudin. Quisque feugiat suscipit turpis id molestie. In interdum risus lectus, a interdum massa lobortis eget. Etiam sed tortor imperdiet, facilisis orci et, laoreet tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque quis lobortis metus.','Weekends(8 Hours per Week)','worksamples/profile-pic/screenshot_2014-04-10-20-48-16.png'),(2,'N97SqS./eZu8sxT9n0Tb',1,'Edinburgh','Scotland','saadoo2','$2y$10$VqoOVJnYPaZyHUu94mTDO.x110M5UW6xuVrgY1qpp/2jjG3DIxKJy','saadarif007@gmail.com','Saad Arif','Scientist','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer consectetur vel risus sed egestas. Praesent at lorem rhoncus, semper metus non, consequat felis. Maecenas ultrices tincidunt velit quis sollicitudin. Quisque feugiat suscipit turpis id molestie. In interdum risus lectus, a interdum massa lobortis eget. Etiam sed tortor imperdiet, facilisis orci et, laoreet tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque quis lobortis metus.','Weekends(8 Hours per Week)','worksamples/profile-pic/screenshot_2014-04-10-20-48-16.png');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_area_of_expertise`
--

DROP TABLE IF EXISTS `members_area_of_expertise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_area_of_expertise` (
  `members_area_of_expertise_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL,
  `expertise_id` int(11) NOT NULL,
  PRIMARY KEY (`members_area_of_expertise_id`),
  UNIQUE KEY `members_id` (`members_id`,`expertise_id`),
  KEY `expertise_id` (`expertise_id`),
  CONSTRAINT `members_area_of_expertise_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `members_area_of_expertise_ibfk_2` FOREIGN KEY (`expertise_id`) REFERENCES `area_of_expertise` (`expertise_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_area_of_expertise`
--

LOCK TABLES `members_area_of_expertise` WRITE;
/*!40000 ALTER TABLE `members_area_of_expertise` DISABLE KEYS */;
INSERT INTO `members_area_of_expertise` VALUES (367,1,121),(368,1,122),(369,1,123),(373,2,5),(374,2,118),(375,2,120);
/*!40000 ALTER TABLE `members_area_of_expertise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_collaboration_types`
--

DROP TABLE IF EXISTS `members_collaboration_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_collaboration_types` (
  `members_collaboration_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `collaboration_type_id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  PRIMARY KEY (`members_collaboration_type_id`),
  UNIQUE KEY `members_collaboration_unique` (`members_id`,`collaboration_type_id`),
  KEY `members_collaboration_types_ibfk_2` (`collaboration_type_id`),
  CONSTRAINT `members_collaboration_types_ibfk_1` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `members_collaboration_types_ibfk_2` FOREIGN KEY (`collaboration_type_id`) REFERENCES `collaboration_types` (`collaboration_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_collaboration_types`
--

LOCK TABLES `members_collaboration_types` WRITE;
/*!40000 ALTER TABLE `members_collaboration_types` DISABLE KEYS */;
INSERT INTO `members_collaboration_types` VALUES (146,2,1);
/*!40000 ALTER TABLE `members_collaboration_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_samples`
--

DROP TABLE IF EXISTS `work_samples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_samples` (
  `work_samples_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`work_samples_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(255)),
  KEY `path` (`path`),
  KEY `work_samples_ibfk_1` (`members_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_samples`
--

LOCK TABLES `work_samples` WRITE;
/*!40000 ALTER TABLE `work_samples` DISABLE KEYS */;
INSERT INTO `work_samples` VALUES (3,1,'cat1.png','worksamples/cat1501460316533758830ca033.98621739.png','cat','cat'),(6,1,NULL,NULL,'lorem','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tristique arcu quis interdum ultricies. Donec sit amet porta diam. Nullam ullamcorper, orci eu tristique dictum, massa nisl volutpat metus, sit amet convallis dui erat a mi. Maecenas consectetur semper porttitor. In hac habitasse platea dictumst. Integer quis lorem sagittis, rhoncus justo quis, ultricies odio. Vivamus facilisis sapien libero, ut sodales est iaculis in. Duis sem massa, faucibus id massa at, accumsan luctus est cras amet.'),(7,1,NULL,NULL,'test','teasdasdasd asdas da adsds d');
/*!40000 ALTER TABLE `work_samples` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-14 18:49:37
