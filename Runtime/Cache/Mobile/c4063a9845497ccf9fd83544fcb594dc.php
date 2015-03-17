<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Mobile/View/Public/css/validate.css" rel="stylesheet" type="text/css">
<link href="/Mobile/View/Public/css/style.css" rel="stylesheet" type="text/css">
<script src="/Mobile/View/Public/jquery-1.8.0.min.js"></script>
<script src="/Mobile/View/Public/js/easy_validator.pack.js"></script>
<script type="text/javascript" src='/Mobile/View/Public/js/jquery.uploadify.min.js'></script>
<link rel="stylesheet" href="/Mobile/View/Public/css/uploadify.css">
</head>

<body>
<form name="validateForm1" action="" method="post">
<div class="container">
<div class="menuset">
  <ul class="menu">
  <li><a href="#"><img src="/Mobile/View/Public/images/t1.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">设置登录名</a></li>
  <li class="bg"><a href="#"><img src="/Mobile/View/Public/images/tit2.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">填写信息</a></li>
  <li style=" padding:10px 0px 0px 0px;"><a href="#"><img src="/Mobile/View/Public/images/t3.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">注册成功</a></li>
 </ul>
 </div>
 
 <div style="text-align:center;font-size:25px ;">慧享园的VIP合作商家信息登记</div>
<div class="conten">
 
<div class="content">

  <div class="name">
  <span class="tt">商家名称：</span>
  <input name="store_name" type="text"  value=""  id="flightno" tip=" 商家名称 如: 慧锐通" url="<?php echo U('ajax_check_vip','','');?>" style=" padding:5px 50px 5px 5px;">
  <p><span style="color:red">*</span>至少3个汉字</p>
  </div>
  
  <div class="tel">
  <span class="tt">移动电话：</span>
  <input name="mobile_phone" type="text"  value="" id="flightno" reg="^1\d{10}" tip="国内手机号码"/ style=" padding:5px 50px 5px 5px;">
  <p><span style="color:red">*</span>有效号码</p>
  </div>

  <div class="tel">
  <span class="tt">店主姓名：</span>
  <input name="user_name" type="text"  value="" id="flightno" reg="^\W{2,20}$" tip="国内手机号码"/ style=" padding:5px 50px 5px 5px;">
  <p><span style="color:red">*</span>店主姓名</p>
  </div>
  
  <div class="QQ">
  <span class="tt">&nbsp;QQ号码：</span>
  <input name="qq" type="text"  id="flightno" reg="^\d{5,11}$" tip="QQ号码"/ style=" padding:5px 50px 5px 5px;"/>
  <p><span style="color:red">*</span>填写正确的qq号</p>
  </div>
  
  <div class="postal">
  <span class="tt">邮政编码：</span>
  <input name="zone" type="text" id="str" reg="\d{6}" tip="邮政编码"/  style=" padding:5px 50px 5px 5px;">
  <p><span style="color:red">*</span>6位的数字</p>
  </div>
 
 
<div class="con" style="height:auto;overflow:hidden">
  <span class="ad" style="float:left; width:80px; text-align:right">城市：</span>
  <div class="province" style=" width:230px;">
    <span class = 'pro'>
      <select name = 'province'  class="form-control" id="addressAdd" style="float:left; width:230px;">
      
      <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["REGION_ID"]); ?>" ><?php echo ($vo["REGION_NAME"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>

      <select name = 'city' style="display:none; width:230px;margin-top:15px;" id ="city_list" class="form-control">
          <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
      </select>

      <select name = 'area' style="display:none; width:230px;margin-top:15px;"  id ="val_list" class="form-control" style="float:left; width:230px;" >
      <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
      </select>
    </span>
  </div>
</div>
<div class="postal" style="both:clear;margin-top:20px;">
  <span class="tt">详细地址：</span>
  <input name="address" type="text" id="flightno" reg="" tip="详细地址"  style=" padding:5px 50px 5px 5px;">
  <p>街道小区门牌号</p>
  </div>
<div class="describe">商家描述：<br/><textarea name="des" cols="60" rows="10" style=" margin:20px 0px 0px 80px"></textarea></div>


<div class="tit" style=" border-bottom:1px dashed #CCC; margin-top:50px;"><h2 style="color:#999;">公司基本资料</h2></div>
<div class="photo">
<script type="text/javascript">
function previewImage(file)
{
  var MAXWIDTH  = 100;
  var MAXHEIGHT = 100;
  var div = document.getElementById('preview');
  if (file.files && file.files[0])
  {
    div.innerHTML = '<img id=imghead>';
    var img = document.getElementById('imghead');
    img.onload = function(){
      var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
      img.width = rect.width;
      img.height = rect.height;
      img.style.marginLeft = rect.left+'px';
      img.style.marginTop = rect.top+'px';
    }
    var reader = new FileReader();
    reader.onload = function(evt){img.src = evt.target.result;}
    reader.readAsDataURL(file.files[0]);
  }
  else
  {
    var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
    file.select();
    var src = document.selection.createRange().text;
    div.innerHTML = '<img id=imghead>';
    var img = document.getElementById('imghead');
    img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
    status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
    div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";
  }
}
function clacImgZoomParam( maxWidth, maxHeight, width, height ){
    var param = {top:0, left:0, width:width, height:height};
    if( width>maxWidth || height>maxHeight )
    {
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;
        if( rateWidth > rateHeight )
        {
            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
        }else
        {
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }
    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}
</script>
<script type="Text/Javascript">
    $(function(){

        if($("#actionSave").val()=='edit'){
            $(".pwsave").remove();
            //  $("#password2").remove(); 
        }
        $('#addressAdd').bind('change',function(){
            //  $('#vallage').hide(200);
            $(this).parent().next().css("color","#7f7f7f")
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
                            str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                        })
                        //   $('#city_list').append(str)
                        $('#city_list').html(str);
                        $('#city_list').show(200);
                    }
                }
            });         
        })
                                                                        
        $('#city_list').bind('change',function(){
            //   alert(1)
            var id=$(this).val();
                                                                            
            $.ajax({
                url : "<?php echo U('City/city','','');?>",
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
                                str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                            })
                            $('#val_list').append(str);
                            $('#val_list').show(200);
                        }
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
                        str += "<option class='city_in' value="+val['REGION_ID']+">"+val['REGION_NAME']+"</option>";
                    })
                    $('#val_list').html(str);
                    $('#val_list').show(200);
                }
            }
        });

    }
</script>

<div class="con-con">
<div class="aaa" style="float:left">营业执照：</div>
<div id="permit_pic" style="height:100px;">
    

</div>
<input type="file" id = "upload_permit" onChange="previewImage(this)">
<input type="hidden" name = 'permit' value="">
</div>


<div class="con-con">
<div class="aaa" style="float:left">税务登记复印件：</div>
<div id="tax_pic"  style="height:100px">
</div>
<input type="file" id ='upload_tax' onChange="previewImage(this)">
<input type="hidden" name = 'tax' value="">
</div>



<div class="con-con">    
<div class="aaa" style="float:left">组织机构代码证复印件：</div>
<div id="organize_pic"  style="height:100px">

</div>
<input type="file" id ='upload_organize' onChange="previewImage(this)">
<input type="hidden" name = 'organize' value="">
</div>


<div class="con-con">   
<div class="aaa" style="float:left">企业营业执照副本复印件：</div>
<div id="company_pic"  style="height:100px">
</div>
<input type="file" id ='upload_company' onChange="previewImage(this)">
<input type="hidden" name = 'company' value="">
</div>


<div class="con-con">
<div class="aaa" style="float:left">基本户开户许可证复印件：</div>
<div id="basic_pic"  style="height:100px">
</div>
<input type="file" id ='upload_basic' onChange="previewImage(this)">
<input type="hidden" name = 'basic' value="">
</div>


       
 <div class="con-con">   
<div class="aaa" style="float:left">店铺负责人身份证正反面复印件：</div>
<div id="front_pic"  style="height:100px">
</div>
<input type="file" id ='person_front' onChange="previewImage(this)">
<input type="hidden" name = 'owner' value="">
</div>

 
<div class="con-con">    
<div class="aaa" style="float:left">法定代表人身份证正反面复印件：</div>
<div id="back_pic"  style="height:100px">
</div>
<input type="file" id ='person_back'  onChange="previewImage(this)">
<input type="hidden" name = 'agent' value="">
</div>


    
<div class="con-con">
<div class="aaa" style="float:left">商户向慧锐通公司出具的授权书：</div>
<div id="authz_pic"  style="height:100px">
</div>
<input type="file" id ='upload_authz' onChange="previewImage(this)">
<input type="hidden" name = 'authz' value="">
</div> 
<div class="con-con">

<input type="submit" value="提交" style=" width:250px; padding:5px 0px; color:#fff; background-color:#019386; font-size:24px; font-weight:bold; border:none;">
</div> 
  
</div>
</form>
</div>
</div>

</body>
<script type="text/javascript">
    $('#upload_permit').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '上传营业执照',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#permit_pic').html(pic);
            $('input[name=permit]').val(obj);
           
        }
    });
    $('#upload_tax').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '上传税务登记复印件',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#tax_pic').html(pic);
            $('input[name=tax]').val(obj);
           
        }
    });
    $('#upload_organize').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '上传组织机构代码证',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#organize_pic').html(pic);
            $('input[name=organize]').val(obj);
           
        }
    });
    $('#upload_company').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '上传企业营业执照副本',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#company_pic').html(pic);
            $('input[name=company]').val(obj);
           
        }
    });
    $('#upload_basic').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '基本户开户许可证',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#basic_pic').html(pic);
            $('input[name=basic]').val(obj);
           
        }
    });
    $('#person_front').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '负责人身份证正反面',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#front_pic').html(pic);
            $('input[name=owner]').val(obj);
           
        }
    });
    $('#person_back').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '代表人身份证正反面',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#back_pic').html(pic);
            $('input[name=agent]').val(obj);
           
        }
    });
    $('#upload_authz').uploadify({
        'swf'      : '/Mobile/View/Public/images/uploadify.swf',
        'uploader' : '<?php echo U("Uploads/upload");?>',
        'cancelImage':'/Mobile/View/Public/images/uploadify-cancel.png',
        'buttonText' : '上传商户授权书',
        'multi': false,
        'onUploadSuccess' : function(file, data, response) {            
            obj= $.parseJSON(data);
            // alert(obj);
            pic = "<img height='100px' src='"+obj+"'>";
            // pic +=" <img src='/Mobile/View/Public/images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
            $('#authz_pic').html(pic);
            $('input[name=authz]').val(obj);
           
        }
    });

</script>
</html>