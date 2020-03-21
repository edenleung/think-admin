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

namespace app\common\model;

use app\BaseModel;
use app\common\traits\Log;
use xiaodi\Permission\Contract\PermissionContract;

class Permission extends BaseModel implements PermissionContract
{
    use Log;
    use \xiaodi\Permission\Traits\Permission;
}
