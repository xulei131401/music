<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>商品分类显示</title>
  <link rel="stylesheet" href="<?php echo C('T_URL');?>/css/public.css" />
  <style>
    .open {
      display: block;
      width: 16px;
      height: 16px;
      line-height: 16px;
      text-align: center;
      border: 1px solid #670768;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
  <script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript">
    $(function () {
      $( 'tr[pid!=0]' ).hide();

      $( '.open' ).toggle( function () {
        var index = $( this ).parents('tr').attr('id');
        $( this ).html( '-' );
        $( 'tr[pid=' + index + ']' ).show();
      }, function () {
        var index = $( this ).parents('tr').attr('id');
        $( this ).html( '+' );
        $( 'tr[pid=' + index + ']' ).hide();
      } );

      $( '.del' ).click( function () {
        return confirm('确认删除该分类？');
      } );
    });
  </script>
</head>
<body>
  <table class="table">
    <tr pid='0'>
      <th>展开</th>
      <th>ID</th>
      <th>分类名称</th>
      <th>操作</th>
    </tr>
    <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><tr id='<?php echo ($v["id"]); ?>' pid='<?php echo ($v["pid"]); ?>'>
        <td width='5%' align='center'><span class='open'>+</span></td>
        <td  width='8%' align='center'><?php echo ($v["id"]); ?></td>
        <td><?php echo str_repeat('&nbsp;&nbsp;', $v['level']); if($v["level"] > 0): ?>|<?php endif; if($v["level"] != 1): ?><a href="<?php echo U('Home/Category/goods_list', array('id'=>$v['id']));?>"><?php echo ($v["html"]); echo ($v["category_name"]); ?></a><?php else: echo ($v["html"]); echo ($v["category_name"]); endif; ?></td>
        <td width='28%'>
          <a href="<?php echo U('Home/Category/addChild', array('pid' => $v['id']));?>" class='bt2'>添加子分类</a>
          <a href="<?php echo U('Home/Category/edit', array('id' => $v['id']));?>" class='bt2'>修改</a>
          <a href="<?php echo U('Home/Category/del', array('id' => $v['id']));?>" class='bt1 del'>删除</a>
        </td>
      </tr><?php endforeach; endif; ?>
  </table>
</body>
</html>