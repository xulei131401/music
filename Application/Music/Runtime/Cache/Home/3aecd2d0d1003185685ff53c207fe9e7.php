<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>精选专辑列表页面</title>
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
 
  <tr>
    <td align="left" valign="top">
    
    <table style="table-layout: fixed;width:100%;" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">专辑编号</th>
        <th align="center" valign="middle" class="borderright">作者</th>
        <th align="center" valign="middle" class="borderright">区域名称</th>
        <th align="center" valign="middle" class="borderright">logo</th>
        <th align="center" valign="middle" class="borderright">描述</th>
        <th align="center" valign="middle" class="borderright">创建时间</th>
        <th align="center" valign="middle">操作</th>
      </tr>

	<?php if(is_array($exce_show)): $k = 0; $__LIST__ = $exce_show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"style="width:15%;"><?php echo ($vo["id"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"style="width:15%;"><?php echo ($vo["author"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"style="width:15%;"><a href="<?php echo U('Home/Excellent/song_list',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></td>
        <!-- 无法加载图片 -->
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($vo["pic"]); ?>" width="50px" height="50px"></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="overflow: hidden;height:50px;"><?php echo ($vo["desc"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom" style="width:15%;"><?php echo ($vo["ctime"]); ?></td>
        <td align="center" valign="middle" class="borderbottom" style="width:100px;"><a href="<?php echo U('Home/Excellent/excellentedit',array('id'=>$vo['id']));?>" target="_self" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="<?php echo U('Home/Excellent/excellentdel',array('id'=>$vo['id']));?>" target="_self" onFocus="this.blur()" class="add">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table></td>
    </tr>
  <tr>
    <td valign="top" align="center" colspan="3"style="letter-spacing:5px;"><?php echo ($page); ?></td>
  </tr>
</table>
</body>
</html>