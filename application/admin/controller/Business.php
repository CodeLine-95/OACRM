<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Project as ProjectModel;
use app\admin\model\Business as BusinessModel;
use app\admin\model\Server as ServerModel;
class Business extends Base
{
   public function index(){
     if(request()->isPost()){
       $post = input('post.');
       if ($post['search_id'] == 1) {
         $where = [
           'b.name'  => ['like','%'.$post['value'].'%']
         ];
       }elseif ($post['search_id'] == 2) {
         $where = [
           'b.firm_url'  => ['like','%'.$post['value'].'%']
         ];
       }elseif ($post['search_id'] == 3){
         $where = [
           'b.firm_sale'  => ['like','%'.$post['value'].'%']
         ];
       }else{
         $where = [
           'b.firm_answer'  => ['like','%'.$post['value'].'%']
         ];
       }
       $Business = (new BusinessModel)->alias('b')->join('crm_project t','b.project_id = t.id')->field('b.*,t.name as project')->where($where)->order('b.firm_create_t','desc')->select();
     }else{
       $Business = (new BusinessModel)->alias('b')->join('crm_project t','b.project_id = t.id')->field('b.*,t.name as project')->order('b.firm_create_t','desc')->select();
     }
     $this->assign('business',$Business);
   	 return $this->fetch();
   }

   public function add(){
     if (request()->isPost()) {
       $post = json_decode(input('post.data'),true);
       $post['firm_create_t'] = time();
       if((new BusinessModel)->save($post)){
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
       $projects = (new ProjectModel)->field(true)->order('create_t','desc')->select();
       $this->assign('projects',$projects);
       return $this->fetch();
     }
   }

   public function edit(){
     if (request()->isPost()) {
       $post = json_decode(input('post.data'),true);
       if((new BusinessModel)->update($post)){
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
       $field = (new BusinessModel)->where('id',$id)->find();
       $servers = (new ServerModel)->field(true)->where('business_id',$field['id'])->order('create_t','desc')->select();
       $this->assign('servers',$servers);
       $this->assign('field',$field);
       $projects = (new ProjectModel)->field(true)->order('create_t','desc')->select();
       $this->assign('projects',$projects);
       return $this->fetch();
     }
   }

   // 查看详情
   public function show($id)
   {
   	   $field = (new BusinessModel)->where('id',$id)->find();
       $servers = (new ServerModel)->field(true)->where('business_id',$field['id'])->order('create_t','desc')->select();
       $this->assign('servers',$servers);
       $this->assign('field',$field);
       $projects = (new ProjectModel)->where('id',$field['project_id'])->find();
       $this->assign('projects',$projects);
       return $this->fetch();
   }

   public function del(){
 		$id = input('id');
 		if (BusinessModel::destroy($id)) {
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

  //服务内容列表
  public function serlist(){
    $ServerModel = new ServerModel();
    if(request()->isPost()){
      $post = input('post.');
      if ($post['business_id'] == 0) {
        $where['business_id'] = ['>',0];
      }else{
        $where['business_id'] = $post['business_id'];
      }
      if($post['value'] != ''){
        $where['name'] = $post['value'];
      }
      $servers = $ServerModel->field(true)->where($where)->order('create_t','desc')->paginate(20);
      $selected = $post['business_id'];
    }else {
      $servers = $ServerModel->field(true)->order('create_t','desc')->paginate(20);
      $selected = 0;
    }
    foreach($servers as $s){
      //业务id
      $buss = (new BusinessModel)->where('id',$s['business_id'])->find();
      $s->business = $buss['name'];
      //项目
      $project = (new ProjectModel)->where('id',$buss['project_id'])->find();
      $s->project = $project['name'];
    }
    $this->assign('servers',$servers);
    $this->assign('selected',$selected);
    //全部业务
    $business = (new BusinessModel)->select();
    $this->assign('business',$business);
    return $this->fetch();
  }

  public function seradd(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $post['create_t'] = time();
      if((new ServerModel)->save($post)){
        $return = ['msg'=>'添加成功','icon'=>6];
      }else{
        $return = ['msg'=>'添加失败','icon'=>5];
      }
      return json_encode($return);
    }else{
      //全部业务
      $business = (new BusinessModel)->select();
      $this->assign('business',$business);
      return $this->fetch();
    }
  }

  public function seredit(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $post['create_t'] = time();
      if((new ServerModel)->update($post)){
        $return = ['msg'=>'修改成功','icon'=>6];
      }else{
        $return = ['msg'=>'修改失败','icon'=>5];
      }
      return json_encode($return);
    }else{
      //全部业务
      $business = (new BusinessModel)->select();
      $this->assign('business',$business);

      $id = input('id');
      $field = (new ServerModel)->where('id',$id)->find();
      $this->assign('field',$field);
      return $this->fetch();
    }
  }

  public function serdel(){
    $id = input('id');
 		if (ServerModel::destroy($id)) {
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
