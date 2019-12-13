<?php

declare(strict_types=1);

namespace app\controller;

use app\model\Log as Model;
use app\model\DbLog;

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
     * 管理员日志列表
     *
     * @return void
     */
    public function acount_list($page = 1, $pageSize = 10)
    {
        $data = $this->log->getList($page, $pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 删除管理员日志
     *
     * @param string $id
     * @return void
     */
    public function account_delete($id)
    {
        if (false === $this->log->deleteLog($id)) {
            return $this->sendError($this->log->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * CURD日志列表
     *
     * @return void
     */
    public function db_list($page = 1, $pageSize = 10)
    {
        $data = $this->db->getList($page, $pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 删除CURD日志
     *
     * @param string $id
     * @return void
     */
    public function db_delete($id)
    {
        if (false === $this->db->deleteLog($id)) {
            return $this->sendError($this->db->getError());
        }

        return $this->sendSuccess();
    }
}
