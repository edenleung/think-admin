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

use app\common\model\Dept;

class DeptService extends \Crud\CrudService
{
    /**
     * @var Dept
     */
    protected $model;

    public function __construct(Dept $model)
    {
        parent::__construct($model);
    }

    public function getTree()
    {
        $data = $this->model->select();

        $tree = $this->formatTree($data->toArray());

        return $tree;
    }

    protected function formatTree($data, $pid = 0)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['pid'] == $pid) {
                $children = $this->formatTree($data, $item['id']);
                if (!empty($children)) {
                    $item['children'] = $children;
                }
                $result[] = $item;
            }
        }

        return $result;
    }
}
