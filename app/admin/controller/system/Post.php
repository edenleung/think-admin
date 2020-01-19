<?php

namespace app\admin\controller\system;

use app\AbstractController;

class Post extends AbstractController
{
    public function __construct(\app\model\Post $post)
    {
        parent::__construct();
        $this->model = $post;
    }

    public function list()
    {
        $data = $this->model->order('postSort desc')->select();
        return $this->sendSuccess([
            'data' => $data,
            'pageSize' => 10,
            'pageNo' => 1,
            'totalPage' => 1,
            'totalCount' => count($data)
        ]);
    }

    public function add()
    {
        if (! $this->model->addPost($this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function update(int $id)
    {
        if (! $this->model->updatePost($id, $this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function delete(int $id)
    {
        if ($this->model->deletePost($id) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
