<?php
if($_POST)
{	
// dump('string');
    require_once("../../API/CtripUnion.php");
    $cu = new CU('group','SearchLife.php');
    // 第二个参数为返回类型参数，支持string，json，xml，array，object，缺省默认执行对应方法中的respond_xml
    $rt = $cu->SearchLife($_POST,'array');
    
    echo "<meta charset='utf-8' />";
    print_r($rt);
    // return $rt;
}
else
{
    require "temp.html";
}