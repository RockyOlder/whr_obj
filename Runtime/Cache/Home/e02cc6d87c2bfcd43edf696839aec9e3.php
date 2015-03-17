<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($data["title"]); ?></title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
        <script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
        <script src="/App/Home/View/Public/Js/easy_validator.pack.js"></script>
        <link href="/App/Home/View/Public/Css/validate.css" rel="stylesheet" type="text/css">
        
    </head>
    

<body style="background: none;">

    <div class="place">
        <span>位置： </span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
            <li>系统管理</li>
            <li><a href="<?php echo U('index');?>">快递公司列表</a></li>
            <li><?php echo ($data["title"]); ?></li>
        </ul>
    </div>
    
        <div class="formbody" style="width:70%;margin:0 auto;" >

            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

            <ul class="forminfo">
                <li><label>快递公司名称:</label><input name="name" id="name" type="text" class="dfinput"  tip="不能修改"  value="<?php echo ($info["name"]); ?>" readonly="readonly"/></li>
               
                <li><label>快递公司电话</label><input name="phone" reg="1\d{10}|0\d{2,3}-\d{7,8}" tip="不能修改" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"  readonly="readonly"/><i></i></li>
                <li><label>每公斤价格</label><input name="price" type="text" class="dfinput"  value="<?php echo ($info["price"]); ?>"  reg="[1-9]\d*" tip="不能修改"   readonly="readonly"/><i>非特殊地区每公斤的价格</i></li>               
                <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">            
                <input type="hidden" id ="delInfo" value="<?php echo U('delInfo');?>">
                <input type="hidden" id="back_url" value="<?php echo U('info',array('id'=>$info['id']));?>">
            </ul>
            <div class="formtitle">
                <span>特殊省份地区及每公斤价格</span>
                <div  style="margin-left:220px" class="btn btn-info" onclick="ajaxAdd(<?php echo ($info["id"]); ?>)"></span>添加特殊地区</div>
            </div>
               <table class="tablelist">
                <thead>
                    <tr>
                       
                        <th width="10%">编号</th>
                        <th>特殊省份</th>
                        <th width="10%">每公斤价格</th>                
                        <th colspan="2">操作</th>
                    </tr>
                </thead>
                <tbody id="table_ajax_list">
                    <?php if(is_array($array)): $i = 0; $__LIST__ = $array;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["area"]); ?></td>
                            <td><?php echo ($vo["price"]); ?></td> 
                            <td width="45px"> 
                                <a href="#">
                                    <div  onclick="if(confirm('确定要修改该项信息？'))ajaxedit(<?php echo ($vo["id"]); ?>)" style="cursor: pointer;">修改
                                    </div>
                                    <input type="hidden" value="<?php echo U('editinfo');?>" id = 'ajaxedit'>
                                </a>
                            </td>                           
                            <td width="45px"> 
                                <a href="#">
                                    <div  onclick="if(confirm('确定要删除该项信息？'))ajaxdel(<?php echo ($vo["id"]); ?>)" style="cursor: pointer;">删除
                                    </div>
                                </a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>    
                </tbody>
               </table>

        </div>

    <form action="" method="post" id ="vform" >
        <div id = "add_box" style="widows: 50%;position: absolute;top: 10%;left: 25%;background: #FFFFFF;border: 2px solid #0072E3;z-index: 2000;padding: 20px;display:none">
            <div class="formtitle">
                <span>添加特殊省份地区</span>                
            </div>
            <ul  class="forminfo">
            
               
                <li><label>特殊地区</label><textarea name="area" reg="" tip="地区之间用逗号隔开"  style="border:1px solid #A7B5BC" cols="48" rows="5"><?php echo ($express["area"]); ?></textarea><i>例如：湖南，湖北，广东等</i></li>
                <li><label>每公斤价格</label><input name="price" type="text" class="dfinput"  value="<?php echo ($express["price"]); ?>"  reg="[1-9]\d*"/><i></i></li>
                <input type="hidden" name="id" value="<?php echo ($express["id"]); ?>">         
                <input type="hidden" name="eid" value="<?php echo ($info["id"]); ?>">
                <input type="hidden" id="add_url" value="<?php echo U('expressAdd');?>">
                <li><label>&nbsp;</label><input name="" type="button" class="btn btn-info" value="确认"  onclick="check()" /></li>
                
                </ul>
        </div>
    </form>
    <div style="background: #90A2BC;display: none;position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: 1999;
filter:alpha(opacity=50); /*IE滤镜，透明度50%*/

-moz-opacity:0.5; /*Firefox私有，透明度50%*/

opacity:0.5;" id = "dibu"></div>  

</body>
<script type="text/javascript">
$('.tablelist tbody tr:odd').addClass('odd');
function check(){
    var data = $('#vform').serialize();
    var id = $('input[name=eid]').val();
    var area = $('textarea[name=area]').val();
    var price = $('input[name=price]').val();
    if ($.trim(area) == '') {
        alert('地区名称不能为空')
    }else if($.trim(price) == ''){
        alert('每公斤价格不能为空')
    }else{
        $.ajax({
            url:$('#add_url').val(),
            type:'post',
            data:data,
            dateType:'json',
            success:function(data){
                if (data == 1) {
                    alert('特殊地区修改成功！');
                    window.location.href = $('#back_url').val();
                    }else if (data == 0) {
                    alert('特殊地区无任何修改');
                    window.location.href = $('#back_url').val();
                    }else{
                        alert('特殊地区添加成功！');
                        window.location.href = $('#back_url').val();
                    };                    
                    
                
            },
            error:function(){
                alert('通讯被阻断');
            }
        });
    }
}
function ajaxdel(id){
    $.ajax({
        url:$('#delInfo').val(),
        data:{'id':id},
        dateType:'json',
        type:'post',
        success:function(data){
            if (data == 1) {
                $('#'+id).hide(100);
                alert('成功删除');
            }else{
                alert('删除失败');
            }
        },
        error:function(){
            alert('删除失败！通讯有问题');
        }
    })
}
function ajaxAdd(){
    $('#add_box').show(100);
    $('#dibu').show(100);
}
function ajaxedit(id){
    $.ajax({
        data:{'id':id},
        type:'post',
        dateType:'json',
        url:$('#ajaxedit').val(),
        success:function(data){
            if (data) {
                $('textarea[name=area]').val(data.area);
                $('input[name=price]').val(data.price);
                $('input[name=id]').val(data.id);
                $('#add_box').show(100);
                $('#dibu').show(100);
            };
        },
        error:function(){
            alert('修改失败！通讯有问题');
        }
    })
}
</script>
</html>