<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品页面</title>
<link href="<?php echo C('T_URL');?>/css/css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo C('T_URL');?>/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/admin_cont/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(/music/Public/images/admin_cont/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(/music/Public/images/admin_cont/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(/music/Public/images/admin_cont/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(/music/Public/images/admin_cont/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
	<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">

  <tr>
    <td align="left" valign="top">
    <form method="post" action="<?php echo U('Home/Goods/addHandle');?>" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品名称：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="name" value="" class="text-word">
        </td>
        </tr> 
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品图片：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="file" name="img"  class="text-word"/>
        </td>
        </tr>   
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品简介：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品分类：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
           <select name="category_id">
             <option value="--请选择分类--" selected="selected">--请选择分类--</option>
             <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo str_repeat('&nbsp;&nbsp;', $vo['level']); if($vo["level"] > 0): ?>|<?php endif; echo ($vo["html"]); echo ($vo["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
           </select>
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">现价格：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="number" name="nowprice" value="" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">原价格：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="number" name="oldprice" value="" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">佩戴方式：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="adorn" value="默认:无此参数" class="text-word">
        </td>  
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">频响范围：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="rate" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">阻抗：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="interfacetype" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">灵敏度：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="sensitivity" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">最大承载功率：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="gonglv" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">线长：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="linelength" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">重量：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="weight" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">线型：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="linetype" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">音频接口：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="vointerface" value="默认:无此参数" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">耳机是否带线控：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="radio" name="controline" value="是"  checked> 是
        <input type="radio" name="controline" value="否" > 否
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">是否上架：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="radio" name="ison" value="1"  checked> 上架
        <input type="radio" name="ison" value="0" > 不上架
        </td>
        </tr>  
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>