-- -------------------------------------------------------------
-- TablePlus 2.3(222)
--
-- https://tableplus.com/
--
-- Database: think
-- Generation Time: 2019-05-03 22:10:20.8350
-- -------------------------------------------------------------


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


CREATE TABLE `pg_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_nickname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` char(250) COLLATE utf8_unicode_ci NOT NULL,
  `admin_status` int(11) NOT NULL,
  `update_time` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_user` (`admin_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pg_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `name` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

CREATE TABLE `pg_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `pg_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `role` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) DEFAULT '',
  `name` char(100) NOT NULL DEFAULT '/',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

INSERT INTO `pg_admin` (`admin_id`, `admin_user`, `admin_nickname`, `admin_password`, `admin_status`, `update_time`, `create_time`) VALUES ('1', X'61646d696e', '小弟', X'243279243130243334337569776f346d612f627959735768724545422e7a433441306b6e46447a767a504a452f624a5749654459684d516734465132', '1', X'31353233353031373830', '1523501780'),
('23', X'74657374', '测试', X'243279243130242e3958344d6b4339515249346c70466f36503236524f424d33566730387167786750504e6e507036456550792f4b72374b3164634b', '1', X'31353536383837353039', '1556887509');

INSERT INTO `pg_auth_group` (`id`, `title`, `name`, `status`, `rules`) VALUES ('15', X'e6b58be8af95', 'test', '1', '130,129,131');

INSERT INTO `pg_auth_group_access` (`uid`, `group_id`) VALUES ('23', '15');

INSERT INTO `pg_auth_rule` (`id`, `pid`, `role`, `title`, `status`, `condition`, `name`) VALUES ('95', '0', X'72756c65', X'e8a784e58899e7aea1e79086', '1', X'', X'61646d696e2f726261632f72756c6573'),
('96', '95', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f61646452756c65'),
('97', '95', X'757064617465', X'e4bfaee694b9', '1', X'', X'61646d696e2f726261632f75706461746552756c65'),
('98', '95', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c65746552756c65'),
('99', '0', X'726f6c65', X'e8a792e889b2e7aea1e79086', '1', X'', X'61646d696e2f726261632f67726f757073'),
('100', '99', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f61646447726f7570'),
('101', '99', X'757064617465', X'e4bfaee694b9', '1', X'', X'61646d696e2f726261632f75706461746547726f7570'),
('102', '99', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c65746547726f7570'),
('103', '0', X'6163636f756e74', X'e794a8e688b7e7aea1e79086', '1', X'', X'61646d696e2f726261632f7573657273'),
('104', '103', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f61646455736572'),
('105', '103', X'757064617465', X'e4bfaee694b9', '1', X'', X'61646d696e2f726261632f75706461746555736572'),
('106', '103', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c65746555736572'),
('129', '95', X'6c697374', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f72756c6573'),
('130', '99', X'6c697374', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f67726f757073'),
('131', '103', X'6c697374', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f7573657273');




/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
