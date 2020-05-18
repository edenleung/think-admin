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

namespace app\wechat\facade;

use think\Facade;

class WechatFacade extends Facade
{
    /**
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function officialAccount()
    {
        return app('wechat.official_account');
    }

    /**
     * @return \EasyWeChat\Work\Application
     */
    public static function work()
    {
        return app('wechat.work');
    }

    /**
     * @return \EasyWeChat\Payment\Application
     */
    public static function payment()
    {
        return app('wechat.payment');
    }

    /**
     * @return \EasyWeChat\MiniProgram\Application
     */
    public static function miniProgram()
    {
        return app('wechat.mini_program');
    }

    /**
     * @return \EasyWeChat\OpenPlatform\Application
     */
    public static function openPlatform()
    {
        return app('wechat.open_platform');
    }

    protected static function getFacadeClass()
    {
        return 'wechat.official_account';
    }
}
