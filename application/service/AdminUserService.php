<?php
namespace app\service;

use app\service\model\rbac\AdminModel;

/**
 * 后台用户服务类.
 */
class AdminUserService
{
    protected $model;

    public function __construct()
    {
        $this->model = new AdminModel;
    }

    /**
     *
     */
    public function doLogin(array $params)
    {
        try {
            $info = $this->model->getUserInfo($params['username']);

            if (!$info->admin_status) {
                exception('此账号已禁用！');
            }

            $this->verifyPwd($params['password'], $info->admin_password);
        } catch (\Exception $e) {
            throw $e;
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
