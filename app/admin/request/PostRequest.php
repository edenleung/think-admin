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
        'post_name' => 'require',
        'post_code' => 'require|unique:post',
    ];

    protected $message = [
        'post_name.require' => '名称必须',
        'post_code.require' => '标识必须',
        'post_code.unique' => '标识重复',
    ];

    protected $scene = [
        'create' => ['post_name', 'post_code'],
        'update' => ['post_code'],
    ];
}
