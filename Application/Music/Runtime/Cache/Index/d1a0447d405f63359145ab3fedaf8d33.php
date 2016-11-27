<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>社会招聘-招聘中心-酷狗音乐</title>
	<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/zhi.css">
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
		<img src="<?php echo C('T_URL');?>/images/zhi/11.jpg">
	</div>
	<div id="center">
		<div class="cen-top">
			<span>热门职位</span>
		</div>
		<div class="cen-cen">
			    <div class="tt">
						<div class="th1">职位名称</div>
						<div class="th2">职位类别</div>
						<div class="th3">招聘人数</div>
						<div class="th4">工作地点</div>
						<div class="th5">发布日期</div>
                </div>
				<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="rrt">
							<div class="td1"><a href="<?php echo U('Index/Employee/index4',array('id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></div>
							<div class="td2"><?php echo ($v["cate"]); ?></div>
							<div class="td3"><?php echo ($v["num"]); ?></div>
							<div class="td4"><?php echo ($v["address"]); ?></div>
							<div ><?php echo ($v["regtime"]); ?></div>
					</div><?php endforeach; endif; ?>
			<div class="ye"><?php echo ($pageinfo); ?></div>
			<!-- <div class="ye">
				<span>11 条数据 1/1 页&nbsp;&nbsp;<a href="#">首页</a>&nbsp;&nbsp;<a href="#">上一页</a>&nbsp;&nbsp;<a href="#">下一页</a>&nbsp;&nbsp;<a href="#">尾页</a></span>
                </tr>
			</div> -->
		</div>
	</div>
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