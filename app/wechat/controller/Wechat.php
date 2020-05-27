<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\wechat\controller;

use app\BaseController;
use app\common\service\MemberService;

class Wechat extends BaseController
{
    /**
     * 微信公众平台通信
     *
     * @return void
     */
    public function index()
    {
        $response = app('wechat.official_account')->server->serve();

        $response->send();

        exit;
    }

    /**
     * 微信公众号授权.
     *
     * @return void
     */
    public function oauth()
    {
        $callback = 'http://www.domain.com/wechat/callback';
        $response = app('wechat.official_account')->oauth->scopes(['snsapi_userinfo'])
            ->redirect($callback);
        $response->send();
    }

    /**
     * 微信授权回调.
     *
     * @param MemberService $member
     *
     * @return void
     */
    public function callback(MemberService $member)
    {
        // $oauth = app('wechat.official_account')->oauth;

        // // 获取 OAuth 授权结果用户信息
        // $user = $oauth->user();

        // unset($user['original']);
        // $member = $member->handleWechatCallback($user);

        // $token = app('jwt')->store('app')->token(['uid' => $member->id, 'nickname' => $user->name, 'type' => 'wechat']);
        // return redirect("http://localhost:8080?token={$token}");
    }
}
