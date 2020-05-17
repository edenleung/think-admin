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
 * 日志表.
 */
class Log extends Migrator
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
        $table = $this->table('log', ['engine' => 'InnoDB', 'collation' => config('database.connections.mysql.charset') . '_unicode_ci']);
        $table->addColumn('user_id', 'integer', ['limit' => 11, 'comment' => '用户标识'])
            ->addColumn('action', 'string', ['limit' => 255, 'comment' => '操作'])
            ->addColumn('url', 'string', ['limit' => 255, 'comment' => '访问地址'])
            ->addColumn('ip', 'string', ['limit' => 15, 'comment' => '访问ip'])
            ->addColumn('user_agent', 'string', ['limit' => 255, 'comment' => '访问者user_agnet'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'comment' => '更新时间'])
            ->create();
    }
}
