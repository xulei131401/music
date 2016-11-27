<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/PIE_IE678.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="/music/Public/Home/css/H-ui.css"/>
<link type="text/css" rel="stylesheet" href="/music/Public/Home/css/H-ui.admin.css"/>
<link type="text/css" rel="stylesheet" href="/music/Public/Home/font/font-awesome.min.css"/>
<!--[if IE 7]>
<link href="font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>商品列表</title>
</head>
<body>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
 <!--    <a href="javascript:;" onClick="user_add('550','','添加用户','<?php echo U('Home/Goods/goodsAdd');?>')" class="btn btn-primary radius"><i class="icon-plus"></i> 添加商品</a></span> -->
    <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="80">商品ID</th>
        <th width="100">商品名</th>
        <th width="40">商品进货价格</th>
        <th width="90">商品图片</th>
        <th width="150">商品库存</th>
        <th width="80">商品出售价格</th>
        <th width="130">商品描述</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($goodsList)): foreach($goodsList as $k=>$goods): ?><tr class="text-c">
        <td><?php echo ($goods["id"]); ?></td>
        <td><u style="cursor:pointer" class="text-primary"><?php echo ($goods["goods_name"]); ?></u></td>
        <td><?php echo ($goods["goods_price"]); ?></td>
        <td><img src="<?php echo ($goods["goods_pic"]); ?>" alt="头像" width="125" height="100"></td>
        <td><?php echo ($goods["count"]); ?></td>
        <td class="text-l"><?php echo ($goods["store_price"]); ?></td>
        <td><?php echo ($goods["description"]); ?></td>
        <td class="f-14 user-manage"><a title="编辑商品"  href="<?php echo U('Home/Goods/goodsEdit',array('id'=>$goods['id']));?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a><a title="删除商品" href="<?php echo U('Home/Goods/goodsDelete',array('id'=>$goods['id']));?>"  class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
      </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
  <div class="pagination" align="center">
　　<?php echo ($page); ?>
  </div>
  <div id="pageNav" class="pageNav"></div>
</div>
<script type="text/javascript" src="/music/Public/Home/js/jquery.min.js"></script>
<script type="text/javascript" src="/music/Public/Home/layer/layer.min.js"></script>
<script type="text/javascript" src="/music/Public/Home/js/pagenav.cn.js"></script>
<script type="text/javascript" src="/music/Public/Home/js/H-ui.js"></script>
<script type="text/javascript" src="/music/Public/Home/plugin/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/music/Public/Home/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/music/Public/Home/js/H-ui.admin.js"></script>
</body>
</html>