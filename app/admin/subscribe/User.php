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

namespace app\admin\subscribe;

use app\common\model\AccountLog;
use app\admin\event\UserLogin as Event;

class User
{
    /**
     * 用户登录事件监听处理.
     *
     * @param UserLogin $event
     */
    public function onUserLogin(Event $event)
    {
        AccountLog::create([
            'user_id'    => $event->user->id,
            'action'     => '登录',
            'url'        => request()->url(),
            'ip'         => request()->ip(),
            'user_agent' => request()->header('USER_AGENT'),
        ]);
    }
}
