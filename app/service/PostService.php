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

namespace app\service;

use app\BaseService;
use app\model\Post;

class PostService extends BaseService
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * 岗位列表.
     */
    public function getList()
    {
        $data = $this->model->order('post_sort desc')->select();

        return [
            'data' => $data,
            'pageSize' => 10,
            'pageNo' => 1,
            'totalPage' => 1,
            'totalCount' => count($data),
        ];
    }
}
