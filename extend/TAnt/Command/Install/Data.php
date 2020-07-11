<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace TAnt\Command\Install;

class Data
{
    const PERMISSION = [
        [
            'name'     => 'Index', 'title' => '首页', 'pid' => 0, 'status' => 1, 'type' => 'path', 'path' => '/', 'redirect' => '/dashboard/workplace', 'component' => 'BasicLayout', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
            'children' => [
                [
                    'name'     => 'Dashboard', 'title' => '仪表盘', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/dashboard', 'redirect' => '/dashboard/workplace', 'component' => 'RouteView', 'icon' => 'dashboard', 'permission' => 'Analysis,Workspace', 'keepAlive' => 0,  'hidden' => 0, 'hideChildrenInMenu' => 0,
                    'children' => [
                        [
                            'name'     => 'Analysis', 'title' => '分析页', 'pid' => 2, 'status' => 1, 'type' => 'menu', 'path' => '/dashboard/analysis', 'redirect' => '', 'component' => 'Analysis', 'icon' => '', 'permission' => 'Analysis', 'keepAlive' => 0,  'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'AnalysisGet', 'title' => '详情', 'pid' => 3, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'Workspace', 'title' => '工作台', 'pid' => 2, 'status' => 1, 'type' => 'menu', 'path' => '/dashboard/workplace', 'redirect' => '', 'component' => 'Workplace', 'icon' => '', 'permission' => 'Workspace', 'keepAlive' => 0,  'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'WorkspaceGet', 'title' => '详情', 'pid' => 5, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                    ],
                ],
                [
                    'name'     => 'System', 'title' => '系统管理', 'status' => 1, 'pid' => 1, 'type' => 'path', 'path' => '/system', 'redirect' => '/system/permission', 'component' => 'PageView', 'icon' => 'slack', 'permission' => 'Permission,Role,Account,Dept', 'keepAlive' => 0,  'hidden' => 0, 'hideChildrenInMenu' => 0,
                    'children' => [
                        [
                            'name'     => 'Permission', 'title' => '菜单管理', 'pid' => 7, 'status' => 1, 'type' => 'menu', 'path' => '/system/permission', 'redirect' => '', 'component' => 'Permission', 'icon' => '', 'permission' => 'Permission', 'keepAlive' => 0,  'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'PermissionGet', 'title' => '详情', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PermissionAdd', 'title' => '添加', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PermissionUpdate', 'title' => '更新', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PermissionDelete', 'title' => '删除', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'Role', 'title' => '角色管理', 'status' => 1, 'pid' => 7, 'type' => 'menu', 'path' => '/system/role', 'redirect' => '', 'component' => 'Role', 'icon' => '', 'permission' => 'Role', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'RoleGet', 'title' => '详情', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'RoleAdd', 'title' => '添加', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'RoleUpdate', 'title' => '更新', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'RoleDelete', 'title' => '删除', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'Account', 'title' => '管理员管理', 'pid' => 7, 'status' => 1, 'type' => 'menu', 'path' => '/system/user', 'redirect' => '', 'component' => 'Account', 'icon' => '', 'permission' => 'Account', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'AccountGet', 'title' => '详情', 'pid' => 18, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'AccountAdd', 'title' => '添加', 'pid' => 18, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'AccountUpdate', 'title' => '更新', 'pid' => 18, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'AccountDelete', 'title' => '删除', 'pid' => 18, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'Dept', 'title' => '部门管理', 'pid' => 7, 'status' => 1, 'type' => 'menu', 'path' => '/system/Dept', 'redirect' => '', 'component' => 'Dept', 'icon' => '', 'permission' => 'Dept', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'DeptGet', 'title' => '详情', 'pid' => 23, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'DeptAdd', 'title' => '添加', 'pid' => 23, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'DeptUpdate', 'title' => '更新', 'pid' => 23, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'DeptDelete', 'title' => '删除', 'pid' => 23, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'Post', 'title' => '岗位管理', 'status' => 1, 'pid' => 7, 'type' => 'menu', 'path' => '/system/post', 'redirect' => '', 'component' => 'Post', 'icon' => '', 'permission' => 'Post', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'PostGet', 'title' => '详情', 'pid' => 28, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PostAdd', 'title' => '添加', 'pid' => 28, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PostUpdate', 'title' => '更新', 'pid' => 28, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'PostDelete', 'title' => '删除', 'pid' => 28, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                    ],
                ],
                [
                    'name'     => 'Log', 'title' => '日志管理', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/log', 'redirect' => '/log/account', 'component' => 'PageView', 'icon' => 'file-text', 'permission' => 'LogAccount,LogDb', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                    'children' => [
                        [
                            'name'     => 'LogAccount', 'title' => '管理员日志', 'pid' => 33, 'status' => 1, 'type' => 'menu', 'path' => '/log/account', 'redirect' => '', 'component' => 'LogAccount', 'icon' => '', 'permission' => 'LogAccount', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'LogAccountGet', 'title' => '详情', 'pid' => 34, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'LogAccountDelete', 'title' => '删除', 'pid' => 34, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                        [
                            'name'     => 'LogDb', 'title' => '数据库日志', 'pid' => 33, 'status' => 1, 'type' => 'menu', 'path' => '/log/db', 'redirect' => '', 'component' => 'LogDb', 'icon' => '', 'permission' => 'LogDb', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                            'children' => [
                                ['name' => 'LogDbGet', 'title' => '详情', 'pid' => 37, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                ['name' => 'LogDbDelete', 'title' => '删除', 'pid' => 37, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                            ],
                        ],
                    ],
                ],
                [
                    'name'     => 'Profile', 'title' => '个人页', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/account', 'redirect' => '/account/center', 'component' => 'RouteView', 'icon' => 'user', 'permission' => 'BaseSettings,SecuritySettings', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                    'children' => [
                        ['name' => 'ProfileAccount', 'title' => '个人中心', 'pid' => 40, 'status' => 1, 'type' => 'menu', 'path' => '/account/center', 'redirect' => '', 'component' => 'Center', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                        [
                            'name'     => 'ProfileSetting', 'title' => '个人设置', 'pid' => 40, 'status' => 1, 'type' => 'menu', 'path' => '/account/settings', 'redirect' => '/account/settings/base', 'component' => 'Settings', 'icon' => '', 'permission' => 'BaseSettings,SecuritySettings', 'keepAlive' => 0, 'hideChildrenInMenu' => 1, 'hidden' => 0,
                            'children' => [
                                [
                                    'name'     => 'BaseSettings', 'title' => '基本设置', 'pid' => 42, 'status' => 1, 'type' => 'menu', 'path' => '/account/settings/base', 'redirect' => '', 'component' => 'BaseSettings', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                                    'children' => [
                                        ['name' => 'SaveProfile', 'title' => '更新信息', 'pid' => 43, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                        ['name' => 'SaveAvatar', 'title' => '更新头像', 'pid' => 43, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                    ],
                                ],
                                [
                                    'name'     => 'SecuritySettings', 'title' => '安全设置', 'pid' => 42, 'status' => 1, 'type' => 'menu', 'path' => '/account/settings/security', 'redirect' => '', 'component' => 'SecuritySettings', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0,
                                    'children' => [
                                        ['name' => 'UpdateSecurityPassword', 'title' => '更新密码', 'pid' => 46, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0, 'hidden' => 0, 'hideChildrenInMenu' => 0],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    const Dept = [
        ['dept_name' => 'Ant-Design', 'dept_pid' => 0],
        ['dept_name' => '深圳总公司', 'dept_pid' => 1],
        ['dept_name' => '北京总公司', 'dept_pid' => 1],

        ['dept_name' => '设计部', 'dept_pid' => 2],
        ['dept_name' => '运营部', 'dept_pid' => 2],
        ['dept_name' => '研发部', 'dept_pid' => 3],
        ['dept_name' => '销售部', 'dept_pid' => 3],
    ];
}
