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

namespace app\model\validate;

use think\Validate;

class PostValidate extends Validate
{
    protected $rule = [
        'postName' => 'require',
        'postCode' => 'require|unique:post',
        'postSort' => 'require'
    ];

    protected $message = [
        'postName.require' => '名称必须',
        'postCode.require' => '标识必须',
        'postCode.unique' => '标识重复'
    ];

    protected $scene = [
        'create' => ['postName', 'postCode'],
        'update' => ['postName'],
    ];
}
