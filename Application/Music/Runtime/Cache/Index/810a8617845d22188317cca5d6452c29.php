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
	<script type="text/javascript" src="<?php echo C('T_URL');?>/js/index.js"></script>
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
					<li><a href="/music/index.php/Index/Zhu/index">新用户注册</a></li>
					<li><span data-toggle="modal" data-target="#myModal">立即登录</span></li>
				  </ul>	
				</div>
				<?php else: ?>
				<div class="right-t1">
				  <ul>
				    <li><a class="t-aa" href="/music/index.php/Index/Zhao/index"></a></li>
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


				<!-- <div id="login" style="display:none">
					<div class="login-top">
						<span>登陆酷狗</span>
						<img src="<?php echo C('T_URL');?>/images/login/logo1.png">
					</div>
					<div class="login-c">
						<form action="/music/index.php/Index/Login/check" method="post">

						    <div class="login-inp">
						        <div class="inp-i">
									<label class="lal">账&nbsp;号：</label><input type="text" style="color:gray;" onblur="if(this.value == '')this.value='用户名/邮箱';" onclick="if(this.value == '用户名/邮箱')this.value='';" value="用户名/邮箱" name="username" class="input"><br><br>
								</div>	
							</div>	
							<div class="login-inp">
							    <div class="inp-i">
									<label class="lal">密&nbsp;码：</label><input type="password" value="" name="password" class="input"><br><br>
									
								</div>	
							</div>
							<div class="apas">
								<a href="/music/index.php/Index/Resetpass/index">忘记密码？</a>
								<a href="">立即注册</a>
							</div>
							<input class="sub" type=image src="<?php echo C('T_URL');?>/images/pic/login.png" name="sub1" onClick="javascript:testclick.submit();">	

						</form>
					</div>
					<div id="close"><img src="<?php echo C('T_URL');?>/images/close.png"></div>
				</div> -->
				<!-- 网页播放器等部分 -->
				<div class="right-b">
					<div class="b-1">
						<img src="<?php echo C('T_URL');?>/images/login/01.png">
						<a href="/music/index.php/Index/Audio/index/songid/30">网页播放器</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-2">
						<img src="<?php echo C('T_URL');?>/images/login/02.png">
						<a href="">酷狗游戏</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-3">
						<img src="<?php echo C('T_URL');?>/images/login/03.png">
						<a href="<?php echo C('T_URL');?>/software/KugouPlayer_219_V7.9.9.apk">下载客户端</a>
					</div>
				</div>
			</div>
		</div>
		<!-- 导航部分 -->
		<div id="dh">
			<div class="dh-l">
			<!-- 导航左边的内容 -->
				<ul class="ul-l">
					<li><a href="/music/index.php/Index/Index/index">乐库</a></li>
					<li><a href="/music/index.php/Index/Rank/index">排行榜</a></li>
					<li><a href="/music/index.php/Index/Classify/index">分类</a></li>
					<li><a href="/music/index.php/Index/Excellent/index">精选</a></li>
					<li><a href="/music/index.php/Index/buyindex/index">商城</a></li>
					<li><a href="/music/index.php/Index/Good/index">好歌</a></li>
					<li><a href="">推荐</a></li>
				</ul>
				<!-- 导航右边的内容 -->
				<ul class="ul-b">	
				    <!-- <img src="./public/img/dh.png"> -->
					<li><a href="">VIP中心</a></li>
					<li><a href="/music/index.php/Index/Kefu/index">客服中心</a></li>
					<li><a href="">产品中心</a></li>
				</ul>
			</div>
		</div>
	</div>

	<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/titindentsindex.css" type="text/css">

	<!-- 购物车信息-->
	<div id="gwchbanner">
		<div id="gwcbanner1">
			<img src="<?php echo C('T_URL');?>/images/buyimages/gouwuche1.png"/>
		</div>
		<div id="gwchbanner2">
			<span>我的购物车</span>
		</div>
		<!--购物车信息 -->
		<div id="gwchbanner3">
			<div id="gwchbanner3-top">
				<table style="text-align:center">
					<tr>
						<td width='478' height='40'>商品名称</td>
						<td width='130' height='40'>单品价格</td>
						<td width='140' height='40'>购买数量</td>	   
						<td width='135' height='40'>小计</td>
						<td width='75' height='40'>操作</td>
					</tr>
				</table>				
			</div>
			<?php if($list == null): ?><div id="nobuy-div"><p id="nobuy-p">您的购物车还是空的，赶紧去买点吧！！</p></div>
				<div id="gwchbanner5">
					<a href="/music/index.php/Index/Buyindex/index"><input type="submit" class="gwchbanner5-buy-anniu" value="去购物"</button></a>
				</div>
			<?php else: ?>
			<!-- 遍历购物车 -->
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="gwchbanner3-bottom" name="<?php echo ($v["id"]); ?>">
			<!-- 需遍历的购物车信息 左侧图片部分-->
				<div class="gwchbanner3-bottom-left">
					<!-- 产品图片 -->
					<div class="gwchbanner3-bottom-left1" >
						<a href=""><img  width='160' height='160' src="<?php echo C('T_URL');?>/Uploads/<?php echo ($v["img"]); ?>" ></a>
					</div>
					<div class="gwchbanner3-bottom-left2">
						<!-- 购物车左侧颜色和型号 -->
						<table width=250 height=80 class="gwchbanner3-bottom-left2-table">
							<tr>
								<td width=250 height=26 colspan=2><?php echo ($v["name"]); ?></td>
							</tr>
							<tr>
								<td width=48 height=26>颜色:</td>
								<td width=202 height=26><?php if($v["gcolor"] == 1): ?>随机<?php elseif($v["gcolor"] == 2): ?>白色<?php else: ?> 黑色<?php endif; ?></td>
							</tr>
							<tr>
								<td width=48 height=26>型号:</td>
								<td width=202 height=26>基本</td>
							</tr>
						</table>
					</div>
				</div>
				<!-- 需遍历的购物车信息 右侧信息数量等部分-->
				<div class="gwchbanner3-bottom-right">
					<table width=440 height=40>
						<tr>
							<td width=94 height=40 class="gwchbanner3-bottom-right1" name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["nowprice"]); ?>"><?php echo ($v["nowprice"]); ?>元</td>
							<td width=140 height=40 >
								<div  class="gwchbanner3-bottom-right2">	
									<span class="gwchbanner3-bottom-right2-1" name="<?php echo ($v["id"]); ?>">-</span>
									<input type="text" value=<?php echo ($v["gnum"]); ?> class="gwchbanner3-bottom-right2-2" width="65" name="<?php echo ($v["id"]); ?>">
									<span class="gwchbanner3-bottom-right2-1" name="<?php echo ($v["id"]); ?>">+</span></td>	
								</div>
							</td>
							<td width=164 height=40 class="gwchbanner3-bottom-right3"><span class="gtotalmoney" name="<?php echo ($v["id"]); ?>" value=<?php echo ($v["gtotal"]); ?>><?php echo ($v["gtotal"]); ?></span></td>
							<td width=42 height=40><img src="<?php echo C('T_URL');?>/images/buyimages/gwchedel.png" value="<?php echo ($v["id"]); ?>" class="qudeleteanniu"></td>
						</tr>
					</table>
				</div>
			</div><?php endforeach; endif; ?>
		</div>
		<!-- 总价 -->
		<div id="gwchbanner4">
			<table width=960 height=120>
				<tr >
					<td height=120 id="gwchbanner4-p">商品共计:</td>
					<td height=120 width=320 id="gwchbanner4-tot">￥<?php echo ($ggt); ?>元</td>
				</tr>
			</table>
		</div>
		<div id="gwchbanner5">
			<button class="gwchbanner5-buy-anniu1" >去结账</button>
			<a href="/music/index.php/Index/Buyindex/index"><input type="submit" class="gwchbanner5-buy-anniu" value="继续购物"</button></a>
		</div><?php endif; ?>
	</div>
	<!-- 购物车信息结束 -->
	<!-- 服务信息开始 -->
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
				<li><a href="JavaScript:void(0)">酷狗2015官方免费下载</a></li>
			</ul>
		</div>
		<div class="foot-ti">
			<ul>
				<li>我们致力于推动网络正版音乐发展，相关版权合作请联系copyrights@kugou.com</li>
				<li>网络视听许可证1910564号 文网文[2010]175号 增值电信业务经营许可证粤B2-20060339&nbsp;&nbsp;<a href="JavaScript:void(0)">粤ICP备09017694号-2</a></li>
				<li>广州酷狗计算机科技有限公司 Copyright (C) 2004-2015 KuGou-Inc.All Rights Reserved </li>
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

<script type="text/javascript">	
	$(function(){
		// 定义空数组用来存储商品信息
			goodnum=new Array();
		// 产品数量加减特效
		$(".gwchbanner3-bottom-right2-1").click(function(){			
			// 存储当前点击订单的id
			tgid2=$(this).attr('name');
			// 获取当前订单商品的单价
			gprice=$(".gwchbanner3-bottom-right1[name="+tgid2+"]").attr("value");
			// alert(tgid2);
			switch($(this).html()){
				case '+':
				// 获取原来的值
				gnumvalu2=parseInt($(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value"));
				abb=gnumvalu2+1;
				$(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value",abb);

				if(abb>10){
					alert("亲，单笔下单最大量为10个哦");
					$(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value",10);
					abb=10;
				}

				// 将数量单价和商品订单id传到控制器里
				$.ajax({
					url:"/music/index.php/Index/Titindents/edit1",
					type:"POST",
					async:true,
					data:{"gid":tgid2,"gnum":abb,"gprice":gprice},
					success:
					function(data){
						// alert(data['all']);
						// 小订单总价插入
						$(".gtotalmoney[name="+tgid2+"]").html(data['tall']);
						// 购物车总价插入
						$("#gwchbanner4-tot").html("￥"+data['all']+"元");
					}
				});
				break;
				case '-':
				// 获取原来的值
				gnumvalu1=parseInt($(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value"));
				abb1=gnumvalu1-1;
				$(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value",abb1);

				if(abb1<=0){
					alert("亲，单笔下单最小为1个哦");
					$(".gwchbanner3-bottom-right2-2[name="+tgid2+"]").attr("value",1);
					abb1=1;
				}

				$.ajax({
					url:"/music/index.php/Index/Titindents/edit1",
					type:"POST",
					async:true,
					data:{"gid":tgid2,"gnum":abb1,"gprice":gprice},
					success:
					function(data){
						// 小订单总价插入
						$(".gtotalmoney[name="+tgid2+"]").html(data['tall']);
						// 购物车总价插入
						$("#gwchbanner4-tot").html("￥"+data['all']+"元");
					}
				});
				break;
			}
		});

		// 删除购物车内商品
		$(".qudeleteanniu").click(function(){
			// 要删除的商品id
			ddid=$(this).attr("value");
			// 获取要删除的总价
			gdtotal=parseInt($(".gtotalmoney[name="+ddid+"]").html());
			// alert(gdtotal);
			// 隐藏显示该商品的div
			$(".gwchbanner3-bottom[name="+ddid+']').css("display","none");

			// 删除数据库中数据
			$.ajax({
				url:"/music/index.php/Index/Titindents/del",
				type:"POST",
				async:true,
				dataType:"html",
				data:{"tid":ddid,"gtotal":gdtotal},
				success:
				function(data){
					// 将返回的购物车总价插入模板
					$("#gwchbanner4-tot").html("￥"+data+"元");
				}
			});
		});

		// 点击结账按钮进行传值修改
		$(".gwchbanner5-buy-anniu1").click(function(){
			// alert(goodnum['21']);
			$.ajax({
				url:"/music/index.php/Index/Titindents/edit",
				type:"GET",
				dataType:"html",
				async:true,
				success:
				function(data){
					
					if(data=='success'){
						window.location.href="/music/index.php/Index/Indents/add";
					}
				}
			});
		});
	});	
</script>