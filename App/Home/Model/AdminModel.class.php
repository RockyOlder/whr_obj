<?php

namespace Home\Model;

use Think\Model;

class AdminModel extends Model {

    protected $_validate = array(
        array('name', 'require', '名称不能为空！'),
      // array('email', 'number', '只能输入数字'), //默认情况下用正则进行验证  
      //  array('class_no', 'require', '不能为空'),
      //  array('class_leader', 'require', '不能为空！'),
      //  array('grade_no', 'require', '不能为空！'), //classroomid
      //  array('classroom_no', 'require', '不能为空'),
       // array('class_monitor', 'require', '不能为空'),
    );

}