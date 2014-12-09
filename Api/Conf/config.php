<?php
return array(
	//'配置项'=>'配置值'
	// 配置文件
    'config'    =>  array(
        THINK_PATH.'Conf/convention.php',   // 系统惯例配置
        CONF_PATH.'config'.CONF_EXT,      // 应用公共配置
    ),

    // 别名定义
    'alias'     =>  array(
        'Think\Exception'         => CORE_PATH . 'Exception'.EXT,
        'Think\Model'             => CORE_PATH . 'Model'.EXT,
        'Think\Db'                => CORE_PATH . 'Db'.EXT,
        'Think\Cache'             => CORE_PATH . 'Cache'.EXT,
        'Think\Cache\Driver\File' => CORE_PATH . 'Cache/Driver/File'.EXT,
        'Think\Storage'           => CORE_PATH . 'Storage'.EXT,
    ),

    // 函数和类文件
    'core'      =>  array(
        MODE_PATH.'Api/functions.php',
        COMMON_PATH.'Common/function.php',
        MODE_PATH . 'Api/App'.EXT,
        MODE_PATH . 'Api/Dispatcher'.EXT,
        MODE_PATH . 'Api/Controller'.EXT,
        CORE_PATH . 'Behavior'.EXT,
    ),
    // 行为扩展定义
    'tags'  =>  array(
    ),
    /* 数据库配置 */
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'wrtdata', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'wrt_', // 数据库表前缀

    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__'  =>__ROOT__."/Api/View",
        ),
    // 缓存文件前缀
    "DATA_CACHE_PREFIX"=>'api',
    "DATA_CACHE_TIME"=>0,
    // // 设置缓存路径
    // 'DATA_CACHE_PATH'=>__ROOT__."Api/data/cache"
   'LOAD_EXT_CONFIG' => 'add',
// 		用户上传配置
   "no_id"=>"没有传入所需id"
);