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

namespace app\model;

class Log extends \think\Model
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取日志列表.
     */
    public function getList(int $pageNo, int $pageSize)
    {
        $total = Log::count();
        $logs = Log::alias('l')->join('user u', 'u.id = l.user_id')
            ->limit($pageSize)
            ->page($pageNo)
            ->field('l.*,u.nickname')
            ->order('create_time desc')
            ->select();

        return [
            'data' => $logs,
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            'totalPage' => count($logs),
            'totalCount' => $total
        ];
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
