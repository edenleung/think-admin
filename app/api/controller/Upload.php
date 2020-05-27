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

namespace app\api\controller;

use app\BaseController;

class Upload extends BaseController
{
    public function __construct()
    {
    }

    public function file()
    {
        $file = $this->request->file('file');

        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);

        return $this->sendSuccess([
            'path' => 'storage' . '/' . $savename,
        ]);
    }
}
