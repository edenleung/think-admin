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

namespace app\admin\request;

use app\BaseRequest;

class DeptRequest extends BaseRequest
{
    protected $rule = [
        'dept_name' => 'require|unique:dept',
        'dept_pid'  => 'require',
    ];

    protected $message = [
        'dept_pid.require'  => '父级必须',
        'dept_name.require' => '名称必须',
        'dept_name.unique'  => '规则重复',
    ];
}
