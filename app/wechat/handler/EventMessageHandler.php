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

    /**
     * 上报地理位置事件
     *
     * @param [type] $payload
     * @return void
     */
    protected function LOCATION($payload = null)
    {
    }

    /**
     * 自定义菜单事件
     *
     * @param [type] $payload
     * @return void
     */
    protected function CLICK($payload)
    {
    }

    /**
     * 点击菜单跳转链接时的事件推送
     *
     * @param [type] $payload
     * @return void
     */
    protected function VIEW($payload)
    {
    }
}
