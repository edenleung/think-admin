<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\auth\Auth;
use app\admin\model\rbac\RuleModel;
use app\lib\Category;

function checkMenuAuth($path)
{
    // 获取auth实例
    $auth = Auth::instance();

    // 检测权限
    if ($auth->check($path, session('admin_user'))) {
        return true;
    }

    return false;
}

/**
 *
 */
function showParentMenu($pid)
{
    $rule = new RuleModel;
    $data = $rule->order('pid asc')->select();
    $category = new Category(array('id','pid','title','cname'));
    $level2 = $category->getChild($pid, $data->toArray());
    foreach ($level2 as $v) {
        if (checkMenuAuth($v['name'])) {
            return true;
            continue;
        }
    }

    return false;
}

/**
 * 路由调整
 */
function dispatchPath()
{
    return request()->routeInfo()['route'];
}
