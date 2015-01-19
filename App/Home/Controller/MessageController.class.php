<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class MessageController extends IsloginController {

    public function index() {
        $title = "wo 我来试试推送";
        $des = "添加看看推送";
        $this->pushMessage_android ($title,$des);
        $data = $this->getdata();
        $this->assign('data', $data);
        $this->display();
    }
    public function send() {
        global $apiKey;
        global $secretKey;
        //$title = "wo 我来试试推送";
        //$des = "添加看看推送";
        //$bool =$this->pushMessage_android ($title,$des);
        
        //请开发者设置自己的apiKey与secretKey
        $apiKey = "5ovo3aUDxYFyw3M145SFRsXn";
        $secretKey = "E2k5HEWO9zG7mTK8ZPxLQcTF0uhOiqMZ";
        $bool =$this->test_pushMessage_android();
        //dump($bool);
    }



function error_output ( $str ) 
{
    echo "\033[1;40;31m" . $str ."\033[0m" . "\n";
}

function right_output ( $str ) 
{
    echo "\033[1;40;32m" . $str ."\033[0m" . "\n";
}


function test_queryBindList ( $userId ) 
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ($apiKey, $secretKey) ;
    $optional [ Channel::CHANNEL_ID ] = "3915728604212165383"; 
    $ret = $channel->queryBindList ( $userId, $optional ) ;
    if ( false === $ret ) 
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }   
}



//推送android设备消息
function test_pushMessage_android ()
{
    global $apiKey;
    global $secretKey;
    import("Org.baidu.Channel");
    $channel = new \Channel ( $apiKey, $secretKey ) ;
    //推送消息到某个user，设置push_type = 1; 
    //推送消息到一个tag中的全部user，设置push_type = 2;
    //推送消息到该app中的全部user，设置push_type = 3;
    $push_type = 3; //推送单播消息
    // $optional[Channel::USER_ID] = $user_id; //如果推送单播消息，需要指定user
    //optional[Channel::TAG_NAME] = "xxxx";  //如果推送tag消息，需要指定tag_name
    //指定发到android设备
    //$channel->USER_ID = 3;
    $channel->DEVICE_TYPE = 3;
    //指定消息类型为通知
    $channel->MESSAGE_TYPE = 1;
    //通知类型的内容必须按指定内容发送，示例如下：
    $message = '{ 
            "title": "我的百度推送",
            "description": "现在是demo设置来试试",
            "notification_basic_style":7,
            "open_type":1,
            "url":"http://www.baidu.com"
        }'; 
    $message_key = "msg_key";
    $ret = $channel->pushMessage ( $push_type, $message, $message_key, $optional ) ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}

//推送ios设备消息
function test_pushMessage_ios ($user_id)
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ( $apiKey, $secretKey ) ;

    $push_type = 1; //推送单播消息
    $optional[Channel::USER_ID] = $user_id; //如果推送单播消息，需要指定user

    //指定发到ios设备
    $optional[Channel::DEVICE_TYPE] = 4;
    //指定消息类型为通知
    $optional[Channel::MESSAGE_TYPE] = 1;
    //如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
    //旧版本曾采用不同的域名区分部署状态，仍然支持。
    $optional[Channel::DEPLOY_STATUS] = 1;
    //通知类型的内容必须按指定内容发送，示例如下：
    $message = '{ 
        "aps":{
            "alert":"msg from baidu push",
            "sound":"",
            "badge":0
        }
    }';
    
    $message_key = "msg_key";
    $ret = $channel->pushMessage ( $push_type, $message, $message_key, $optional ) ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}


function test_initAppIoscert ( $name, $description, $release_cert, $dev_cert )
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ($apiKey, $secretKey) ;
    //如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
    //旧版本曾采用不同的域名区分部署状态，仍然支持。
    //$optional[Channel::DEPLOY_STATUS] = 1;
    
    $ret = $channel->initAppIoscert ($name, $description, $release_cert, $dev_cert) ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}

function test_updateAppIoscert ( $name, $description, $release_cert, $dev_cert )
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ($apiKey, $secretKey) ;
    //如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
    //旧版本曾采用不同的域名区分部署状态，仍然支持。
    //$optional[Channel::DEPLOY_STATUS] = 1;

    $optional[ Channel::NAME ] = $name;
    $optional[ Channel::DESCRIPTION ] = $description;
    $optional[ Channel::RELEASE_CERT ] = $release_cert;
    $optional[ Channel::DEV_CERT ] = $dev_cert;
    $ret = $channel->updateAppIoscert ($optional) ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}

function test_queryAppIoscert ( )
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ($apiKey, $secretKey) ;
    //如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
    //旧版本曾采用不同的域名区分部署状态，仍然支持。
    //$optional[Channel::DEPLOY_STATUS] = 1;

    $ret = $channel->queryAppIoscert () ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}

function test_deleteAppIoscert ( )
{
    global $apiKey;
    global $secretKey;
    $channel = new Channel ($apiKey, $secretKey) ;
    //如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
    //旧版本曾采用不同的域名区分部署状态，仍然支持。
    //$optional[Channel::DEPLOY_STATUS] = 1;

    $ret = $channel->deleteAppIoscert () ;
    if ( false === $ret )
    {
        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!' ) ;
        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
    }
    else
    {
        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
    }
}
}
