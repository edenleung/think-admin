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

namespace app;

use TAnt\Abstracts\AbstractModel;

abstract class BaseModel extends AbstractModel
{
    protected $pageSize = 10;

    protected $order = 'id';

    protected $orderType = 'desc';

    /**
     * @return $this
     */
    abstract public static function detail($id);

    /**
     * @return \think\Collection
     */
    public function list(array $query)
    {
        $querys = array_merge([
            'pageNo'   => 1,
            'pageSize' => $this->pageSize,
        ], $query);

        $data = $this->paginate([
            'list_rows' => $querys['pageNo'],
            'page'      => $querys['pageSize'],
        ]);

        return $data;
    }

    /**
     * @return \think\Collection
     */
    public function all()
    {
        return $this->order($this->order, $this->orderType)->select();
    }
}
