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

namespace app\common\service;

use think\facade\Db;
use app\common\model\Role;
use app\common\model\Rule;
use app\common\model\MenuAction;

class RoleService extends \Crud\CrudService
{
    /**
     * @var Role
     */
    protected $model;

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function list(array $query)
    {
        $querys = array_merge([
            'pageNo' => 1,
            'pageSize' => 10
        ], $query);

        $data = $this->model->paginate([
            'list_rows' => $querys['pageSize'],
            'page'      => $querys['pageNo'],
        ]);

        return $data->items();
    }

    public function create($data)
    {
        Db::transaction(function () use ($data) {
            $this->model->save([
                'title' => $data['title'],
            ]);

            $ids = array_map(function ($item) {
                return ['menu_action_id' => $item];
            }, $data['actions']);

            $this->model->actions()->saveAll($ids);
            $this->addEnforcer($this->model->id, $data['actions']);
        });
    }

    public function update($id, $data)
    {
        Db::transaction(function () use ($id, $data) {
            $row = $this->info($id);
            $row->actions()->select()->delete();
            Rule::where('ptype', 'p')->where('v0', $row->id)->delete();

            $row->save([
                'title'  => $data['title'],
                'status' => $data['status'],
            ]);

            $ids = array_map(function ($item) {
                return ['menu_action_id' => $item];
            }, $data['actions']);

            $row->actions()->saveAll($ids);
            $this->addEnforcer($row->id, $data['actions']);
        });
    }

    protected function addEnforcer($id, $actions)
    {
        $actions = MenuAction::whereIn('id', $actions)->with('menu')->select();
        foreach ($actions as $item) {
            Rule::insert([
                'ptype' => 'p',
                'v0'    => $id,
                'v1'    => $item->menu->name,
                'v2'    => $item->name,
            ]);
        }
    }

    public function delete($id)
    {
        Db::transaction(function () use ($id) {
            $row = $this->info($id);
            Rule::where('ptype', 'p')->where('v0', $row->title)->delete();

            $row->actions()->select()->delete();
            $row->delete();
        });
    }
}
