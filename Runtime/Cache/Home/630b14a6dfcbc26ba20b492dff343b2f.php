<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo ($lang["cp_home"]); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
            <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <script type="Text/Javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="Text/Javascript" src="/App/Home/View/Public/Js/bootstrap.min.js"></script>

            <style>
                *{padding:0;margin:0;}
                body{background:#f0f9fd;}
                #box{width:100%;height:auto; }
                #header{width:100%;text-indent:4em;line-height:30px;font-weight:700;font-size:18px;}
                .down{width:30%;float:left;margin-left:1%; border:1px solid #dfe9ee;}
                p{line-height:24px;text-indent:2em;width:100%}
                span{float:right;}
                .button_save{text-align: center;  }
                .button_save input { margin-left: 10px; width: 100px;}
                #deleteDEL {text-align: center; margin-left:310px;; margin-top: 30px;}

                #table_list tr td{ padding: 7px;}
                .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 40%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                .infoTAG{ float: left; position:  absolute; margin-left: 23%; margin-top: -25px; color: threeddarkshadow; font-size: 13px;}
                #deletePASSWORD{ width: 200px; height: 30px;}
            </style>
            <script type="Text/Javascript">
                $(function(){
                    $('#pro').bind('change',function(){
                        $('#vallage').hide(200);
                        var id =$('#pro').val();
                        var name= $($(this)).find("option:selected").text();     
                        if($("#regionlist").val()==2){
                            $("#region").val(name); 
                            $("#parent").val($(this).val()); 
                        }
                        $("#REGION_ID").val($(this).val());
                        $("#ceshi").val(name)
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
                                    str=''
                                    $.each(data,function(key,val){
                                    //    var name="\'"+val['region_name']+"\'"
                                        str += '<option class="city_in" value='+val["REGION_ID"]+' >'+val["REGION_NAME"]+'</option>';
                                        //     str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+","+val['region_name']+")'>"+val['region_name']+"</option>";
                                    })
                                    $('#city_list').html(str);
                                    $('#city').show(200);
                                }
                            }
                        });			
                    })//
                    $('#val_list').bind('change',function(){        
                          var id=$(this).val(); var name= $($(this)).find("option:selected").text();     
                         $("#REGION_ID").val(id); $("#ceshi").val(name)
                         
                    })
                    $('#city_list').bind('change',function(){
                         
                        var id=$(this).val();
                        var name= $($(this)).find("option:selected").text();     
                     
                      if($("#regionlist").val()==3){ $("#region").val(name);  $("#parent").val(id);  }
                        $("#REGION_ID").val(id);   $("#ceshi").val(name)
                        $.ajax({
                            url : "<?php echo U('City/vallage','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){        
                                                                                                                                      
                                if(data != null){
                                    $("#val_list .city_in").remove();
                                    if($(".city_in").val()!==''){
                              
                                        var str=""
                                        var inex= this//selected=selected
                                                                                                                                                                      
                                        $.each(data,function(key,val){
                                            str += "<option class='city_in' value="+val['REGION_ID']+" >"+val['REGION_NAME']+"</option>";
                                        })
                                        $('#val_list').append(str);
                                        $('#vallage').show(200);
                                    }
                                }
                            }
                                                                                                                                                              
                        });  
                    
                    })
                    $('#regionlist').bind('change',function(){
                          
                        if($(this).val()==1){
                       
                            $("#region").val('\u4e2d国'); 
                            $("#parent").val($(this).val()); 
                        }
                     
                    })   
                    $('#REGIONADD').bind('click',function(){
                      
                        if($("#selectadd").val()==0){ $("#selectadd").val(1); $("#dialog-form").show() }else{  $("#dialog-form").hide(); $("#selectadd").val(0)  }
                     
                    }) 
                    $('#like').bind('click',function(){
                      
                        if($("#deleteselete").val()==0){ $("#deleteselete").val(1); $("#deleteDEL").show() }else{  $("#deleteDEL").hide(); $("#deleteselete").val(0)  }
                     
                    }) 
                    $('#regionFRom').submit(function(){
                       
                        if(!checkInput()){
                      
                            return false;
                        }
                    
                        return true
                    })
                    
                })
               /* function getvallage(id,name){
            
                    if($("#regionParentCate").val()==3){ $("#region").val(name);  $("#parent").val(id);  }
                    $("#REGION_ID").val(id);
               
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
                                    str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:areaonclick("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                                })
                                $('#val_list').html(str);
                                $('#val_list').show(200);
               
                            }
                        }
                    });
                }
                function areaonclick(id){
                    $("#REGION_ID").val(id);
            
                }*/
                function setout(){
                    $('.validateTips').text()
                    $('#skuNotice').show();
                    var dingshi= setTimeout( function(){
                        $( '#skuNotice' ).fadeOut();
                    }, ( 1 * 1000 ) );  
                    return dingshi;
                } 
                function checkInput(){
                    var bValid = true;           
                    bValid = bValid && checkEmpty( $("#regionlist"), "\u8bf7选择添加类型！" );
                    //    $("#regionParentCate").removeClass('ui-state-error') 
                    bValid = bValid && checkEmpty( $("#REGION_NAME"), "\u57ce市名字不能为空！" );
                    bValid = bValid && checkEmpty( $("#REGION_NAME_EN"), "\u57ce市英文拼写不能为空！" );
                    bValid = bValid && checkEmpty( $("#REGION_INITIAL"), "\u57ce市首字母拼写不能为空！" );
                    if(bValid==false){ setout(); }
                    return bValid;
                }
                function cats_Shop() {
                    
                    art.dialog({
                        content:'你确定要删除 :"'+ $("#ceshi").val()+'"?',
                        title: '确定框',  
                        cancelValue:'取消', 
                        okValue:'确认',  
                        width: 230,  
                        height: 100,  
                        fixed:true,
                        id:'bnt4_test',
                        style:'confirm'}, 
                    function(){
                        var msg = art.dialog({id:'bnt4_test'}).data.content; // 使用内置接口获取消息容器对象
                        if(msg){
                            $("#deleteREMOVE").submit();
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
            
            
            </script>

    </head>
    <body>
        <div class="place">

                <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>系统管理</li>
                <li>城市列表</li>
            </ul>
        </div>
        <div id="box" style=" float: left;">
            <div id= "header" class="down">全國城市列表</div>
            <div id = "provence" class="down">
                <select size=30 style="width: 200px;" name= "pro" id = "pro">

                    <option value="volvo">添加省份</option>
                    <?php if(is_array($data)): foreach($data as $key=>$pro): ?><option  class="pro_in" value="<?php echo ($pro["REGION_ID"]); ?>"><?php echo ($pro["REGION_NAME"]); ?></option><?php endforeach; endif; ?>
                 </select>

            </div>
            <div id = "city" class="down" style="display:none">
                <select id ="city_list"  size=30  style="width: 200px;">
                    <option class="city_in" num="0">请选择省份</option>
                </select>
            </div>
            <div id = "vallage" class="down"  style="display:none">
                <select id ="val_list"   size=30  style="width: 200px;">
                    <option class="vallage_in" num="0">请选择城市</option>
                </select>
            </div>
        </div>
            <input type="hidden" class="btn btn-default" value="" id="ceshi"/> 
        <form action="#" method="post" name="myform" class="form-input" id="deleteREMOVE" />
        <div class="button_save">
            <input type="button" class="btn btn-default" value="添加" id="REGIONADD"/> 
            <input type="button" class="btn btn-danger" value="删除" id="like" />
            <input name="action" type="hidden" class="btn btn-default" value="delete" />
            <input name="REGION_ID" type="hidden" class="btn btn-default" id="REGION_ID" />
            <div id="deleteDEL" style=" display:  none;"><label for="content">密码：</label> <input name="password" type="password" class="dfinput" id="deletePASSWORD" /><i style=" color: rosybrown">请点击城市在输入密码</i></input>
                <input type="button" class="btn btn-info" value="提交" onclick="cats_Shop()" id="buttonSUBIT"  />
            </div>

        </div>
        </form>
        <div style="display:none" id="skuNotice" class="sku_tip">
            <span class="validateTips"></span>
        </div>
        <input type="hidden" id="selectadd" class="form-control" value="0" />
        <input type="hidden" id="deleteselete" class="form-control" value="0" />
        <div id="dialog-form" title="添加城市" style=" display: none;">

            <form action="#" method="post" name="myform" class="form-input" id="regionFRom" />

            <input name="action" type="hidden" class="btn btn-default" value="add" id="roleActionObject"/>
            <input name="PARENT_ID"  type="hidden" id="parent" class="form-control" />
            <table id="table_list" width="30%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td align="right" width="90px">
                        <label for="title">添加类型：</label>
                    </td>
                    <td>
                        <select name="REGION_LEVEL" id="regionlist" class="form-control">
                            <option class = "top_cate" value="">请选择</option>
                            <option class = "top_cate" value="1">省市</option>
                            <option class = "top_cate"  value="2">市区</option>
                            <option class = "top_cate" value="3" >区县</option>
                        </select>
                        <span class="infoTAG">选择完类型后请点击上级城市的名字，省则不用</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="content">上级城市：</label>
                    </td>
                    <td>
                        <input type="text" id="region" class="form-control" disabled="disabled" />

                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="content">城市名字：</label>
                    </td>
                    <td>
                        <input type="text" name="REGION_NAME" id="REGION_NAME" class="form-control" /><span class="infoTAG" style=" color: red;">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="120px">
                        <label for="author">城市英文拼写：</label>
                    </td>
                    <td>
                        <input type="text" name="REGION_NAME_EN" id="REGION_NAME_EN" class="form-control" /><span class="infoTAG">列如：深圳:SHENZHEN</span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="130px">
                        <label for="author">城市首字母拼写：</label>
                    </td>
                    <td>
                        <input type="text" name="REGION_INITIAL" id="REGION_INITIAL" class="form-control" /><span class="infoTAG">列如：深圳：S</span>
                    </td>
                </tr>

            </table>
            <input type="submit" class="btn btn-info" value="提交"   style=" margin-left: 250px; width: 150px;" />
        </div>

        </form>
    </body>
</html>