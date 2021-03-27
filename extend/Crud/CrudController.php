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

trait CrudController
{
    public function index()
    {
        $query = $this->request->get();

        return $this->sendSuccess($this->service->list($query));
    }

    public function create()
    {
        $data = $this->request->post();
        $this->validteData($data, 'create');
        $this->service->create($data);

        return $this->sendSuccess();
    }

    public function update($id)
    {
        $data = $this->request->put();
        $this->validteData($data, 'update');
        $this->service->update($id, $data);

        return $this->sendSuccess();
    }

    public function delete($id)
    {
        $this->service->delete($id);
        return $this->sendSuccess();
    }

    public function view($id)
    {
        $result = $this->service->view($id);
        return $this->sendSuccess($result);
    }

    public function all()
    {
        return $this->sendSuccess($this->service->all());
    }

    public function info($id)
    {
        return $this->sendSuccess($this->service->info($id));
    }
}
