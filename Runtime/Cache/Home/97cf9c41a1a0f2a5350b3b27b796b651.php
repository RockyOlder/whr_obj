<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_config.js"></script>
            <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_all_min.js"></script>
            <script type="text/javascript" src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">

                <script type="text/javascript">
                    $(function(){
                        //   console.log(/whr/App/Home/View/Public)
                        //简单验证
                        var validate = {
                            'username' : false,
                            'type_id':false
                        };
                        $('#name').blur(function(){
                            if($.trim($(this).val()) == ''){
                                $('#name_info').text('商品名字不能为空').css('color','red');
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
                                //  if (! validate.type_id) {alert('请选择分类')};
                                // return false;
                            }

                            return true;
            
                        });
                    })
                </script>
                <style type="text/css">
                    .pro{

                        float: left;
                        line-height: 30px;
                        margin-left: 5px;
                        margin-bottom: 10px;
                    }
                    .pro select{
                        line-height: 30px;
                    }
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">合作商家管理</a></li>
                            <li><a href="#">添加生活导航商品</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">

                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                        <ul class="forminfo">
                                            <li style = "display:none"><label>生活导航商品编号</label><input name="number" type="text" class="dfinput" value="<?php echo ($info["id"]); ?>" disabled="disabled"/><i>不用输入，系统自动生成</i></li>
                                            <li><label>分类</label>
                                                <span class = 'pro'>
                                                    <select name = 'cate_pid' class="form-control" >
                                                        <option>请选择</option>
                                                        <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>


                                                    <select name = 'cate_id' style="display:none" id ="soncate"  >

                                                    </select>



                                                </span>
                                                <i id="type_info"></i></li> 
                                            <li><label>商品所属商店</label>
                                                <span class = 'pro'>
                                                    <select name = 'bid'class="form-control" >
                                                        <?php if(is_array($shop)): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>




                                                </span>
                                                <i id="type_info"></i></li> 
                                            <li><label>商品名称</label><input name="lgname" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" />xxx<i id="name_info">名称不能超过30个字符</i></li>
                                            <li style="height:85px"><label>商品描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="des"></textarea><i>描述</i></li>
                                            <li style="height:85px"><label>商品服务</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="server"></textarea><i>服务描述</i></li>
                                            <li style="height:50px"><label>商品详情</label></li>
                                            <li><textarea rows="5"  cols='40' style="" name ="content"id="intro" ></textarea></li>
                                            <li><label>列表图片</label><div id="list_hidden"></div></li>
                                            <li style="position:relative;margin-bottom:5px;height:55px"><input name="" id="upload_list" type="file" class="dfinput" style=""/><i  id ="imgs" style="position:absolute;left:150px;top:-5px;"><img src="" style="" height="50px"></i></li>
                                            <li><label>商品图册</label><input name="pic" id="more" type="text" class="dfinput" /><i></i></li> 
                                            <li style="position:relative;margin-bottom:5px;height:55px"><input name="" id="upload_more" type="file" class="dfinput" style=""/><i  id ="imgs_more" style="position:absolute;left:150px;top:-5px;"><img src="" style="" height="50px">上传图片不要大于5张</i></li>
                                            <li><label>商品星级</label><input name="star" id="notice" type="text" class="dfinput" value="-1"/><i></i></li>
                                            <li><label>商场价格</label><input name="price" type="text" class="dfinput"  value="<?php echo ($info["owner"]); ?>"/><i></i></li>
                                            <li><label>市场价格</label><input name="m_price" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i></i></li> 
                                            <li><label>促销价格</label><input name="t_price" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i>格式如:2014-11-12</i></li> 
                                            <li><label>过期时间</label><input name="pass_time" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i></i></li>  

                                            <li><label>競價排名</label><input name="sort" id="notice" type="text" class="dfinput" value="100"/><i></i></li>
                                            <li><label>是否鎖定</label><span style="line-height:30px"><input name="is_lock" id="lock" type="radio" class="dfinput" value="0" style="width:50px" checked="checked"/>正常<input name="is_lock" id="lock" type="radio" class="dfinput" value="1" style="width:50px" />鎖定</span><i></i></li>              
                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>

                                        </ul>

                                    </div>
                                    </form>
                                    <!-- <div id="map" style="border:1px solid red;width:100%;height:auto">ditu
                                        
                                    </div> -->

                                    </body>
                                    <script>
                                        //var edit= new UE.ui.Editor({initialContent:'',initialFrameWidth:450});
                                        // console.log(edit)
                                        // edit.render("intro");
                                        UE.getEditor('intro', {
                                            theme:"default", //皮肤
                                            lang:"zh-cn",//语言
                                            initialFrameWidth:600,  //初始化编辑器宽度,默认800
                                            initialFrameHeight:320
                                        });
                                        var img = "";
                                        $('#upload_list').uploadify({
                                            'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                            'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                            'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                            'buttonText' : '列表上传',
                                            'multi': false,
                                            'onUploadSuccess' : function(file, data, response) {
                                                // alert(data);
                                                obj= $.parseJSON(data);
                                                img += "<img height='50px' src='"+obj.path+"'>";
                                                $('#imgs').html(img);
                                                var hid ="<input name='thumb_pic' type='hidden' value='"+obj.mid+"' />"
                                                hid +="<input name='list_pic' type='hidden' value='"+obj.min+"' />"
                                                $('#list_hidden').html(hid);
                                            }
                                        });
                                        var more = "";
         
                                        $('#upload_more').uploadify({
                                            'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                            'uploader' : '<?php echo U("Uploads/phone");?>',
                                            'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                            'buttonText' : '图册上传',
                                            'multi': true,
                                            'onUploadSuccess' : function(file, data, response) {
                                                // alert(data);
                                                var old = $('#more').val();
                                                if (old == '') {
                                                    var src =data
                                                }else{
                                                    var src = $('#more').val()+ "&"+data
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
                                        $(function(){
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
                                                            $('#city_list').html(str);
                                                            $('#city_list').show(200);
                                                        }
                                                    }
                                                });         
                                            })
                                            $('.top_cate').click(function(){
            
                                                var id =$(this).val();
                                                // alert(id);
                                                $.ajax({
                                                    url : "<?php echo U('sonCate','','');?>",
                                                    type : "post",
                                                    data : "id="+id,
                                                    dataType : "json",
                                                    success : function(data){                   
                                                        if(data != null){
                                                            var str=""
                                                            $.each(data,function(key,val){
                                                                str += "<option value="+val['type_id']+">"+val['type_name']+"</option>";
                                                            })
                                                            //$(this).addClass("form-control")
                                                            $('#soncate').addClass("form-control")
                                                            $('#soncate').html(str);
                                                            $('#soncate').show(200);
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