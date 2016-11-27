<?php if (!defined('THINK_PATH')) exit();?>    <!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<?php if(is_array($doop)): foreach($doop as $key=>$fvg): ?><title><?php echo ($fvg["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($fvg["keywords"]); ?>"><?php endforeach; endif; ?>
	<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/bootstrapValidator.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/index.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/geren.css"> -->
	<!-- <script type="text/javascript" src="<?php echo C('T_URL');?>/js/index.js"></script> -->
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#myform').bootstrapValidator();
	    });
	</script>
</head>
<body>
	 <!-- 头部开始 -->
	<div id="header">
		<div id="top">
		    <!-- logo部分 -->
			<div class="top-left">
			    <?php if(is_array($doop)): foreach($doop as $key=>$uup): ?><a href="/music/index.php/Index/Index/index"><img src="/music/<?php echo ($uup["logo"]); ?>" width="160px" height="50px"></a><?php endforeach; endif; ?>
				<img src="<?php echo C('T_URL');?>/images/login/logo2.png">
			</div>
			<!-- 注册登录部分 -->
			<div class="top-right">
			    <?php if($_SESSION['username'] == null): ?><div class="right-t">
				  <ul>
				    <li><a class="t-aa" href="<?php echo U('Index/Employee/index');?>"></a></li>
					<li><a href="<?php echo U('Index/Register/index');?>">新用户注册</a></li>
					<li><span data-toggle="modal" data-target="#myModal">立即登录</span></li>
				  </ul>	
				</div>
				<?php else: ?>
				<div class="right-t1">
				  <ul>
				    <li><a class="t-aa" href="<?php echo U('Index/Employee/index');?>"></a></li>
					<li><?php if($_SESSION['user'][pic] == ''): ?><img src="<?php echo C('T_URL');?>/images/user.png" width="40px" height="40px"><?php else: ?><img src="/music/<?php echo ($_SESSION['user'][pic]); ?>" width="40px" height="40px"><?php endif; ?></li>
					<li><a href="javascript:void(0)" style="color:#72CEF2;text-decoration: underline"><?php if($_SESSION['user']['username'] == ''): echo ($_SESSION['user']['email']); else: echo ($_SESSION['user']['username']); endif; ?></a></li>
					<li><a href="<?php echo U('Index/Login/logout');?>">退出登陆</a></li>
					<li class="goods"><a href="/music/index.php/Index/Titindents/index" style="border:1px solid red"><img src="<?php echo C('T_URL');?>/images/goods.png"></a></li>
				  </ul>	
				</div><?php endif; ?>

				<!-- 模态框（Modal） -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="myModalLabel" align="center">登录框</h4>
		            </div>
		         <form id="myform" class="form-horizontal"  action="<?php echo U('Index/Login/isLogin');?>" method="post" role="form">
		  
			        <div class="form-group">
			        	<label for="username" class="control-label col-sm-2">用户名:</label>
			          <div class="col-xs-8">
			            	 <input type="text" id="username" class="form-control" name="username"
	                                   data-bv-message="用户名没有验证"
	                                   required data-bv-notempty-message="用户名不能为空"
	                                   pattern="^[a-zA-Z0-9]+$" data-bv-regexp-message="用户名只能由字母和数字组成"
	                                   data-bv-stringlength="true" data-bv-stringlength-min="2" data-bv-stringlength-max="30" data-bv-stringlength-message="用户名最少2个字符,不能超过30个字符"/>
	          		   </div>           
			          </div>
			    
		         	<div class="form-group">
                        <label for="password" class="control-label col-sm-2">密码:</label>
                        <div class="col-xs-8">
                            <input type="password" id="password" class="form-control" name="password"
                                   required data-bv-notempty-message="密码不能为空"
                                   data-bv-different="true" data-bv-different-field="username" data-bv-different-message="用户名和密码不能相同"/>
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
				<!-- 网页播放器等部分 -->
				<div class="right-b">
					<div class="b-1">
						<img src="<?php echo C('T_URL');?>/images/login/01.png">
						<a href="javascript:void(0)">网页播放器</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-2">
						<img src="<?php echo C('T_URL');?>/images/login/02.png">
						<a href="javascript:void(0)">酷狗游戏</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-3">
						<img src="<?php echo C('T_URL');?>/images/login/03.png">
						<a href="javascript:void(0)">下载客户端</a>
					</div>
				</div>
			</div>
		</div>
		<!-- 导航部分 -->
		<div id="dh">
			<div class="dh-l">
			<!-- 导航左边的内容 -->
				<ul class="ul-l">
					<li><a href="<?php echo U('Index/Index/index');?>">乐库</a></li>
					<li><a href="<?php echo U('Index/Rank/index');?>">排行榜</a></li>
					<li><a href="<?php echo U('Index/Classify/index');?>">分类</a></li>
					<li><a href="<?php echo U('Index/Excellent/index');?>">精选</a></li>
					<li><a href="<?php echo U('Index/Shop/index');?>">商城</a></li>
					<li><a href="<?php echo U('Index/Good/index');?>">好歌</a></li>
					<li><a href="javascript:void(0)">推荐</a></li>
				</ul>
				<!-- 导航右边的内容 -->
				<ul class="ul-b">	
					<li><a href="">VIP中心</a></li>
					<li><a href="javascript:void(0)">客服中心</a></li>
					<li><a href="">产品中心</a></li>
				</ul>
			</div>
		</div>
	</div>

	<link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/buyindex.css" />
	
	 <!-- 轮播开始 -->
	 <div class="lunbotu">
	   	<div id="myCarousel" class="carousel slide">
	    <!-- 轮播（Carousel）指标 -->
	    <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	        <li data-target="#myCarousel" data-slide-to="1"></li>
	        <li data-target="#myCarousel" data-slide-to="2"></li>
	        <li data-target="#myCarousel" data-slide-to="3"></li>
	    </ol>   
	    <!-- 轮播（Carousel）项目 -->
	    <div class="carousel-inner" data-ride="carousel" data-interval="3500" id="lunbo">
	        <div class="item active">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/1.jpg" alt="图1">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/2.jpg" alt="图2">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/3.jpg" alt="图3">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/4.jpg" alt="图4">
	        </div>
	    </div>
	    <!-- 轮播（Carousel）导航 -->
	    <a class="carousel-control left" href="#myCarousel" 
	        data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span>
	    	<span class="sr-only">Previous</span>
	    </a>
	    <a class="carousel-control right" href="#myCarousel" 
	        data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
	    	<span class="sr-only">Next</span>
	    </a>
	</div>
	</div>
<!--轮播结束-->
<!--商品展示-->	
	<div class="showgoods">
	<div class="cate-title"><span>小耳机</span></div>
	<div class="row">
	<?php if(is_array($goods_show1)): $i = 0; $__LIST__ = array_slice($goods_show1,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<a href="<?php echo U('Index/Goods/index',array('id'=>$vo['id']));?>"><img src="/music/<?php echo ($vo["img"]); ?>" alt="通用的占位符缩略图"></a>
				<div class="caption">
					<p>商品名称:<?php echo ($vo["name"]); ?></p>
					<p>原价:<?php echo ($vo["oldprice"]); ?></p>
					<p>促销价格:<?php echo ($vo["nowprice"]); ?></p>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	</div>
	<div class="showgoods">
	<div class="cate-title"><span>周杰伦专辑</span></div>
		<div class="row">
		<?php if(is_array($goods_show2)): $i = 0; $__LIST__ = array_slice($goods_show2,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<a href="<?php echo U('Index/Goods/index',array('id'=>$vo['id']));?>"><img src="/music/<?php echo ($vo["img"]); ?>" alt="通用的占位符缩略图"></a>
				<div class="caption">
					<p>商品名称:<?php echo ($vo["name"]); ?></p>
					<p>原价:<?php echo ($vo["oldprice"]); ?></p>
					<p>促销价格:<?php echo ($vo["nowprice"]); ?></p>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	</div>
	<div class="showgoods">
	<div class="cate-title"><span>小音响</span></div>
		<div class="row">
		<?php if(is_array($goods_show3)): $i = 0; $__LIST__ = array_slice($goods_show3,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-3 ">
			<div class="thumbnail">
				<a href="<?php echo U('Index/Goods/index',array('id'=>$vo['id']));?>"><img src="/music/<?php echo ($vo["img"]); ?>" alt="通用的占位符缩略图"></a>
				<div class="caption">
					<p>商品名称:<?php echo ($vo["name"]); ?></p>
					<p>原价:<?php echo ($vo["oldprice"]); ?></p>
					<p>促销价格:<?php echo ($vo["nowprice"]); ?></p>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	</div>
<!-- 商品页身体部分结束 -->
    <div id="aa"></div>
    <div id="foot">
		<div class="foot-dh">
			<ul>
				<li><a href="JavaScript:void(0)">关于酷狗</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">广告服务</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">版权指引</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">推广合作</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">招聘信息</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">客服中心</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">用户体验提示计划</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="JavaScript:void(0)">酷狗2016官方免费下载</a></li>
			</ul>
		</div>
		<div class="foot-ti">
			<ul>
				<li>我们致力于推动网络正版音乐发展，相关版权合作请联系copyrights@kugou.com</li>
				<li>网络视听许可证1910564号 文网文[2010]175号 增值电信业务经营许可证粤B2-20060339&nbsp;&nbsp;<a href="JavaScript:void(0)">粤ICP备09017694号-2</a></li>
				<li>广州酷狗计算机科技有限公司 Copyright (C) 2004-2017 KuGou-Inc.All Rights Reserved </li>
			</ul>
		</div>
		<div class="foot-img">
			<img src="<?php echo C('T_URL');?>/images/login/foot.png" width="200px">
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
      
       // 专辑最新部分的选项卡特效
	   var list1=document.getElementById("list1");
	   var list2=document.getElementById("list2");
	   var list3=document.getElementById("list3");
	   var list4=document.getElementById("list4");
	   var list5=document.getElementById("list5");
	   var list6=document.getElementById("list6");
	   var list7=document.getElementById("list7");
	   var list8=document.getElementById("list8");
	   var list9=document.getElementById("list9");
	   var list10=document.getElementById("list10");
	   var list11=document.getElementById("list11");
       var list12=document.getElementById("list12");
	   var cur1=document.getElementById("cur1");
	   var cur2=document.getElementById("cur2");
	   var cur3=document.getElementById("cur3");
	   cur1.style.backgroundColor="#B5B5B5";
	   cur1.style.color="white";
	   cur1.onmouseover=function(){
	   	  list1.style.display="block";
	   	  list2.style.display="none";
	   	  list3.style.display="none";
	   	  list4.style.display="block";
	   	  list5.style.display="none";
	   	  list6.style.display="none";
	   	  list7.style.display="block";
	   	  list8.style.display="none";
	   	  list9.style.display="none";
	   	  list10.style.display="block";
	   	  list11.style.display="none";
	   	  list12.style.display="none";
	   	  cur1.style.backgroundColor="#B5B5B5";
	      cur1.style.color="white";
	      cur2.style.backgroundColor="white";
	      cur2.style.color="black";
          cur3.style.backgroundColor="white";
	      cur3.style.color="black";
	   }
	   cur2.onmouseover=function(){
	   	  list1.style.display="none";
	   	  list2.style.display="block";
	   	  list3.style.display="none";
	   	  list4.style.display="none";
	   	  list5.style.display="block";
	   	  list6.style.display="none";
	   	  list7.style.display="none";
	   	  list8.style.display="block";
	   	  list9.style.display="none";
	   	  list10.style.display="none";
	   	  list11.style.display="block";
	   	  list12.style.display="none";
	   	  cur1.style.backgroundColor="white";
	      cur1.style.color="black";
	      cur2.style.backgroundColor="#B5B5B5";
	      cur2.style.color="white";
          cur3.style.backgroundColor="white";
	      cur3.style.color="black";
	   }
	   cur3.onmouseover=function(){
	   	  list1.style.display="none";
	   	  list2.style.display="none";
	   	  list3.style.display="block";
	   	  list4.style.display="none";
	   	  list5.style.display="none";
	   	  list6.style.display="block";
	   	  list7.style.display="none";
	   	  list8.style.display="none";
	   	  list9.style.display="block";
	   	  list10.style.display="none";
	   	  list11.style.display="none";
	   	  list12.style.display="block";
	   	  cur1.style.backgroundColor="white";
	      cur1.style.color="black";
	      cur2.style.backgroundColor="white";
	      cur2.style.color="black";
          cur3.style.backgroundColor="#B5B5B5";
	      cur3.style.color="white";
	   }
       
       // 专辑华语、欧美、日韩、蒙面歌王的选项卡
	   var sp1=document.getElementById("sp1");
	   var sp2=document.getElementById("sp2");
	   var sp3=document.getElementById("sp3");
	   var sp4=document.getElementById("sp4");
	   var gequ1=document.getElementById("gequ1");
	   var gequ2=document.getElementById("gequ2");
	   var gequ3=document.getElementById("gequ3");
	   var gequ4=document.getElementById("gequ4");
	   sp1.style.color="#6FCEF4";
	   sp1.onmouseover=function(){
	   	  gequ1.style.display="block";
	   	  gequ2.style.display="none";
	   	  gequ3.style.display="none";
	   	  gequ4.style.display="none";
	   	  sp1.style.color="#6FCEF4";
	   	  sp2.style.color="#464646";
	   	  sp3.style.color="#464646";
	   	  sp4.style.color="#464646";
	   }
	   sp2.onmouseover=function(){
	   	  gequ2.style.display="block";
	   	  gequ1.style.display="none";
	   	  gequ3.style.display="none";
	   	  gequ4.style.display="none";
	   	  sp2.style.color="#6FCEF4";
	   	  sp1.style.color="#464646";
	   	  sp3.style.color="#464646";
	   	  sp4.style.color="#464646";
	   }
	    sp3.onmouseover=function(){
	   	  gequ3.style.display="block";
	   	  gequ1.style.display="none";
	   	  gequ2.style.display="none";
	   	  gequ4.style.display="none";
	   	  sp3.style.color="#6FCEF4";
	   	  sp1.style.color="#464646";
	   	  sp2.style.color="#464646";
	   	  sp4.style.color="#464646";
	   }
	    sp4.onmouseover=function(){
	   	  gequ4.style.display="block";
	   	  gequ1.style.display="none";
	   	  gequ3.style.display="none";
	   	  gequ2.style.display="none";
	   	  sp4.style.color="#6FCEF4";
	   	  sp1.style.color="#464646";
	   	  sp3.style.color="#464646";
	   	  sp2.style.color="#464646";
	   }
       
       // 最新、最热、推荐榜的选项卡
	   var zui1=document.getElementById("zui1");
	   var zui2=document.getElementById("zui2");
	   var zui3=document.getElementById("zui3");
	   var pp1=document.getElementById("pp1");
	   var pp2=document.getElementById("pp2");
	   var pp3=document.getElementById("pp3");
	   zui1.style.color="#6FCEF4";
	   zui1.onmouseover=function(){
	   	  zui1.style.color="#6FCEF4";
	   	  zui2.style.color="#464646"
	   	  zui3.style.color="#464646"
	   	  pp1.style.display="block";
	   	  pp2.style.display="none";
	   	  pp3.style.display="none";
	   }
	   zui2.onmouseover=function(){
	   	  zui2.style.color="#6FCEF4";
	   	  zui1.style.color="#464646"
	   	  zui3.style.color="#464646"
	   	  pp2.style.display="block";
	   	  pp1.style.display="none";
	   	  pp3.style.display="none";
	   }
	    zui3.onmouseover=function(){
	   	  zui3.style.color="#6FCEF4";
	   	  zui1.style.color="#464646"
	   	  zui2.style.color="#464646"
	   	  pp3.style.display="block";
	   	  pp1.style.display="none";
	   	  pp2.style.display="none";
	   }
       //最热歌曲的翻页特效
       var lista=document.getElementById("lista");
       var listb=document.getElementById("listb");
       var listc=document.getElementById("listc");
       var cura=document.getElementById("cura");
       var curb=document.getElementById("curb");
       var curc=document.getElementById("curc");
       cura.style.backgroundColor="#B5B5B5";
       cura.style.color="white";
       cura.onmouseover=function(){
       	  lista.style.display="block";
       	  listb.style.display="none";
       	  listc.style.display="none";
       	  cura.style.backgroundColor="#B5B5B5";
       	  cura.style.color="white";
       	  curb.style.backgroundColor="white";
       	  curb.style.color="black";
       	  curc.style.backgroundColor="white";
       	  curc.style.color="black";
       }
       curb.onmouseover=function(){
       	  listb.style.display="block";
       	  lista.style.display="none";
       	  listc.style.display="none";
       	  curb.style.backgroundColor="#B5B5B5";
       	  curb.style.color="white";
       	  cura.style.backgroundColor="white";
       	  cura.style.color="black";
       	  curc.style.backgroundColor="white";
       	  curc.style.color="black";
       }
       curc.onmouseover=function(){
       	  listc.style.display="block";
       	  listb.style.display="none";
       	  lista.style.display="none";
       	  curc.style.backgroundColor="#B5B5B5";
       	  curc.style.color="white";
       	  curb.style.backgroundColor="white";
       	  curb.style.color="black";
       	  cura.style.backgroundColor="white";
       	  cura.style.color="black";
       }

       //热榜top10的选项卡
       var tp10a=document.getElementById("tp10a");
       var tp10b=document.getElementById("tp10b");
       var tl1=document.getElementById("tl1");
       var tl2=document.getElementById("tl2");
       tp10a.style.color="#6FCEF4";
       tp10a.onmouseover=function(){
       	  tp10a.style.color="#6FCEF4";
       	  tp10b.style.color="#464646";
       	  tl1.style.display="block";
       	  tl2.style.display="none";
       }
       tp10b.onmouseover=function(){
       	  tp10b.style.color="#6FCEF4";
       	  tp10a.style.color="#464646";
       	  tl2.style.display="block";
       	  tl1.style.display="none";
       }

       //全球热榜top10的选项卡
       var wt1=document.getElementById("wt1");
       var wt2=document.getElementById("wt2");
       var wt3=document.getElementById("wt3");
       var wt4=document.getElementById("wt4");
       var wor1=document.getElementById("wor1");
       var wor2=document.getElementById("wor2");
       var wor3=document.getElementById("wor3");
       var wor4=document.getElementById("wor4");
       wt1.style.color="#6FCEF4";
       wt1.onmouseover=function(){
       	  wt1.style.color="#6FCEF4";
       	  wt2.style.color="#464646";
       	  wt3.style.color="#464646";
       	  wt4.style.color="#464646";
       	  wor1.style.display="block";
       	  wor2.style.display="none";
       	  wor3.style.display="none";
       	  wor4.style.display="none";
       }
       wt2.onmouseover=function(){
       	  wt2.style.color="#6FCEF4";
       	  wt1.style.color="#464646";
       	  wt3.style.color="#464646";
       	  wt4.style.color="#464646";
       	  wor2.style.display="block";
       	  wor1.style.display="none";
       	  wor3.style.display="none";
       	  wor4.style.display="none";
       }
       wt3.onmouseover=function(){
       	  wt3.style.color="#6FCEF4";
       	  wt2.style.color="#464646";
       	  wt1.style.color="#464646";
       	  wt4.style.color="#464646";
       	  wor3.style.display="block";
       	  wor2.style.display="none";
       	  wor1.style.display="none";
       	  wor4.style.display="none";
       }
       wt4.onmouseover=function(){
       	  wt4.style.color="#6FCEF4";
       	  wt2.style.color="#464646";
       	  wt3.style.color="#464646";
       	  wt1.style.color="#464646";
       	  wor4.style.display="block";
       	  wor2.style.display="none";
       	  wor3.style.display="none";
       	  wor1.style.display="none";
       }
</script>