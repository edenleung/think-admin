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

namespace app\common\service;

use app\common\model\MenuAction;

class MenuActionService extends \Crud\CrudService
{
    /**
     * @var MenuAction
     */
    protected $model;

    public function __construct(MenuAction $model)
    {
        parent::__construct($model);
    }

    public function create(array $data)
    {
        $data['menu_id'] = $data['pid'];
        $data['name'] = $data['permission'];

        return $this->model->save($data);
    }

    public function update($id, array $data)
    {
        $row = $this->info($id);

        $data['name'] = $data['permission'];
        $data['menu_id'] = $data['pid'];

        return $row->save($data);
    }
}
