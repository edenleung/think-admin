<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace Crud;

use TAnt\Abstracts\AbstractService;

abstract class CrudService extends AbstractService
{
    protected $pageSize = 10;

    protected $order = 'id desc';

    protected $with;

    protected $alias = 'a';

    public function list(array $query)
    {
        $pageNo = isset($query['pageNo']) ? $query['pageNo'] : 1;
        $pageSize = isset($query['pageSize']) ? $query['pageSize'] : $this->pageSize;

        $data = $this->model->alias($this->alias)->where(function ($q) use ($query) {
            if (method_exists($this, 'filter')) {
                call_user_func([$this, 'filter'], ...[$q, $query]);
            }
        })->paginate([
            'list_rows' => $pageSize,
            'page'      => $pageNo,
        ]);

        return [
            'data'       => $data->items(),
            'pageSize'   => (int) $pageSize,
            'pageNo'     => (int) $pageNo,
            'totalPage'  => count($data->items()),
            'totalCount' => $data->total(),
        ];
    }

    public function with($with)
    {
        $this->with = $with;

        return $this;
    }

    public function create(array $data)
    {
        return $this->model->save($data);
    }

    public function update($id, array $data)
    {
        $row = $this->info($id);
        return $row->save($data);
    }

    public function delete($id)
    {
        $row = $this->info($id);
        return $row->delete();
    }

    public function info($id)
    {
        $row = $this->model->with($this->with)->find($id);

        if ($row) {
            return $row;
        }

        exception('没有此记录');
    }

    public function all()
    {
        return $this->model->with($this->with)->order($this->order)->select();
    }
}
