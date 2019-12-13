<?php

declare(strict_types=1);

namespace app\listener;

use app\event\UserLogin as Event;

/**
 * 触发例子
 * $user = User::find(1);
 * event(new UserLogin($user));
 */
class UserLogin
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle(Event $event)
    {
    }
}
