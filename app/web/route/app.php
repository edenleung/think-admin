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

use think\facade\Route;
use app\common\model\User;
use tauthz\facade\Enforcer;
use app\common\service\UserService;

Route::get('/2$', function () {

    // $user = User::find(1);
    // $service = new UserService($user);
    // $info = $service->info();
    // dump($info);

    // $data = Enforcer::getPolicy();
    // $roles = Enforcer::getPermissionsForUser('admin');
    // Enforcer::addPolicy('中级管理员', 'articles', 'edit');

    // Enforcer::deleteRolesForUser('admin');
    // Enforcer::addRoleForUser('admin', '管理员');

    dump(Enforcer::enforce('1234', 'UpdateAccount', 'Save'));
});
