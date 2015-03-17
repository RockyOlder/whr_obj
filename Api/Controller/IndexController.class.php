<?php
namespace api\Controller;
use Api\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
    	
        $data=$this->getjson();
        // dump($data);
        $this->assign('data',$data);
        $this->display();
        }

    // 获取数据
	function getjson(){
		$data = $this->getData(APP_PATH.'/'.APP_NAME.'/data/data.json');
		return $data;
	}
	// 获取数据
	function getData($file)
		{
			// var_dump($file);
			// var_dump(file_exists($file));
			$text = file_get_contents($file);
			// dump($text);die;
			$text = preg_replace("%//\s+[^\n]+%", '', $text);
			$data = json_decode($text, true);
			if (empty($data)) {
				return false;
			} else {
				return $this->formatData($data);
			}
		}

	function formatData($data)
	{
		$return = array();
		foreach ($data['controller'] as $key => $value) {
			$api = array_filter(explode(' ', $key));
			// dump($api);
			// dump($value);die();
			$temp = array('type'=>$api[0], 'url'=>trim(end($api)), 'request'=>$value['request'],'des'=>$value['__desc__']);
			$return['api'][] = $temp;
		}
		// dump($data['server']);die;
		$return['server'] = $data['server'];
		$return['model'] = $data['model'];	
		// dump($return);die;
		return $return;
	}
}
