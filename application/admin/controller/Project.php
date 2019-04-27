<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Project as ProjectModel;
class Project extends Base
{
   public function index(){
     if(request()->isPost()){
       $post = input('post.');
       if ($post['search_id'] == 1) {
         $where = [
           'name'  => ['like','%'.$post['value'].'%']
         ];
       }elseif ($post['search_id'] == 2) {
         $where = [
           'website'  => ['like','%'.$post['value'].'%']
         ];
       }else{
         $where = [
           'head'  => ['like','%'.$post['value'].'%']
         ];
       }
       $projects = (new ProjectModel)->field(true)->where($where)->order('create_t','desc')->select();
     }else{
       $projects = (new ProjectModel)->field(true)->order('create_t','desc')->select();
     }
     $this->assign('projects',$projects);
   	 return $this->fetch();
   }

   public function add(){
     if (request()->isPost()) {
       $post = json_decode(input('post.data'),true);
       $post['create_t'] = time();
       if((new ProjectModel)->save($post)){
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

   public function edit(){
     if (request()->isPost()) {
       $post = json_decode(input('post.data'),true);
       if((new ProjectModel)->update($post)){
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
       $field = (new ProjectModel)->where('id',$id)->find();
       $this->assign('field',$field);
       return $this->fetch();
     }
   }

   public function del(){
 		$id = input('id');
 		if (ProjectModel::destroy($id)) {
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
