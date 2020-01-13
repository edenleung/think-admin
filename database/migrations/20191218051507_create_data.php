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
            ['name' => 'dashboard', 'title' => '仪表盘', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'system', 'title' => '系统管理', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'log', 'title' => '日志管理', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'profile', 'title' => '个人页', 'pid' => 0, 'status' => 1, 'type' => 'path'],
            ['name' => 'analysis', 'title' => '分析页', 'pid' => 1, 'status' => 1, 'type' => 'menu'],
            ['name' => 'workspace', 'title' => '工作台', 'pid' => 1, 'status' => 1, 'type' => 'menu'],
            ['name' => 'permission', 'title' => '菜单管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'role', 'title' => '角色管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'account', 'title' => '管理员管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'dept', 'title' => '部门管理', 'pid' => 2, 'status' => 1, 'type' => 'menu'],
            ['name' => 'log-account', 'title' => '管理员日志', 'pid' => 3, 'status' => 1, 'type' => 'menu'],
            ['name' => 'log-db', 'title' => '数据库日志', 'pid' => 3, 'status' => 1, 'type' => 'menu'],
            ['name' => 'profile-account', 'title' => '个人中心', 'pid' => 4, 'status' => 1, 'type' => 'menu'],
            ['name' => 'profile-setting', 'title' => '个人设置', 'pid' => 4, 'status' => 1, 'type' => 'menu'],
            ['name' => 'analysis-view', 'title' => '查看', 'pid' => 5, 'status' => 1, 'type' => 'action'],
            ['name' => 'workspace-view', 'title' => '查看', 'pid' => 6, 'status' => 1, 'type' => 'action'],
            ['name' => 'permission-view', 'title' => '查看', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'permission-add', 'title' => '添加', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'permission-update', 'title' => '更新', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'permission-delete', 'title' => '删除', 'pid' => 7, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-view', 'title' => '查看', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-add', 'title' => '添加', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-update', 'title' => '更新', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'role-delete', 'title' => '删除', 'pid' => 8, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-view', 'title' => '查看', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-add', 'title' => '添加', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-update', 'title' => '更新', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'account-delete', 'title' => '删除', 'pid' => 9, 'status' => 1, 'type' => 'action'],
            ['name' => 'dept-view', 'title' => '查看', 'pid' => 10, 'status' => 1, 'type' => 'action'],
            ['name' => 'dept-add', 'title' => '添加', 'pid' => 10, 'status' => 1, 'type' => 'action'],
            ['name' => 'dept-update', 'title' => '更新', 'pid' => 10, 'status' => 1, 'type' => 'action'],
            ['name' => 'dept-delete', 'title' => '删除', 'pid' => 10, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-account-view', 'title' => '查看', 'pid' => 11, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-account-delete', 'title' => '删除', 'pid' => 11, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-db-view', 'title' => '查看', 'pid' => 12, 'status' => 1, 'type' => 'action'],
            ['name' => 'log-db-delete', 'title' => '删除', 'pid' => 12, 'status' => 1, 'type' => 'action'],
            ['name' => 'profile-account-view', 'title' => '查看', 'pid' => 13, 'status' => 1, 'type' => 'action'],
            ['name' => 'profile-setting-view', 'title' => '查看', 'pid' => 14, 'status' => 1, 'type' => 'action'],

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
