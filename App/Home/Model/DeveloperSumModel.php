<?php 
namespace Admin\Model;
use Think\Model;
class DeveloperSumModel extends Model {
	protected $tableName = 'developer_sum'; 
    array('name','require','用户名必须填写')
    
    function insert(){
        $sql = "insert into ".C('DB_PREFIX')."developer_sum set ";
                $model = D('DeveloperSum');
        $bool = $this->db->query($sql);
        dump($bool);die();
    }
}