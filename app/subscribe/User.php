<?php

namespace app\subscribe;

use app\event\UserLogin as Event;
use app\model\Log;

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
        Log::create([
            'user_id'    => $event->user->id,
            'action' => '登录',
            'url'    => request()->url(),
            'ip'     => request()->ip(),
            'user_agent' => request()->header('USER_AGENT')
        ]);
    }
}
