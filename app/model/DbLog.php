<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\model;

final class DbLog extends \think\Model
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取日志列表.
     *
     * @param int $page
     * @param int $pageSize
     */
    public function getList($page, $pageSize)
    {
        $total = DbLog::count();
        $logs = DbLog::limit($pageSize)->page($page)->select();

        return ['data' => $logs, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 删除日志.
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
