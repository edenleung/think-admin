<?php

namespace app\api\controller;

use app\auth\AuthorizationUserInterface;
use app\BaseController;
use app\auth\AuthService;
use app\common\model\Member;

class Auth extends BaseController
{
    /**
     * @var AuthService
     */
    protected $service;

    public function __construct()
    {
        $this->service = new AuthService(new Member);
    }

    protected $validates = [
        'login' => [
            'username'   => 'require',
            'password' => 'require',
        ],
        'register' => [
            'username'   => 'require',
            'password' => 'require',
        ],
        'code' => [
            'phone'   => 'require',
        ],
    ];

    public function login()
    {
        $data = $this->request->post();
        $this->validate($data, $this->validates['login']);

        $username = $data['username'];
        $password = $data['password'];
        $result = $this->service->login($username, $password);

        if ($result !== false) {
            if (method_exists($this, 'login_after')) {
                return call_user_func_array([$this, 'login_after'], [$result]);
            } else {
                return $this->sendSuccess($result);
            }
        } else {
            return $this->sendError($this->service->getError());
        }
    }

    public function register()
    {
        $data = $this->request->post();
        $this->validate($data, $this->validates['register']);

        $result = $this->service->register($data);
        if ($result) {
            return $this->sendSuccess();
        } else {
            return $this->sendError($this->service->getError());
        }
    }

    public function login_after(AuthorizationUserInterface $user)
    {
        return $this->sendSuccess([
            'token' => $user->makeToken()
        ]);
    }
}
