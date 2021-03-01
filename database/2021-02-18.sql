-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.28 - MySQL Community Server (GPL)
-- 服务器OS:                        Linux
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table think2.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `top` int(11) DEFAULT '0' COMMENT '是否置顶',
  `sort` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1' COMMENT '状态 0 隐藏 1 显示',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章表';

-- Dumping data for table think2.article: ~0 rows (大约)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `title`, `image`, `article_category_id`, `content`, `top`, `sort`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '文章一', 'storage/topic/20210301\\6906862ce43bdce3991e0054431992c6.jpg', 4, '<p>9090</p>', 1, 0, 1, 1614566767, 1614568003, 0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table think2.article_category
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `disable` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.article_category: ~2 rows (大约)
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` (`id`, `title`, `pid`, `disable`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '顶级分类', 0, 0, 1612940363, 1612940363, 0),
	(4, '分类一', 1, 0, 1614566307, 1614566307, 0);
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;

-- Dumping structure for table think2.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.dept: ~4 rows (大约)
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` (`id`, `title`, `pid`, `status`, `create_time`, `update_time`) VALUES
	(1, 'Ant Design', 0, 1, 1612940363, 1612940363),
	(2, '深圳分部', 1, 1, 1612940363, 1612940363),
	(3, '设计部', 2, 1, 1612940363, 1612940363),
	(4, '程序部', 2, 1, 1612940363, 1612940363);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;

-- Dumping structure for table think2.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '路由名称|资源名称',
  `title` varchar(100) NOT NULL COMMENT '菜单名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `type` varchar(6) NOT NULL COMMENT '类别 1 目录 2 菜单',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 隐藏',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT 'path',
  `redirect` varchar(100) NOT NULL DEFAULT '' COMMENT 'redirect',
  `component` varchar(100) NOT NULL DEFAULT '' COMMENT 'component',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT 'icon',
  `permission` varchar(100) NOT NULL DEFAULT '' COMMENT 'permission',
  `keepAlive` int(11) NOT NULL DEFAULT '0' COMMENT 'keepAlive',
  `hidden` int(11) NOT NULL DEFAULT '0' COMMENT 'hidden',
  `hideChildrenInMenu` int(11) NOT NULL DEFAULT '0' COMMENT 'hideChildrenInMenu',
  `blank` int(11) NOT NULL DEFAULT '0' COMMENT 'blank 1 外部链接 0 默认内部',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table think2.menu: ~22 rows (大约)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`, `blank`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Index', '首页', 0, 'path', 1, '/', '/dashboard', 'BasicLayout', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(2, 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/workplace', 'RouteView', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(3, 'Analysis', '分析页', 2, 'menu', 1, '/dashboard/analysis', '', 'Analysis', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(4, 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', 'Workplace', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(5, 'System', '系统管理', 1, 'path', 1, '/system', '/system/menu', 'PageView', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(6, 'Menu', '菜单管理', 5, 'menu', 1, '/system/menu', '', 'Menu', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(7, 'Role', '角色列表', 13, 'menu', 1, '/system/role/list', '', 'Role', 'smile-o', '', 0, 0, 0, 0, 0, 1612859426, 0),
	(8, 'Account', '管理员列表', 17, 'menu', 1, '/system/account/list', '', 'Account', '', '', 0, 0, 0, 0, 0, 1613542292, 0),
	(9, 'Dept', '部门管理', 5, 'menu', 1, '/system/dept', '', 'Dept', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(11, 'test', 'test', 1, 'menu', 1, '/test', '', 'Analysis', 'smile-o', '', 0, 0, 0, 0, 1612857539, 1612858652, 1612858652),
	(12, 'UpdateRole', '更新角色', 13, 'menu', 1, '/system/role/:id', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612859191, 1612859554, 1612859554),
	(13, 'RoleManage', '角色管理', 5, 'path', 1, '/system/role', '/system/role/list', 'RouteView', 'smile-o', '', 0, 0, 1, 0, 1612859346, 1612859505, 0),
	(14, 'UpdateRole', '更新角色', 13, 'menu', 1, '/system/role/:id/update', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612859649, 1612933655, 0),
	(15, 'CreateRole', '创建角色', 13, 'menu', 1, '/system/role/create', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612889407, 1612889407, 0),
	(16, 'CreateAccount', '创建管理员', 17, 'menu', 1, '/system/account/create', '', 'AccountForm', '', '', 0, 1, 0, 0, 1613542028, 1613542206, 0),
	(17, 'AccountManage', '管理员管理', 5, 'path', 1, '/system/account', '/system/account/list', 'RouteView', 'smile-o', '', 0, 0, 1, 0, 1613542117, 1613542320, 0),
	(18, 'UpdateAccount', '更新管理员', 17, 'menu', 1, '/system/account/:id/update', '', 'AccountForm', '', '', 0, 0, 0, 0, 1613544796, 1613544796, 0),
	(19, 'ArticleManager', '文章管理', 1, 'path', 1, '/article', '/article/list', 'PageView', 'smile-o', 'Article', 0, 0, 0, 0, 1614562874, 1614567926, 0),
	(20, 'Article', '文章列表', 19, 'menu', 1, '/article/list', '', 'Article', '', 'Article', 0, 0, 0, 0, 1614562915, 1614567792, 0),
	(21, 'ArticleCategory', '分类列表', 19, 'menu', 1, '/article/category', '', 'ArticleCategory', '', 'ArticleCategory', 0, 0, 0, 0, 1614562980, 1614567778, 0),
	(22, 'CreateArticle', '创建文章', 19, 'menu', 1, '/article/create', '', 'ArticleForm', '', 'CreateArticle', 0, 1, 0, 0, 1614563312, 1614563726, 0),
	(23, 'UpdateArticle', '更新文章', 19, 'menu', 1, '/article/:id/update', '', 'ArticleForm', '', 'UpdateArticle', 0, 1, 0, 0, 1614563375, 1614567969, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table think2.menu_action
CREATE TABLE IF NOT EXISTS `menu_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.menu_action: ~27 rows (大约)
/*!40000 ALTER TABLE `menu_action` DISABLE KEYS */;
INSERT INTO `menu_action` (`id`, `name`, `title`, `menu_id`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'View', '详情', 3, 0, 0, 0),
	(2, 'View', '详情', 4, 0, 0, 0),
	(3, 'View', '详情', 7, 0, 0, 0),
	(4, 'List', '列表', 7, 0, 0, 0),
	(5, 'Create', '创建', 7, 0, 0, 0),
	(6, 'Update', '更新', 7, 0, 0, 0),
	(7, 'Delete', '删除', 7, 0, 0, 0),
	(8, 'List', '列表', 6, 1612938348, 1612938348, 0),
	(9, 'Info', '详情', 6, 1612938363, 1612938363, 0),
	(10, 'Update', '修改', 6, 1612938386, 1612938386, 0),
	(11, 'Delete', '删除', 6, 1612938396, 1612938396, 0),
	(12, 'Save', '保存', 16, 1613542061, 1613542061, 0),
	(13, 'List', '列表', 8, 1613542183, 1613542183, 0),
	(14, 'Save', '保存', 15, 1613546258, 1613546258, 0),
	(15, 'Save', '保存', 14, 1613546271, 1613546271, 0),
	(16, 'Save', '保存', 18, 1613546286, 1613546286, 0),
	(17, 'List', '列表', 20, 1614562996, 1614562996, 0),
	(18, 'Create', '新增', 20, 1614563009, 1614563009, 0),
	(19, 'Update', '修改', 19, 1614563024, 1614563024, 0),
	(20, 'Delete', '删除', 20, 1614563038, 1614563038, 0),
	(21, 'List', '列表', 21, 1614563065, 1614563065, 0),
	(22, 'Create', '新增', 21, 1614563088, 1614563088, 0),
	(23, 'Update', '修改', 21, 1614563099, 1614563099, 0),
	(24, 'Delete', '删除', 21, 1614563119, 1614563119, 0),
	(25, 'Update', '修改', 20, 1614563144, 1614563144, 0),
	(26, 'Save', '保存', 22, 1614563324, 1614563324, 0),
	(27, 'Save', '保存', 23, 1614563415, 1614563415, 0);
/*!40000 ALTER TABLE `menu_action` ENABLE KEYS */;

-- Dumping structure for table think2.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.oauth_access_tokens: ~67 rows (大约)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`client_id`, `userid`, `scope`, `revoked`, `access_token`, `expires`) VALUES
	('123456', '1', '', 0, '1ece53138c817ad9b20ee1c3d5e097825755ef85f556d6767c39b1dda9c1442c525dbf355bca75ca', 1614054646),
	('123456', '1', '', 0, '58b802144ace143618f0077e5e40e263c4d41be952fd552db9e1a3c225f84434287fd77a97f7de98', 1614054647),
	('123456', '1', '', 0, '86715a0f145331f91a38a01ef5d46837377a12f63600e0ec6e152c81656fc9dd9f2b8ab71acc9e50', 1614054736),
	('123456', '1', '', 0, '299944a5700bb06122e1ea1b995b575fbf9f28a09f6cc33fbd02e40b2ca2bdcd3d56dbf34efd1674', 1614054760),
	('123456', '1', '', 0, 'ff6db06fbeb9f780621a88577187b3a386c6683f9fbce14f1a1e949b5c4dc9c5c461cd00c31d530f', 1614060148),
	('123456', '1', '', 0, '169cbfd97858a0b185d5f0e1e70d66917243e0d895ec3daa042c04bf2541930344332149ef6cf53d', 1614060190),
	('123456', '1', '', 0, '6fa952a74c5f065facb3d761d009ffef87d69f3ec670a40cea977f5f9abe0beeb3c647ff56d2408c', 1614060223),
	('123456', '1', '', 0, '2eb730b4adea4fe340d359fd395122e5ff1d526220d77e804a614b5678b0859ab696ba579889ca7b', 1614060345),
	('123456', '1', '', 0, '9b2f63b9fefc39f9cf990e86649900d7bd447724ad4d9df5a11a85af3bc335fb48009203fe7def40', 1614060468),
	('123456', '1', '', 0, '789afe82271333af23564b605698cce2559ea6dee47fec20c339822d2394c91642e094b94091101e', 1614060485),
	('123456', '1', '', 0, '651614ffaa15c697f8d7ae5b269492601fad1802e69d9bfdabb03e382fcdc0a5504a11de77a96630', 1614060581),
	('123456', '1', '', 0, '1ed244cc7e72032c815a16cc411e02ae0286f16139ebede16088138d41205ebe98244ff82754551c', 1614060587),
	('123456', '1', '', 0, 'be9518be56ac09846abcf9ccba25709e4fce167c9b7d163d623123bdaf658e01fa2e8fbd7f692ffa', 1614060594),
	('123456', '1', '', 0, '4bc3de229af23ca2e98a6a5e7db46b7367b1cf1bd286874ed949cd3f1d4e9822025507a4f48e64df', 1614060684),
	('123456', '1', '', 0, '80ddeeda2a4a6f91195348e19de80e91791965916736397f2909d08ca6e2bf2777e84a7975b873a9', 1614060688),
	('123456', '1', '', 0, '5602ff9a5c5f04eec18f94b17d4f6775c695da982ba984bdf60ec5a026374453db2a1c6279531dff', 1614060760),
	('123456', '1', '', 0, 'f1d4ce2075be4e30649e30fbb55aa9c3cbd5239cde322f5d7d6b5f97a9671884b989bd67d953cb3a', 1614060769),
	('123456', '1', '', 0, '5a682dfda64cb7ea6b116ab0635b3893e1541e5a9b20adead1a04f59f40c96d657ff58372e99afa6', 1614060779),
	('123456', '1', '', 0, 'f0aa748b4af50407f12471f560a4fe79e5866a9573551252b0cc83fc7ff492ae6a852625617edadb', 1614060783),
	('123456', '1', '', 0, '21d6d74c742c2fcff7b20338505f787ad0bff2e0ffa690ec5a68731a17e4b6d642080c42c8b38fc9', 1614060787),
	('123456', '1', '', 0, 'f24ec400608d48fd4032daacfa4c29fd5e3749c33d2675d41b0cc890c8d8797e57691a03e7a506dd', 1614060803),
	('123456', '1', '', 0, 'a4c6117883c965216e920687ec67e636790ac5f40cbd04fe3692b1a069094f7dac57bb95c4d4307c', 1614061441),
	('123456', '1', '', 0, 'b7985f1e8e45a61eaa9672c5b8cc4fba494e9cf4e344448c5c83de2b235b778b2eb2e5e80e7d2689', 1614062871),
	('123456', '1', '', 0, '1a2afe60d78c54e2cbf66a0048d66d7f6585e452e8c85304de3b2754b3b98e0bf9c88298bbc15993', 1614063789),
	('123456', '1', '', 0, 'a40a59c004c3607fc1d095305ccfa37aa5a661befdca566191cfdacc1eafcda47785177be3bef0ce', 1614063823),
	('123456', '1', '', 0, '78d414efae6545f946152694118695bdf44d1132a45086cb003d9a8c4a5d811445bd2cf937d7e856', 1614063836),
	('123456', '1', '', 0, 'ff4d9e12351ec5ad63a839b3f6020b0c543fef36b9a46a81c27e247e98a35c9acf41733fc68acc00', 1614063839),
	('123456', '1', '', 0, 'd184aefc75ef9efa95da7ffff80b0eeb1f2e7d1602181afcf290f19587f80c3eb1ae6dbf8b98bdee', 1614063842),
	('123456', '1', '', 0, '8ac1eeb7b302aefbab8363669faa261de3f5531a132e7468088a9a7e1bed7cc30cd65478123c4d06', 1614063850),
	('123456', '1', '', 0, '58189d78e45289e25bd0dfcbb6950ee34decf2c658e1b5070260bcd2b0785e8564a5f2fd42590f64', 1614063868),
	('123456', '1', '', 0, '0d999ef3ee7713e4fe9ef1cf2636b861c23d32a70b79097caef439fc252e893a084d47769512164a', 1614064254),
	('123456', '1', '', 0, '8231a86645fe7844de37d1d2b5986647ccb0efdf28719dc20939f49fdf5d01b1be7217b1ea579bce', 1614064256),
	('123456', '1', '', 0, 'cad2c43e8e301aaa173ce96dd2d95b71c9a1f106512f9e38c179effa2d42aea530834a8b74086ec7', 1614065539),
	('123456', '1', '', 0, 'd31105e9d64d9c44c530e4919b37c775c1b00d1cbdd32650c565dc8e3a4d279c0eb6e939a733f7af', 1614065570),
	('123456', '1', '', 0, 'bd272ead2e800d0bdd217d501b896ccefa89f3ea1e6098174d85106fa47059b57a79d9550a88324d', 1614062269),
	('123456', '1', '', 0, 'e709488efec359b590b6fcdefd5b3652e9bdfb1eb12268709b96c2e05d7a2b706129599b707a4057', 1614062396),
	('123456', '1', '', 0, '6e39ec738ee6468be5959a386e519c8045367e1fbb5da1fd3c78c223bad2e17c6a6a9dc8464347dd', 1614067006),
	('123456', '1', '', 0, '90b52d6cda0c5247d728694101ce23963bc1771a949950e83d7c9092330cc056381ffed7bd075df2', 1614071518),
	('123456', '1', '', 0, 'ac4d83b9d56e2c88e4ad0a98ba8177acad3754814fa03b89c5fa7cf8c8c272b0768f7bc2376dabb0', 1614071636),
	('123456', '1', 'photos', 0, '685559b6882df288f96a612b06bdd6343832f6f352c69cfb8fdd566fa15ba75d7e74a55a8b5d8ab4', 1614073892),
	('123456', '1', '', 0, '47ef7674d059eedfee4ee09da57a21f5416ed57ed5085891df15056ceaeaf94988168e56f944edea', 1614076713),
	('123456', '1', '', 0, '3fcd90440b745178fb847a357ba7271f6d1f527af48ce0244dbf34f981ef6722b02a0f44b8f3df27', 1614076944),
	('123456', '1', 'photos', 0, '9babb6c13ff5ff4029918946e3e93c5bac2c67c3b54c6dfb6aeeb2b19df7552dd7bfc28a1e0c147e', 1614077178),
	('123456', '1', 'photos', 0, '782a42218b6e72bc7544e2bc275f1b8112c541ee0bd8131049a5e1b0084bccf50e26094f39c2bee7', 1614077348),
	('123456', '1', 'photos', 0, '98d80082d750fe9205dc185bdc4891ac2d1f474b4cc955397ef1b7e41b62b56452931bef20843a35', 1614077404),
	('123456', '1', 'photos', 0, '74c0bd8d0e9235dca1f660b172724a90b7ec8f4c4013c2ca8d25bec658ea4b83c01e99bce883266e', 1614077406),
	('123456', '1', 'photos', 0, '6860e2067aa378c26265ab40c22324fd63ece21c1923f253b287ed6a6b98a1a1c7319f73ca7367e1', 1614077429),
	('123456', '1', 'photos', 0, 'e8a4f5f5c009029adb5cb9a20a42584e22e1a919928f9a0142f7c03b0cfb9a863ebab70908166de6', 1614077431),
	('123456', '1', 'photos', 0, '7522935743fcb433e77ecd0027e6e2199937bdf1c79b560f1290eda94dd1fd6198d257d949747bc1', 1614077436),
	('123456', '1', 'photos', 0, 'c72cc0dde8404fee10f218eceddcc005d52f9bc330542bb3bcde03cadd31b9a29c311384377764b6', 1614077438),
	('123456', '1', 'photos', 0, '1830d3c5834e11914082d82d9c6a1a2f4ce165fb5a78a3f41017787bfd19f614e639b756236f8fba', 1614077450),
	('123456', '1', 'photos', 0, 'fe466ccb43ad699c3984949a736e1ab28ad84ef8eb81fb76d6da83efe6ecdaf1002ed45b6a922c06', 1614077452),
	('123456', '1', 'photos', 0, '6126f595b9eed65606f7f975cb417ebcbf1e82246da92d341a1d7704be3bbfe2eeb7b4f6eb9a0c3c', 1614077454),
	('123456', '1', 'photos', 0, '350faf94f952ad589cf68484da256d6faa26cbcffe240aa585a88ddb20d6990f772430f415bf6871', 1614077474),
	('123456', '1', 'photos', 0, 'efaff2ad69ef2bc34bff0cafa45b40528b6f4d55c79b3f2c46d142a1b3016361c0ae8b7f6fd6b5f4', 1614077513),
	('123456', '1', 'photos', 0, 'a1daab99be5cdd25a6e92e084c732ef7e53ef567ddb5e493d70303907a5397335a1d7a835da0ae86', 1614077531),
	('123456', '1', 'photos', 0, 'f634a33e212b724f00c2f49627761a7d4cfb140dda6f8cc80c31a2b75d24e690e3ea7efb4ea46565', 1614077545),
	('123456', '1', 'photos', 0, '3cfa3141888195a3f55f4132d2a9e9f82aef6e449edfee1f5bf4640057c98a244196409606aaf37f', 1614077554),
	('123456', '1', 'photos', 0, '3120c9f11acc2f0f9d6b5c902eecd857a5bfdebad452fdc9c3f59663356e29779b4fdc293a19d887', 1614077776),
	('123456', '1', '', 0, '9974dc0e48d874b9b9f0b7df63485cf4c34004072ca2b338a98978737ad31fa4f112fd9478fb3245', 1614077828),
	('123456', '1', '', 0, '1298c089263f5cce60676cefc51d201ed6a8cc74852cd0e95bdce6fdf7f7e86b854896942e02787a', 1614077832),
	('123456', '1', '', 0, '877b9a3b988370ae7cf66896a453298451ec1cb4b410ba9a2edfc7fd06368df96fa56f2833d52961', 1614078153),
	('123456', '1', '', 0, '6f7371055c0cfbd0eec0da648a613ae43f8a1356f9657ef65e0a650ea9d08b18c3d98458eadc9b8d', 1614078189),
	('123456', '1', '', 0, 'b4776963db107e99a449a3044443510083e5aff776bae66dd204dac5abbb13434a8b62902436ac45', 1614078229),
	('123456', '1', '', 0, '96c89b722751c4d20270888fc5df81dc5805219692ef4a4ed4ead6bb5b2dd21c8b2f92c444139e3d', 1614078320),
	('123456', '1', '', 0, '53ab8a319b8be0e1247c5a559decfc41e784a858f245957a9ca94f826991b793e49481965fa0c428', 1614078323),
	('123456', '1', '', 0, 'dd08da34dcb9d914a5da020f40f6ca9bce8b44d4a499be6e1685aa5d38abde22cd13a0be0d1e72a5', 1614078343);
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table think2.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `auth_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.oauth_auth_codes: ~21 rows (大约)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
INSERT INTO `oauth_auth_codes` (`client_id`, `user_id`, `scope`, `revoked`, `auth_code`, `expires`) VALUES
	('123456', '1', 'photos', 0, 'a3b46fc7b6e9567a3aa541b61a464472def7f98eba8a55e45aedb51d0fd73f75fc623111fbe1511c', 1614049442),
	('123456', '1', '', 0, '6d5e5e4e449556755575ba224a85d1ebca1bcff3cf54e73a2180dfb6631d19ae5b68d5072cc11221', 1614050610),
	('123456', '1', '', 0, 'ad742635129ba8280f699be9d6df9d189704286d1916bfa001c39916133bc8079f6409dfde9d39fe', 1614051548),
	('123456', '1', '', 1, '19548ac558d8237dbef22a9c4b212d9c1c3cc4286f1090a6a46a3c9bf177075700dd17eb4b74de64', 1614051619),
	('123456', '1', '', 0, '1186a2d4f3231edbaa81d35fcfd0bc2c390af89589359007dd747cee211d9472c025ef5c4f43c68b', 1614055822),
	('123456', '1', '', 0, '15ebb26682a61ac8137da2de7c80c7520ba8c1c532651b2b64baa4edb7509e0a5eb5bfb4652e1540', 1714056753),
	('123456', '1', '', 0, '5e43a9d6fc8f51aae623cc3d1547f00731008b99d03b7b35d28d1d6dd33a89ced7cb2daa2f2ce0da', 1614057426),
	('123456', '1', '', 1, '3550ff5225508b74c917605992407ad27b875813209bd6c4a8a5f2e7d0907965b1df199c5f8194f8', 1614057467),
	('123456', '1', '', 1, 'b2360e23005c4dccc3ba9d30b00d268dbd01235a3756c796091a72d9a7d2a5f263e64925f975dd97', 1614058440),
	('123456', '1', '', 1, '7a7d51496a130f3f9720ed58c05b3585d0d6c4900f931fafbac45bfbc12e9bf574795edcefdc9a4c', 1614059870),
	('123456', '1', '', 0, 'a22d93a5bfcaaeb9ed01acb886408893384dce0eb0ad694494f07824fca036a91c1d8558327e193c', 1614060778),
	('123456', '1', '', 1, 'a7ad667c0677e6f365abb6b1b1570802cf9976de8ddc3d3c1de7cb2825d9766e32af96ad92f86161', 1614060788),
	('123456', '1', '', 1, '7dc2f37dc41e1e4050672cfca9dce0693642e313cb9dfad186da56aedeea23b7865b04017ddf9ea9', 1614062537),
	('123456', '1', '', 1, '4b217a5866f7683941d1fcf5ca1aabb76ebcd5cb6e620b45150008dd82d4437333b5c50c8b27f41e', 1614062808),
	('123456', '1', '', 0, '48eb5d17b859d8c6b6aeb08a9cc65062df9e120e6a1251d5b839114fc58313e758b009e8301eed78', 1614067223),
	('123456', '1', '', 0, '4d9fcbb0a393d181a3ec8677e217d9aad3c6c6e93dff6f99c1705a3577ce4a89c5291f8f9f1dd642', 1614067268),
	('123456', '1', '', 1, 'ee2fcaeaa9d5a095e44c043c2d422af6f16f1461e4eeef83089170f0a5f80e2bfe6753b979901a7d', 1614067397),
	('123456', '1', '', 1, '222c20dcac72b6411623f58afc40600c7c5499a091b55075ad50c1f3594d4f6677ecf0c68ae608c8', 1614068517),
	('123456', '1', '', 1, 'f488e8b1489534033c22693a1ba6e9ae82707712039d90d0ac0ffcde2645923732845bd3c51d2138', 1614068635),
	('123456', '1', 'photos', 1, 'f75114acc27110bf1c26adda79613e5242cbd97644c30763b4e3c553fad58ed5be664ca6d599dc19', 1614070891),
	('123456', '1', '', 1, '66a253395e0d637f7b9c35daaa3432bf863690907f470bb80d9afb785087bf59dbb0240b21fb89b2', 1614073711),
	('123456', '1', 'photos', 1, '6f1731e0855152f52fea8fc461da83063e0d8918eb880b01bef8166a66d08f1eef9aec949c321268', 1614074177),
	('123456', '1', '', 1, '166d2465bb0fecf45d8ebf00d737618a9eaf93697eadb12c1d96f029fb1c806f3d152a6ffc622aa1', 1614074827);
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table think2.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grant_types` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.oauth_clients: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`client_id`, `grant_types`, `name`, `redirect_uri`, `client_secret`) VALUES
	('123456', '', 'xiaodi app', 'http://192.168.31.217:4444/callback', 'bRntdgKH8afd7FqrAgwvRFYSkgK5fXLKkEzoaGSl');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table think2.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `revoked` tinyint(1) DEFAULT '0',
  `refresh_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.oauth_refresh_tokens: ~83 rows (大约)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` (`revoked`, `refresh_token`, `access_token`, `expires`) VALUES
	(0, 'e4b272d570387eb1f94f3208d266c4aba6c5be9a936b2b0799a48c4cd91df02691d5f9cc7264e52d', '9ccebaa8b3950963582fb03c10f572378be58901e2aed7116bbb803b692189fc29dcf9c24700dc5a', 1616233925),
	(0, '0c96e0499279ef4bda617ef74b0e00e6817e27cf61838da557ddfbab77055fc8b7cace0802b9297d', '85452b56d0c70710ad4260546add9417b8cd74e41882d97618658fe02d1f24c0a3632cc833e1567b', 1616233930),
	(0, '5e00e8022abe1c29f1e4062f0aaa251465fed6e8a4b3e1e8c016a8f26fbfd5a2b0c9073dfb7c3c9e', 'e32915e43dfaaa233d186f1d745ebedd7a89517a3e54f9cb491ecff354287bb58cf693a4244e801a', 1616234205),
	(0, 'b13716eacc4b364fe600bae9d9cc19dd2d5eaccba354af4f5b9fd895f675330bd1fbfed658ec6500', 'a13627b184c654fe050c17c9baedfd35bfd08c83449303f164ff69219bd0fc5888a67e47d86f82e6', 1616234224),
	(0, 'fd9e3cb12bc66dfa45a251c82bad71889086beb5cc677d61ba978da26c8488b4b141db8a281cee58', 'e83be1e552a7a48a6cf8f14bc796e2f2e4909b6b7e997d99b6861915e8b2a509e206fcb364fabfd6', 1616234233),
	(0, '31880b8b029a8ecb9e813d61d0f32b376289bb64f3f58f542d5f40eb020b2dc7925d3d97fdabc6fc', '0ca68a5f49afd176330160c3e2c492c02d0222a5e32268d8c272fa43566aecdae11fc39de1766c46', 1616234235),
	(0, '2e1012cf4ebd5a420d92d41cb3804e9f2f22151d86606389533ae80194dc3ba96922d1083a59029e', '22ea4217a7e1e76497b4941d6f4dd0e8dca91bd85ea1fc7d3ee39231f3986a98c22986175cb1baa7', 1616234237),
	(0, 'cf6d2461f2c5de91071e940c24a181ccc2461e352194e000ecd3b10da8de52e378e8df6755c43365', 'f61d56939d42a015cba4009467dfb60f0fbc18579b1910500740a8e887df849a1a1ccceb4a2e1e1b', 1616234266),
	(0, '9facf9e1597104dc53aeb67a9e3bb1e9c0a3444b65d3d8dfff7261df58bb89ca85a4221fee7c4492', '624736c1f013d464ab1f56e874e5d9c318a02427055095bd5d5c50169c6e99f6918e27ce6e97ec92', 1616234268),
	(0, '54dbbb3da49a84f3737407acbfc33bbd7d608e90ba4e90db760d27ad0a19944de809beed883a6051', '49ad1323e1ff7fb220dc043db04e6de285f975873ee896c7118524f70b688ef72ff7e6cfe475d74d', 1616234273),
	(0, 'dbe158390c811dc801a80116ca255a9ad755a60732fda02b56966b85b61e7770e1209ba94197f267', 'afa21f550cc8960c34dbc8d7ab2e040915fb7afa2736dde1388ff05b7fd956255f250ebac18414e3', 1616234289),
	(0, '2b53a95abce1bd07e7e61d34b1332d67b5f7c8ea5d449bd63714234d7b189cedd5a43196f71b1f15', '28e088325e8012f29e9ae5ebc2ef84e6489e08a8e57cc042c15f360efd7618ff69481fa98c54f91c', 1616234290),
	(0, '14e3c9514d97549512b5ddf8cb0dd95869d79efd5c794347c73a5e90262086beadaaa2046e9d8c01', '1cb3700d129979a19adfe960a9ed774552c3e64f79c4b114f317ce2ee67d5a627f15145a76611cc7', 1616234323),
	(0, '2ceab5f8ab23088886b4f757ebd46c64bbf088c3697d3712bae8dd16609a7fba6fa836284656e78b', 'c40ffba0be616d9ea50d4facbaf659c36b62d514ba266f3769df3aac0199992f439a3b7d284dffa1', 1616234325),
	(0, '6d59dfa2a0a61b82bca51db4bfaac073b4a81d6d419e9560c395baf6e866dc413e91ea51feb700ff', '4b0b585edebda1c6b909326454ea638f35f795cdb65f87983b947db9cedefc3ae052dc7c926cd9ca', 1616234349),
	(0, '349c91783e33388cd872b396c813ba8e40ece270ee9e71b1aa66231f7fcb5d13c6a58ff6c1e8e1c3', '65e5155a78189903a7e1dea595b2ad651cdfe22facc138db45b40eb08d0a473e16a964100066bb11', 1616234372),
	(0, 'a83341dedd0d00359a677a8ba8e8ed8446a2ce70d3f53713f30fa6410f31e519a4933f99771b3d83', '89ad0eea6d4da1e1a8f7b320d426bc75aef6018e740b982dc9e34d22c72e02baf5682a3c16b68b84', 1616234441),
	(0, 'e0fb76cc67aa9f240c09a569c6d97db8f4bce02bfe82cff409b5445d541b85c314ecda617ba1ba70', '7c3a682d0bc1912da53260f4592d80feb9de902f4083a72b0ca61bac359e856e8d2a808781126e64', 1616234455),
	(0, 'f9cfc7de4f003f9c83f8c7bd2dacc2460a8aedc4b95a91620fe87381a1976465281e396d3b0eb988', '1f03bf70eb803f15b230be5752e05d393e513bb8631d64ee4575eb3f911080e8e6c0817d4cdc3ffe', 1616234483),
	(0, 'dd926b3ab97730e759406af39e0521c7d0d7d84471f1035ccdfa1dc72345428c30727ffacf118db7', '1ece53138c817ad9b20ee1c3d5e097825755ef85f556d6767c39b1dda9c1442c525dbf355bca75ca', 1616470246),
	(0, 'ff03c075256060369ff71aaed9e4c7d9b6e82867ec8f30b7d9ac0ed1ebedce59a36709fbcb7f562b', '58b802144ace143618f0077e5e40e263c4d41be952fd552db9e1a3c225f84434287fd77a97f7de98', 1616470247),
	(0, '89871aa2472bbb6ae988d231e7c034e9c04b1d6c9eaf21e9f2e98c0fb3ffa91a754112e49db430ea', '86715a0f145331f91a38a01ef5d46837377a12f63600e0ec6e152c81656fc9dd9f2b8ab71acc9e50', 1616470336),
	(0, '0afef08f82d66078d199e547d368c5811841e9fba664f6436332795d23f417f3b719c242418a8c16', '299944a5700bb06122e1ea1b995b575fbf9f28a09f6cc33fbd02e40b2ca2bdcd3d56dbf34efd1674', 1616470360),
	(0, 'e2fc0088912be1d558f5aa9aa2fbb36450a93e3598aba65671f0b997f7625b102ecc1bece92dc290', 'ff6db06fbeb9f780621a88577187b3a386c6683f9fbce14f1a1e949b5c4dc9c5c461cd00c31d530f', 1616475748),
	(0, 'cafcc47ef6d81c71e7cd141dabaca5047fc6f8f156406c36f32abf363f5046a1e95666d893cfd11d', '169cbfd97858a0b185d5f0e1e70d66917243e0d895ec3daa042c04bf2541930344332149ef6cf53d', 1616475790),
	(0, 'e86c78ca49ea036bd739fecd6db5f5c335c44666baa89edea0d0c9b6c13468da6fe5b87a013b4486', '6fa952a74c5f065facb3d761d009ffef87d69f3ec670a40cea977f5f9abe0beeb3c647ff56d2408c', 1616475823),
	(0, '34673bcdeead65d572a18a7e844e58b4d17113397f7ef550fa5e9ddfbb5b1d99d8dfbdc5459d2e45', '2eb730b4adea4fe340d359fd395122e5ff1d526220d77e804a614b5678b0859ab696ba579889ca7b', 1616475945),
	(0, 'dbb14d98561063c420347493682f431f77376ba94db8c94f998a5455a3aa61f9ed9e4036e226e536', '9b2f63b9fefc39f9cf990e86649900d7bd447724ad4d9df5a11a85af3bc335fb48009203fe7def40', 1616476068),
	(0, '087de37059f276a386143be1fab9f377b88de05f16ed8a625d1471af38f6d04479f86df63f514f5a', '789afe82271333af23564b605698cce2559ea6dee47fec20c339822d2394c91642e094b94091101e', 1616476085),
	(0, 'f0a8eb622acaf73c46b2f69ac63d4203bb9089d561564e65603b451521a8717debfbaddf14639d8c', '651614ffaa15c697f8d7ae5b269492601fad1802e69d9bfdabb03e382fcdc0a5504a11de77a96630', 1616476181),
	(0, 'a324e316fde199642c24c7c82d30041387b4f58572edb18fb61bd7bcea0c2911853dd753a5879f07', '1ed244cc7e72032c815a16cc411e02ae0286f16139ebede16088138d41205ebe98244ff82754551c', 1616476187),
	(0, 'afba3b0f38703ac897eb6e8a78ec1eaf20ddd0dfb9ff5b73509b983f9c7f239dfa968047d700b6fe', 'be9518be56ac09846abcf9ccba25709e4fce167c9b7d163d623123bdaf658e01fa2e8fbd7f692ffa', 1616476194),
	(0, '7ade81bdb2a50bb8e0211b8fd6119f7731cbe1a3c3928a75a7fef6437c642fd786f9b1a3c72ec444', '4bc3de229af23ca2e98a6a5e7db46b7367b1cf1bd286874ed949cd3f1d4e9822025507a4f48e64df', 1616476284),
	(0, 'e7980e4972159e8305c9da7a44a077bfaf959f10119f2f9e01719e903fffaac021c44d778dda506b', '80ddeeda2a4a6f91195348e19de80e91791965916736397f2909d08ca6e2bf2777e84a7975b873a9', 1616476289),
	(0, 'd50799df81ba8f444f48b7e352e2d886474df7e2ac92b75f5f66d3ec43dabf6c59a1b7a8abce5feb', '5602ff9a5c5f04eec18f94b17d4f6775c695da982ba984bdf60ec5a026374453db2a1c6279531dff', 1616476360),
	(0, 'e2dbea58b189f7a765662337a67a2582d5a1168b575150dd762424640f7293b088fcb45790f04fbc', 'f1d4ce2075be4e30649e30fbb55aa9c3cbd5239cde322f5d7d6b5f97a9671884b989bd67d953cb3a', 1616476369),
	(0, 'c05e9dac85693842a77f9a74be8c5565979e92ca733ebc671e6335f76dca1f255ea0292c32e7692c', '5a682dfda64cb7ea6b116ab0635b3893e1541e5a9b20adead1a04f59f40c96d657ff58372e99afa6', 1616476379),
	(0, '1ea52d3224a25204a832deeb6b30f8c903699f02bbcc70282923710ae8fe7555f1b67f9dc8a27973', 'f0aa748b4af50407f12471f560a4fe79e5866a9573551252b0cc83fc7ff492ae6a852625617edadb', 1616476383),
	(0, 'be0702465c8048d92bf0105e5ec39166420f3bff727de222affa28baa74643b13c85e4468c51d8b1', '21d6d74c742c2fcff7b20338505f787ad0bff2e0ffa690ec5a68731a17e4b6d642080c42c8b38fc9', 1616476387),
	(0, '1327fdab62216eb8e901ddb74ba6c19b5d831053b639f0c4014e3d7089c9d94d0cc105950567d2a8', 'f24ec400608d48fd4032daacfa4c29fd5e3749c33d2675d41b0cc890c8d8797e57691a03e7a506dd', 1616476403),
	(0, '3baffae21fc6f41ffff92f045449b51b96bda7e6058f1d9704447ff16aed613ce402afd8827a9ad2', 'a4c6117883c965216e920687ec67e636790ac5f40cbd04fe3692b1a069094f7dac57bb95c4d4307c', 1616477041),
	(0, '327380966e46d1daff5414eadeeb2f1c6fea1550a18c5598bdf6800800f1c9af18cce2f8f6e46c1c', 'b7985f1e8e45a61eaa9672c5b8cc4fba494e9cf4e344448c5c83de2b235b778b2eb2e5e80e7d2689', 1616478471),
	(0, '9701f80871825bfe7b52f84b35cf5055a889a320077560300c12191bfb85ab9d302cdf9337b2c768', '1a2afe60d78c54e2cbf66a0048d66d7f6585e452e8c85304de3b2754b3b98e0bf9c88298bbc15993', 1616479389),
	(0, 'bd9e9c638b4555e2cce6e473a10d41ac4f7948f274e2538351484dd9ee559fcd7e3cdd5c80ffea5c', 'a40a59c004c3607fc1d095305ccfa37aa5a661befdca566191cfdacc1eafcda47785177be3bef0ce', 1616479423),
	(0, 'c19a0cb0233ab0cf4ccd5979c1d2deb476c61b766758ecff7c2a2dc95faad31f50202da295ba4acb', '78d414efae6545f946152694118695bdf44d1132a45086cb003d9a8c4a5d811445bd2cf937d7e856', 1616479436),
	(0, 'c72163077179f8d486c18a93fe431ae52fceb96d2ad327dac44072aa690adeffc05787e1a7dfa304', 'ff4d9e12351ec5ad63a839b3f6020b0c543fef36b9a46a81c27e247e98a35c9acf41733fc68acc00', 1616479439),
	(0, 'e7b9870e991418f6cd4f7bf091de903e2910a3ca8c9d6f53e5f80d6683cdd37e071f401f1f32b6a6', 'd184aefc75ef9efa95da7ffff80b0eeb1f2e7d1602181afcf290f19587f80c3eb1ae6dbf8b98bdee', 1616479442),
	(0, 'e73101179958c87f9792868bf84645ed1f6a6aeca5d2cd23c829896027fa5a377eacda51d86f1012', '8ac1eeb7b302aefbab8363669faa261de3f5531a132e7468088a9a7e1bed7cc30cd65478123c4d06', 1616479450),
	(0, 'c7e5a169ecb0380414e9e3cdc38038de3bf3d7ae3d32d22a58e3a2023d10809103cf21f8507e423b', '58189d78e45289e25bd0dfcbb6950ee34decf2c658e1b5070260bcd2b0785e8564a5f2fd42590f64', 1616479468),
	(0, 'eea1c3511e6b47d9a0f87f3ca485f7d6cb063407ce2aaba26f06853679b2cc4fc046ea7281fec10c', '0d999ef3ee7713e4fe9ef1cf2636b861c23d32a70b79097caef439fc252e893a084d47769512164a', 1616479854),
	(0, '1be2a79822749391eb7f942c79e6d9a83432afa60b0163bd4c0cc24a6cd4ded93aa5b33f01a6bb1d', '8231a86645fe7844de37d1d2b5986647ccb0efdf28719dc20939f49fdf5d01b1be7217b1ea579bce', 1616479856),
	(0, 'a267fe78fb95afaf811822793000234c68e657beb70950e509f98c006df76f3ecafc97f9d891238e', 'cad2c43e8e301aaa173ce96dd2d95b71c9a1f106512f9e38c179effa2d42aea530834a8b74086ec7', 1616481139),
	(0, '4c3a553a633b2f8e55394ee4fa2188ccefb1f07fa7f794644cef1adffeaa37c15eb1734179b1eabc', 'd31105e9d64d9c44c530e4919b37c775c1b00d1cbdd32650c565dc8e3a4d279c0eb6e939a733f7af', 1616481171),
	(0, '9dba9f894ce85e40036a12ff9081ecfb063a6ba67035c008eebe82d233323b19cc57c543608ed400', 'bd272ead2e800d0bdd217d501b896ccefa89f3ea1e6098174d85106fa47059b57a79d9550a88324d', 1616481409),
	(0, '4e09f505de7e1de575d5f0ee419779dbfb694ba81009ace15b8e70739105d3517f37516594181cf7', 'e709488efec359b590b6fcdefd5b3652e9bdfb1eb12268709b96c2e05d7a2b706129599b707a4057', 1616481536),
	(0, '411da6f27a0929393977d565fb0d1184db975d37d1ac9658fdd6c880f9e7ea03225cd6c042e4a9f7', '6e39ec738ee6468be5959a386e519c8045367e1fbb5da1fd3c78c223bad2e17c6a6a9dc8464347dd', 1616486146),
	(0, 'ff5803a1f48664ad1395fc1c6652d552d5f3fd268142d9b78dc25475d7388378f4dbc89005258aa8', '90b52d6cda0c5247d728694101ce23963bc1771a949950e83d7c9092330cc056381ffed7bd075df2', 1616487118),
	(0, 'abdded6bb2cab7b46a4039804b5c396ebf45238bed8c1be008bc016c5db661bc96f30354e222dcba', 'ac4d83b9d56e2c88e4ad0a98ba8177acad3754814fa03b89c5fa7cf8c8c272b0768f7bc2376dabb0', 1616487236),
	(0, '5cfe6833fd10d9f20e0be3c88280b32eacc193ca4c3ebc345d49d2b223eab609f129e42cc2ff20b7', '685559b6882df288f96a612b06bdd6343832f6f352c69cfb8fdd566fa15ba75d7e74a55a8b5d8ab4', 1616489492),
	(0, '3fa406c0dfbd2e04bc5ffbff47c741303ee3945fed6afdd047bccc8451f21f2bdc6dddf7a09c7ac0', '47ef7674d059eedfee4ee09da57a21f5416ed57ed5085891df15056ceaeaf94988168e56f944edea', 1616492313),
	(0, '2d56f6bc86b3501d9ea3d6644e4bbf631c0bfa8b1d79bc4dc55031ede50536cdb41109fef5218cd8', '3fcd90440b745178fb847a357ba7271f6d1f527af48ce0244dbf34f981ef6722b02a0f44b8f3df27', 1616492544),
	(0, '3ee0fef88f062325f51e862906e8f0315ed0d41ad4edc07500447cd1ac19b87fe49637889bccfd8a', '9babb6c13ff5ff4029918946e3e93c5bac2c67c3b54c6dfb6aeeb2b19df7552dd7bfc28a1e0c147e', 1616492778),
	(0, '24a43d126e0bddaf9917fc0335cb5a43b8b736e9a758f333c64829c6dbee3a7954aa90b3f2a0c39d', '782a42218b6e72bc7544e2bc275f1b8112c541ee0bd8131049a5e1b0084bccf50e26094f39c2bee7', 1616492948),
	(0, 'b248a5c73a58684fa63ae3ce29718fb1f89b2d74ddcfacced764a4af2d02c2ae3bf6349915bd1075', '98d80082d750fe9205dc185bdc4891ac2d1f474b4cc955397ef1b7e41b62b56452931bef20843a35', 1616493005),
	(0, '5f8970b8ddde462b3b9fc4e106a2d57db4bb274c24deb8e683d33a9b252f44a7af1faf85fc8cec39', '74c0bd8d0e9235dca1f660b172724a90b7ec8f4c4013c2ca8d25bec658ea4b83c01e99bce883266e', 1616493006),
	(0, '49b863325ef754d53ee4077ea4bb7bd9554f4b3107eba8d7ceded3d613ca23b636d4fd95d614debf', '6860e2067aa378c26265ab40c22324fd63ece21c1923f253b287ed6a6b98a1a1c7319f73ca7367e1', 1616493029),
	(0, '461fd261ee6cbf0f504f672d6dbe409ff4d3fc98101a3497ab40bc3d4681466aa34fd20ea0a216f2', 'e8a4f5f5c009029adb5cb9a20a42584e22e1a919928f9a0142f7c03b0cfb9a863ebab70908166de6', 1616493031),
	(0, 'd39db237923a3a08519fa6721cf0c9b44c21e0fe01ea1b249024adbd9e69c7448d9e82fd394c5800', '7522935743fcb433e77ecd0027e6e2199937bdf1c79b560f1290eda94dd1fd6198d257d949747bc1', 1616493036),
	(0, '63887589a155323d544709a6798260d4fe7b8a68a983369897fed831582698d51948eac3e7065d57', 'c72cc0dde8404fee10f218eceddcc005d52f9bc330542bb3bcde03cadd31b9a29c311384377764b6', 1616493038),
	(0, 'ae82c6d084868057356281f1d6f9a42504c863cff9ecabe67509d36de09102b7adca8cff1966634d', '1830d3c5834e11914082d82d9c6a1a2f4ce165fb5a78a3f41017787bfd19f614e639b756236f8fba', 1616493050),
	(0, 'f53c1b625b05a0d2d378870b1424c305f26d86bfbb2d8508e7128c2c299b480b9b1037d2eb722fe5', 'fe466ccb43ad699c3984949a736e1ab28ad84ef8eb81fb76d6da83efe6ecdaf1002ed45b6a922c06', 1616493052),
	(0, '6bdb0440ebb8ec65e671af1989c5da75a84801f3c3d293d608ba842f8310af1ca3df01bd56a13191', '6126f595b9eed65606f7f975cb417ebcbf1e82246da92d341a1d7704be3bbfe2eeb7b4f6eb9a0c3c', 1616493054),
	(0, '1d5931a1f887159088964246aa7c3193b68f7607accc426ca66b70d4b3bdc3c44d618eadeb5cda3b', '350faf94f952ad589cf68484da256d6faa26cbcffe240aa585a88ddb20d6990f772430f415bf6871', 1616493074),
	(0, 'e6c876027fb4c47f00cf03ce519478767330e2ad5e92ec645c3970b7e54e45a40147b70e29bd1529', 'efaff2ad69ef2bc34bff0cafa45b40528b6f4d55c79b3f2c46d142a1b3016361c0ae8b7f6fd6b5f4', 1616493113),
	(0, '518eb17278f75ad8f840de38fa806619ac70483ccf51f440269cc361c76f08a535d1da629693ca55', 'a1daab99be5cdd25a6e92e084c732ef7e53ef567ddb5e493d70303907a5397335a1d7a835da0ae86', 1616493131),
	(0, '544c9ffcbb474935e5284164dcea34c4d49ea5b8f4210cf3c236fb6353d2573afeec7a277d837525', 'f634a33e212b724f00c2f49627761a7d4cfb140dda6f8cc80c31a2b75d24e690e3ea7efb4ea46565', 1616493145),
	(0, 'f88a913b438bdc434627c6bc7561abb989d0035567c54997f76aad202b04135c9a022894e7fc3b41', '3cfa3141888195a3f55f4132d2a9e9f82aef6e449edfee1f5bf4640057c98a244196409606aaf37f', 1616493154),
	(0, '84b7edf3118dda71400727bf2be230996e48e406b64ab29a1508cf1f21ee53ecad60d3ed313a9432', '3120c9f11acc2f0f9d6b5c902eecd857a5bfdebad452fdc9c3f59663356e29779b4fdc293a19d887', 1616493377),
	(0, 'aef2f4bbde247ddf59143edb7b8e0050a0b04b58971c6a8ca11f9cebf96c9b26b6566435f1bba534', '9974dc0e48d874b9b9f0b7df63485cf4c34004072ca2b338a98978737ad31fa4f112fd9478fb3245', 1616493428),
	(0, 'f58202779c07b69a0f39acdc6bb003ad0af55be5408665348169a965db692809b46058777d498291', '1298c089263f5cce60676cefc51d201ed6a8cc74852cd0e95bdce6fdf7f7e86b854896942e02787a', 1616493432),
	(0, '6eed42e48bc8c731a59bf448524fbb48d9a0e4e8601b49d8ed748569ea7052c3fe1e529e14531d39', '877b9a3b988370ae7cf66896a453298451ec1cb4b410ba9a2edfc7fd06368df96fa56f2833d52961', 1616493753),
	(0, '8946620f1a22718adb2a97568b279007f56dec6eaf1a520fb8fe907eedcf9a45eff884125382f72b', '6f7371055c0cfbd0eec0da648a613ae43f8a1356f9657ef65e0a650ea9d08b18c3d98458eadc9b8d', 1616493789),
	(0, '892901fb8a0d4f5c25fac9d9ced8e71e0e8623229cd9232ff10fc318c86340f17ce4117bdab08657', 'b4776963db107e99a449a3044443510083e5aff776bae66dd204dac5abbb13434a8b62902436ac45', 1616493829),
	(0, 'a9b72160828f3ab9be2c54d2724c59eca399cd3aa7d4d92c5cc3ab7169aa09fe9703f52d655850dc', '96c89b722751c4d20270888fc5df81dc5805219692ef4a4ed4ead6bb5b2dd21c8b2f92c444139e3d', 1616493920),
	(0, 'ad71ab5184b22a1c274b3fb242a5fcde8f0f44fc18f22239b509d0caced9c7aed73a8f2b7f097499', '53ab8a319b8be0e1247c5a559decfc41e784a858f245957a9ca94f826991b793e49481965fa0c428', 1616493923),
	(0, 'ddc446998caf346663252f5e113e6413ec71bad7646325e4d6c536b734375bcb6ec374805977f9ea', 'dd08da34dcb9d914a5da020f40f6ca9bce8b44d4a499be6e1685aa5d38abde22cd13a0be0d1e72a5', 1616493944);
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table think2.oauth_scopes
CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.oauth_scopes: ~2 rows (大约)
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
INSERT INTO `oauth_scopes` (`scope_id`, `description`) VALUES
	('photos', '查看图片'),
	('get_user_info', '获取用户信息');
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;

-- Dumping structure for table think2.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.role: ~2 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `title`, `status`, `create_time`, `update_time`) VALUES
	(7, '普通超管组', 1, 1612939329, 1613547896),
	(8, '高级管理员', 1, 1613546245, 1613546245);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table think2.role_action
CREATE TABLE IF NOT EXISTS `role_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.role_action: ~23 rows (大约)
/*!40000 ALTER TABLE `role_action` DISABLE KEYS */;
INSERT INTO `role_action` (`id`, `role_id`, `menu_action_id`) VALUES
	(43, 7, 1),
	(44, 7, 2),
	(45, 7, 8),
	(46, 7, 9),
	(47, 7, 3),
	(48, 7, 4),
	(49, 7, 13),
	(81, 8, 1),
	(82, 8, 2),
	(83, 8, 8),
	(84, 8, 9),
	(85, 8, 10),
	(86, 8, 11),
	(87, 8, 3),
	(88, 8, 4),
	(89, 8, 5),
	(90, 8, 6),
	(91, 8, 7),
	(92, 8, 15),
	(93, 8, 14),
	(94, 8, 13),
	(95, 8, 12),
	(96, 8, 16);
/*!40000 ALTER TABLE `role_action` ENABLE KEYS */;

-- Dumping structure for table think2.rules
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) DEFAULT NULL,
  `v0` varchar(255) DEFAULT NULL,
  `v1` varchar(255) DEFAULT NULL,
  `v2` varchar(255) DEFAULT NULL,
  `v3` varchar(255) DEFAULT NULL,
  `v4` varchar(255) DEFAULT NULL,
  `v5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Dumping data for table think2.rules: ~25 rows (大约)
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES
	(8, 'p', '7', 'Analysis', 'View', NULL, NULL, NULL),
	(9, 'p', '7', 'Workspace', 'View', NULL, NULL, NULL),
	(10, 'p', '7', 'Role', 'View', NULL, NULL, NULL),
	(11, 'p', '7', 'Role', 'List', NULL, NULL, NULL),
	(12, 'p', '7', 'Menu', 'List', NULL, NULL, NULL),
	(13, 'p', '7', 'Menu', 'Info', NULL, NULL, NULL),
	(14, 'p', '7', 'Account', 'List', NULL, NULL, NULL),
	(32, 'g', '1234', '7', NULL, NULL, NULL, NULL),
	(33, 'g', '1234', '8', NULL, NULL, NULL, NULL),
	(49, 'p', '8', 'Analysis', 'View', NULL, NULL, NULL),
	(50, 'p', '8', 'Workspace', 'View', NULL, NULL, NULL),
	(51, 'p', '8', 'Role', 'View', NULL, NULL, NULL),
	(52, 'p', '8', 'Role', 'List', NULL, NULL, NULL),
	(53, 'p', '8', 'Role', 'Create', NULL, NULL, NULL),
	(54, 'p', '8', 'Role', 'Update', NULL, NULL, NULL),
	(55, 'p', '8', 'Role', 'Delete', NULL, NULL, NULL),
	(56, 'p', '8', 'Menu', 'List', NULL, NULL, NULL),
	(57, 'p', '8', 'Menu', 'Info', NULL, NULL, NULL),
	(58, 'p', '8', 'Menu', 'Update', NULL, NULL, NULL),
	(59, 'p', '8', 'Menu', 'Delete', NULL, NULL, NULL),
	(60, 'p', '8', 'CreateAccount', 'Save', NULL, NULL, NULL),
	(61, 'p', '8', 'Account', 'List', NULL, NULL, NULL),
	(62, 'p', '8', 'CreateRole', 'Save', NULL, NULL, NULL),
	(63, 'p', '8', 'UpdateRole', 'Save', NULL, NULL, NULL),
	(64, 'p', '8', 'UpdateAccount', 'Save', NULL, NULL, NULL);
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;

-- Dumping structure for table think2.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户唯一标识（登录名）',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `dept_id` int(11) NOT NULL DEFAULT '3' COMMENT '部门标识',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `allowed_grant_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'authorization_code',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think2.user: ~3 rows (大约)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `allowed_grant_types`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'admin', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', 'admin', 0, 1, 'storage/topic/avatar.png', 'SeratiMa@aliyun.com', 'authorization_code', 1589699902, 1613543684, 0),
	(3, 'test', '$2y$10$QPI203ILGnMlCbC16hWUye8DJRJXIby7EDW2yJE5MrPw6IL3vEb/m', '测试', 4, 1, '', '', 'authorization_code', 1593931035, 1593931035, 0),
	(10, '1234', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', '1234', 3, 1, '', '', 'authorization_code', 1613548328, 1613548372, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
