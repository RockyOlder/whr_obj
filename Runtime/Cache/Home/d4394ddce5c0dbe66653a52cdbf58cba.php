<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>

        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
            <script type="text/javascript">
                $(function(){
                  
                    /*$('.pro_in').click(function(){
                        $('#vallage').hide(200);
                        var id =$(this).val();
                        // alert(id);
                        $('#city').attr('pro',id);
                        $('#val_list').html("<p>请选择城市</p>")
                        $.ajax({
                            url : "<?php echo U('City/city','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){                   
                                if(data != null){
                                    var str=""
                                    $.each(data,function(key,val){
                                        str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+")'>"+val['region_name']+"</option>";
                                    })
                                    //   $('#city_list').append(str)
                                    $('#city_list').html(str);
                                    $('#city_list').show(200);
                                }
                            }
                        });         
                    })
                    var province = function() {
                        var id=$(".cheng_in").val();
                        $.ajax({
                            url : "<?php echo U('City/city','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){                   
                                if(data != null){
                                    if($(".cheng_in").val()!==''){
                                        var str=""
                                        $.each(data,function(key,val){
                                            str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+")'>"+val['region_name']+"</option>";
                                        })
                                        $('#city_list').html(str);
                                        $('#city_list').show(200);
                                    }
                                }
                            }
                        });  
                    };
                    var area = function() {
                        var id=$(".area_on").val();
                        //   alert(id)
                        $.ajax({
                            url : "<?php echo U('City/vallcage','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){                       
                                if(data != null){
                                    if($(".city_in").val()!==''){
                                        var str=""
                                        $.each(data,function(key,val){
                                            str += "<option class='city_in' value="+val['region_id']+">"+val['region_name']+"</option>";
                                        })
                                        $('#val_list').html(str);
                                        $('#val_list').show(200);
                                    }
                                }
                            }
                        });  
                    };
                    //   area();
                    province();
                    // getvallage($(".city_in").val());

                    var pro = function() {
                        var id=$(".pro_into").val();
                        //  alert(id)
                        $.ajax({
                            url : "<?php echo U('sonCate','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){     
                                //   alert(data) 
                                if(data != null){

                                    var str=""
                                    $.each(data,function(key,val){
                                        str += "<option value="+val['type_id']+">"+val['type_name']+"</option>";
                                    })
                                    $('#soncate').html(str);
                                    $('#soncate').show(300);
                                }
                            }
                        });    
                    }
                    province();
                    getvallage($(".city_in").val());
                    pro();
                })
                function getvallage(id){

                    var id = id;
                    $('#vallage').attr('city',id);
                    $.ajax({
                        url : "<?php echo U('City/vallage','','');?>",
                        type : "post",
                        data : "id="+id,
                        dataType : "json",
                        success : function(data){                       
                            if(data != null){
                                var str=""
                                $.each(data,function(key,val){
                                    str += "<option class='city_in' value="+val['region_id']+">"+val['region_name']+"</option>";
                                })
                                $('#val_list').html(str);
                                $('#val_list').show(200);
                            }
                        }
                    });
                     */
                }
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">楼盘管理</a></li>
                <li><a href="#">添加管理员</a></li>
            </ul>
        </div>
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                        <div class="formbody">
                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                            <ul class="forminfo">
                                <li><label>楼盘名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                <li><label>楼盘信息</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="info" value="<?php echo ($info["info"]); ?>"><?php echo ($info["info"]); ?></textarea><i>描述</i></li>
                                <li><label>所属开发商</label>
                                    <select  class="form-control" name = 'developer_id' style="width: 345px;height: 32px;" >
                                        <option class="cheng_in" value="<?php echo ($info["did"]); ?>"><?php echo ($info["dname"]); ?></option>
                                        <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                            </ul>
                            <div style="display:none" id="skuNotice" class="sku_tip">
                                <span id="skuTitle2"></span>
                            </div>
                        </div>
                        </form>
                        </body>
                        </html>