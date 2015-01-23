<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($lang["cp_home"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  rel="stylesheet" type="text/css" src="/default/App/Home/View/Public/Css/bootstrap.min.css" />
<script type="Text/Javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
<script type="Text/Javascript" src="/default/App/Home/View/Public/Js/bootstrap.min.js"></script>
<style>
*{padding:0;margin:0;}
body{background:#f0f9fd;}
#box{width:100%;height:auto; }
#header{width:100%;text-indent:4em;line-height:30px;font-weight:700;font-size:18px;}
.down{width:30%;float:left;margin-left:1%; border:1px solid #dfe9ee;}
p{line-height:24px;text-indent:2em;width:100%}
span{float:right;}
</style>
<script type="Text/Javascript">
	$(function(){
		$('.pro_in').click(function(){
			$('#vallage').hide(200);
			var id =$('#pro').val();
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
						$('#city').show(200);
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
						$('#vallage').show(200);
					}
				}
			});
		
	}
</script>
  
</head>
<body>
	<div id="box">
		<div id= "header" class="down">全國城市列表</div>
		<div id = "provence" class="down">
			<select size=30 style="width: 200px;" name= "pro" id = "pro">

 				 <option value="volvo">添加省份</option>
 				 <?php if(is_array($data)): foreach($data as $key=>$pro): ?><option  class="pro_in" value="<?php echo ($pro["region_id"]); ?>"><?php echo ($pro["region_name"]); ?></option><?php endforeach; endif; ?>
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
	<!-- <div id ="add">
		
	</div> -->
</body>
</html>