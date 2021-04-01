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

namespace app\admin\controller\system;

use Crud\CrudController;
use think\annotation\Inject;
use app\common\service\MenuService;
use Auth\User\AuthorizationController;

class Menu extends AuthorizationController
{
    use CrudController;

    protected $validates = [
        'create' => [
            'name'      => 'require',
            'title'     => 'require',
            'pid'       => 'require',
            'type'      => 'require',
            'path'      => 'require',
            'redirect'  => 'requireIf:type,1',
            'component' => 'requireIf:type,1|requireIf:type,2',
        ],
        'update' => [
            'name'      => 'require',
            'title'     => 'require',
            'pid'       => 'require',
            'type'      => 'require',
            'path'      => 'require',
            'redirect'  => 'requireIf:type,1',
            'component' => 'requireIf:type,1|requireIf:type,2',
        ],
    ];

    /**
     * @Inject
     *
     * @var MenuService
     */
    protected $service;

    public function tree()
    {
        return $this->sendSuccess(['data' => $this->service->getTree()]);
    }
}
