<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php if(is_array($list)): foreach($list as $key=>$mgj): ?><title><?php echo ($mgj["name"]); ?>-社会招聘-酷狗音乐</title><?php endforeach; endif; ?>
	<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/xinxi.css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-1.8.3.min.js"></script>
</head>
<body>
	<div id="top">
		<img src="<?php echo C('T_URL');?>/images/zhao.png" height="100px">
	</div>
	<!-- 导航 -->
	<div id="dh">
		<div class="dh-l">
			<ul>
				<li id="re"><a href="<?php echo U('Index/Employee/index');?>" title="首页">首页</a></li>
				<li  id="rl" style="background:#48CBFF"><a href="<?php echo U('Index/Employee/index1');?>" title="社会招聘">社会招聘</a></li>
				<li id="rf"><a href="<?php echo U('Index/Employee/index2');?>" title="校园招聘">校园招聘</a></li>
				<li id="rt"><a href="<?php echo U('Index/Employee/index3');?>" title="CEO特招">CEO特招</a></li>
			</ul>
			<a href="/music/index.php/Index/Index/index" class="ku">Kugou官网首页>></a>
		</div>
	</div>
	<div id="img">
		<img src="<?php echo C('T_URL');?>/images/zhi/01.png">
	</div>
	<?php if(is_array($list)): foreach($list as $key=>$v): ?><div id="center">
		<div class="cent-top">
			<a href="/music/index.php/Index/Zhao/index">招聘首页</a>&nbsp;>&nbsp;<a href="/music/index.php/Index/Zhao/index1">社会招聘</a>&nbsp;>&nbsp;<?php echo ($v["name"]); ?>
		</div>
		<div class="cent-cent">
			<div class="c-c-top">
				<span><?php echo ($v["name"]); ?></span>
			</div>
			<div class="c-dh">
				<ul>
					<li class="it">工作地点：<span><?php echo ($v["address"]); ?></span></li>
					<li>职位类别：<span><?php echo ($v["cate"]); ?></span></li>
					<li>招聘人数：<span><?php echo ($v["num"]); ?></span></li>
				</ul>
			</div>
			<div class="c-c-list">
				<h5>岗位职责：</h5>
				<pre><p><?php echo ($v["task"]); ?></p></pre>
				<h5>任职要求：</h5>
				<pre><p><?php echo ($v["required"]); ?></p></pre>
				<h5>联系方式：</h5>
				<p>邮箱：hr#kugou.com（请把#号替换成@号</p>
			</div>
		</div>
	</div><?php endforeach; endif; ?>
	<div id="guanggao">
		<span>我们致力于推动网络正版音乐发展，相关版权合作请联系copyrights@kugou.com</span>
	</div>
	<div id="aa"></div>
    <div id="foot">
		<div class="foot-dh">
			<ul>
				<li><a href="">关于酷狗</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">广告服务</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">版权指引</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">推广合作</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">招聘信息</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">客服中心</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">用户体验提示计划</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="">酷狗2015官方免费下载</a></li>
			</ul>
		</div>
		<div class="foot-ti">
			<ul>
				<li>我们致力于推动网络正版音乐发展，相关版权合作请联系copyrights@kugou.com</li>
				<li>网络视听许可证1910564号 文网文[2010]175号 增值电信业务经营许可证粤B2-20060339&nbsp;&nbsp;<a href="">粤ICP备09017694号-2</a></li>
				<li>广州酷狗计算机科技有限公司 Copyright (C) 2004-2015 KuGou-Inc.All Rights Reserved </li>
			</ul>
		</div>
		<div class="foot-img">
			<img src="<?php echo C('T_URL');?>/images/login/foot.png" width="200px">
		</div>
	</div>
</body>
</html>