<?php

return array(
    'URL_MODEL' => 3,
    'PAGER_CONFIG' => array(
        'prev' => '上一页',
        'next' => '下一页',
        'first' => '首页',
        'last' => '尾页',
        'theme' => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    ),
    //Auth权限设置
    'AUTH_CONFIG' => array(
        'AUTH_ON' => true, // 认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP' => 'wrt_auth_group', // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'wrt_auth_group_access', // 用户-用户组关系表
        'AUTH_RULE' => 'wrt_auth_rule', // 权限规则表
        'AUTH_USER' => 'wrt_admin', // 用户信息表
    ),
    /* 数据库配置 */
    'DB_TYPE' => 'mysqli', // 数据库类型
    'DB_HOST' => '127.0.0.1', // 服务器地址
    'DB_NAME' => 'wrtdate', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'wrt_', // 数据库表前缀
    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . "/App/Home/View/Public",
    ),
    'web_copy' => '版权所有 2014 深圳市慧锐通只能电器股份有限公司',
);