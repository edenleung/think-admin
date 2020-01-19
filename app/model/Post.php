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
use app\model\validate\PostValidate;

class Post extends AbstractModel
{
    protected $pk = 'postId';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'createTime';
    protected $updateTime = 'updateTime';

    protected $validate = PostValidate::class;

    public function addPost(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        return Post::create($data);
    }

    public function updatePost(int $id, array $data)
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

    public function deletePost(int $id)
    {
        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $rule->delete();
    }
}
