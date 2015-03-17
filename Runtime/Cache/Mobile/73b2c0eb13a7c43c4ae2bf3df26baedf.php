<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
 <title>社区调查</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="/Mobile/View/Public/jquery.mobile-1.4.5.min.css" /> 
 <script src="/Mobile/View/Public/jquery-1.8.0.min.js"></script> 
 <script src="/Mobile/View/Public/jquery.mobile-1.4.5.min.js"></script> 
</head>
<body> 
	<div data-role="page"> 
		<div data-role="header"> 
		<h1>社区调查</h1> 
		</div>
		<div data-role="content">
			<p  data-role="title">感谢你的参与！</p>
　　  
　　  <p>
　　    <a href="javascript:;"
　　       data-role="button"
　　       onclick="window.dc.js_finish()">关闭
　　    </a>
　　  </p>
		<div data-role="footer"><h4><?php echo (C("web_copy")); ?></h4></div>

		 

		 

		</div>
	</div>
</body> 

</html>