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

namespace TAnt\Util;

use think\Cache;

// 用法
// 发送
// if (!app('tant.sms')->has($phone)) {
//     $code = round(100000, 999999);
//     发送验证码成功后
//     app('tant.sms')->set($phone, $code);
// }

// 验证
// if (app('tant.sms')->verify($phone, $code)) {
//     // 成功
//     app('tant.sms')->delete($phone);
// }

class Sms
{
    /**
     * @var Cache
     */
    protected $cache;
    protected $pre = 'sms_';
    protected $exp = 3600;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function verify($key, $value)
    {
        if ($cvalue = $this->has($key)) {
            return $value == $cvalue;
        }

        return false;
    }

    public function has($key)
    {
        return $this->hasKey($key);
    }

    public function set($phone, $value)
    {
        $this->setKey($phone, $value);
    }

    public function delete($phone)
    {
        $this->deleteKey($phone);
    }

    private function setKey($key, $value)
    {
        $this->cache->set($this->pre . '_' . $key, $value, $this->exp);
    }

    private function hasKey($key)
    {
        return $this->cache->has($this->pre . '_' . $key);
    }

    private function deleteKey($key)
    {
        return $this->cache->delete($this->pre . '_' . $key);
    }
}
