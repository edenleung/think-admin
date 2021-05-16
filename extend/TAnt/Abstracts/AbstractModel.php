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

namespace TAnt\Abstracts;

use think\Model;
use think\model\concern\SoftDelete;

abstract class AbstractModel extends Model
{
    use SoftDelete;

    protected $autoWriteTimestamp = true;

    protected $createTime = 'create_time';

    protected $updateTime = 'update_time';

    protected $deleteTime = 'delete_time';

    protected $defaultSoftDelete = 0;

    abstract public static function detail($id);
}
