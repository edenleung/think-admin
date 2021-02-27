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

use app\BaseService;
use app\common\model\Article;

class ArticleService extends BaseService
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function list(int $pageNo, int $pageSize, $params = [])
    {
        $query = $this->model->alias('a')->with('category');

        if (isset($params['status'])) {
            $query->where('a.status', $params['status']);
        }

        if (isset($params['title']) && !empty($params['title'])) {
            $query->whereLike('a.title', '%' . $params['title'] . '%');
        }

        if (!empty($params['cid'])) {
            $query->where('c.id', $params['cid']);
        }

        $query->join('article_category c', 'a.category_id = c.id')
            ->field('a.*')
            ->order('top desc, a.id desc');

        $data = $query->paginate([
            'list_rows' => $pageSize,
            'page'      => $pageNo,
        ]);

        return [
            'data'       => $data->items(),
            'pageSize'   => $pageSize,
            'pageNo'     => $pageNo,
            'totalPage'  => count($data->items()),
            'totalCount' => $data->total(),
        ];
    }
    public function info($id)
    {
        return $this->model->with('category')->find($id);
    }
}
