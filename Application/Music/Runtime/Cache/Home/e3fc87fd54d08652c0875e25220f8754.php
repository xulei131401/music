<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改商品页面</title>
    <link href="<?php echo C('T_URL');?>/css/admin_cont_css.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo C('T_URL');?>/css/admin_cont_main.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo C('T_URL');?>/images/admin_cont/favicon.ico" />
    <script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
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
    <script type="text/javascript">
    //处理选中的分类
    $(function () {
        $('#a'+<?php echo ($id); ?>).attr('selected','selected');
    });
    </script>
</head>
<body>
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td align="left" valign="top">
    <form method="post" action="<?php echo U('Home/Goods/editHandle');?>" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'"> 
        <input type="hidden" name="id" value="<?php echo ($goods["id"]); ?>"/>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品名称：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="name" value="<?php echo ($goods["name"]); ?>" class="text-word">
        </td>
        </tr> 
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">原图：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
         <img src="/music/<?php echo ($goods["img"]); ?>" alt="图片" width="80px" height="80px">
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">新图：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="file" name="img">
        </td>
        </tr>  
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品简介：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
         <textarea name="desc" id="desc" cols="30" rows="10"><?php echo ($goods["desc"]); ?></textarea>
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">现价格：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="nowprice" value="<?php echo ($goods["nowprice"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">原价格：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="oldprice" value="<?php echo ($goods["oldprice"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">佩戴方式：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="adorn" value="<?php echo ($goods["adorn"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">频响范围：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="rate" value="<?php echo ($goods["rate"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">阻抗：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="interfacetype" value="<?php echo ($goods["interfacetype"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">灵敏度：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="sensitivity" value="<?php echo ($goods["sensitivity"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">最大承载功率：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="gonglv" value="<?php echo ($goods["gonglv"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">线长：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="linelength" value="<?php echo ($goods["linelength"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">重量：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="weight" value="<?php echo ($goods["weight"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">线型：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="linetype" value="<?php echo ($goods["linetype"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">音频接口：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="vointerface" value="<?php echo ($goods["vointerface"]); ?>" class="text-word">
        </td>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">耳机是否带线控：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="controline" value="<?php echo ($goods["controline"]); ?>" class="text-word">
        </td>
        </tr>
        </tr>  
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品所属分类</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
           <select name="category_id">
                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" id="a<?php echo ($vo["id"]); ?>"><?php echo str_repeat('&nbsp;&nbsp;', $vo['level']); if($vo["level"] > 0): ?>|<?php endif; echo ($vo["html"]); echo ($vo["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
           </select>
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">是否上架：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="radio" name="ison" value="1" <?php if($goods["ison"] == 1): ?>checked<?php endif; ?>/> 上架
        <input type="radio" name="ison" value="0" <?php if($goods["ison"] == 0): ?>checked<?php endif; ?>/> 不上架
        </td>
        </tr>  
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">关注度：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="notinum" value="<?php echo ($goods["notinum"]); ?>" class="text-word">
        </td>
        </tr>  
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but"/>
        <input name="" type="reset" value="重置" class="text-but"/></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>