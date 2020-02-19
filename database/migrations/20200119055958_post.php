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
        $table = $this->table('post', ['engine' => 'InnoDB', 'id' => 'post_id']);
        $table->addColumn('post_name', 'string', ['limit' => 100, 'comment' => '岗位名称'])
            ->addColumn('post_code', 'string', ['limit' => 50, 'comment' => '岗位标识'])
            ->addColumn('post_sort', 'integer', ['limit' => 11, 'comment' => '排序', 'default' => 0])
            ->addColumn('status', 'integer', ['limit' => 11, 'comment' => '状态', 'default' => 1])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'comment' => '更新时间'])
            ->create();
    }
}
