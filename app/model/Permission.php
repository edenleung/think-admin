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

use app\model\validate\PermissionValidate;
use think\exception\ValidateException;
use xiaodi\Permission\Contract\PermissionContract;

class Permission extends \think\Model implements PermissionContract
{
    use \app\traits\CurdEvent;

    use \xiaodi\Permission\Traits\Permission;
    use \app\traits\ValidateError;

    /**
     * 添加规则.
     */
    public function addRule(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
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

        return $this->find($id)->save($data);
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
        $data = $this->where($map)->limit($pageSize)->page($pageNo)->select();
        $data = $category->getTree($data);
        foreach ($data as $permission) {
            $permission->permissionId = $permission->name;
            $permission->actions = $permission->getActions();
        }

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
     * 获取顶级
     */
    public function getMenuPermission()
    {
        $menu = $this->where('type', 'menu')->select();
        foreach ($menu as $permission) {
            $permission->permissionId = $permission->name;
            $permission->actions = $permission->getActions();
        }

        return $menu;
    }

    /**
     * 获取树形结构.
     */
    public function getTree()
    {
        $map = [];

        $category = new \extend\Category();

        $map['type'] = 'menu';
        $data = $this->where($map)->select();
        $data = $category->formatTree($data);
        $tree = [
            [
                'title' => '根',
                'value'    => '0',
                'children' => $data
            ]
        ];

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
     * 验证数据.
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
     */
    protected function validate(string $scene, array $data)
    {
        try {
            \validate(PermissionValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

    /**
     * 获取当前权限下级权限.
     */
    protected function getActions()
    {
        $data = Permission::where(['pid' => $this->id, 'type' => 'action'])->select();

        foreach ($data as $permission) {
            $permission->value = $permission->id;
            $permission->label = $permission->title;
        }

        return $data;
    }
}
