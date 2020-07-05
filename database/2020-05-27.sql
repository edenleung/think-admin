-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.30-log - MySQL Community Server (GPL)
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
  `category_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `top` int(11) DEFAULT '0' COMMENT '是否置顶',
  `sort` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1' COMMENT '状态 0 隐藏 1 显示',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章表';

-- Dumping data for table think.article: ~0 rows (大约)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table think.article_category
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `disable` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.article_category: ~2 rows (大约)
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` (`id`, `name`, `pid`, `disable`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, '顶级分类', 0, 0, 1590593923, 1590593923, 0),
	(2, '测试', 1, 0, 1590593923, 1590593923, 0);
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;

-- Dumping structure for table think.db_log
CREATE TABLE IF NOT EXISTS `db_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模型名',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问地址',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `sql` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sql',
  `user_id` int(11) NOT NULL COMMENT '操作员id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.db_log: ~21 rows (大约)
/*!40000 ALTER TABLE `db_log` DISABLE KEYS */;
INSERT INTO `db_log` (`id`, `model`, `url`, `action`, `sql`, `user_id`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Permission', '/admin/permission/31', 'update', 'UPDATE `permission`  SET `name` = \'UpdatePost\' , `title` = \'修改\' , `button_type` = \'Update\' , `update_time` = 1593929051  WHERE (  `id` = 31 ) AND `permission`.`delete_time` = 0', 1, 1593929051, 1593929051, 0),
	(2, 'Permission', '/admin/permission/26', 'update', 'UPDATE `permission`  SET `name` = \'UpdateDept\' , `title` = \'修改\' , `button_type` = \'Update\' , `update_time` = 1593929061  WHERE (  `id` = 26 ) AND `permission`.`delete_time` = 0', 1, 1593929061, 1593929061, 0),
	(3, 'Permission', '/admin/permission', 'insert', 'INSERT INTO `permission` SET `pid` = 13 , `type` = \'action\' , `action_type` = 2 , `title` = \'编辑数据权限\' , `name` = \'UpdateRoleAccess\' , `status` = 1 , `create_time` = 1593929218 , `update_time` = 1593929218', 1, 1593929218, 1593929218, 0),
	(4, 'Role', '/admin/role', 'insert', 'INSERT INTO `role` SET `pid` = 1 , `name` = \'test\' , `title` = \'普通分组 只有查看权限\' , `status` = 1 , `create_time` = 1593930146 , `update_time` = 1593930146', 1, 1593930146, 1593930146, 0),
	(5, 'Permission', '/admin/permission/75', 'update', 'UPDATE `permission`  SET `title` = \'列表2\' , `update_time` = 1593930180  WHERE (  `id` = 75 ) AND `permission`.`delete_time` = 0', 1, 1593930180, 1593930180, 0),
	(6, 'Permission', '/admin/permission/75', 'update', 'UPDATE `permission`  SET `name` = \'FetchAccount2\' , `update_time` = 1593930188  WHERE (  `id` = 75 ) AND `permission`.`delete_time` = 0', 1, 1593930188, 1593930188, 0),
	(7, 'Permission', '/admin/permission/20', 'update', 'UPDATE `permission`  SET `name` = \'FetchAccount\' , `title` = \'列表\' , `button_type` = \'Fetch\' , `update_time` = 1593930200  WHERE (  `id` = 20 ) AND `permission`.`delete_time` = 0', 1, 1593930200, 1593930200, 0),
	(8, 'Permission', '/admin/permission/21', 'update', 'UPDATE `permission`  SET `name` = \'AccountUpdate2\' , `update_time` = 1593930224  WHERE (  `id` = 21 ) AND `permission`.`delete_time` = 0', 1, 1593930224, 1593930224, 0),
	(9, 'Permission', '/admin/permission/22', 'update', 'UPDATE `permission`  SET `name` = \'AccountDelete2\' , `update_time` = 1593930232  WHERE (  `id` = 22 ) AND `permission`.`delete_time` = 0', 1, 1593930232, 1593930232, 0),
	(10, 'Permission', '/admin/permission/21', 'update', 'UPDATE `permission`  SET `name` = \'CreateAccount\' , `title` = \'新增\' , `action_type` = 1 , `button_type` = \'Create\' , `update_time` = 1593930241  WHERE (  `id` = 21 ) AND `permission`.`delete_time` = 0', 1, 1593930241, 1593930241, 0),
	(11, 'Permission', '/admin/permission/22', 'update', 'UPDATE `permission`  SET `name` = \'UpdateAccount\' , `title` = \'修改\' , `action_type` = 1 , `button_type` = \'Update\' , `update_time` = 1593930249  WHERE (  `id` = 22 ) AND `permission`.`delete_time` = 0', 1, 1593930249, 1593930249, 0),
	(12, 'Permission', '/admin/permission/75', 'update', 'UPDATE `permission`  SET `name` = \'DeleteAccount\' , `title` = \'删除\' , `button_type` = \'Delete\' , `update_time` = 1593930257  WHERE (  `id` = 75 ) AND `permission`.`delete_time` = 0', 1, 1593930257, 1593930257, 0),
	(13, 'Role', '/admin/role/3', 'update', 'UPDATE `role`  SET `update_time` = 1593930275  WHERE (  `id` = 3 ) AND `role`.`delete_time` = 0', 1, 1593930275, 1593930275, 0),
	(14, 'Permission', '/admin/permission/19', 'update', 'UPDATE `permission`  SET `permission` = \'Account\' , `update_time` = 1593930375  WHERE (  `id` = 19 ) AND `permission`.`delete_time` = 0', 1, 1593930375, 1593930375, 0),
	(15, 'Permission', '/admin/permission/17', 'update', 'UPDATE `permission`  SET `name` = \'DeleteRole\' , `action_type` = 1 , `button_type` = \'Delete\' , `update_time` = 1593930465  WHERE (  `id` = 17 ) AND `permission`.`delete_time` = 0', 1, 1593930465, 1593930465, 0),
	(16, 'Permission', '/admin/permission/48', 'update', 'UPDATE `permission`  SET `update_time` = 1593930643  WHERE (  `id` = 48 ) AND `permission`.`delete_time` = 0', 1, 1593930643, 1593930643, 0),
	(17, 'Permission', '/admin/permission/49', 'update', 'UPDATE `permission`  SET `permission` = \'UpdateAccountView\' , `update_time` = 1593930651  WHERE (  `id` = 49 ) AND `permission`.`delete_time` = 0', 1, 1593930651, 1593930651, 0),
	(18, 'Permission', '/admin/permission/48', 'update', 'UPDATE `permission`  SET `permission` = \'CreateAccountView\' , `update_time` = 1593930974  WHERE (  `id` = 48 ) AND `permission`.`delete_time` = 0', 1, 1593930974, 1593930974, 0),
	(19, 'User', '/admin/user', 'insert', 'INSERT INTO `user` SET `name` = \'test\' , `nickname` = \'测试\' , `status` = 1 , `dept_id` = 4 , `hash` = \'8anGvp7hT30\' , `password` = \'$2y$10$QPI203ILGnMlCbC16hWUye8DJRJXIby7EDW2yJE5MrPw6IL3vEb/m\' , `create_time` = 1593931035 , `update_time` = 1593931035', 1, 1593931035, 1593931035, 0),
	(20, 'Permission', '/admin/permission/43', 'update', 'UPDATE `permission`  SET `permission` = \'BaseSettings\' , `update_time` = 1593932353  WHERE (  `id` = 43 ) AND `permission`.`delete_time` = 0', 1, 1593932353, 1593932353, 0),
	(21, 'Permission', '/admin/permission/46', 'update', 'UPDATE `permission`  SET `permission` = \'BaseSettings\' , `update_time` = 1593932359  WHERE (  `id` = 46 ) AND `permission`.`delete_time` = 0', 1, 1593932359, 1593932359, 0);
/*!40000 ALTER TABLE `db_log` ENABLE KEYS */;

-- Dumping structure for table think.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '部门名称',
  `pid` int(11) NOT NULL COMMENT '上级部门',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.dept: ~7 rows (大约)
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` (`id`, `name`, `pid`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Ant-Design', 0, 1, 1590510869, 1590510869, 0),
	(2, '深圳总公司', 1, 1, 1590510869, 1590510869, 0),
	(3, '北京总公司', 1, 1, 1590510869, 1590510869, 0),
	(4, '设计部', 2, 1, 1590510869, 1590510869, 0),
	(5, '运营部', 2, 1, 1590510869, 1590510869, 0),
	(6, '研发部', 3, 1, 1590510869, 1590510869, 0),
	(7, '销售部', 3, 1, 1590510869, 1590510869, 0);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;

-- Dumping structure for table think.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户标识',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问地址',
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问ip',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问者user_agnet',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.log: ~2 rows (大约)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` (`id`, `user_id`, `action`, `url`, `ip`, `user_agent`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 3, '登录', '/admin/auth/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36', 1593931059, 1593931059, 0),
	(2, 1, '登录', '/admin/auth/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36', 1593931867, 1593931867, 0);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table think.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table think.migrations: ~11 rows (大约)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
	(20191217060229, 'Permission', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060230, 'Dept', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060256, 'Role', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060327, 'RolePermissionAccess', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060357, 'User', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060458, 'UserRoleAccess', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060620, 'Log', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20191217060648, 'DbLog', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20200109074431, 'RoleDeptAccess', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20200119055958, 'Post', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0),
	(20200119060019, 'UserPostAccess', '2020-05-17 15:18:22', '2020-05-17 15:18:22', 0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table think.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则名称',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `type` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类别',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'path',
  `redirect` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'redirect',
  `component` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'component',
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'icon',
  `permission` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'permission',
  `keepAlive` int(11) NOT NULL DEFAULT '0' COMMENT 'keepAlive',
  `hidden` int(11) NOT NULL DEFAULT '0' COMMENT 'hidden',
  `hideChildrenInMenu` int(11) NOT NULL DEFAULT '0' COMMENT 'hideChildrenInMenu',
  `action_type` int(11) NOT NULL DEFAULT '0',
  `button_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.permission: ~70 rows (大约)
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`id`, `name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`, `action_type`, `button_type`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Index', '首页', 0, 'path', 1, '/', '/dashboard/workplace', 'BasicLayout', '', '', 0, 0, 0, 0, NULL, 0, 1593875048, 0),
	(2, 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/workplace', 'RouteView', 'dashboard', 'Analysis,Workspace', 0, 0, 0, 0, NULL, 0, 0, 0),
	(3, 'Analysis', '分析页', 2, 'menu', 1, '/dashboard/analysis', '', 'Analysis', '', 'Analysis', 0, 0, 0, 0, NULL, 0, 0, 0),
	(4, 'InfoAnalysis', '详情', 3, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Info', 0, 1593876265, 0),
	(5, 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', 'Workplace', '', 'Workspace', 0, 0, 0, 0, NULL, 0, 0, 0),
	(6, 'InfoWorkspace', '详情', 5, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Info', 0, 1593876276, 0),
	(7, 'System', '系统管理', 1, 'path', 1, '/system', '/system/permission', 'PageView', 'slack', 'Permission,Role,Account,Dept', 0, 0, 0, 0, NULL, 0, 0, 0),
	(8, 'Permission', '菜单管理', 7, 'menu', 1, '/system/permission', '', 'Permission', '', 'Permission', 0, 0, 0, 0, NULL, 0, 0, 0),
	(9, 'FetchPermission', '列表', 8, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593876286, 0),
	(10, 'CreatePermission', '新增', 8, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 0, 1593876297, 0),
	(11, 'UpdatePermission', '修改', 8, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Update', 0, 1593876310, 0),
	(12, 'DeletePermission', '删除', 8, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593876563, 0),
	(13, 'Role', '角色管理', 7, 'menu', 1, '/system/role', '', 'Role', '', 'Role', 0, 0, 0, 0, NULL, 0, 0, 0),
	(14, 'FetchRole', '列表', 13, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593876522, 0),
	(15, 'CreateRole', '新增', 13, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 0, 1593876533, 0),
	(16, 'UpdateRole', '修改', 13, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Update', 0, 1593876552, 0),
	(17, 'DeleteRole', '删除', 13, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593930465, 0),
	(18, 'AccountManager', '管理员管理', 7, 'path', 1, '/system/user', '/system/user/list', 'RouteView', '', '', 0, 0, 1, 0, NULL, 0, 1593927984, 0),
	(19, 'Account', '管理员列表', 18, 'menu', 1, '/system/user/list', '', 'Account', '', 'Account', 0, 0, 0, 0, NULL, 0, 1593930375, 0),
	(20, 'FetchAccount', '列表', 19, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593930200, 0),
	(21, 'CreateAccount', '新增', 19, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 0, 1593930241, 0),
	(22, 'UpdateAccount', '修改', 19, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Update', 0, 1593930249, 0),
	(23, 'Dept', '部门管理', 7, 'menu', 1, '/system/Dept', '', 'Dept', '', 'Dept', 0, 0, 0, 0, NULL, 0, 0, 0),
	(24, 'FetchDept', '列表', 23, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593928144, 0),
	(25, 'CreateDept', '新增', 23, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 0, 1593928222, 0),
	(26, 'UpdateDept', '修改', 23, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Update', 0, 1593929061, 0),
	(27, 'DeleteDept', '删除', 23, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593928304, 0),
	(28, 'Post', '岗位管理', 7, 'menu', 1, '/system/post', '', 'Post', '', 'Post', 0, 0, 0, 0, NULL, 0, 0, 0),
	(29, 'FetchPost', '列表', 28, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593928260, 0),
	(30, 'CreatePost', '新增', 28, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 0, 1593928268, 0),
	(31, 'UpdatePost', '修改', 28, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Update', 0, 1593929051, 0),
	(32, 'DeletePost', '删除', 28, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593928341, 0),
	(33, 'Log', '日志管理', 1, 'path', 1, '/log', '/log/account', 'PageView', 'file-text', 'LogAccount,LogDb', 0, 0, 0, 0, NULL, 0, 0, 0),
	(34, 'LogAccount', '管理员日志', 33, 'menu', 1, '/log/account', '', 'LogAccount', '', 'LogAccount', 0, 0, 0, 0, NULL, 0, 0, 0),
	(35, 'FetchLogAccount', '列表', 34, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593928379, 0),
	(36, 'DeleteLogAccount', '删除', 34, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593928390, 0),
	(37, 'LogDb', '数据库日志', 33, 'menu', 1, '/log/db', '', 'LogDb', '', 'LogDb', 0, 0, 0, 0, NULL, 0, 0, 0),
	(38, 'FetchLogDb', '列表', 37, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 0, 1593928401, 0),
	(39, 'DeleteLogDb', '删除', 37, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 0, 1593928425, 0),
	(40, 'Profile', '个人页', 1, 'path', 1, '/account', '/account/center', 'RouteView', 'user', 'BaseSettings,SecuritySettings', 0, 0, 0, 0, NULL, 0, 0, 0),
	(41, 'ProfileAccount', '个人中心', 40, 'menu', 1, '/account/center', '', 'Center', '', '', 0, 0, 0, 0, NULL, 0, 0, 0),
	(42, 'ProfileSetting', '个人设置', 40, 'menu', 1, '/account/settings', '/account/settings/base', 'Settings', '', 'BaseSettings,SecuritySettings', 0, 0, 1, 0, NULL, 0, 0, 0),
	(43, 'BaseSettings', '基本设置', 42, 'menu', 1, '/account/settings/base', '', 'BaseSettings', '', 'BaseSettings', 0, 0, 0, 0, NULL, 0, 1593932353, 0),
	(44, 'SaveProfile', '更新信息', 43, 'action', 1, '', '', '', '', '', 0, 0, 0, 2, NULL, 0, 1593928517, 0),
	(45, 'SaveAvatar', '更新头像', 43, 'action', 1, '', '', '', '', '', 0, 0, 0, 2, NULL, 0, 1593928524, 0),
	(46, 'SecuritySettings', '安全设置', 42, 'menu', 1, '/account/settings/security', '', 'SecuritySettings', '', 'BaseSettings', 0, 0, 0, 0, NULL, 1590511221, 1593932359, 0),
	(47, 'UpdateSecurityPassword', '更新密码', 46, 'action', 1, '', '', '', '', '', 0, 0, 0, 2, NULL, 0, 1593928532, 0),
	(48, 'CreateAccountView', '创建用户', 18, 'menu', 1, '/user/create', '', 'AccountForm', '', 'CreateAccountView', 0, 1, 0, 0, NULL, 1590589427, 1593930974, 0),
	(49, 'UpdateAccountView', '更新用户', 18, 'menu', 1, '/user/:id/update', '', 'AccountForm', '', 'UpdateAccountView', 0, 1, 0, 0, NULL, 1590590048, 1593930651, 0),
	(50, 'ArticleManager', '文章管理', 1, 'path', 1, '/article', '/article/list', 'PageView', 'smile-o', '', 0, 0, 0, 0, NULL, 1590593923, 1590593975, 0),
	(51, 'Article', '文章列表', 50, 'menu', 1, '/article/list', '', 'Article', '', 'Article', 0, 0, 1, 0, NULL, 1590594018, 1593875062, 0),
	(52, 'CreateArticleView', '创建文章', 50, 'menu', 1, '/article/create', '', 'ArticleForm', '', 'CreateArticleView', 0, 1, 0, 0, NULL, 1590594348, 1593854847, 0),
	(53, 'UpdateArticleView', '更新文章', 50, 'menu', 1, '/article/:id/update', '', 'ArticleForm', '', 'UpdateArticleView', 0, 1, 0, 0, NULL, 1590594384, 1593854857, 0),
	(54, 'ArticeCategory', '分类列表', 50, 'menu', 1, '/article/category', '', 'ArticleCategory', '', '', 0, 0, 0, 0, NULL, 1590594754, 1593928587, 0),
	(55, 'Picture', '图片管理', 1, 'path', 1, '/picture', '/picture/folder', 'RouteView', 'smile-o', '', 0, 0, 0, 0, NULL, 1593834567, 1593928681, 1593928681),
	(56, 'Folder', '文件夹', 55, 'menu', 1, '/picture/floder', '', 'Article', '', '', 0, 0, 0, 0, NULL, 1593834647, 1593928676, 1593928676),
	(69, 'FetchArticle', '列表', 51, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 1593873606, 1593875445, 0),
	(70, 'CreateArticle', '新增', 51, 'action', 1, '', '', '', '', '', 0, 0, 0, 0, NULL, 1593873625, 1593873625, 0),
	(71, 'UpdateArticle', '修改', 51, 'action', 1, '', '', '', '', '', 0, 0, 0, 0, NULL, 1593873660, 1593873660, 0),
	(72, 'DeleteArticle', '删除', 51, 'action', 1, '', '', '', '', '', 0, 0, 0, 0, NULL, 1593873673, 1593873673, 0),
	(73, 'SaveCreateArticleView', '保存', 52, 'action', 1, '', '', '', '', '', 0, 0, 0, 0, NULL, 1593873696, 1593873696, 0),
	(74, 'SaveUpdateArticleView', '保存', 53, 'action', 1, '', '', '', '', '', 0, 0, 0, 0, NULL, 1593873734, 1593873734, 0),
	(75, 'DeleteAccount', '删除', 19, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 1593928021, 1593930257, 0),
	(76, 'SaveCreateAccountView', '保存', 48, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Save', 1593928100, 1593928100, 0),
	(77, 'SaveUpdateAccountView', '保存', 49, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Save', 1593928120, 1593928120, 0),
	(78, 'FetchArticeCategory', '列表', 54, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Fetch', 1593928570, 1593928601, 0),
	(79, 'CreateArticeCategory', '新增', 54, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Create', 1593928623, 1593928623, 0),
	(80, 'SaveArticeCategory', '保存', 54, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Save', 1593928635, 1593928635, 0),
	(81, 'DeleteArticeCategory', '删除', 54, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Delete', 1593928665, 1593928665, 0),
	(82, 'UpdateRoleAccess', '编辑数据权限', 13, 'action', 1, '', '', '', '', '', 0, 0, 0, 2, NULL, 1593929218, 1593929218, 0);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Dumping structure for table think.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '岗位名称',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '岗位标识',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.post: ~0 rows (大约)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table think.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色唯一标识',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `mode` int(11) NOT NULL DEFAULT '3' COMMENT '数据权限类型',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role: ~2 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `title`, `pid`, `mode`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'root', '顶级角色', 0, 0, 1, 0, 0, 0),
	(3, 'test', '普通分组 只有查看权限', 1, 3, 1, 1593930146, 1593930275, 0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table think.role_dept_access
CREATE TABLE IF NOT EXISTS `role_dept_access` (
  `role_id` int(11) NOT NULL COMMENT '角色主键',
  `dept_id` int(11) NOT NULL COMMENT '部门主键',
  PRIMARY KEY (`role_id`,`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role_dept_access: ~0 rows (大约)
/*!40000 ALTER TABLE `role_dept_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_dept_access` ENABLE KEYS */;

-- Dumping structure for table think.role_permission_access
CREATE TABLE IF NOT EXISTS `role_permission_access` (
  `role_id` int(11) NOT NULL COMMENT '角色主键',
  `permission_id` int(11) NOT NULL COMMENT '规则主键',
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role_permission_access: ~11 rows (大约)
/*!40000 ALTER TABLE `role_permission_access` DISABLE KEYS */;
INSERT INTO `role_permission_access` (`role_id`, `permission_id`) VALUES
	(3, 4),
	(3, 6),
	(3, 9),
	(3, 14),
	(3, 20),
	(3, 24),
	(3, 29),
	(3, 35),
	(3, 38),
	(3, 69),
	(3, 78);
/*!40000 ALTER TABLE `role_permission_access` ENABLE KEYS */;

-- Dumping structure for table think.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户唯一标识（登录名）',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `hash` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '加密hash',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `dept_id` int(11) NOT NULL DEFAULT '3' COMMENT '部门标识',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user: ~2 rows (大约)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `password`, `hash`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'admin', '$2y$10$NivWBgBTy8f/Sfghr3Bch.38kDb/WL7cncBF7iLG4f8KumkGQeo56', 'US%qMfOqun4', 'Serati Ma', 0, 1, 'storage/topic/avatar.png', 'SeratiMa@aliyun.com', 1589699902, 1589699902, 0),
	(3, 'test', '$2y$10$QPI203ILGnMlCbC16hWUye8DJRJXIby7EDW2yJE5MrPw6IL3vEb/m', '8anGvp7hT30', '测试', 4, 1, '', '', 1593931035, 1593931035, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table think.user_post_access
CREATE TABLE IF NOT EXISTS `user_post_access` (
  `user_id` int(11) NOT NULL COMMENT '用户主键',
  `post_id` int(11) NOT NULL COMMENT '岗位主键',
  PRIMARY KEY (`user_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user_post_access: ~0 rows (大约)
/*!40000 ALTER TABLE `user_post_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_post_access` ENABLE KEYS */;

-- Dumping structure for table think.user_role_access
CREATE TABLE IF NOT EXISTS `user_role_access` (
  `user_id` int(11) NOT NULL COMMENT '用户主键',
  `role_id` int(11) NOT NULL COMMENT '角色主键',
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user_role_access: ~1 rows (大约)
/*!40000 ALTER TABLE `user_role_access` DISABLE KEYS */;
INSERT INTO `user_role_access` (`user_id`, `role_id`) VALUES
	(3, 3);
/*!40000 ALTER TABLE `user_role_access` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
