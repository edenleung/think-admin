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

class PostRequest extends BaseRequest
{
    protected $rule = [
        'name' => 'require',
        'code' => 'require',
    ];

    protected $message = [
        'name.require' => '名称必须',
        'code.require' => '标识必须',
        'code.unique'  => '标识重复',
    ];

    protected $scene = [
        'create' => ['name', 'code'],
        'update' => ['name', 'code'],
    ];
}
