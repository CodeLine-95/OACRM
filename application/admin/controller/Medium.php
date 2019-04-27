<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Medium as Mediums;
use app\admin\model\Sitetype;
use app\admin\model\Siteyewu;
class Medium extends Base
{
	public function index(){
		$list = (new Mediums)->order('create_t','desc')->select();
		foreach ($list as $item) {
			$typelist = (new Sitetype)->where(['id'=>['in',$item['type_id']]])->select();
			$item->typeList = $typelist;
		}
		$this->assign('list',$list);
		return $this->fetch();
	}
	//公司供应商
	public function commpany(){
		$list = (new Mediums)->where('nature',1)->order('create_t','desc')->select();
		foreach ($list as $item) {
			$typelist = (new Sitetype)->where(['id'=>['in',$item['type_id']]])->select();
			$item->typeList = $typelist;
		}
		$this->assign('list',$list);
		return $this->fetch();
	}
	//个人供应商
	public function individual(){
		$list = (new Mediums)->where('nature',2)->order('create_t','desc')->select();
		foreach ($list as $item) {
			$typelist = (new Sitetype)->where(['id'=>['in',$item['type_id']]])->select();
			$item->typeList = $typelist;
		}
		$this->assign('list',$list);
		return $this->fetch();
	}
	// 添加供应商
	public function add(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$one_name = $one_num = $sectors_name = [];
			foreach($data as $key=>$value){
				if (strpos($key,'sectors_name[name') !== false) {
					$one_name[] = $value;
					unset($data[$key]);
				}else{
					continue;
				}
			}
			foreach($data as $key=>$value){
				if (strpos($key,'sectors_name[num') !== false) {
					$one_num[] = $value;
					unset($data[$key]);
				}else{
					continue;
				}
			}
			for($i=0;$i<=2;$i++){
				$sectors_name[$i]['name'] = $one_name[$i];
				$sectors_name[$i]['num'] = $one_num[$i];
			}
			$data['sectors_name'] = json_encode($sectors_name);
			$data['create_t'] = time();
			unset($data['yewuleixing'],$data['yewuneirong'],$data['file']);
			if ((new Mediums)->save($data)) {
				$return = ['msg'=>'添加供应商成功','icon'=>6];
			}else{
				$return = ['msg'=>'添加供应商失败','icon'=>5];
			}
			return json_encode($return);
		}else{
			$typelist = (new Sitetype)->select();
			$type = (new Sitetype)->find();
			$yewu = (new Siteyewu)->where('typeid',$type['id'])->select();
			$this->assign('type',$type);
			$this->assign('typelist',$typelist);
			$this->assign('yewu',$yewu);
			return $this->fetch();
		}
	}
	// 编辑供应商
	public function update(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$one_name = $one_num = $sectors_name = [];
			foreach($data as $key=>$value){
				if (strpos($key,'sectors_name[name') !== false) {
					$one_name[] = $value;
					unset($data[$key]);
				}else{
					continue;
				}
			}
			foreach($data as $key=>$value){
				if (strpos($key,'sectors_name[num') !== false) {
					$one_num[] = $value;
					unset($data[$key]);
				}else{
					continue;
				}
			}
			for($i=0;$i<=2;$i++){
				$sectors_name[$i]['name'] = $one_name[$i];
				$sectors_name[$i]['num'] = $one_num[$i];
			}
			$data['sectors_name'] = json_encode($sectors_name);
			unset($data['yewuleixing'],$data['yewuneirong'],$data['file']);
			if ((new Mediums)->update($data)) {
				$return = ['msg'=>'修改供应商成功','icon'=>6];
			}else{
				$return = ['msg'=>'修改供应商失败','icon'=>5];
			}
			return json_encode($return);
		}else{
			$id = input('id');
			$field = (new Mediums)->where('id',$id)->find();
			$field['sectors_name'] = json_decode($field['sectors_name'],true);
			$type_one = explode(',',$field['type_id']);
			$this->assign('type_one',$type_one);
			$this->assign('field',$field);
			$typelist = (new Sitetype)->select();
			$type = (new Sitetype)->find();
			$yewu = (new Siteyewu)->where('typeid',$type['id'])->select();
			$this->assign('type',$type);
			$this->assign('typelist',$typelist);
			$this->assign('yewu',$yewu);
			return $this->fetch();
		}
	}
	//供应商详情
	public function show(){
		$id = input('id');
		$field = (new Mediums)->where('id',$id)->find();
		$field['sectors_name'] = json_decode($field['sectors_name'],true);
		$type_one = explode(',',$field['type_id']);
		$this->assign('type_one',$type_one);
		$this->assign('field',$field);
		$typelist = (new Sitetype)->select();
		$type = (new Sitetype)->find();
		$yewu = (new Siteyewu)->where('typeid',$type['id'])->select();
		$this->assign('type',$type);
		$this->assign('typelist',$typelist);
		$this->assign('yewu',$yewu);
		return $this->fetch();
	}
	// 删除供应商
	public function del(){
		$id = input('post.id');
		if(Mediums::destroy($id)){
			$return = array("msg"=>"删除供应商成功","icon"=>6);
		}else{
			$return = array("msg"=>"删除供应商失败","icon"=>5);
		}
		return json_encode($return);
	}
	// 供应商业务类型列表
	public function business(){
		if(request()->isPost()){

		}else{
		  $data = [
   	  	'type'=>"",
   	  	'value'=>""
   	  ];
   	  $list = (new Sitetype)->order('id','desc')->select();
   	  foreach ($list as $key => $value) {
   	  	$yewu = (new Siteyewu)->where('typeid',$value['id'])->select();
   	  	$name="";
   	  	foreach ($yewu as $k => $v) {
   	  		$name.=$v['name']."&nbsp;&nbsp;";
   	  	}
   	  	$value['name'] = $name;
   	  }
   	  $this->assign('list',$list);
   	  $this->assign('data',$data);
		  return $this->fetch();
		}
	}
	// 供应商业务类型添加
	public function addtype(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['createtime'] = time();
			$re = (new Sitetype)->insert($data);
			if($re){
				$return = array('msg'=>"添加业务类型成功",'icon'=>6);
			}else{
				$return = array('msg'=>"添加业务类型失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			return $this->fetch();
		}
	}
	// 供应商业务类型编辑
	public function updatetype($id=0){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Sitetype)->update($data);
			if($re){
				$return = array('msg'=>"编辑业务类型成功",'icon'=>6);
			}else{
				$return = array('msg'=>"编辑业务类型失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$type = (new Sitetype)->where('id',$id)->find();
			$this->assign('type',$type);
			return $this->fetch();
		}
	}
	// 供应商业务类型删除
	public function deltype(){
		$id = input('post.id');
		if(Sitetype::destroy($id)){
			$return = array("msg"=>"删除业务类型成功","icon"=>6);
		}else{
			$return = array("msg"=>"删除业务类型失败","icon"=>5);
		}
		return json_encode($return);
	}
	// 业务标签列表
	public function yewu(){
		if(request()->isPost()){

		}else{
			$list = (new Siteyewu)->order('id','desc')->select();
			foreach ($list as $key => $value) {
				$type = (new Sitetype)->where('id',$value['typeid'])->find();
				$value['typename'] = $type['typename'];
			}
			$data = [
	   	  	'type'=>"",
	   	  	'value'=>""
	   	  	];
	   	  	$this->assign('data',$data);
			$this->assign('list',$list);
			return $this->fetch();
		}
	}
	// 添加业务标签
	public function addyewu(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['createtime'] = time();
			$re = (new Siteyewu)->insert($data);
			if($re){
				$return = array('msg'=>"添加业务标签成功",'icon'=>6);
			}else{
				$return = array('msg'=>"添加业务标签失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$list = (new Sitetype)->select();
			$this->assign('list',$list);
			return $this->fetch();
		}
	}
	// 编辑业务标签
	public function updateyewu($id=0){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Siteyewu)->update($data);
			if($re){
				$return = array('msg'=>"编辑业务标签成功",'icon'=>6);
			}else{
				$return = array('msg'=>"编辑业务标签失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$yewu = (new Siteyewu)->where('id',$id)->find();
			$list = (new Sitetype)->select();
			$this->assign('list',$list);
			$this->assign('yewu',$yewu);
			return $this->fetch();
		}
	}
	// 删除业务标签
	public function delyewu(){
		$id = input('post.id');
		if(Siteyewu::destroy($id)){
			$return = array("msg"=>"删除业务标签成功","icon"=>6);
		}else{
			$return = array("msg"=>"删除业务标签失败","icon"=>5);
		}
		return json_encode($return);
	}
}
