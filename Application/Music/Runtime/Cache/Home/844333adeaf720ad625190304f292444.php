<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加排行榜子分类页面</title>
	<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/public.css" />
</head>
<body>
	<form action="<?php echo U('Home/Rank/addCate');?>" method='post' enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th colspan='2'>添加&nbsp;[<?php echo ($cate["name"]); ?>]&nbsp;子分类</th>
			</tr>
			<tr>
				<td width='45%' align='right'>子分类名称：</td>
				<td>
					<input type="text" name='name'/>
				</td>
			</tr>
			<tr>
				<td width='45%' align='right'>子分类图片：</td>
				<td>
					<input type="file" name='pic'/>
				</td>
			</tr>
			<tr>
				<td width='45%' align='right'>分类描述：</td>
				<td>
					<textarea name="desc" id="desc" cols="30" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height='60'>
					<input type="hidden" name='pid' value='<?php echo ($cate["id"]); ?>'/>
					<input type="hidden" name="level" value="<?php echo ($cate["level"]); ?>">
					<input type="submit" value='保存添加' class='submit'/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>