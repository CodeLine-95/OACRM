<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Integral as Integrals;
class Integral extends Base
{
	public function index()
	{
	   if(request()->isPost()){
	   	  $data = input('post.');
	   	  $type = $data['type'];
	   	  if($type==1){
	   	  	$where = [
             'type'  => ['like','%'.$data['value'].'%']
            ];
	   	  }elseif($type==2){
	   	  	$where = [
              'score'  => ['like','%'.$data['value'].'%']
            ];
	   	  }else{
	   	  	$where = [
              'desc'  => ['like','%'.$data['value'].'%']
            ];
	   	  }
	   	  $list = (new Integrals)->where($where)->select();
	   }else{
	   	  $list = (new Integrals)->select();
	   	  $data = [
	   	  	'type'=>"",
	   	  	'value'=>""
	   	  ];
	   }
	   $this->assign('data',$data);
	   $this->assign('list',$list);
	   return $this->fetch();
	}
	// 添加积分规则
	public function add()
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['create_t'] = time();
			$re = (new Integrals)->insert($data);
			if($re){
				$return = array('msg'=>"添加积分规则成功",'icon'=>6);
			}else{
				$return = array('msg'=>"添加积分规则失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			return $this->fetch();
		}
	}
	// 删除积分规则
	public function del()
	{
		$id = input('id');
		var_dump($id);exit();
		// if(Integrals::destroy($id)){
		// 	$return = array("msg"=>"删除积分规则成功","icon"=>6);
		// }else{
		// 	$return = array("msg"=>"删除积分规则失败","icon"=>5);
		// }
		// return json_encode($return);
	}
	// 编辑积分规则
	public function update($id=0)
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Integrals)->update($data);
			if($re){
				$return = array('msg'=>"编辑积分规则成功",'icon'=>6);
			}else{
				$return = array('msg'=>"编辑积分规则失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$int = (new Integrals)->where('id',$id)->find();
			$this->assign('int',$int);
			return $this->fetch();
		}
	}
}