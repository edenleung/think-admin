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

    public function list(array $query)
    {
        $pageNo = isset($query['pageNo']) ? $query['pageNo'] : 1;
        $pageSize = isset($query['pageSize']) ? $query['pageSize'] : $this->pageSize;

        $data = $this->model->alias('a')->where(function ($q) use ($query) {
            call_user_func([$this, 'filter'], ...[$q, $query]);
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

    abstract public function filter($q, $query);

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
        if ($row) {
            return $row->save($data);
        }

        return false;
    }

    public function delete($id)
    {
        $row = $this->info($id);
        if ($row) {
            return $row->delete();
        }

        return false;
    }

    public function info($id)
    {
        $row = $this->model->with($this->with)->find($id);

        if ($row) {
            return $row;
        }

        $this->error = '没有此记录';

        return false;
    }

    public function all()
    {
        return $this->model->with($this->with)->order($this->order)->select();
    }
}
