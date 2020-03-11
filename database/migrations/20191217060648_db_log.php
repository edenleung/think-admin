<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 *
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 *
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use think\migration\Migrator;

/**
 * 数据日志表.
 */
class DbLog extends Migrator
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
        $table = $this->table('db_log', ['engine' => 'InnoDB']);
        $table->addColumn('model', 'string', ['limit' => 100, 'comment' => '模型名'])
            ->addColumn('url', 'string', ['limit' => 255, 'comment' => '访问地址'])
            ->addColumn('action', 'string', ['limit' => 255, 'comment' => '操作'])
            ->addColumn('sql', 'text', ['comment' => 'sql'])
            ->addColumn('user_id', 'integer', ['limit' => 11, 'comment' => '操作员id'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'comment' => '创建时间'])
            ->create();
    }
}
