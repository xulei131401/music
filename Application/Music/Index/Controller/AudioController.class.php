<?php
namespace Index\Controller;
use Think\Controller;

class AudioController extends Controller {

    //播放单首歌曲页面
    public function index(){

        if (IS_GET) {
            //获得歌曲的id
            $id = I('id','','intval');
            //获得该歌曲信息
            $result = $song=M("Song")->find($id);
            $url = basename($result['url']);              //mp3路径
            $lyric = basename($result['lyric']);          //歌词路径
            $singer = $result['singer'];                //歌手名字
            $name = $result['name'];                    //歌曲名字

            //获取文件扩展名字
            $extenesion1 = pathinfo($result['url'], PATHINFO_EXTENSION);
            $extenesion2 = pathinfo($result['lyric'], PATHINFO_EXTENSION);
            //获取文件名字
            $real_url = str_replace('.'.$extenesion1, '', $url);
            $real_lyric = str_replace('.'.$extenesion2, '', $lyric);

            //组装json数据
            $a['data']  = array(
                array('real_song_name'=>$real_url,'song_name'=>$name,'artist'=>$singer ,'real_lrc_name'=>$real_lyric,'ly_ric_url'=>$result['lyric'],'real_song_url'=>$result['url']),
            );

            $dataJson =  json_encode($a,JSON_UNESCAPED_UNICODE);        //不编码汉字
            // dump($dataJson);
            $this->assign('song',$result);
            $this->assign('a',$a['data']);
            $this->assign('dataJson',$dataJson);
            $this->display();
        } else {
            $this->error('非法请求!');
        }

    }

    //播放排行榜列表歌曲
    public function play () {
        if (IS_GET) {

            $id = I('id','','intval');          //排行榜分类ID
            $rankSong = M('Rank_song');
            $rank=M("Rank");
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

            $result1 = $song->order('id asc')->where($where)->select();         //查询出该分类下的所有歌曲信息
            foreach ($result1 as $key => $v) {
                //获得该歌曲信息
                $url = basename($v['url']);              //mp3路径
                $lyric = basename($v['lyric']);          //歌词路径
                $singer = $v['singer'];                //歌手名字
                $name = $v['name'];                    //歌曲名字

                 //获取文件扩展名字
                $extenesion1 = pathinfo($v['url'], PATHINFO_EXTENSION);
                $extenesion2 = pathinfo($v['lyric'], PATHINFO_EXTENSION);
                //获取文件名字
                $real_url = str_replace('.'.$extenesion1, '', $url);
                $real_lyric = str_replace('.'.$extenesion2, '', $lyric);

                 //组装json数据
                $a['data'][] = 
                    array('real_song_name'=>$real_url,'song_name'=>$name,'artist'=>$singer ,'real_lrc_name'=>$real_lyric,'ly_ric_url'=>$v['lyric'],'real_song_url'=>$v['url']);
            }

            $result2 = $song=M("song")->find($result1[0]['id']);        //默认显示第一首歌曲
            $dataJson =  json_encode($a,JSON_UNESCAPED_UNICODE);        //不编码汉字
            // dump($dataJson);
            $this->assign('song',$result2);
            $this->assign('a',$a['data']);
            $this->assign('dataJson',$dataJson);
            $this->display('index');
            
        } else {
            $this->error('非法请求!');
        }
    }

    //播放歌曲分类列表歌曲
    public function playClassify () {
        if (IS_GET) {
            $id = I('id','','intval');          //歌曲分类ID
            $classifySong = M('Classify_song');
            $classify=M("Classify");
            $result = $classifySong->where('classify_id=%d', $id)->field('id, classify_id, song_id')->select(); //取出该分类下的歌曲ID
            $good = $classify->where('id=%d', $id)->find(); //取出该分类的信息
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

            $result1 = $song->order('id asc')->where($where)->select();         //查询出该分类下的所有歌曲信息
            foreach ($result1 as $key => $v) {
                //获得该歌曲信息
                $url = basename($v['url']);              //mp3路径
                $lyric = basename($v['lyric']);          //歌词路径
                $singer = $v['singer'];                //歌手名字
                $name = $v['name'];                    //歌曲名字

                 //获取文件扩展名字
                $extenesion1 = pathinfo($v['url'], PATHINFO_EXTENSION);
                $extenesion2 = pathinfo($v['lyric'], PATHINFO_EXTENSION);
                //获取文件名字
                $real_url = str_replace('.'.$extenesion1, '', $url);
                $real_lyric = str_replace('.'.$extenesion2, '', $lyric);

                 //组装json数据
                $a['data'][] = 
                    array('real_song_name'=>$real_url,'song_name'=>$name,'artist'=>$singer ,'real_lrc_name'=>$real_lyric,'ly_ric_url'=>$v['lyric'],'real_song_url'=>$v['url']);
            }

            $result2 = $song=M("song")->find($result1[0]['id']);        //默认显示第一首歌曲
            $dataJson =  json_encode($a,JSON_UNESCAPED_UNICODE);        //不编码汉字
            // dump($dataJson);
            $this->assign('song',$result2);
            $this->assign('a',$a['data']);
            $this->assign('dataJson',$dataJson);
            $this->display('index');
            
        } else {
            $this->error('非法请求!');
        }
    }
    
     //播放专辑分类列表歌曲
    public function playExcellent () {
        if (IS_GET) {
            $id = I('id','','intval');          //专辑分类ID
            $excellent = M('Excellent');
            $song=M("Song");
            $result = $song->select();          //取出所有歌曲ID
            $exe = $excellent->where('id=%d', $id)->find(); //取出该分类的信息
            //实例化歌曲类模型
            if ($exe) {      //为了防止foreach报错    
                $arr = $exe['song_id'];
                $arr1 = explode(',', $arr);
                $where['id'] = array('IN', $arr1);
            } else {
                $where['id'] = null;        //当没有歌曲时默认为null
            }

            $result1 = $song->order('id asc')->where($where)->select();         //查询出该分类下的所有歌曲信息
            foreach ($result1 as $key => $v) {
                //获得该歌曲信息
                $url = basename($v['url']);              //mp3路径
                $lyric = basename($v['lyric']);          //歌词路径
                $singer = $v['singer'];                //歌手名字
                $name = $v['name'];                    //歌曲名字

                 //获取文件扩展名字
                $extenesion1 = pathinfo($v['url'], PATHINFO_EXTENSION);
                $extenesion2 = pathinfo($v['lyric'], PATHINFO_EXTENSION);
                //获取文件名字
                $real_url = str_replace('.'.$extenesion1, '', $url);
                $real_lyric = str_replace('.'.$extenesion2, '', $lyric);

                 //组装json数据
                $a['data'][] = 
                    array('real_song_name'=>$real_url,'song_name'=>$name,'artist'=>$singer ,'real_lrc_name'=>$real_lyric,'ly_ric_url'=>$v['lyric'],'real_song_url'=>$v['url']);
            }

            $result2 = $song->find($result1[0]['id']);                  //默认显示第一首歌曲
            $dataJson =  json_encode($a,JSON_UNESCAPED_UNICODE);        //不编码汉字
            // dump($dataJson);
            $this->assign('song',$result2);
            $this->assign('a',$a['data']);
            $this->assign('dataJson',$dataJson);
            $this->display('index');
            
        } else {
            $this->error('非法请求!');
        }
    }

     //播放好歌曲板块列表所有歌曲
    public function playGood () {
        if (IS_GET) {
            $id = I('id','','intval');          //好歌曲分类ID
            $goodSong = M('Goodsong');
            $song=M("Song");
            $result = $song->select();          //取出所有歌曲ID
            $exe = $goodSong->where('id=%d', $id)->find(); //取出该分类的信息
            //实例化歌曲类模型
            if ($exe) {      //为了防止foreach报错    
                $arr = $exe['song_id'];
                $arr1 = explode(',', $arr);
                $where['id'] = array('IN', $arr1);
            } else {
                $where['id'] = null;        //当没有歌曲时默认为null
            }

            $result1 = $song->order('id asc')->where($where)->select();         //查询出该分类下的所有歌曲信息
            foreach ($result1 as $key => $v) {
                //获得该歌曲信息
                $url = basename($v['url']);              //mp3路径
                $lyric = basename($v['lyric']);          //歌词路径
                $singer = $v['singer'];                //歌手名字
                $name = $v['name'];                    //歌曲名字

                 //获取文件扩展名字
                $extenesion1 = pathinfo($v['url'], PATHINFO_EXTENSION);
                $extenesion2 = pathinfo($v['lyric'], PATHINFO_EXTENSION);
                //获取文件名字
                $real_url = str_replace('.'.$extenesion1, '', $url);
                $real_lyric = str_replace('.'.$extenesion2, '', $lyric);

                 //组装json数据
                $a['data'][] = 
                    array('real_song_name'=>$real_url,'song_name'=>$name,'artist'=>$singer ,'real_lrc_name'=>$real_lyric,'ly_ric_url'=>$v['lyric'],'real_song_url'=>$v['url']);
            }

            $result2 = $song->find($result1[0]['id']);                  //默认显示第一首歌曲
            $dataJson =  json_encode($a,JSON_UNESCAPED_UNICODE);        //不编码汉字
            // dump($dataJson);
            $this->assign('song',$result2);
            $this->assign('a',$a['data']);
            $this->assign('dataJson',$dataJson);
            $this->display('index');
            
        } else {
            $this->error('非法请求!');
        }
    }

}