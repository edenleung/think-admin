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

namespace app\admin\controller\system;

use app\BaseController;
use app\admin\service\ArticleService;

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

        if (!$result) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    public function update($id)
    {
        $result = $this->service->update($id, request()->put());

        if (!$result) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);

        if (!$result) {
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
