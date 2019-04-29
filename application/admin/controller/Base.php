<?php
namespace app\admin\controller;

use app\common\HttpResponse;
use app\service\model\rbac\RuleModel;
use app\lib\Category;

/**
 *
 */
class Base extends HttpResponse
{
    public function __construct()
    {
        parent::__construct();
    }
}
