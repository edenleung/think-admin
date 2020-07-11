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

namespace TAnt\DataScope;

use app\common\model\Dept;
use app\common\model\User;

class Scope
{
    const DATA_SCOPE_ALL = 1;

    const DATA_SCOPE_CUSTOM = 2;

    const DATA_SCOPE_DEPT = 3;

    const DATA_SCOPE_DEPT_AND_CHILD = 4;

    const DATA_SCOPE_SELF = 5;

    /**
     * Undocumented function.
     *
     * @param [type] $tableAlias 主表的别名
     */
    public function handle($tableAlias)
    {
        $user = request()->user;
        $sql = '';
        if (!$user->isSuper()) {
            // 非超级管理员 则进行数据过滤
            $sql = $this->dataScopeFilter($tableAlias, $user);
        }

        return $sql;
    }

    private function dataScopeFilter($tableAlias, User $user)
    {
        $roles = $user->roles;
        $sqls = [];
        $index = 0;
        foreach ($roles as $role) {
            $scope = $index > 0 ? 'OR' : '';

            if ($role->mode == self::DATA_SCOPE_ALL) {
                continue;
            }
            if ($role->mode == self::DATA_SCOPE_CUSTOM) {
                // 自定义数据
                $ids = implode(',', $role->depts->column('dept_id'));
                $sqls[] = sprintf(" {$scope} %s.dept_id IN (%s) ", $tableAlias, $ids);
            } elseif ($role->mode == self::DATA_SCOPE_DEPT) {
                // 本部门数据
                $sqls[] = sprintf(" {$scope} %s.dept_id = %s ", $tableAlias, $user->dept_id);
            } elseif ($role->mode == self::DATA_SCOPE_DEPT_AND_CHILD) {
                // 本部门数据及以下部门数据
                $depts[] = $user->dept_id;
                $data = Dept::select()->toArray();
                $category = new \TAnt\Util\Category(['id', 'pid', 'name', 'cname']);
                $children = array_column($category->getTree($data, $role->dept_id), 'dept_id');
                if (!empty($children)) {
                    $depts = array_merge($depts, $children);
                }

                $ids = implode(',', $depts);
                $sqls[] = sprintf(' %s.dept_id IN (%s) ', $tableAlias, $ids);
            } elseif ($role->mode == self::DATA_SCOPE_SELF) {
                $sqls[] = sprintf(' %s.user_id = %s', $tableAlias, $user->id);
            }

            $index++;
        }

        return implode('', $sqls);
    }
}
