<?php

declare(strict_types=1);

namespace Tant\Command\Backup;

use think\console\Command;
use think\console\Input;
use think\console\Output;

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
