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

namespace app\common\traits;

use think\Model;
use app\common\model\DataBaseLog;

trait Log
{
    /**
     * 新增后.
     */
    public static function onAfterInsert(Model $model)
    {
        DataBaseLog::create([
            'user_id' => request()->user->id,
            'model'   => $model->getName(),
            'url'     => request()->url(),
            'action'  => 'insert',
            'sql'     => $model->getLastSql(),
        ]);
    }

    /**
     * 更新后.
     */
    public static function onAfterUpdate(Model $model)
    {
        DataBaseLog::create([
            'user_id' => request()->user->id,
            'model'   => $model->getName(),
            'url'     => request()->url(),
            'action'  => 'update',
            'sql'     => $model->getLastSql(),
        ]);
    }

    /**
     * 删除后.
     */
    public static function onAfterDelete(Model $model)
    {
        DataBaseLog::create([
            'user_id' => request()->user->id,
            'model'   => $model->getName(),
            'url'     => request()->url(),
            'action'  => 'delete',
            'sql'     => $model->getLastSql(),
        ]);
    }
}
