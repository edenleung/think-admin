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

namespace app\api\controller;

use Auth\User\AuthorizationController;
use app\common\service\MemberService;

class Member extends AuthorizationController
{
    /**
     * @var MemberService
     */
    protected $service;

    protected $validates = [
        'resetPassword' => [
            'old_password'     => 'require',
            'password'         => 'require',
            'confirm_password' => 'require|confirm:password',
        ],
    ];

    public function resetPassword()
    {
        $data = $this->request->post();
        $this->validate($data, $this->validates['resetPassword']);

        $service = new MemberService($this->user);
        $service->resetPassword($data['old_password'], $data['password']);
        return $this->sendSuccess();
    }
}
