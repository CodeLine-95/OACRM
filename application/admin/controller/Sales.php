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
class Sales extends Base
{
  public function index(){
 	  if(request()->isPost()){
 			$data = input('post.');
 			$where = array();
      if(!empty($data['user_name'])){
        $where['user_name'] = ['like','%'.$data['user_name'].'%'];
      }
      if(!empty($data['staff_tel'])){
        $where['staff_tel'] = ['like','%'.$data['staff_tel'].'%'];
      }
      if(!empty($data['sectors_id'])){
        $where['sectors_id'] = ['eq',$data['sectors_id']];
      }
      if(!empty($data['quarters_id'])){
        $where['quarters_id'] = ['eq',$data['quarters_id']];
      }
      $list = (new Admin)->where($where)->where('id!=1')->select();
   	}else{
   		// 查询所有地址
   		$list = (new Admin)->where('id!=1')->select();
   	}
 		// 查询所有成员
 		$city = (new Citys)->where("type=1 or type=0")->select();
 		// 查询全部岗位
 		$quarters = (new Quarters)->select();
 		// 查询全部部门
 		$sectors = (new Sectors)->select();
 		$this->assign('sectors',$sectors);
 		$this->assign('city',$city);
 		$this->assign('quarters',$quarters);
 		$this->assign('list',$list);
 		return $this->fetch();
 	}

 	// 添加订单
 	public function addorder(){
 		if(request()->isPost()){
      $data = json_decode(input('post.data'),true);
      $time = time();
      $data['uid'] = $data['service_id'];
      $data['end_time'] = strtotime($data['end_time']);
      $data['create_t']= $time;
      $data['update_t']= $time;
      $data['order_id']=27;
      $res = db('client')->where('phone',$data['phone'])->find();
      if ($res) {
        $return = array("msg"=>"客户信息已存在，请不要重复添加！！","icon"=>5);
      }else{
        if((new Client)->save($data)){
           $return = array("msg"=>"添加客户成功","icon"=>6);
        }else{
           $return = array("msg"=>"添加客户失败","icon"=>5);
        }
      }
      return json_encode($return);
 		}else{
 			$city = (new Citys)->where("type=1 or type=0")->select();
   		// 查询全部岗位
   		$quarters = (new Quarters)->select();
   		// 查询全部部门
   		$sectors = (new Sectors)->select();
   		// 查询所有分类
   		$typelist = (new Ditchs)->select();
   		// 查询所有项目
   		$project = (new Project)->select();
   		$this->assign('project',$project);
   		$this->assign('typelist',$typelist);
   		$this->assign('sectors',$sectors);
   		$this->assign('city',$city);
   		$this->assign('quarters',$quarters);
   		$this->assign('service_id',$this->user['uid']);
      $kv = db('kv')->where(['servicename'=>['in','销售,客服']])->order('id','asc')->select();
      $this->assign('kv',$kv);
 			return $this->fetch();
 		}
 	}
  // 编辑订单
  public function updateorder($id=0){
   if(request()->isPost()){
      $data = json_decode(input('post.data'),true);
      $data['update_t'] = time();
      if((new Client)->update($data)){
        $return = array("msg"=>"编辑订单成功","icon"=>6);
      }else{
        $return = array("msg"=>"编辑订单失败","icon"=>5);
      }
      return json_encode($return);
     }else{
      // 查询当前订单
      $client = (new Client)->where('id',$id)->find();
      // 查询所有省份城市
      $city = (new Citys)->where("type=1 or type=0")->select();
      // 查询全部岗位
      $quarters = (new Quarters)->select();
      // 查询全部部门
      $sectors = (new Sectors)->select();
      // 查询所有分类
      $typelist = (new Ditchs)->select();
      // 查询所有项目
      $project = (new Project)->select();
      // 查询所有兴趣爱好
      $interests = explode(",", $client['interests']);
      if(empty($interests)){
         $interests = array();
      }
      $this->assign('interests',$interests);
      $this->assign('client',$client);
      $this->assign('project',$project);
      $this->assign('typelist',$typelist);
      $this->assign('sectors',$sectors);
      $this->assign('city',$city);
      $this->assign('quarters',$quarters);
      $kv = db('kv')->where(['servicename'=>['in','销售,客服']])->order('id','asc')->select();
      $this->assign('kv',$kv);
      return $this->fetch();
     }
  }

  public function orderAction($where = '', $whereor = ''){
    $post = input('get.value');
    $xing = [];
    $this->assign('post',$post);
    if(strpos($post,'星级:') !== false){
      $arr = explode(':',$post);
      $xing['c.level'] = $arr[1];
      $post = '';
    }
    $list = db('client')->alias('c')
      ->join('admin a', 'c.service_id = a.id', 'left')
      ->join('admin d', 'c.uid = d.id', 'left')
      ->join('kv k', 'c.schedule = k.id', 'left')
      ->join('kv v', 'c.order_id = v.id', 'left')
      ->join('business b', 'c.business = b.id', 'left')
      ->where($where)
      ->where($whereor)
      ->where($xing)
      ->whereLike('c.name|c.sitename|c.phone|c.wechat', '%' . $post . '%')
      ->order('c.create_t', 'desc')
      ->field('c.*,a.user_name service_name,d.user_name user,k.name schedule_name,v.name order_name,b.name business')
      ->paginate(20, false, ['query' => request()->param()]);
    return $list;
  }
 	// 订单列表
 	public function orderlist(){
    $this->assign('list',$this->orderAction(['order_id'=>['>',26]]));
    return $this->fetch();
 	}
 	// 我的订单
 	public function myorder(){
    $this->assign('list',$this->orderAction(['service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
 	// 今日订单
 	public function todayorder(){
    $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
    $this->assign('list',$this->orderAction(['update_t'=>['>',$todayStart],'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
  //本周订单
  public function weekorder(){
    $this->assign('list',$this->orderAction(['update_t'=>['>=',newWeek()],'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
 	// 本月订单
 	public function monthorder(){
    $this->assign('list',$this->orderAction(['update_t'=>['between',getMonth(date('Y-m-d',time()))],'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
  //洽谈订单
  public function struckorder(){
    $this->assign('list',$this->orderAction(['schedule'=>6,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //报价订单
  public function offerorder(){
    $this->assign('list',$this->orderAction(['schedule'=>7,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //方案订单
  public function planorder(){
    $this->assign('list',$this->orderAction(['schedule'=>8,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //竞标订单
  public function biddingorder(){
    $this->assign('list',$this->orderAction(['schedule'=>9,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //合同订单
  public function pactorder(){
    $this->assign('list',$this->orderAction(['schedule'=>10,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //付款订单
  public function payorder(){
    $this->assign('list',$this->orderAction(['schedule'=>11,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
  //合作订单
  public function cooperorder(){
    $this->assign('list',$this->orderAction(['schedule'=>12,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
  }
 	// 已派订单
 	public function logorder(){
    $this->assign('list',$this->orderAction(['order_id'=>27,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
 	// 被退订单
 	public function outorder(){
    $this->assign('list',$this->orderAction(['order_id'=>23,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
 	// 回访订单
 	public function visitorder(){
    $this->assign('list',$this->orderAction(['revisit_days'=>['>',0],'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
 	// 作废订单
 	public function cancellationorder(){
    $this->assign('list',$this->orderAction(['order_id'=>25,'service_id'=>$this->user['uid'],'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
  // 作废中心
 	public function cores(){
    $this->assign('list',$this->orderAction(['order_id'=>25]));
    return $this->fetch();
 	}
  //激活
  public function activation(){
    $id = input('post.id');
    if ((new Client)->where(['id'=>$id,'order_id'=>25])->update(['schedule'=>5,'order_id'=>27])) {
      $return = array('msg'=>'激活成功','icon'=>6);
    }else{
      $return = array('msg'=>'激活失败','icon'=>5);
    }
    return json_encode($return);
  }
  //排班销售
  public function arrange(){
    $list = (new DutyModel)->field(true)->where('type_id',1)->select();
    foreach ($list as $item) {
      $user = (new Admin)->where('id',$item['user_id'])->find();
      $item->user_name = $user['user_name'];
      $item->user_id   = $user['id'];
      $project = (new Project)->where('id',$item['project_id'])->find();
      $item->project = $project['name'];
      $business = (new Business)->where(['id'=>['in',$item['business_list']]])->select();
      $bus = '';
      foreach ($business as $one) {
        $bus .= $one['name'].'&nbsp;&nbsp;';
      }
      $item->business = $bus;
      //累计数据
      $item->allCount         = (new Client)->where('service_id',$item['user_id'])->count();
      //未跟进    last_time = 0
      $item->failure_followup = (new Client)->where(['last_time'=>['eq',0],'service_id'=>$item['user_id']])->count();
      //已跟进    last_time != 0
      $item->followup         = (new Client)->where(['last_time'=>['neq',0],'service_id'=>$item['user_id']])->count();
      //已退单    schedule = 20
      $item->retreat          = (new Client)->where(['order_id'=>['eq',23],'service_id'=>$item['user_id']])->count();
      //已报价    schedule = 7
      $item->quote            = (new Client)->where(['schedule'=>['>=',7],'service_id'=>$item['user_id']])->count();
      //已发方案  schedule = 8
      $item->plan             = (new Client)->where(['schedule'=>['>=',8],'service_id'=>$item['user_id']])->count();
      //已发合同  schedule = 10
      $item->pact             = (new Client)->where(['schedule'=>['>=',10],'service_id'=>$item['user_id']])->count();
      //已合作    schedule = 12
      $item->cooperate        = (new Client)->where(['schedule'=>['>=',12],'service_id'=>$item['user_id']])->count();
      //已付款    schedule = 11
      $item->payment          = (new Client)->where(['schedule'=>['>=',11],'service_id'=>$item['user_id']])->count();
    }
    $this->assign('list',$list);
    return $this->fetch();
  }
  //排版客户列表
 	public function arrangeorder(){
    $uid = input('id');
    $this->assign('list',$this->orderAction(['service_id'=>$uid,'order_id'=>['neq',25]]));
    return $this->fetch();
 	}
  //排版销售的订单统计
  public function arrangeshow(){
    $id = input('id');
    $field = (new DutyModel)->where('id',$id)->find();
    $user = (new Admin)->where('id',$field['user_id'])->find();
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
    $data['failure_followup'] = (new Client)->where($where)->where(['last_time'=>['eq',0]])->count();
    //已跟进    last_time != 0
    $data['followup']         = (new Client)->where($where)->where(['last_time'=>['neq',0]])->count();
    //已退单    schedule = 20
    $data['retreat']          = (new Client)->where($where)->where(['order_id'=>['eq',23]])->count();
    //已报价    schedule = 7
    $data['quote']            = (new Client)->where($where)->where(['schedule'=>['>=',7]])->count();
    //已发方案  schedule = 8
    $data['plan']             = (new Client)->where($where)->where(['schedule'=>['>=',8]])->count();
    //已发合同  schedule = 10
    $data['pact']             = (new Client)->where($where)->where(['schedule'=>['>=',10]])->count();
    //已合作    schedule = 12
    $data['cooperate']        = (new Client)->where($where)->where(['schedule'=>['>=',12]])->count();
    //已付款    schedule = 11
    $data['payment']          = (new Client)->where($where)->where(['schedule'=>['>=',11]])->count();
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
      if ((new DutyModel)->save($post)) {
        $data = array('msg'=>'添加值班销售成功','icon'=>6);
      }else{
        $data = array('msg'=>'添加值班销售失败','icon'=>5);
      }
      return json_encode($data);
    }else{
      $projects = (new Project)->field(true)->select();
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
      if ((new DutyModel)->update($post)) {
        $data = array('msg'=>'修改值班销售成功','icon'=>6);
      }else{
        $data = array('msg'=>'修改值班销售失败','icon'=>5);
      }
      return json_encode($data);
    }else{
      $id = input('id');
      $field = (new DutyModel)->where('id',$id)->find();
      $user = (new Admin)->where('id',$field['user_id'])->find();
      // 部门
      $sectors = (new Sectors)->where('id',$user['sectors_id'])->find();
      // 岗位
      $quarters = (new Quarters)->where('id',$user['quarters_id'])->find();
      // 业务
      $yewu = "";
      if (!empty($user['firm_business'])) {
        $arr = json_decode($user['firm_business'],true);
        if(!empty($arr)){
          foreach ($arr as $k => $v) {
            $yyy = (new Business)->where('id',$v)->find();
            $yewu.= $yyy['name']."&nbsp;&nbsp;";
          }
        }
      }
      if(!empty($user['firm_report'])){
        $lingdao = (new Admin)->where('id',$user['firm_report'])->find();
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
      $project = (new Project)->where('id',$field['project_id'])->find();
      $field->project = $project['name'];
      $business = (new Business)->where(['id'=>['in',$field['business_list']]])->select();
      $bus = '';
      foreach ($business as $one) {
        $bus .= $one['name'].'&nbsp;&nbsp;';
      }
      $field->business = $bus;
      $this->assign('user',$user);
      $this->assign('field',$field);
      $projects = (new Project)->field(true)->select();
      $this->assign('projects',$projects);
      return $this->fetch();
    }
  }
  //转单
  public function changeorder(){
    $id = input('id');
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $data['service_id'] = $post['service_id_new'];
      $data['update_t'] = time();
      if((new Client)->where(['id'=>$post['id'],'service_id'=>$post['service_id_now']])->update($data)){
        $return = array('msg'=>'转单成功','icon'=>6);
      }else{
        $return = array('msg'=>'转单失败','icon'=>5);
      }
      return json_encode($return);
    }else{
      //当前派单人员
      $field = (new Client)->field(true)->where('id',$id)->find();
      $user_now = (new Admin)->field(true)->where('id',$field['service_id'])->find();
      // 部门
      $user_sectors = (new Sectors)->where('id',$user_now['sectors_id'])->find();
      // 岗位
      $user_quarters = (new Quarters)->where('id',$user_now['quarters_id'])->find();
      // 业务
      $user_yewu = "";
      if (!empty($user_now['firm_business'])) {
        $user_arr = json_decode($user_now['firm_business'],true);
        if(!empty($user_arr)){
          foreach ($user_arr as $k => $v) {
            $user_yyy = (new Business)->where('id',$v)->find();
            $user_yewu.= $user_yyy['name']."&nbsp;&nbsp;";
          }
        }
      }
      if(empty($user_now['firm_report'])){
        $user_now->shangji = "暂无上级";
      }else{
        $lingdao = (new Admin)->where('id',$user_now['firm_report'])->find();
        $user_now->shangji = $lingdao['user_name'];
      }
      if ($user_sectors) {
        $user_now->sectors = $user_sectors['name'];
      }else{
        $user_now->sectors = '暂无部门';
      }
      if ($user_quarters) {
        $user_now->quarters = $user_quarters['name'];
      }else{
        $user_now->quarters = '暂无岗位';
      }
      if($user_yewu == ''){
        $user_now->yewu = '暂无职责';
      }else{
        $user_now->yewu = $user_yewu;
      }
      //要转单的人员
      $dutys = (new DutyModel)->field(true)->where('type_id',1)->select();
      foreach ($dutys as $d) {
        $user = (new Admin)->field(true)->where('id',$d['user_id'])->find();
        $users[] = $user;
      }
      foreach ($users as $key => $item) {
        // 部门
        $sectors = (new Sectors)->where('id',$item['sectors_id'])->find();
        // 岗位
        $quarters = (new Quarters)->where('id',$item['quarters_id'])->find();
        // 业务
        $yewu = "";
        if (!empty($item['firm_business'])) {
          $arr = json_decode($item['firm_business'],true);
          if(!empty($arr)){
            foreach ($arr as $k => $v) {
              $yyy = (new Business)->where('id',$v)->find();
              $yewu.= $yyy['name']."&nbsp;&nbsp;";
            }
          }
        }
        if(empty($item['firm_report'])){
          $item->shangji = "暂无上级";
        }else{
          $lingdao = (new Admin)->where('id',$item['firm_report'])->find();
          $item->shangji = $lingdao['user_name'];
        }
        if ($sectors) {
          $item->sectors = $sectors['name'];
        }else{
          $item->sectors = '暂无部门';
        }
        if ($quarters) {
          $item->quarters = $quarters['name'];
        }else{
          $item->quarters = '暂无岗位';
        }
        if($yewu == ''){
          $item->yewu = '暂无职责';
        }else{
          $item->yewu = $yewu;
        }
      }
      $this->assign([
        'field'    => $field,
        'user_now' => $user_now,
        'users'    => $users,
        'id'       => $id
      ]);
      return $this->fetch();
    }
  }
  //批量转单
  public function changeorderall(){
    $id = input('id');
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $ids = explode(',',$post['id']);
      foreach($ids as $id_one){
        $update_one = [
          'id'   =>  $id_one,
          'service_id'=>$post['service_id_new'],
          'update_t'  => time()
        ];
        $update_all[] = $update_one;
      }
      if((new Client)->isUpdate()->saveAll($update_all)){
        $return = array('msg'=>'批量转单成功','icon'=>6);
      }else{
        $return = array('msg'=>'批量转单失败','icon'=>5);
      }
      return json_encode($return);
    }else{
      //要转单的人员
      $dutys = (new DutyModel)->field(true)->where('type_id',1)->select();
      foreach ($dutys as $d) {
        $user = (new Admin)->field(true)->where('id',$d['user_id'])->find();
        $users[] = $user;
      }
      foreach ($users as $key => $item) {
        // 部门
        $sectors = (new Sectors)->where('id',$item['sectors_id'])->find();
        // 岗位
        $quarters = (new Quarters)->where('id',$item['quarters_id'])->find();
        // 业务
        $yewu = "";
        if (!empty($item['firm_business'])) {
          $arr = json_decode($item['firm_business'],true);
          if(!empty($arr)){
            foreach ($arr as $k => $v) {
              $yyy = (new Business)->where('id',$v)->find();
              $yewu.= $yyy['name']."&nbsp;&nbsp;";
            }
          }
        }
        if(empty($item['firm_report'])){
          $item->shangji = "暂无上级";
        }else{
          $lingdao = (new Admin)->where('id',$item['firm_report'])->find();
          $item->shangji = $lingdao['user_name'];
        }
        if ($sectors) {
          $item->sectors = $sectors['name'];
        }else{
          $item->sectors = '暂无部门';
        }
        if ($quarters) {
          $item->quarters = $quarters['name'];
        }else{
          $item->quarters = '暂无岗位';
        }
        if($yewu == ''){
          $item->yewu = '暂无职责';
        }else{
          $item->yewu = $yewu;
        }
      }
      $this->assign([
        'users'    => $users,
        'id'       => $id
      ]);
      return $this->fetch();
    }
  }
  //派单
  public function dispatch(){
    $id = input('id');
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['schedule'] = 5;
      $data['update_t'] = time();
      if((new Client)->update($post)){
        $return = array('msg'=>'派单成功','icon'=>6);
      }else{
        $return = array('msg'=>'派单失败','icon'=>5);
      }
      return json_encode($return);
    }else{
      $dutys = (new DutyModel)->field(true)->where('type_id',1)->select();
      $users = [];
      if ($dutys) {
        foreach ($dutys as $d) {
          $user = (new Admin)->field(true)->where('id',$d['user_id'])->find();
          $users[] = $user;
        }
        foreach ($users as $key => $item) {
          // 部门
          $sectors = (new Sectors)->where('id',$item['sectors_id'])->find();
          // 岗位
          $quarters = (new Quarters)->where('id',$item['quarters_id'])->find();
          // 业务
          $yewu = "";
          if (!empty($item['firm_business'])) {
            $arr = json_decode($item['firm_business'],true);
            if(!empty($arr)){
              foreach ($arr as $k => $v) {
                $yyy = (new Business)->where('id',$v)->find();
                $yewu.= $yyy['name']."&nbsp;&nbsp;";
              }
            }
          }
          if(empty($item['firm_report'])){
            $item->shangji = "暂无上级";
          }else{
            $lingdao = (new Admin)->where('id',$item['firm_report'])->find();
            $item->shangji = $lingdao['user_name'];
          }
          if ($sectors) {
            $item->sectors = $sectors['name'];
          }else{
            $item->sectors = '暂无部门';
          }
          if ($quarters) {
            $item->quarters = $quarters['name'];
          }else{
            $item->quarters = '暂无岗位';
          }
          if($yewu == ''){
            $item->yewu = '暂无职责';
          }else{
            $item->yewu = $yewu;
          }
        }
      }
      $this->assign([
        'users'   => $users,
        'id'      => $id
      ]);
      return $this->fetch();
    }
  }
  // 处理 handle
  public function handle(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $add['order_id'] = $post['schedule'];
      if ((new Client)->where('id',$post['id'])->update($add)) {
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
  //退回
  public function retreat(){
	  $id = input('id');
	  if((new Client)->where('id',$id)->update(['schedule'=>20])){
		  $return = array('msg'=>'退回成功','icon'=>6);
	  }else{
		  $return = array('msg'=>'退回失败','icon'=>5);
	  }
	  return json_encode($return);
  }
  //结束
  public function ibegunexit(){
     $id = input('id');
     if((new Client)->where('id',$id)->update(['order_id'=>32])){
       $return = array('msg'=>'结束成功','icon'=>6);
     }else{
       $return = array('msg'=>'结束失败','icon'=>5);
     }
     return json_encode($return);
  }
  //删除排班客服
  public function arrangedel(){
    $id = input('post.id');
    if(DutyModel::destroy($id)){
      $return = array("msg"=>"删除值班销售成功","icon"=>6);
    }else{
      $return = array("msg"=>"删除值班销售失败","icon"=>5);
    }
    return json_encode($return);
  }
  //修改排班客服状态
  public function arrangestatus(){
    $id = input('post.id');
    $field = (new DutyModel)->field(true)->where('id',$id)->find();
    if ($field['status'] == 0) {
      $status = 1;
      $update = ['status'=>$status,'start_time'=>time()];
    }else{
      $status = 0;
      $update = ['status'=>$status];
    }
    if ((new DutyModel)->where('id',$id)->update($update)) {
      $return = array("msg"=>"状态修改成功","icon"=>6);
    }else{
      $return = array("msg"=>"状态修改失败","icon"=>5);
    }
    return json_encode($return);
  }
}
