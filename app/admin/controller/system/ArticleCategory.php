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

use Auth\User\AuthorizationController;
use Crud\CrudController;
use think\annotation\Inject;
use app\common\service\ArticleCategoryService;

class ArticleCategory extends AuthorizationController
{
    use CrudController;

    protected $validates = [
        'create' => [
            'title' => 'require',
            'pid'   => 'require',
        ],
        'update' => [
            'title' => 'require',
            'pid'   => 'require',
        ],
    ];

    /**
     * @Inject
     *
     * @var ArticleCategoryService
     */
    protected $service;

    public function tree()
    {
        return $this->sendSuccess($this->service->getTree());
    }
}
