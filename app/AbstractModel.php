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

namespace app;

use think\Model;
use think\exception\ValidateException;

abstract class AbstractModel extends Model
{
    /**
     * 验证类
     *
     * @var \think\Validate
     */
    protected $validate;

    /**
     * 验证错误信息.
     *
     * @var string
     */
    protected $error;

    /**
     * 获取验证错误信息.
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 验证数据.
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
     */
    protected function validate(string $scene, array $data)
    {
        try {
            \validate($this->validate)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }
}
