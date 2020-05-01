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

namespace app\home\controller;

use app\BaseController;
use app\common\model\Role;

class Index extends BaseController
{
    public function index()
    {
        $category = new \Tant\Util\Category();

        $data = Role::order('pid', 'asc')->select();

        $roles = $category->getTree($data);
        return $data;
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
