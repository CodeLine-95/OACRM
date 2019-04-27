<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Admin;
use app\admin\model\Duty as DutyModel;
use app\admin\model\Project;
use app\admin\model\Business;
use app\admin\model\Client;
use app\admin\model\Quarters;
use app\admin\model\Sectors;
use think\Db;

class Operate extends Base {

	public $delid = '';
	public function index() {
		return '运营页面';
	}
	public function orderlist() {
		$this->assign([
			'list' => $this->publicuser("c.order_id >=30"),
		]);
		return $this->fetch('orderlist');
	}
	//未开始
	public function ibegunnot() {
		$this->assign('implement', 'ibegunnot');
		$this->assign(['list' => $this->publicuser('c.order_id=30', ['c.operate_id' => $this->user['uid']])]);
		return $this->fetch('orderlist');

	}
	//执行中
	public function ibegunin($value = '') {
		$this->assign('implement', 'ibegunin');
		$this->assign(['list' => $this->publicuser('c.order_id=31', ['c.operate_id' => $this->user['uid']])]);
		return $this->fetch('orderlist');
	}
	//已结束
	public function ibegunexit($value = '') {
		$this->assign('implement', 'ibegunexit');
		$this->assign(['list' => $this->publicuser('c.order_id=32', ['c.operate_id' => $this->user['uid']])]);
		return $this->fetch('orderlist');
	}
	//公用类
	public function publicuser($where = '', $whereor = '') {
		$post = input('get.value');
		$list = Db::table('crm_client')
			->alias('c')
			->join('kv k', 'c.schedule=k.id', 'left')
			->join('kv v', 'c.order_id = v.id', 'left')
			->join('citys s', 'c.city=s.id', 'left')
			->join('admin a', 'c.service_id=a.id', 'left')
			->join('admin m', 'c.uid=m.id', 'left')
			->join('admin o', 'c.operate_id=o.id', 'left')
			->join('business b', 'c.business=b.id', 'left')
			->join('demand d', 'c.id=d.uid', 'left')
			->where($where)
		// ->where($whereor)
			->whereLike('c.name|c.sitename|c.phone|c.wechat', '%' . $post . '%')
			->order('c.last_time', 'desc')
            ->group('c.id')
			->field("c.*,k.name schedule,s.name city,a.user_name service_name,b.name business,v.name order_name,m.user_name username,o.user_name operate_name")
			->paginate(20, false, ['query' => request()->param()]);
		$this->assign('value', $post);
		return $list;
	}
	//其他需求
	public function notimplement() {
		$name = input('get.value');
		$res = db('demand')
			->where('d.cid', null)
			->where('d.uid', $this->user['uid'])
			->alias('d')
			->join('reply r', 'd.id=r.creid', 'left')
			->group('d.id')
			->field('d.*,r.id cid,r.isnot')
			->paginate(20, false, ['query' => request()->param()]);
		//$res = db('demand')->where('d.cid', null)->where('d.uid', $this->user['uid'])->paginate(20, false, ['query' => request()->param()]);
		if (!$res) {
			$this->error('报表为空');
		}

		$this->assign([
			'value' => $name,
			'list' => $res,
		]);
		return $this->fetch('createxionlist');

	}
	//////////
	// 创建执行方案
	public function implement() {
		if (request()->isPost()) {
			$data = input('post.');
			$data['data']['uid'] = $this->user['uid']; //自己
			//$data['data']['pid'] = input('pid'); //接任务的id
			//$data['data']['cid'] = input('cid'); //任务列表id
			$data['data']['intime'] = time();

			if (empty($data['data']['pid'])) {
				$this->error('请选择执行人');
			}

			$res = db('demand')->insert($data['data']);
			if ($res) {
				$uid = db('client')->where('id', $data['data']['cid'])->update(['order_id' => 30, 'operate_id' => $data['data']['pid']]);
				$message = db('client')->where('id',$data['data']['cid'])->find();
				$user_name = (new Admin)->field(true)->where('id',$message['service_id'])->find();
				$operate_name = (new Admin)->field(true)->where('id',$message['operate_id'])->find();
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
				$message_content = '【下发提醒】客户信息：'.$message['name'].'，'.$sex.'，北京，电话：'.$phone.'，微信：'.$wechat.'，业务：'.$business['name'].'。销售：'.$user_name['user_name'].'，请尽快执行！！';
				if(!empty($operate_name['firm_tel'])){
					message($message_content,$operate_name['firm_tel']);
				}
				$tice = db('notice')->insert(['user_id' => $data['data']['pid'], 'read_id' => 0, 'typeid' => 2, 'title' => $message_content, 'content' => $message_content, 'create_t' => time()]);
				msg(2, '提交成功');

			} else {
				msg(4, '提交成功失败');
			}

		}

		$this->assign('username', $this->username());
		$this->assign('cid', input('id'));
		return $this->fetch();
	}
	//更新
	public function upimplement() {
		if (request()->isPost()) {
			$data = input('post.');
			if (!empty($data['id'])) {msg(1, 'id不能为空');}
			$data['uptime'] = time();
			$res = db('demand')->where('id', $data['id'])->update($data);
			if ($res) {
				msg(2, '修改成功');
			} else {
				msg(4, '修改失败');
			}

		}

	}
	//删除
	public function delimplement() {
		if (request()->isPost()) {
			$data = input('post.id/');
			$res = db('demand')->where('id', $data)->delete();
			if ($res) {
				$this->success('删除成功');
			} else {
				$this->error('删除失败');
			}

		}
		return $this->fetch();
	}
	//执行方案周期报表列表
	public function createxionlist() {

		$id = input('id/');
		$name = input('get.value');
		if (empty($id)) {
			msg(4, 'id不能为空');
		}
		$res = db('demand')->where('cid', $id)
			->alias('d')
			->join('reply r', 'd.id=r.creid', 'left')
			->group('d.id')
			->field('d.*,r.id cid,r.isnot')
			->paginate(20, false, ['query' => request()->param()]);
		if (!$res) {
			$this->error('报表为空');
		}

		$this->assign([
			'value' => $name,
			'list' => $res,
		]);
		return $this->fetch();
	}
	//详情
	public function createxionnum($value = '') {
		$res = db('demand')->where('id', input('id/'))->find();
		$userid = db('client')->where('operate_id', $this->user['uid'])->find();

		if (!$res) {
			$this->error('读取失败');
		}
		$list = $this->replylist($res['id']);
		$id = db('reply')->where('creid', $res['id'])->find();
		$this->assign([
			'vo' => $res,
			'replylist' => $list,
			'userid' => $userid,
			'id' => $id['id'],
		]);
		return $this->fetch();
	}
	//任务回复列表
	public function replylist($id) {
		$res = db('reply')->where('creid', $id)->order('intime', 'desc')->paginate(10, false, ['query' => request()->param()]);
		if (!$res) {
			return '获取列表失败';
		} else {
			return $res;
		}
	}
	//任务回复
	public function replyin() {

		if (request()->isPost()) {
			$data = input('');
			$data['data']['intime'] = time();
			$res = db('reply')->insertGetId($data['data']);
			if ($res) {
				$cid = db('reply')->alias('r')->join('demand d', 'r.creid=d.id', 'left')->where('r.id', 102)->field('d.cid')->find();
				if ($cid) {
					$uid = db('client')->where('id', $cid['cid'])->update(['order_id' => 31]);
				}
				$this->success('提交成功');
			} else {
				$this->success('提交失败');
			}
		}
		$this->assign('id', input('id'));
		return $this->fetch();
	}
	//任务结束
	public function replynot() {
		$res = db('reply')->where('id', input('id'))->update(['isnot' => '1']);
		if ($res) {
			$this->success('结束任务成功');
		} else {
			$this->error('结束任务失败');
		}
	}
	//是否通过申请
	public function replyadopt() {
		if (request()->isPost()) {
			$data = input('post.');
			if (empty($data)) {
				msg(4, 'id不能为空');
			}
			if (empty($data['isadopt'])) {
				$this->error('');
				msg(4, '请选择是否通过审核');
			}
			if (empty($data['isadopt']) == 2) {
				if (empty($data['reason'])) {
					msg(4, '未通过理由不能为空');
				}
			}
			$res = db('reply')->where('id', $data['id'])->update($data);
			if ($res) {
				msg(2, '修改状态成功');
			} else {
				msg(4, '修改状态失败');
			}

		}
	}
	//执行方案周期报表
	public function createxion() {

		if (request()->isPost()) {
			$data = input('post');
			$data['intime'] = time();
			$res = db('createxion')->insert($data);
			if ($res) {
				$this->success('提交成功');
			} else {
				$this->error('提交失败');
			}
		}
		$this->assign('username', $this->username());
		$this->assign('cid', input('id'));
		return $this->fetch();
	}
//人员
	public function username() {
		$res = (new DutyModel)
			->alias('d')
			->join('admin a', 'd.user_id=a.id', 'left')
			->join('sectors s', 'a.sectors_id=s.id', 'left')
			->where(['d.status'=>1,'d.type_id'=>['not in','0,1']])
			->field('a.id,a.user_name,a.staff_major,a.homeoffice,a.sectors_id,a.quarters_id,s.name')
			->select();
		if ($res) {
			return $res;
		} else {
			return '读取失败';
		}

	}

	//排班运营
  public function arrange(){
    $list = (new DutyModel)->field(true)->where('type_id',2)->select();
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
  //排版运营的订单统计
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
  //添加排班运营
  public function arrangeadd(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['user_id'] = $post['member'];
      unset($post['business'],$post['member']);
      $post['status'] = 1;
      $post['type_id'] = 2;
      $post['start_time'] = time();
      if ((new DutyModel)->save($post)) {
        $data = array('msg'=>'添加值班运营成功','icon'=>6);
      }else{
        $data = array('msg'=>'添加值班运营失败','icon'=>5);
      }
      return json_encode($data);
    }else{
      $projects = (new Project)->field(true)->select();
      $this->assign('projects',$projects);
      return $this->fetch();
    }
  }
  //编辑排班运营
  public function arrangeedit(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['user_id'] = $post['member'];
      unset($post['business'],$post['member']);
      $post['status'] = 1;
      if ((new DutyModel)->update($post)) {
        $data = array('msg'=>'修改值班运营成功','icon'=>6);
      }else{
        $data = array('msg'=>'修改值班运营失败','icon'=>5);
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

	//删除排班运营
  public function arrangedel(){
    $id = input('post.id');
    if(DutyModel::destroy($id)){
      $return = array("msg"=>"删除值班运营成功","icon"=>6);
    }else{
      $return = array("msg"=>"删除值班运营失败","icon"=>5);
    }
    return json_encode($return);
  }
  //修改排班运营状态
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
