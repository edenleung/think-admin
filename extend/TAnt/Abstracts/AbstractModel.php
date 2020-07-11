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

namespace TAnt\Abstracts;

use think\Model;
use TAnt\DataScope\Scope;

abstract class AbstractModel extends Model
{
    public $sortBy = 'create_time';

    public $sortOrder = 'asc';

    protected $autoWriteTimestamp = true;

    protected $createTime = 'create_time';

    protected $updateTime = 'update_time';

    /**
     * 获取所有.
     */
    public function all()
    {
        return $this->order($this->sortBy, $this->sortOrder)
            ->select();
    }

    /**
     * 数据权限 (数据范围).
     *
     * @param [type] $query
     * @param [type] $alias
     */
    public function scopeDataAccess($query, $alias)
    {
        $dataScope = new Scope();
        $sql = $dataScope->handle($alias);

        $query->where($sql);
    }
}
