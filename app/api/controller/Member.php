<?php

namespace app\api\controller;

use app\common\service\MemberService;
use app\auth\AuthorizationController;

class Member extends AuthorizationController
{
    /**
     * @var MemberService
     */
    protected $service;

    protected $validates = [
        'resetPassword' => [
            'old_password' => 'require',
            'password' => 'require',
            'confirm_password' => 'require|confirm:password'
        ]
    ];

    public function resetPassword()
    {
        $data = $this->request->post();
        $this->validate($data, $this->validates['resetPassword']);

        $service = new MemberService($this->user);
        $result = $service->resetPassword($data['old_password'], $data['password']);
        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }
}
