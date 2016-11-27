<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/zhuce.css">
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-1.8.3.min.js"></script>
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
				<li><a href="" title="注册">注册</a></li>
				<li><a href="" title="登录">登录</a></li>
			</ul>
		</div>
	</div>
	<!-- 导航部分 -->
	<div id="dh">
			<div class="dh-c">
				<img src="<?php echo C('T_URL');?>/images/daohang.png" height="60px">
				<div class="dh-l">
					<ul>
						<li><a href="" title="酷狗商城">酷狗商城</a></li>
						<li><a href="" title="下载客户端">下载客户端</a></li>
						<li><a href="" title="娱乐资讯">娱乐资讯</a></li>
						<li><a href="" title="音乐直播">音乐直播</a></li>
						<li><a href="" title="酷狗音乐人">酷狗音乐人</a></li>
					</ul>
					<ul class="or">	
						<li class="or"><a href="" title="产品中心">产品中心</a></li>
						<li class="or"><a href="" title="VIP中心">VIP中心</a></li>
						<li class="or"><a href="" title="客服中心">客服中心</a></li>
					</ul>
				</div>
			</div>
	</div>
	<!-- 中间注册主体部分 -->
	<div id="center">
	    <!-- 注册导航部分 -->
		<div class="login-top">
			<div class="login">
				<img src="<?php echo C('T_URL');?>/images/1.png" height="20px">
				<span id="ab">用户登录</span>
			</div>
		</div>
		<div class="center-c">
		    <div class="fm">
		    	
		        <form action="<?php echo U('Index/Login/isLogin');?>" method="post" id="ge">
				    <label class="int">*&nbsp;用户名：</label><input type="text" name="username" class="req"><br><br>
				    <label class="int">*&nbsp;密码：</label><input type="password" name="password" class="req"><br><br>
				    <label class="int">*&nbsp;验证码：</label><input type="text" name="fcode" class="req1"><img height="30px" 
				    id="aa" src="<?php echo U('Index/Common/verify');?>" alt="验证码" 
				    onclick="this.src='<?php echo U('Index/Common/verify');?>?code='+Math.random()"><a onclick="a.src='<?php echo U('Index/Common/verify');?>?code='+Math.random()" class="yzm1">&nbsp;&nbsp;&nbsp;换一张</a><br><br>
				    <input class="sub1" type=image src="<?php echo C('T_URL');?>/images/login.png" name="sub1" onClick="javascript:testclick.submit();">
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
				<li>广州酷狗计算机科技有限公司 Copyright (C) 2004-2017 KuGou-Inc.All Rights Reserved </li>
			</ul>
		</div>
		<div class="foot-img">
			<img src="<?php echo C('T_URL');?>/images/foot.png" width="200px">
		</div>
	</div>
</body>
</html>
<script>
	var a=document.getElementById('aa');
</script>
<script type="text/javascript">
	var em=document.getElementById("em");
	var ph=document.getElementById("ph");
	var us=document.getElementById("us");
	var gm=document.getElementById("gm");
	var gh=document.getElementById("gh");
	var ge=document.getElementById("ge");
	var ab=document.getElementById("ab");
	var cd=document.getElementById("cd");
	var ef=document.getElementById("ef");
	em.style.background="white";
	em.style.border="0px"
	em.style.borderTop="3px solid #54ADE7"
	em.onclick=function(){
       gm.style.display="block";
       gh.style.display="none";
       ge.style.display="none";
       em.style.background="white";
	   em.style.border="0px"
	   em.style.borderTop="3px solid #54ADE7"
	   ab.style.color="#2B86CB"
	   cd.style.color="#A3A3A3"
	   ef.style.color="#A3A3A3"

	   ph.style.background="#F5F5F5";
	   ph.style.border="1px solid #CCCCCC"
	   ph.style.borderLeft="0px"
	   us.style.background="#F5F5F5";
	   us.style.border="1px solid #CCCCCC"
	   us.style.borderLeft="0px"
	}
	ph.onclick=function(){
       gm.style.display="none";
       gh.style.display="block";
       ge.style.display="none";
       ph.style.background="white";
	   ph.style.border="0px"
	   ph.style.borderTop="3px solid #54ADE7"
	   ab.style.color="#A3A3A3"
	   cd.style.color="#2B86CB"
	   ef.style.color="#A3A3A3"

       em.style.background="#F5F5F5";
	   em.style.border="1px solid #CCCCCC"
	   em.style.borderLeft="0px"
	   us.style.background="#F5F5F5";
	   us.style.border="1px solid #CCCCCC"
	   us.style.borderLeft="0px"	   
	}
	us.onclick=function(){
       gm.style.display="none";
       gh.style.display="none";
       ge.style.display="block";
       us.style.background="white";
	   us.style.border="0px"
	   us.style.borderTop="3px solid #54ADE7"
	   ab.style.color="#A3A3A3"
	   cd.style.color="#A3A3A3"
	   ef.style.color="#2B86CB"

       em.style.background="#F5F5F5";
	   em.style.border="1px solid #CCCCCC"
	   em.style.borderLeft="0px"
	   ph.style.background="#F5F5F5";
	   ph.style.border="1px solid #CCCCCC"
	   ph.style.borderLeft="0px"
	}
</script>
<script type="text/javascript">
    // var pd=document.getElementsByName('password').val();
   $(function(){
   	  //获取焦点事件
   	  $("input").focus(function(){
   	  	// alert("1111");
   	  	 $(this).css({background:"white",border:"1px solid blue"});
   	  })
   	  //失去焦点事件
   	  $("input[name=email]").blur(function(){
   	  	  //获取当前input框的值
   	  	  var v=$(this).val();
           if(!v){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;邮箱不能为空</span>").css("color","red").insertAfter(this);
          }else if(v.match(/^\w+@\w+\.com$/)==null){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;邮箱格式不正确</span>").css("color","red").insertAfter(this);
          }else{
          	$(this).next("span").remove();
          }
   	  })
   	   //手机注册失去焦点事件
   	  $("input[name=phone]").blur(function(){
   	  	  //获取当前input框的值
   	  	  var h=$(this).val();
           if(!h){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;手机号不能为空</span>").css("color","red").insertAfter(this);
          }else if(h.match(/^\d{11}$/)==null){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;手机格式不正确</span>").css("color","red").insertAfter(this);
          }else{
          	$(this).next("span").remove();
          }
   	  })
   	   //用户名注册失去焦点事件
   	  $("input[name=username]").blur(function(){
   	  	  //获取当前input框的值
   	  	  var u=$(this).val();
           if(!u){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;用户名不能为空</span>").css("color","red").insertAfter(this);
          }else if(u.match(/^\w{3,12}$/)==null){
          	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;用户名不符合规则</span>").css("color","red").insertAfter(this);
          }else{
          	$(this).next("span").remove();
          }
   	  })
   	  //密码框的失去焦点事件
   	  $("input[name=password]").blur(function(){
   	  	 //获取值
   	  	 var p=$(this).val();
         if(!p){
         	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;密码不能为空</span>").css("color","red").insertAfter(this);
         }else{
         	$(this).next("span").remove();
         }
   	  })
   	  //确认密码的失去焦点事件
   	  $("input[name=repassword]").blur(function(){
   	  	 //获取input值
   	  	 var rp=$(this).val();
   	  	 if(!rp){
         	$(this).css("border","1px solid red");
          	$(this).next("span").remove();
			$("<span>&nbsp;&nbsp;&nbsp;*&nbsp;确认密码不能为空</span>").css("color","red").insertAfter(this);
         }else{
         	$(this).next("span").remove();
         }
   //       if(rp!=p){
   //       	$(this).css("border","1px solid red");
   //        	$(this).next("span").remove();
			// $("<span>&nbsp;&nbsp;&nbsp;*&nbsp;两次密码不一致</span>").css("color","red").insertAfter(this);
   //       }else{
   //       	$(this).next("span").remove();
   //       }
   	  })
   	  //验证码的失去焦点事件
   //     $("input[name=fcode]").blur(function(){
   // 	  	 //获取input值
   // 	  	 var rp=$(this).val();
   // 	  	 if(!rp){
   //       	$(this).css("border","1px solid red");
   //        	$(this).next("span").remove();
			// $("<span>&nbsp;&nbsp;&nbsp;*&nbsp;确认密码不能为空</span>").css("color","red").insertAfter(this);
   //       }else{
   //       	$(this).next("span").remove();
   //       }
   })

</script>