<?php
namespace Home\Controller;

//商品评论控制器
class CommentController extends TotalController {

    //分页查询商品评论信息
    public function index(){
      $comment = M('Comment');
      $count = $comment->count();// 查询满足要求的总记录数
      $num = 7;   //每页显示几条
      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $comment->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
      $this->assign('comment',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

    //删除评论
    public function del(){
        if (IS_GET) {
            //实例化
            $comment=M("Comment");
            $id = I('id','','intval');
            $result = $comment->where('id=%d',$id)->delete();
            if($result){
                $this->success("删除成功",U("Home/Comment/index"));
            }else{
                $this->error("删除失败");
            }
        } else {
            $this->error('非法请求!');
        }
        
    }


}