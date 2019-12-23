## T-Ant
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Ant-Design-Vue-Pro](https://img.shields.io/travis/edenleung/think-ant-vue.svg)](https://github.com/xiaodit/think-ant-vue)

ThinkPHP 6.0 与 Ant-Design-Vue 基础权限系统  

前端: 
Ant Design Vue Pro [项目](https://github.com/xiaodit/think-ant-vue) . [预览](https://ant.xiaodim.com)

## 安装
- 拉取最新源码
```sh
git clone https://github.com/edenleung/think-admin.git
```

- 依赖安装
```sh
composer i
```
- 配置数据库
```sh
cp .env.example .env
```

- 迁移数据
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
