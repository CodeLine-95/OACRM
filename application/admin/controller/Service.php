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
use app\admin\model\Tools as ToolsModel;
class Service extends Base
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
        $data['uid']=$data['service_id'];
        unset($data['service_id']);
        $data['create_t']=time();
        $data['update_t']=time();
        $data['order_id']=26;
        $res = db('client')->where('phone',$data['phone'])->find();
        if ($res) {
          $return = array("msg"=>"客户信息已存在，请不要重复添加！！","icon"=>5);
        }else{
          if((new Client)->save($data)){
             $return = array("msg"=>"添加订单成功","icon"=>6);
          }else{
             $return = array("msg"=>"添加订单失败","icon"=>5);
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
        $kv = db('kv')->where('servicename','客服')->select();
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
        $this->assign('service_id',$this->user['uid']);
        $kv = db('kv')->where('servicename','客服')->select();
        $this->assign('kv',$kv);
        return $this->fetch();
       }
    }

    public function orderAction($where = '', $whereor = ''){
      $post = input('get.value');
      $list = db('client')->alias('c')
        ->join('admin a', 'c.service_id = a.id', 'left')
        ->join('admin d', 'c.uid = d.id', 'left')
        ->join('kv k', 'c.schedule = k.id', 'left')
        ->join('kv v', 'c.order_id = v.id', 'left')
        ->join('business b', 'c.business = b.id', 'left')
        ->where($where)
        ->where($whereor)
        ->whereLike('c.name|c.sitename|c.phone|c.wechat', '%' . $post . '%')
  			->order('c.create_t', 'desc')
        ->field('c.*,a.user_name service_name,d.user_name user,k.name schedule_name,v.name order_name,b.name business')
  			->paginate(20, false, ['query' => request()->param()]);
      $this->assign('post',$post);
      return $list;
    }
   	// 订单列表
   	public function orderlist(){
      $this->assign('list',$this->orderAction());
      return $this->fetch();
   	}
   	// 我的订单
   	public function myorder(){
      $this->assign('list',$this->orderAction(['uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 今日订单
   	public function neworder(){
      $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
      $this->assign('list',$this->orderAction(['update_t'=>['>',$todayStart],'uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 本月订单
   	public function newmonth(){
      $this->assign('list',$this->orderAction(['update_t'=>['between',getMonth(date('Y-m-d',time()))],'uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 已派订单
   	public function logorder(){
      $this->assign('list',$this->orderAction(['order_id'=>27,'uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 被退订单
   	public function outorder(){
      $this->assign('list',$this->orderAction(['order_id'=>23,'uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 回访订单
   	public function visitorder(){
      $this->assign('list',$this->orderAction(['revisit_days'=>['>',0],'uid'=>$this->user['uid']]));
      return $this->fetch();
   	}
   	// 作废订单
   	public function cancellationorder(){
      $this->assign('list',$this->orderAction(['order_id'=>25,'uid'=>$this->user['uid']]));
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
    //排班客服
    public function arrange(){
      $list = (new DutyModel)->field(true)->where('type_id',0)->select();
      foreach ($list as $item) {
        $user = (new Admin)->where('id',$item['user_id'])->find();
        $item->user_name = $user['user_name'];
        $project = (new Project)->where('id',$item['project_id'])->find();
        $item->project = $project['name'];
        $business = (new Business)->where(['id'=>['in',$item['business_list']]])->select();
        $bus = '';
        foreach ($business as $one) {
          $bus .= $one['name'].'&nbsp;&nbsp;';
        }
        $item->business = $bus;
        $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
        $item->todayCount    = (new Client)->field(true)->where(['create_t'=>['>=',$todayStart],'order_id'=>27,'uid'=>$item['user_id']])->count();
        $item->newWeek       = (new Client)->field(true)->where(['create_t'=>['>=',newWeek()],'order_id'=>27,'uid'=>$item['user_id']])->count();
        $item->newmonthCount = (new Client)->field(true)->where(['create_t'=>['between',getMonth(date('Y-m-d',time()))],'service_id'=>['neq',0],'uid'=>$item['user_id']])->count();
        $item->newmonthBack  = (new Client)->field(true)->where(['create_t'=>['between',getMonth(date('Y-m-d',time()))],'order_id'=>23,'service_id'=>['neq',0],'uid'=>$item['user_id']])->count();
        $item->dispatch      = (new Client)->field(true)->where(['order_id'=>27,'service_id'=>['neq',0],'uid' => $item['user_id']])->count();
        $item->allCount      = (new Client)->field(true)->where(['uid'=>$item['user_id']])->count();
      }
      $this->assign('list',$list);
      return $this->fetch();
    }
    //排版客户列表
   	public function arrangeorder(){
      $uid = input('id');
      $this->assign('list',$this->orderAction(['uid'=>$uid]));
      return $this->fetch();
   	}
    //添加排班客服
    public function arrangeadd(){
      if (request()->isPost()) {
        $post = json_decode(input('post.data'),true);
        $post['user_id'] = $post['member'];
        unset($post['business'],$post['member']);
        $post['start_time'] = time();
        $post['status'] = 1;
        if ((new DutyModel)->save($post)) {
          $data = array('msg'=>'添加值班客服成功','icon'=>6);
        }else{
          $data = array('msg'=>'添加值班客服失败','icon'=>5);
        }
        return json_encode($data);
      }else{
        $projects = (new Project)->field(true)->select();
        $this->assign('projects',$projects);
        return $this->fetch();
      }
    }
    //编辑排班客服
    public function arrangeedit(){
      if (request()->isPost()) {
        $post = json_decode(input('post.data'),true);
        $post['user_id'] = $post['member'];
        unset($post['business'],$post['member']);
        $post['status'] = 1;
        if ((new DutyModel)->update($post)) {
          $data = array('msg'=>'修改值班客服成功','icon'=>6);
        }else{
          $data = array('msg'=>'修改值班客服失败','icon'=>5);
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
        $dutys = (new DutyModel)->field(true)->where('type_id',0)->select();
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
    //派单
    public function dispatch(){
      $id = input('id');
      if (request()->isPost()) {
        $post = json_decode(input('post.data'),true);
        $post['order_id'] = 27;
        $post['update_t'] = time();
        if((new Client)->update($post)){
          $message = (new Client)->where('id',$post['id'])->find();
          $user_name = (new Admin)->field(true)->where('id',$message['uid'])->find();
          $service_name = (new Admin)->field(true)->where('id',$message['service_id'])->find();
          if ($message['sex'] == 1) {
            $sex = '男';
          }else{
            $sex = '女';
          }
          if (empty($message['phone'])) {
            $phone = '暂无';
          }else{
            $phone = $message['phone'];
          }
          if (empty($message['wechat'])) {
            $wechat = '暂无';
          }else{
            $wechat = $message['wechat'];
          }
          $business = (new Business)->where('id',$message['business'])->find();
          $message_content = '【派单提醒】客户信息：'.$message['name'].'，'.$sex.'，北京，电话：'.$phone.'，微信：'.$wechat.'，业务：'.$business['name'].'。客服：'.$user_name['user_name'].'，请尽快联系';
          if(!empty($service_name['firm_tel'])){
            message($message_content,$service_name['firm_tel']);
          }
          db('notice')->insert(['title'=>'您好，客服：'.$user_name['user_name'].'于——'.date('Y-m-d H:i:s',$message['update_t']).'给您派了一条客户资源，抓紧去跟进吧！','content'=>'您好，客服'.$user_name['user_name'].'于'.date('Y-m-d H:i:s',$message['update_t']).'给您派了一条客户资源，抓紧去跟进吧！','typeid'=>2,'user_id'=>$service_name['id'],'create_t'=>time()]);
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
        $add['order_id'] = $post['order_id'];
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
    //删除排班客服
    public function arrangedel(){
      $id = input('post.id');
      if(DutyModel::destroy($id)){
        $return = array("msg"=>"删除值班客服成功","icon"=>6);
      }else{
        $return = array("msg"=>"删除值班客服失败","icon"=>5);
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
    // 渠道来源分类
    public function ditch(){
      if(request()->isPost()){

      }else{
        $list = (new Ditchs)->select();
        $this->assign('list',$list);
        return $this->fetch();
      }
    }
    // 渠道来源列表
    public function ditchlist(){
    	if(request()->isPost()){

       }else{
        $list = (new Ditchlists)->alias('aa')->join('ditch','ditch.id=aa.typeid')->field('aa.*,ditch.typename,ditch.entryname')->select();
        $this->assign('list',$list);
        return $this->fetch();
       }
    }
    // 添加渠道
    public function addditch(){
    	if(request()->isPost()){
    		$data = json_decode(input('post.data'),true);
          $data['createtime'] = time();
          $re = (new Ditchs)->insert($data);
          if($re){
             $return = array("msg"=>"添加渠道成功","icon"=>6);
          }else{
             $return = array("msg"=>"添加渠道失败","icon"=>5);
          }
          return json_encode($return);
       }else{
          return $this->fetch();
       }
    }
    // 添加来源
    public function addditchlist(){
    	if(request()->isPost()){
    		$data = json_decode(input('post.data'),true);
          $data['createtime'] = time();
          $re = (new Ditchlists)->insert($data);
          if($re){
             $return = array("msg"=>"添加来源成功","icon"=>6);
          }else{
             $return = array("msg"=>"添加来源失败","icon"=>5);
          }
          return json_encode($return);
       }else{
          $typelist = (new Ditchs)->select();
          $this->assign('typelist',$typelist);
          return $this->fetch();
       }
    }
    // 编辑渠道
    public function updateditch($id=0){
    	if(request()->isPost()){
    		$data = json_decode(input('post.data'),true);
          $re = (new Ditchs)->update($data);
          if($re){
             $return = array("msg"=>"编辑渠道成功","icon"=>6);
          }else{
             $return = array("msg"=>"编辑渠道失败","icon"=>5);
          }
          return json_encode($return);
       }else{
          $ditch = (new Ditchs)->where('id',$id)->find();
          $this->assign('ditch',$ditch);
          return $this->fetch();
       }
    }
    // 编辑来源
    public function updateditchlist($id=0){
    	if(request()->isPost()){
    		$data = json_decode(input('post.data'),true);
          $re = (new Ditchlists)->update($data);
          if($re){
             $return = array("msg"=>"编辑来源成功","icon"=>6);
          }else{
             $return = array("msg"=>"编辑来源失败","icon"=>5);
          }
          return json_encode($return);
       }else{
          $ditch = (new Ditchlists)->where('id',$id)->find();
          $typelist = (new Ditchs)->select();
          $this->assign('typelist',$typelist);
          $this->assign('ditch',$ditch);
          return $this->fetch();
       }
    }
    // 删除渠道
    public function delditch(){
    	 $id = input('post.id');
       if(Ditchs::destroy($id)){
         $return = array("msg"=>"删除渠道成功","icon"=>6);
       }else{
         $return = array("msg"=>"删除渠道失败","icon"=>5);
       }
       return json_encode($return);
    }
    // 删除来源
    public function delditchlist(){
    	 $id = input('post.id');
       if(Ditchlists::destroy($id)){
         $return = array("msg"=>"删除来源成功","icon"=>6);
       }else{
         $return = array("msg"=>"删除来源失败","icon"=>5);
       }
       return json_encode($return);
    }
    //咨询工具列表
    public function tools(){
      $list = (new ToolsModel)->order('entry_createtime','desc')->select();
      foreach ($list as $item) {
        //来源
        $ditchList = (new Ditchlists)->where('id',$item['ditchlist_id'])->find();
        $item->ditchlist = $ditchList['name'];
        //渠道
        $ditch = (new Ditchs)->where('id',$item['ditch_id'])->find();
        $item->ditch = $ditch['typename'];
      }
      $this->assign('list',$list);
      return $this->fetch();
    }
    //添加咨询工具
    public function addtools(){
      if (request()->isPost()) {
        $post = json_decode(input('post.data'),true);
        $post['entry_createtime'] = time();
        if ((new ToolsModel)->save($post)) {
          $return = ['msg'=>'添加成功','icon'=>6];
        }else{
          $return = ['msg'=>'添加失败','icon'=>5];
        }
        return json_encode($return);
      }else{
        //来源
        $ditchlist = (new Ditchlists)->select();
        $this->assign('ditchlist',$ditchlist);
        //渠道
        $ditch = (new Ditchs)->select();
        $this->assign('ditch',$ditch);
        return $this->fetch();
      }
    }

    //编辑咨询工具
    public function edittools(){
      if (request()->isPost()) {
        $post = json_decode(input('post.data'),true);
        if ((new ToolsModel)->update($post)) {
          $return = ['msg'=>'编辑成功','icon'=>6];
        }else{
          $return = ['msg'=>'编辑失败','icon'=>5];
        }
        return json_encode($return);
      }else{
        $id = input('id');
        $field = (new ToolsModel)->where('id',$id)->find();
        $ditchlist = (new Ditchlists)->where('id',$field['ditchlist_id'])->find();
        $field->ditchlist = '<option value="'.$ditchlist['id'].'">'.$ditchlist['name'].'</option>';
        $this->assign('field',$field);

        //来源
        $ditchlist = (new Ditchlists)->select();
        $this->assign('ditchlist',$ditchlist);
        //渠道
        $ditch = (new Ditchs)->select();
        $this->assign('ditch',$ditch);
        return $this->fetch();
      }
    }
}
