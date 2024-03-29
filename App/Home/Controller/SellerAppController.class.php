<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class SellerAppController extends IsloginController {

    
    /**
     * 生活导航申请页面只有慧锐通总管理平台能够查看
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-02-01T09:18:48+0800
     * @return [type]                   [description]
     */
    public function life() {
        // dump(session());
         $owner = M("admin");
         $where = array('flag'=>1,'type'=>0,'statue'=>2);                
        if (IS_POST) {
            $name = I('post.name');
            $mobile = I('post.mobile');
            $address = I('post.address');
            if ($name)
                $where['name'] = array('LIKE', '%' . $name . '%');
            if ($mobile)
                $where['mobile'] = array('LIKE', '%' . $mobile . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
        }
        // dump($where);die();
        $count = $owner->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 20);
        $show = $page->show();
     //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        
        $data = $owner->field('id,name,mobile,email,true_name,type,developer,add_time')
                ->where($where)->order('add_time desc')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        // dump($owner->getlastSql());die();
        foreach ($data as $k => $v) {            
            $data[$k] = $this->appRole($v);
        }
        // dump($where);
        // dump($data);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    } 
    /**
     * 生活导航申请页面只有慧锐通总管理平台能够查看
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-02-01T09:18:48+0800
     * @return [type]                   [description]
     */
    public function vip() {
        // dump(session());
         $owner = M("admin");
         $where = array('flag'=>1,'type'=>1,'statue'=>3);                
        if (IS_POST) {
            $name = I('post.name');
            $mobile = I('post.mobile');
            $address = I('post.address');
            if ($name)
                $where['name'] = array('LIKE', '%' . $name . '%');
            if ($mobile)
                $where['mobile'] = array('LIKE', '%' . $mobile . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
        }
        // dump($where);die();
        $count = $owner->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 20);
        $show = $page->show();
     //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        
        $data = $owner->field('id,name,mobile,email,true_name,type,developer,add_time')
                ->where($where)->order('add_time desc')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        // dump($owner->getlastSql());die();
        foreach ($data as $k => $v) {            
            $data[$k] = $this->appRole($v);
        }
        // dump($where);
        // dump($data);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    } 
    /**
     * 生活导航申请页面只有慧锐通总管理平台能够查看
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-02-01T09:18:48+0800
     * @return [type]                   [description]
     */
    public function developer() {
        // dump(session());
         $owner = M("admin");
         $where = array('flag'=>1,'statue'=>4,'shop_id'=>0);                
        if (IS_POST) {
            $name = I('post.name');
            $mobile = I('post.mobile');
            $address = I('post.address');
            if ($name)
                $where['name'] = array('LIKE', '%' . $name . '%');
            if ($mobile)
                $where['mobile'] = array('LIKE', '%' . $mobile . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
        }
        // dump($where);die();
        $count = $owner->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 20);
        $show = $page->show();
     //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        
        $data = $owner->field('id,name,mobile,email,true_name,type,developer,add_time')
                ->where($where)->order('add_time desc')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        // dump($owner->getlastSql());die();
        //dump($data);
        foreach ($data as $k => $v) {            
            $data[$k] = $this->appRole($v);
        }
        // dump($where);
           //dump($data);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }  
    /**
     * 查看用户的详情申请页面
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-02-01T09:35:33+0800
     * @return [type]                   [description]
     */
    public function info(){
        $id = I('get.id',0,'intval');
        // dump($data);die;
        // 查找用户的所有东西
        $data = M('admin')->where(array('id'=>$id))->find();
        // dump($data);
        if ($data['statue'] == 2) { //代表生活导航的申请商家
			$data['title'] = '服务商家申请详情';
            $shop = M('business b')
                  ->join('wrt_business_shop AS s ON b.id = s.bid')
                  ->where('b.id='.$data['shop_id'])->find();
			$shop[more_pic] = json_decode($shop[more_pic],true);
			$arr ="REGION_ID in ($shop[province],$shop[city],$shop[area])";
				$address = M('region')->field('REGION_NAME')->where($arr)->select();
				if($address){
					
				$shop[address_info] = current($address[0]).current($address[1]).current($address[2]).$shop['address'];
					
				}
			$tpl = 'lifeinfo';
        }elseif($data['statue'] == 3 ) { //代表vip申请商家
			$data['title'] = 'VIP商家申请详情';
            $shop = M('vip')
                  ->where('store_id='.$data['shop_id'])->find();
                  //dump(M('business')->getlastSql());
                  // dump($shop);die();
            $arr ="REGION_ID in ($shop[province],$shop[city],$shop[area])";
				$address = M('region')->field('REGION_NAME')->where($arr)->select();
				if($address){
					
				$shop[address_info] = current($address[0]).current($address[1]).current($address[2]).$shop['address'];
					
				}
            $tpl = 'vipinfo';
        }elseif($data['statue'] == 4 ) { //代表开发商申请
        	$data['title'] = '开发商申请详情';
            $shop = M('developer_sum')
                  ->where('id='.$data['developer'])->find();
				  //dump(M('developer_sum')->)
                  // dump($shop);die();
            if($shop){
            	$arr ="REGION_ID in ($shop[province],$shop[city],$shop[area])";
				$address = M('region')->field('REGION_NAME')->where($arr)->select();
				if($address){
					
				$shop[address_info] = current($address[0]).current($address[1]).current($address[2]).$shop['address'];
					
				}
				//dump($address_info);            	
            }
            
			$tpl = 'developerinfo';
        }
		$data = $this->appRole($data);
		//dump($data);
		//dump($shop);
        $this->assign('info',$data);
        $this->assign('shop',$shop);
        $this->display($tpl);
    }
    public function delApp(){
        $id = I('post.id',0,'intval');
        if ($id == 0) {
            $this->error('缺少参数');
        }
        // 查询出用户的参数
        $data = M('admin')->field('id,statue,shop_id,house')->where(array('id'=>$id))->find();
        // dump($data);die();
        M()->startTrans();
        // $w = array(uid)
        if ($data[statue] == 2) { //生活导航
            $bool1 = M('admin')->delete($id);
            $bool2 = M('business')->delete($data[shop_id]);
            $bool3 = M('business_shop')->where(array('bid'=>$data[shop_id]))->delete();
			$bool4 = M('wrt_auth_group_access')->where(array('uid'=>$id))->delete();
            $bool = true;
        }elseif($data[statue] == 3){
            $bool1 = M('admin')->delete($id);
            $bool2 = M('vip')->delete($data[shop_id]);
			$bool4 = M('wrt_auth_group_access')->where(array('uid'=>$id))->delete();
            $bool = true;
        }elseif($data[statue] == 4){
            $bool1 = M('admin')->delete($id);
            $bool2 = M('developer')->delete($data[house]);
            $bool3 = M('developer_info')->where(array('did'=>$data[house]))->delete();
			$bool4 = M('wrt_auth_group_access')->where(array('uid'=>$id))->delete();
            $bool = true;
        }
        if($bool){
            $this->ajaxReturn(1);
        }
        $this->ajaxReturn(0);
    }
    
	//通过管理员的申请
	function toPass(){
		$id = I('post.id');
		$life = I('post.life');
		$data=array('is_lock'=>0,'flag'=>0,'id'=>$id);
        // dump($data);
		$bool = M('admin')->save($data);
		if($bool){
			if($life == 1){
				$data = M('admin')->field('shop_id')->where(array('id'=>$id))->find();
				$data = array('id'=>$data['shop_id'],'lock'=>0);
				M('business')->save($data);
			}
            if($life == 0){
                $data = M('admin')->field('shop_id')->where(array('id'=>$id))->find();
                $data = array('id'=>$data['shop_id'],'lock'=>0);
                M('vip')->save($data);
            }
            if($life == 2){
                
            }
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}

    function addRole($uid,$rid){
        $arr = array('uid'=>$uid,'group_id'=>$rid);
        M('auth_group_access')->add($arr);

    }
    function changeRole($uid,$rid){
        $w = array('uid'=>$uid);
        $arr = array('group_id'=>$rid);
        M('auth_group_access')->where($w)->save($arr);
    }
	function appRole($v){
        // dump($v);die();
		if ($v[type] == 1) {
           $v['role'] = "VIP商家";
        }elseif ($v[type] == 0 && $v[developer] == 0) {
            $v[role] ="生活导航商家";
        }elseif ($v[developer] != 0) {
            $v[role] ="房地产开发商";
        }
		return $v;
	}
    public function village(){
        $id = I('post.id',0,'intval');
        if (!$id) {
            $this->ajaxReturn(null);
        }
        // 查找物业下面的小区
        $w = array('property_id'=>$id);
        $data = M('village')->field('id,name')->where($w)->select();
        // dump($data);die();
        if ($data) {
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(null);
        }
    }

}

?>
