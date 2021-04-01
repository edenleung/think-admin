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
use Auth\User\AuthorizationUserInterface;

class MemberService extends BaseService
{
    /**
     * @var AuthorizationUserInterface
     */
    protected $member;

    public function __construct(AuthorizationUserInterface $member)
    {
        $this->member = $member;
    }

    /**
     * 处理用户信息更新与创建.
     *
     * @param [type] $user
     *
     * @return Member
     */
    public function handleWechatCallback($user)
    {
        $member = $this->model->where('openid', $user->id)->find();
        $user = $user->toArray();
        $user['openid'] = $user['id'];
        unset($user['id']);
        unset($user['name']);

        if (!$member) {
            $this->model->save($user);
            $member = $this->model;
        } else {
            $member->save($user);
        }

        return $member;
    }

    public function resetPassword($old_password, $new_password)
    {
        if ($this->member->verifyPassword($old_password)) {
            $this->member->password = password_hash($new_password, PASSWORD_DEFAULT);

            return $this->member->save();
        } else {
            exception('密码错误');
        }
    }
}
