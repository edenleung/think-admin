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
        $result = $this->service->create($data);

        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function update($id)
    {
        $data = $this->request->put();
        $this->validteData($data, 'update');
        $result = $this->service->update($id, $data);

        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function view($id)
    {
        $result = $this->service->view($id);
        if ($result !== false) {
            return $this->sendSuccess($result);
        }

        return $this->sendError($this->service->getError());
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
