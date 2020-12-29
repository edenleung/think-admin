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

namespace app\api\controller;

use TAnt\Abstracts\AbstractController;
use app\common\model\Member;
use think\annotation\Inject;

class MemberController extends AbstractController
{
    /**
     * Member实例(已登录).
     *
     * @Inject
     *
     * @var Member
     */
    protected $member;
}
