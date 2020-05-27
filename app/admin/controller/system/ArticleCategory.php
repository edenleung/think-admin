<?php

declare(strict_types=1);

namespace app\admin\controller\system;

use app\admin\service\ArticleCategoryService;
use app\BaseController;

class ArticleCategory extends BaseController
{
    public function __construct(ArticleCategoryService $service)
    {
        $this->service = $service;
    }

    public function tree()
    {
        return $this->sendSuccess(
            $this->service->tree()
        );
    }

    public function list()
    {
        return $this->sendSuccess(
            $this->service->tree()
        );
    }

    public function create()
    {
        $result = $this->service->create(request()->post());
        if (! $result) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    public function update($id)
    {
        $result = $this->service->update($id, request()->put());
        if (! $result) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if (! $result) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}
