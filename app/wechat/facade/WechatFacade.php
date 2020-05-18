<?php

declare(strict_types=1);

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
