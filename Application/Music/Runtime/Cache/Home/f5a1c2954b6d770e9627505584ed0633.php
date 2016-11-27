<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>歌曲信息列表</title>
<link href="/music/Public/css/admin_cont_css.css" type="text/css" rel="stylesheet" />
<link href="/music/Public/css/admin_cont_main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="/music/Public/images/admin_cont/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(/music/Public/images/admin_cont/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(/music/Public/images/admin_cont/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(/music/Public/images/admin_cont/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
 <!--  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">

	         <form action="/music/index.php/Home/Song/index" method="post">
	         <span>歌曲：</span>
	         <input type="text" name="name" value="" class="text-word">
              <input type="submit"value="查询"class="text-but">
	         <input name="" type="button" value="查询" class="text-but">
	         </form>

         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="/music/index.php/Home/Song/add" target="mainFrame" onFocus="this.blur()" class="add">新增歌曲</a></td>
  		</tr>
	</table>
    </td>
  </tr> -->
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">歌名</th>
        <th align="center" valign="middle" class="borderright">作者</th>
        <th align="center" valign="middle" class="borderright">专辑</th>
        <th align="center" valign="middle" class="borderright">播放次数</th>
        <th align="center" valign="middle" class="borderright">上传时间</th>
        <th align="center" valign="middle">操作</th>
      </tr>

      <?php if(is_array($song_show)): $i = 0; $__LIST__ = $song_show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 更改内容区域 -->
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:50px;height:50px;"><?php echo ($vo["id"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:110px;height:50px;"><?php echo ($vo["name"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:90px;height:50px;"><?php echo ($vo["singer"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:110px;height:50px;"><?php echo ($vo["volume"]); ?>0</td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:90px;height:50px;"><?php echo ($vo["playtimes"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow:hidden;width:90px;height:50px;"><?php echo ($vo["addtime"]); ?></td>
        
        <td align="center" valign="middle" class="borderbottom" style="width:100px;"><a href="<?php echo U('Home/Song/edit',array('id'=>$vo['id']));?>" target="_self" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="<?php echo U('Home/Song/delete',array('id'=>$vo['id']));?>" target="_self" onFocus="this.blur()" class="add">删除</a></td>
      </tr>
      <!-- 更改内容区域 --><?php endforeach; endif; else: echo "" ;endif; ?>

    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye" style="word-spacing:10px;text-align:center;"><?php echo ($page); ?></td>
  </tr>
</table>
</body>
</html>