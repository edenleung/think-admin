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

namespace app;

use think\Model;

abstract class BaseModel extends Model
{
    public $sortBy = 'createTime';

    public $sortOrder = 'asc';

    protected $autoWriteTimestamp = true;

    protected $createTime = 'createTime';

    protected $updateTime = 'updateTime';

    /**
     * 获取所有.
     */
    public function all()
    {
        return $this->order($this->sortBy, $this->sortOrder)
            ->select();
    }

    /**
     * 获取分页.
     *
     * @param [type] $paginate
     */
    public function paginate($paginate)
    {
        return $this->order($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

    /**
     * 添加一条记录.
     *
     * @param [type] $paginate
     * @param mixed $input
     */
    public function add($input)
    {
        $this->save($input);

        return $this;
    }

    /**
     * 查找一条记录.
     *
     * @param [type] $id
     */
    public function find($id)
    {
        return $this->where($this->pk, $id)->find();
    }

    /**
     * 删除一条记录.
     *
     * @param [type] $id
     */
    public function remove($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * 更新一条记录.
     *
     * @param [type] $id
     */
    public function renew($id, array $input)
    {
        $model = $this->find($id);
        $model->save($input);

        return $model;
    }
}
