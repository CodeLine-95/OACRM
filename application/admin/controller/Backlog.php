<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Backlog as BacklogNodel;
use app\admin\model\Followup as FollowupModel;
use app\admin\model\Client;
use app\admin\model\Admin;
use think\Queue;
class Backlog extends Base
{
  public function backlogs($where = '',$whereor = ''){
    $backlogs = (new BacklogNodel)->field(true)->where($where)->order('creates_time','desc')->select();
    foreach ($backlogs as $back) {
      $follow = (new FollowupModel)->where('backlog_id',$back['id'])->order('create_t','desc')->find();
      if($follow){
        $client = (new Client)->where('id',$follow['client_id'])->find();
        $back->client_name = $client['name'];
        $back->client_id = $client['id'];
      }else{
        $user = (new Admin)->where('id',$back['user_id'])->find();
        $back->client_name = $user['user_name'];
        $back->client_id = 0;
      }
      $user = (new Admin)->where('id',$back['user_id'])->find();
      $back->user_name = $user['user_name'];
    }
    //今日待办事项个数
    $todayStart = strtotime(date('Y-m-d 00:00:00',time()));
    $todayEnd = strtotime(date('Y-m-d 23:59:59',time()));
    $todaycount = (new BacklogNodel)->field(true)->where($whereor)->where(['backlog_time'=>['between',[$todayStart,$todayEnd]]])->count();
    //本周待办事项个数
    $weekcount = (new BacklogNodel)->field(true)->where($whereor)->where(['backlog_time'=>['between',Week_list()]])->count();
    //本月待办事项个数
    $monthcount = (new BacklogNodel)->field(true)->where($whereor)->where(['backlog_time'=>['between',getMonth(date('Y-m-d',time()))]])->count();
    $data = [
      'backlogs'=>$backlogs,
      'todaycount'=>$todaycount,
      'weekcount' => $weekcount,
      'monthcount'=> $monthcount
    ];
    return $data;
  }
  public function index(){
    $this->assign($this->backlogs());
    return $this->fetch();
  }
  //今日待办
  public function todaylog(){
    $todayStart = strtotime(date('Y-m-d 00:00:00',time()));
    $todayEnd = strtotime(date('Y-m-d 23:59:59',time()));
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_time'=>['between',[$todayStart,$todayEnd]]],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //本周待办
  public function weeklog(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_time'=>['between',Week_list()]],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //本月待办monthlog
  public function monthlog(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_time'=>['between',getMonth(date('Y-m-d',time()))]],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //不执行
  public function notexecution(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_status'=>3],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //已执行
  public function execution(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_status'=>1],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //未执行
  public function unexecuted(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_status'=>0],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //已超时
  public function timeout(){
    $this->assign($this->backlogs(['user_id'=>$this->user['uid'],'backlog_status'=>2],['user_id'=>$this->user['uid']]));
    return $this->fetch();
  }
  //添加待办
  public function add(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      if (strtotime($post['backlog_time']) <= time()) {
        $post['creates_time'] = strtotime($post['backlog_time']);
      }else{
        $post['creates_time'] = time();
      }
      $post['backlog_time'] = strtotime($post['backlog_time']);
      $post['user_id'] = $this->user['uid'];
      if ((new BacklogNodel)->save($post)) {
        $return = ['msg'=>'添加待办事项成功','icon'=>6];
      }else{
        $return = ['msg'=>'添加待办事项失败','icon'=>5];
      }
      return json_encode($return);
    }else{
      return $this->fetch();
    }
  }
  //处理
  public function handle(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $add['backlog_status'] = $post['backlog_status'];
      if ($post['backlog_status'] == 1) {
        $add['execute_time'] = time();
      }
      if ((new BacklogNodel)->where('id',$post['id'])->update($add)) {
        $return = array('msg'=>'处理状态提交成功','icon'=>6);
      }else{
        $return = array('msg'=>'处理状态提交失败','icon'=>5);
      }
      return json_encode($return);
    }else{
      $id = input('id');
      $this->assign('id',$id);
      return $this->fetch();
    }
  }
  //待办事项短信提醒消息队列
  public function sendActivationTel(){
    $jobHandlerClassName  = 'app\admin\controller\job\sendActivationTel';
    $jobQueueName  	  = "sendActivationTel";
    $jobData       	  = [];
    $isPushed = Queue::push( $jobHandlerClassName , $jobData , $jobQueueName );
    if( $isPushed !== false ){
        return true;
    }else{
        return false;
    }
  }
}
