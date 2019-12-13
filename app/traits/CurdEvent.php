<?php

namespace app\traits;

use think\Model;
use app\model\DbLog;

trait CurdEvent
{
    /**
     * 新增后
     *
     * @param Model $model
     * @return void
     */
    public static function onAfterInsert(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'insert',
            'sql' => $model->getLastSql()
        ]);
    }

    /**
     * 更新后
     * 
     * @param Model $model
     * @return void
     */
    public static function onAfterUpdate(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'update',
            'sql' => $model->getLastSql()
        ]);
    }

    /**
     * 删除后
     *
     * @param Model $model
     * @return void
     */
    public static function onAfterDelete(Model $model)
    {
        DbLog::create([
            'model' => $model->getName(),
            'url' => request()->url(),
            'action' => 'delete',
            'sql' => $model->getLastSql()
        ]);
    }
}
