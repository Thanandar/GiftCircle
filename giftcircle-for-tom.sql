-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: giftcircle
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Baby '),(2,'Beauty '),(3,'Books '),(4,'Car & Motorbike '),(5,'Classical '),(6,'Clothing '),(7,'Computers & Accessories '),(8,'DIY & Tools '),(9,'Electronics & Photo '),(10,'Film & TV '),(11,'Garden & Outdoors '),(12,'Grocery '),(13,'Health & Beauty '),(14,'Jewellery '),(15,'Kitchen & Home '),(16,'Lighting '),(17,'MP3 Downloads '),(18,'Music '),(19,'Musical Instruments & DJ '),(20,'PC & Video Games '),(21,'Pet Supplies '),(22,'Shoes & Accessories '),(23,'Software '),(24,'Sports & Leisure '),(25,'Stationery & Office Supplies '),(26,'Toys & Games '),(27,'Watches');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_shops`
--

DROP TABLE IF EXISTS `categories_shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_shops`
--

LOCK TABLES `categories_shops` WRITE;
/*!40000 ALTER TABLE `categories_shops` DISABLE KEYS */;
INSERT INTO `categories_shops` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,1),(12,12,1),(13,13,1),(14,14,1),(15,15,1),(16,16,1),(17,17,1),(18,18,1),(19,19,1),(20,20,1),(21,21,1),(22,22,1),(23,23,1),(24,24,1),(25,25,1),(26,26,1),(27,27,1),(28,1,2),(29,2,2),(30,3,2),(31,4,2),(32,5,2),(33,6,2),(34,7,2),(35,8,2),(36,9,2),(37,10,2),(38,11,2),(39,12,2),(40,13,2),(41,14,2),(42,15,2),(43,16,2),(44,17,2),(45,18,2),(46,19,2),(47,20,2),(48,21,2),(49,22,2),(50,23,2),(51,24,2),(52,25,2),(53,26,2),(54,27,2),(55,6,3),(56,7,3),(57,8,3),(58,9,3),(59,11,3),(60,19,3),(61,25,3),(62,26,3),(63,27,3);
/*!40000 ALTER TABLE `categories_shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creator_id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (6,12,'matt@matt.com','Matt','M','','','0000-00-00 00:00:00'),(9,13,'tom.quay@basecreativeagency.com','Tom','Quay','','','0000-00-00 00:00:00'),(11,13,'tom.quay@basecreativeagency.com','Tom','Quay','','','0000-00-00 00:00:00'),(16,14,'dave.hulbert@basecreativeagency.com','Dave','Hulbert','','','0000-00-00 00:00:00'),(17,14,'kathryn@basecreativeagency.com','Kathryn','Tradewell','','','0000-00-00 00:00:00'),(18,14,'matt@basecreativeagency.com','Matthew','Morgan','','','0000-00-00 00:00:00'),(19,15,'tom@basecreativeagency.com','Tom','Quay','','','0000-00-00 00:00:00'),(20,14,'emma@basecreativeagency.com','Emma','Quay','','','0000-00-00 00:00:00'),(21,16,'tom@basecreativeagency.com','Tom','Quay','','','0000-00-00 00:00:00'),(22,16,'joe@basecreativeagency.com','Joe','Thwaites','','','0000-00-00 00:00:00'),(24,12,'dave1010@gmail.com','dave','h','','','0000-00-00 00:00:00'),(27,12,'dave1010@gmail.com','dave','h','','','0000-00-00 00:00:00'),(29,12,'t@basecreativeagency.com','Thomas','Quay','','','0000-00-00 00:00:00'),(30,12,'peter.evans@basecreativeagency.com','Peter','Evans (smells)','','','0000-00-00 00:00:00'),(32,12,'dave1010@gmail.com','Dave','H (!\"£$%^&*()_+-= \\/|<>,.;\'#[]{}:@~','','','0000-00-00 00:00:00'),(33,12,'peter@basecreativeagency.com','Peter','Evans (!\"£$%^&*()_+-= \\/|<>,.;\'#[]{}:@~','','','0000-00-00 00:00:00'),(37,10,'matt.morgan@basecreativeagency.com','Matt','Morgan','','','0000-00-00 00:00:00'),(38,10,'dave.hulbert@basecreativeagency.com','Dave','Hulbert','','','0000-00-00 00:00:00'),(39,12,'tom.quay@basecreativeagency.com','Tom','Quay','','','0000-00-00 00:00:00'),(40,14,'petermanlay@gmail.com','Pete','Manlay','','','0000-00-00 00:00:00'),(41,14,'tom+davesright@basecreativeagency.com','Gift ','Circle Test','','','0000-00-00 00:00:00'),(42,14,'mattsright+tom@basecreativeagency.com','ANohter ','Test','','','0000-00-00 00:00:00'),(46,12,'tom@basecreativeagency.com','Thomas','Quay','','','2011-10-12 15:58:30'),(47,21,'kathryn.tradewell@basecreativeagency.com','Kathryn','Tradewell','','','2011-10-13 15:16:06'),(48,20,'adam.burt@basecreativeagency.com','Adam','Burt','','','2011-10-13 15:16:18'),(49,20,'tom.quay@basecreativeagency.com','Tom','Quay','','','2011-10-13 15:19:25'),(50,20,'matt.morgan@basecreativeagency.com','Matt','Morgan','','','2011-10-13 15:19:25'),(51,20,'dave.hulbert@basecreativeagency.com','Dave','Hulbert','','','2011-10-13 15:19:26'),(52,12,'kathryn.tradewell@basecreativeagency.com','Kathryn','Tradewell','','','2011-10-13 15:24:45'),(56,22,'kathryn.tradewell@basecreativeagency.com','Kathryn','Tradewell','','','2011-10-14 14:58:37'),(57,20,'kathryntradewell@gmail.com','Kat','Cooper','','','2011-10-14 14:58:51');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends_lists`
--

DROP TABLE IF EXISTS `friends_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `friend_id` int(10) NOT NULL,
  `list_id` int(10) NOT NULL,
  `subscribed` int(1) DEFAULT '1',
  `last_notification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends_lists`
--

LOCK TABLES `friends_lists` WRITE;
/*!40000 ALTER TABLE `friends_lists` DISABLE KEYS */;
INSERT INTO `friends_lists` VALUES (3,6,3,1,'2011-10-14 15:33:46'),(4,2,2,1,'0000-00-00 00:00:00'),(5,3,2,1,'0000-00-00 00:00:00'),(6,7,7,1,'0000-00-00 00:00:00'),(8,9,8,1,'0000-00-00 00:00:00'),(9,10,8,1,'0000-00-00 00:00:00'),(10,11,8,1,'0000-00-00 00:00:00'),(11,12,8,1,'0000-00-00 00:00:00'),(13,4,9,1,'0000-00-00 00:00:00'),(25,3,12,1,'0000-00-00 00:00:00'),(26,16,13,1,'0000-00-00 00:00:00'),(27,17,13,1,'0000-00-00 00:00:00'),(28,18,13,1,'0000-00-00 00:00:00'),(29,19,14,0,'0000-00-00 00:00:00'),(30,3,16,1,'0000-00-00 00:00:00'),(31,6,16,1,'2011-10-14 15:33:46'),(32,15,16,1,'0000-00-00 00:00:00'),(34,14,3,1,'0000-00-00 00:00:00'),(35,17,18,1,'0000-00-00 00:00:00'),(36,18,18,1,'0000-00-00 00:00:00'),(37,20,18,1,'0000-00-00 00:00:00'),(38,21,19,1,'0000-00-00 00:00:00'),(39,22,19,1,'0000-00-00 00:00:00'),(40,23,3,1,'0000-00-00 00:00:00'),(44,27,17,1,'0000-00-00 00:00:00'),(46,29,16,1,'2011-10-14 15:33:46'),(47,30,16,1,'2011-10-14 15:33:46'),(53,37,7,0,'0000-00-00 00:00:00'),(54,38,7,1,'0000-00-00 00:00:00'),(55,16,22,1,'0000-00-00 00:00:00'),(56,17,22,0,'0000-00-00 00:00:00'),(58,20,22,0,'0000-00-00 00:00:00'),(59,40,22,0,'0000-00-00 00:00:00'),(60,18,22,0,'0000-00-00 00:00:00'),(63,42,22,0,'0000-00-00 00:00:00'),(64,47,23,1,'0000-00-00 00:00:00'),(65,48,24,0,'0000-00-00 00:00:00'),(66,49,24,0,'0000-00-00 00:00:00'),(67,50,24,0,'0000-00-00 00:00:00'),(68,51,24,1,'0000-00-00 00:00:00'),(69,48,25,1,'2011-10-14 15:36:52'),(70,49,25,0,'0000-00-00 00:00:00'),(71,50,25,0,'0000-00-00 00:00:00'),(72,51,25,1,'2011-10-14 15:36:52'),(74,24,16,1,'2011-10-14 15:33:46'),(75,27,16,1,'2011-10-14 15:33:46'),(76,32,16,1,'2011-10-14 15:33:46'),(80,52,16,1,'2011-10-14 15:05:50'),(81,52,3,1,'2011-10-14 15:33:46'),(82,51,27,1,'0000-00-00 00:00:00'),(83,56,26,1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `friends_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gifts`
--

DROP TABLE IF EXISTS `gifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gifts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `details` text NOT NULL,
  `reserver_id` int(10) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gifts`
--

LOCK TABLES `gifts` WRITE;
/*!40000 ALTER TABLE `gifts` DISABLE KEYS */;
INSERT INTO `gifts` VALUES (1,3,'cheese','1000','','',10,10,12,'0000-00-00 00:00:00'),(7,3,'Buzz Lightyear','99','','not Buzz Aldrin',10,0,26,'0000-00-00 00:00:00'),(9,7,'HTC Wildfire S','200','http://phone-shop.tesco.com/mobile-phones-and-sim-cards/pay-monthly-phones/double-clubcard-points-htc-wildfire-s.aspx?bnr=hphtcwildfires_wk29','',12,0,9,'2011-10-11 15:10:11'),(10,8,'HTC Case','7.99','http://direct.tesco.com/q/R.211-3248.aspx','',12,0,3,'0000-00-00 00:00:00'),(13,7,'html book','5','','',12,12,3,'2011-10-12 15:40:16'),(14,7,'php book','10','','',0,0,3,'0000-00-00 00:00:00'),(17,3,'Particle accelerator','1000000000','http://www.cern.ch','Required for some tests',20,0,8,'2011-10-14 14:20:44'),(18,13,'Book','10','','big book',15,0,3,'0000-00-00 00:00:00'),(19,16,'Multi-tool pen','11','http://www.firebox.com/product/660/12-in-1-Multi-Tool-Pen','',10,0,25,'2011-10-12 16:03:00'),(20,13,'DVD','10','','',12,12,10,'2011-10-12 15:50:34'),(21,13,'Black Coat','75','','',0,0,6,'0000-00-00 00:00:00'),(22,13,'Playstation Vita','280','http://www.amazon.co.uk/Sony-PlayStation-Vita-Wi-Fi-3G/dp/B004ISLDVA/ref=amb_link_160481147_2?pf_rd_m=A3P5ROKL5A1OLE&pf_rd_s=right-4&pf_rd_r=1RJJMX1F43QM18WXNA9P&pf_rd_t=101&pf_rd_p=247090527&pf_rd_i=468294','',0,0,7,'0000-00-00 00:00:00'),(23,18,'Slide for the garden','20','','Needs to be a baby one (not too steep!)',0,0,11,'0000-00-00 00:00:00'),(24,19,'Drum kit','800','','Premier',17,0,19,'0000-00-00 00:00:00'),(25,19,'Mr Happy Bottle Opener','6','http://www.gizoo.co.uk/Products/HomeGarden/Kitchen/MrHappyBottleOpener.htm','',17,0,15,'0000-00-00 00:00:00'),(26,16,'Google','1','http://www.google.com','',14,14,9,'0000-00-00 00:00:00'),(28,22,'Holiday','100','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.attractiontix.co.uk%2Fport-aventura.aspx%3FPromo%3Dbestseller-PortAventura%2520Pass%25204%2520Days','',12,12,24,'2011-10-12 15:42:36'),(29,14,'Tweed jacket','','','',0,0,0,'0000-00-00 00:00:00'),(30,14,'Tweed trousers','','','',14,14,0,'0000-00-00 00:00:00'),(31,16,'Coffee','3','','',20,20,21,'2011-10-14 14:20:15'),(32,24,'Winter-Scented Ceramic Stars','20.00','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.thewhitecompany.com%2Fcandles-and-scents%2Fnew-arrivals%2Fwinterscented-ceramic-stars%2F','',21,21,15,'2011-10-13 16:25:12'),(33,24,'Winter-Scented Heart Wreath','25.00','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.thewhitecompany.com%2Fcandles-and-scents%2Fnew-arrivals%2Fwinterscented-heart-wreath%2F','',21,0,15,'2011-10-13 16:25:56'),(34,24,'Bootham Socks','14.50','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.jackwills.com%2Fen-gb%2Fproduct%2Fbootham-socks-011056110','',12,0,6,'2011-10-14 15:05:03'),(36,24,'Star - Stitched Paper Garland','300.00','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.notonthehighstreet.com%2Fmeninafeliz%2Fproduct%2Fstar-stitched-paper-garland','',0,0,15,'2011-10-18 14:28:55'),(37,25,'Painted Edge Double Belt','38.00','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.notonthehighstreet.com%2Flowie%2Fproduct%2Fpainted-edge-double-belt','',0,0,6,'2011-10-13 16:06:58'),(38,25,'Personalised Ransom Note Mug','14.50','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.notonthehighstreet.com%2Ftheletteroom%2Fproduct%2Fpersonalised-ransom-note-mug','',0,0,15,'2011-10-14 14:35:25'),(39,25,'Cardboard Wendy House','48.00','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.notonthehighstreet.com%2Fgreenrabbit%2Fproduct%2Fcardboard_wendy_house','',0,0,26,'2011-10-14 12:41:44'),(40,26,'Wooden Cooker and Cook Set','77.50','http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=http%3A%2F%2Fwww.notonthehighstreet.com%2Fberryred%2Fproduct%2Fwooden_cooker_and_cook_set','',0,0,26,'2011-10-14 14:44:01');
/*!40000 ALTER TABLE `gifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expiry` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_notification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (3,12,'Anniversary','','2011-10-14 14:33:46','2011-10-14 15:33:47'),(6,0,'christmas2','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(7,10,'Xmas','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(8,13,'Xmas 2011','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(13,14,'Christmas List','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(14,15,'My Christmas list','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(15,15,'30th Birthdat','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(16,12,'Birthday','','2011-10-14 14:33:46','2011-10-14 15:33:47'),(17,12,'30th birthday','9/10/2016','2011-10-14 10:55:03','2011-10-14 11:55:04'),(18,14,'Mally\'s Birthday','01/07/11','2011-10-14 10:55:03','2011-10-14 11:55:04'),(19,16,'Pete\'s Christmas List','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(20,19,'Christmas','25/12/2011','2011-10-14 10:55:03','2011-10-14 11:55:04'),(21,10,'Secret list with no friends on','','2011-10-14 10:55:03','2011-10-14 11:55:04'),(22,14,'Easter list','30/04/12','2011-10-14 10:55:03','2011-10-14 11:55:04'),(23,21,'My Birthday','01.04.2011','2011-10-14 10:55:03','2011-10-14 11:55:04'),(24,20,'Christmas Time','25/12/2011','2011-10-18 14:28:55','2011-10-14 11:55:04'),(25,20,'Its my Birthday and I\'ll buy if I want to!','30.08.2011','2011-10-14 14:36:52','2011-10-14 15:36:53'),(26,22,'Christmas Eve','24','2011-10-14 14:58:37','2011-10-14 15:03:55'),(27,20,'Easter','','2011-10-14 14:33:46','2011-10-14 15:33:47');
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listtransactions`
--

DROP TABLE IF EXISTS `listtransactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listtransactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listtransactions`
--

LOCK TABLES `listtransactions` WRITE;
/*!40000 ALTER TABLE `listtransactions` DISABLE KEYS */;
INSERT INTO `listtransactions` VALUES (1,16,'Updated a gift.','2011-10-13 16:27:31'),(2,16,'Updated a gift: Test','2011-10-13 16:29:16'),(3,16,'Updated a gift: Test3','2011-10-14 08:27:47'),(4,16,'Updated a gift: Test4','2011-10-14 10:26:05'),(5,3,'Updated a gift: Particle accelerator','2011-10-14 10:58:43'),(6,3,'Updated a gift: Particle accelerator','2011-10-14 11:02:26'),(7,16,'Updated a gift: Test','2011-10-14 11:17:38'),(8,25,'Added a gift: Cardboard Wendy House','2011-10-14 12:41:44'),(9,16,'Updated a gift: Coffee','2011-10-14 13:17:03'),(10,16,'Updated a gift: Coffee','2011-10-14 13:29:02'),(11,16,'Updated a gift: Coffee','2011-10-14 13:31:17'),(12,16,'Updated a gift: Coffee','2011-10-14 13:31:23'),(13,16,'Updated a gift: Coffee','2011-10-14 13:31:33'),(14,16,'Updated a gift: Coffee','2011-10-14 14:20:15'),(15,3,'Updated a gift: Particle accelerator','2011-10-14 14:20:44'),(16,25,'Updated a gift: Personalised Ransom Note Mug','2011-10-14 14:35:25'),(17,26,'Added a gift: Wooden Cooker and Cook Set','2011-10-14 14:44:01'),(18,24,'Updated a gift: Bootham Socks','2011-10-14 15:05:03'),(19,24,'Updated a gift: Star - Stitched Paper Garland','2011-10-18 14:28:55');
/*!40000 ALTER TABLE `listtransactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'login','Login privileges, granted after account confirmation'),(2,'admin','Administrative user, has access to everything.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_users`
--

LOCK TABLES `roles_users` WRITE;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
INSERT INTO `roles_users` VALUES (1,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(1,2),(11,2);
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (1,'Amazon','http://www.amazon.co.uk/','/static/merchants/amazon.png'),(2,'EBay','http://www.ebay.co.uk','/static/merchants/ebay.gif'),(3,'Firebox','http://www.firebox.co.uk','/static/merchants/firebox.gif');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_identities`
--

DROP TABLE IF EXISTS `user_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_identities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `provider` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_indentity` (`provider`,`identity`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `user_identities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_identities`
--

LOCK TABLES `user_identities` WRITE;
/*!40000 ALTER TABLE `user_identities` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_identities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_identity`
--

DROP TABLE IF EXISTS `user_identity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_identity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_identity`
--

LOCK TABLES `user_identity` WRITE;
/*!40000 ALTER TABLE `user_identity` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_identity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tokens`
--

LOCK TABLES `user_tokens` WRITE;
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` char(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `reset_token` char(64) NOT NULL DEFAULT '',
  `status` varchar(20) NOT NULL DEFAULT '',
  `last_failed_login` datetime NOT NULL,
  `failed_login_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`),
  UNIQUE KEY `uniq_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test@test.com','admin','368ae03c1b3b29b8d242bc43dcbe3f0bd4755ea181adbd22ef',8,1317140044,'','','2011-09-27 17:11:41',3,'0000-00-00 00:00:00','2011-09-27 17:14:04',NULL,NULL),(9,'bob@bob.com','bob@bob.com','04699d127d16dbc71f898d7febca6dbaf0c62c8728c46435fcc00d351214eb6a',2,1317213327,'','','0000-00-00 00:00:00',0,'2011-09-28 13:12:48','2011-09-28 13:35:27',NULL,NULL),(10,'tom.quay@basecreativeagency.com','tom.quay@basecreativeagency.com','04699d127d16dbc71f898d7febca6dbaf0c62c8728c46435fcc00d351214eb6a',20,1318952586,'','','2011-09-30 15:37:51',0,'2011-09-28 13:45:10','2011-10-18 16:43:06','Tom','Quay'),(11,'new@new.com','new','04699d127d16dbc71f898d7febca6dbaf0c62c8728c46435fcc00d351214eb6a',1,1317214830,'','','0000-00-00 00:00:00',0,'2011-09-28 13:59:51','2011-09-28 14:23:54','Mr','New'),(12,'dave.hulbert@basecreativeagency.com','dave.hulbert@basecreativeagency.com','04699d127d16dbc71f898d7febca6dbaf0c62c8728c46435fcc00d351214eb6a',57,1318952197,'','','0000-00-00 00:00:00',0,'2011-09-28 14:49:15','2011-10-18 16:36:37','Dave','Hulbert'),(13,'matt.morgan@basecreativeagency.com','matt.morgan@basecreativeagency.com','16d38bb81b7c5ae19d7c8293ddba978cfeb9f2418c9f59724df816a660a1d035',1,1317311563,'bv1c6rk4y124kxny8y4342h6r95ce793','','2011-10-13 16:20:19',7,'2011-09-29 16:52:43','2011-10-13 16:22:00','Matthew','Morgan'),(14,'tom@basecreativeagency.com','tom@basecreativeagency.com','285911bab3a5ab75f983453264a1f669e5d49a499f1c3a983f14eb2879854234',7,1318250851,'','','0000-00-00 00:00:00',0,'2011-09-30 15:31:36','2011-10-10 13:47:31','Thomas','Quay'),(15,'matt@basecreativeagency.com','matt@basecreativeagency.com','285911bab3a5ab75f983453264a1f669e5d49a499f1c3a983f14eb2879854234',9,1318519210,'','','0000-00-00 00:00:00',0,'2011-09-30 15:35:33','2011-10-13 16:20:10','Matt','Morgan'),(16,'petermanlay@gmail.com','petermanlay@gmail.com','9a496a71bbb2de0aed6338e4dd3e594f8c0ff6623df0e18fef7644fa7ecc6bd7',1,1317724117,'','','0000-00-00 00:00:00',0,'2011-10-04 11:28:37','2011-10-04 11:28:37','Pete','Manlay'),(17,'joe@basecreativeagency.com','joe@basecreativeagency.com','285911bab3a5ab75f983453264a1f669e5d49a499f1c3a983f14eb2879854234',1,1317725044,'','','0000-00-00 00:00:00',0,'2011-10-04 11:44:04','2011-10-04 11:44:04','Joe','Thwaites'),(18,'t@basecreativeagency.com','t@basecreativeagency.com','285911bab3a5ab75f983453264a1f669e5d49a499f1c3a983f14eb2879854234',1,1317740916,'','','0000-00-00 00:00:00',0,'2011-10-04 16:08:36','2011-10-04 16:08:36','Thomas','Quay'),(19,'peter.evan1s@basecreativeagency.com','peter.evan1s@basecreativeagency.com','285911bab3a5ab75f983453264a1f669e5d49a499f1c3a983f14eb2879854234',3,1318327828,'','','0000-00-00 00:00:00',0,'2011-10-04 16:10:30','2011-10-11 11:10:28','Peter','Evans (smells)'),(20,'kathryn.tradewell@basecreativeagency.com','kathryn.tradewell@basecreativeagency.com','7e931a12134559fc39144975e6804753f7185313f94704f7383d72b242b7a09c',21,1318949641,'v3765d7vqw86ufduzgp58v32gk7uuya5','','0000-00-00 00:00:00',0,'2011-10-13 15:20:00','2011-10-18 15:54:01','Kathryn','Tradewell'),(21,'adam.burt@basecreativeagency.com','adam.burt@basecreativeagency.com','b0e7da4a4637358978439380bcdbfe01b2528d1f4321d7a79b499b53a279aff0',2,1318520758,'','','0000-00-00 00:00:00',0,'2011-10-13 16:09:33','2011-10-13 16:45:58','Adam','Burt'),(22,'kathryntradewell@gmail.com','kathryntradewell@gmail.com','7e931a12134559fc39144975e6804753f7185313f94704f7383d72b242b7a09c',4,1318603358,'','','2011-10-14 15:42:31',0,'2011-10-14 14:55:54','2011-10-14 15:42:38','Kat','Cooper');
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

-- Dump completed on 2011-10-19 10:02:23
