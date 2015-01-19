<?php

namespace Home\Controller;

use Think\Controller;

/**
 * 保证用户必须登录
 */
class IsloginController extends Controller {

    private $field = "region_id,region_name";

	function __construct()
	{
		//调用父类的construct方法，免去覆盖父类的方法
		parent::__construct();
		if (session('admin') == "" || session('user_auth') == "") {
			//$this->error('你还没有登录',U('Login/index','',''));
            $this->redirect('Login/index','', 0, '');       //
		}
        $this->checkself();
        
	}

    function checkself() {
        //检查权限
        if (!checkpermission()) {
            $this->error('你没有访问权限');
        };
    }

    //获取左边的用户可访问列表
    function getleft() {
        // 获取用的id
        $id = session('admin.id');
        //开发时间组织了登录，所以用户的id默认为1，显示全部的菜单
        //$id = 1;
        $pre = C('DB_PREFIX');
        // 获取用户分组的权限
        $sql = "select rules from " . $pre . "auth_group_access as a join " . $pre . "auth_group as g on a.group_id = g.id where a.uid = $id";
        //dump($sql);
        $rule = M()->query($sql);
        if (is_array($rule)) {
            $rule = current($rule[0]);
        }
        // dump($rule == "all");
        // // 超级管理员查询出来所有的顶级数据
        if ($rule == "all") {
            $sql = "select id,title from " . $pre . "auth_rule where type = 1 and status = 1 and add_type = 1 and add_pid = 0 ";
            // dump($sql);
            $data = M()->query($sql);
            // dump($data);
            // 循环顶级数据查询自己的数据
            foreach ($data as $k => $v) {
                $sql = "select id,title,name from " . $pre . "auth_rule where type = 1 and status = 1 and add_type = 2 and add_pid = $v[id] ";
                $son = M()->query($sql);
                $data[$k]['son'] = $son;
            }
        } else {
            $sql = "select id,title from " . $pre . "auth_rule where type = 1 and status = 1 and add_type = 1 and add_pid = 0 and id in (" . $rule . ")";
            // dump($sql);
            $data = M()->query($sql);
            // dump($data);
            // 循环顶级数据查询自己的数据
            foreach ($data as $k => $v) {
                $sql = "select id,title,name from " . $pre . "auth_rule where type = 1 and status = 1 and add_type = 2 and add_pid = $v[id] and id in (" . $rule . ")";
                $son = M()->query($sql);
                $data[$k]['son'] = $son;
            }
        }
        // dump($data);die;
        return $data;
    }

    //获取城市省份列表
    function getprovence() {
        //查询出所有的省份
        $sql = "SELECT " . $this->field . " FROM " . C('DB_PREFIX') . "region where parent_id = 1";
        // dump($sql);
        return M()->query($sql);
    }

    //根据省的id查询出所有的城市列表
    function getcity($id) {
//     	dump($id);
//     	dump(empty($id));
        if (empty($id))
            return null;

        $sql = "select " . $this->field . " from " . C('DB_PREFIX') . "region where parent_id =" . $id;
//     	dump($sql);
        return M()->query($sql);
    }

    function getSaveCity($id) {
      if (empty($id))
            return null;
        $region = M("region");
        $typeList = $region->where("REGION_ID=" . $id)->find();
        $typeList['list'] = $region->where("PARENT_ID=" . $typeList['PARENT_ID'] . " and REGION_ID!=" . $typeList['REGION_ID'])->select();
         return $typeList;
    }

    //根据城市的id查询出所有的区列表
    function getvillage($id) {
        if (empty($id))
            return null;

        $sql = "select " . $this->field . " from " . C('DB_PREFIX') . "region where parent_id =" . $id;
        return M()->query($sql);
    }

    function getvicare($id) {
        if (empty($id))
            return null;

        $sql = "select " . $this->field . " from " . C('DB_PREFIX') . "region where REGION_ID =" . $id;
        return M()->query($sql);
    }

    //查询出城市的总数据
    function fullcity() {
        $data = $this->getprovence();
        //dump($data);$sql
        foreach ($data as $k => $v) {
            $id = $v['rid'];
            $city = $this->getcity($id);
            foreach ($city as $k1 => $v1) {
                $id = $v1['rid'];
                $city[$k1]['vallage'] = $this->getvillage($id);
            }
            $data[$k]['city'] = $city;
        }
        return $data;
    }

    //查询出城市的总数据
    function topCate() {
        $sql = "select type_id,type_name from " . C('DB_PREFIX') . "type where parent_id = 0";
        // dump($sql);
        $data = M()->query($sql);
        // dump($data);
        return $data;
    }

    function getsonCate($id) {
        if (empty($id))
            return null;

        $sql = "select type_id,type_name from " . C('DB_PREFIX') . "type where parent_id = $id";

        return M()->query($sql);
    }

    //获取商店的名称和编号
    function getshop() {
        $sql = "select id,name from " . C('DB_PREFIX') . "business";
        // dump($sql);
        $data = M()->query($sql);
        // dump($data);
        return $data;
    }

    public function getChaBetweenTwoDate($date1, $date2) {

        $Date_List_a1 = explode("-", $date1);

        $Date_List_a2 = explode("-", $date2);

        $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);

        $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);

        $Days = round(($d1 - $d2) / 3600 / 24);

        return $Days;
    }

    public function getTree($cat, $id = 0) {
        $tree = array();
        $cats = $cat->select();
        while ($id > 0) {
            foreach ($cats as $v) {
                if ($v['cat_id'] == $id) {
                    $tree[] = $v;

                    $id = $v['parent_id'];
                    break;
                }
            }
        }

        return array_reverse($tree);
    }

    public function getCatTree($arr, $id = 0, $lev = 0) {
        $tree = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == $id) {
                $v['lev'] = $lev;
                $tree[] = $v;
                $tree = array_merge($tree, $this->getCatTree($arr, $v['cat_id'], $lev + 4));
            }
        }
        return $tree;
    }

    /*   function getdata($table) {

      // dump($page);
      // dump($pageSize);

      $sql = "select * from " . C('DB_PREFIX') . $table;
      // dump($sql);die();
      $data = M()->query($sql);
      // dump($data);die();
      return $data;
      }
     * 
     */
}