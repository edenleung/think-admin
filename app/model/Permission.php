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

use app\AbstractModel;
use app\model\validate\PermissionValidate;
use xiaodi\Permission\Contract\PermissionContract;

class Permission extends AbstractModel implements PermissionContract
{
    protected $validate = PermissionValidate::class;

    use \app\traits\CurdEvent;
    use \xiaodi\Permission\Traits\Permission;

    /**
     * 添加规则.
     */
    public function addRule(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        if (!empty($data['permission'])) {
            $data['permission'] = implode(',', $data['permission']);
        }

        return Permission::create($data);
    }

    /**
     * 更新规则.
     */
    public function updateRule(int $id, array $data)
    {
        if ($this->validate('update', $data) === false) {
            return false;
        }

        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        if (!empty($data['permission'])) {
            $data['permission'] = implode(',', $data['permission']);
        }

        return $rule->save($data);
    }

    /**
     * 删除规则.
     */
    public function deleteRule(int $id)
    {
        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $rule->delete();
    }

    /**
     * 获取规则列表.
     */
    public function getList(int $pageNo, int $pageSize)
    {
        $map = [];
        $category = new \extend\Category();

        $map[] = ['type', '<>', 'action'];
        $total = $this->where($map)->count();
        $data = $this->where($map)->select();
        $data = $category->formatTree($data);
        $data = $this->formatTreeAction($data);

        return [
            'data' => $data,
            'tree' => $this->getTree(),
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            'totalPage' => count($data),
            'totalCount' => $total
        ];
    }

    /**
     * 递归菜单下的操作
     *
     * @param [type] $data
     * @return array
     */
    protected function formatTreeAction($data)
    {
        foreach($data as $item) {
            if ($item['type'] == 'menu') {
                $item->actions = $item->getActions();
            }

            if (!empty($item['children'])) {
                $this->formatTreeAction($item['children']);
            }
        }

        return $data;
    }

    /**
     * 获取顶级
     */
    public function getMenuPermission()
    {
        $menu = $this->where('type', 'menu')->select();
        foreach ($menu as $permission) {
            $permission->actions = $permission->getActions();
            $permission->selected = [];
        }

        return $menu;
    }

    /**
     * 获取树形结构.
     */
    public function getTree()
    {
        $category = new \extend\Category();

        $map[] = ['type', '<>', 'action'];
        $data = $this->where($map)->select();
        $tree = $category->formatTree($data);
        return $tree;
    }

    /**
     * 获取顶级分类.
     */
    public function getMenu()
    {
        $data = $this->order('pid asc')->select()->toArray();
        $category = new \extend\Category(['id', 'pid', 'title', 'cname']);
        return $category->formatTree($data); //获取分类数据树结构
    }

    /**
     * 获取当前菜单的子操作.
     */
    protected function getActions()
    {
        $data = Permission::where(['pid' => $this->id, 'type' => 'action'])->select();
        return $data;
    }
}
