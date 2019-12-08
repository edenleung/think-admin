<?php

namespace app\traits;

trait ValidateError
{
    /**
     * 验证错误信息
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
}