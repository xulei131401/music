<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加歌曲顶级分类视图</title>
	<link rel="stylesheet" href="<?php echo C('T_URL');?>/css/public.css" />
</head>
<body>
	<form action="<?php echo U('Home/Classify/addCate');?>" method='post'>
		<table class="table">
			<tr>
				<th colspan='2'>添加歌曲顶级分类</th>
			</tr>
			<tr>
				<td align='right' width='45%'>歌曲顶级分类名称：</td>
				<td>
					<input type="text" name='name'/>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height='60'>
					<input type="hidden" name='pid' value='0'/>
					<input type="submit" value='保存添加' class='submit'/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>