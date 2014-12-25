<?php
namespace Home\Model;
use Think\Model;

class BusinessModel extends Model {

//	protected $tableName = 'admin'; 
//	    array('username','require','用户名必须填写'),
//        array('password','require','密码必须填写'),
////        //可以为同一个项目设置多个验证
    // array('verify','require','验证码必须填写'),

    protected $_validate = array(
        //array('email', 'require', '名称不能为空！'),

    );


}


?>
