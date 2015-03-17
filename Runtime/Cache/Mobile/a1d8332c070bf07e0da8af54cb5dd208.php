<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>vip商品详情</title>
<link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>
html, body { padding: 0; margin: 0; background: #f8f8f8;}
</style>
</head>
<body>

<div data-role="page"  id = "pageOne" data-enhance="true"> 
    <div data-role="header">        
      <div data-role="navbar">
        <ul>
          <li><a href="#pageOne">图文详情</a></li>
          <li><a href="#pageTwo">产品参数</a></li>
          <li><a href="#pageThree">包装售后</a></li>
        </ul>
      </div>
    </div>
    <div data-role="content">
        <?php echo $info['intro'];?>
    </div>
</div>
<div data-role="page" id = "pageTwo"> 
    <div data-role="header">
      <div data-role="navbar">
        <ul>
          <li><a href="#pageOne">图文详情</a></li>
          <li><a href="#pageTwo">产品参数</a></li>
          <li><a href="#pageThree">包装售后</a></li>
        </ul>
      </div>
    </div>
      <div data-role="navbar">
        <div data-role="content">
            
              <?php foreach ($type as $k => $v) { echo "<p style='dispaly:block'>$k$v</p>"; }?>

            
            <!--<table>
              <?php if(is_array($info["type"])): $k = 0; $__LIST__ = $info["type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                <td><?php echo ($vo); ?></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table> -->
            
     </div>
    
   </div>
            
        </div>
      </div>
    
</div>
<div data-role="page" id = "pageThree"> 
    <div data-role="header">
      <div data-role="navbar"> 
      <ul>
          <li><a href="#pageOne">图文详情</a></li>
          <li><a href="#pageTwo">产品参数</a></li>
          <li><a href="#pageThree">包装售后</a></li>
        </ul>
      </div>
    </div>
        <div data-role="content">
            <p><?php echo ($info["description"]); ?></p>
        </div>
     
</div>
</body>
</html>