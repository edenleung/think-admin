<?php

namespace app\auth;

use TAnt\Abstracts\AbstractController;
use app\auth\AuthorizationUserInterface;
use app\auth\exception\Unauthorized;

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
