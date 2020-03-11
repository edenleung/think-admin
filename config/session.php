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

// | 会话设置
// +----------------------------------------------------------------------

return [
    // session name
    'name' => 'PHPSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache
    'type' => 'file',
    // 存储连接标识 当type使用cache的时候有效
    'store' => null,
    // 过期时间
    'expire' => 1440,
    // 前缀
    'prefix' => '',
];
