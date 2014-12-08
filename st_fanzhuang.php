<?php

function getStr($str){
        $len=strlen($str);
        for ($i=0;$i<$len/2;$i++){
                $temp=$str[$i];
                        $str[$i]=$str[$len-$i-1];
                        $str[$len-$i-1]=$temp;
        }
           return $str;
}

$str='abcdefg';
var_dump(getStr('abcdefg'));

?>