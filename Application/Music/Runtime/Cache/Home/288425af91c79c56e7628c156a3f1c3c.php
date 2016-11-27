<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>歌曲分类显示</title>
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
        <td width='5%' align='center'><button class='open'>+</button></td>
        <td  width='8%' align='center'><?php echo ($v["id"]); ?></td>
        <td><?php echo str_repeat('&nbsp;&nbsp;', $v['level']); if($v["level"] > 0): ?>|<?php endif; if($v["level"] != 1): ?><a href="<?php echo U('Home/Classify/song_list', array('id'=>$v['id']));?>"><?php echo ($v["html"]); echo ($v["name"]); ?></a><?php else: echo ($v["html"]); echo ($v["name"]); endif; ?></td>
        <td width='28%'>
          <a href="<?php echo U('Home/Classify/addChild', array('id' => $v['id']));?>" class='bt2'>添加子分类</a>
          <a href="<?php echo U('Home/Classify/edit', array('id' => $v['id']));?>" class='bt2'>修改</a>
          <a href="<?php echo U('Home/Classify/del', array('id' => $v['id']));?>" class='bt1 del'>删除</a>
        </td>
      </tr><?php endforeach; endif; ?>
  </table>
  <script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
  <script type="text/javascript">
  //toggle方法在1.9版本以后移除
    $(function () {
      
      //先将子类行隐藏
      $( 'tr[pid!=0]' ).hide();
      var i =false;   //状态变量
      //给+添加单击事件
      $(".open").click(function () {

        if (i === false) {    //若内容可见则隐藏
          var index = $( this ).parents('tr').attr('id');
          $( this ).html( '-' );
          $( 'tr[pid=' + index + ']' ).show();
          i = true;  //更改为相反的状态
        } else {
          var index = $( this ).parents('tr').attr('id');
          $( this ).html( '+' );
          $( 'tr[pid=' + index + ']' ).hide();    //反之则显示
          i = false;//更改为相反的状态
        }

      });
     
      //给删除链接添加单击事件
      $( '.del' ).click( function () {
        return confirm('确认删除该分类？');
      } );


    });
  </script>
</body>
</html>