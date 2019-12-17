<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\controller;

use app\model\DbLog;
use app\model\Log as Model;

class Log extends AbstractController
{
    protected $log;

    protected $db;

    public function __construct(Model $model, DbLog $dbLog)
    {
        $this->log = $model;
        $this->db = $dbLog;
    }

    /**
     * 管理员日志列表.
     *
     * @param mixed $page
     * @param mixed $pageSize
     */
    public function acount_list($page = 1, $pageSize = 10)
    {
        $data = $this->log->getList((int)$page, (int)$pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 删除管理员日志.
     *
     * @param string $id
     */
    public function account_delete($id)
    {
        if ($this->log->deleteLog($id) === false) {
            return $this->sendError($this->log->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * CURD日志列表.
     *
     * @param mixed $page
     * @param mixed $pageSize
     */
    public function db_list($page = 1, $pageSize = 10)
    {
        $data = $this->db->getList((int)$page, (int)$pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 删除CURD日志.
     *
     * @param string $id
     */
    public function db_delete($id)
    {
        if ($this->db->deleteLog($id) === false) {
            return $this->sendError($this->db->getError());
        }

        return $this->sendSuccess();
    }
}
