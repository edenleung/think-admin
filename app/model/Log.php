<?php

namespace app\model;

use app\model\User;

class Log extends \think\Model
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取日志列表
     *
     * @param integer $page
     * @param integer $pageSize
     * @return void
     */
    public function getList($page, $pageSize)
    {
        $total = Log::count();
        $logs = Log::alias('l')->join('user u', 'u.id = l.user_id')
            ->limit($pageSize)
            ->page($page)
            ->field('l.*,u.nickname')
            ->select();

        return ['data' => $logs, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 删除日志
     *
     * @param string $id
     * @return void
     */
    public function deleteLog(string $id)
    {
        $ids = explode(',', $id);

        if (empty($ids)) {
            return false;
        }

        Log::whereIn('id', $ids)->delete();

        return true;
    }
}
