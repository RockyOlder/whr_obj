<?php
function mk_open($path,$lev=1){
    $dir=  opendir($path);
    while (($row=  readdir($dir))!==false){
        if($row=='.'||$row=='..'){
            continue;
    }
    echo str_repeat('&nbsp;&nbsp;', $lev).$row,'<br/>';
    if(is_dir($path.'/'.$row)){
        mk_open($path.'/'.$row,$lev+1);
    }
}
closedir($dir);
}
mk_open('./');



?>