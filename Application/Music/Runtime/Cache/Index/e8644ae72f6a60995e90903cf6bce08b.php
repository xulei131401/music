<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/zhaoping.css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
	<script type="text/javascript">
       document.title="招聘中心-酷狗音乐";
	</script>
</head>
<body>
	<div id="top">
		<img src="<?php echo C('T_URL');?>/images/zhao.png" height="100px">
	</div>
	<!-- 导航 -->
	<div id="dh">
		<div class="dh-l">
			<ul>
				<li id="re" style="background:#48CBFF"><a href="" title="首页">首页</a></li>
				<li id="rl"><a href="<?php echo U('Index/Employee/index1');?>" title="社会招聘">社会招聘</a></li>
				<li id="rf"><a href="<?php echo U('Index/Employee/index2');?>" title="校园招聘">校园招聘</a></li>
				<li id="rt"><a href="<?php echo U('Index/Employee/index3');?>" title="CEO特招">CEO特招</a></li>
			</ul>
			<a href="/music/index.php/Index/Index/index" class="ku">Kugou官网首页>></a>
		</div>
	</div>
	<div id="img">
		<img src="<?php echo C('T_URL');?>/images/03.jpg">
	</div>
	<div id="fuli">
		<img src="<?php echo C('T_URL');?>/images/fuli_bg.png">
	</div>
	<div id="zhiwei">
		<div class="zhi-img">
			<a href=""><img src="<?php echo C('T_URL');?>/images/ceo.png"></a>
		</div>
		<div class="zhi-test">
			<div class="test-top">
				<span>热门职位</span>
				<a href="">更多职位>></a>
			</div>
			<div class="test-c">
				<ul>
					<li><a href="">PHP开发工程师</a></li>
					<li><a href="">前端开发工程师</a></li>
					<li><a href="">IOS开发工程师</a></li>
					<li><a href="">android开发工程师</a></li>
					<li><a href="">自动化测试工程师</a></li>
					<li><a href="">VC开发工程师</a></li>
					<li><a href="">产品经理</a></li>
					<li><a href="">市场经理</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="kugou">
		<div class="kugou-top">
			<span>走进酷狗</span>
		</div>
		<div class="kugou-img">
			<ul>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/01.jpg" width="305px" height="180px"><h5><span>我们真不是黑社会-部门海边游</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/02.jpg" width="305px" height="180px"><h5><span>放开那女生，让我来-部门海边游</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/03.jpg" width="305px" height="180px"><h5><span>我只想说四个字，哪投简历！-繁星女神秀</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/04.jpg" width="305px" height="180px"><h5><span>阳光快乐的团队，期待你成为其中一份子-年轻就是这个味</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/05.jpg" width="305px" height="180px"><h5><span>努力就能受到认可-优秀团队颁奖</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/06.jpg" width="305px" height="180px"><h5><span>耍帅也得有实力，顺利通关！-受邀参加活力大冲关</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/07.jpg" width="305px" height="180px"><h5><span>打篮球的男生最帅气，求交往！-篮球友谊赛</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/08.jpg" width="305px" height="180px"><h5><span>帅哥美女壮大我大酷狗-年会主持</span></h5></li>
				<li><img src="<?php echo C('T_URL');?>/images/zhi/09.jpg" width="305px" height="180px"><h5><span>我们的底线就是没有下限-游戏年会节目</span></h5></li>
			</ul>
		</div>
	</div>
	<div id="xinxi">
		<div class="xinxi-top">
			<span>联系信息</span>
		</div>
		<div class="xinxi-c">
			<div class="xin-l">
				<div class="xin-l-top">
					<span>广州招聘邮箱地址</span>
				</div>
				<div class="xin-l-list">
					<p><span>Email:hr@kugou.com</span></p>
					<p>广州总部地址:<br><br><span>广州市天河区科韵路广州信息港B1栋13楼</span></p>
				</div>
			</div>
			<div class="xin-c">
				<div class="xin-c-top">
					<span>北京招聘邮箱地址</span>
				</div>
				<div class="xin-c-list">
					<p><span>Email:bjjob@kugou.com</span></p>
					<p>北京总部地址:<br><br><span>北京市朝阳区光华路甲8号和乔大厦B座208</span></p>
				</div>
			</div>
			<div class="xin-r">
				<div class="xin-r-top">
					<span>CEO特招邮箱地址</span>
				</div>
				<div class="xin-r-list">
					<p><span>Email:ceo@kugou.com</span></p>
					
				</div>
			</div>
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