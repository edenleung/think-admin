<?php

use think\migration\Migrator;
use think\migration\db\Column;

/**
 * 日志表
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
        $table = $this->table('log', array('engine' => 'InnoDB'));
        $table->addColumn('user_id', 'integer', array('limit' => 11, 'comment' => '用户标识'))
            ->addColumn('action', 'string', array('limit' => 255, 'comment' => '操作'))
            ->addColumn('url', 'string', array('limit' => 255, 'comment' => '访问地址'))
            ->addColumn('ip', 'string', array('limit' => 15, 'comment' => '访问ip'))
            ->addColumn('user_agent', 'string', array('limit' => 255, 'comment' => '访问者user_agnet'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'comment' => '更新时间'))
            ->create();
    }
}
