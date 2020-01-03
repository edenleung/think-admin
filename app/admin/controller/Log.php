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

namespace app\admin\controller;

use app\AbstractController;
use app\model\DbLog;
use app\model\Log as Model;

class Log extends AbstractController
{
    protected $log;

    protected $db;

    public function __construct(Model $model, DbLog $dbLog)
    {
        parent::__construct();
        $this->log = $model;
        $this->db = $dbLog;
    }

    /**
     * 管理员日志列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function account_list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->log->getList((int) $pageNo, (int) $pageSize);
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
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function db_list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->db->getList((int) $pageNo, (int) $pageSize);
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
