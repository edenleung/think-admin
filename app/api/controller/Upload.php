<?php

declare(strict_types=1);

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
