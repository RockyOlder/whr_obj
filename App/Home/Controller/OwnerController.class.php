<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class OwnerController extends IsloginController {

    public function index() {
        $this->display();
       
    }

    public function add() {
        $this->display();
    }

    public function get() {
        if (IS_POST) {
            $file = $_POST['file'];
            $data = $this->phpexcel($file);
            print_r($data);exit;
            $sum = count($data)+1;
            for ($i=1; $i <= $sum ; $i++) { 
                // dump($i);
                $v=$data[$i];
                array_pop($v);
                $str = "'".implode("','", $v)."'";
                $field = "id,name,mobile,address,water,electric,gas";
                $sql =" insert into ".C('DB_PREFIX')."pro_owner(".$field.",property_id) values(".$str.",".I('request.property_id').")";
                // dump($sql);die();
                $bool =M()->execute($sql);
                //dump($i);
                //dump($bool); 
                if ($bool && $i == 20) {
                    //echo 1;exit;
                     $this->success('成功插入',U('index'));
                }             
            }
            
           
            // $this->success('成功插入',U('index'));
            // dump($data);die();
            // dump($_POST);die();
        }
        // dump($_SERVER);
        // dump(session());die();
        // 获取所有的物业信息，选择导入那个物业
        $data['title'] = "导入业主";
        $data['action'] = 'insert';
        $this->assign('data',$data);
        $field = "id,pname";
        $property = M('property')->field($field)->select();
        // dump($property);
        $this->assign('property',$property);
        $this->display();        
    }
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
