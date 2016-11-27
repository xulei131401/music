<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" /> 
<link href="<?php echo C('T_URL');?>/assets/css/bootstrap.min.css" rel="stylesheet" />
<!---3.1版本-->
<link rel="stylesheet" href="<?php echo C('T_URL');?>/assets/css/font-awesome.min.css" />
<!--4.5.0版本-->
<link rel="stylesheet" href="<?php echo C('T_URL');?>/font/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/style.css"/>       
<link rel="stylesheet" href="<?php echo C('T_URL');?>/assets/css/ace.min.css" />
<link rel="stylesheet" href="<?php echo C('T_URL');?>/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link href="<?php echo C('T_URL');?>/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />   
<!--[if IE 7]>
<link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
<![endif]-->
<!--[if lte IE 8]>
<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
<![endif]-->
<script src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>   
<script src="<?php echo C('T_URL');?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo C('T_URL');?>/assets/js/typeahead-bs2.min.js"></script>
<!-- <script src="<?php echo C('T_URL');?>/assets/js/jquery.dataTables.bootstrap.js"></script> -->
<script type="text/javascript" src="<?php echo C('T_URL');?>/js/H-ui.js"></script> 
<script type="text/javascript" src="<?php echo C('T_URL');?>/js/H-ui.admin.js"></script> 
<script src="<?php echo C('T_URL');?>/assets/layer/layer.js" type="text/javascript" ></script>
<script src="<?php echo C('T_URL');?>/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo C('T_URL');?>/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
<script src="<?php echo C('T_URL');?>/js/lrtk.js" type="text/javascript" ></script>
<title>商品列表</title>
</head>
<body>
<div class=" page-content clearfix">
<form action="<?php echo U('Home/Category/addGoods');?>" method="post">
<input type="hidden" name="id" value="<?php echo ($good['id']); ?>">
 <div id="products_style">
    <table class="table table-striped table-bordered table-hover" id="sample-table">
    <thead>
     <tr>
      <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
      <th width="80px">商品编号</th>
      <th width="250px">商品名称</th>
      <th width="100px">原价格</th>
      <th width="100px">现价</th>
          <th width="100px">商品图片</th>       
          <th width="180px">加入时间</th>
          <th width="180px">商品描述</th>             
          <th width="180px">佩戴方式</th>             
          <th width="180px">承载功率</th>             
          <th width="180px">线长</th>             
          <th width="180px">重量</th>             
          <th width="180px">线控</th>             
          <th width="180px">上架</th>             
      <th width="180px">关注量</th>             
    </tr>
    </thead>
  <tbody>
  <?php if(is_array($goods_show)): $i = 0; $__LIST__ = $goods_show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td width="25px"><label><input type="checkbox" class="ace" name="check[]" value="<?php echo ($vo["id"]); ?>"><span class="lbl"></span></label></td>
        <td width="80px"><?php echo ($vo["id"]); ?></td>               
        <td width="250px"><u style="cursor:pointer" class="text-primary" onclick=""><?php echo ($vo["name"]); ?></u></td>
        <td width="100px"><?php echo ($vo["oldprice"]); ?></td>
        <td width="100px"><?php echo ($vo["nowprice"]); ?></td> 
        <td width="100px"><img src="/music/<?php echo ($vo["img"]); ?>" alt="" width="80px" height="80px"></td>         
        <td width="180px"><?php echo ($vo["regtime"]); ?></td>
        <td width="180px"><?php echo ($vo["desc"]); ?></td>
        <td width="180px"><?php echo ($vo["adorn"]); ?></td>
        <td width="180px"><?php echo ($vo["gonglv"]); ?></td>
        <td width="80px"><?php echo ($vo["linelength"]); ?></td>
        <td width="80px"><?php echo ($vo["weight"]); ?></td>
        <td width="80px"><?php echo ($vo["controline"]); ?></td>
        <?php if($vo['ison'] == 1): ?><td width="80px">上架</td>
          <?php else: ?>
          <td width="80px">不上架</td><?php endif; ?>
        <td width="80px"><?php echo ($vo["notinum"]); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
    </tbody>
    </table>
    <input type="submit" value="添加">
</form>
    <div align="center"><?php echo ($page); ?></div>
  </div>
 </div>
</body>
</html>
<script>
jQuery(function($) {
    var oTable1 = $('#sample-table').dataTable( {
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,2,3,4,5,8,9]}// 制定列不参与排序
    ] } );
        
        
        $('table th input:checkbox').on('click' , function(){
          var that = this;
          $(this).closest('table').find('tr > td:first-child input:checkbox')
          .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
          });
            
        });
      
    
      });
 laydate({
    elem: '#start',
    event: 'focus' 
});

</script>
<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()-215); 
$(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
  $(".widget-box").height($(window).height()-215);
   $(".table_menu_list").width($(window).width()-260);
    $(".table_menu_list").height($(window).height()-215);
  });
 
/*产品-停用*/
function member_stop(obj,id){
  layer.confirm('确认要停用吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="icon-ok bigger-120"></i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
    $(obj).remove();
    layer.msg('已停用!',{icon: 5,time:1000});
  });
}

/*产品-启用*/
function member_start(obj,id){
  layer.confirm('确认要启用吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="icon-ok bigger-120"></i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
    $(obj).remove();
    layer.msg('已启用!',{icon: 6,time:1000});
  });
}
/*产品-编辑*/
function member_edit(title,url,id,w,h){
  layer_show(title,url,w,h);
}

/*产品-删除*/
function member_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){
    $(obj).parents("tr").remove();
    layer.msg('已删除!',{icon:1,time:1000});
  });
}
</script>