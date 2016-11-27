<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>用户注册-酷狗音乐</title>
	<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/zhuce.css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/bootstrap.min.js"></script>
	<link href="<?php echo C('T_URL');?>/css/templatemo_style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#myform1').bootstrapValidator();
	    });
	</script>
</head>
<body>
    <!-- 头部部分 -->
	<div id="top">
	    <!-- logo部分 -->
		<div class="top-left">
			<img src="<?php echo C('T_URL');?>/images/01.jpg" height="25px">
			<img src="<?php echo C('T_URL');?>/images/02.jpg" height="25px">
		</div>
		<!-- 注册登录 -->
		<div class="top-right">
			<ul>
				<li><button class="btn btn-primary btn-sm" >注册</button></li>
				<li><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">登录</button></li>

			</ul>
		</div>
		<!-- 模态框（Modal） -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="myModalLabel">登录框</h4>
		            </div>
		         <form class="form-horizontal" role="form" action="<?php echo U('Index/Login/isLogin');?>" method="post" id="myform1">				
		        <div class="form-group">	            
		            <label for="username" class="control-label">用户名:</label>
		            <div class="col-xs-10">
		            	<input type="text" class="form-control" id="username" placeholder="填写用户名" name="username" 
		            				 data-bv-message="用户名没有验证"
	                                   required data-bv-notempty-message="用户名不能为空"
	                                   pattern="^[a-zA-Z0-9]+$" data-bv-regexp-message="用户名只能由字母和数字组成"
	                                   data-bv-stringlength="true" data-bv-stringlength-min="2" data-bv-stringlength-max="30" data-bv-stringlength-message="用户名最少2个字符,不能超过30个字符"/>
	                     </div>
		        	            	            
		          </div>              

		        <div class="form-group">
		         <label for="password" class="control-label">密码:</label>
			        <div class="col-xs-10">
		            	<input type="password" name="password" class="form-control" id="password" placeholder="填写密码" 
		            	required data-bv-notempty-message="密码不能为空" 
		            	data-bv-different="true" data-bv-different-field="username" 
		            	data-bv-different-message="用户名和密码不能相同"/>
	                 </div>
		         </div>
		       
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		
		          		<a href="/music/index.php/Index/Resetpass/index" class="text-right pull-right">忘记密码?</a>
		          	</div>
		          </div>
		        </div>
		
		        	<div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		                <button type="submit" class="btn btn-primary">登录</button>
		            </div>
		      </form>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal -->
		</div>
		
	</div>
	<!-- 导航部分 -->
	<div id="dh">
			<div class="dh-c">
				<img src="<?php echo C('T_URL');?>/images/daohang.png" height="60px">
				<div class="dh-l">
					<ul>
						<li><a href="javascript:void(0)" title="酷狗商城">酷狗商城</a></li>
						<li><a href="javascript:void(0)" title="下载客户端">下载客户端</a></li>
						<li><a href="javascript:void(0)" title="娱乐资讯">娱乐资讯</a></li>
						<li><a href="javascript:void(0)" title="音乐直播">音乐直播</a></li>
						<li><a href="javascript:void(0)" title="酷狗音乐人">酷狗音乐人</a></li>
					</ul>
					<ul class="or" id="ul1">	
						<li class="or"><a href="javascript:void(0)" title="产品中心">产品中心</a></li>
						<li class="or"><a href="javascript:void(0)" title="VIP中心">VIP中心</a></li>
						<li class="or"><a href="javascript:void(0)" title="客服中心">客服中心</a></li>
					</ul>
				</div>
			</div>
	</div>
	<div id="shou"><a href="/music/index.php/Index/Index/index">返回首页>></a></div>
	<!-- 中间注册主体部分 -->
	<div id="center">
		<h1 class="margin-bottom-15" align="center">创建帐户</h1>
	  	<div class="container zhuce">
		<div class="col-md-12">			
			<form class="form-horizontal" role="form" action="<?php echo U('Index/Register/index');?>" method="post">
					<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">真实姓名</label>
			            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="realname">
			          </div>
			           <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">电话</label>
			            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="tel">
			          </div>
			        </div>
			      	<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">邮箱</label>
			            <input type="email" class="form-control input-sm" id="first_name" placeholder="" name="email">
			          </div>
			           <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">用户名</label>
			            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="username">
			          </div>
			        </div>
			      <div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">密码</label>
			            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="password">
			          </div>
			           <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">确认密码</label>
			            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="repassword">
			          </div>
			        </div>
			       <div class="form-group">
			   		<div class="col-md-6 templatemo-radio-group">
			          	<label class="radio-inline">
		          			<input type="radio" name="sex" id="optionsRadios1" value="0" checked="checked"> 男
		          		</label>
		          		<label class="radio-inline">
		          			<input type="radio" name="sex" id="optionsRadios2" value="1"> 女
		          		</label>
			          </div>
				      	<div class="form-group">
				          <div class="col-md-6">		          	
				            <label for="first_name" class="control-label">验证码</label>
				            <input type="text" class="form-control input-sm" id="first_name" placeholder="" name="checkCode">
				            <img src="<?php echo U('Index/Common/verify');?>" alt="验证码" onclick="this.src='<?php echo U('Index/Common/verify');?>?code='+Math.random()">
				          </div>
				     	 </div>
			      </div>
			      <div class="form-group">
			          <div class="col-md-12">
			            <input type="submit" value="创建帐户" class="btn btn-info">
			          </div>
			        </div>	
		      </form>		      
		</div>
	</div>
	</div>
	<div id="footer-a"></div>
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
			<img src="<?php echo C('T_URL');?>/images/foot.png" width="200px">
		</div>
	</div>
</body>
</html>
<!-- <script type="text/javascript">
        function fun(){
			var login=document.getElementById("login");
			login.style.display="block";
		}
		var close=document.getElementById("close");
		close.onclick=function(){
			login.style.display="none";
	   }
</script> -->