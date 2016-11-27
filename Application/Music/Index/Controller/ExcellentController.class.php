<?php 
namespace Index\Controller;
use Think\Controller;

class ExcellentController extends Controller{

	//显示精选专辑列表
	public function index(){
		$excellent = M('Excellent');
		$count = M('Excellent')->count();// 查询满足要求的总记录数
        $num = 4;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result = $excellent->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->assign('excellentlist',$result);
		$this->display();
	}

	//显示专辑中的歌曲
	public function songlist(){
		
       if (IS_GET) {
        $id = I('id','','intval');
        $excellent = M('Excellent');
        $song = M('Song');
        $result = $excellent->where('id=%d', $id)->find(); //取出该专辑下的歌曲ID
        $songs = $song->select();													//取出所有歌曲的信息
        //实例化歌曲类模型
        if ($result) {      //为了防止foreach报错
            $arr = $result['song_id'];
            $arr1 = explode(',', $arr);
            $where['id'] = array('IN', $arr1);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $count = count($arr1);           // 查询满足要求的总记录数
        $num = 8;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result1 = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('songlist',$result1);// 赋值专辑歌曲数据集
        $this->assign('excellentlist',$result);// 赋值专辑数据集
        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->assign('id',$id);// 专辑ID;
        // dump($show);
        // dump($result1);
        $this->display();
        
       } else {
        $this->error('非法请求!');
       }


	}




}