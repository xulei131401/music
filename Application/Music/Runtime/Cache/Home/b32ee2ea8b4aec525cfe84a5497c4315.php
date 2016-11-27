<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>好歌曲列表管理</title>
	<style type="text/css">
		*{
			padding:0px;
			margin:0 auto;
		}
		#l{
			background-color:#85D2F2;
			width:250px;
			height:50px;
			color:white;
			font-weight:bold;
			text-align:center;
			font-size:30px;
			margin-top:20px;
			line-height:50px;
			list-style-type:none;
			margin-left:40px;
			float:left;
		}
		a{
			text-decoration:none;
		}
		#body{
			width:960px;
			height:auto;
			margin-top:80px;
		}
	</style>
</head>
<body>
	<div id="body">
		<div style="width:880px;height:auto;float:left;">
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><div id="l"><a href="<?php echo U('Home/Goodsong/song_list',array('id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></div><?php endforeach; endif; ?>		
		</div>
	</div>
	
</body>
</html>