<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css">
           <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>


            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
                <script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
                    $(function(){
                        // alert(1)
                        //简单验证
                        /*    var validate = {
                            'username' : false,
                            'type_id':false
                        };
                        $('#name').blur(function(){
                            if($.trim($(this).val()) == ''){
                                $('#name_info').text('商家名字不能为空').css('color','red');
                                validate.username = false;
                            }else{
                                $('#name_info').text('');
                                validate.username = true;
                            }
                        });
                        $('#soncate').change(function(){
                            if($.trim($(this).val()) == 0){
                                $('#type_info').text('请选择分类').css('color','red');
                                validate.type_id = false;
                            }else{
                                $('#type_info').text('');
                                validate.type_id = true;
                            }
                        });
                    
       
                        $('form').submit(function(){
                            $('#name').trigger('blur');
                            var isOK = validate.username && validate.type_id
                            if(!isOK){
                                if($(".pro_into").text()=="请选择"){
                                    $('#skuTitle2').text("您还未选择分类")
                                    $('#skuNotice').show();
                                    setTimeout( function(){
                                        $( '#skuNotice' ).fadeOut();
                                    }, ( 1 * 1000 ) ); 
                                    return false;
                                }
                            }
                            return true;
            
                        });
                         */
                    })
                </script>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px; margin-left: 0px;margin-bottom: 10px;}

                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">合作商家管理</a></li>
                            <li><a href="#">添加商品</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="goods_id" value="<?php echo ($info["goods_id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                            <li><label>分类</label>
                                                <span class = 'pro'>
                                                    <select name = 'cat_id' id="type_on" class="form-control" >
                                                        <option class="pro_into"  value="<?php echo ($info["cat_id"]); ?>"><?php echo ($info["cat_name"]); ?></option>
                                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </span>
                                                <i id="type_info"></i></li> 
                                            <li><label>商家名称</label>
                                                <span class = 'pro'>
                                                    <select name ='store_id' id="type_on" class="form-control" >
                                                        <option class="pro_into"  value="<?php echo ($info["store_id"]); ?>"><?php echo ($info["store_name"]); ?></option>
                                                        <?php if(is_array($vip)): $i = 0; $__LIST__ = $vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["store_id"]); ?>" name="store_id" ><?php echo ($vo["store_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </span>

                                                <i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>商品名字</label><input name="goods_name" id="name" type="text" class="dfinput" value="<?php echo ($info["goods_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>价 格</label><input name="price" type="text" class="dfinput"  value="<?php echo ($info["price"]); ?>"/><i>商品价格</i></li>
                                            <li><label>库 存</label><input name="inventory" type="text" class="dfinput"  value="<?php echo ($info["inventory"]); ?>"/><i></i></li>
                                            <li><label>地 址</label>
                                                <span class = 'pro'>
                                                    <select name = 'province'class="form-control" >
                                                        <option class="cheng_in" value="<?php echo ($info["province"]); ?>"><?php echo ($info["REGION_NAME"]); ?></option>
                                                        <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["region_id"]); ?>"><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                    <select name = 'city' style="display:none" id ="city_list" class="form-control"  >
                                                        <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                                    </select>
                                                    <select name = 'area' style="display:none"  id ="val_list" class="form-control" >
                                                        <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                                    </select>
                                                </span>
                                                <div style="display:none" id="skuNotice" class="sku_tip">
                                                    <span id="skuTitle2"></span>
                                                </div>
                                                <i></i></li> 
                                            <input type="hidden" value="<?php echo ($info["list_img"]); ?>" id="img_list">
                                                <input type="hidden" value="<?php echo ($info["if_show"]); ?>" id="if_show">
                                                    <li><label>是否上架</label><input name="if_show"  class="radiolist" id="rdaoid"  type="radio" value="1"><a class="box">是</a><input name="if_show"  class="radiolist" type="radio" value="0"><a class="box">否</a></li>
                                                                <li style="height:85px"><label>商家描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="description" value="<?php echo ($info["description"]); ?>"><?php echo ($info["description"]); ?></textarea><i>描述</i></li>
                                                                <li><label>列表图片</label>
                                                                    <div id="list_hidden">
                                                                        <input type ='hidden' name = "list_path" value="<?php echo ($info["list_path"]); ?>">
                                                                            <input type ='hidden' name = "goods_img" value="<?php echo ($info["mid_pic"]); ?>">
                                                                                <input type ='hidden' name = "list_img" value="<?php echo ($info["list_img"]); ?>">
                                                                                    </div></li>
                                                                                    <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_img" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                                                            <?php if($info["list_img"] != ''): ?><div class="up_list_pic">
                                                                                                    <img height='50px' src='<?php echo ($info["list_img"]); ?>'>
                                                                                                        <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                                                                                                            </div><?php endif; ?>
                                                                                                            </i></li>
                                                                                                            <li><label>商品图册</label><i></i></li> 
                                                                                                            <li style="position:relative;margin-bottom:5px;height:55px"><input type = "file" id ="upload_more">
                                                                                                                    <i  id ="imgs_more" style="position:absolute;left:150px;top:-5px;">
                                                                                                                        <div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = 0 > 
                                                                                                                        </div>
                                                                                                                        <?php if($info["goods_img"] != ''): if(is_array($info["goods_img"])): $k = 0; $__LIST__ = $info["goods_img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = "<?php echo ($k); ?>" style=" float: left">
                                                                                                                                    <img width='50px' src='<?php echo ($vo["mid"]); ?>' name ='path'>
                                                                                                                                        <input type='hidden' name='path[]'  value='<?php echo ($vo["pic"]); ?>'/>
                                                                                                                                        <input type='hidden' name='mid[]' value='<?php echo ($vo["mid"]); ?>'/>
                                                                                                                                        <input type='hidden' name='pic_name[]' value='<?php echo ($vo["name"]); ?>'/>
                                                                                                                                        <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic(<?php echo ($k); ?>)' > 
                                                                                                                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                                                                                                            </i></li>
                                                                                                                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                                                                                                            </ul>

                                                                                                                                            </div>
                                                                                                                                            </form>

                                                                                                                                            </body>
                                                                                                                                            <script>
                                                                                                        
                                                                                                                                                var list_img = "";
                                                                                                                                                $('#upload_list').uploadify({
                                                                                                                                                    'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                                                                                                    'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                                                                                                    'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                                                                    'buttonText' : '列表上传',
                                                                                                                                                    'multi': false,
                                                                                                                                                    'onUploadSuccess' : function(file, data, response) {
                                                                                                                                                        // alert(data);
                                                                                                                                                        obj= $.parseJSON(data);
                                                                                                                                                        list_img += "<img height='50px' src='"+obj.path+"'>";
                                                                                                                                                        list_img +=" <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                                                                                                        $('#imgs').html(list_img);
                                                                                                                                                        var hid ="<input name='list_path' id='list_path' type='hidden' value='"+obj.path+"' />";
                                                                                                                                                        hid +="<input name='suolie_img' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                                                                                                        hid +="<input name='list_img' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                                                                                                        $('#list_hidden').html(hid);
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                                var img = '';
                                                                                                                                                var num = $('.more_list_pic').last().attr('num')+1;

                                                                                                                                                $('#upload_more').uploadify({
                                                                                                                                                    'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                                                                                                    'uploader' : '<?php echo U("Uploads/photo",'','');?>',
                                                                                                                                                    'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                                                                    'buttonText' : '缩略图上传',
                                                                                                                                                    'onUploadSuccess' : function(file, v, response) {
                                                                                                                                                        obj= $.parseJSON(v);
                                                                                                                                                        // console.log(obj)
                                                                                                                                                        img += "<div id = 'more_"+num+"' class = ' more_list_pic' num = '"+num+"'>"
                                                                                                                                                        img += "<img width='50px' src='"+obj.path+"' name ='path'>";
                                                                                                                                                        img += "<input type='hidden' name='path[]'  value='"+obj.path+"'/>";
                                                                                                                                                        img += "<input type='hidden' name='mid[]' value='"+obj.mid+"'/>";
                                                                                                                                                        img += "<input type='hidden' name='pic_name[]' value='"+obj.name+"'/>";
                                                                                                                                                        img += "<img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic("+num+")'> ";
                                                                                                                                                        img += "</div>"
                                                                                                                                                        $('#imgs_more').append(img);
                                                                                                                                                        img = '';
                                                                                                                                                        num++;
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                                function deletePic(num){
                                                                                                                                                    $("#more_"+num+"").html('');
                                                                                                                                                    // $('this').parent('.more_list_pic').remove();
                                                                                                                                                }
                                                                                                                                                function deleteListPic(){
                                                                                                                                                    $(".up_list_pic").html('');
                                                                                                                                                    $('#list_hidden').html('');
                                                                                                                                                }
                                                                                                                                                function openwindow()
                                                                                                                                                {
                                                                                                                                                    var url = 'http://api.map.baidu.com/lbsapi/getpoint/'; //转向网页的地址;
                                                                                                                                                    var name="获取经纬"; //网页名称，可为空;
                                                                                                                                                    var iWidth='800'; //弹出窗口的宽度;
                                                                                                                                                    var iHeight='600'; //弹出窗口的高度;
                                                                                                                                                    //window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽
                                                                                                                                                    var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;
                                                                                                                                                    var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
                                                                                                                                                    window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
                                                                                                                                                }
                                                                                                                                                function ShowPage()
                                                                                                                                                {
                                                                                                                                                    showModalDialog('http://api.map.baidu.com/lbsapi/getpoint/','example04','dialogWidth:400px;dialogHeight:300px;dialogLeft:200px;dialogTop:150px;center: yes;help:no;resizable:no;status:no')
                                                                                                                                                }

                                                                                                                                            </script>
                                                                                                                                            <script type="Text/Javascript">
                                
                                                                                                                                                $(document).ready(function() {
                                                                                                                                                    $('.radiolist').each(function() {
                                                                                                                                                        if($("#if_show").val()==1 && $(this).val()==1){
                                                                                                                                                            $(this).attr({ checked: "checked"})
                                                                                                                                                        }else if($("#if_show").val()==0 && $(this).val()==0){
                                                                                                                                                            $(this).attr({ checked: "checked"})
                                                                                                                                                        }
                                                                                                                                                    });
                                                                                                                                                    if($("#if_show").val()==''){ $("#rdaoid").attr({ checked: "checked"}) }
                                                                                                                                                });
                                                          
                                                                                                                                                $(function(){
                                                                                                                                                    //   alert($('.area_on').val())
                                                                                                                                                    if($(".pro_into").val()==''){ $(".pro_into").text("请选择"); }
                                                                                                                                                    if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
                                                                                                                                                    $('.pro_in').click(function(){
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
                                                                                                                                                    area();
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
                                                                                                                                                    $('.top_cate').click(function(){
            
                                                                                                                                                        var id =$(this).val();
                                                                                                                                                        //  alert(id);
                                                                                                                                                        $.ajax({
                                                                                                                                                            url : "<?php echo U('sonCate','','');?>",
                                                                                                                                                            type : "post",
                                                                                                                                                            data : "id="+id,
                                                                                                                                                            dataType : "json",
                                                                                                                                                            success : function(data){   
                                                                                                                                                                //  alert(data)
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
                                                                                                                                                    })    
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
        
                                                                                                                                                }
                                                                                                                                            </script>

                                                                                                                                            </html>