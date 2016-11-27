<?php 
namespace Index\Controller;
use Think\Controller;

/*排行页面取出信息*/
class RankController extends Controller{
    
	//排行榜首页
	public function index(){
		$rank=M("Rank");
		$cate = $rank->select();
		$recur = recursive($cate);
		if ($_GET['id']){
			
			$id = I('id','','intval');
		} else {
			$id = intval($recur[1]['id']);		//默认显示为大分类的第一个子分类
		}

        $rankSong = M('Rank_song');
        $result = $rankSong->where('rank_id=%d', $id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        $good = $rank->where('id=%d', $id)->find(); //取出该分类的信息
        //实例化歌曲类模型
        $song = M('Song');
        if ($result) {      //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
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
        $this->assign('songlist',$result1); // 赋值排行榜歌曲列表
        $this->assign('count',$count);      // 赋值数据集
        $this->assign('page',$show);        // 赋值分页输出;
        $this->assign('good',$good);        // 排行榜信息输出;
        $this->assign('cate',$recur);       //无限分类结果集;
        $this->assign('id',$id);            //默认显示的排行榜信息id

		$this->display();
	}
	
}