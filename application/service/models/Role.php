<?php
namespace app\service\models;

use xiaodi\Permission\Models\Role as Model;

/**
 * 角色模型
 * 
 */
class Role extends Model
{
    /**
     * 获取角色详情
     * @param int|string $id
     *
     */
    public function getInfo($id)
    {
        $res = $this->getOrFail($id);

        return $res;
    }

    public function getList($page, $pageSize)
    {
        $total = $this->count();
        $data = $this->limit($pageSize)->page($page)->select();

        return ['data' => $data, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }
}
