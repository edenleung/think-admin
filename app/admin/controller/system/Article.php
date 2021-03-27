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

use app\BaseController;
use Crud\CrudController;
use think\annotation\Inject;
use app\common\service\ArticleService;

class Article extends BaseController
{
    use CrudController;

    protected $validates = [
        'create' => [
            'title'                 => 'require',
            'article_category_id'   => 'require',
            'content'               => 'require',
        ],
        'update' => [
            'title'                 => 'require',
            'article_category_id'   => 'require',
            'content'               => 'require',
        ],
    ];

    /**
     * @Inject
     *
     * @var ArticleService
     */
    protected $service;
}
