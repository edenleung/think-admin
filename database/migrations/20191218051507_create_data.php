<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use think\migration\Migrator;

class CreateData extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $this->createUserData();
        $this->createPermissionData();
        $this->createRoleData();
        $this->createDeptData();
    }

    public function down()
    {
    }

    public function randomKey($len = 11)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~0123456789#$%^&';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 10; ++$i) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     * 创建用户.
     */
    protected function createUserData()
    {
        // 超级管理员
        $default_password = '1234';
        $hash = $this->randomKey();

        $pwd_peppered = hash_hmac('sha256', $default_password, $hash);
        $password = password_hash($pwd_peppered, PASSWORD_DEFAULT);

        $table = $this->table('user');
        $table->insert([
            'name' => 'admin',
            'password' => $password,
            'hash' => $hash,
            'nickname' => 'Serati Ma',
            'email' => 'SeratiMa@aliyun.com',
            'status' => 1,
            'create_time' => time(),
            'update_time' => time(),
            'dept_id' => 0,
            'avatar' => 'storage/topic/avatar.png'
        ]);
        $table->saveData();
    }

    /**
     * 创建规则数据.
     */
    protected function createPermissionData()
    {
        $rows = [
            ['name' => 'Index', 'title' => '根', 'pid' => 0, 'status' => 1, 'type' => 'path', 'path' => '/', 'redirect' => '/dashboard/workplace', 'component' => 'BasicLayout', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'Dashboard', 'title' => '仪表盘', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/dashboard', 'redirect' => '/dashboard/workplace', 'component' => 'RouteView', 'icon' => 'dashboard', 'permission' => 'Analysis,Workspace', 'keepAlive' => 0 ],
            ['name' => 'System', 'title' => '系统管理', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/system', 'redirect' => '/system/permission', 'component' => 'PageView', 'icon' => 'slack', 'permission' => 'Permission,Role,Account,Dept', 'keepAlive' => 0 ],
            ['name' => 'Log', 'title' => '日志管理', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/log', 'redirect' => '/log/account', 'component' => 'PageView', 'icon' => 'file-text', 'permission' => 'LogAccount,LogDb', 'keepAlive' => 0 ],
            ['name' => 'Profile', 'title' => '个人页', 'pid' => 1, 'status' => 1, 'type' => 'path', 'path' => '/account', 'redirect' => '/account/center', 'component' => 'RouteView', 'icon' => 'user', 'permission' => 'ProfileAccount,ProfileSetting', 'keepAlive' => 0 ],
            ['name' => 'Analysis', 'title' => '分析页', 'pid' => 2, 'status' => 1, 'type' => 'menu', 'path' => '/dashboard/analysis', 'redirect' => '', 'component' => 'Analysis', 'icon' => '', 'permission' => 'Analysis', 'keepAlive' => 0 ],
            ['name' => 'Workspace', 'title' => '工作台', 'pid' => 2, 'status' => 1, 'type' => 'menu', 'path' => '/dashboard/workplace', 'redirect' => '', 'component' => 'Workplace', 'icon' => '', 'permission' => 'Workspace', 'keepAlive' => 0 ],
            ['name' => 'Permission', 'title' => '菜单管理', 'pid' => 3, 'status' => 1, 'type' => 'menu', 'path' => '/system/permission', 'redirect' => '', 'component' => 'Permission', 'icon' => '', 'permission' => 'Permission', 'keepAlive' => 0 ],
            ['name' => 'Role', 'title' => '角色管理', 'pid' => 3, 'status' => 1, 'type' => 'menu', 'path' => '/system/role', 'redirect' => '', 'component' => 'Role', 'icon' => '', 'permission' => 'Role', 'keepAlive' => 0 ],
            ['name' => 'Account', 'title' => '管理员管理', 'pid' => 3, 'status' => 1, 'type' => 'menu', 'path' => '/system/user', 'redirect' => '', 'component' => 'Account', 'icon' => '', 'permission' => 'Account', 'keepAlive' => 0 ],
            ['name' => 'Dept', 'title' => '部门管理', 'pid' => 3, 'status' => 1, 'type' => 'menu', 'path' => '/system/Dept', 'redirect' => '', 'component' => 'Dept', 'icon' => '', 'permission' => 'Dept', 'keepAlive' => 0 ],
            ['name' => 'LogAccount', 'title' => '管理员日志', 'pid' => 4, 'status' => 1, 'type' => 'menu', 'path' => '/log/account', 'redirect' => '', 'component' => 'LogAccount', 'icon' => '', 'permission' => 'LogAccount', 'keepAlive' => 0 ],
            ['name' => 'LogDb', 'title' => '数据库日志', 'pid' => 4, 'status' => 1, 'type' => 'menu', 'path' => '/log/db', 'redirect' => '', 'component' => 'LogDb', 'icon' => '', 'permission' => 'LogDb', 'keepAlive' => 0 ],
            ['name' => 'ProfileAccount', 'title' => '个人中心', 'pid' => 5, 'status' => 1, 'type' => 'menu', 'path' => '/account/center', 'redirect' => '', 'component' => 'Center', 'icon' => '', 'permission' => 'ProfileAccount', 'keepAlive' => 0 ],
            ['name' => 'ProfileSetting', 'title' => '个人设置', 'pid' => 5, 'status' => 1, 'type' => 'menu', 'path' => '/account/settings', 'redirect' => '', 'component' => 'Settings', 'icon' => '', 'permission' => 'ProfileSetting', 'keepAlive' => 0 ],
            ['name' => 'AnalysisView', 'title' => '查看', 'pid' => 6, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'WorkspaceView', 'title' => '查看', 'pid' => 7, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'PermissionView', 'title' => '查看', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'PermissionAdd', 'title' => '添加', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'PermissionUpdate', 'title' => '更新', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'PermissionDelete', 'title' => '删除', 'pid' => 8, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'RoleView', 'title' => '查看', 'pid' => 9, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'RoleAdd', 'title' => '添加', 'pid' => 9, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'RoleUpdate', 'title' => '更新', 'pid' => 9, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'RoleDelete', 'title' => '删除', 'pid' => 9, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'AccountView', 'title' => '查看', 'pid' => 10, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'AccountAdd', 'title' => '添加', 'pid' => 10, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'AccountUpdate', 'title' => '更新', 'pid' => 10, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'AccountDelete', 'title' => '删除', 'pid' => 10, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'DeptView', 'title' => '查看', 'pid' => 11, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'DeptAdd', 'title' => '添加', 'pid' => 11, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'DeptUpdate', 'title' => '更新', 'pid' => 11, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'DeptDelete', 'title' => '删除', 'pid' => 11, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'LogAccountView', 'title' => '查看', 'pid' => 12, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'LogAccountDelete', 'title' => '删除', 'pid' => 12, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'LogDbView', 'title' => '查看', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'LogDbDelete', 'title' => '删除', 'pid' => 13, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'ProfileAccountView', 'title' => '查看', 'pid' => 14, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
            ['name' => 'ProfileSettingView', 'title' => '查看', 'pid' => 15, 'status' => 1, 'type' => 'action', 'path' => '', 'redirect' => '', 'component' => '', 'icon' => '', 'permission' => '', 'keepAlive' => 0 ],
        ];

        $this->insert('permission', $rows);
    }

    /**
     * 创建角色.
     */
    protected function createRoleData()
    {
        $rows = [
            // 创建 超级管理员角色
            ['name' => 'root', 'title' => '根', 'status' => 1, 'pid' => 0 , 'mode' => 0],
        ];

        $this->insert('role', $rows);
    }

    protected function createDeptData()
    {
        $rows = [
            ['dept_name' => 'Ant-Design', 'dept_pid' => 0],
            ['dept_name' => '深圳总公司', 'dept_pid' => 1],
            ['dept_name' => '北京总公司', 'dept_pid' => 1],

            ['dept_name' => '设计部', 'dept_pid' => 2],
            ['dept_name' => '运营部', 'dept_pid' => 2],
            ['dept_name' => '研发部', 'dept_pid' => 3],
            ['dept_name' => '销售部', 'dept_pid' => 3],
        ];
        $this->insert('dept', $rows);
    }
}
