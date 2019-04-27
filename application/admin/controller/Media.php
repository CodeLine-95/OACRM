<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Media as Medias;
use app\admin\model\Mediatype;
use app\admin\model\Platform;
class Media extends Base
{
	public function index()
	{
		if(request()->isPost()){

		}else{
			$list = (new Medias)->order('create_t','desc')->paginate(20);
			foreach ($list as $item) {
				$mediaType = (new Mediatype)->where('id',$item['type_id'])->find();
				$item->typename = $mediaType['typename'];
				$platform = (new Platform)->where('id',$item['platform_id'])->find();
				$item->platform = $platform['name'];
			}
			$this->assign('list',$list);
			return $this->fetch();
		}
	}
	// 添加账户
	public function add(){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			unset($data['type_hidden']);
			$data['create_t'] = time();
			$re = (new Medias)->insert($data);
			if($re){
				$return = array("msg"=>"添加账号成功",'icon'=>6);
			}else{
				$return = array("msg"=>"添加账号失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$typelist = (new Mediatype)->select();
			$this->assign('typelist',$typelist);
			return $this->fetch();
		}
	}
	// 删除账号
	public function del()
	{
		$id = input('post.id');
		$re = (new Medias)->where('id',$id)->delete();
		if($re){
			$return = array('msg'=>"删除账户成功",'icon'=>6);
		}else{
			$return = array('msg'=>"删除账户失败",'icon'=>5);
		}
		return json_encode($return);
	}
	// 编辑账号
	public function update($id=0){
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['id'] = intval($data['id']);
			$data['create_t'] = time();
			unset($data['platform']);
			$re = (new Medias)->update($data);
			if($re){
				$return = array("msg"=>"编辑账号成功",'icon'=>6);
			}else{
				$return = array("msg"=>"编辑账号失败",'icon'=>5);
			}
			return json_encode($return);
		}else{
			$typelist = (new Mediatype)->select();
			$this->assign('typelist',$typelist);
			$media = (new Medias)->where('id',$id)->find();
			$this->assign('media',$media);
			return $this->fetch();
		}
	}
	// 账号类型
	public function typelist()
	{
		if(request()->isPost()){

		}else{
			$list = (new Mediatype)->select();
			$this->assign('list',$list);
			return $this->fetch();
		}
	}
	// 添加账号类型
	public function addtype()
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$data['createtime'] = time();
			$re = (new Mediatype)->insert($data);
			if($re){
				$return = array("msg"=>"添加账号类型成功","icon"=>6);
			}else{
				$return = array("msg"=>"添加账号类型失败","icon"=>5);
			}
			return json_encode($return);
		}else{
			return $this->fetch();
		}
	}
	// 编辑账号类型
	public function updatetype($id=0)
	{
		if(request()->isPost()){
			$data = json_decode(input('post.data'),true);
			$re = (new Mediatype)->update($data);
			if($re){
				$return = array("msg"=>"编辑账号类型成功","icon"=>6);
			}else{
				$return = array("msg"=>"编辑账号类型失败","icon"=>5);
			}
			return json_encode($return);
		}else{
			$type = (new Mediatype)->where('id',$id)->find();
			$this->assign('type',$type);
			return $this->fetch();
		}
	}
	// 删除账号类型
	public function deltype()
	{
		$id = input('post.id');
		$re = (new Mediatype)->where('id',$id)->delete();
		if($re){
			$return = array('msg'=>"删除账户类型成功",'icon'=>6);
		}else{
			$return = array('msg'=>"删除账户类型失败",'icon'=>5);
		}
		return json_encode($return);
	}
	//账号平台
	public function platform(){
		$list = (new Platform)->field(true)->select();
		foreach ($list as $item) {
			$mediaType = (new Mediatype)->where('id',$item['type_id'])->find();
			$item->type_name = $mediaType['typename'];
		}
		$this->assign('list',$list);
		return $this->fetch();
	}
	//添加账号平台
	public function platformadd(){
		if (request()->isPost()) {
			$post = json_decode(input('post.data'),true);
			$post['create_t'] = time();
			if ((new Platform)->save($post)) {
				$return = ['msg'=>'添加账号平台成功','icon'=>6];
			}else{
				$return = ['msg'=>'添加账号平台失败','icon'=>5];
			}
			return json_encode($return);
		}else{
			$mediaType = (new Mediatype)->select();
			$this->assign('mediaType',$mediaType);
			return $this->fetch();
		}
	}
	//编辑账号平台
	public function platformedit(){
		if (request()->isPost()) {
			$post = json_decode(input('post.data'),true);
			$post['create_t'] = time();
			if ((new Platform)->update($post)) {
				$return = ['msg'=>'修改账号平台成功','icon'=>6];
			}else{
				$return = ['msg'=>'修改账号平台失败','icon'=>5];
			}
			return json_encode($return);
		}else{
			$id = input('id');
			$field = (new Platform)->where('id',$id)->find();
			$this->assign('field',$field);
			$mediaType = (new Mediatype)->select();
			$this->assign('mediaType',$mediaType);
			return $this->fetch();
		}
	}
	// 删除账号平台
	public function platformdel(){
		$id = input('post.id');
		$re = (new Platform)->where('id',$id)->delete();
		if($re){
			$return = array('msg'=>"删除账号平台成功",'icon'=>6);
		}else{
			$return = array('msg'=>"删除账号平台失败",'icon'=>5);
		}
		return json_encode($return);
	}

}
