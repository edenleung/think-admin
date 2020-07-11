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

namespace TAnt\Abstracts;

use think\Model;
use think\facade\Db;
use TAnt\Traits\Error;

abstract class AbstractService
{
    use Error;

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($pageNo, $pageSize)
    {
        $data = $this->model
            ->paginate([
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

    public function create(array $data)
    {
        return $this->model->save($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->save($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function transaction($callback)
    {
        return Db::transaction($callback);
    }
}
