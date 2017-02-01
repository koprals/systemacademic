# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.56)
# Database: amaya-004-hsbc
# Generation Time: 2015-06-03 23:56:11 +0000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table point_log_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `point_log_types`;

CREATE TABLE `point_log_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `point_log_types` WRITE;
/*!40000 ALTER TABLE `point_log_types` DISABLE KEYS */;
INSERT INTO `point_log_types` (`id`,`name`)
VALUES
	(1,'Api'),
	(2,'Import');

/*!40000 ALTER TABLE `point_log_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table point_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `point_logs`;

CREATE TABLE `point_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `point_log_type_id` int(11) DEFAULT NULL,
  `game_hash` varchar(30) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `win` int(1) DEFAULT '0',
  `voucher` int(1) DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `point_logs` WRITE;
/*!40000 ALTER TABLE `point_logs` DISABLE KEYS */;
INSERT INTO `point_logs` (`id`,`user_id`,`point_log_type_id`,`game_hash`,`point`,`date`,`win`,`voucher`,`status`,`created`,`modified`)
VALUES
	(2,24,1,'q5XeqpWVrJSWqpqWrw==',0,'2015-06-03',0,0,1,'2015-06-03 21:32:26','2015-06-03 21:32:26'),
	(3,24,1,'q5XeqpWVrJSWqpqWsQ==',0,'2015-06-03',0,0,1,'2015-06-03 21:32:28','2015-06-03 21:32:28'),
	(4,24,1,'q5XeqpWVrJSWqpqWsg==',0,'2015-06-03',0,0,1,'2015-06-03 21:32:29','2015-06-03 21:32:29'),
	(5,24,1,'q5XeqpWVrJSWq5KVrw==',0,'2015-06-03',0,0,1,'2015-06-03 21:35:36','2015-06-03 21:35:36'),
	(6,24,1,'q5XeqpWVrJSWq5KVsQ==',0,'2015-06-03',0,0,1,'2015-06-03 21:35:38','2015-06-03 21:35:38'),
	(7,24,1,'q5XeqpWVrJSWq5abrA==',0,'2015-06-03',0,0,1,'2015-06-03 21:43:13','2015-06-03 21:43:13'),
	(8,24,1,'q5XeqpWVrJSWrJGUrw==',0,'2015-06-03',0,0,1,'2015-06-03 21:50:26','2015-06-03 21:50:26'),
	(9,24,1,'q5XeqpWVrJSWrJGXrg==',10,'2015-06-03',1,0,1,'2015-06-03 21:50:55','2015-06-03 22:18:53'),
	(10,24,1,'q5XeqpWVrJSWrJWbsA==',10,'2015-06-03',1,0,1,'2015-06-03 21:58:17','2015-06-03 22:17:40'),
	(11,24,1,'q5XeqpWVrJSWrJaSqg==',10,'2015-06-03',1,0,1,'2015-06-03 21:58:21','2015-06-03 22:12:55'),
	(12,24,1,'q5XeqpWVrJSWrJebsg==',0,'2015-06-03',1,1,1,'2015-06-03 22:01:39','2015-06-03 22:13:28'),
	(13,24,1,'q5XeqpWVrJSWrJiSrQ==',0,'2015-06-03',1,1,1,'2015-06-03 22:01:44','2015-06-03 22:14:55');

/*!40000 ALTER TABLE `point_logs` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
