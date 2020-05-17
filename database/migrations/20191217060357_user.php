<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use think\migration\Migrator;

/**
 * 用户表.
 */
class User extends Migrator
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
    public function change()
    {
        $table = $this->table('user', ['engine' => 'InnoDB', 'collation' => config('database.connections.mysql.charset') . '_unicode_ci']);
        $table->addColumn('name', 'string', ['limit' => 50, 'comment' => '用户唯一标识（登录名）'])
            ->addColumn('password', 'string', ['limit' => 255, 'comment' => '登录密码'])
            ->addColumn('hash', 'string', ['limit' => 11, 'comment' => '加密hash'])
            ->addColumn('nickname', 'string', ['limit' => 50, 'default' => '', 'comment' => '昵称'])
            ->addColumn('dept_id', 'integer', ['limit' => 11, 'default' => 3, 'comment' => '部门标识'])
            ->addColumn('status', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '状态'])
            ->addColumn('avatar', 'string', ['limit' => 255, 'default' => '', 'comment' => '头像'])
            ->addColumn('email', 'string', ['limit' => 50, 'default' => '', 'comment' => '邮箱'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'comment' => '更新时间'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
