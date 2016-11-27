<?php if (!defined('THINK_PATH')) exit();?>    <!-- 引入头部文件 -->
    <!DOCTYPE html>
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

   <!--  <link rel="stylesheet" type="text/css" href="<?php echo C('T_URL');?>/css/bootstrap.min.css" />
    <script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.js"></script>
    <script type="text/javascript" src="<?php echo C('T_URL');?>/js/bootstrap.min.js"></script> -->
    <!-- 轮播部分 -->
	<div id="wrapper">
	   <!-- 轮播开始 -->
	   	<div id="myCarousel" class="carousel slide">
	    <!-- 轮播（Carousel）指标 -->
	    <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	        <li data-target="#myCarousel" data-slide-to="1"></li>
	        <li data-target="#myCarousel" data-slide-to="2"></li>
	        <li data-target="#myCarousel" data-slide-to="3"></li>
	    </ol>   
	    <!-- 轮播（Carousel）项目 -->
	    <div class="carousel-inner" data-ride="carousel" data-interval="3000" id="lunbo">
	        <div class="item active">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/01.jpg" alt="图1">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/02.jpg" alt="图2">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/03.jpg" alt="图3">
	        </div>
	        <div class="item">
	            <img src="<?php echo C('T_URL');?>/images/login/lunbo/04.jpg" alt="图4">
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
	   	<!--轮播结束-->
        <div class="and">
        	<a href="javascript:void(0)"><div class="dian" title="酷狗音乐盒2016官方免费下载"></div></a>
        	<a href="javascript:void(0)"><div class="andr" title="酷狗音乐盒2016官方免费下载"></div></a>
        	<a href="javascript:void(0)"><div class="iph" title="酷狗音乐盒2016官方免费下载"></div></a>
        	<a href="javascript:void(0)"><div class="ipa" title="酷狗音乐盒2016官方免费下载"></div></a>
        </div>
	</div>	
	<!-- 轮播的JS代码 -->
	
	<!-- 专辑部分 -->
	<div id="zhuanji">
	    <!-- 专辑歌曲部分 -->
	    <div class="ji-A">
	        <!-- 专辑头部部分 -->
			<div class="zhuan-top">
				<strong>最新专辑</strong>
				<div id="zui1" class="z-t" title="最新专辑">最新&nbsp;&nbsp;&nbsp;&nbsp;|</div>
				<div id="zui2" class="z-t" title="最热专辑">最热&nbsp;&nbsp;&nbsp;&nbsp;|</div>
				<div id="zui3" class="z-t" title="推荐榜">推荐榜</div>
				<div class="z-t-l">
					<a href="javascript:void(0)" class="fox" title="酷狗音乐盒2016官方免费下载"><strong>酷狗音乐盒2016官方免费下载</strong></a>
				    <a href="/music/index.php/Index/Classify/index" class="more" title="更多音乐推荐">更多</a>
				</div>
			</div>
			<!-- 最新 -->
			<div id="pp1" class="xin">
				<!-- 专辑开始 -->
				<div id="fp-1">
						<!-- 专辑图片 -->
						<?php if(is_array($gmdlist)): foreach($gmdlist as $key=>$pop): ?><ul>
							<li><a href="/music/index.php/Index/Excellent/songlist/id/<?php echo ($pop["id"]); ?>" title="<?php echo ($pop["name"]); ?>"><img src="/music/<?php echo ($pop["pic"]); ?>" title="<?php echo ($pop["name"]); ?>" width="80px" height="80px"></a>
							<strong><a href="/music/index.php/Index/Excellent/songlist/id/<?php echo ($pop["id"]); ?>" title="<?php echo ($pop["name"]); ?>"><?php echo ($pop["name"]); ?></a></strong>
							<span><?php echo ($pop["author"]); ?></span></li>
							
						</ul><?php endforeach; endif; ?>
				</div>
				
				<!-- 单曲部分 -->
				<div class="c-c-l">
				    <!-- 单曲导航 -->
					<strong><a href="" title="推荐单曲">推荐单曲</a></strong>
					<div id="sp1" class="sp" title="华语新歌">华语&nbsp;&nbsp;&nbsp;&nbsp;|</div>
					<div id="sp2" class="sp" title="欧美新歌">欧美&nbsp;&nbsp;&nbsp;&nbsp;|</div>
					<div id="sp3" class="sp" title="日韩新歌">日韩&nbsp;&nbsp;&nbsp;&nbsp;|</div>
					<div id="sp4" class="sp" title="蒙面歌王">蒙面歌王</div>
				</div>
				<!-- 酷狗飙升榜 -->
				<div id="gequ1" class="gequ">
					<div id="list1" class="gequlist">
					    <div id="uuu" class="ddf">
						    <?php if(is_array($list1)): $i = 0; $__LIST__ = array_slice($list1,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$v['id']));?>" title="<?php echo ($v["singer"]); ?> - <?php echo ($v["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($v["singer"]); ?> - <?php echo ($v["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="uuu1" class="ffd">
							<?php if(is_array($list2)): $i = 0; $__LIST__ = array_slice($list2,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$u['id']));?>" title="<?php echo ($u["singer"]); ?> - <?php echo ($u["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($u["singer"]); ?> - <?php echo ($u["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#uuu ul li:odd").css({"background-color":"white"});
                        $("#uuu ul li:even").css({"background-color":"#EFEFEF"});
                        $("#uuu1 ul li:odd").css({"background-color":"white"});
                        $("#uuu1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list2" style="display:none" class="gequlist">
					    <div id="uu" class="ddf">
						    <?php if(is_array($rt1)): $i = 0; $__LIST__ = $rt1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$a['id']));?>" title="<?php echo ($a["singer"]); ?> - <?php echo ($a["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($a["singer"]); ?> - <?php echo ($a["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="uu1" class="ffd">
							<?php if(is_array($rt2)): $i = 0; $__LIST__ = $rt2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$b['id']));?>" title="<?php echo ($b["singer"]); ?> - <?php echo ($b["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($b["singer"]); ?> - <?php echo ($b["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#uu ul li:odd").css({"background-color":"white"});
                        $("#uu ul li:even").css({"background-color":"#EFEFEF"});
                        $("#uu1 ul li:odd").css({"background-color":"white"});
                        $("#uu1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list3" style="display:none" class="gequlist">
						<div id="u" class="ddf">
						    <?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$c['id']));?>" title="<?php echo ($c["singer"]); ?> - <?php echo ($c["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($c["singer"]); ?> - <?php echo ($c["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="u1" class="ffd">
							<?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$d['id']));?>" title="<?php echo ($d["singer"]); ?> - <?php echo ($d["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($d["singer"]); ?> - <?php echo ($d["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#u ul li:odd").css({"background-color":"white"});
                        $("#u ul li:even").css({"background-color":"#EFEFEF"});
                        $("#u1 ul li:odd").css({"background-color":"white"});
                        $("#u1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
				</div>
				<!-- 欧美歌曲 -->
				<div id="gequ2" style="display:none" class="gequ">
					<div id="list4" class="gequlist">
						<div id="r" class="ddf">
						    <?php if(is_array($list2)): $i = 0; $__LIST__ = array_slice($list2,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ll): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$ll['id']));?>" title="<?php echo ($ll["singer"]); ?> - <?php echo ($ll["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($ll["singer"]); ?> - <?php echo ($ll["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="r1" class="ffd">
							<?php if(is_array($list2)): $i = 0; $__LIST__ = array_slice($list2,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yy): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$yy['id']));?>" title="<?php echo ($yy["singer"]); ?> - <?php echo ($yy["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($yy["singer"]); ?> - <?php echo ($yy["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#r ul li:odd").css({"background-color":"white"});
                        $("#r ul li:even").css({"background-color":"#EFEFEF"});
                        $("#r1 ul li:odd").css({"background-color":"white"});
                        $("#r1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list5" style="display:none" class="gequlist">
						<div id="t" class="ddf">
						    <?php if(is_array($list5)): $i = 0; $__LIST__ = array_slice($list5,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$vo['id']));?>" title="<?php echo ($vo["singer"]); ?> - <?php echo ($vo["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($vo["singer"]); ?> - <?php echo ($vo["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="t1" class="ffd">
							<?php if(is_array($vv)): $i = 0; $__LIST__ = array_slice($vv,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$vv['id']));?>" title="<?php echo ($vv["singer"]); ?> - <?php echo ($vv["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($vv["singer"]); ?> - <?php echo ($vv["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#t ul li:odd").css({"background-color":"white"});
                        $("#t ul li:even").css({"background-color":"#EFEFEF"});
                        $("#t1 ul li:odd").css({"background-color":"white"});
                        $("#t1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list6" style="display:none" class="gequlist">
						<div id="w" class="ddf">
						    <?php if(is_array($bb)): $i = 0; $__LIST__ = $bb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bb): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$bb['id']));?>" title="<?php echo ($bb["singer"]); ?> - <?php echo ($bb["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($bb["singer"]); ?> - <?php echo ($bb["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="w1" class="ffd">
							<?php if(is_array($bv)): $i = 0; $__LIST__ = $bv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bv): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$bv['id']));?>" title="<?php echo ($bv["singer"]); ?> - <?php echo ($bv["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($bv["singer"]); ?> - <?php echo ($bv["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#w ul li:odd").css({"background-color":"white"});
                        $("#w ul li:even").css({"background-color":"#EFEFEF"});
                        $("#w1 ul li:odd").css({"background-color":"white"});
                        $("#w1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
				</div>
				<!-- 日韩新歌 -->
				<div id="gequ3" style="display:none" class="gequ">
					<div id="list7" class="gequlist">
						<div id="q" class="ddf">
						    <?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rr): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$rr['id']));?>" title="<?php echo ($rr["singer"]); ?> - <?php echo ($rr["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($rr["singer"]); ?> - <?php echo ($rr["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="q1" class="ffd">
							<?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tr): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$tr['id']));?>" title="<?php echo ($tr["singer"]); ?> - <?php echo ($tr["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($tr["singer"]); ?> - <?php echo ($tr["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#q ul li:odd").css({"background-color":"white"});
                        $("#q ul li:even").css({"background-color":"#EFEFEF"});
                        $("#q1 ul li:odd").css({"background-color":"white"});
                        $("#q1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list8" style="display:none" class="gequlist">
						<div id="g" class="ddf">
						    <?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fr): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$fr['id']));?>" title="<?php echo ($fr["singer"]); ?> - <?php echo ($fr["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($fr["singer"]); ?> - <?php echo ($fr["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="g1" class="ffd">
							<?php if(is_array($list3)): $i = 0; $__LIST__ = array_slice($list3,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tf): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$tf['id']));?>" title="<?php echo ($tf["singer"]); ?> - <?php echo ($tf["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($tf["singer"]); ?> - <?php echo ($tf["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#g ul li:odd").css({"background-color":"white"});
                        $("#g ul li:even").css({"background-color":"#EFEFEF"});
                        $("#g1 ul li:odd").css({"background-color":"white"});
                        $("#g1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list9" style="display:none" class="gequlist">
						<div id="h" class="ddf">
						    <?php if(is_array($zz)): $i = 0; $__LIST__ = $zz;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zz): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$zz['id']));?>" title="<?php echo ($zz["singer"]); ?> - <?php echo ($zz["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($zz["singer"]); ?> - <?php echo ($zz["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="h1" class="ffd">
							<?php if(is_array($zt)): $i = 0; $__LIST__ = $zt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zt): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$zt['id']));?>" title="<?php echo ($zt["singer"]); ?> - <?php echo ($zt["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($zt["singer"]); ?> - <?php echo ($zt["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#h ul li:odd").css({"background-color":"white"});
                        $("#h ul li:even").css({"background-color":"#EFEFEF"});
                        $("#h1 ul li:odd").css({"background-color":"white"});
                        $("#h1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
				</div>
				<!-- 蒙面歌王 -->
				<div id="gequ4" style="display:none" class="gequ">
					<div id="list10" class="gequlist">
						<div id="i" class="ddf">
						    <?php if(is_array($list4)): $i = 0; $__LIST__ = array_slice($list4,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bg): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$bg['id']));?>" title="<?php echo ($bg["singer"]); ?> - <?php echo ($bg["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($bg["singer"]); ?> - <?php echo ($bg["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="i1" class="ffd">
							<?php if(is_array($list4)): $i = 0; $__LIST__ = array_slice($list4,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bm): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$bm['id']));?>" title="<?php echo ($bm["singer"]); ?> - <?php echo ($bm["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($bm["singer"]); ?> - <?php echo ($bm["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#i ul li:odd").css({"background-color":"white"});
                        $("#i ul li:even").css({"background-color":"#EFEFEF"});
                        $("#i1 ul li:odd").css({"background-color":"white"});
                        $("#i1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list11" style="display:none" class="gequlist">
						<div id="l" class="ddf">
						    <?php if(is_array($mu)): $i = 0; $__LIST__ = $mu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mu): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$mu['id']));?>" title="<?php echo ($mu["singer"]); ?> - <?php echo ($mu["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($mu["singer"]); ?> - <?php echo ($mu["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="l1" class="ffd">
							<?php if(is_array($mi)): $i = 0; $__LIST__ = $mi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mi): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$mi['id']));?>" title="<?php echo ($mi["singer"]); ?> - <?php echo ($mi["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($mi["singer"]); ?> - <?php echo ($mi["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#l ul li:odd").css({"background-color":"white"});
                        $("#l ul li:even").css({"background-color":"#EFEFEF"});
                        $("#l1 ul li:odd").css({"background-color":"white"});
                        $("#l1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="list12" style="display:none" class="gequlist">
						<div id="j" class="ddf">
						    <?php if(is_array($nn)): $i = 0; $__LIST__ = $nn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nn): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$nn['id']));?>" title="<?php echo ($nn["singer"]); ?> - <?php echo ($nn["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($nn["singer"]); ?> - <?php echo ($nn["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="j1" class="ffd">
							<?php if(is_array($nm)): $i = 0; $__LIST__ = $nm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nm): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$nm['id']));?>" title="<?php echo ($nm["singer"]); ?> - <?php echo ($nm["name"]); ?>" target="view_window">
								    <span class="getext"><?php echo ($nm["singer"]); ?> - <?php echo ($nm["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#j ul li:odd").css({"background-color":"white"});
                        $("#j ul li:even").css({"background-color":"#EFEFEF"});
                        $("#j1 ul li:odd").css({"background-color":"white"});
                        $("#j1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
				</div>
				<!-- 下面的按钮 全部播放 -->
				<div class="zhuanji-bu">
				    <div class="gequ-an">
						<div id="cur1" class="cur">1</div>
						<div id="cur2" class="cur">2</div>
						<div id="cur3" class="cur">3</div>
					</div>	
					<!-- <div class="gequ-l">
						<a href="" title="全部播放"><img src="<?php echo C('T_URL');?>/images/login/list.png"></a>
					</div> -->
			    </div>
			</div> 
			<!-- 最热 -->
			<div id="pp2" style="display:none" class="re">
				<!-- 专辑开始 -->
				<div id="fp-1">
						<!-- 专辑图片 -->
						<?php if(is_array($mdglist)): $i = 0; $__LIST__ = $mdglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ggp): $mod = ($i % 2 );++$i;?><ul>
							<li><a href="/music/index.php/Index/Excellent/songlist/id/<?php echo ($ggp["id"]); ?>" title="<?php echo ($ggp["name"]); ?>"><img src="/music/<?php echo ($ggp["pic"]); ?>" title="<?php echo ($ggp["name"]); ?>" width="80px" height="80px"></a>
							<strong><a href="/music/index.php/Index/Excellent/songlist/id/<?php echo ($ggp["id"]); ?>" title="<?php echo ($ggp["name"]); ?>"><?php echo ($ggp["name"]); ?></a></strong>
							<span><?php echo ($ggp["author"]); ?></span></li>
							
						</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<!-- 最热歌曲 -->
				<div id="gequr" class="gequ1">
					<div id="lista" class="gequlist">
						<div id="tt" class="ddf">
						    <?php if(is_array($list5)): $i = 0; $__LIST__ = array_slice($list5,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ee): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$ee['id']));?>" title="<?php echo ($ee["singer"]); ?> - <?php echo ($ee["name"]); ?>">
								    <span class="getext"><?php echo ($ee["singer"]); ?> - <?php echo ($ee["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="tt1" class="ffd">
							<?php if(is_array($list5)): $i = 0; $__LIST__ = array_slice($list5,5,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$er): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$er['id']));?>" title="<?php echo ($er["singer"]); ?> - <?php echo ($er["name"]); ?>">
								    <span class="getext"><?php echo ($er["singer"]); ?> - <?php echo ($er["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#tt ul li:odd").css({"background-color":"white"});
                        $("#tt ul li:even").css({"background-color":"#EFEFEF"});
                        $("#tt1 ul li:odd").css({"background-color":"white"});
                        $("#tt1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="listb" style="display:none" class="gequlist">
						<div id="gg" class="ddf">
						    <?php if(is_array($fs)): $i = 0; $__LIST__ = $fs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fs): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$fs['id']));?>" title="<?php echo ($fs["singer"]); ?> - <?php echo ($fs["name"]); ?>">
								    <span class="getext"><?php echo ($fs["singer"]); ?> - <?php echo ($fs["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="gg1" class="ffd">
							<?php if(is_array($sf)): $i = 0; $__LIST__ = $sf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sf): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$sf['id']));?>" title="<?php echo ($sf["singer"]); ?> - <?php echo ($sf["name"]); ?>">
								    <span class="getext"><?php echo ($sf["singer"]); ?> - <?php echo ($sf["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#gg ul li:odd").css({"background-color":"white"});
                        $("#gg ul li:even").css({"background-color":"#EFEFEF"});
                        $("#gg1 ul li:odd").css({"background-color":"white"});
                        $("#gg1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
					<div id="listc" style="display:none" class="gequlist">
						<div id="hh" class="ddf">
						    <?php if(is_array($ds)): $i = 0; $__LIST__ = $ds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ds): $mod = ($i % 2 );++$i;?><ul class="cler-f">
								<li class="ord"><a href="<?php echo U('Index/Audio/index',array('id'=>$ds['id']));?>" title="<?php echo ($ds["singer"]); ?> - <?php echo ($ds["name"]); ?>">
								    <span class="getext"><?php echo ($ds["singer"]); ?> - <?php echo ($ds["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div id="hh1" class="ffd">
							<?php if(is_array($sd)): $i = 0; $__LIST__ = $sd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sd): $mod = ($i % 2 );++$i;?><ul class="cler-r">
								<li><a href="<?php echo U('Index/Audio/index',array('id'=>$sd['id']));?>" title="<?php echo ($sd["singer"]); ?> - <?php echo ($sd["name"]); ?>">
								    <span class="getext"><?php echo ($sd["singer"]); ?> - <?php echo ($sd["name"]); ?></span>
									<span class="list" title="播放">播放</span>
								</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<script type="text/javascript">
                        $("#hh ul li:odd").css({"background-color":"white"});
                        $("#hh ul li:even").css({"background-color":"#EFEFEF"});
                        $("#hh1 ul li:odd").css({"background-color":"white"});
                        $("#hh1 ul li:even").css({"background-color":"#EFEFEF"});
					</script>
				</div>
				<!-- 下面的按钮 全部播放 -->
				<div class="zhuanji-buu">
				    <div class="gequ-ann">
						<div id="cura" class="cur">1</div>
						<div id="curb" class="cur">2</div>
						<div id="curc" class="cur">3</div>
					</div>	
					<!-- <div class="gequ-l">
						<a href="" title="全部播放"><img src="<?php echo C('T_URL');?>/images/login/list.png"></a>
					</div> -->
			    </div>
			</div> 
			<!-- 推荐榜 -->
			<div id="pp3" style="display:none" class="jian">
				<div class="left-l">
				    <div id="kl" class="tuijian-l">
				        <?php if(is_array($list6)): $m = 0; $__LIST__ = array_slice($list6,6,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cf): $mod = ($m % 2 );++$m;?><ul class="left-le">
							<a href="<?php echo U('Index/Audio/index',array('id'=>$cf['id']));?>" target="view_window"><li>
								<span class="numm"><?php echo ($m+1); ?></span>
								<span class="til" title="<?php echo ($cf["name"]); ?>"><?php echo ($cf["name"]); ?></span>
								<span class="per" title="<?php echo ($cf["singer"]); ?>"><?php echo ($cf["singer"]); ?></span><br><br>
								<i>审批文号:WB9714</i>
							</li></a>
							
						</ul><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div id="kl1" class="tuijian-r">	
					    <?php if(is_array($list6)): $m = 0; $__LIST__ = array_slice($list6,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fc): $mod = ($m % 2 );++$m;?><ul class="right-le">
							<a href="<?php echo U('Index/Audio/index',array('id'=>$fc['id']));?>" target="view_window"><li>
								<span class="numm"><?php echo ($m+1); ?></span>
								<span class="til" title="<?php echo ($fc["name"]); ?>"><?php echo ($fc["name"]); ?></span>
								<span class="per" title="<?php echo ($fc["singer"]); ?>"><?php echo ($fc["singer"]); ?></span><br><br>
								<i>审批文号:WB9714</i>
							</li></a>
							
						</ul><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<script type="text/javascript">
                        $("#kl ul li:odd").css({"background-color":"#EFEFEF"});
                        $("#kl ul li:even").css({"background-color":"white"});
                        $("#kl1 ul li:odd").css({"background-color":"#EFEFEF"});
                        $("#kl1 ul li:even").css({"background-color":"white"});
					</script>	
				</div>
			</div>
	    </div> 
	    <!-- 乐库部分 -->
	    <div class="ji-B">
	    	<div class="yueku">
		       <h4>乐库</h4>

		      <ul>
		       	<?php if(is_array($cate)): $key = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?><li>
		       			<?php if(is_array($v)): $k = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($vo['pid'] == 0): ?><span class="hov"><?php echo ($vo['name']); ?></span>
				       		<?php else: ?>
				       			<a href="<?php echo U('Index/Classify/index',array('id'=>$vo['id']));?>" title="<?php echo ($vo['name']); ?>"><?php echo ($vo['name']); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
 						<a href="<?php echo U('Index/Classify/index');?>" title="更多" class="more-m">更多</a>
 						</li><?php endforeach; endif; else: echo "" ;endif; ?>
		     </ul>
	       </div>
	   </div> 
	
	</div>
	<!-- 广告部分 -->
	<div id="guanggao">
		<a href="JavaScript:void(0)"><img src="<?php echo C('T_URL');?>/images/login/guang.jpg" width="960px" height="100px"></a>
	</div>
	<!-- 歌曲排行榜单 -->
	<div id="bang">
	    <!-- top10榜单 -->
		<div class="top10">
		    <!-- top10榜单头部 -->
		    <div class="top10-top">
			    <strong><a href="" title="热榜TOP10">热榜TOP10</a></strong>
				<div id="tp10a" class="tp10" title="最新Top100">最新&nbsp;&nbsp;&nbsp;&nbsp;|</div>
				<div id="tp10b" class="tp10" title="最热Top500">最热</div>
				<a href="/music/index.php/Index/Rank/index" class="more-o" title="更多音乐排行榜">更多</a>
			</div>	
			<!-- top10榜单列表 -->
			<!-- 最新top10 -->
			<div id="tl1" class="top10-list">
			    <?php if(is_array($list7)): $m = 0; $__LIST__ = array_slice($list7,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mv): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$mv['id']));?>" title="<?php echo ($mv["singer"]); ?> - <?php echo ($mv["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext"><?php echo ($mv["singer"]); ?> - <?php echo ($mv["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 最热top10 -->
			<div id="tl2" class="top10-list" style="display:none">
				<?php if(is_array($list8)): $m = 0; $__LIST__ = array_slice($list8,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gv): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$gv['id']));?>" title="<?php echo ($gv["singer"]); ?> - <?php echo ($gv["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext"><?php echo ($gv["singer"]); ?> - <?php echo ($gv["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 全部播放按钮 -->
			<!-- <div class="top10-an">
				<a href="" title="全部播放"><img src="<?php echo C('T_URL');?>/images/login/list.png"></a>
			</div> -->
		</div>
		<!-- 全球热榜开始 -->
        <div class="worldtop">
        	<!-- 全球热榜头部 -->
        	<div class="worldtop-top">
        		<strong><a href="" title="全球热榜">全球热榜</a></strong>
				<div id="wt1" class="wt-t" title="香港RTHK电台榜">华语&nbsp;&nbsp;|</div>
				<div id="wt2" class="wt-t" title="台湾Hito榜">香港&nbsp;&nbsp;|</div>
				<div id="wt3" class="wt-t" title="英国单曲榜">日韩&nbsp;&nbsp;|</div>
				<div id="wt4" class="wt-t" title="美国BillBoard榜">欧美</div>
				<a href="/music/index.php/Index/Rank/index" class="more-e" title="更多音乐排行榜">更多</a>
        	</div>
        	<!-- 全球热榜歌曲列表 -->
        	<!-- 华语排行榜歌曲 -->
        	<div id="wor1" class="worldtop-list">
        		<?php if(is_array($list9)): $m = 0; $__LIST__ = array_slice($list9,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xx): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$xx['id']));?>" title="<?php echo ($xx["singer"]); ?> - <?php echo ($xx["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext"><?php echo ($xx["singer"]); ?> - <?php echo ($xx["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
        	</div>
        	<!-- 香港排行榜歌曲 -->
        	<div id="wor2" class="worldtop-list" style="display:none">
        		<?php if(is_array($list10)): $m = 0; $__LIST__ = array_slice($list10,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oo): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$oo['id']));?>" title="【华语】<?php echo ($oo["singer"]); ?> - <?php echo ($oo["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext">【华语】<?php echo ($oo["singer"]); ?> - <?php echo ($oo["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
        	</div>
        	<!-- 日韩排行榜歌曲 -->
        	<div id="wor3" class="worldtop-list" style="display:none">
        		<?php if(is_array($list11)): $m = 0; $__LIST__ = array_slice($list11,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xo): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$xo['id']));?>" title="<?php echo ($xo["singer"]); ?> - <?php echo ($xo["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext"><?php echo ($xo["singer"]); ?> - <?php echo ($xo["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
        	</div>
        	<!-- 欧美排行榜歌曲 -->
        	<div id="wor4" class="worldtop-list" style="display:none">
        		<?php if(is_array($list12)): $m = 0; $__LIST__ = array_slice($list12,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jo): $mod = ($m % 2 );++$m;?><ul>
					<li><a href="<?php echo U('Index/Audio/index',array('id'=>$jo['id']));?>" title="<?php echo ($jo["singer"]); ?> - <?php echo ($jo["name"]); ?>" target="view_window">
					        <span class="shu"><?php echo ($m+1); ?></span>
							<span class="t-list" title="播放">播放</span>
							<span class="t-getext"><?php echo ($jo["singer"]); ?> - <?php echo ($jo["name"]); ?></span>
					</a></li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
        	</div>
        	<!-- 全部播放按钮 -->
			<div class="worldtop-an">
				<a href="JavaScript:void(0)" title="全部播放"><img src="<?php echo C('T_URL');?>/images/login/list.png"></a>
			</div>
        </div>
        <!-- 抢先首发开始 -->
        <div class="first">
        	<h2 class="hl">抢先首发</h2>
        	<div class="first-img1">
        		<a href="JavaScript:void(0)" title="陈奕迅 《让我留在你身边》"><img src="<?php echo C('T_URL');?>/images/login/gequ/bb.jpg" title="孟文豪《我要醉在草原上》" width="230px" height="170px"></a>
        	</div>
        	<div class="first-img2">
        		<a href="JavaScript:void(0)" title="周杰伦《床边的故事》"><img src="<?php echo C('T_URL');?>/images/login/gequ/cc.jpg" title="嘉旗《出来走走》" width="230px" height="170px"></a>
        	</div>
        </div>
	</div>
	<!-- 广告部分 -->
	<div id="guanggao2">
		<a href="JavaScript:void(0)"><img src="<?php echo C('T_URL');?>/images/login/pa.jpg"></a>
		<a href="JavaScript:void(0)"><img src="<?php echo C('T_URL');?>/images/login/pe.jpg" width="250px" height="100px"></a>
	</div>
	<!-- 合作伙伴部分 -->
	<div id="hezuo">
		<div class="h-title">
			<a href="JavaScript:void(0)" title="合作伙伴"><strong>合作伙伴</strong></a>
		</div>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="h-img">
			<a href="JavaScript:void(0)" title="<?php echo ($v["linkname"]); ?>"><img src="/music/<?php echo ($v["linkpic"]); ?>" height="50px"></a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<!-- 友情链接 -->
	
	<div id="link">
		<div class="l-title">
			<a href="JavaScript:void(0)" title="友情链接"><strong>友情链接</strong></a>
		</div>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="l-cent">
			<a href="JavaScript:void(0)" title="<?php echo ($v["linkname"]); ?>"><?php echo ($v["linkname"]); ?></a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	

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