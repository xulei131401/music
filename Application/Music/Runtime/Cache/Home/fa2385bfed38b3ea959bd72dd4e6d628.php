<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>修改歌曲分类视图</title>
	<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/public.css" />
</head>
<body>
	<form action="<?php echo U('Home/Classify/editCate');?>" method='post'>
		<table class="table">
			<tr>
				<th colspan='2'>修改分类(目前只能修改名字,其他类似)</th>
			</tr>
			<tr>
				<td width='45%' align='right'>分类名称：</td>
				<td>
					<input type="text" name='name' value='<?php echo ($cate["name"]); ?>'/>
				</td>
			</tr>
			<tr>
				<td height='60' colspan='2' align='center'>
					<input type="hidden" name='id' value='<?php echo ($cate["id"]); ?>'/>
					<input type="submit" value='保存修改' class='submit'/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>