<?php

declare(strict_types=1);

namespace app\admin\service;

use app\BaseService;
use app\common\model\ArticleCategory;
use Tant\Util\Category;

class ArticleCategoryService extends BaseService
{
    public function __construct(ArticleCategory $model)
    {
        $this->model = $model;
    }

    public function list($pageNo, $pageSize)
    {
        $data = $this->model->paginate([
            'list_rows' => $pageSize,
            'page' => $pageNo,
        ]);

        return [
            'data' => $data->items(),
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            'totalPage' => count($data->items()),
            'totalCount' => $data->total(),
        ];
    }

    public function tree()
    {
        $data = $this->model->order('pid asc')->select()->toArray();
        $category = new Category(['id', 'pid', 'name']);
        return $category->getTree($data);
    }

    public function categorys($pid)
    {
        return $this->model->where('pid', $pid)->where('disable', 0)->select();
    }

    public function create(array $data)
    {
        return $this->model->save($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->save($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
