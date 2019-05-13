<?php
return [
    'auth_super_id'     => 1,
    'tables' => [
        // 后台用户表
        'admin' => 'admin',
        
        // 角色表
        'role' => 'auth_group',

        // 规则表
        'permission' => 'auth_rule',

        // 中间表
        'role_access' => 'auth_group_access'
    ]
];