<?php
namespace Mobile\Controller;
use Think\Controller;
//社区调查的显示页面
class IndexController extends Controller {
    public function index(){
    	$id = I('request.id',0,'intval');
        $w= array('id'=>$id);
        if (IS_AJAX) {
            if (!isset($_POST['answer'])) {
                $this->error('没有选择任何答案');
            }
                //检查用户是否参见过调查活动
           
            $num =$_POST['answer'];
            // dump($num);
            switch ($num) {
                case '1':
                    $unit= 'survey_verygood';
                    break;
                case '2':
                    $unit= 'survey_good';
                    break;
                case '3':
                    $unit= 'survey_general';
                    break;
                case '4':
                    $unit= 'survey_nogood';
                    break;
                case '5':
                    $unit= 'survey_bad';
                    break;
            }
            $data = array('uid'=>I('post.uid',0,'intval'),'sid'=>I('post.id',0,'intval'),'info'=>$unit,'add_time'=>time());
            //dump($data);
            $bool = M('pro_survey_sign')->add($data);
            //dump($bool);die();
            M('pro_survey')->where($w)->setInc($unit);
            M('pro_survey')->where($w)->setInc('number');

            
            if ($bool) {                
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }   
        $w = array('uid'=>I('get.uid',0,'intval'),'sid'=>I('get.id',0,'intval'));
        $data = M('pro_survey_sign')->field('id')->where($w)->find();
        if ($data) {
            $this->assign('end',1);
        }else{
            $data=M('pro_survey')->where($w)->find();
            $data['add_time'] = date('Y-m-d H:i:s',$data['add_time']);
            if ($data['number'] == 0) {
                $data['one'] = 0;
                $data['two'] = 0;
                $data['three'] = 0;
                $data['four'] = 0;
                $data['five'] = 0;
            }else{
            // dump($data);
            $data['one'] = round(($data['survey_verygood']*100/$data['number'] >100)?100:$data['survey_verygood']*100/$data['number'],2);
            $data['two'] = round(($data['survey_good']*100/$data['number'] > 100)?100:$data['survey_good']*100/$data['number'],2);
            $data['three'] = round(($data['survey_general']*100/$data['number'] > 100)?100:$data['survey_good']*100/$data['number'],2);
            $data['four'] = round(($data['survey_nogood']*100/$data['number'] > 100) ?100:$data['survey_nogood']*100/$data['number'],2);
            $data['five'] = round(($data['survey_bad']*100/$data['number'] > 100)?100:$data['survey_bad']*100/$data['number'],2);
            // dump($data);
            }
            $this->assign('data',$data);        
        }
        
        $this->display();
        }


}