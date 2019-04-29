<?php
namespace app\home\controller;

class Index
{
    public function index()
    {
        new \lib\Category();
        return 'hello, ThinkPHP5';
    }
}
