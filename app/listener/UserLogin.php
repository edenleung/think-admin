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
