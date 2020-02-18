<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\controller\log;

use app\BaseController;
use app\service\AccountLogService;

class AccountLog extends BaseController
{
    public function __construct(AccountLogService $service)
    {
        $this->service = $service;
    }

    /**
     * 管理员日志列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->service->list((int) $pageNo, (int) $pageSize);

        return $this->sendSuccess($data);
    }

    /**
     * 删除管理员日志.
     *
     * @param string $id
     */
    public function delete($id)
    {
        if ($this->service->remove($id) === false) {
            return $this->sendError('操作失败');
        }

        return $this->sendSuccess();
    }
}
