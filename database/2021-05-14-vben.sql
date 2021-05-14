-- --------------------------------------------------------
-- 主机:                           106.52.123.45
-- 服务器版本:                        5.7.33 - MySQL Community Server (GPL)
-- 服务器OS:                        Linux
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table think.article
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章表';

-- Dumping data for table think.article: ~3 rows (大约)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `title`, `image`, `article_category_id`, `content`, `top`, `sort`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'abc', 'storage/topic/20210301\\6906862ce43bdce3991e0054431992c6.jpg', 4, '<p>9090</p>', 0, 0, 1, 1614566767, 1619427934, 0),
	(2, 'def', 'storage/topic/20210408/bf43d9b81d95fb39d307e5e21027d139.jpg', 4, '<p><span style="font-weight: bold;">d<span style="color: rgb(123, 91, 161);">d</span>d</span></p>', 0, 0, 1, 1617851471, 1618198944, 0),
	(3, 'test', 'storage/topic/20210426/12cdfbad047aa7582c2b84152a318320.jpeg', 4, '<p>sdada</p>', 1, 0, 1, 1619427927, 1619427927, 0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table think.article_category
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `disable` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.article_category: ~3 rows (大约)
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` (`id`, `title`, `pid`, `disable`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '顶级分类', 0, 0, 1612940363, 1612940363, 0),
	(4, '分类一', 1, 0, 1614566307, 1614566307, 0),
	(5, '1111', 4, 1, 1619422162, 1619422165, 1619422165);
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;

-- Dumping structure for table think.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.dept: ~5 rows (大约)
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` (`id`, `title`, `pid`, `status`, `sort`, `create_time`, `update_time`) VALUES
	(1, 'Ant Design', 10, 1, 1, 1612940363, 1612940363),
	(3, '设计部', 7, 1, 1, 1612940363, 1612940363),
	(4, '程序部', 7, 1, 1, 1612940363, 1612940363),
	(7, '华南分部', 0, 1, 1, 0, 0),
	(8, '1234', 7, 1, 1234, 1620723861, 1620724237);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;

-- Dumping structure for table think.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '路由名称|资源名称',
  `title` varchar(100) NOT NULL COMMENT '菜单名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `type` varchar(6) NOT NULL COMMENT '类别 1 目录 2 菜单',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 隐藏',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT 'path',
  `redirect` varchar(100) NOT NULL DEFAULT '' COMMENT 'redirect',
  `component` varchar(100) NOT NULL DEFAULT '' COMMENT 'component',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT 'icon',
  `permission` varchar(100) DEFAULT NULL COMMENT 'permission',
  `keepAlive` int(11) NOT NULL DEFAULT '0' COMMENT 'keepAlive',
  `hidden` int(11) NOT NULL DEFAULT '0' COMMENT 'hidden',
  `hideChildrenInMenu` int(11) NOT NULL DEFAULT '0' COMMENT 'hideChildrenInMenu',
  `blank` int(11) NOT NULL DEFAULT '0' COMMENT 'blank 1 外部链接 0 默认内部',
  `sort` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Dumping data for table think.menu: ~9 rows (大约)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`, `blank`, `sort`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Index', '首页', 0, 'path', 1, '/', '/dashboard', 'LAYOUT', 'smile0', NULL, 0, 0, 0, 0, 0, 0, 1618373462, 0),
	(2, 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/analysis', 'LAYOUT', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(3, 'Analysis', '分析页', 2, 'menu', 1, '/dashboard/analysis', '', '/dashboard/analysis/index', 'smile-o', NULL, 0, 0, 0, 0, 0, 0, 0, 0),
	(4, 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', '/dashboard/workbench/index', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'System', '系统管理', 1, 'path', 1, '/system', '/system/menu', 'LAYOUT', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Menu', '菜单管理', 5, 'menu', 1, '/system/menu', '', '/demo/system/menu/index', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(7, 'Role', '角色管理', 5, 'menu', 1, '/system/role/list', '', '/demo/system/role/index', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Account', '用户管理', 5, 'menu', 1, '/system/account/list', '', '/demo/system/account/index', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'Dept', '部门管理', 5, 'menu', 1, '/system/dept', '', '/demo/system/dept/index', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table think.menu_action
CREATE TABLE IF NOT EXISTS `menu_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.menu_action: ~36 rows (大约)
/*!40000 ALTER TABLE `menu_action` DISABLE KEYS */;
INSERT INTO `menu_action` (`id`, `name`, `title`, `menu_id`, `sort`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'View', '详情', 3, 0, 0, 1620705259, 1620705259),
	(2, 'View', '详情', 4, 0, 0, 0, 0),
	(3, 'View', '详情', 7, 0, 0, 1620704239, 0),
	(4, 'List', '列表', 7, 0, 0, 0, 0),
	(5, 'Create', '创建', 7, 0, 0, 0, 0),
	(6, 'Update', '更新', 7, 0, 0, 0, 0),
	(7, 'Delete', '删除', 7, 0, 0, 0, 0),
	(8, 'List', '列表', 6, 0, 1612938348, 1612938348, 0),
	(9, 'Info', '详情', 6, 0, 1612938363, 1612938363, 0),
	(10, 'Update', '修改', 6, 0, 1612938386, 1612938386, 0),
	(11, 'Delete', '删除', 6, 0, 1612938396, 1618480321, 1618480321),
	(12, 'Save', '保存', 16, 0, 1613542061, 1613542061, 0),
	(13, 'List', '列表', 8, 0, 1613542183, 1613542183, 0),
	(14, 'Save', '保存', 15, 0, 1613546258, 1613546258, 0),
	(15, 'Save', '保存', 14, 0, 1613546271, 1613546271, 0),
	(16, 'Save', '保存', 18, 0, 1613546286, 1613546286, 0),
	(17, 'List', '列表', 20, 0, 1614562996, 1614562996, 0),
	(18, 'Create', '新增', 20, 0, 1614563009, 1614563009, 0),
	(20, 'Delete', '删除', 20, 0, 1614563038, 1614563038, 0),
	(21, 'List', '列表', 21, 0, 1614563065, 1614563065, 0),
	(22, 'Create', '新增', 21, 0, 1614563088, 1614563088, 0),
	(23, 'Update', '修改', 21, 0, 1614563099, 1614563099, 0),
	(24, 'Delete', '删除', 21, 0, 1614563119, 1614563119, 0),
	(25, 'Update', '修改', 20, 0, 1614563144, 1614563144, 0),
	(26, 'Save', '保存', 22, 0, 1614563324, 1614563324, 0),
	(27, 'Save', '保存', 23, 0, 1614563415, 1614563415, 0),
	(28, 'List', '列表', 9, 0, 1615014392, 1615014392, 0),
	(29, 'Update', '修改', 9, 0, 1615014409, 1618480314, 1618480314),
	(30, 'Delete', '删除', 9, 0, 1615014423, 1615014423, 0),
	(31, 'Create', '新增', 6, 0, 1615015052, 1615015052, 0),
	(32, 'SaveProfile', '更新信息', 27, 0, 1615016065, 1615016065, 0),
	(33, 'SaveAvatar', '更新头像', 27, 0, 1615016094, 1615016094, 0),
	(34, 'UpdateSecurityPassword', '更新密码', 28, 0, 1615016179, 1615016179, 0),
	(35, 'aaa', 'aaa', 30, 0, 1619509477, 1619509477, 0),
	(36, '1234', '56', 33, 0, 1620703667, 1620703667, 0),
	(37, 'View', '详情', 3, 0, 1620705184, 1620705346, 0);
/*!40000 ALTER TABLE `menu_action` ENABLE KEYS */;

-- Dumping structure for table think.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role: ~3 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `title`, `status`, `create_time`, `update_time`) VALUES
	(9, 'ceshi', 1, 1619090073, 1619090073),
	(10, 'c', 1, 0, 0),
	(11, '1342', 1, 1620628640, 1620628640);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table think.role_action
CREATE TABLE IF NOT EXISTS `role_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role_action: ~12 rows (大约)
/*!40000 ALTER TABLE `role_action` DISABLE KEYS */;
INSERT INTO `role_action` (`id`, `role_id`, `menu_action_id`) VALUES
	(190, 9, 1),
	(191, 9, 17),
	(192, 9, 18),
	(193, 9, 25),
	(194, 9, 21),
	(195, 9, 22),
	(196, 9, 23),
	(197, 9, 24),
	(198, 9, 26),
	(199, 9, 27),
	(200, 11, 1),
	(201, 11, 2);
/*!40000 ALTER TABLE `role_action` ENABLE KEYS */;

-- Dumping structure for table think.rules
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
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;

-- Dumping data for table think.rules: ~59 rows (大约)
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES
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
	(64, 'p', '8', 'UpdateAccount', 'Save', NULL, NULL, NULL),
	(87, 'g', '1234', '7', NULL, NULL, NULL, NULL),
	(88, 'g', '1234', '8', NULL, NULL, NULL, NULL),
	(93, 'p', '7', 'Analysis', 'View', NULL, NULL, NULL),
	(94, 'p', '7', 'Workspace', 'View', NULL, NULL, NULL),
	(95, 'p', '7', 'Menu', 'List', NULL, NULL, NULL),
	(96, 'p', '7', 'Menu', 'Info', NULL, NULL, NULL),
	(97, 'p', '7', 'Menu', 'Update', NULL, NULL, NULL),
	(98, 'p', '7', 'Menu', 'Delete', NULL, NULL, NULL),
	(99, 'p', '7', 'Dept', 'List', NULL, NULL, NULL),
	(100, 'p', '7', 'Dept', 'Update', NULL, NULL, NULL),
	(101, 'p', '7', 'Dept', 'Delete', NULL, NULL, NULL),
	(102, 'p', '7', 'Menu', 'Create', NULL, NULL, NULL),
	(103, 'g', 'admin123', '7', NULL, NULL, NULL, NULL),
	(117, 'g', 'test888', '9', NULL, NULL, NULL, NULL),
	(118, 'g', 'test', '7', NULL, NULL, NULL, NULL),
	(139, 'g', 'hello', '9', NULL, NULL, NULL, NULL),
	(170, 'g', '33', '10', NULL, NULL, NULL, NULL),
	(171, 'g', '33', '9', NULL, NULL, NULL, NULL),
	(172, 'g', '1324', '10', NULL, NULL, NULL, NULL),
	(173, 'g', '1324', '9', NULL, NULL, NULL, NULL),
	(176, 'g', 'lida3', '10', NULL, NULL, NULL, NULL),
	(177, 'g', 'lida3', '9', NULL, NULL, NULL, NULL),
	(178, 'g', 'ggc', '10', NULL, NULL, NULL, NULL),
	(179, 'g', 'ggc', '9', NULL, NULL, NULL, NULL),
	(180, 'p', '9', 'Analysis', 'View', NULL, NULL, NULL),
	(181, 'p', '9', 'Article', 'List', NULL, NULL, NULL),
	(182, 'p', '9', 'Article', 'Create', NULL, NULL, NULL),
	(183, 'p', '9', 'ArticleCategory', 'List', NULL, NULL, NULL),
	(184, 'p', '9', 'ArticleCategory', 'Create', NULL, NULL, NULL),
	(185, 'p', '9', 'ArticleCategory', 'Update', NULL, NULL, NULL),
	(186, 'p', '9', 'ArticleCategory', 'Delete', NULL, NULL, NULL),
	(187, 'p', '9', 'Article', 'Update', NULL, NULL, NULL),
	(188, 'p', '9', 'CreateArticle', 'Save', NULL, NULL, NULL),
	(189, 'p', '9', 'UpdateArticle', 'Save', NULL, NULL, NULL),
	(190, 'p', '11', 'Analysis', 'View', NULL, NULL, NULL),
	(191, 'p', '11', 'Workspace', 'View', NULL, NULL, NULL),
	(197, 'p', '12', 'Analysis', 'View', NULL, NULL, NULL),
	(198, 'p', '12', 'Workspace', 'View', NULL, NULL, NULL),
	(199, 'p', '12', 'Article', 'List', NULL, NULL, NULL),
	(200, 'p', '12', 'ArticleCategory', 'List', NULL, NULL, NULL),
	(201, 'p', '12', 'CreateArticle', 'Save', NULL, NULL, NULL),
	(202, 'p', '12', 'UpdateArticle', 'Save', NULL, NULL, NULL),
	(203, 'p', '12', 'test/aaa', 'aaa', NULL, NULL, NULL);
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;

-- Dumping structure for table think.user
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user: ~10 rows (大约)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `allowed_grant_types`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'admin', '$2y$10$jZVblAFfubcFsxYOmOSt7eTXzaAL8.xQqp8eAw42Izm3jmcv0iI1W', 'admin', 0, 1, 'storage/topic/20210422/83730d34b0e9a914b7bd2737174d714b.pem', 'SeratiMa@aliyun.com', 'authorization_code', 1589699902, 1619520089, 0),
	(3, 'test', '$2y$10$PtaVBleq4JvhhoKN56oYCuP9krqAfAvj3gKQx98PNTTCLqoNtgGO6', '测试', 4, 1, '', '', 'authorization_code', 1593931035, 1619339420, 0),
	(10, '1234', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', '1234', 4, 1, '', '', 'authorization_code', 1613548328, 1617801864, 0),
	(11, 'admin123', '$2y$10$csS0o29NyMR2Gy9Npquh.exmFSt1ECv5FRHrD5c/wMahSeJyRV06m', '1113', 4, 1, '', '', 'authorization_code', 1618195840, 1618480292, 0),
	(12, 'lida3', '$2y$10$1Ash2zcZIfFlD/zF76zu7eEMxJd40T421yGT.hrD3aUvr1bNcpYKO', 'da3', 4, 1, '', '', 'authorization_code', 1619090103, 1620553310, 0),
	(13, 'test888', '$2y$10$uKDXOD0Iww.pV4f8RIzIEuEUWipqvwSwaCpfoOog1YcOB9Ho/LEwK', 'zzzz', 4, 1, '', '', 'authorization_code', 1619282780, 1619282780, 0),
	(14, 'hello', '$2y$10$D.QtUi1HhN/XepGnMhgqvOUJYhiMYPxrlA0PnpNzVqnUlgSotvU5W', 'hello', 4, 1, '', '', 'authorization_code', 1619427748, 1619427748, 0),
	(15, '33', '$2y$10$UnD10W6.sy/6Yss4gUe/Mu2AxZRIX.ckvObCBGsAeiOOU.wJHdpeO', '1234', 7, 0, '', '', 'authorization_code', 1620551039, 1620551039, 0),
	(16, '1324', '$2y$10$9PO8w9EC4AlH2bKEPcT9bOAKqURiXnJRDYYIEnEDlOrnSBRS/dTTq', '1234', 7, 0, '', '', 'authorization_code', 1620551541, 1620554301, 1620554301),
	(17, 'ggc', '$2y$10$K0uj2n0zqesuOSNfn8dq5OMpzQfEF5qLYz5waknPTzyorH9d/Ib9y', 'ggc', 7, 0, '', '', 'authorization_code', 1620553073, 1620553666, 1620553666);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
