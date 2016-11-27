<?php 
namespace Index\Controller;
use Think\Controller;

class GoodController extends Controller{
	//显示好歌列表
	public function index(){
		$goodSong = M('Goodsong');
		$song = M('Song');
		$result = $goodSong->select();
		$songs = $song->select();													//取出所有歌曲的信息
		//实例化歌曲类模型
		if ($result && $songs) {      												//为了防止foreach报错
		    $arr = $result[0]['song_id'];											//默认显示第一个好歌曲板块歌曲
		    $arr1 = explode(',', $arr);
		    $where['id'] = array('IN', $arr1);
		} else {
		    $where['id'] = null;        //当没有歌曲时默认为null
		}
		$result1 = $song->order('id asc')->where($where)->select();
		$this->assign('goodSong',$result);
		$this->assign('songlist',$result1);
		$this->assign('id',$result[0]['id']);
		$this->display();
	}

	//显示专辑中的歌曲
	public function songlist(){
		$goodSong = M('Goodsong');
		$good = $goodSong->select();
       if (IS_GET) {
	        $id = I('id','','intval');
	        $goodSong = M('Goodsong');
	        $song = M('Song');
	        $result = $goodSong->where('id=%d', $id)->find(); //取出该专辑下的歌曲ID
	        $songs = $song->select();													//取出所有歌曲的信息
	        //实例化歌曲类模型
	        if ($result) {      //为了防止foreach报错
	            $arr = $result['song_id'];
	            $arr1 = explode(',', $arr);
	            $where['id'] = array('IN', $arr1);
	        } else {
	            $where['id'] = null;        //当没有歌曲时默认为null
	        }
	        $count = count($arr);// 查询满足要求的总记录数
	        $num = 5;   //每页显示几条
	        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
	        // dump($page);
	        $show   = $page->show();// 分页显示输出
	        //分页查询
	        $result1 = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
	        $this->assign('songlist',$result1);// 赋值好歌曲板块歌曲数据集
	       	$this->assign('goodSong',$good);// 赋值专辑数据集
	       	$this->assign('id',$id);// 赋值好歌曲板块ID
	        $this->assign('count',$count);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出;
	        $this->display('index');
        
       } else {
        	$this->error('非法请求!');
       }


	}



}