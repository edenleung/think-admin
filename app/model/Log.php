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

class Log extends \think\Model
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取日志列表.
     *
     * @param int $page
     * @param int $pageSize
     */
    public function getList(int $page, int $pageSize)
    {
        $total = Log::count();
        $logs = Log::alias('l')->join('user u', 'u.id = l.user_id')
            ->limit($pageSize)
            ->page($page)
            ->field('l.*,u.nickname')
            ->order('create_time desc')
            ->select();

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

        Log::whereIn('id', $ids)->delete();

        return true;
    }
}
