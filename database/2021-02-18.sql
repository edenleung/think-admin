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

-- Dumping structure for table think.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.dept: ~3 rows (大约)
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` (`id`, `title`, `pid`, `status`, `create_time`, `update_time`) VALUES
	(1, 'Ant Design', 0, 1, 1612940363, 1612940363),
	(2, '深圳分部', 1, 1, 1612940363, 1612940363),
	(3, '设计部', 2, 1, 1612940363, 1612940363),
	(4, '程序部', 2, 1, 1612940363, 1612940363);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;

-- Dumping structure for table think.menu
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
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table think.menu: ~15 rows (大约)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`, `blank`, `delete_time`) VALUES
	(1, 'Index', '首页', 0, 'path', 1, '/', '/dashboard', 'BasicLayout', 'smile-o', '', 0, 0, 0, 0, 0),
	(2, 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/workplace', 'RouteView', 'smile-o', 'Analysis,Workspace', 0, 0, 0, 0, 0),
	(3, 'Analysis', '分析页', 2, 'menu', 1, '/dashboard/analysis', '', 'Analysis', 'smile-o', 'Analysis', 0, 0, 0, 0, 0),
	(4, 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', 'Workplace', 'smile-o', 'Workspace', 0, 0, 0, 0, 0),
	(5, 'System', '系统管理', 1, 'path', 1, '/system', '/system/menu', 'PageView', 'smile-o', 'Menu,Dept,RoleManage', 0, 0, 0, 0, 0),
	(6, 'Menu', '菜单管理', 5, 'menu', 1, '/system/menu', '', 'Menu', 'smile-o', 'Menu', 0, 0, 0, 0, 0),
	(7, 'Role', '角色列表', 13, 'menu', 1, '/system/role/list', '', 'Role', 'smile-o', 'Role', 0, 0, 0, 0, 0),
	(8, 'Account', '管理员列表', 17, 'menu', 1, '/system/account/list', '', 'Account', '', '', 0, 0, 0, 0, 0),
	(9, 'Dept', '部门管理', 5, 'menu', 1, '/system/dept', '', 'Dept', 'smile-o', 'Dept', 0, 0, 0, 0, 0),
	(13, 'RoleManage', '角色管理', 5, 'path', 1, '/system/role', '/system/role/list', 'RouteView', 'smile-o', 'Role,UpdateRole', 0, 0, 1, 0, 0),
	(14, 'UpdateRole', '更新角色', 13, 'menu', 1, '/system/role/:id/update', '', 'RoleForm', '', 'UpdateRole', 0, 1, 0, 0, 0),
	(15, 'CreateRole', '创建角色', 13, 'menu', 1, '/system/role/create', '', 'RoleForm', '', 'CreateRole', 0, 1, 0, 0, 0),
	(16, 'CreateAccount', '创建管理员', 17, 'menu', 1, '/system/account/create', '', 'AccountForm', '', '', 0, 1, 0, 0, 0),
	(17, 'AccountManage', '管理员管理', 5, 'path', 1, '/system/account', '/system/account/list', 'RouteView', 'smile-o', 'Account,CreateAccount,UpdateAccount', 0, 0, 1, 0, 0),
	(18, 'UpdateAccount', '更新管理员', 17, 'menu', 1, '/system/account/:id/update', '', 'AccountForm', '', '', 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table think.menu_action
CREATE TABLE IF NOT EXISTS `menu_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.menu_action: ~24 rows (大约)
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
	(17, 'Create', '新增', 6, 1614093171, 1614093171, 0),
	(18, 'List', '列表', 9, 1614093198, 1614093198, 0),
	(19, 'Update', '修改', 9, 1614093212, 1614093212, 0),
	(20, 'Delete', '删除', 9, 1614093223, 1614093223, 0),
	(21, 'Create', '新增', 9, 1614093245, 1614093245, 0),
	(22, 'Create', '新增', 8, 1614093276, 1614093276, 0),
	(23, 'Update', '修改', 8, 1614093293, 1614093293, 0),
	(24, 'Delete', '删除', 8, 1614093308, 1614093308, 0);
/*!40000 ALTER TABLE `menu_action` ENABLE KEYS */;

-- Dumping structure for table think.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_access_tokens: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table think.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `auth_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_auth_codes: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
INSERT INTO `oauth_auth_codes` (`client_id`, `user_id`, `scope`, `revoked`, `auth_code`, `expires`) VALUES
	('123456', NULL, '1234', 0, 'ca0df06d97f319e43714952d0ebb50bac4d5d883dfeb2d1cb5a97a2ebad1063276ff09f6a4a19906', 1613663429);
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table think.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grant_types` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_clients: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table think.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `revoked` tinyint(1) DEFAULT '0',
  `refresh_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_refresh_tokens: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table think.oauth_scopes
CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_scopes: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;

-- Dumping structure for table think.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role: ~3 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `title`, `status`) VALUES
	(7, '普通超管组', 1),
	(8, '高级管理员', 1),
	(9, '游客', 1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table think.role_action
CREATE TABLE IF NOT EXISTS `role_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role_action: ~27 rows (大约)
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
	(96, 8, 16),
	(99, 9, 1),
	(100, 9, 2),
	(101, 9, 8),
	(102, 9, 17);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table think.rules: ~4 rows (大约)
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES
	(4, 'p', '9', 'Analysis', 'View', NULL, NULL, NULL),
	(5, 'p', '9', 'Workspace', 'View', NULL, NULL, NULL),
	(6, 'p', '9', 'Menu', 'List', NULL, NULL, NULL),
	(7, 'p', '9', 'Menu', 'Create', NULL, NULL, NULL),
	(8, 'g', 'visitor', '9', NULL, NULL, NULL, NULL);
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
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user: ~2 rows (大约)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `allowed_grant_types`, `delete_time`) VALUES
	(1, 'admin', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', 'admin', 0, 1, 'storage/topic/avatar.png', 'SeratiMa@aliyun.com', 'authorization_code', 0),
	(11, 'visitor', '$2y$10$eLnM2CF/S1oRE.kUkBqWU.LFz0Srisb1tEey94o4Ad8HzRmOdZygO', 'visitor', 3, 1, '', '', 'authorization_code', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
