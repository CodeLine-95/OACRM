<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Admin;
use think\Cache;
use app\admin\model\Rule;
use app\admin\model\Backlog as BacklogNodel;
class Index extends Base
{
	// 首页
    public function index()
    {
      $user = (new Admin)->field(true)->where('id',$this->user['uid'])->find();
      $this->assign('user',$user);
      $backlogs = (new BacklogNodel)->field(true)->where(['user_id'=>$this->user['uid'],'read_status'=>0])->count();
      $this->assign('backlogs',$backlogs);
      if ($this->user['uid'] == 1) {
        $notice = db('notice')->where(['read_id'=>0])->count();
      }else{
        $notice = db('notice')->where(['read_id'=>0,'user_id'=>$this->user['uid']])->count();
      }
      $this->assign('notice',$notice);
      return $this->fetch();
    }
    // 控制台数据统计
    public function console()
    {
      $backlogs = (new BacklogNodel)->field(true)->where(['user_id'=>$this->user['uid'],'read_status'=>0])->count();
      $this->assign('backlogs',$backlogs);
    	return $this->fetch();
    }
    // 权限控制台
    public function authority()
    {
    	if(request()->isPost()){

    	}else{
    		return $this->fetch();
    	}
    }
    public function password()
    {
      if(request()->isPost()){
        $data = input('post.');
        $user= session('user');
        $pass =  cms_pwd_encode($data['pass']);
        $re = (new Admin)->where('id',$user['uid'])->update(array('user_pwd'=>$pass));
        if($re){
            $return = array('msg'=>"更改密码成功",'icon'=>6);
        }else{
            $return = array('msg'=>"更改密码失败",'icon'=>5);
        }
        return json_encode($return);
      }else{
        return $this->fetch();
      }
    }
    // 用户密码修改
    public function member(){
      if(request()->isPost()){
        $data = json_decode(input('post.data'),true);
        var_dump($data);exit();
        $data['create_time']=time();
        $re = (new Admin)->update($data);
        if($re){
        	$return = array("msg"=>"用户编辑成功","icon"=>6);
        }else{
        	$return = array("msg"=>"用户编辑失败","icon"=>5);
        }
        return json_encode($return);
      }else{
        $user= session('user');
        $member = (new Admin)->where('id',$user['uid'])->find()->toArray();
        $this->assign("member",$member);
        return $this->fetch();
      }
    }
}
