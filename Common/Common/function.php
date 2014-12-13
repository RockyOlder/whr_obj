<?php

// 对密码进行加密
function change($salt = "", $password = '') {
    // dump
    if ($password == '') {
        $password = md5(I('post.password'));
    }
    // var_dump($password);die();
    if (!empty($salt)) {
        // var_dump(md5($salt.$password));die;
        return md5($salt . $password);
    } else {
        return $password;
    }
}

// 对json数据的处理
function data() {
    $data = $_POST['json'];
    // var_dump($data);die();
    return $data = json_decode($data, true);
}

function _vialg($value) {

    $sbust = implode(",", $value);
    $word = D('ProKeyword');
    $wordlist = $word->where("id=1")->find();
    $list = json_decode($wordlist['pname']);
    foreach ($list as $v) {
        if (strstr($sbust, $v)) {
            $res = $v . "是关键字";
        }
    }
    return $res;
}
