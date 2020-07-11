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

namespace TAnt\Command\Backup;

use think\console\Input;
use think\console\Output;
use think\console\Command;

class Backup extends Command
{
    protected function configure()
    {
        $this->setName('tant:backup')
            ->setDescription('数据库备份');
    }

    protected function execute(Input $input, Output $output)
    {
        // TODO
    }
}
