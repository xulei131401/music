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
    <td width="99%" align="left" valign="top">您的位置：商品图片管理&nbsp;&nbsp;>&nbsp;&nbsp;修改商品图片<td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.html" target="mainFrame" onFocus="this.blur()" class="add"></a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="<?php echo U('Home/Goodspic/update');?>" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'"> 
        <input type="hidden" name="id" value="<?php echo ($ob["id"]); ?>"/> 
        <input type="hidden" name="oldimgindex" value="<?php echo ($ob["imgindex"]); ?>"/> 
        <input type="hidden" name="oldimglb1" value="<?php echo ($ob["imglb1"]); ?>"/> 
        <input type="hidden" name="oldimglb2" value="<?php echo ($ob["imglb2"]); ?>"/> 
        <input type="hidden" name="oldimglb3" value="<?php echo ($ob["imglb3"]); ?>"/> 
        <input type="hidden" name="oldimglb4" value="<?php echo ($ob["imglb4"]); ?>"/> 
        <input type="hidden" name="oldimglb5" value="<?php echo ($ob["imglb5"]); ?>"/> 
        <input type="hidden" name="oldimgad" value="<?php echo ($ob["imgad"]); ?>"/> 
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商城首页原图：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imgindex"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imgindex"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品轮播图1：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imglb1"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imglb1"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品轮播图2：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imglb2"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imglb2"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品轮播图3：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imglb3"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imglb3"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品轮播图4：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imglb4"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imglb4"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品轮播图5：</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imglb5"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imglb5"  class="text-word">
        </td>
        </tr>   
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">广告介绍图</td>
        <td align="center" valign="middle" class="borderright borderbottom"><img src="/music/<?php echo ($ob["imgad"]); ?>" width='80' height='80'/></td><td align="right" valign="middle" class="borderright borderbottom bggray">修改上传新图：</td>
        <td align="center" valign="middle" class="borderright borderbottom ">
        <input type="file" name="imgad"  class="text-word">
        </td>
        </tr>   
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but"/>
        <input name="" type="reset" value="重置" class="text-but"/>
        </td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>