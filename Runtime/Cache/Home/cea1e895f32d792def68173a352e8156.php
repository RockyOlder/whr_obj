<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
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
                    <form action="<?php echo U('add';?>" method="post" name ="vform">
                        <input type ="hidden" name="goods_id" value="<?php echo ($info["goods_id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                            <li><label>分类{</label>
                                                <span class = 'pro'>
                          
                                                        <p class="text-lowercase"  value="{$info.cat_id}"><?php echo ($info["cat_name"]); ?></p>
                                     
                                                </span>
                                                <i id="type_info"></i></li> 
                                            <li><label>商家名称</label>
                                        
                                                        <p class="pro_into"  value="<?php echo ($info["store_id"]); ?>"><?php echo ($info["store_name"]); ?></p>

                                        </li>
                                            <li><label>商品名字</label><p id="name" class="text-capitalize"/><?php echo ($info["goods_name"]); ?></p></li>
                                            <li><label>价 格</label><p id="name" class="text-capitalize"/><?php echo ($info["price"]); ?></p></li>
                                            <li><label>库 存</label><p id="name" class="text-capitalize"/><?php echo ($info["inventory"]); ?></p></li>
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
                                                 
                                                                <li style="height:85px"><label>商家描述</label><span><?php echo ($info["description"]); ?></span></li>
                                                                <li><label>列表图片</label><div id="list_hidden"></div></li>
                                                                <li style="position:relative;margin-bottom:5px;height:55px"><input id="upload_list" type="hidden" class="dfinput" style="" value="<?php echo ($info["goods_img"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;"><img style=" height: 80px;" class="goodsImg" src="<?php echo ($info["goods_img"]); ?>"></img></i></li>
                                                                <li><label>店铺图册</label><input name="list_img" id="more" type="hidden" class="dfinput"  value="<?php echo ($info["list_img"]); ?>"/><i></i></li> 
                                                                <li style="position:relative;margin-bottom:5px;height:55px"><input name="" id="upload_more" type="file" class="dfinput" style=""/><i  id ="imgs_more" style="position:absolute;left:150px;top:-5px;"></i></li>

                                                                <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                                </ul>
                                                                </div>
                                                                </form>
                                                                <!-- <div id="map" style="border:1px solid red;width:100%;height:auto">ditu
                                                                    
                                                                </div> -->

                                                                </body>
                                                                <script>
                                                                    $('#upload_list').uploadify({
                                                                        'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                        'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                        'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                        'buttonText' : '列表上传',
                                                                        'multi': false,
                                                                        'onUploadSuccess' : function(file, data, response) {
                                                                       
                                                                            obj= $.parseJSON(data);
                                                                            img += "<img height='50px' src='"+obj.path+"'>";
                                                                            //  $('#imgs').html(img);
                                                                            $(".goodsImg").attr({ src: obj.path})
                                                                            var hid ="<input name='goods_img' id='list' type='hidden' value='"+obj.path+"' />";
                                                                            $('#list_hidden').html(hid);
                                                                        }
                                                                    });
                                                                    var more = "";
         
                                                                    $('#upload_more').uploadify({
                                                                        'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                        'uploader' : '<?php echo U("Uploads/upload");?>',
                                                                        'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                        'buttonText' : '图册上传',
                                                                        'multi': true,
                                                                        'onUploadSuccess' : function(file, data, response) {
                                                                            // alert(data);
                                                                            var name= file.name
                                                                            var old = $('#more').val();
                                                                            if (old == '') {
                                                                                var src ='{"'+name+'"'+':"'+data+'",'
                                                                            }else{

                                                                                var src = $('#more').val()+ '"'+name+'":"'+data+'"}'
                                                                            };
                                                                            var one = data;
                                                                            more += "<img height='50px' src='"+one+"'>";
                                                                            $('#imgs_more').html(more);
                                                                            $('#more').val(src);
                                                                        }
                                                                    });
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