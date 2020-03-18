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

return [
    // 超级管理员id
    'super_id' => 1,

    // 用户模型
    'user' => [
        'model'       => \app\common\model\User::class,
        'froeign_key' => 'user_id',
    ],

    // 规则模型
    'permission' => [
        'model'       => \app\common\model\Permission::class,
        'froeign_key' => 'permission_id',
    ],

    // 角色模型
    'role' => [
        'model'       => \app\common\model\Role::class,
        'froeign_key' => 'role_id',
    ],

    // 角色与规则中间表模型
    'role_permission_access' => \xiaodi\Permission\Model\RolePermissionAccess::class,

    // 用户与角色中间表模型
    'user_role_access' => \xiaodi\Permission\Model\UserRoleAccess::class,
];
