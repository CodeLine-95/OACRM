<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Admin;
use app\admin\model\Citys;
use app\admin\model\Quarters;
use app\admin\model\Sectors;
use app\admin\model\Client;
use app\admin\model\Project;
use app\admin\model\Ditchlist as Ditchlists;
use app\admin\model\Ditch as Ditchs;
use app\admin\model\Service as Services;
use app\admin\model\Duty as DutyModel;
use app\admin\model\Business;
use app\admin\model\Backlog;
use app\admin\model\Followup as FollowupModel;
use app\admin\model\Tools as ToolsModel;
use app\admin\model\Server as ServerModel;
class Followup extends Base
{
  //跟进
  public function index(){
    $id = input('id');
    // 查询当前订单
    $client = (new Client)
      ->alias('c')
      ->join('citys t', 'c.city = t.id', 'left')
      ->join('admin a', 'c.service_id = a.id', 'left')
      ->join('admin d', 'c.uid = d.id', 'left')
      ->join('kv k', 'c.schedule = k.id', 'left')
      ->join('kv v', 'c.order_id = v.id', 'left')
      ->join('business b', 'c.business = b.id', 'left')
      ->join('ditch ch', 'c.ditch_id = ch.id', 'left')
      ->join('ditchlist cl', 'c.source_id = cl.id', 'left')
      ->join('project p', 'c.project_id = p.id', 'left')
      ->where('c.id',$id)
      ->field('c.*,t.name city,a.user_name service_name,d.user_name user,k.name schedule_name,v.name order_name,b.name business,ch.typename ditch_id,cl.name source_id,p.name project_id')
      ->find();
    //咨询工具
    $tools = (new ToolsModel)->where('id','in',$client['tools_ids'])->select();
    $client->tools = $tools;
    // 查询所有兴趣爱好
    $interests = explode(",", $client['interests']);
    if(empty($interests)){
      $interests = array();
    }
    //服务内容
    // $service = explode(',',$client['service']);
    $service = (new ServerModel)->where(['id'=>['in',$client['service']]])->select();
    if(empty($service)){
      $service = array();
    }
    //跟进列表
    $followups = (new FollowupModel)->field(true)->where('client_id',$id)->order('create_t','asc')->select();
    foreach ($followups as $up) {
      $team_one = (new Admin)->field('user_name')->where('id',$up['team_id'])->find();
      $up->user_name = $team_one['user_name'];
      if ($up['backlog_id'] == 0) {
        $up->backlog = '暂无';
      }else{
        $backlog_one = (new Backlog)->where('id',$up['backlog_id'])->find();
        $up->backlog = $backlog_one['backlog_title'];
      }
    }
    $this->assign('followups',$followups);
    $this->assign('interests',$interests);
    $this->assign('client',$client);
    $this->assign('service',$service);
    return $this->fetch();
  }

  public function add(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $post = array_filter($post);
      if (isset($post['backlog_time']) || isset($post['backlog_title'])) {
        $Backlog = new Backlog();
        $backlogAdd = [
          'backlog_title'    => $post['backlog_title'],
          'backlog_content'  => $post['backlog_title'],
          'backlog_time'     => strtotime($post['backlog_time']),
          'user_id'          => $this->user['uid'],
          'creates_time'     => time()
        ];
        $Backlog->save($backlogAdd);
        $post['backlog_id'] = $Backlog->id;
        unset($post['backlog_time'],$post['backlog_title']);
      }else{
        $post['backlog_id'] = 0;
      }
      $time = time();
      $post['team_id'] = $this->user['uid'];
      $post['create_t'] = $time;
      if ((new FollowupModel)->save($post)) {
        $client = db('client')->where('id',$post['client_id'])->find();
        if ($client['order_id'] <= 29) {
          $update = ['last_time'=>$time,'schedule'=>$post['client_status'],'order_id'=>29];
        }else{
          $update = ['last_time'=>$time,'schedule'=>$post['client_status']];
        }
        if ((new Client)->where('id',$post['client_id'])->update($update)) {
          $return = array('msg'=>'跟进成功,客户信息已更新！','icon'=>6);
        }else{
          $return = array('msg'=>'跟进成功,客户信息未更新！','icon'=>6);
        }
      }else{
        $return = array('msg'=>'跟进失败！','icon'=>5);
      }
      return json_encode($return);
    }else{
      $id = input('id');
      $this->assign('id',$id);
      $client = db('client')->where('id',$id)->find();
      $this->assign('client',$client);
      $kv = db('kv')->where(['servicename'=>['in','销售,客服']])->order('id','asc')->select();
      $this->assign('kv',$kv);
      return $this->fetch();
    }
  }
}
