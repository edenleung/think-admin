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

namespace app\model;

use app\AbstractModel;
use app\model\validate\DeptValidate;

class Dept extends AbstractModel
{
    protected $pk = 'dept_id';

    protected $validate = DeptValidate::class;

    public function getTree()
    {
        $data = $this->select();
        $category = new \extend\Category(['dept_id', 'dept_pid', 'dept_name', 'cname']);

        $tree = $category->formatTree($data->toArray());
        return $tree;
    }

    public function addDept(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        return Dept::create($data);
    }

    public function updateDept(int $id, array $data)
    {
        if ($this->validate('update', $data) === false) {
            return false;
        }

        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $rule->save($data);
    }

    public function deleteDept(int $id)
    {
        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $rule->delete();
    }

    public function getChildrenDepts($deptPid)
    {
        $data = $this->select();
        $category = new \extend\Category(['dept_id', 'dept_pid', 'dept_name', 'cname']);

        $tree = $category->getTree($data->toArray(), $deptPid);
        return $tree;
    }
}
