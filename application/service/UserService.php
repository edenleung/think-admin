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
            $info = $this->user->getInfo([
                'admin_user' => $params['username']
            ]);
            if (!$info->admin_status) {
                exception('此账号已禁用！');
            }

            $this->verifyPwd($params['password'], $info->admin_password);
        } catch (\Exception $e) {
            exception($e->getMessage());
        }

        return $info->admin_id;
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
