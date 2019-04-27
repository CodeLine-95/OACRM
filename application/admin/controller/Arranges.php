<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
class Arranges extends Base
{
  //排班运营
  public function operate(){
    $list = db('duty')->field(true)->where('type_id',1)->select();
    foreach ($list as $item) {
      $user = db('admin')->where('id',$item['user_id'])->find();
      $item->user_name = $user['user_name'];
      $project = db('project')->where('id',$item['project_id'])->find();
      $item->project = $project['name'];
      $business = db('business')->where(['id'=>['in',$item['business_list']]])->select();
      $bus = '';
      foreach ($business as $one) {
        $bus .= $one['name'].'&nbsp;&nbsp;';
      }
      $item->business = $bus;
      //累计数据
      $item->allCount         = db('client')->where('service_id',$item['user_id'])->count();
      //未跟进    last_time = 0
      $item->failure_followup = db('client')->where(['last_time'=>['eq',0],'service_id'=>$item['user_id']])->count();
      //已跟进    last_time != 0
      $item->followup         = db('client')->where(['last_time'=>['neq',0],'service_id'=>$item['user_id']])->count();
      //已退单    schedule = 20
      $item->retreat          = db('client')->where(['order_id'=>['eq',23],'service_id'=>$item['user_id']])->count();
      //已报价    schedule = 7
      $item->quote            = db('client')->where(['schedule'=>['>=',7],'service_id'=>$item['user_id']])->count();
      //已发方案  schedule = 8
      $item->plan             = db('client')->where(['schedule'=>['>=',8],'service_id'=>$item['user_id']])->count();
      //已发合同  schedule = 10
      $item->pact             = db('client')->where(['schedule'=>['>=',10],'service_id'=>$item['user_id']])->count();
      //已合作    schedule = 12
      $item->cooperate        = db('client')->where(['schedule'=>['>=',12],'service_id'=>$item['user_id']])->count();
      //已付款    schedule = 11
      $item->payment          = db('client')->where(['schedule'=>['>=',11],'service_id'=>$item['user_id']])->count();
    }
    $this->assign('list',$list);
    return $this->fetch();
  }
  //排版销售的订单统计
  public function arrangeshow(){
    $id = input('id');
    $field = db('duty')->where('id',$id)->find();
    $user = db('admin')->where('id',$field['user_id'])->find();
    $user->starttime = date('Y-m-d',$field['start_time']);
    //今日 $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
    $data['toDay'] = $this->arrangeCount(['create_t'=>['>',strtotime(date('Y-m-d'.'00:00:00',time()))],'service_id'=>$user['id']],'今日');
    //本周   ['update_t'=>['>=',newWeek()]]
    $data['newWeek'] = $this->arrangeCount(['create_t'=>['>',newWeek()],'service_id'=>$user['id']],'本周');
    //本月   ['update_t'=>['between',getMonth(date('Y-m-d',time()))]]
    $data['newMonth'] = $this->arrangeCount(['create_t'=>['between',getMonth(date('Y-m-d',time()))],'service_id'=>$user['id']],'本月');
    //本年   ['create_t'=>['between',getYear()]]
    $data['newYear'] = $this->arrangeCount(['create_t'=>['between',getYear()]],'本年');
    $user->count = $data;

    //详情数据统计
    $this->assign('user',$user);
    return $this->fetch();
  }
  //数据统计报表
  public function arrangeCount($where='',$date){
    //标识符
    $data['date']             = $date;
    //未跟进    last_time = 0
    $data['failure_followup'] = db('client')->where($where)->where(['last_time'=>['eq',0]])->count();
    //已跟进    last_time != 0
    $data['followup']         = db('client')->where($where)->where(['last_time'=>['neq',0]])->count();
    //已退单    schedule = 20
    $data['retreat']          = db('client')->where($where)->where(['order_id'=>['eq',23]])->count();
    //已报价    schedule = 7
    $data['quote']            = db('client')->where($where)->where(['schedule'=>['>=',7]])->count();
    //已发方案  schedule = 8
    $data['plan']             = db('client')->where($where)->where(['schedule'=>['>=',8]])->count();
    //已发合同  schedule = 10
    $data['pact']             = db('client')->where($where)->where(['schedule'=>['>=',10]])->count();
    //已合作    schedule = 12
    $data['cooperate']        = db('client')->where($where)->where(['schedule'=>['>=',12]])->count();
    //已付款    schedule = 11
    $data['payment']          = db('client')->where($where)->where(['schedule'=>['>=',11]])->count();
    return $data;
  }
  //添加排班销售
  public function arrangeadd(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['user_id'] = $post['member'];
      unset($post['business'],$post['member']);
      $post['status'] = 1;
      $post['type_id'] = 1;
      $post['start_time'] = time();
      if (db('duty')->insert($post)) {
        $data = array('msg'=>'添加值班销售成功','icon'=>6);
      }else{
        $data = array('msg'=>'添加值班销售失败','icon'=>5);
      }
      return json_encode($data);
    }else{
      $projects = db('project')->field(true)->select();
      $this->assign('projects',$projects);
      return $this->fetch();
    }
  }
  //编辑排班销售
  public function arrangeedit(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['user_id'] = $post['member'];
      unset($post['business'],$post['member']);
      $post['status'] = 1;
      if (db('duty')->update($post)) {
        $data = array('msg'=>'修改值班销售成功','icon'=>6);
      }else{
        $data = array('msg'=>'修改值班销售失败','icon'=>5);
      }
      return json_encode($data);
    }else{
      $id = input('id');
      $field = db('duty')->where('id',$id)->find();
      $user = db('admin')->where('id',$field['user_id'])->find();
      // 部门
      $sectors = db('sectors')->where('id',$user['sectors_id'])->find();
      // 岗位
      $quarters = db('quarters')->where('id',$user['quarters_id'])->find();
      // 业务
      $yewu = "";
      if (!empty($user['firm_business'])) {
        $arr = json_decode($user['firm_business'],true);
        if(!empty($arr)){
          foreach ($arr as $k => $v) {
            $yyy = db('business')->where('id',$v)->find();
            $yewu.= $yyy['name']."&nbsp;&nbsp;";
          }
        }
      }
      if(!empty($user['firm_report'])){
        $lingdao = db('admin')->where('id',$user['firm_report'])->find();
        $user->shangji = $lingdao['user_name'];
      }else{
        $user->shangji = "暂无上级";
      }
      if ($sectors) {
        $user->sectors=$sectors['name'];
      }else{
        $user->sectors='暂无部门';
      }
      if ($quarters) {
        $user->quarters=$quarters['name'];
      }else{
        $user->quarters='暂无岗位';
      }
      if($yewu == ''){
        $user->yewu='暂无职责';
      }else{
        $user->yewu=$yewu;
      }
      $project = db('project')->where('id',$field['project_id'])->find();
      $field->project = $project['name'];
      $business = db('business')->where(['id'=>['in',$field['business_list']]])->select();
      $bus = '';
      foreach ($business as $one) {
        $bus .= $one['name'].'&nbsp;&nbsp;';
      }
      $field->business = $bus;
      $this->assign('user',$user);
      $this->assign('field',$field);
      $projects = db('project')->field(true)->select();
      $this->assign('projects',$projects);
      return $this->fetch();
    }
  }
}
