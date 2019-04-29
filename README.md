## ThinkPHP5.1 + vue-element-admin
### 权限后台 后端
[前端](https://github.com/saybabi/thinkphp-ele-admin-vue)

## 安装
`$composer install`

## 权限配置
1. 后台添加规则时，注意`规则`与`菜单路由`这两块
1. 后端api验证权限还是走 `model/conctrooler/action` 方式验证
2. 前端菜单权限 主要读取 `/info` 这条api返回的`role`权限节点

## 路由配置
父级路由 `权限管理` roles 最好配置成子路由权限的
```
{
    path: '',
    component: Layout,
    name: 'auth',
    meta: {
      title: '权限管理',
      icon: 'dashboard',
      roles: ['auth-rule-list']
    },
    children: [
      { path: 'rules', component: () => import('@/views/auth/rules/index'), name: 'rules', meta: { title: '规则管理', roles: ['auth-rule-list'] }}
    ]
  },
```

## 按钮权限
使用 `v-permission`
```
<el-button v-permission="['auth-rule-add']" type="primary" @click="dialogVisible= true">添加</el-button>
```
