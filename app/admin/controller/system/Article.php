<?php

declare(strict_types=1);

namespace app\admin\controller\system;

use app\admin\service\ArticleService;
use app\BaseController;

class Article extends BaseController
{
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function list($pageNo = 1, $pageSize = 10)
    {
        return $this->sendSuccess($this->service->list($pageNo, $pageSize));
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

    public function info($id)
    {
        return $this->sendSuccess(
            $this->service->info($id)
        );
    }
}
