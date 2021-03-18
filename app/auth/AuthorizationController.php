<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\auth;

use app\auth\exception\Unauthorized;
use TAnt\Abstracts\AbstractController;

class AuthorizationController extends AbstractController
{
    /**
     * @var AuthorizationUserInterface
     */
    protected $user;

    public function __construct()
    {
        parent::__construct();
        if (!request()->user) {
            throw new Unauthorized('未登录.', 401);
        }

        $this->user = request()->user;
    }
}
