<?php
namespace Home\Controller;
use Org\Net;

class AdminController extends TotalController {

    //分页显示管理员列表
    public function index () {

      /*查询所有管理员信息*/
      $admin = D('Admin');
      $count = $admin->count();// 查询满足要求的总记录数
      $num = 5;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $admin->order('id asc')->relation(true)->limit($page->firstRow.','.$page->listRows)->select();

      $arr = "";    //用来保存关联查询的结果
      // dump($result);
      foreach ($result as $key => $value) {
          $arr[] = $value['groups'];
      }
      // dump($arr);
      foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
          $arr1 .= $v['title'].",";
        }
        $arr1 = rtrim($arr1,',');
        $arr2[] = $arr1;  //保存结果
        unset($arr1);   //清除记录
      }
      // dump($arr2);
      // dump($result);
      $this->assign('admin_show',$result);// 赋值数据集
      $this->assign('title',$arr2);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

   //显示管理员添加页面
   public function add () {
        $group = M('Auth_group');
        $res = $group->select();  //取出管理组信息
        $this->assign('group',$res);// 赋值数据集
        $this->display();
   }

   //真正添加管理员数据的方法
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
          $access = I('access','','intval');
          //先处理用户上传头像
          $upload = new \Think\Upload();// 实例化上传类
          $upload->maxSize   =     3145728 ;// 设置附件上传大小
          $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
          $upload->subName   =    array('date','Ymd');
          $upload->rootPath   =   './Public/';       //网站跟目录是./
          $upload->savePath  =     'Home/Uploads/admin_pic/'; //设置管理员头像附件上传目录
          $rootPath =  $upload->rootPath;             //保存根路径 
          $info   =   $upload->upload();
          if(!$info) {        //当没有新头像上传时

            $this->error($upload->getError());  //直接返回错误页面
            
          } else {             // 当有新头像上传并且上传成功时    

            $data['pic'] = $rootPath.$info['pic']['savepath'].$info['pic']['savename'];
            $admin = M('Admin');
            $auth_access = M('Auth_group_access');
            $result = $admin->add($data);
            if (!$result === false) {
                $insertId = intval($result);    //插入的主键ID
                $data['uid'] = $insertId;
                foreach ($access as $key => $value) {
                  $data['group_id'] = $value;
                  $result1[] = $auth_access->data($data)->add();
                }
                if (!$result1) {
                  $this->error('用户管理组明细表信息添加失败!');
                }
                $this->success('管理员添加成功!',U('Home/Admin/index'));
            } else {
                $this->error('管理员添加失败!');
            }
          }
      } else {
        $this->error ('非法请求!');
      }


   }


   //显示修改页面
   public function edit () {
        $id = I('id','','intval');
        $admin = M('Admin');
        $data['id'] = $id;
        $result = $admin->where($data)->order('id desc')->find();
        $this->assign('admin',$result);
        $this->display();
   }

   //真正修改管理员数据的方法
    public function editHandle () {
      if (IS_POST) {
            $data['id'] = I('id','','intval');
            $data['regtime'] = date('Y-m-d H:i:s',time());
            $data['username'] = I('username');
            $data['password'] = I('password','','md5');
            $data['tel'] = I('tel');
            $data['email'] = I('email');
            $data['address'] = I('address');
            
            //先获取原图片路径
            $admin = M('Admin');
            $val = $admin->find($data['id']);
            $imgpath = $val['pic'];



          //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $rootPath =  $upload->rootPath;             //保存根路径
            $upload->savePath  =     'Home/Uploads/admin_pic/'; //设置管理员头像附件上传目录    
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

              
                  $result = $admin->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('管理员信息更新成功!',U('Home/Admin/index'));
                  } else {
                      $this->error('管理员信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {             // 当有新头像上传并且上传成功时    

              //先检查原头像是否存在
              if (file_exists($imgpath)) {
                //如果原图存在 先删除原图
                unlink($imgpath);
              }


                $data['pic'] = $rootPath.$info['npic']['savepath'].$info['npic']['savename'];
              
                $result = $admin->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('管理员信息更新成功!',U('Home/Admin/index'));
                } else {
                    $this->error('管理员信息更新失败!');
                }

            }


      } else {
        $this->error ('非法访问!');
      }
     

   }



   //删除管理员的方法
    public function delete () {

        if (IS_GET) {
          $id = I('id','','intval');
          $admin = M('Admin');
          $data['id'] = $id;
          //先获取原图片路径
          $val = $admin->find($data['id']);
          $imgpath = $val['pic'];
          //先检查原头像是否存在
          if (file_exists($imgpath)) {
            //如果原图存在 先删除原图
            unlink($imgpath);
          }

          $result = $admin->where($data)->delete();
          
          if ($result) {
            $this->success ('删除管理员成功',U('Home/Admin/index'));
          } else {
            $this->error ('删除管理员失败!');
          }

        } else {
           $this->error ('非法访问!');
        }
    }


    //显示管理员个人信息
    public function info () {
      //从session中取管理员id
        $id = session('user_id');
        $admin = M('Admin');
        $data['id'] = $id;
        $result = $admin->where($data)->find();
        $this->assign('info',$result);
        $this->display();

    }


    //获取管理员登录信息
    public function loginInfo () {

        // $taobaoIP = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$clientIP;
        // $IPinfo = json_decode(file_get_contents($taobaoIP));
        // $province = $IPinfo->data->region;
        // $city = $IPinfo->data->city;
        // $data = $province.$city;
        // return $data;
        dump(gethostname());
        dump(gethostbyname(gethostname()));
      // $ip = get_client_ip();
      
    
      // dump($ip);
    
      // $Ip = new \Org\Net\IpLocation(); // 实例化类 参数表示IP地址库文件

      // $area = $Ip->getlocation('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js'); // 获取某个IP地址所在的位置

      // dump($area);
    }


    //修改状态
    public function status(){

      if (IS_GET) {
        $admin = M('Admin');
        $id = I('id','','intval');
        $status = I('status','','intval');
        $data['id'] = $id;
        if($status){
          $data['status'] = 0;
          $admin -> save($data);
          $this -> success("禁用成功!",U('Home/Admin/index'));
        }else{
          $data['status'] = 1;
          $admin -> save($data);
          $this -> success("启用成功!",U('Home/Admin/index'));
        }
      } else {
        $this->error('非法请求!');
      }

    }

    //修改管理组页面
    public function editGroup () {
      if (IS_POST) {
          $where['uid'] = I('id','','intval');    //管理员ID
          $arr = I('group');
          // dump($arr);
          $access = M('Auth_group_access');
          $del = $access->where($where)->delete();    //先将原来的管理组全部删除
          if ($del) {
            foreach ($arr as $key => $value) {
              $where['group_id'] = $value;
              $result[] = $access->add($where);       //逐条插入
            }
          }

          if ($result) {
            $this->success('修改管理组成功!',U('Home/Admin/index'));
          } else {
            $this->error('修改管理组失败!');
          }

      } else {
        $data['id'] = I('id','','intval');
        $admin = M('Admin');
        $group = M('Auth_group');
        $result = $group->select();
        $result1 = $admin->where($data)->order('id desc')->find();
        $this->assign('groups',$result);
        $this->assign('admin',$result1);
        $this->display();
      }    
    }


    
}  