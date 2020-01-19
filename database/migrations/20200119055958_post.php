<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Post extends Migrator
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
        $table = $this->table('post', ['engine' => 'InnoDB', 'id' => 'postId']);
        $table->addColumn('postName', 'string', ['limit' => 100, 'comment' => '岗位名称'])
            ->addColumn('postCode', 'string', ['limit' => 50, 'comment' => '岗位标识'])
            ->addColumn('postSort', 'integer', ['limit' => 11, 'comment' => '排序', 'default' => 0])
            ->addColumn('status', 'integer', ['limit' => 11, 'comment' => '状态', 'default' => 1])
            ->addColumn('createTime', 'integer', ['limit' => 11, 'comment' => '创建时间'])
            ->addColumn('updateTime', 'integer', ['limit' => 11, 'comment' => '更新时间'])
            ->create();
    }
}
