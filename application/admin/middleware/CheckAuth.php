<?php

namespace app\admin\middleware;

use xiaodi\Auth;
use app\service\model\rbac\AdminModel;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use think\facade\Config;

/**
 * 权限中间件
 */
class CheckAuth
{
    public function handle($request, \Closure $next)
    {
        // if ($request->controller() != 'Auth') {
        //     $header = request()->header();
        //     if (empty($header['authorization'])) {
        //         return response(['code' => 50001, 'message' => '缺少 token'], 200, [], 'json');
        //     }

        //     $oauthToken = $header['authorization'];
        //     $token = (new Parser())
        //         ->parse((string) $oauthToken);

        //     $data = new ValidationData();

        //     if (!$token->validate($data)) {
        //         return response(['code' => 50008, 'message' => '签名过期或错误'], 200, [], 'json');
        //     }

        //     if ($token->getClaim('uid') != Config::get('auth.auth_super_id')) {
        //         $res = $this->checkAuth($token->getClaim('uid'));
        //         if (!$res) {
        //             return response(['code' => 50015, 'message' => '没有操作权限！'], 200, [], 'json');
        //         }
        //     }

        //     $request->uid = $token->getClaim('uid');
        // }

        return $next($request);
    }

    /**
     * 权限验证
     */
    protected function checkAuth($uid)
    {
        try {
            $user = new AdminModel;
            $userInfo = $user->getInfo($uid);

            // 获取auth实例
            $auth = Auth::instance();

            $pathInfo = dispatchPath();
            // 放行_ajax开头的方法
            if (strpos(request()->action(), '_ajax') === false) {
                // 检测权限
                if (!$auth->check($pathInfo, $uid)) {
                    return false;
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return true;
    }
}
