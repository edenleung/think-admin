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

class Dept extends Migrator
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
        $table = $this->table('dept', ['engine' => 'InnoDB', 'id' => 'dept_id', 'collation' => config('database.connections.mysql.charset') . '_unicode_ci']);
        $table->addColumn('dept_name', 'string', ['limit' => 100, 'comment' => '部门名称'])
            ->addColumn('dept_pid', 'integer', ['limit' => 11, 'comment' => '上级部门'])
            ->addColumn('dept_status', 'integer', ['limit' => 11, 'comment' => '状态', 'default' => 1])
            ->create();
    }
}
