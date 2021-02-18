<?php

namespace Crud;

use TAnt\Abstracts\AbstractService;
use think\Model;

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
            'pageSize'   => (int)$pageSize,
            'pageNo'     => (int)$pageNo,
            'totalPage'  => count($data->items()),
            'totalCount' => $data->total(),
        ];
    }

    abstract function filter($q, $query);

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
