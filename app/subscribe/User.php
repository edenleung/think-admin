<?php

namespace app\subscribe;

use app\event\UserLogin as Event;

/**
 * 触发例子
 * $user = User::find(1);
 * event(new UserLogin($user));
 */
class User
{
    /**
     * 用户登录事件监听处理
     *
     * @param UserLogin $event
     * @return void
     */
    public function onUserLogin(Event $event)
    {
    }
}
