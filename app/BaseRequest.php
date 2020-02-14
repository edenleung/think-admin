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

use think\exception\ValidateException;
use think\Request;
use think\Response;
use think\Validate;

abstract class BaseRequest extends Request
{
    /**
     * @var bool
     */
    public $batch = false;

    /**
     * @var string
     */
    protected $currentScene;

    /**
     * @var array
     */
    protected $scene = [];

    /**
     * @var array
     */
    protected $rule = [];

    /**
     * @var array
     */
    protected $message = [];

    /**
     * 指定场景验证
     *
     * @param string $scene
     * @return $this
     */
    public function scene($scene)
    {
        $this->currentScene = $scene;
        return $this;
    }

    /**
     * 批量验证
     *
     * @param [type] $batch
     * @return $this
     */
    public function batch($batch)
    {
        $this->batch = $batch;

        return $this;
    }

    /**
     * 验证数据.
     *
     * @return bool|Response
     */
    public function validate()
    {
        try {
            $validate = new Validate();
            $validate->rule($this->rule);

            // 验证场景
            if ($this->currentScene) {
                $only = $this->scene[$this->currentScene];
                $validate->only($only);
            }

            // TODO
            // apache 环境下会获取当前url
            // $data = $this->param();

            $data = request()->param();
            $validate->rule($this->rule)->message($this->message)->batch($this->batch)->failException(true)->check($data);
        } catch (ValidateException $e) {
            // 验证失败 默认返回json
            return Response::create([
                'message' => $e->getError(),
                'code' => 50015,
            ], 'json', 200);
        }

        return true;
    }
}
