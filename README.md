## TAnt

[![Build Status](https://travis-ci.org/edenleung/think-admin.svg?branch=6.0)](https://travis-ci.org/edenleung/think-admin)

ThinkPHP 6.0 与 Ant Design Pro Vue 基础前后分离权限系统

#### 警告： 不授权 hexianqi1959 趣果科技 使用

预览地址: 
 * https://vben.wfunc.com

## 前端 
Vben-Admin [项目](https://github.com/edenleung/think-vben-admin) [预览](https://vben.wfunc.com)

[开发文档](https://vvbin.cn/doc-next/)


## 安装

### 导入数据表
> database/2021-05-14-vben.sql

## 定时任务

### 配置
```php
class Example
{
    public function register()
    {
        new Crontab('* * * * * *', function () {
            echo date('Y-m-d H:i:s') . "\n";
        });
    }
}
```

### 注册

```php
<?php

namespace app\command;

class Tasker extends Command
{
    protected $tasks = [
        Example::class,
    ];
}

```

### 启动

`php think tasker start`

## 其它包
### 权限包
https://github.com/xiaodit/think-permission

### JWT包
https://github.com/xiaodit/think-jwt

### h5 模板
https://github.com/edenleung/vue-h5-template

## 打赏
如果此项目对你有帮助的，不忘给我打赏哦。

<div>
    <img src="./static/author.png" width="250" />
</div>

# License
Apache License Version 2.0
