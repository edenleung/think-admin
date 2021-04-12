## TAnt

[![Build Status](https://travis-ci.org/edenleung/think-admin.svg?branch=6.0)](https://travis-ci.org/edenleung/think-admin)

ThinkPHP 6.0 与 Ant Design Pro Vue 基础前后分离权限系统

#### 警告： 不授权 hexianqi1959 使用

预览地址: 
 * http://ant.wfunc.com

## 前端 
Ant Design Vue Pro [项目](https://github.com/xiaodit/think-ant-vue) [预览](http://ant.wfunc.com)

## 后端

* https://tant-admin.vercel.app

[开发文档](http://muaawn.coding-pages.com)

[开发计划](https://github.com/edenleung/think-admin/projects/1)

[最新版本](https://github.com/edenleung/think-admin/releases/latest)

没安装Composer？ 请在最新版本链接下找到`TAnt_Full.zip`下载

## 安装
### 拉取代码
```bash
git clone https://github.com/edenleung/think-admin.git

# 稳定版
composer create-project xiaodi/tant

# 数据库从 database/2020-05-27.sql 导入
```

### 导入数据表
> database/2020-05-27.sql

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
