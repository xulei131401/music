<?php
/**
 * 格式化打印数组
 * @param  [type] $arr [description]
 * @return [type]      [description]
 */
function p ($arr) {
	echo '<pre>';
	dump($arr);
	echo '</pre>';
}

/**
 * 递归重新排序无限级分类数组
 * [recursive description]
 * @param  [type]  $array [取得的记录数组]
 * @param  integer $pid   [父ID默认为0]
 * @param  integer $level [等级默认为1]
 * @return [type]         [结果数组]
 */
function recursive ($array, $pid=0, $level=1) {	//默认为顶级分类
	$arr = array();	//先设定为一个空数组

	foreach ($array as $v) {
		if ($v['pid'] == $pid) {
			$v['level'] = $level;
			$v['html'] = str_repeat('--', $level);	//多一级添加1个--
			$arr[] = $v;	//组装成二维数组
			$arr = array_merge($arr, recursive($array, $v['id'], $level + 1));
		}
	}

	return $arr;
}


/**
 * 递归获取传递ID的所有子分类ID
 * @param  [type] $array [分类的全部结果集]
 * @param  [type] $id    [分类ID]
 * @return [type]        [数组]
 */
function get_all_child ($array, $id) {
	$arr = array();

	foreach ($array as $v) {
		if ($v['pid'] == $id) {		//若相等表示是自己的子级分类
			$arr[] = $v['id'];
			$arr = array_merge($arr, get_all_child($array, $v['id']));
		}
	}

	return $arr;
}