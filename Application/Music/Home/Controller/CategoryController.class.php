<?php
namespace Home\Controller;
/**
 * 商品分类控制器
 */
class CategoryController extends TotalController {

   //分类列表视图
    Public function index () {
        $cate = M('Category')->select();
        $this->cate = recursive($cate);
        // dump($this->cate);
        $this->display();
    }

    //添加顶级分类视图
    Public function addTop () {
        $this->display();
    }

    //添加子分类视图
    Public function addChild () {
        $this->cate = M('Category')->find(I('pid','','intval'));
        //dump($this->cate);
        $this->display();
    }

    //添加分类表单处理
    Public function addCate () {
        $data['category_name'] = I('category_name');
        $data['pid'] = I('pid','','intval');
        $data['level'] = I('level','','intval')+1;

        if (M('Category')->data($data)->add()) {
            $this->success('添加成功', 'index');
        } else {
            $this->error('添加失败');
        }
    }

    //修改分类视图
    Public function edit () {
        $this->cate = M('Category')->find(I('id','','intval'));
        $this->display();
    }

    //修改分类操作
    Public function editCate () {
        if (M('Category')->save($_POST)) {
            $this->success('修改成功', 'index');
        } else {
            $this->error('修改失败');
        }
    }

    //删除分类
    Public function del () {
        $id = I('id','','intval');
        $cate = M('Category');
        $cateid = $cate->field(array('id', 'pid'))->select();
        $delid = get_all_child($cateid, $id);
        $delid[] = $id;

        $data = array('id' => array('IN', $delid));
        // dump($data);
        if (!$cate->where($data)->delete()) {
            $this->error('删除失败');
        }

        $this->success('删除成功', U('index'));
     }

    //获取商品分类下的商品信息
    public function goods_list(){

       if (IS_GET) {
        $id = I('id','','intval');          //商品分类ID
        $categoryGoods = M('Category_goods');
        $category = M('Category');
        $result = $categoryGoods->where('category_id=%d', $id)->field('id, category_id, goods_id')->select(); //取出该分类下的商品ID
        $good = $category->where('id=%d', $id)->find(); //取出该分类的信息
        //实例化歌曲类模型
        $goods = M('Goods');
        if ($result) {      //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['goods_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有商品时默认为null
        }

        $count = count($arr);// 查询满足要求的总记录数
        $num = 5;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result1 = $goods->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('goods_show',$result1);// 赋值数据集
        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->assign('good',$good);// 赋值分类信息输出;
        $this->display();
        
       } else {
        $this->error('非法请求!');
       }

    }
   
   //往商品分类中添加商品
    public function addGoods () {
    if (IS_POST) {
        $data['category_id'] = I('id','','intval');
        $check = I('check','','intval');
        // dump($check);
        $categoryGoods = M('Category_goods');
        foreach ($check as $key => $value) {
            $data['goods_id'] = $value;
            $result = $categoryGoods->add($data);
        }

        if ($result) {
            $this->success('添加商品成功!', U('Home/Category/goods_list',array('id'=>$data['category_id'])));
        } else {
            $this->error("添加商品失败!");
        }

    } else {
        $id = I('id','','intval');
        $categoryGoods = M('Category_goods');
        $category = M('Category');
        $good = $category->where('id=%d', $id)->find(); //取出该商品分类的信息
        $result = $categoryGoods->where('category_id=%d', $id)->field('id, category_id, goods_id')->select(); //取出该分类下的商品ID
        foreach ($result as $key => $value) {
            $arr[] = intval($value['goods_id']);
        }

        /*查询所有商品信息*/
        $goods=M("Goods");
        $goodslist=$goods->select();
        $list = array();
        //循环遍历商品信息,查看商品id是否在CategoryGoods表的goods_id里面
        for($i=0;$i<count($goodslist);$i++){
            $goodsid=$goodslist[$i]['id'];
            if(in_array($goodsid,$arr)){
                    $list[]=$goodsid;    //若存在,则将商品信息放到该数组中
            }
        }

        $where['id'] = array('NOT IN',$list);   //添加商品时取相反条件
        // dump($where['id'][1]);
        if ($where['id'][1]) {                  //防止没有结果集SQL语句报错
            $count = $goods->where($where)->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $goods->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
            
        } else {
            $count = $goods->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $goods->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

        }

          $show   = $page->show();// 分页显示输出
          
          $this->assign('goods_show',$result);// 赋值数据集
          $this->assign('count',$count);// 赋值数据集
          $this->assign('page',$show);// 赋值分页输出;
          $this->assign('good',$good);// 赋值好歌曲指定ID结果集;
          $this->display();
        }
    }

     //删除排行榜分类中的歌曲
    public function delGoods () {

        if (IS_GET) {
            $category_id = I('category_id','','intval');          //排行榜分类ID
            $goods_id = I('goods_id','','intval');     //歌曲ID
            $categoryGoods = M('Category_goods');
            $result = $categoryGoods->where("goods_id = %d and category_id = %d", array($goods_id,$category_id))->delete();
            if ($result) {
                $this->success('删除成功!',U('Home/Category/goods_list',array('id'=>$category_id)));
            } else {
                $this->error('删除失败!');
            }
        } else {
            $this->error('非法请求!');
        }
    }

}