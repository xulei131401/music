<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="<?php echo C('T_URL');?>/assets/css/bootstrap.min.css" rel="stylesheet" />
        <!---3.1版本-->
        <link rel="stylesheet" href="<?php echo C('T_URL');?>/assets/css/font-awesome.min.css" />
        <!--4.5.0版本-->
        <link rel="stylesheet" href="<?php echo C('T_URL');?>/font/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo C('T_URL');?>/css/style.css"/>       
        <link href="<?php echo C('T_URL');?>/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo C('T_URL');?>/assets/css/ace.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="<?php echo C('T_URL');?>/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo C('T_URL');?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo C('T_URL');?>/Widget/Validform/5.3.2/Validform.min.js"></script>
		<script src="<?php echo C('T_URL');?>/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="<?php echo C('T_URL');?>/assets/js/jquery.dataTables.min.js"></script>
		<!-- <script src="<?php echo C('T_URL');?>/assets/js/jquery.dataTables.bootstrap.js"></script> -->
        <script src="<?php echo C('T_URL');?>/assets/layer/layer.js" type="text/javascript" ></script>          
		<script src="<?php echo C('T_URL');?>/js/lrtk.js" type="text/javascript" ></script>
         <script src="<?php echo C('T_URL');?>/assets/layer/layer.js" type="text/javascript"></script>	
        <script src="<?php echo C('T_URL');?>/assets/laydate/laydate.js" type="text/javascript"></script>
<title>友情链接列表</title>
</head>

<body>
<div class="page-content clearfix">
  <div class="administrator">
    <table class="table table-striped table-bordered table-hover" id="sample_table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="80px">ID</th>
				<th width="80px">友情链接名称</th>
				<th width="250px">友情链接地址</th>
				<th width="100px">合作伙伴</th>		               
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
	<?php if(is_array($link_show)): $i = 0; $__LIST__ = $link_show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
      <td><?php echo ($vo["id"]); ?></td>
      <td><?php echo ($vo["linkname"]); ?></td>
      <td><?php echo ($vo["linkaddress"]); ?></td>
      <td><img src="/music/<?php echo ($vo["linkpic"]); ?>" alt="图片" width="100px" height="70px"></td>
      <td class="td-manage">
        <a title="编辑"  target="_self" href="<?php echo U('Home/Link/edit',array('id'=>$vo['id']));?>"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>       
        <a title="删除" href="javascript:;"  onclick="member_del(this,'1')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
     </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
    </table>
<div align="center">
　　<?php echo ($page); ?>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
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
$(function() { 
	$("#administrator").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
	});
});
//初始化宽度、高度  
 $(".widget-box").height($(window).height()-215); 
$(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height()-215);
	 $(".table_menu_list").width($(window).width()-260);
	  $(".table_menu_list").height($(window).height()-215);
	})
 laydate({
    elem: '#start',
    event: 'focus' 
});

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}
/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="fa fa-check  bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
// /*产品-编辑*/
// function member_edit(title,url,id,w,h){
// 	layer_show(title,url,w,h);
// }

// /*产品-删除*/
// function member_del(obj,id){
// 	layer.confirm('确认要删除吗？',function(index){
// 		// $(obj).parents("tr").remove();
// 		// layer.msg('已删除!',{icon:1,time:1000});
// 		location.href="<?php echo U('Home/Link/delete',array('id'=>$vo['id']));?>";
// 	});
// }

</script>