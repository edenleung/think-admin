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

namespace app\admin\service;

use app\BaseService;
use app\common\model\Permission;

class PermissionService extends BaseService
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    /**
     * 获取列表.
     */
    public function list(int $pageNo, int $pageSize)
    {
        $map = [];
        $category = new \TAnt\Util\Category();

        $map[] = ['type', '<>', 'action'];
        $total = $this->model->where($map)->count();
        $data = $this->model->where($map)->select();
        $data = $category->formatTree($data);
        $data = $this->formatTreeAction($data);

        return [
            'data'       => $data,
            'tree'       => $this->getTree(),
            'pageSize'   => $pageSize,
            'pageNo'     => $pageNo,
            'totalPage'  => count($data),
            'totalCount' => $total,
        ];
    }

    /**
     * 添加菜单.
     */
    public function create(array $data)
    {
        if (empty($data['permission'])) {
            $data['permission'] = [$data['name']];
        }

        $data['permission'] = implode(',', $data['permission']);

        return $this->model->save($data);
    }

    /**
     * 更新菜单.
     *
     * @param [type] $id
     */
    public function update($id, array $data)
    {
        $rule = $this->model->find($id);

        if (!empty($data['permission'])) {
            $data['permission'] = implode(',', $data['permission']);
        } else {
            $data['permission'] = '';
        }

        return $rule->save($data);
    }

    /**
     * 获取菜单与子操作结构.
     */
    public function getMenuPermission()
    {
        $actions = $this->model->where('type', 'action')->order('pid asc')->select();
        $menusIds = $this->model->where('type', 'action')->column('pid');
        $menus = $this->model->whereIn('id', $menusIds)->select();
        $category = new \TAnt\Util\Category();

        foreach ($menus as $menu) {
            $menu->actions = $category->getChild($menu->id, $actions);
        }

        return $menus;
    }

    /**
     * 获取树形结构.
     */
    public function getTree()
    {
        $category = new \TAnt\Util\Category();

        $map[] = ['type', '<>', 'action'];
        $data = $this->model->where($map)->where('status', 1)->select();

        return $category->formatTree($data);
    }

    /**
     * 获取顶级分类.
     */
    public function getMenu()
    {
        $data = $this->model->order('pid asc')->where('status', 1)->select()->toArray();
        $category = new \TAnt\Util\Category(['id', 'pid', 'title', 'cname']);

        return $category->formatTree($data); //获取分类数据树结构
    }

    /**
     * 获取当前菜单的子操作.
     */
    protected function getActions(Permission $permission)
    {
        return Permission::where(['pid' => $permission->id, 'type' => 'action'])->select();
    }

    /**
     * 递归菜单下的操作.
     *
     * @param [type] $data
     *
     * @return array
     */
    protected function formatTreeAction($data)
    {
        foreach ($data as $item) {
            if ($item['type'] == 'menu') {
                $item->actions = $this->getActions($item);
            }

            if (!empty($item['children'])) {
                $this->formatTreeAction($item['children']);
            }
        }

        return $data;
    }
}
