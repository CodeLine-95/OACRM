<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Industry as inModel;
use app\admin\model\IndustryCate as inCateModel;
class Industry extends Base
{
  public function index(){
    $inModel = new inModel();
    $catelist = $inModel->field(true)->select();
    foreach ($catelist as $one) {
      $inCateModel = new inCateModel();
      $cate_one = $inCateModel->where('id',$one['cate_id'])->find();
      $one->catename = $cate_one['name'];
    }
    $this->assign('catelist',$catelist);
    return $this->fetch();
  }

  //行业类型添加
  public function add(){
    if (request()->isPost()) {
      $inModel = new inModel();
      $post = json_decode(input('post.data'),true);
      if($inModel->save($post)){
        $data = [
          'msg'   =>   '添加成功',
          'icon'  =>   6
        ];
      }else{
        $data = [
          'msg'   =>   '添加失败',
          'icon'  =>   5
        ];
      }
      return json_encode($data);
    }else{
      $inCateModel = new inCateModel();
      $catelist = $inCateModel->field(true)->select();
      $this->assign('catelist',$catelist);
      return $this->fetch();
    }
  }
  //行业类型编辑
  public function edit(){
    if (request()->isPost()) {
      $inModel = new inModel();
      $post = json_decode(input('post.data'),true);
      if($inModel->update($post)){
        $data = [
          'msg'   =>   '编辑成功',
          'icon'  =>   6
        ];
      }else{
        $data = [
          'msg'   =>   '编辑失败',
          'icon'  =>   5
        ];
      }
      return json_encode($data);
    }else{
      $inCateModel = new inCateModel();
      $inModel = new inModel();
      $catelist = $inCateModel->field(true)->select();
      $this->assign('catelist',$catelist);
      $id = input('id');
      $field = $inModel->where('id',$id)->find();
      $this->assign('field',$field);
      return $this->fetch();
    }
  }

  //行业删除
  public function del(){
   $id = input('id');
   if (inModel::destroy($id)) {
     $data = [
         'msg'  => '删除成功',
         'icon' => 6
     ];
   }else{
     $data = [
         'msg'  => '删除失败',
         'icon' => 5
     ];
   }
   return json_encode($data);
 }

  // 行业分类列表
  public function catelist(){
    $inCateModel = new inCateModel();
    $catelist = $inCateModel->field(true)->select();
    $this->assign('catelist',$catelist);
    return $this->fetch();
  }

  //行业分类创建
  public function cateadd(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $inCateModel = new inCateModel();
      if($inCateModel->save($post)){
        $data = [
          'msg'   =>   '添加成功',
          'icon'  =>   6
        ];
      }else{
        $data = [
          'msg'   =>   '添加失败',
          'icon'  =>   5
        ];
      }
      return json_encode($data);
    }else{
      return $this->fetch();
    }
  }
  //行业分类编辑
  public function cateedit(){
    $inCateModel = new inCateModel();
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      if($inCateModel->update($post)){
        $data = [
          'msg'   =>   '编辑成功',
          'icon'  =>   6
        ];
      }else{
        $data = [
          'msg'   =>   '编辑失败',
          'icon'  =>   5
        ];
      }
      return json_encode($data);
    }else{
      $id = input('id');
      $field = $inCateModel->where('id',$id)->find();
      $this->assign('field',$field);
      return $this->fetch();
    }
  }
  //行业分类删除
  public function catedel(){
   $id = input('id');
   if (inCateModel::destroy($id)) {
     $data = [
         'msg'  => '删除成功',
         'icon' => 6
     ];
   }else{
     $data = [
         'msg'  => '删除失败',
         'icon' => 5
     ];
   }
   return json_encode($data);
 }
}
