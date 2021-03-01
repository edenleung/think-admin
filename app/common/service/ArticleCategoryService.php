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

namespace app\common\service;

use TAnt\Util\Category;
use app\common\model\ArticleCategory;

class ArticleCategoryService extends \Crud\CrudService
{
    /**
     * @var ArticleCategory
     */
    protected $model;

    public function __construct(ArticleCategory $model)
    {
        $this->model = $model;
    }

    public function getTree()
    {
        $data = $this->model->order('pid', 0)->select();

        $category = new Category();
        $tree = $category->getTree($data->toArray());

        return $tree;
    }
}
