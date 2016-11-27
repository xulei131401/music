<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>客服中心</title>
	<link rel="shortcut icon" href="/music/Public/images/favico.ico">
	<link rel="stylesheet" type="text/css" href="/music/Public/css/index.css">
	<link rel="stylesheet" type="text/css" href="/music/Public/css/kefu1.css">
	<!-- <link rel="stylesheet" type="text/css" href="/music/Public/css/geren.css"> -->
<!-- 	<script type="text/javascript" src="/music/Public/js/index.js"></script> -->
	<script type="text/javascript" src="/music/Public/js/jquery-2.2.2.min.js"></script>   
</head>
<body>
	 <!-- 头部开始 -->
	<div id="header">
		<div id="top">
		    <!-- logo部分 -->
			<div class="top-left">
				<a href="/music/index.php/Index/Index/index"><img src="/music/Public/images/login/logo1.png"></a>
				<img src="/music/Public/images/login/logo2.png">
			</div>
			<!-- 注册登录部分 -->
			<div class="top-right">
			    <?php if($_SESSION['user'] == null): ?><div class="right-t">
				  <ul>
				    <li><a class="t-aa" href="/music/index.php/Index/Zhao/index"></a></li>
					<li><a href="/music/index.php/Index/Zhu/index">新用户注册</a></li>
					<li><span onclick="fun()">立即登录<span></li>
				  </ul>	
				</div>
				<?php else: ?>
				<div class="right-t1">
				  <ul>
				    <li><a class="t-aa" href="/music/index.php/Index/Zhao/index"></a></li>
					<li><?php if($_SESSION['user'][pic] == ''): ?><img src="/music/Public/images/user.png" width="40px" height="40px"><?php else: ?><img src="/music/<?php echo ($_SESSION['user'][pic]); ?>" width="40px" height="40px"><?php endif; ?></li>
					<li><a href="/music/index.php/Index/User/index/id/<?php echo ($_SESSION['user'][id]); ?>" style="color:#72CEF2;text-decoration: underline"><?php if($_SESSION['user']['username'] == ''): echo ($_SESSION['user']['email']); else: echo ($_SESSION['user']['username']); endif; ?></a></li>
					<li><a href="/music/index.php/Index/Kefu/logout">退出登陆</a></li>
					<li class="goods"><a href="/music/index.php/Index/Titindents/index" style="border:1px solid red"><img src="/music/Public/images/goods.png"></a></li>
				  </ul>	
				</div><?php endif; ?>
				<div id="login" style="display:none">
					<div class="login-top">
						<span>登陆酷狗</span>
						<img src="/music/Public/images/login/logo1.png">
					</div>
					<div class="login-c">
						<form action="/music/index.php/Index/Kefu/check" method="post">
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
							<input class="sub" type=image src="/music/Public/images/pic/login.png" name="sub1" onClick="javascript:testclick.submit();">	
						</form>
					</div>
					<div id="close"><img src="/music/Public/images/close.png"></div>
				</div>
				<!-- 网页播放器等部分 -->
				<div class="right-b">
					<div class="b-1">
						<img src="/music/Public/images/login/01.png">
						<a href="">网页播放器</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-2">
						<img src="/music/Public/images/login/02.png">
						<a href="">酷狗游戏</a>&nbsp;&nbsp;|
					</div>&nbsp;&nbsp;
					<div class="b-3">
						<img src="/music/Public/images/login/03.png">
						<a href="">下载客户端</a>
					</div>
				</div>
			</div>
		</div>
		<!-- 导航部分 -->
		<div id="dh">
			<div class="dh-l">
			<!-- 导航左边的内容 -->
				<ul class="ul-l">
					<li style="background:#80DBFF;font-size:12px"><a href="">酷狗音乐客服</a></li>
					
				</ul>
			</div>
		</div>

	</div>
	<!-- 客服中心导航 -->
		<div id="kefu">
			<ul>
				<li id="kl1" class="kl1">酷狗软件客服中心</li>
				<li id="kl2" class="kl2">酷狗商城客服中心</li>
				<li id="kl3" class="kl3">酷狗使用帮助</li>
				<li id="kl4" class="kl4">酷狗游戏客服中心</li>
			</ul>
		</div>
		<!-- 软件客服 -->
		<div id="ruan">
			<form action="/music/index.php/Index/Kefu/insert" method="post" enctype="multipart/form-data">
			    <input type="hidden" name="username" value="<?php echo ($_SESSION['user']['username']); ?>">
			    <input type="hidden" name="email" value="<?php echo ($_SESSION['user']['email']); ?>">
				<label>您的身份：</label><input type="radio" name="VIP" value="普通用户">&nbsp;<span class="sp1">普通用户</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="VIP" value="VIP用户">&nbsp;<span class="sp1">VIP用户(尊享绿色通道服务)</span><br><br>
				<label style="float:left">选择平台：</label><div id="ping1" class="ping1">电脑版</div><div id="ping2" class="ping2">安卓手机</div><div id="ping3" class="ping3">iPhone手机</div><br><br>
				<label>反馈内容：</label><textarea cols="50" rows="10" style="color:#ccc;" onblur="if(this.value == '')this.value='请详细描述您的问题';" onclick="if(this.value == '请详细描述您的问题')this.value='';" value="请详细描述您的问题" name="text"></textarea><br><br>
				<label style="vertical-align: top">上传截图：</label><input type="file" name="pic"><br><br>
				<label>联系方式：</label><input type="text" name="QQ" class="inp_key" style="color:#ccc;" onblur="if(this.value == '')this.value='请输入联系QQ';" onclick="if(this.value == '请输入联系QQ')this.value='';" value="请输入联系QQ">&nbsp;<span class="sp2">仅酷狗工作人员可见，请暂时取消加好友时的验证限制</span><br><br>
				<input class="sub" type=image src="/music/Public/images/pic/sub.png" name="sub1" onClick="javascript:testclick.submit();">
			</form>
			<div class="QQ">
				<p>联系酷狗产品客服QQ</p>
				<a href=""><img src="/music/Public/images/pic/QQ.png"></a>
			</div>
		</div>
		<!-- 商城客服 -->
		<div id="goods" style="display:none">
			<div class="goods-t"><span>自助服务</span></div>
			<div class="goods-c">
				<div class="goods-c-c">
					<div class="tr_img">
						<img src="/music/Public/images/pic/01.jpg">
					</div>
					<div class="tr_con1">
						<span><a href="">在线客服</a></span>
					</div>
					<div class="tr_cen">
						<p>周一至周五 9:30-18:30</p>
						<p>(仅受理订单相关咨询)</p>
					</div>
				</div>
				<div class="goods-c-c">
					<div class="tr_img">
						<img src="/music/Public/images/pic/02.jpg">
					</div>
					<span class="h1">400-626-0870</span>
					<div class="tr_cen">
						<p>周一至周五 9:30-18:30</p>
						<p>(仅受理订单相关咨询)</p>
					</div>
				</div>
				<div class="goods-c-c">
					<div class="tr_img">
						<img src="/music/Public/images/pic/03.jpg">
					</div>
					<span class="h2">投诉建议</span>
					<p>Service@kugou.com</p>
				</div>
				<div class="goods-c-c">
					<div class="tr_img">
						<img src="/music/Public/images/pic/04.jpg">
					</div>
					<span class="h2">真伪查询</span>
					<p>请刮开产品上的防伪标签获取防伪码</p>
				</div>
			</div>
		</div>
		<!-- 使用帮助 -->
		<div id="help" style="display:none">
			<div class="he-t">
				<div class="ttop"><span>常见问题Q&A</span></div>
				<ul>
					<a href="javascript:void(0)" onclick="show(this)">01、如何解绑安全邮箱和安全手机？</a>
					<li id="li" style="display:none">请进入酷狗官网www.kugou.com在右上角登陆后，进入“账户设置”-“账号安全”进行修改。若需要解绑安全邮箱或安全手机，暂时需要联系酷狗播放器客服解决。<div class="sq" onclick="hidet(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show1(this)">02、桌面歌词不显示怎么办？？</a>
					<li id="li1" style="display:none">
					<pre>1.检查酷狗客户端左上角“词”是否为开启状态</pre>
                    <pre>2.在“设置”→“歌词设置”中查看桌面歌词的透明度是否为100%。</pre>
                    <pre>3.在“主菜单”下拉列表中选择“皮肤与窗口调整”，然后点击“恢复窗口默认尺寸”。若仍然无法解决，请联系客服人员。</pre>
                    <div class="sq" onclick="hidet1(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show2(this)">03、如何去重重复歌曲？</a>
					<li id="li2" style="display:none">1.在本地列表空白处，点击右键，右键菜单中点击“歌曲体检工具”，即可使用歌曲去重功能。<div class="sq" onclick="hidet2(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show3(this)">04、如何使用定时停止播放歌曲功能？</a>
					<li id="li3" style="display:none">请选择酷狗音乐工具箱中的“定时设置”功能，然后点击“定时停止”，并设置定时停止播放的时间即可。<div class="sq" onclick="hidet3(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show4(this)">05、如何批量添加、删除歌曲？</a>
					<li id="li4" style="display:none">请选中您要添加或者删除的歌曲，点击右键，选择添加歌曲或者删除即可。<div class="sq" onclick="hidet4(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show5(this)">06、打开播放器，如何继续上次播放歌曲的进度？</a>
					<li id="li5" style="display:none">请在“主菜单”下拉列表下选择“设置”，将“常规设置”中的自动播放歌曲选项选定即可。<div class="sq" onclick="hidet5(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show6(this)">07、MV画面无法显示怎么办？</a>
					<li id="li6" style="display:none">
					<pre>1.查看当前网络状态，如果有比较占网络的游戏或者网页建议先关闭后刷新尝试；</pre>
                    <pre>2.更新adobe flash player；</pre>
                    <pre>3.将客户端酷狗“设置”-“音频设置”-“视频渲染”选择更改为“EVR渲染器”。若仍然无法解决，请联系客服人员。</pre><div class="sq" onclick="hidet6(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show7(this)">08、忘记密码怎么办？</a>
					<li id="li7" style="display:none">
					<pre>第一种：通过安全邮箱找回；根据注册时填写的安全信息，按照页面提示填写，提交后登录邮箱进行密码重置。</pre>
                    <pre>第二种：通过安全手机找回；根据注册时填写的安全信息，按照页面提示填写，提交后查收验证码进行密码重置。</pre>
                    <pre>第三种：通过设置安全问题找回；点击“安全问题找回”，输入答案与验证码，点击“提交”，按页面提示重置密码即可。</pre>
                    <pre>第四种：通过在线申诉流程找回密码。找回密码链接：http://www.kugou.com/newuc/user/retrievepwd </pre><div class="sq" onclick="hidet7(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show8(this)">09、VIP和音乐包支付方式都有哪些？</a>
					<li id="li8" style="display:none">目前支持的支付方式有：微信、网银、支付宝、财付通四种。充值时长有：一年、三个月、六个月、其他时长（该选项用户可自行选择需要的时长）。<div class="sq" onclick="hidet8(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show9(this)">10、为何充值后账号没有显示VIP标识？</a>
					<li id="li9" style="display:none">成功充值酷狗VIP后，请在播放器上重新登陆账号，若仍没有点亮请尝试对酷狗播放器进行更新，或等待30分钟后再次登录查询。如问题仍未解决，请提供充值订单号联系酷狗播放器客服。<div class="sq" onclick="hidet9(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show10(this)">11、VIP到期后网络收藏中的歌曲是否会消失？</a>
					<li id="li10" style="display:none">网络收藏歌曲是不会消失的，只是不能再添加歌曲进去，只能选择删除歌曲，一直到网络收藏空间降到5G为止。（7535以后版本的用户则是降到1000首歌曲为止。） <div class="sq" onclick="hidet10(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show11(this)">12、VIP用户为何不能下载无损或者高品音乐？</a>
					<li id="li11" style="display:none">并不是所有的歌曲都有无损或者高品音质的，搜索后歌曲后带有HQ或SQ标志的，才有其他音质选择，否则都是标准音质<div class="sq" onclick="hidet11(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show12(this)">13、如何上传原创歌曲？</a>
					<li id="li12" style="display:none">进入酷狗官网www.kugou.com选择“酷狗音乐人”，点击“加入酷狗音乐人”进行注册，并提交相关资料审核<div class="sq" onclick="hidet12(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show13(this)">14、如何上传非原创歌曲？</a>
					<li id="li13" style="display:none">
					<pre>1.将歌曲添加入本地列表；</pre>
                    <pre>2.登陆酷狗后，把歌曲添加入网络收藏（或我的收藏）待服务器检测资源上传；</pre>
                    <pre>3.添加后不要立即删除电脑本地源文件，服务器需要3-5天时间进行信息更新。</pre><div class="sq" onclick="hidet13(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show14(this)">15、如何上传歌词？</a>
					<li id="li14" style="display:none">鼠标点击歌词，在工具栏中选中“制作歌曲”，根据页面提示步骤操作。 <div class="sq" onclick="hidet14(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show15(this)">16、为何上传的歌词不能搜索？</a>
					<li id="li15" style="display:none">歌词上传不会立即显示，会先通过服务器检测是否包含敏感字词，广告，不良信息等。如果部分内容服务器无法判别，将转交人工审批。<div class="sq" onclick="hidet15(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show16(this)">17、第三方账号登录酷狗白屏怎么办？</a>
					<li id="li16" style="display:none">可查询该贴吧内容进行修复，如修复无效请联系客服。 http://tieba.baidu.com/p/3376903325?pid=59503617627&cid=0#59503617627 <div class="sq" onclick="hidet16(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show17(this)">18、如何更改热键？</a>
					<li id="li17" style="display:none">您可以在右键中选择“设置”，进入“热键设置”，从而更改您的热键即可。<div class="sq" onclick="hidet17(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show18(this)">19、如何更改歌曲播放模式？</a>
					<li id="li18" style="display:none">请在右键中选择“播放模式”从而进行更改。播放模式有五种选择，分别为单曲播放，单曲循环，顺序播放，列表循环，随机播放。<div class="sq" onclick="hidet18(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show19(this)">20、如何查看PC酷狗版本？</a>
					<li id="li19" style="display:none">您可以在“主菜单”下拉列表中选择“帮助与意见反馈”选项，然后选择“关于酷狗”就能看到酷狗的版本号。<div class="sq" onclick="hidet19(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show20(this)">21、锁定歌词后如何解锁？</a>
					<li id="li20" style="display:none">您可以在通知栏中右键点击酷狗图标，在出现的菜单中选择“解锁歌词”；或者将鼠标停留在桌面歌词面板所在区域，点击面板上出现的解锁图标即可。<div class="sq" onclick="hidet20(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show21(this)">22、乐库打不开如何解决？</a>
					<li id="li21" style="display:none">
					<pre>1.检查是否使用网络代理。方法：打开浏览器→点击设置（齿轮状图标）→选“Internet选择”→选“连接”第二个设置。查看内部是否填写了内容，如果</pre>
					<pre>有选择网络代理，尝试取消勾选。</pre>
                    <pre>2.尝试关闭防火墙，查看杀毒软件是否有截取酷狗信息。例如电脑管家的流量控制，360的流量控制等。</pre>
                    <pre>3.如果乐库不断自我刷新，建议客户把酷狗完全退出后，更新adobe flash player后重新打开酷狗。adobe flash player网站：http://get.ad</pre>
                    <pre>obe.com/cn/flashplayer/，若仍然无法解决，请联系客服人员。</pre><div class="sq" onclick="hidet21(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show22(this)">23、关于版权歌曲的问题</a>
					<li id="li22" style="display:none">酷狗歌曲分为“有版权”和“无版权”两大类。 有版权歌曲有“收费”和“免费”：免费歌曲提供免费试听和下载；收费歌曲分为单曲收费和专辑收费，其中单曲收费基本为试听免费、下载收费，专辑收费则需要购买整个专辑才能试听和下载专辑里的歌曲。 无版权歌曲不提供试听和下载。<div class="sq" onclick="hidet22(this)">↑收起</div> </li>
					
				</ul>
				<ul>
					<a href="javascript:void(0)" onclick="show23(this)">24、咨询繁星酷狗直播、酷狗ktv相关信息？</a>
					<li id="li23" style="display:none">由于业务发展扩充，酷狗繁星、ktv客服QQ合并更改为：800057627，若需咨询繁星直播及酷狗ktv问题可联系此QQ。<div class="sq" onclick="hidet23(this)">↑收起</div> </li>
					
				</ul>
				
			</div>
		</div>

<script type="text/javascript">
    var ping1=document.getElementById("ping1");
    var ping2=document.getElementById("ping2");
    var ping3=document.getElementById("ping3");
    ping1.style.backgroundColor="#E6F8FF";
    ping1.style.fontWeight="700";
    ping1.style.borderColor="#80DBFF";
    ping1.onclick=function(){
    	ping1.style.backgroundColor="#E6F8FF";
        ping1.style.fontWeight="700";
        ping1.style.borderColor="#80DBFF";
        ping2.style.backgroundColor="white";
        ping2.style.fontWeight="500";
        ping2.style.borderColor="black";
        ping3.style.backgroundColor="white";
        ping3.style.fontWeight="500";
        ping3.style.borderColor="black";
    }
     ping2.onclick=function(){
    	ping2.style.backgroundColor="#E6F8FF";
        ping2.style.fontWeight="700";
        ping2.style.borderColor="#80DBFF";
        ping1.style.backgroundColor="white";
        ping1.style.fontWeight="500";
        ping1.style.borderColor="black";
        ping3.style.backgroundColor="white";
        ping3.style.fontWeight="500";
        ping3.style.borderColor="black";
    }
     ping3.onclick=function(){
    	ping3.style.backgroundColor="#E6F8FF";
        ping3.style.fontWeight="700";
        ping3.style.borderColor="#80DBFF";
        ping2.style.backgroundColor="white";
        ping2.style.fontWeight="500";
        ping2.style.borderColor="black";
        ping1.style.backgroundColor="white";
        ping1.style.fontWeight="500";
        ping1.style.borderColor="black";
    }

	var kl1=document.getElementById("kl1");
	var kl2=document.getElementById("kl2");
	var kl3=document.getElementById("kl3");
	var kl4=document.getElementById("kl4");
	var ruan=document.getElementById("ruan");
	var goods=document.getElementById("goods");
	var help=document.getElementById("help");
	kl1.style.backgroundColor="#3399FF";
	kl1.style.color="white";
	kl1.onclick=function(){
		kl1.style.backgroundColor="#3399FF";
	    kl1.style.color="white";
	    ruan.style.display="block";
	    kl2.style.backgroundColor="#F3F3F3";
	    kl2.style.border="1px 0px 1px 0px";
	    kl2.style.color="black";
	    goods.style.display="none";
	    kl3.style.backgroundColor="#F3F3F3";
	    kl3.style.border="1px 0px 1px 1px";
	    kl3.style.color="black";
	    help.style.display="none";
	    kl4.style.backgroundColor="#F3F3F3";
	    kl4.style.border="1px 1px 1px 1px";
	    kl4.style.color="black";
	}
	kl2.onclick=function(){
		kl2.style.backgroundColor="#3399FF";
	    kl2.style.color="white";
	    goods.style.display="block";
	    kl1.style.backgroundColor="#F3F3F3";
	    kl1.style.border="1px 0px 1px 1px";
	    kl1.style.color="black";
	    ruan.style.display="none";
	    kl3.style.backgroundColor="#F3F3F3";
	    kl3.style.border="1px 0px 1px 0px";
	    kl3.style.color="black";
	    help.style.display="none";
	    kl4.style.backgroundColor="#F3F3F3";
	    kl4.style.border="1px 1px 1px 1px";
	    kl4.style.color="black";
	}
		kl3.onclick=function(){
		kl3.style.backgroundColor="#3399FF";
	    kl3.style.color="white";
	    help.style.display="block";
	    kl1.style.backgroundColor="#F3F3F3";
	    kl1.style.border="1px 0px 1px 1px";
	    kl1.style.color="black";
	    ruan.style.display="none";
	    kl2.style.backgroundColor="#F3F3F3";
	    kl2.style.border="1px 0px 1px 1px";
	    kl2.style.color="black";
	    goods.style.display="none";
	    kl4.style.backgroundColor="#F3F3F3";
	    kl4.style.border="1px 1px 1px 0px";
	    kl4.style.color="black";
	}
</script>
<script type="text/javascript">
            function show(){
               var li=document.getElementById("li");
               li.style.display="block";
            }
            function hidet(){
            	var li=document.getElementById("li");
            	li.style.display="none";
            }
             function show1(){
               var li1=document.getElementById("li1");
               li1.style.display="block";
            }
            function hidet1(){
            	var li1=document.getElementById("li1");
            	li1.style.display="none";
            }
             function show2(){
               var li2=document.getElementById("li2");
               li2.style.display="block";
            }
            function hidet2(){
            	var li2=document.getElementById("li2");
            	li2.style.display="none";
            }
             function show3(){
               var li3=document.getElementById("li3");
               li3.style.display="block";
            }
            function hidet3(){
            	var li3=document.getElementById("li3");
            	li3.style.display="none";
            }
             function show4(){
               var li4=document.getElementById("li4");
               li4.style.display="block";
            }
            function hidet4(){
            	var li4=document.getElementById("li4");
            	li4.style.display="none";
            }
             function show5(){
               var li5=document.getElementById("li5");
               li5.style.display="block";
            }
            function hidet5(){
            	var li5=document.getElementById("li5");
            	li5.style.display="none";
            }
             function show6(){
               var li6=document.getElementById("li6");
               li6.style.display="block";
            }
            function hidet6(){
            	var li6=document.getElementById("li6");
            	li6.style.display="none";
            }
             function show7(){
               var li7=document.getElementById("li7");
               li7.style.display="block";
            }
            function hidet7(){
            	var li7=document.getElementById("li7");
            	li7.style.display="none";
            }
             function show8(){
               var li8=document.getElementById("li8");
               li8.style.display="block";
            }
            function hidet8(){
            	var li8=document.getElementById("li8");
            	li8.style.display="none";
            }
             function show9(){
               var li9=document.getElementById("li9");
               li9.style.display="block";
            }
            function hidet9(){
            	var li9=document.getElementById("li9");
            	li9.style.display="none";
            }
             function show10(){
               var li10=document.getElementById("li10");
               li10.style.display="block";
            }
            function hidet10(){
            	var li10=document.getElementById("li10");
            	li10.style.display="none";
            }
             function show11(){
               var li11=document.getElementById("li11");
               li11.style.display="block";
            }
            function hidet11(){
            	var li11=document.getElementById("li11");
            	li11.style.display="none";
            }
             function show12(){
               var li12=document.getElementById("li12");
               li12.style.display="block";
            }
            function hidet12(){
            	var li12=document.getElementById("li12");
            	li12.style.display="none";
            }
             function show13(){
               var li13=document.getElementById("li13");
               li13.style.display="block";
            }
            function hidet13(){
            	var li13=document.getElementById("li13");
            	li13.style.display="none";
            }
             function show14(){
               var li14=document.getElementById("li14");
               li14.style.display="block";
            }
            function hidet14(){
            	var li14=document.getElementById("li14");
            	li14.style.display="none";
            }
             function show15(){
               var li15=document.getElementById("li15");
               li15.style.display="block";
            }
            function hidet15(){
            	var li15=document.getElementById("li15");
            	li15.style.display="none";
            }
             function show16(){
               var li16=document.getElementById("li16");
               li16.style.display="block";
            }
            function hidet16(){
            	var li16=document.getElementById("li16");
            	li16.style.display="none";
            }
             function show17(){
               var li17=document.getElementById("li17");
               li17.style.display="block";
            }
            function hidet17(){
            	var li17=document.getElementById("li17");
            	li17.style.display="none";
            }
             function show18(){
               var li18=document.getElementById("li18");
               li18.style.display="block";
            }
            function hidet18(){
            	var li18=document.getElementById("li18");
            	li18.style.display="none";
            }
             function show19(){
               var li19=document.getElementById("li19");
               li19.style.display="block";
            }
            function hidet19(){
            	var li19=document.getElementById("li19");
            	li19.style.display="none";
            }
             function show20(){
               var li20=document.getElementById("li20");
               li20.style.display="block";
            }
            function hidet20(){
            	var li20=document.getElementById("li20");
            	li20.style.display="none";
            }
             function show21(){
               var li21=document.getElementById("li21");
               li21.style.display="block";
            }
            function hidet21(){
            	var li21=document.getElementById("li21");
            	li21.style.display="none";
            }
             function show22(){
               var li22=document.getElementById("li22");
               li22.style.display="block";
            }
            function hidet22(){
            	var li22=document.getElementById("li22");
            	li22.style.display="none";
            }
             function show23(){
               var li23=document.getElementById("li23");
               li23.style.display="block";
            }
            function hidet23(){
            	var li23=document.getElementById("li23");
            	li23.style.display="none";
            }
</script>