<?php

namespace app\wechat\handler;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 接管事件消息
 * 
 */
class EventMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return call_user_func([$this, $payload['Event']], $payload);
    }

    /**
     * 关注事件
     *
     * @param [type] $payload
     * @return void
     */
    protected function subscribe($payload = null)
    {
    }

    /**
     * 取消关注事件
     *
     * @param [type] $payload
     * @return void
     */
    protected function unsubscribe($payload = null)
    {
    }

    /**
     * 二维码事件
     *
     * @param [type] $payload
     * @return void
     */
    protected function SCAN($payload = null)
    {
    }
}
