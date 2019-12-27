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
    public function getList(int $page, int $pageSize)
    {
        $total = $this->where('pid', 0)->count();
        $top = $this->where('pid', 0)->limit($pageSize)->page($page)->select();
        foreach ($top as $permission) {
            $permission->permissionId = $permission->name;
            $permission->actions = $permission->getActions();
        }

        return ['data' => $top, 'tree' => $this->getTree(), 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 获取顶级
     */
    public function getTopPermission()
    {
        $top = $this->where('pid', 0)->select();
        foreach ($top as $permission) {
            $permission->permissionId = $permission->name;
            $permission->actions = $permission->getActions();
        }

        return $top;
    }

    /**
     * 获取树形结构.
     */
    public function getTree()
    {
        return $this->where('pid', 0)->select()->toArray();
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
        $data = Permission::where(['pid' => $this->id])->select();

        foreach ($data as $permission) {
            $permission->value = $permission->id;
            $permission->label = $permission->title;
        }

        return $data;
    }
}
