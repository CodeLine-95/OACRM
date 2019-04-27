<?php
namespace app\index\controller;
use app\admin\model\Medium as Mediums;
use app\admin\model\Sitetype;
use app\admin\model\Siteyewu;
use app\admin\model\Client;
use think\Controller;
class Index extends Controller
{
	//管家首页
	public function index(){
		return $this->fetch();
	}
	//供应商页面
	public function supplier(){
		return $this->fetch();
	}
	//客户信息页面
	public function order(){
		return $this->fetch();
	}
	// 供应商业务类型数据
	public function addIndex(){
    $data = (new Sitetype)->field('id,typename')->select();
    msg('2','ok',$data);
	}
  /*
    添加供应商提交方法
    接收请求：post
    返回添加请求信息
   */
  public function addAction(){
    if (request()->isPost()) {
      $data = input('post.');
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
			$data['status'] = 0;
			$data['rate'] = 0;
      if ((new Mediums)->save($data)) {
        msg('2','添加供应商成功！！');
      }else{
        msg('4','添加供应商失败！！');
      }
    }else{
      msg('4','请使用post请求访问！');
    }

  }

  //客户订单相关显示数据
  public function addserviceindex(){
    $data = array();
    // 渠道类型
    $data['ditch'] = db('ditch')->field('id,typename')->select();
    // 所属项目
    $data['project'] = db('project')->field('id,name')->select();
    // 精准状态
    $data['kv'] = db('kv')->field('id,name')->where('servicename','客服')->select();
    $data['uid'] = 0;
    msg('2','ok',$data);
  }
  /*
    添加客户信息提交方法
    接收请求：post
    返回添加请求信息
   */
  public function addservice(){
    if(request()->isPost()){
      $data = input('post.');
      $data['uid'] = $data['service_id'];
      unset($data['service_id']);
      $data['create_t'] = time();
      $data['update_t'] = time();
      $data['order_id'] = 26;
      $res = db('client')->where('phone',$data['phone'])->find();
      if ($res) {
        msg('4','客户信息已存在，请不要重复添加！！');
      }else{
        if((new Client)->save($data)){
          msg('2','添加订单成功！！');
        }else{
          msg('4','添加订单失败！！');
        }
      }
    }else{
      msg('4','请使用post请求访问！');
    }
  }
}
