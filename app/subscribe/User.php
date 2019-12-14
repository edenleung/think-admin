<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\subscribe;

use app\event\UserLogin as Event;
use app\model\Log;

class User
{
    /**
     * 用户登录事件监听处理.
     *
     * @param UserLogin $event
     */
    public function onUserLogin(Event $event)
    {
        Log::create([
            'user_id' => $event->user->id,
            'action' => '登录',
            'url' => request()->url(),
            'ip' => request()->ip(),
            'user_agent' => request()->header('USER_AGENT'),
        ]);
    }
}
