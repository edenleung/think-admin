<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\wechat\handler;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 接管事件消息.
 */
class EventMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return call_user_func([$this, $payload['Event']], $payload);
    }

    /**
     * 关注事件.
     *
     * @param [type] $payload
     *
     * @return void
     */
    protected function subscribe($payload = null)
    {
    }

    /**
     * 取消关注事件.
     *
     * @param [type] $payload
     *
     * @return void
     */
    protected function unsubscribe($payload = null)
    {
    }

    /**
     * 二维码事件.
     *
     * @param [type] $payload
     *
     * @return void
     */
    protected function SCAN($payload = null)
    {
    }
}
