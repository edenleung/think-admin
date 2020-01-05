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
        $this->createRolePermissionData();
        $this->createUserRoleData();
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
        ]);
        $table->saveData();

        // 游客账号
        $default_password = '1234';
        $hash = $this->randomKey();

        $pwd_peppered = hash_hmac('sha256', $default_password, $hash);
        $password = password_hash($pwd_peppered, PASSWORD_DEFAULT);

        $table = $this->table('user');
        $table->insert([
            'name' => 'xiaodi',
            'password' => $password,
            'hash' => $hash,
            'nickname' => 'Xiao Di',
            'email' => 'XiaoDi@aliyun.com',
            'status' => 1,
            'create_time' => time(),
            'update_time' => time(),
        ]);
        $table->saveData();
    }

    /**
     * 创建规则数据.
     */
    protected function createPermissionData()
    {
        $rows = [
            ['name' => 'dashboard', 'title' => '仪表盘', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'auth', 'title' => '权限管理', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'log', 'title' => '日志管理', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'profile', 'title' => '个人页', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'analysis', 'title' => '分析页', 'pid' => 1, 'status' => 1, 'type' => 'menu'],
            ['name' => 'workspace', 'title' => '工作台', 'pid' => 1, 'status' => 1, 'type' => 'menu'],
            ['name' => 'rule', 'title' => '规则管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'role', 'title' => '角色管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'account', 'title' => '管理员管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'log-account', 'title' => '管理员日志', 'pid' => 3, 'status' => 1, 'type' => 'menu'],
            ['name' => 'log-db', 'title' => '数据库日志', 'pid' => 3, 'status' => 1, 'type' => 'menu'],
            ['name' => 'profile-account', 'title' => '个人中心', 'pid' => 4, 'status' => 1, 'type' => 'menu'],
            ['name' => 'profile-setting', 'title' => '个人设置', 'pid' => 4, 'status' => 1, 'type' => 'menu'],
            ['name' => 'analysis-view', 'title' => '查看', 'pid' => 5, 'status' => 1, 'type' => 'action'],
            ['name' => 'workspace-view', 'title' => '查看', 'pid' => 6, 'status' => 1, 'type' => 'action'],
            ['name' => 'rule-view', 'title' => '查看', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'rule-add', 'title' => '添加', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'rule-update', 'title' => '更新', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'rule-delete', 'title' => '删除', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-view', 'title' => '查看', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-add', 'title' => '添加', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-update', 'title' => '更新', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-delete', 'title' => '删除', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-view', 'title' => '查看', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-add', 'title' => '添加', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-update', 'title' => '更新', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-delete', 'title' => '删除', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-account-view', 'title' => '查看', 'pid' => 10, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-db-view', 'title' => '查看', 'pid' => 11, 'status' => 1, 'type' => 'action'],
            ['name' => 'profile-account-view', 'title' => '查看', 'pid' => 12, 'status' => 1, 'type' => 'action'],
            ['name' => 'profile-setting-view', 'title' => '查看', 'pid' => 13, 'status' => 1, 'type' => 'action'],

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
            ['name' => 'admin', 'title' => '超级管理员组', 'status' => 1, 'pid' => 0],
            // 创建 游客角色
            ['name' => 'guest', 'title' => '游客组', 'status' => 1, 'pid' => 0],
        ];

        $this->insert('role', $rows);
    }

    /**
     * 创建角色与规则关系.
     */
    protected function createRolePermissionData()
    {
        $rows = [
            ['role_id' => 1, 'permission_id' => 14],
            ['role_id' => 1, 'permission_id' => 15],
            ['role_id' => 1, 'permission_id' => 16],
            ['role_id' => 1, 'permission_id' => 17],
            ['role_id' => 1, 'permission_id' => 18],
            ['role_id' => 1, 'permission_id' => 19],
            ['role_id' => 1, 'permission_id' => 20],
            ['role_id' => 1, 'permission_id' => 21],
            ['role_id' => 1, 'permission_id' => 22],
            ['role_id' => 1, 'permission_id' => 23],
            ['role_id' => 1, 'permission_id' => 24],
            ['role_id' => 1, 'permission_id' => 25],
            ['role_id' => 1, 'permission_id' => 26],
            ['role_id' => 1, 'permission_id' => 27],
            ['role_id' => 1, 'permission_id' => 28],
            ['role_id' => 1, 'permission_id' => 29],
            ['role_id' => 1, 'permission_id' => 30],
            ['role_id' => 1, 'permission_id' => 31],

            // 为游客角色分配权限(默认只有查看权限)
            ['role_id' => 2, 'permission_id' => 14],
            ['role_id' => 2, 'permission_id' => 15],
            ['role_id' => 2, 'permission_id' => 16],
            ['role_id' => 2, 'permission_id' => 20],
            ['role_id' => 2, 'permission_id' => 24],
            ['role_id' => 2, 'permission_id' => 28],
            ['role_id' => 2, 'permission_id' => 29],
            ['role_id' => 2, 'permission_id' => 30],
            ['role_id' => 2, 'permission_id' => 31],
        ];

        $this->insert('role_permission_access', $rows);
    }

    /**
     * 创建用户与角色关系.
     */
    protected function createUserRoleData()
    {
        $rows = [
            // 为游客账分配游客角色
            ['user_id' => 2, 'role_id' => 2],
        ];
        $this->insert('user_role_access', $rows);
    }
}
