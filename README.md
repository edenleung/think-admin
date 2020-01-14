## T-Ant
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/edenleung/think-admin.svg?branch=6.0)](https://travis-ci.org/edenleung/think-admin)

ThinkPHP 6.0 与 Ant Design Pro Vue 基础前后分离权限系统

前端: 
Ant Design Vue Pro [项目](https://github.com/xiaodit/think-ant-vue) [预览](https://ant.wfunc.com)

QQ 群 `996887666` 暗号 `Tant`

[开发计划](https://github.com/edenleung/think-admin/projects/1)

[最新版本](https://github.com/edenleung/think-admin/releases/latest)

没安装Composer？ 请在最新版本链接下找到`Tant_Full.zip`下载

## 安装
### 正式版本
```sh
composer create-project xiaodi/tant
```

### 开发版本
- 拉取最新源码
```sh
git clone https://github.com/edenleung/think-admin.git
```

- 依赖安装
```sh
composer i
```
### 配置数据库
```sh
cp .env.example .env
```

### 迁移数据
```
php think migrate:run
```

### 账号
* 超级管理员 `admin, 1234` 
* 普通管理员 `xiaodi, 1234`

### 权限包
https://github.com/xiaodit/think-permission

### JWT包
https://github.com/xiaodit/think-jwt

