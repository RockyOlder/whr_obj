<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />

        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>      -->
        <!-- <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css"> jquery-1.8.3.min -->
        <link type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
                <script type="text/javascript">
                    $(function(){
                        
      
                        
                        $( "#dialog-form" ).dialog({
                            width: 500,
                        
                            autoOpen: false,
                            modal:true,
                            position:{
                                my: "center", 
                                at: "center", 
                                of: window
                            }, 
                            buttons: {
                                "提　交":function(){
                                    // allFields.removeClass( "ui-state-error" );
                                    $('form[name=myform]').submit();
                                },
                                "重　置":function(){
                                    //  resetInput();	
                                }	
                            },
        
                            close: function() {
                      
                                $("#dialog-form").hide();
                                //     resetInput();
                            }
                        });
                        $("#ig_primary").click(function(){
                             $("div[role=dialog]").show()
                            $("#dialog-form").dialog("option","title","添加");            
                            $("#dialog-form").dialog("open");
                        });
                        
                        $("button[title=close]").click(function(){
                            $("div[role=dialog]").hide()
                        });
                    });         
                    //     var roleDataBak='{}';
                    //     var allFields=$( [] );close
                    function update_list(subId){
                        $("#dialog-form").dialog("option","title","编辑");
                    
                        $("form[name=myform]").attr("action",$("#examUpdate").val());
                        //  alert($("#table").val())
                        $.ajax({ 
                            url:$("#url_ajaxCalendar").val(),
                            type:"post",
                            dataType:"json",
                            cache:false,
                            data: {
                                "id":subId
                            },
                            timeout:30000,
                            error:function(data, msg){
                                alert("error:"+msg);
                            },
                            success:function(data){
                                // roleDataBak=data;
                                //alert(data.id)
                                $("#title").val(data.title);
                                $("#add_id").val(data.id);
                                $("#content").val(data.content);
                                $("#author").val(data.author);
                                $("#pic_id").val(data.pic);
                                $("#img_add").attr("src",data.pic);
                                $("#action").val(data.action);
                                $("#dialog-form").dialog("open");
                            }
                        });
                    }

                </script>
                </head>
                <style type="text/css">
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    #val_list{width: 345px;height: 32px;  margin-left: 85px;}
                    #table_list tr td{ padding: 7px;}
                    .th_default a{ width: 70px;}
                    #ig_primary{float: right; margin-top: 3px;}
                    #img_add{ position: absolute; float: left; margin-top: 205px; margin-left: 85px;}
                </style>

                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">物业信息管理</a></li>
                            <li><a href="#">邻里拼车</a></li>
                        </ul>
                    </div>
                    <input type="hidden" value="/whr/index.php?s=/Home/ProInfo/active" id="examUpdate" name="examUpdate" />
                    <input type="hidden" value="<?php echo ($data["table"]); ?>" id="table" name="examUpdate" />
                    <input type="hidden" value="/whr/index.php?s=/Home/ProInfo/url_ajaxActive" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                    <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加"/></li>

                    <div style="display:none" id="skuNotice" class="sku_tip">
                        <span id="skuTitle2"></span>
                    </div>
                    <table class="tablelist">
                        <thead>
                            <tr>
                                <th><input name="" type="checkbox" value="" checked="checked"/></th>
                                <th>编号<i class="sort"><img src="/whr/App/Home/View/Public/Images/px.gif" /></i></th>
                                <th>公告标题</th>
                                <th>公告内容</th>
                                <th>手机号码</th> 
                                <th>发布时间</th>

                                <th>操作</th>
                            </tr>
                        </thead>

                        <tbody id="table_ajax_list">
                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><input name="num" type="checkbox" value="" /></td>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["title"]); ?></td>
                                    <td><?php echo ($vo["content"]); ?></td>
                                    <td><?php echo ($vo["phone"]); ?></td>
                                    <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>      


                                    <td class="th_default">    
                                        <a class="btn btn-default" onclick="update_list(<?php echo ($vo["id"]); ?>)">修改</a>    
                                        <a href="<?php echo U('del',array(id=>$vo['nid']),'');?>" class="btn btn-danger" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
                        </tbody>
                    </table>
                    <div id="xxoo">
                        <div id="dialog-form" title="添加" style=" display: none;">
                            <div class="tip">
                                <p class="validateTips"></p>
                            </div>
                            <form action="#" method="post" name="myform" class="form-input" />
                            <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>

                                    <input type="hidden" id="hidRoleId" value="" />
                                    <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td align="right" width="90px">
                                                <label for="title">活动标题：</label>
                                            </td>
                                            <td>
                                                <input type="text" name="title" id="title"  class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <label for="content">活动内容：</label>
                                            </td>
                                            <td>
                                                <textarea rows="5"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="90px">
                                                <label for="author">发布人：</label>
                                            </td>
                                            <td>
                                                <input type="text" name="author" id="author" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="90px">
                                                <label for="phone">活动图片：</label>
                                            </td>
                                            <td>
                                                <input name="pic" id="upload_list" type="file" class="dfinput" style=""/><i  id ="imgs" style="position:absolute;left:150px;top:-5px;"><img src="" id='img_add'  height="50px">
                                                </i>
                                            </td>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="pic" id="pic_id"  />
                                        <input type="hidden" name="id" id="add_id"  />
                                    </table>

                                    </form>
                                    </div>
                                    </div>
                                    <script>
                        
                                        $(function(){
                                            var img = "";
                                            $('#upload_list').uploadify({
                                                'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                'buttonText' : '列表上传',
                                                'multi': true,
                                                'onUploadSuccess' : function(file, data, response) {
                                                    // alert(data);
                                                    obj= $.parseJSON(data);
                                                    img += "<img height='50px' id='img_add' src='"+obj.path+"'>";
                                                    $('#imgs').html(img);
                                                    //  var hid ="<input name='pic' type='hidden' value='"+obj.mid+"' />"
                               
                                                    $('#pic_id').val(obj.mid);
                                                }
                                            });
                                        });
                                        function deleteListPic(){
                                            $(".up_list_pic").html('');
                                            $('#list_hidden').html('');
                                        }
                                    </script>
                                    </body>
                                    </html>