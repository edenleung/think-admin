-- -------------------------------------------------------------
-- TablePlus 2.3(222)
--
-- https://tableplus.com/
--
-- Database: think
-- Generation Time: 2019-05-11 13:56:52.9020
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pg_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `name` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `pg_auth_group_access` (
  `user_id` mediumint(8) unsigned NOT NULL,
  `role_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`user_id`,`role_id`),
  KEY `uid` (`user_id`),
  KEY `group_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `pg_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) DEFAULT '',
  `name` char(100) NOT NULL DEFAULT '/',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `pg_admin` (`admin_id`, `admin_user`, `admin_nickname`, `admin_password`, `admin_status`, `update_time`, `create_time`) VALUES ('1', X'61646d696e', '小弟', X'243279243130243334337569776f346d612f627959735768724545422e7a433441306b6e46447a767a504a452f624a5749654459684d516734465132', '1', X'31353233353031373830', '1523501780'),
('28', X'74657374', '测试用户', X'2432792431302461324f7634655a4d696f6b4f6f416e73676b532f4d4f486537485a664c5744737245457353646b6f71456c6c415a3452466e4e4965', '1', X'31353537353532393931', '1557552991');

INSERT INTO `pg_auth_group` (`id`, `title`, `name`, `status`, `rules`) VALUES ('1', X'e6b58be8af95', 'test', '1', '2,7,12');

INSERT INTO `pg_auth_group_access` (`user_id`, `role_id`) VALUES ('28', '1');

INSERT INTO `pg_auth_rule` (`id`, `pid`, `action`, `title`, `status`, `condition`, `name`) VALUES ('1', '0', X'72756c65', X'e8a784e58899e7aea1e79086', '1', X'', X'2f'),
('2', '1', X'76696577', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f72756c6573'),
('3', '1', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f61646452756c65'),
('4', '1', X'757064617465', X'e69bb4e696b0', '1', X'', X'61646d696e2f726261632f75706461746552756c65'),
('5', '1', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c65746552756c65'),
('6', '0', X'726f6c65', X'e8a792e889b2e7aea1e79086', '1', X'', X'2f'),
('7', '6', X'76696577', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f726f6c6573'),
('8', '6', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f616464526f6c65'),
('9', '6', X'757064617465', X'e69bb4e696b0', '1', X'', X'61646d696e2f726261632f757064617465526f6c65'),
('10', '6', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c657465526f6c65'),
('11', '0', X'6163636f756e74', X'e7aea1e79086e59198e7aea1e79086', '1', X'', X'2f'),
('12', '11', X'76696577', X'e69fa5e79c8b', '1', X'', X'61646d696e2f726261632f7573657273'),
('13', '11', X'616464', X'e6b7bbe58aa0', '1', X'', X'61646d696e2f726261632f61646455736572'),
('14', '11', X'757064617465', X'e69bb4e696b0', '1', X'', X'61646d696e2f726261632f75706461746555736572'),
('15', '11', X'64656c657465', X'e588a0e999a4', '1', X'', X'61646d696e2f726261632f64656c65746555736572');




/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;