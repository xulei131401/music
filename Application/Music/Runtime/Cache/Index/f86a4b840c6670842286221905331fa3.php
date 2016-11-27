<?php if (!defined('THINK_PATH')) exit();?>   	 <!DOCTYPE html>
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

	<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/goodsindex.css" type="text/css">

	<!-- 存储用户ID  商品ID 单价-->
	<input name="uid" type="hidden" value="<?php echo ($_SESSION['user']['id']); ?>">
	<input name="gprice" type="hidden" value="<?php echo ($list["nowprice"]); ?>">
	<input name="gid" type="hidden" value="<?php echo ($list["id"]); ?>">
	<input name="gname" type="hidden" value="<?php echo ($list["name"]); ?>">
	<!-- 可加入购物车成功后div移动 -->
	<div id="jiaruchengong">
		加入成功
	</div>
	<!-- 产品参数顶部信息 -->
	<div id="cpxqtop">
	<!-- 残品详情左侧轮播图 -->
		<div id="cpxqtop-left">	
			<image name="lunbo-pics" width="500" height="500" src="<?php echo C('T_URL');?>/Uploads/<?php echo ($lb["imglb1"]); ?>" style="display:block;" />
			<image name="lunbo-pics" width="500" height="500" src="<?php echo C('T_URL');?>/Uploads/<?php echo ($lb["imglb2"]); ?>" style="display:none;" />			
			<image name="lunbo-pics" width="500" height="500" src="<?php echo C('T_URL');?>/Uploads/<?php echo ($lb["imglb3"]); ?>" style="display:none;" />			
			<image name="lunbo-pics" width="500" height="500" src="<?php echo C('T_URL');?>/Uploads/<?php echo ($lb["imglb4"]); ?>" style="display:none;" />			
			<image name="lunbo-pics" width="500" height="500" src="<?php echo C('T_URL');?>/Uploads/<?php echo ($lb["imglb5"]); ?>" />	
			<div class="lunbo-anniu" name="lunbo-anniu" onclick="funn(0)"></div>
			<div class="lunbo-anniu" name="lunbo-anniu" onclick="funn(1)"></div>
			<div class="lunbo-anniu" name="lunbo-anniu" onclick="funn(2)"></div>
			<div class="lunbo-anniu" name="lunbo-anniu" onclick="funn(3)"></div>
			<div class="lunbo-anniu" name="lunbo-anniu" onclick="funn(4)"></div>
		</div>

		<!-- 产品详情右侧购买信息 -->
		<div id="cpxqtop-right">
			<?php if($guanzhu == 1): ?><div id="yigzhu">已关注</div>
			<?php else: ?>
			<div id="addgzhu" value="<?php echo ($list["id"]); ?>">加关注</div><?php endif; ?>
			<h3 class="cpxqtop-right-title"><?php echo ($list["name"]); ?></h3><!-- 商品标题 -->
			<h4 style="color:#333; margin-top:5px;">关注度：<?php echo ($list["notinum"]); ?></h4>
			<p class="cpxqtop-right-description"><?php echo ($list["descri"]); ?></p>
			<div class="cpxq-price">
				<table class="cpxq-price-tot">
					<tr>
						<td  width="65" ><p class="cpxq-price-1">酷价</p></td>
						<td  width="366" class="cpxq-price-2"><b class="now-price" style="font-size:38px;color:#ff6600">￥<?php echo ($list["nowprice"]); ?>.00 &nbsp;</b><s class="old-price" style="font-size:22px;color:#C2A599">￥<?php echo ($list["oldprice"]); ?>.00</s></td>
					</tr>
				</table>
			</div>
			<div class="cpxq-color"><!-- 商品颜色 -->
				<table class="cpxq-color-tot">
					<tr>
						<td  width="65" ><p class="cpxq-price-1">颜色</p></td>
						<td  width="366" ><span class="cpxq-color-tot-2" name='color' value="1" >随机</span>
						<span class="cpxq-color-tot-2" name='color' value="2">纯白</span>
						<span class="cpxq-color-tot-2" name='color' value="3">纯黑</span></td>
					</tr>
				</table>
			</div>
			<div class="cpxq-color"><!-- 商品型号 -->
				<table class="cpxq-color-tot">
					<tr>
						<td  width="65" ><p class="cpxq-price-1" >型号</p></td>
						<td  width="366" ><span class="cpxq-type-2" name="type" value="1" style="border:3px solid #ff4a00">基本</span>
						<span class="cpxq-type-2" name="type" value="2">标准</span>
						<span class="cpxq-type-2" name="type" value="3">潮人</span></td>
					</tr>
				</table>
			</div>
			<div class="cpxq-color"><!-- 购买数量 -->
				<table class="cpxq-color-tot">
					<tr>
						<td  width="65" ><p class="cpxq-price-1">数量</p></td>
						<td  width="366" ><span class="cpxq-num" width="40">-</span>
						<input type="text" value=1 id="cpxq-num-insert" width="80">
						<span class="cpxq-num" width="40">+</span></td>
					</tr>
				</table>
			</div>

			<!-- 购买按钮 -->
			<div id="cpxq-buy">
				<button type="submit" id="cpxq-buy-anniu">立即购买</button>
				<button id="cpxq-buy-anniu1" name="jiarucar" >加入购物车</button>
			</div>
		</div>
	</div>

	<!-- 产品参数详细信息 -->
	<div id="cpxqbottom">
		<div id="cpxqbottom-top">
			<div id="cpxqbottom-top1" >产品介绍</div>
			<div id="cpxqbottom-top2" >规格参数</div>
			<div id="cpxqbottom-top3" >产品评价</div>
			<div id="cpxqbottom-top4"></div>
		</div>
		<div id="cpxqbottom-foot">
			<!-- 产品介绍 -->
			<div id="cpxqbottom-foot1" style="display: block;">
				<img src="<?php echo C('T_URL');?>/images/goodadd.png" style="" width="960">	
			</div>

			<!-- 规格参数 -->
			<div id="cpxqbottom-foot2" style="display:none;">
				<table id="cpxqbottom-table">
					<tr>
						<td class="canshuda" colspan="2">主 体</td>
					</tr>
					<tr>
						<td class="canshuleft"><p>品牌&nbsp;&nbsp;&nbsp;</p></td>
						<td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["name"]); ?></p></td></tr>
					<tr>
						<td class="canshuleft"><p>型号&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;Y10</p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>类型&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p><p>&nbsp;&nbsp;&nbsp;耳机</p></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>佩戴方式&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["adorn"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>颜色&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;棕/白/蓝</p></td>
					</tr>
					<tr class="firstRow">
						<td class="canshuda" colspan="2"><p>耳机规格&nbsp;&nbsp;&nbsp;</p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>频响范围&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["rate"]); ?></p></td></tr>
					<tr>
						<td class="canshuleft"><p>阻抗&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["impedance"]); ?></p></td></tr>
					<tr>
						<td class="canshuleft"><p>接口类型&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["interfacetype"]); ?></p></td></tr>
					<tr>
						<td class="canshuleft"><p>灵敏度&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["sensitivity"]); ?></p></td></tr>
					<tr>
						<td class="canshuleft"><p>最大承载功率&nbsp;&nbsp;&nbsp;</p></td><td  class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["gonglv"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>线长&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["linetype"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>重量&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["weight"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>线型&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["linetype"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>音频接口&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["cointerface"]); ?></p></td>
					</tr>
					<tr>
						<td class="canshuleft"><p>耳机/耳麦是否带线控&nbsp;&nbsp;&nbsp;</p></td><td class="canshuright"><p>&nbsp;&nbsp;&nbsp;<?php echo ($list["controline"]); ?></p></td>
					</tr>
				</table>
			</div>
			<!-- 产品评价 -->
			<div id="cpxqbottom-foot3" style="display:none;">
				<!-- 左侧点击div	 -->
				<div id="cpxqbottom-foot3-left">
					<div class="cpxqbottom-foot3-left-all" name="all" style="color:red; fontWeight:bolder; border:2px solid #cEcEBE;">
					全部评论
					</div>
					<div class="cpxqbottom-foot3-left-all" name="tou" style="margin-top:15px;">
						只看头评
					</div>
					<div class="cpxqbottom-foot3-left-all" name="zhui" style="margin-top:15px;">
						只看追评
					</div>
				</div>
				<!-- 右侧显示div -->
				<div id="cpxqbottom-foot3-right">
					<?php if($allp == ''): ?>小伙伴们都很懒！还没留下评价！！
					<?php else: ?>
					<!-- 全部评价 -->
					<div class="cpxqbottom-foot3-right-all" name="all">
						<?php if(is_array($allp)): foreach($allp as $key=>$aa): ?><div class="jutipingjia">
							<table >
								<!-- 判断是匿名与否 -->
								<?php if($aa["isopen"] == 0): ?><td width=60 height=60><img src="<?php echo C('T_URL');?>/images/user.png" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;">狗酷匿名用户</td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"> <?php echo (date("Y-m-d H:i:s",$aa["cmtime"])); ?></td>
								<?php else: ?>
								<tr>
									<td width=60 height=60><img src="/music/<?php echo ($aa["pic"]); ?>" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;"><?php echo ($aa["username"]); ?></td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"><?php echo (date("Y-m-d H:i:s",$aa["cmtime"])); ?></td>
								</tr><?php endif; ?>
								<tr>
									<td width=60 height=88 style="text-align:center;font-size:22px;color:red;"><?php if($aa["cmstatus"] == 1): ?>初评<?php else: ?>追评<?php endif; ?>:</td>
									<td width=550 height=88 colspan=3 ><div style="font-size:13px; overflow:hidden;"><?php echo ($aa["content"]); ?></div></td>
								</tr>
							</table>
						</div><?php endforeach; endif; ?>
						<!-- 分页 -->
						<div class="pingjiafen"><?php echo ($pageinfo); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</div >
					<!-- 头评 -->
					<div class="cpxqbottom-foot3-right-all" name="tou" style="display:none;">
						<?php if(is_array($chup)): foreach($chup as $key=>$bb): ?><div class="jutipingjia">
							<table >
								<!-- 判断是匿名与否 -->
								<?php if($bb["isopen"] == 0): ?><td width=60 height=60><img src="<?php echo C('T_URL');?>/images/user.png" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;">狗酷匿名用户</td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"> <?php echo (date("Y-m-d H:i:s",$bb["cmtime"])); ?></td>
								<?php else: ?>
								<tr>
									<td width=60 height=60><img src="/music/<?php echo ($bb["pic"]); ?>" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;"><?php echo ($bb["username"]); ?></td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"><?php echo (date("Y-m-d H:i:s",$bb["cmtime"])); ?></td>
								</tr><?php endif; ?>
								<tr>
									<td width=60 height=88 style="text-align:center;font-size:22px;color:red;">初评:</td>
									<td width=550 height=88 colspan=3 ><div style="font-size:13px; overflow:hidden;"><?php echo ($bb["content"]); ?></div></td>
								</tr>
							</table>
						</div><?php endforeach; endif; ?>
						<!-- 分页 -->
						<div class="pingjiafen"><?php echo ($pageinfo1); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</div>
					<!-- 追平 -->
					<div class="cpxqbottom-foot3-right-all" name="zhui" style="display:none;"> 
						<?php if(is_array($zhuip)): foreach($zhuip as $key=>$cc): ?><div class="jutipingjia">
							<table >
								<!-- 判断是匿名与否 -->
								<?php if($cc["isopen"] == 0): ?><td width=60 height=60><img src="<?php echo C('T_URL');?>/images/user.png" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;">狗酷匿名用户</td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"> <?php echo (date("Y-m-d H:i:s",$cc["cmtime"])); ?></td>
								<?php else: ?>
								<tr>
									<td width=60 height=60><img src="/music/<?php echo ($cc["pic"]); ?>" width=60 height=60></td>
									<td width=20 height=60></td>
									<td width=190 height=60 style="textalign:left; font-weight:bolder; font-size:20px; color:#3980F4;"><?php echo ($cc["username"]); ?></td>
									
									<td width=340 height=60 style="  font-size:16px;color:#3980F4;"><?php echo (date("Y-m-d H:i:s",$cc["cmtime"])); ?></td>
								</tr><?php endif; ?>
								<tr>
									<td width=60 height=88 style="text-align:center;font-size:22px;color:red;">追评:</td>
									<td width=550 height=88 colspan=3 ><div style="font-size:13px; overflow:hidden;"><?php echo ($cc["content"]); ?></div></td>
								</tr>
							</table>
						</div><?php endforeach; endif; ?>
						<!-- 分页 -->
						<div class="pingjiafen"><?php echo ($pageinfo2); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php endif; ?>
					</div>
				</div>
			</div>		
		</div>
	</div>

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

<script type="text/javascript">
	// 左上脚产品图片轮播特效
	// 获取图片
	imglist=document.getElementsByName("lunbo-pics");

	// // 获取按钮
	anniu=document.getElementsByName("lunbo-anniu");

	// 遍历按钮
	x=180;
	for(i=0;i<anniu.length;i++){
		anniu[i].style.left=x+"px";
		x+=28;
	}
	m=0;
	runpics();
	// 轮播函数
	function runpics(){
		if(m==imglist.length){
			m=0;
		}
		showpics();
		m++;
		mytime=setTimeout(runpics,2000);
	}

	// 展示图片函数
	function showpics(){
		for(j=0;j<imglist.length;j++){
			if(j==m){
				imglist[j].style.display="block";
				anniu[j].style.backgroundColor="#bebebe";
			}else{
				imglist[j].style.display="none";
				anniu[j].style.backgroundColor="white";
			}
		}
	}

	function funn(abab){
		clearTimeout(mytime);		
		m=abab;
		runpics();
	}

	$(function(){
		gcolor=0;
		gnum=1;		
		gtype=1;
		// 产品颜色选择特效
		$("span[name='color']").click(function(){
			$("span[name='color']").css("border","1px solid #666666");
			$(this).css('border','3px solid #ff4a00');
			// 存储选中商品颜色
			gcolor=$(this).attr("value");
		});
		// 产品型号选择特效
		$("span[name='type']").click(function(){
			$("span[name='type']").css("border","1px solid #666666");
			$(this).css('border','3px solid #ff4a00');
			// 存储选中商品型号
			gtype=$(this).attr("value");
		});

		// 产品数量加减特效
		$(".cpxq-num").click(function(){
			switch($(this).html()){
				case '+':
				ss=parseInt($("#cpxq-num-insert").attr("value"));
				b=ss+1;
				$("#cpxq-num-insert").attr("value",b);
				if(b>10){
					alert("亲，单笔下单最大量为10个哦");
					$("#cpxq-num-insert").attr("value",10);
					b=10;
				}
				gnum=b;
				break;
				case '-':
				smsm=parseInt($("#cpxq-num-insert").attr("value"));
				bm=smsm-1;
				$("#cpxq-num-insert").attr("value",bm);
				if(bm<=0){
					alert("亲，单笔下单量不可以为空!");
					$("#cpxq-num-insert").attr("value",1);
					bm=1;
				}
				gnum=bm;
				break;
			}
		});
		// 产品参数和规格参数的切换特效
		cpxqbottomfoot1=$("#cpxqbottom-foot1");
		cpxqbottomfoot2=$("#cpxqbottom-foot2");
		cpxqbottomfoot3=$("#cpxqbottom-foot3");
		$("#cpxqbottom-top1").click(function(){
			cpxqbottomfoot1.css('display','block');
			$("#cpxqbottom-top1").css({borderTop:'3px solid #008ad4',borderBottom:'0px'});
			cpxqbottomfoot2.css('display','none');
			$("#cpxqbottom-top2").css('border','1px solid #dadada');
			cpxqbottomfoot3.css('display','none');
			$("#cpxqbottom-top3").css('border','1px solid #dadada');
		});
		$("#cpxqbottom-top2").click(function(){
			cpxqbottomfoot2.css('display','block');
			$("#cpxqbottom-top2").css({borderTop:'3px solid #008ad4',borderBottom:'0px'});
			cpxqbottomfoot1.css('display','none');
			$("#cpxqbottom-top1").css('border','1px solid #dadada');
			cpxqbottomfoot3.css('display','none');
			$("#cpxqbottom-top3").css('border','1px solid #dadada');
		});
		$("#cpxqbottom-top3").click(function(){
			cpxqbottomfoot3.css('display','block');
			$("#cpxqbottom-top3").css({borderTop:'3px solid #008ad4',borderBottom:'0px'});
			cpxqbottomfoot1.css('display','none');
			$("#cpxqbottom-top1").css('border','1px solid #dadada');
			cpxqbottomfoot2.css('display','none');
			$("#cpxqbottom-top2").css('border','1px solid #dadada');
		});

		// 加入购物车和购买时先获取各个变量值
		uid=$("input[name='uid']").attr("value");
		gid=$("input[name='gid']").attr("value");
		gname=$("input[name='gname']").attr("value");
		gprice=$("input[name='gprice']").attr("value");

		// 加入购物车	
		$("#cpxq-buy-anniu1").click(function(){

		// 先判断用户是否登录
		if(uid==""){
			alert("请先登录");
			$("#login").css("display","block");
		}else if(gcolor==0){
			alert("亲请选择商品颜色");
		}else{
			$.ajax({
				url:"/music/index.php/Index/Titindents/insert",
				type:"POST",
				async:true,
				dataType:"html",
				data:{"gcolor":gcolor,"gnum":gnum,"gtype":gtype,"uid":uid,"gname":gname,"gid":gid,"gprice":gprice},
				success:
				function(data){
					
					// 加入成功后运行div移动到右上角
					jiaruchengong=document.getElementById("jiaruchengong");
					$("#jiaruchengong").css("display","block");
					
					// movetime=data;
					// 初始化小球位置
					startx=800;
					starty=500;
					jiaruchengong.style.left=startx+"px";
					jiaruchengong.style.top=starty+"px";
					// 设定移动速度
					xv=5;
					yv=8;
					movetime1=setInterval(function(){	
						startx+=xv;
						starty-=yv;

						if(starty<-30){
							// 清除移动定时器
							clearInterval(movetime1);
							$("#jiaruchengong").css("display","none");
						}

						jiaruchengong.style.left=startx+"px";
						jiaruchengong.style.top=starty+"px";
					},10);
				
					// 防止连续点击加入购物车，将颜色初始化
					gcolor=0;
				}
			});
		}
		});

		// 立即购买	
		$("#cpxq-buy-anniu").click(function(){
			// 先判断用户是否登录
			// 测试数据
			// uid=2;
			// gid=2;
			// gname="s333";
			// gprice=2222;
			if(uid==""){
				alert("请先登录");
				$("#login").css("display","block");
			}else if(gcolor==0){
				alert("亲请选择商品颜色");
			}else{
				$.ajax({
				url:"/music/index.php/Index/Titindents/add",
				type:"POST",
				async:true,
				dataType:"html",
				data:{"gcolor":gcolor,"gnum":gnum,"gtype":gtype,"uid":uid,"gname":gname,"gid":gid,"gprice":gprice},
				success:					
				function(data){
					window.location.href="/music/index.php/Index/Indents/add";
				}
				});
			}
		});

		// 产品评价特效
		$(".cpxqbottom-foot3-left-all").click(function(){
			// 或取名字
			aa=$(this).attr("name");
			$(".cpxqbottom-foot3-left-all").css({color:"white",fontWeight:"normal",border:"0px"});
			$(this).css({color:"red",fontWeight:"bolder",border:"2px solid #cEcEBE"});
			// 右侧全部隐藏再显示一个
			$(".cpxqbottom-foot3-right-all").css("display","none");
			$(".cpxqbottom-foot3-right-all[name="+aa+"]").css("display","block");
		});

		// 加关注
		$("#addgzhu").click(function(){
			gzid=$(this).attr("value");
	
			if(uid==""){
				alert("请先登录");
			$("#login").css("display","block");
			}else{					
				window.location.href="/music/index.php/Index/Notice/add/sgid/"+gzid;
			}
		});
	});
</script>