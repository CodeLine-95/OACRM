<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Quarters as Quarterse;
use app\admin\model\Project as ProjectModel;
use app\admin\model\Sectors as Sectorse;
use app\admin\model\Business as BusinessModel;
class Quarters extends Base
{

	public function index()
	{
		if(request()->isPost()){
			$data = input('post.');
		   	$type = $data['type'];
		   	$id = array();
		   	if($type==1){
		   	  	$where = [
	             'name'  => ['like','%'.$data['value'].'%']
	            ];
		   	}elseif($type==2){
		   	  	$where1 = [
	              'name'  => ['like','%'.$data['value'].'%']
	            ];
	            $sec = (new Sectorse)->where($where1)->select();
	            foreach ($sec as $key => $value) {
	             	$id[$key] = $value['id'];
	            }
	            $where = [
	             'sectors_id'  => ['in',$id]
	            ];
		   	}elseif($type==3){
		   		$where1 = [
	              'name'  => ['like','%'.$data['value'].'%']
	            ];
	            $pro = (new ProjectModel)->where($where1)->select();
	            foreach ($pro as $key => $value) {
	             	$id[$key] = $value['id'];
	            }
	            $where = [
	             'project_id'  => ['in',$id]
	            ];
		   	}elseif($type==4){
		   		if($data['value']=="全职"){
		   			$type = 1;
		   		}else{
		   			$type = 0;
		   		}
		   		$where = [
	             'type'  => ['eq',$type]
	            ];
		   	}
		   	$list = (new Quarterse)->where($where)->select();
		}else{
			$list = (new Quarterse)->select();
		}
		foreach ($list as $key => $value) {
			$sectors = (new Sectorse)->where('id',$value['sectors_id'])->find();
			$project = (new ProjectModel)->where('id',$value['project_id'])->find();
			$value['sec'] = $sectors['name'];
			$value['pro'] = $project['name'];
			if(mb_strlen($value['desc'])>10){
					$value['desc'] = mb_substr($value['desc'],0,10,'utf-8')."......";
			}
		}
		$data = ['type'=>"",'value'=>""];
		$this->assign('data',$data);
		$this->assign('list',$list);
		return $this->fetch();
	}
	// 添加岗位
	public function add()
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['createtime'] = time();
			$re = (new Quarterse)->insert($data);
			if($re){
				$return = array("msg"=>"添加岗位成功",'icon'=>6);
			}else{
				$return = array("msg"=>"添加岗位失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$list = (new Sectorse)->select();
			$secone = (new Sectorse)->find();
			$project = (new ProjectModel)->where('id ',$secone['projects'])->select();
			$this->assign('list',$list);
			$this->assign('project',$project);
			return $this->fetch();
		}
	}
	// 编辑岗位
	public function update($id=0)
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Quarterse)->update($data);
			if($re){
				$return = array("msg"=>"编辑岗位成功",'icon'=>6);
			}else{
				$return = array("msg"=>"编辑岗位失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$list = (new Sectorse)->select();
			$qua = (new Quarterse)->where('id',$id)->find();
			$secone = (new Sectorse)->where('id',$qua['project_id'])->find();
			$project = (new ProjectModel)->where('id ',$secone['projects'])->select();
			$this->assign('qua',$qua);
			$this->assign('list',$list);
			$this->assign('project',$project);
			return $this->fetch();
		}
	}

	// 编辑岗位
	public function show($id=0)
	{
		$list = (new Sectorse)->select();
		$qua = (new Quarterse)->where('id',$id)->find();
		$secone = (new Sectorse)->where('id',$qua['project_id'])->find();
		$project = (new ProjectModel)->where('id ',$secone['projects'])->select();
		$this->assign('qua',$qua);
		$this->assign('list',$list);
		$this->assign('project',$project);
		return $this->fetch();
	}
	// 删除岗位
	public function del()
	{
		$id = input('post.id');
		if(Quarterse::destroy($id)){
			$return = array("msg"=>"删除岗位成功","icon"=>6);
		}else{
			$return = array("msg"=>"删除岗位失败","icon"=>5);
		}
		return json_encode($return);
	}
}
