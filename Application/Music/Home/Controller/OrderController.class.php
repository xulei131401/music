<?php
namespace Home\Controller;

class UserController extends TotalController {

  //分页显示会员列表
    public function index () {

      /*查询所有会员信息*/
      $user = M('User');
      $count = $user->count();// 查询满足要求的总记录数
      $num = 2;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $user->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('user_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

   //显示会员添加页面
   public function add () {

        $this->display();
   }

   //真正添加会员数据的方法
   public function addHandle () {

      if (IS_POST) {
          $data['regtime'] = date('Y-m-d H:i:s',time());
          $data['username'] = I('username');
          $data['password'] = I('password','','md5');
          $data['tel'] = I('tel');
          $data['realname'] = I('realname');
          $data['email'] = I('email');
          $data['address'] = I('address');
          $data['sex'] = I('sex','','intval');
          $data['age'] = I('age','','intval');
          $data['vip'] = I('vip');

            //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './';       //网站跟目录是./
            $upload->savePath  =     'Public/Home/Uploads/user_pic/'; //设置管理员头像附件上传目录    
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

              $this->error($upload->getError());  //直接返回错误页面
              
            } else {             // 当有新头像上传并且上传成功时    

                $data['pic'] = __ROOT__."/".$info['pic']['savepath'].$info['pic']['savename'];
                $user = M('User');
                $result = $user->add($data);       
                if (!$result === false) {
                    $this->success('管理员添加成功!',U('Home/User/index'));
                } else {
                    $this->error('管理员添加失败!');
                }
            }
      } else {
        $this->error ('非法请求!');
      }


   }


   //显示会员修改页面
   public function edit () {
        $id = I('id','','intval');
        $user = M('User');
        $data['id'] = $id;
        $result = $user->where($data)->order('id desc')->find();
        $this->assign('user',$result);
        $this->display();
   }

   //真正修改会员数据的方法
    public function editHandle () {
      if (IS_POST) {
            $data['id'] = I('id','','intval');
            $data['regtime'] = date('Y-m-d H:i:s',time());
            $data['username'] = I('username');
            $data['password'] = I('password','','md5');
            $data['tel'] = I('tel');
            $data['email'] = I('email');
            $data['address'] = I('address');
            $data['vip'] = I('vip');
      
          //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './';       //网站跟目录是./
            $upload->savePath  =     'Public/Home/Uploads/user_pic/'; //设置会员头像附件上传目录    
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

                  $user = M('User');
                  $result = $user->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('用户信息更新成功!',U('Home/User/index'));
                  } else {
                      $this->error('用户信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {             // 当有新头像上传并且上传成功时    

                $data['pic'] = __ROOT__."/".$info['npic']['savepath'].$info['npic']['savename'];
                $user = M('User');
                $result = $user->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('用户信息更新成功!',U('Home/User/index'));
                } else {
                    $this->error('用户信息更新失败!');
                }

            }


      } else {
        $this->error ('非法访问!');
      }
     

   }



   //删除会员的方法
    public function delete () {

        if (IS_GET) {
          $id = I('id','','intval');
          $user = M('User');
          $data['id'] = $id;
          $result = $user->where($data)->delete();
          if ($result) {
            $this->success ('删除用户成功',U('Home/User/index'));
          } else {
            $this->error ('删除用户失败!');
          }

        } else {
           $this->error ('非法访问!');
        }
    }


    //显示会员个人信息
    public function info () {
      //从session中取会员id
        $id = session('user_id');
        $user = M('User');
        $data['id'] = $id;
        $result = $admin->where($data)->find();
        $this->assign('info',$result);
        $this->display();

    }


   

}  