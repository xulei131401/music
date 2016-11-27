<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
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
	<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：商品图片管理&nbsp;&nbsp;>&nbsp;&nbsp;商品图片列表</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
      <tr>
       <td width="90%" align="left" valign="middle">
           <form method="post" action="/music/index.php/Home/Goodspic/index">
           <span>商品ID：</span>
           <input type="text" name="gid" value="<?php echo ($_GET['gid']); ?>" class="text-word">
           <input name="" type="submit" value="查询" class="text-but">
           </form>
         </td>
        
      </tr>
  </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
    <tr>
      <th align="center" valign="middle" class="borderright">ID</th>
      <th align="center" valign="middle" class="borderright">商品ID</th>
      <th align="center" valign="middle" class="borderright">前台图</th>
      <th align="center" valign="middle" class="borderright">轮播图1</th>
      <th align="center" valign="middle" class="borderright">轮播图2</th>
      <th align="center" valign="middle" class="borderright">轮播图3</th>
      <th align="center" valign="middle" class="borderright">轮播图4</th>
      <th align="center" valign="middle" class="borderright">轮播图5</th>
      <th align="center" valign="middle" class="borderright">广告介绍图</th>
      <th align="center" valign="middle" class="borderright">操作</th>
    </tr>
    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["id"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["gid"]); ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imgindex"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imglb1"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imglb2"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imglb3"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imglb4"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imglb5"]); ?>" width='80' height='80'/></td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($v["imgad"]); ?>" width='80' height='80'/></td>
         <td align="center" valign="middle" class="borderbottom">
        <a href="/music/index.php/Home/Goodspic/edit/id/<?php echo ($v["id"]); ?>"  onFocus="this.blur()" class="add">修改</a>|<a href="/music/index.php/Home/Goodspic/del/id/<?php echo ($v["id"]); ?>"  onFocus="this.blur()" class="add" onclick="return confirm('你确定要删除吗?');" >删除</a>
        </td> 
       </tr><?php endforeach; endif; ?>
       <tr>
        <td colspan=10 align="center" valign="middle" class="borderright borderbottom"><?php echo ($pageinfo); ?></td>
       </tr>
      </table></td>
    </tr>
  
</table>
</body>
</html>