<?php
namespace Index\Controller;
use Think\Controller;

class IndexController extends Controller {
    //前台首页显示
    public function index(){
        //实例化
        $webSite = M("Website");
        $result = $webSite->find();
        if($result['state'] == 0){
            $this->success("网站正在维护中.....",U("Wrong/index"));
        }

        $doop=$webSite->select();
        $this->assign("doop",$doop);        //将网站信息传递到模板
        //专辑实例化
        $gmd=M("Excellent");
        $gmdlist=$gmd->limit(1,8)->select();
        $this->assign("gmdlist",$gmdlist);
        $mdglist=$gmd->limit(0,7)->select();
        $this->assign("mdglist",$mdglist);

    	//歌曲实例化
    	$mo=M("Song");
    	//分类实例化
    	$md=M("Rank");
    	//链接实例化
        $mod=M("Link");
        $list = $mod->select();             //查询友情链接
        $this->assign('list', $list);         
        //专辑新歌华语部分
        $rankSong = M('Rank_song');

        $kg=$md->where("name='酷狗飙升榜'")->find();
        $rank_id = intval($kg['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list1  = $mo->order('id asc')->where($where)->select();
    	$this->assign("list1",$list1);
    

        //专辑新歌欧美部分      
        $lg=$md->where("name='欧美新歌榜'")->find();
        $rank_id = intval($lg['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list2  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list2",$list2);
    

        //专辑新歌日韩部分
        $ss=$md->where("name='日本新歌榜'")->find();
        $rank_id = intval($ss['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list3  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list3",$list3);

        //专辑新歌蒙面歌王部分
        $mng=$md->where("name='蒙面新歌榜'")->find();
        $rank_id = intval($mng['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list4  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list4",$list4);

        //专辑最热开始
        $km=$md->where("name='网络红歌榜'")->find();
        $rank_id = intval($mng['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list5  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list5",$list5);
    
        //专辑推荐榜部分
        $fm=$md->where("name='酷狗分享榜'")->find();
        $rank_id = intval($fm['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list6  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list6",$list6);

        //排行版块开始
        //最新热榜
        $qq=$md->where("name='酷狗飙升榜'")->find();
        $rank_id = intval($qq['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list7  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list7",$list7);

         //最热热榜
        $dw=$md->where("name='酷狗TOP500'")->find();
        $rank_id = intval($dw['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list8  = $mo->order('id asc')->where($where)->select();
   
        $this->assign("list8",$list8);

        //全球排行开始
        //华语排行
        $sh=$md->where("name='中国TOP排行榜'")->find();
        $rank_id = intval($sh['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list9  = $mo->order('id asc')->where($where)->select();
        $this->assign("list9",$list9);

         //香港排行
        $xg=$md->where("name='香港RTHK电台榜'")->find();
        $rank_id = intval($xg['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list10  = $mo->order('id asc')->where($where)->select();
        $this->assign("list10",$list10);

         //日韩排行
        $jp=$md->where("name='日本新歌榜'")->find();
        $rank_id = intval($jp['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list11  = $mo->order('id asc')->where($where)->select();
        $this->assign("list11",$list11);

         //欧美排行
        $am=$md->where("name='美国BillBoard榜'")->find();
        $rank_id = intval($am['id']);
        $result = $rankSong->where('rank_id=%d', $rank_id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        if ($result) {                                  //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }
        $list12  = $mo->order('id asc')->where($where)->select();
        $this->assign("list12",$list12);

        //歌曲分类板块
        $cate = M('Classify');
        $cre = $cate->where('pid = 0')->select();           //查询所有顶级分类信息
        // // dump($cre);
        $cateid = $cate->select();                          //将所有的分类信息取出来
        $arr = array();
        foreach ($cre as $key => $value) {                  //查询各个顶级分类下的子分类的所有信息
          $delid = get_all_child($cateid,$value['id']);
          if ($delid) {
            $delid[] = $value['id'];
            $where['id'] = array('IN', $delid);
          } else {
            $where['id'] = null;
          }
            $result = $cate->where($where)->select();
            $arr[] = $result;                               //各自的分类信息保存到该数组中
                  
        }        
        $this->assign('cate', $arr);            //将歌曲分类信息分配到模板
        //显示模板
        $this->display();
    }
}