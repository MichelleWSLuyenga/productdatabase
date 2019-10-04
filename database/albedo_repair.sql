CREATE DATABASE  IF NOT EXISTS `albedo_repair` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `albedo_repair`;
-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: albedo_repair
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `tel` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'สุดารัตน์','0845678901'),(2,'ชมัยพร','0801234567'),(3,'อภิพร','0823456789'),(4,'สมเกียรติ','0834567890'),(10,'test','0784512369'),(11,'new','0741258963'),(12,'reef','0933205654'),(13,'smooth','0897898979'),(14,'data','010101010101'),(15,'asd','012525852'),(16,'eww','025252525'),(17,'yahoo','0521642587'),(18,'last','0258697452'),(19,'uiop','0987879798'),(20,'quest','0182345678'),(21,'กนก','091282318');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `role` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`emp_id`),
  KEY `role` (`role`),
  CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'lee','','',1,1),(2,'reef','reefjaa','reefna',1,1),(3,'somebody','abc','cba',1,1),(4,'old man','old','old',2,0);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pro_number`
--

DROP TABLE IF EXISTS `pro_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pro_number` (
  `pro_num` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `repair_num` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `cost` int(11) NOT NULL,
  `money_received_date` date DEFAULT NULL,
  PRIMARY KEY (`pro_num`),
  KEY `repair_num_idx` (`repair_num`),
  CONSTRAINT `repair_num` FOREIGN KEY (`repair_num`) REFERENCES `repair_item` (`repair_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pro_number`
--

LOCK TABLES `pro_number` WRITE;
/*!40000 ALTER TABLE `pro_number` DISABLE KEYS */;
INSERT INTO `pro_number` VALUES ('PR18/002','18/016',450,NULL),('PR18/003','18/019',200,NULL),('PR18/004','18/020',250,NULL),('PR18/005','18/021',100,NULL),('PR18/006','18/022',800,NULL),('PR18/007','18/023',200,NULL),('PR18/008','18/024',750,NULL),('PR18/010','18/026',990,NULL),('PR18/012','18/028',1000,NULL),('PR18/013','18/029',290,NULL),('PR18/014','18/030',1100,NULL),('PR18/016','18/032',1200,NULL),('PR18/018','18/034',1300,NULL),('PR18/020','18/036',1500,NULL),('PR18/022','18/038',100,NULL),('PR18/024','18/040',250,NULL),('PR18/026','18/042',10,NULL),('PR18/028','18/044',400,NULL),('PR18/030','18/046',190,NULL),('PR18/031','18/047',850,NULL),('PR18/033','18/002',200,NULL),('PR18/034','18/003',800,NULL),('PR18/035','18/011',120,NULL),('PR18/036','18/001',112,'2018-09-01'),('PR18/037','18/059',111,NULL),('PR18/038','18/004',200,NULL);
/*!40000 ALTER TABLE `pro_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `item` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `detail` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(4) CHARACTER SET utf8mb4 DEFAULT NULL,
  `collection` varchar(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('ABAC00100','AC-001 KEY RING (KL-16)',490,'A','AC'),('ABAC00200','AC-002 KEY RING (543)',590,NULL,NULL),('ABAC00255','AC-002 KEY RING',590,NULL,NULL),('ABAC00271','AC-002 KEY RING',590,NULL,NULL),('ABAC00276','AC-0002 KEY RING',590,'XL','NA'),('ABAC00299','AC-002 KEY RING',590,NULL,'EA'),('delete101','test product',123123,NULL,'NO'),('item010','test',11,'A',NULL),('test001111','product test',234,'A',NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_item`
--

DROP TABLE IF EXISTS `repair_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_item` (
  `repair_num` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `form_num` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `prod_code` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `repair_detail` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `warranty_type` int(11) NOT NULL,
  `purchased_date` date DEFAULT NULL,
  `repair_location` int(11) DEFAULT NULL,
  `send_factory_date` date DEFAULT NULL,
  `received_from_factory` date DEFAULT NULL,
  `return_dept_date` date DEFAULT NULL,
  `send_method` varchar(15) CHARACTER SET utf8mb4 DEFAULT NULL,
  `person_sent` int(11) DEFAULT NULL,
  `note` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`repair_num`),
  KEY `product_idx` (`prod_code`),
  KEY `location_idx` (`repair_location`),
  KEY `sentperson_idx` (`person_sent`),
  KEY `formnumber_idx` (`form_num`),
  KEY `warranty` (`warranty_type`),
  CONSTRAINT `formnumber` FOREIGN KEY (`form_num`) REFERENCES `repair_order` (`form_num`) ON UPDATE CASCADE,
  CONSTRAINT `location` FOREIGN KEY (`repair_location`) REFERENCES `repair_location` (`location_id`),
  CONSTRAINT `personsent` FOREIGN KEY (`person_sent`) REFERENCES `employee` (`emp_id`),
  CONSTRAINT `product` FOREIGN KEY (`prod_code`) REFERENCES `product` (`item`),
  CONSTRAINT `warranty` FOREIGN KEY (`warranty_type`) REFERENCES `warranty` (`warranty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_item`
--

LOCK TABLES `repair_item` WRITE;
/*!40000 ALTER TABLE `repair_item` DISABLE KEYS */;
INSERT INTO `repair_item` VALUES ('18/001','789/027','item010','torn',3,'2018-02-02',4,'2018-09-05','2018-09-06','2018-11-07','PLAN',2,'test'),('18/002','789/026','ABAC00255','test1',6,'2018-09-11',1,NULL,NULL,NULL,'PLAN',1,NULL),('18/003','321/321','ABAC00100','test1',3,'2018-09-19',1,NULL,NULL,NULL,NULL,NULL,NULL),('18/004','789/027','ABAC00271','test1',2,'2018-09-18',1,NULL,NULL,NULL,NULL,NULL,NULL),('18/005','321/321','ABAC00200','test1',1,'2018-09-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/006','789/027','ABAC00200','reef',1,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/007','789/027','ABAC00276','reef',1,'2018-09-16',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/008','121/122','ABAC00100','ลอก',1,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/009','789/026','ABAC00100','ลอก',3,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/010','789/026','ABAC00271','ขาด',2,'2018-09-03',1,'2018-09-13','2018-09-14','2018-09-15','PLAN',1,'test'),('18/011','789/001','ABAC00255','ลอก',2,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/012','100/101','ABAC00271','ลอก',2,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/013','100/002','ABAC00271','ลอก',2,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/014','100/003','ABAC00276','test',2,'2018-09-02',1,'2018-09-03','2018-09-05','2018-09-07','PLAN',1,'test'),('18/015','100/004','ABAC00255','ลอก',3,'2018-09-12',2,NULL,NULL,NULL,NULL,1,NULL),('18/016','100/005','ABAC00255','ลอก',3,'2018-09-09',2,'2018-09-02','2018-09-12','2018-09-13','PLAN',1,'test'),('18/017','100/006','ABAC00271','ลอก',2,'2018-09-02',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/018','100/007','ABAC00100','ลอก',2,'2018-09-18',2,'2018-09-02','2018-09-03','2018-09-04','PLAN',1,'test'),('18/019','100/008','ABAC00200','ลอก',2,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/020','100/009','ABAC00271','ลอก',2,'2018-09-17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/021','789/002','ABAC00276','ลอก',2,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/022','789/002','ABAC00276','ขาด',3,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/023','789/003','ABAC00276','ลอก',2,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/024','789/003','ABAC00200','ขาด',3,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/025','789/004','ABAC00271','ลอก',1,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/026','789/004','ABAC00271','test2',3,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/027','789/005','ABAC00271','ลอก',1,'2018-09-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/028','789/005','ABAC00255','ขาด',3,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/029','789/006','ABAC00100','test1',2,'2018-09-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/030','789/006','ABAC00271','test2',3,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/031','789/007','ABAC00200','ลอก',1,'2018-09-13',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/032','789/007','ABAC00255','ขาด',3,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/033','789/008','ABAC00255','ลอก',1,'2018-09-17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/034','789/008','ABAC00255','ขาด',3,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/035','789/009','ABAC00271','test1',1,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/036','789/009','ABAC00276','test2',3,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/037','789/010','ABAC00200','ลอก',1,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/038','789/010','ABAC00200','ขาด',3,'2018-09-20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/039','789/011','ABAC00200','test',1,'2018-09-13',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/040','789/011','ABAC00271','ขาด',3,'2018-09-20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/041','789/012','ABAC00271','ลอก',1,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/042','789/012','ABAC00255','ขาด',3,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/043','789/013','ABAC00255','ลอก',1,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/044','789/013','ABAC00271','ขาด',3,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/045','789/014','ABAC00200','ลอก',1,'2018-09-18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/046','789/014','ABAC00255','ขาด',3,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/047','789/015','ABAC00271','ลอก',3,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/048','789/015','ABAC00255','ขาด',1,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/049','789/016','ABAC00255','test',1,'2018-09-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/050','789/017','ABAC00271','test1',1,'2018-09-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/051','789/018','ABAC00200','ลอก',1,'2018-09-17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/052','789/019','ABAC00276','ลอก',1,'2018-09-23',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/053','789/020','ABAC00271','test1',1,'2018-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/054','789/021','ABAC00276','ลอก',1,'2018-09-17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/055','789/022','ABAC00271','ลอก',1,'2018-09-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/056','789/023','ABAC00271','ลอก',1,'2018-09-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/057','789/024','ABAC00299','test1',1,'2018-09-17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/058','144/144','ABAC00200','ลอก',1,'2018-08-15',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('18/059','444/123','ABAC00271','reef',3,'2018-09-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `repair_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_location`
--

DROP TABLE IF EXISTS `repair_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `address` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_location`
--

LOCK TABLES `repair_location` WRITE;
/*!40000 ALTER TABLE `repair_location` DISABLE KEYS */;
INSERT INTO `repair_location` VALUES (1,'complain','test'),(2,'พี่พงษ์','somewhere in the world'),(3,'Yossapol','7 Ratpatthana Road. Sapansoon BKK, 10240, Tha'),(4,'reef','krub'),(6,'pluto','universe'),(7,'database','2204, building 2, level 2, room number 04'),(8,'database2',NULL);
/*!40000 ALTER TABLE `repair_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_order`
--

DROP TABLE IF EXISTS `repair_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_order` (
  `form_num` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `dept_store` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `received_from_cust` date NOT NULL,
  `arrived_at_comp` date DEFAULT NULL,
  PRIMARY KEY (`form_num`),
  KEY `deptstore_idx` (`dept_store`),
  KEY `customer_idx` (`cust_id`),
  CONSTRAINT `customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  CONSTRAINT `departmentstore` FOREIGN KEY (`dept_store`) REFERENCES `store` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_order`
--

LOCK TABLES `repair_order` WRITE;
/*!40000 ALTER TABLE `repair_order` DISABLE KEYS */;
INSERT INTO `repair_order` VALUES ('100/002',1,13,'2018-09-02',NULL),('100/003',1,14,'2018-09-19','2018-09-01'),('100/004',1,10,'2018-09-26','2018-09-04'),('100/005',1,15,'2018-09-12','2018-09-01'),('100/006',1,16,'2018-09-10',NULL),('100/007',1,2,'2018-09-18','2018-09-01'),('100/008',1,4,'2018-09-18',NULL),('100/009',1,1,'2018-09-12',NULL),('100/101',1,14,'2018-09-18',NULL),('121/122',1,4,'2018-09-24',NULL),('123/123',1,4,'2018-12-31',NULL),('144/144',5,2,'2018-09-01',NULL),('321/321',1,10,'2018-09-12',NULL),('444/123',4,21,'2018-09-01',NULL),('789/001',1,12,'2018-09-18',NULL),('789/002',1,14,'2018-09-05',NULL),('789/003',1,17,'2018-09-12',NULL),('789/004',1,12,'2018-09-12',NULL),('789/005',1,11,'2018-09-19',NULL),('789/006',1,14,'2018-09-19',NULL),('789/007',1,3,'2018-09-20',NULL),('789/008',1,4,'2018-09-19',NULL),('789/009',1,12,'2018-09-19',NULL),('789/010',1,3,'2018-09-20',NULL),('789/011',1,10,'2018-09-05',NULL),('789/012',1,10,'2018-09-12',NULL),('789/013',1,2,'2018-09-12',NULL),('789/014',1,15,'2018-09-10',NULL),('789/015',1,18,'2018-09-17',NULL),('789/016',1,16,'2018-09-28',NULL),('789/017',1,10,'2018-09-12',NULL),('789/018',1,4,'2018-09-02',NULL),('789/019',1,14,'2018-09-04',NULL),('789/020',1,2,'2018-09-18',NULL),('789/021',1,4,'2018-09-18',NULL),('789/022',1,2,'2018-09-13',NULL),('789/023',1,2,'2018-09-11',NULL),('789/024',1,2,'2018-09-19',NULL),('789/025',1,12,'2018-09-20',NULL),('789/026',1,1,'2018-09-24','2018-09-12'),('789/027',5,2,'2018-09-01','2018-09-02');
/*!40000 ALTER TABLE `repair_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `add_repair_order` tinyint(4) NOT NULL DEFAULT '0',
  `update_repair_order` tinyint(4) NOT NULL DEFAULT '0',
  `edit_repair_order` tinyint(4) NOT NULL DEFAULT '0',
  `delete_repair_order` tinyint(4) NOT NULL DEFAULT '0',
  `add_product` tinyint(4) NOT NULL DEFAULT '0',
  `edit_product` tinyint(4) NOT NULL DEFAULT '0',
  `delete_product` tinyint(4) NOT NULL DEFAULT '0',
  `add_store` tinyint(4) NOT NULL DEFAULT '0',
  `edit_store` tinyint(4) NOT NULL DEFAULT '0',
  `delete_store` tinyint(4) NOT NULL DEFAULT '0',
  `add_repair_location` tinyint(4) NOT NULL DEFAULT '0',
  `edit_repair_location` tinyint(4) NOT NULL DEFAULT '0',
  `delete_repair_location` tinyint(4) NOT NULL DEFAULT '0',
  `add_warranty` tinyint(4) NOT NULL DEFAULT '0',
  `edit_warranty` tinyint(4) NOT NULL DEFAULT '0',
  `delete_warranty` tinyint(4) NOT NULL DEFAULT '0',
  `add_customer` tinyint(4) NOT NULL DEFAULT '0',
  `edit_customer` tinyint(4) NOT NULL DEFAULT '0',
  `delete_customer` tinyint(4) NOT NULL DEFAULT '0',
  `add_employee` tinyint(4) NOT NULL DEFAULT '0',
  `edit_employee` tinyint(4) NOT NULL DEFAULT '0',
  `delete_employee` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(2,'tester',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_tracking`
--

DROP TABLE IF EXISTS `status_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_tracking` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_word_display` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_tracking`
--

LOCK TABLES `status_tracking` WRITE;
/*!40000 ALTER TABLE `status_tracking` DISABLE KEYS */;
INSERT INTO `status_tracking` VALUES (1,'received from customer','รับสินค้าซ่อมจากลูกค้า'),(2,'arrived at company','สินค้าถึงสำนักงานใหญ่'),(3,'send to factory','สินค้าอยู่ระหว่างการซ่อม'),(4,'received from factory','สินค้าซ่อมเสร็จแล้ว รอส่งกลับร้านค้า'),(5,'return to dept store','สินค้าพร้อมรับ ที่ร้าน');
/*!40000 ALTER TABLE `status_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'RO บางนา'),(3,'change'),(4,'new store'),(5,'Yossapol'),(6,'robinson'),(7,'live');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warranty`
--

DROP TABLE IF EXISTS `warranty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warranty` (
  `warranty_id` int(11) NOT NULL AUTO_INCREMENT,
  `warranty_desc` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`warranty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warranty`
--

LOCK TABLES `warranty` WRITE;
/*!40000 ALTER TABLE `warranty` DISABLE KEYS */;
INSERT INTO `warranty` VALUES (1,'ในประกัน'),(2,'ในประกัน จ่ายส่วนต่าง'),(3,'นอกประกัน'),(6,'afese'),(8,'ทดลอง');
/*!40000 ALTER TABLE `warranty` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-03 13:07:12
