<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\listener;

use app\event\UserLogin as Event;

/**
 * 触发例子
 * $user = User::find(1);
 * event(new UserLogin($user));.
 */
class UserLogin
{
    /**
     * 事件监听处理.
     *
     * @return mixed
     */
    public function handle(Event $event)
    {
    }
}
