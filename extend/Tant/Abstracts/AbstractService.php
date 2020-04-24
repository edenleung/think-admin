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

namespace Tant\Abstracts;

use think\Model;
use think\facade\Db;
use Tant\Traits\Error;

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

    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }

    public function add(array $input)
    {
        return $this->model->add($input);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function renew($id, array $input)
    {
        return $this->model->renew($id, $input);
    }

    public function remove($id)
    {
        return $this->model->remove($id);
    }

    public function transaction($callback)
    {
        return Db::transaction($callback);
    }
}
