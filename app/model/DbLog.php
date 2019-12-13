<?php

namespace app\model;

final class DbLog extends \think\Model
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
        $total = DbLog::count();
        $logs = DbLog::limit($pageSize)->page($page)->select();

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

        DbLog::whereIn('id', $ids)->delete();

        return true;
    }
}
