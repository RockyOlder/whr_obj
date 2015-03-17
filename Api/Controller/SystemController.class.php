<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class SystemController extends CommonController {
  /**
   * 获取大众点评的appkey和secrat
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-08T09:26:16+0800
   * @return [type]                   [description]
   */
  public function people()
  {
    $id = I('request.version',1,'intval');
    if($id == 1){
      $root = $this->getPath();
      $path = $root.'/Data/people';
      $out['data']= json_decode(file_get_contents($path),true);
      $out['success'] = 1;
      $out['msg'] = '成功';
      $this->ajaxReturn($out);
    }
  }
  /**
   * 更新商店的人均消费数量
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-10T09:57:12+0800
   * @return [type]                   [description]
   */
    public function update()
  {
    $id = I('request.version',1,'intval');
    if($id == 1){
      $bid = M('business')->field('id')->select();
      foreach ($bid as $k => $v) {
        $avg = M('life_goods')->field('avg(price) as price')->where(array('bid'=>$v['id']))->find();
        //讲平均值压入数据库表中
        if(is_null($avg['price'])) $avg['price']=0;
        $data = array('id'=>$v['id'],'avg_price'=>$avg['price']);
        $bool=M('business')->save($data);
        // dump($avg['price']);
        // dump($data);
        // dump(rand($data[0]['price']));die();
      }
      $out['success']=1;
      $out['msg']="数据更新完成";
      $out['data']=null;
      $this->ajaxReturn($out);
    }   
  }
  /**
   * 获取用户完善资料的进度
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-09T16:51:25+0800
   * @return [type]                   [description]
  */
   public function step()
  {
    $id = I('request.version',1,'intval');
    if($id == 1){
      $uid = I('request.userId',0,'intval');
      
      $flag = M('user')->field('flag')->where(array('user_id'=>$uid))->find();
      if ($flag) {
        $flag = current($flag);
      }else{
        $flag = 0;
      }
      switch ($flag) {
        case '1':
          $out['msg'] = "你已经提交了个人信息，请耐心等候管理员的审核";
          break;
        case '2':
          $out['msg'] = "你已经通过审核，成功升级为vip";
          break;
        case '3':
          $out['msg'] = "你提交的个人信息未通过管理员审核！";
          break;
        
        default:
          $out['msg'] = "你还没有完善个人信息";
          break;
      }     
      $out['success']=1;
      $out['data']=$flag;
      $this->ajaxReturn($out);
    }
   
  }
    
  /**
    * 关键字提示
    * @author xujun
    * @email  [jun0421@163.com]
    * @date   2015-01-07T20:14:32+0800
    * @return [type]                   [description]
  */
  public function keyword(){
    $id = I('request.version',1,'intval');   
    if ($id == 1) {
      $keyword = I('request.keyword');
      //dump($keyword);
      $city = I('request.city',1,'intval');
      $area = I('request.area',0,'intval');
      //查找用户的关键字分类
      $w= "type_name like '%$keyword%'";
      //dump($w);
      $field = 'type_id,type_name';//
      $cate = M('type')->field($field)->where($w)->select();
      // 寻找分类对应的商店是否存在
      foreach ($cate as $k => $v) {
        $w="(type = $v[type_id] or parent_type = $v[type_id]) and city = $city";
        if ($area != 0) {
        $w .= " and area = $area";
      }
        $num =M('business')->where($w)->count();
        if ($num != 0){
          $v['num'] = $num;
          $tem[] = $v;
        }
      }
      // 保存有商店的分类
      
      //按照商店的名字
      $w="name like '%$keyword%' and city = $city";
      if ($area != 0) {
        $w .= " and area = $area";
      }
      $shop = M('business')->field('name')->where($w)->limit(5)->select();
      foreach ($shop as $k => $v) {
        $v['id'] = 0;
        $v['num']=1;
        $tem[]=$v;
      }
      $out['data'] = $tem;
      $out[success]=1;
      $out[msg]='成功';
      $this->ajaxReturn($out);
    }

  }
  /**
    * vip搜索关键字提示
    * @author xujun
    * @email  [jun0421@163.com]
    * @date   2015-01-07T20:14:32+0800
    * @return [type]                   [description]
  */
  public function vipword(){
    $id = I('request.version',1,'intval');   
    if ($id == 1) {
      $keyword = I('request.keyword');
      //查找用户的关键字分类
      $w= "cat_name like '%$keyword%'";
      //dump($w);
      $field = 'cat_id,cat_name,parent_id';//
      $cate = M('category')->field($field)->where($w)->select();
      //dump($cate);
      // 寻找分类对应的商店是否存在
      foreach ($cate as $k => $v) {
        $w="cat_id = $v[cat_id]";      
        $num =M('goods')->where($w)->count();
        if ($num != 0){
          $v['num'] = $num;
          $tem[] = $v;
        }
      }
      $num = 10-count($tem);
      // 保存有商店的分类
      
      //按照商店的名字
      $w="goods_name like '%$keyword%'";
      
      $shop = M('goods')->field('goods_name')->where($w)->limit($num)->select();
      foreach ($shop as $k => $v) {
        $v['id'] = 0;
        $v['num']=1;
        $tem[]=$v;
      }
      $out['data'] = $tem;
      $out[success]=1;
      $out[msg]='成功';
      $this->ajaxReturn($out);
    }

  }
  /**
   * 组合出根路径
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-10T10:02:37+0800
   * @return [type]                   [description]
   */
  private function getPath() {
      // 组合出文件的路径
      $start = str_replace('\\', '/', dirname(__FILE__));
      //dump($start);
      $start = str_replace('/Api/Controller', '', $start);
      //dump($start);
      return $start;
  }
   
    
    
  
}
