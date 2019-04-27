<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Sectors as Sectorse;
use app\admin\model\Business as BusinessModel;
use app\admin\model\Project as ProjectModel;
use app\admin\model\Citys;
class Sectors extends Base
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
	            $pro = (new ProjectModel)->where($where1)->select();
	            foreach ($pro as $key => $value) {
	             	$id[$key] = $value['id'];
	            }
	            $where = [
	             'projects'  => ['in',$id]
	            ];
		   	}elseif($type==3){
		   		$where = [
	             'author'  => ['like','%'.$data['value'].'%']
	            ];
		   	}elseif($type==4){
		   		$where = [
	             'tel'  => ['like','%'.$data['value'].'%']
	            ];
		   	}elseif($type==5){
		   		$where1 = [
	             'name'  => ['eq',$data['value']]
	            ];
		   		$citt = (new Citys)->where($where1)->where('type',1)->find();
		   		$where = [
	             'city'  => ['eq',$citt['id']]
	            ];
		   	}elseif($type==6){
		   		if($data['value']=="开启"){
		   			$status = 1;
		   		}else{
		   			$status = 0;
		   		}
		   		$where = [
	             'status'  => ['eq',$status]
	            ];
		   	}elseif($type==7){
		   		$where = [
	             'desc'  => ['like','%'.$data['value'].'%']
	            ];
		   	}
		   	  $list = (new Sectorse)->where($where)->select();
		}else{
			$list = (new Sectorse)->select();
		}
		$project = (new ProjectModel)->select();
		foreach ($list as $key => $value) {
			$pro =  (new ProjectModel)->where('id',$value['projects'])->find();
			$value['project'] = $pro['name'];
			$arr = explode(",",$value['business']);
			foreach ($arr as $k => $v) {
				$bubu = (new BusinessModel)->where('id',$v)->find();
				$bu[$k] = $bubu['name'];
			}
			$value['bubu'] = $bu;
			$city = (new Citys)->where('id',$value['city'])->find();
			$value['city'] = $city['name'];
			if(mb_strlen($value['desc'])>10){
					$value['desc'] = mb_substr($value['desc'],0,10,'utf-8')."......";
			}
		}
		$data = ['type'=>"",'value'=>""];
		$this->assign('data',$data);
		$this->assign('list',$list);
		$this->assign('project',$project);
		return $this->fetch();
	}
	// 添加部门
	public function add(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Sectorse)->insert($data);
			if($re){
				$return = array("msg"=>"添加部门成功",'icon'=>6);
			}else{
				$return = array("msg"=>"添加部门失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$project = (new ProjectModel)->select();
			$proone  = (new ProjectModel)->find();
			$buslist = (new BusinessModel)->where('project_id',$proone['id'])->select();
			$city = (new Citys)->where('type',1)->select();
			$this->assign('city',$city);
			$this->assign('buslist',$buslist);
			$this->assign('project',$project);
			$this->assign('proone',$proone);
			return $this->fetch();
		}
	}
	// 删除部门
	public function del()
	{
		$id = input('post.id');
		if(Sectorse::destroy($id)){
			$return = array("msg"=>"删除部门成功","icon"=>6);
		}else{
			$return = array("msg"=>"删除部门失败","icon"=>5);
		}
		return json_encode($return);
	}
	// 编辑部门
	public function update($id=0)
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Sectorse)->update($data);
			if($re){
				$return = array("msg"=>"编辑部门成功",'icon'=>6);
			}else{
				$return = array("msg"=>"编辑部门失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$sec = (new Sectorse)->where('id',$id)->find();
			$project = (new ProjectModel)->select();
			$proone  = (new ProjectModel)->find();
			$buslist = (new BusinessModel)->where('project_id',$proone['id'])->select();
			$city = (new Citys)->where('type',1)->select();
			$arr = explode(",",$sec['business']);
			$this->assign('arr',$arr);
			$this->assign('sec',$sec);
			$this->assign('city',$city);
			$this->assign('buslist',$buslist);
			$this->assign('project',$project);
			$this->assign('proone',$proone);
			return $this->fetch();
		}
	}

	//部门详情
	public function show(){
		$id = input('id');
		$field = (new Sectorse)->where('id',$id)->find();
		//城市
		if($field['city'] == 0){
			$field->city = '全国';
		}else{
			$city = (new Citys)->where('id',$field['city'])->find();
			$field->city = $city['name'];
		}
		//项目
		$project = (new ProjectModel)->where('id',$field['projects'])->find();
		$field->projects = $project['name'];
		//业务
		$bus =  (new BusinessModel)->where(['project_id'=>['in',$field['projects']]])->select();
		$bustr = '';
		foreach ($bus as $b){
			$bustr .= $b['name'].'&nbsp;&nbsp;&nbsp;';
		}
		$field['business'] = $bustr;
		$this->assign('field',$field);
		return $this->fetch();
	}
}
