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

use app\common\model\Article;

class ArticleService extends \Crud\CrudService
{
    /**
     * @var Article
     */
    protected $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function list(array $query)
    {
        $querys = array_merge([
            'pageNo'   => 1,
            'pageSize' => 10,
        ], $query);

        $data = $this->model->with('category')->where(function ($q) use ($query) {
            if (isset($query['title'])) {
                $q->whereLike('title', '%' . $query['title'] . '%');
            }
        })->paginate([
            'list_rows' => $querys['pageSize'],
            'page'      => $querys['pageNo'],
        ]);

        return $data;
    }
}
