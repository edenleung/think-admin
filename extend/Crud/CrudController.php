<?php

namespace Crud;

use TAnt\Abstracts\AbstractController;

abstract class CrudController extends AbstractController
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
