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

namespace app\common\service;

use app\BaseService;
use app\common\model\Member;

class MemberService extends BaseService
{
    public function __construct(Member $model)
    {
        $this->model = $model;
    }

    /**
     * 处理用户信息更新与创建.
     *
     * @param [type] $user
     *
     * @return void
     */
    public function handleWechatCallback($user)
    {
        $member = $this->model->where('openid', $user->id)->find();
        $user = $user->toArray();
        $user['openid'] = $user['id'];
        unset($user['id']);

        if (!$member) {
            $this->model->save($user);
            $member = $this->model;
        } else {
            $member->save($user);
        }

        return $member;
    }
}
