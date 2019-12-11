<?php
namespace app\service;

use xiaodi\Permission\Models\User;

/**
 * 后台用户服务类.
 * 
 */
class UserService
{
    protected $model;

    public function __construct()
    {
        $this->user = new User;
    }

    /**
     *
     */
    public function doLogin(array $params)
    {
        try {
            $user = $this->user->getByName($params['username']);
            
            if (empty($user)) {
                 exception('没有此账号！');
            }
            

            if (!$user->status) {
                exception('此账号已禁用！');
            }

            $this->verifyPwd($params['password'], $user->password);
        } catch (\Exception $e) {
            exception($e->getMessage());
        }

        return $user->id;
    }

    /**
     * 校验密码
     */
    protected function verifyPwd($pwd, $hash)
    {
        if (!password_verify($pwd, $hash)) {
            exception('密码错误');
        }
    }
}
