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

namespace app\traits;

use app\model\DbLog;
use think\Model;

trait CurdEvent
{
    /**
     * 新增后.
     */
    public static function onAfterInsert(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'insert',
            'sql' => $model->getLastSql(),
        ]);
    }

    /**
     * 更新后.
     */
    public static function onAfterUpdate(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'update',
            'sql' => $model->getLastSql(),
        ]);
    }

    /**
     * 删除后.
     */
    public static function onAfterDelete(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'delete',
            'sql' => $model->getLastSql(),
        ]);
    }
}
