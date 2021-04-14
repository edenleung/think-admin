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
use EasyWeChat\Kernel\Messages\Message;
use app\wechat\handle\EventMessageHandler;

class Wechat extends BaseController
{
    /**
     * 微信公众平台通信
     *
     * @return void
     */
    public function index()
    {
        $app = app('wechat.official_account');

        $app->server->push(EventMessageHandler::class, Message::EVENT);

        $response = $app->server->serve();

        $response->send();

        exit;
    }

    /**
     * 微信公众号授权 回调到自有业务
     *
     * @return void
     */
    public function oauth()
    {
        $action = request()->get('action');
        if ($action) {
            $oauth = app('wechat.official_account')->oauth;

            // 带上自定义参数
            $querys = \http_build_query(request()->get());
            $oauth_callback = request()->domain() . '/wechat/wechat/' . $action . '?' . $querys;
            $response = $oauth->scopes(['snsapi_userinfo'])->redirect($oauth_callback);

            $response->send();
        }
    }

    /**
     * 微信公众号授权回调 自有业务
     *
     * @return void
     */
    public function example()
    {
        $oauth = app('wechat.official_account')->oauth;
        $user = $oauth->user();

        // 微信用户信息
        dump($user);

        // 发起授权时设置的自定义参数
        dump(request()->get());
    }
}
