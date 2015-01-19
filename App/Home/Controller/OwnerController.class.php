<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class OwnerController extends IsloginController {
    /**
     * 业主列表
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T16:06:53+0800
     * @return [type]                   [description]
     */
    public function index() {   
        $owner = M("pro_owner");
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
        $count = $owner->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 30);
        $show = $page->show();
     //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $type = M("type");
        $typeList = $type->select();
        $data = $owner//->field('id,name,mobile_phone,fax_mobile,user_name,address,star,lock,list_pic')
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign('type', $typeList);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
       
    }
    /**
     * 添加或者修改单个的业主
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T13:10:26+0800
     */
    public function add() {
        $model = M('pro_owner');
        if (IS_POST) {
            $data = $_POST;
            ////dump($_POST);
            ////dump($_POST['id'] == "");
            if($data['id'] == ""){
                unset($data['id']);
                dump($data);
                //dump($model);
                $bool = $model->add($data);
                //dump($bool);die();
                $msg = "添加业主失败";
            }else{
                $bool = $model->save($data);
                $msg = "修改业主信息失败";
            }
           if ($bool) {
              $this->redirect('index','', 0, '');
           }else{
            $this->error($msg);
           }
            
        }
        $id = I('get.id',0,'intval');
        if ($id == 0) {
            $data['title'] = '添加业主信息';
            $data['btn'] = '添加业主';
        }else{
            // 根据id查找用户的信息
            $w = array('id'=>$id);            
            $info=$model->where($w)->find();
            $info=$this->assign('info',$info);
            $data['id'] = $id;
            $data['title'] = '修改业主信息';
            $data['btn'] = '修改业主';
        }
        $property = M('property')->field($field)->select();
        // dump($property);
        $this->assign('property',$property);
        $this->assign('data',$data);
        $this->display();
    }
    /**
     * 导入业主信息
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T13:10:49+0800
     * @return [type]    [description]
     */
    public function get() {
        if (IS_POST) {
            $file = $_POST['file'];
            $data = $this->phpexcel($file);
            $sum = count($data)+1;
            // dump($sum);
            for ($i=2; $i < $sum ; $i++) { 
                // dump($i);
                $v=$data[$i];
                array_shift($v);
                $str = "'".implode("','", $v)."'";
                $field = "name,mobile,address";
                $sql =" insert into ".C('DB_PREFIX')."pro_owner(".$field.",property_id) values(".$str.",".I('request.property_id').")";
                // dump($sql);die();
                $bool =M()->execute($sql);
                if ($bool && $i == $sum-1) {
                    header("Content-type: text/html; charset=utf-8");
                    $this->redirect('Owner/index', '', 3, '页面跳转中...');
                }             
            }
        }
        // dump($_SERVER);
        // dump(session());die();
        // 获取所有的物业信息，选择导入那个物业
        $data['title'] = "导入业主信息";
        $this->assign('data',$data);
        $field = "id,pname";
        $property = M('property')->field($field)->select();
        // dump($property);
        $this->assign('property',$property);
        $this->display();        
    }
    /**
     * 导入业主账单
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T13:11:24+0800
     * @return [type]                   [description]
     */
    public function fee() {
        if (IS_POST) {
            $table = "pro_owner_bill";
            $file = $_POST['file'];
            $data = $this->phpexcel($file);
            // dump($data);die();            
            $sum = count($data)+1;
            for ($i=2; $i < $sum ; $i++) {                 
                $v=$data[$i];
                //查询出用户的id
                // 根据地址查询用户的oid如果地址匹配不成功怎用用户名和电话匹配
                $w = array('address'=>$v['D']);
                $oid = M('pro_owner')->field('id')->where($w)->find();
                if (!$oid) {
                    $w = array('mobile'=>$v['C'],'name'=>$v['B']);
                    $oid = M('pro_owner')->field('id')->where($w)->find();
                    if (!$oid) {
                       continue;
                    }
                }
                $id = current($oid);               
                // 组合好数组
                $arr = array(  
                    'date'   =>strtotime(I('request.time')),               
                    'use_water'=>$v['E'],
                    'water_price'=>$v['F'],
                    'water_fee'=>$v['G'],
                    'use_elec'=>$v['H'],
                    'elec_price'=>$v['I'],
                    'elec_fee'=>$v['J'],
                    'use_gas'=>$v['K'],
                    'gas_price'=>$v['L'],
                    'gas_fee'=>$v['M'],
                    'manage_fee'=>$v['N'],
                    'car_fee'=>$v['O'],
                    'net_fee'=>$v['P'],
                    'mobile_fee'=>$v['Q'],
                    'fit_fee'=>$v['R'],
                    'swim_fee'=>$v['S']
                    );
                $arr['oid'] = $id;
                $bool =M($table)->add($arr);
                // dump($i);
                // dump($sum);
                // dump($bool && $i ==$sum-1);
                if ($bool && $i == $sum-1) {
                    header("Content-type: text/html; charset=utf-8");
                    $this->redirect('Owner/index', '', 3, '页面跳转中...');
                }             
            }
        }
        // dump($_SERVER);
        // dump(session());die();
        // 获取所有的物业信息，选择导入那个物业
        $data['title'] = "导入业主账单";
        $this->assign('data',$data);
        $field = "id,pname";
        $property = M('property')->field($field)->select();
        // dump($property);
        $this->assign('property',$property);
        $this->display();        
    }
    /**
     * 读取excel文件的内容返回一个数组
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T13:11:42+0800
     * @param  [type]                   $file [description]
     * @return [type]                         [description]
     */
    function phpexcel($file){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //要导入的xls文件，位于根目录下的Public文件夹
        $filename=$file;
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        import("Org.Util.PHPExcel.Reader.Excel5");
        //如果excel文件后缀名为.xlsx，导入这下类
        //import("Org.Util.PHPExcel.Reader.Excel2007");
        // $PHPReader=new \PHPExcel_Reader_Excel2007();

        $PHPReader=new \PHPExcel_Reader_Excel5();
        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //数据坐标
                $address=$currentColumn.$currentRow;
                //读取到的数据，保存到数组$arr中
                $arr[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
            }
        
        }
            //dump($arr);
            return $arr;
    }
  
}

?>
