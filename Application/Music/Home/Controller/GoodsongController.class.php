<?php 
namespace Home\Controller;

class GoodsongController extends TotalController {
    //查询好歌曲列表
    public function index(){
        $goodsong=M("Goodsong");
        $list=$goodsong->select(); 
        //分配变量
        // $this->assign("row",ceil(count($list)/3));   //显示几行
        $this->assign("list",$list);
        $this->display();
    }



    //获取对应好歌曲区域的歌曲列表信息
    public function song_list(){

       if (IS_GET) {
        $id = I('id','','intval');
        $goodsong = M('Goodsong');
        $result = $goodsong->where('id=%d', $id)->field('id, name, song_id')->find(); //取出该分类下的歌曲ID
        //实例化歌曲类模型
        $song = M('Song');
        $data = array();
        $arr = explode(',', $result['song_id']);    //将歌曲id转换为数组
        // dump($arr);
        
        $where['id'] = array('IN', $arr);
        $count = count($arr);// 查询满足要求的总记录数
        $num = 5;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result1 = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('songlist',$result1);// 赋值数据集
        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->assign('good',$result);// 赋值分页输出;
        $this->display();
        
       } else {
        $this->error('非法请求!');
       }

    }

    //加载添加页面
    public function add(){

    if (IS_GET) {
      $id = I('id','','intval');    //好歌曲分类ID
      //获得song_id里面的歌曲ID值用于接下来的比较
      $goodsong=M("Goodsong");
      $value=$goodsong->field("id,name,song_id")->find($id);
      /*查询所有歌曲信息*/
      $song=M("Song");
      $songlist=$song->select();
      $list = array();
     //循环遍历歌曲信息,查看歌曲id是否在Goodsong表的song_id里面
      for($i=0;$i<count($songlist);$i++){
            $songid=$songlist[$i]['id'];
            if(in_array($songid,explode(",",$value['song_id']))){
                    $list[]=$songid;    //若存在,则将歌曲信息放到该数组中
            }
      }
        $where['id'] = array('NOT IN',$list);   //添加歌曲时取相反条件
        // dump($where['id'][1]);
        if ($where['id'][1]) {                  //防止没有结果集SQL语句报错
            $count = $song->where($where)->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
            
        } else {
            $count = $song->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $song->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

        }

          $show   = $page->show();// 分页显示输出
          
          $this->assign('songlist',$result);// 赋值数据集
          $this->assign('count',$count);// 赋值数据集
          $this->assign('page',$show);// 赋值分页输出;
          $this->assign('good',$value);// 赋值好歌曲指定ID结果集;

          $this->display();

        } else {
            $this->error('非法请求');
        }
    }

    //执行添加
    public function insert(){   
        if (IS_POST) {
        $data['id'] = I('id','','intval');
        $goodsong=M("Goodsong");
        $value=$goodsong->field("song_id")->find($data['id']);

        //获取复选框中选中的歌曲ID
        $ids = I('check');
        $arr = implode(",", $ids);        //将ID以逗号分隔变成字符串

        $data['song_id'] = $arr.','.$value['song_id'];    //替换原来的字段值
        $result = $goodsong->where("id=%d",$data['id'])->save($data);

            if (!$result === false) {
                $this->success('添加歌曲成功!',U('Home/Goodsong/song_list',array('id'=>$data['id'])));
            } else {
                $this->error('添加歌曲失败!');
            }
        } else {
            $this->error('非法请求');
        } 
    }

    //加载修改页面
     public function edit(){
        //实例化
        $mod=D("good");
        //获取需要修改的数据
        $ob=$mod->find($_GET['id']);
        //分配变量
        $this->assign("ob",$ob);
        //加载模板
        $this->display("edit");

    }

    //执行修改
    public function update(){
        //实例化
        $mod=D("good");
        //封装信息
        if(!$mod->create()){
            $this->error($mod->getError());
        }
        if($mod->save()){
            $this->success("修改成功",U("Good/index"));
        }else{
            $this->error("修改失败");
        }
    }

    //删除好歌曲分类中的歌曲(但实际上不需要删除歌曲)
    public function del(){
       if (IS_GET) {
        $id = I('id','','intval');                          //好歌曲分类ID
        $song_id = I('song_id','','intval');                //歌曲ID

        $goodsong=M("Goodsong");
        $value=$goodsong->field("song_id")->find($id);      //查询好歌曲分类中的歌曲ID集合

        $arr = explode(',',$value['song_id']);          //以逗号分隔数组
        if (in_array($song_id, $arr)) {                 //若好歌曲分类中存在该歌曲,则从数组中删除
            foreach ($arr as $key => $v) {
                if ($v == $song_id){
                    unset($arr[$key]);
                }
                
            }
        }

        $data['song_id'] = implode(",", $arr);
        $result = $goodsong->where("id=%d",$id)->save($data);

            if (!$result === false) {
                $this->success('删除歌曲成功!',U('Home/Goodsong/song_list',array('id'=>$id)));
            } else {
                $this->error('删除歌曲失败!');
            }

        } else {
            $this->error('非法请求');
        }
    }

}
 ?>