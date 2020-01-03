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

namespace app\home\controller;

use app\AbstractController;
use Houdunwang\Arr\Arr;
use app\model\Role;
use app\model\User;

class Index extends AbstractController
{
    public function index()
    {
        $user = User::find(3);

        $category = new \extend\Category();

        $map = [];
        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        $childrenRoleIds = [];
        $all = Role::order('pid asc')->select()->toArray();

        foreach ($user->roles as $role) {
            $roles = array_column($category->getTree($all, $role->id), 'id');
            if (!empty($roles)) {
                $childrenRoleIds = array_merge($childrenRoleIds, $roles);
            }
        }

        if (!empty($childrenRoleIds)) {
            $map[] = ['id', 'in', $childrenRoleIds];
        }

        $total = Role::where($map)->count();
        $roles = Role::where($map)->limit(10)->page(1)->select();

        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->column('id');
        }

        $category = new \extend\Category();

        $tree = $roles->toArray();
        var_dump($tree);

        $tree = $category->getTree($tree, $tree[0]['pid']);
        var_dump($tree);

        // return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V6<br/><span style="font-size:30px">13载初心不改 - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
