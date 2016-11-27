<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站信息页面</title>
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
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">ID</th>
        <th align="center" valign="middle" class="borderright">网站标题</th>
        <th align="center" valign="middle" class="borderright">网站名称</th>
        <th align="center" valign="middle" class="borderright">网站关键字</th>
        <th align="center" valign="middle" class="borderright">网站logo</th>
        <th align="center" valign="middle" class="borderright">网站状态</th>
        <th align="center" valign="middle">操作</th>
      </tr>

      <?php if(is_array($web)): $i = 0; $__LIST__ = $web;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="bggray" onMouseOut="this.style.backgroundColor='#f9f9f9'" onMouseOver="this.style.backgroundColor='#edf5ff'">

        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["id"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["title"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["webname"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["keywords"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($vo["logo"]); ?>" width="60px" height="60px"></td>
        <?php if($vo['state'] == 1): ?><td align="center" valign="middle" class="borderright borderbottom">开启</td>
          <?php else: ?>
          <td align="center" valign="middle" class="borderright borderbottom">关闭</td><?php endif; ?>
        <td align="center" valign="middle" class="borderbottom"><a href="<?php echo U('Home/Web/edit',array('id'=>$vo['id']));?>" target="_self" onFocus="this.blur()" class="add">编辑</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table></td>
    </tr>
<!--   <tr>
    <td align="left" valign="top" class="fenye">11 条数据 1/1 页&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr> -->
</table>

</body>
</html>