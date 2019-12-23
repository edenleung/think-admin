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
            'status' => 1,
            'create_time' => time(),
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
            'status' => 1,
            'create_time' => time(),
        ]);
        $table->saveData();
    }

    /**
     * 创建规则数据.
     */
    protected function createPermissionData()
    {
        $rows = [
            ['name' => 'rule', 'title' => '规则管理', 'pid' => 0, 'status' => 1],
            ['name' => 'rule-view', 'title' => '查询', 'pid' => 1, 'status' => 1],
            ['name' => 'rule-add', 'title' => '添加', 'pid' => 1, 'status' => 1],
            ['name' => 'rule-update', 'title' => '更新', 'pid' => 1, 'status' => 1],
            ['name' => 'rule-delete', 'title' => '删除', 'pid' => 1, 'status' => 1],

            ['name' => 'role', 'title' => '角色管理', 'pid' => 0, 'status' => 1],
            ['name' => 'role-view', 'title' => '查询', 'pid' => 6, 'status' => 1],
            ['name' => 'role-add', 'title' => '添加', 'pid' => 6, 'status' => 1],
            ['name' => 'role-update', 'title' => '更新', 'pid' => 6, 'status' => 1],
            ['name' => 'role-delete', 'title' => '删除', 'pid' => 6, 'status' => 1],

            ['name' => 'account', 'title' => '管理员管理', 'pid' => 0, 'status' => 1],
            ['name' => 'account-view', 'title' => '查询', 'pid' => 11, 'status' => 1],
            ['name' => 'account-add', 'title' => '添加', 'pid' => 11, 'status' => 1],
            ['name' => 'account-update', 'title' => '更新', 'pid' => 11, 'status' => 1],
            ['name' => 'account-delete', 'title' => '删除', 'pid' => 11, 'status' => 1],
        ];

        $this->insert('permission', $rows);
    }

    /**
     * 创建角色.
     */
    protected function createRoleData()
    {
        $rows = [
            // 创建游客角色
            ['name' => 'guest', 'title' => '游客', 'status' => 1],
        ];

        $this->insert('role', $rows);
    }

    /**
     * 创建角色与规则关系.
     */
    protected function createRolePermissionData()
    {
        $rows = [
            // 为游客角色分配权限
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 12],
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
            ['user_id' => 2, 'role_id' => 1],
        ];
        $this->insert('user_role_access', $rows);
    }
}
