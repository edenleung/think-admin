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

namespace TAnt;

use TAnt\Util\Sms;
use think\Service;
use TAnt\Command\Crud\Crud;

class AppService extends Service
{
    public function register()
    {
        $this->registerCommand();
        $this->registerUntil();
    }

    /**
     * 注册命令行.
     *
     * @return void
     */
    protected function registerCommand()
    {
        $this->commands([
            Crud::class,
        ]);
    }

    /**
     * 注册助手.
     *
     * @return void
     */
    protected function registerUntil()
    {
        $this->app->bind('tant.sms', Sms::class);
    }
}
