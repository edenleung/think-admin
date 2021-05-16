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

use app\common\model\Menu;

class MenuService extends \Crud\CrudService
{
    /**
     * @var Menus
     */
    protected $model;

    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }

    public function getTree()
    {
        $data = $this->model->with(['actions' => ['menu']])->select();

        $tree = $this->formatTree($data->toArray());

        return $tree;
    }

    public function getRoleRuleTree()
    {
        $data = $this->getTree();

        $data = $this->formatRoleRuleTree($data);

        return $data;
    }

    protected function formatRoleRuleTree($data, $selected = [], &$actionIds = [])
    {
        $init = [
            'selected'      => [],
            'indeterminate' => false,
            'checkedAll'    => false,
            'disabled'      => false,
        ];

        foreach ($data as $key => $item) {
            if (!empty($item['actions'])) {
                $actionIds = array_merge(array_column($item['actions'], 'id'), $actionIds);
                $item['actions'] = array_map(function ($a) {
                    $a['disabled'] = false;

                    return $a;
                }, $item['actions']);
            }

            if (isset($item['children'])) {
                $res = $this->formatRoleRuleTree($item['children'], $selected, $actionIds);
                $item['children'] = $res['data'];
            }
            $data[$key] = array_merge($item, $init);
        }

        return ['data' => $data, 'actionsIds' => $actionIds];
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
