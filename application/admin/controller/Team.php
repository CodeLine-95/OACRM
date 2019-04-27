<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
use app\admin\model\Admin;
use app\admin\model\Sectors;
use app\admin\model\Quarters;
use app\admin\model\Citys;
use app\admin\model\Project;
use app\admin\model\Business;
use app\admin\model\Media as Medias;
use app\admin\model\Mediatype;
use app\admin\model\Intlog;
use app\admin\model\Ditchlist as Ditchlists;
use app\admin\model\Role;
use app\admin\model\Integral;
use app\admin\model\Platform;
class Team extends Base
{
  public function index(){
   	if(request()->isPost()){
      $post = input('post.');
      $where = [];
      switch ($post['type']) {
        case 1:
          $where['user_name'] = ['like','%'.$post['value'].'%'];
          break;

        case 2:
          $where['staff_num'] = ['like','%'.$post['value'].'%'];
          break;

        case 3:
          $where['staff_idcard'] = ['like','%'.$post['value'].'%'];
          break;

        case 4:
          $where['staff_tel'] = ['like','%'.$post['value'].'%'];
          break;
      }
      $list = (new Admin)->field(true)->where($where)->order('staff_num','asc')->select();
   	}else{
   	 	$list = (new Admin)->field(true)->where('user_name','neq','admin')->order('staff_num','asc')->select();
   	}
    foreach($list as $l){
      //部门编号
      $Sectors = (new Sectors)->where('id',$l['sectors_id'])->find();
      $l->sectors = $Sectors['name'];
      $l->sectors_author = $Sectors['author'];
      //岗位
      $quarters = (new quarters)->where('id',$l['quarters_id'])->find();
      if($quarters){
	    $l->quarters = $quarters['name'];
      }else{
	    $l->quarters = '暂未分配';
      }
      $role = (new Role)->where('id',$l['role_id'])->find();
      $l->role_name = $role['title'];
    }
    $this->assign('list',$list);
    return $this->fetch();
  }

  public function add(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $staff_hobby = $one = array();
      foreach($post as $key=>$value){
        if (strpos($key,'staff_hobby') !== false) {
          $staff_hobby[] = $post[$key];
          unset($post[$key]);
        }
      }
      $post['user_pwd'] = cms_pwd_encode($this->conf['pwd']);
      unset($post['file']);
      $post['staff_hobby'] = json_encode($staff_hobby);
      $post['staff_skills'] = json_encode(array_filter(explode(',',$post['staff_skills'])));
      $post['user_host'] = request()->ip();
      $post['create_time'] = time();
      $post['user_status'] = 1;
      $res = db('admin')->where('staff_num',$post['staff_num'])->find();
      if ($res) {
        $data = [
          'msg'   => '该用户已存在，请勿重复添加！！',
          'icon'  => 5
        ];
      }else{
        if ((new Admin)->save($post)) {
          $data = [
            'msg'   => '添加成功',
            'icon'  => 6
          ];
        }else{
          $data = [
            'msg'   => '添加失败',
            'icon'  => 5
          ];
        }
      }
      return json_encode($data);
     }else{
      if ($this->user['uid'] == 1 || $this->user['uid'] == 32) {
        $tpl = 'add_admin';
      }else{
        $tpl = 'add';
      }
      $lastnum = (new Admin)->field('staff_num')->order('id','desc')->find()->toArray();
      $staff_biuld = 'JT'.sprintf("%05d", findNum($lastnum['staff_num'])+1);
      $this->assign('staff_biuld',$staff_biuld);
      return $this->fetch($tpl);
    }
  }
  // 编辑人员
  public function edit($id=0){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $staff_hobby = $one = array();
      foreach($post as $key=>$value){
        if (strpos($key,'staff_hobby') !== false) {
          $staff_hobby[] = $post[$key];
          unset($post[$key]);
        }
      }
      unset($post['file']);
      $post['staff_hobby'] = json_encode($staff_hobby);
      $post['staff_skills'] = json_encode(array_filter(explode(',',$post['staff_skills'])));
      $post['user_host'] = request()->ip();
      if ((new Admin)->update($post)) {
        $data = [
          'msg'   => '编辑成功',
          'icon'  => 6
        ];
      }else{
        $data = [
          'msg'   => '编辑失败',
          'icon'  => 5
        ];
      }
      return json_encode($data);
    }else{
      if ($this->user['uid'] == 1) {
        $tpl = 'edit_admin';
      }else{
        $tpl = 'edit';
      }
      $admin = (new Admin)->where('id',$id)->find()->toArray();
      $staff_hobby = json_decode($admin['staff_hobby'],true);
      $staff_skills = json_decode($admin['staff_skills'],true);
      $staff_skills2 = implode(",", $staff_skills);
      $this->assign('staff_hobby',$staff_hobby);
      $this->assign('staff_skills',$staff_skills);
      $this->assign('staff_skills2',$staff_skills2);
      $this->assign('admin',$admin);
      return $this->fetch($tpl);
    }
   }
   // 删除员工账户
   public function del(){
    $id = input('post.id');
    if(Admin::destroy($id)){
      $return = array("msg"=>"删除员工成功","icon"=>6);
    }else{
      $return = array("msg"=>"删除员工失败","icon"=>5);
    }
    return json_encode($return);
  }
  // 部门管理
  public function sectors(){
    if(!empty($id)){
   		$member = (new Admin)->where('id',$id)->find();
 	 		$firm_answer = json_decode($member['firm_answer'],true);
 	 		$firm_business = json_decode($member['firm_business'],true);
 	 		$type=1;
      if(!empty($member['firm_report'])){
        $mem = (new Admin)->where('id',$member['firm_report'])->find();
        $member['bumen']=$mem['sectors_id'];
      }else{
        $member['bumen']="";
      }
    }else{
      $firm_answer=array();
      $member=array();
   		$type=0;
      $firm_business=array();
      $member['firm_report']="";
      $member['bumen']="";
      $member['firm_type']="";
      $member['firm_incumbency']="";
      $member['staff_status']="";
      $member['sectors_id']="";
      $member['quarters_id']="";
      $member['firm_report']="";
      $member['bumen']="";
    }
    // 全部部门
    $sectors = (new Sectors)->select();
    // 全部岗位
    $quarters = (new Quarters)->select();
    // 全部业务
    $pro = (new Project)->select();
    $city = (new Citys)->where("type=1 or type=0")->select();
    $this->assign('city',$city);
    $this->assign('pro',$pro);
    $this->assign('firm_business',$firm_business);
    $this->assign('type',$type);
    $this->assign('firm_answer',$firm_answer);
    $this->assign('member',$member);
    $this->assign('sectors',$sectors);
    $this->assign('quarters',$quarters);
    $roles = (new Role)->select();
    $this->assign('roles',$roles);
    return $this->fetch();
  }

   // 分配账号
   public function media(){
     if(request()->isPost()){
        $data = input('post.');
        $type = $data['type'];
        if($type==1){
          $where = [
             'staff_num'  => ['like','%'.$data['value'].'%']
            ];
        }elseif($type==2){
          $where = [
              'user_name'  => ['like','%'.$data['value'].'%']
            ];
        }
        $list = (new Admin)->where($where)->where("id!=1")->select();
        foreach ($list as $key => $value) {
         // 部门
          $sectors = (new Sectors)->where('id',$value['sectors_id'])->find();
          // 岗位
          $quarters = (new Quarters)->where('id',$value['quarters_id'])->find();
          // 业务
          $arr = json_decode($value['firm_business'],true);
          $yewu = "";
          if(!empty($arr)){
            foreach ($arr as $k => $v) {
              $yyy = (new Business)->where('id',$v)->find();
              $yewu.=$yyy['name']."&nbsp;&nbsp;";
            }
          }
          if(!empty($value['firm_report'])){
            $lingdao = (new Admin)->where('id',$value['firm_report'])->find();
            $value['shangji'] = $lingdao['user_name'];
          }else{
            $value['shangji'] = "暂无上级";
          }
          $value['sectors']=$sectors['name'];
          $value['quarters']=$quarters['name'];
          $value['yewu']=$yewu;

       }
        $this->assign('list',$list);
     }
     $typelist = (new Mediatype)->select();
     $this->assign('typelist',$typelist);
     return $this->fetch();
   }

   // 员工积分考核
   public function integral(){
     if(request()->isPost()){
      $data = input('post.');
      $where = array();
      if(!empty($data['year'])&&!empty($data['month'])&&!empty($data['week'])){
        $arr = $this->getTime($data['year'],$data['month']);
        $starttime = $arr[$data['week']]['start'];
        $endtime = $arr[$data['week']]['end'];
        $where['time'] = array(array('gt',$starttime),array('lt',$endtime));
        $where1 = array();
        if(!empty($data['name']))
        {
          $where1 = [
               'user_name'  => ['like','%'.$data['name'].'%']
              ];
        }
        if(!empty($data['iacard']))
        {
           $where1 = [
               'staff_idcard'  => ['like','%'.$data['idcard'].'%']
              ];
        }
        // 查询所有的查询到的用户
        $list = (new Admin)->where($where1)->select();
        foreach ($list as $key => $value) {
          // 查询当前员工在所在的日期内的积分记录
          $value['weekcount'] = (new Intlog)->where($where)->where('adminid',$value['id'])->count('number');
          // 查询所处时间的当前月开始和结束时间
          $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
          $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
          $value['monthcount'] = (new Intlog)->where("adminid={$value['id']} and time>{$beginThismonth} and time<{$endThismonth}")->count('number');
          // 查询当前员工所处部门
          $sectors = (new Sectors)->where('id',$value['sectors_id'])->find();
          $value['sectors'] = $sectors['name'];
          // 处理员工当月分数等级
          if($value['monthcount']>=500)
          {
            $value['class'] = "A级";
          }elseif(500>$value['monthcount']&&$value['monthcount']>=300)
          {
            $value['class'] = "B级";
          }elseif(300>$value['monthcount']&&$value['monthcount']>=100){
            $value['class'] = "C级";
          }else{
            $value['class'] = "D级";
          }
          // 处理员工等级
          if($value['firm_rank']==1){
            $value['calssname'] = "P1";
          }elseif($value['firm_rank']==2){
            $value['calssname'] = "P2";
          }elseif($value['firm_rank']==3){
            $value['calssname'] = "P3";
          }elseif($value['firm_rank']==4){
            $value['calssname'] = "P4";
          }elseif($value['firm_rank']==5){
            $value['calssname'] = "P5";
          }elseif($value['firm_rank']==6){
            $value['calssname'] = "P6";
          }elseif($value['firm_rank']==7){
            $value['calssname'] = "P7";
          }elseif($value['firm_rank']==8){
            $value['calssname'] = "P8";
          }elseif($value['firm_rank']==9){
            $value['calssname'] = "P9";
          }else{
            $value['calssname'] = "未划分的等级";
          }
          // 查询累计积分
          $value['zongcount'] = (new Intlog)->where("adminid={$value['id']}")->count('number');
        }
      }else{
          if(!empty($data['name']))
          {
            $where = [
                 'user_name'  => ['like','%'.$data['name'].'%']
                ];
          }
          if(!empty($data['iacard']))
          {
             $where = [
                 'staff_idcard'  => ['like','%'.$data['idcard'].'%']
                ];
          }
          // 查询所有的查询到的用户
          $list = (new Admin)->where($where)->select();
          // 处理用户数据
          foreach ($list as $key => $value) {
            // 查询当前时间
            $time = time();
            // 查询当前所处的年月
            $year = date('Y',time());
            $month = date('m',time());
            // 查询当月星期数返回二维数组
            $week = $this->getTime($year,$month);
            // 查询出当前日期坐在周
            foreach ($week as $k => $v) {
              // 当查询出所在周之后
              if($v['end']>$time&&$time>$v['start']){
                // 查询当前周中该员工所有的积分
                $value['weekcount'] = (new Intlog)->where("adminid={$value['id']} and time>{$v['start']} and time<{$v['end']}")->count('number');
              }
              break;
            }
            // 查询所处时间的当前月开始和结束时间
            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
            $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
            $value['monthcount'] = (new Intlog)->where("adminid={$value['id']} and time>{$beginThismonth} and time<{$endThismonth}")->count('number');
            // 查询当前员工所处部门
            $sectors = (new Sectors)->where('id',$value['sectors_id'])->find();
            $value['sectors'] = $sectors['name'];
            // 处理员工当月分数等级
            if($value['monthcount']>=500)
            {
              $value['class'] = "A级";
            }elseif(500>$value['monthcount']&&$value['monthcount']>=300)
            {
              $value['class'] = "B级";
            }elseif(300>$value['monthcount']&&$value['monthcount']>=100){
              $value['class'] = "C级";
            }else{
              $value['class'] = "D级";
            }
            // 处理员工等级
            if($value['firm_rank']==1){
              $value['calssname'] = "P1";
            }elseif($value['firm_rank']==2){
              $value['calssname'] = "P2";
            }elseif($value['firm_rank']==3){
              $value['calssname'] = "P3";
            }elseif($value['firm_rank']==4){
              $value['calssname'] = "P4";
            }elseif($value['firm_rank']==5){
              $value['calssname'] = "P5";
            }elseif($value['firm_rank']==6){
              $value['calssname'] = "P6";
            }elseif($value['firm_rank']==7){
              $value['calssname'] = "P7";
            }elseif($value['firm_rank']==8){
              $value['calssname'] = "P8";
            }elseif($value['firm_rank']==9){
              $value['calssname'] = "P9";
            }else{
              $value['calssname'] = "未划分的等级";
            }
            // 查询累计积分
            $value['zongcount'] = (new Intlog)->where("adminid={$value['id']}")->count('number');
          }
      }
      foreach ($list as $key => $value) {

      }
     }else{
      $list = (new Intlog)->paginate(10);
     }
     return $this->fetch();
   }

   // 个人资料
   public function user(){
     if(request()->isPost()){
       $post = json_decode(input('post.data'),true);
       $staff_hobby = $one = array();
       foreach($post as $key=>$value){
         if (strpos($key,'staff_hobby') !== false) {
           $staff_hobby[] = $post[$key];
           unset($post[$key]);
         }
       }
       unset($post['file']);
       $post['staff_hobby'] = json_encode($staff_hobby);
       $post['staff_skills'] = json_encode(array_filter(explode(',',$post['staff_skills'])));
       $post['user_host'] = request()->ip();
       if ((new Admin)->update($post)) {
         $data = [
           'msg'   => '编辑成功',
           'icon'  => 6
         ];
       }else{
         $data = [
           'msg'   => '编辑失败',
           'icon'  => 5
         ];
       }
       return json_encode($data);
     }else{
       $admin = (new Admin)->where('id',$this->user['uid'])->find()->toArray();
       $staff_hobby = json_decode($admin['staff_hobby'],true);
       $staff_skills = json_decode($admin['staff_skills'],true);
       $staff_skills2 = implode(",", $staff_skills);
       $this->assign('staff_hobby',$staff_hobby);
       $this->assign('staff_skills',$staff_skills);
       $this->assign('staff_skills2',$staff_skills2);
       $this->assign('admin',$admin);
       return $this->fetch();
     }
   }
   /**
   *   得到对应的时间戳
   *   @method  getTime
   *   deep
   *   @param   [string]   $year   [年份]
   *   @param   [string]   $month  [月份]
   *   @return  [array]    ['YearDay','MonthDay','normalWeek','week','month']       [时间戳]
   */
  public function getTime($current_year,$current_month)
  {
    $firstday = strtotime($current_year.'-'.$current_month.'-01');
    //计算本月头一天的星期一
    $monday=$firstday-86400*(date('N',$firstday)-1);//计算第一个周一的日期
    //由于每个月只有四周 让 $i 从 1 到 5 增加即可
    $arr = array();
    for ($i=1; $i <= 5; $i++) {
        $start=date("Y-m-d",$monday+($i-1)*86400*7);//起始周一
        $end=date("Y-m-d",$monday+$i*86399*7);//结束周日
        if(date('m',$monday+$i*86399*7)!=$current_month)
        {
            continue;
        }
        $arr[$i]['start'] = strtotime($start);
        $arr[$i]['end'] = strtotime($end);
    }
    return $arr;
  }

  //打分
  public function scoring(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $one_num = $one_score = $score_nums = [];
			foreach($post as $key=>$value){
				if (strpos($key,'score') !== false) {
					$one_score[] = $value;
					unset($post[$key]);
				}else{
					continue;
				}
			}
			foreach($post as $key=>$value){
				if (strpos($key,'num') !== false) {
					$one_num[] = $value;
					unset($post[$key]);
				}else{
					continue;
				}
			}
			for($i=0;$i<count($one_num);$i++){
				$score_nums[$i]['score'] = $one_score[$i];
				$score_nums[$i]['num'] = $one_num[$i];
			}
      $num = 0;
      foreach ($score_nums as $one) {
        $num += intval($one['score'])*intval($one['num']);
      }
      $data['time'] = time();
      $data['adminid'] = $post['id'];
      $data['number'] = $num;
      if ((new Intlog)->save($data)) {
        $return = ['msg'=>'员工打分成功','icon'=>6];
      }else{
        $return = ['msg'=>'员工打分失败','icon'=>5];
      }
      return json_encode($return);
    }else{
      $id = input('id');
      $user = (new Admin)->where('id',$id)->find();
      $intlogs = (new Intlog)->where(['time'=>['>=',newWeek()],'adminid'=>$user['id']])->select();
      $inter_num = 0;
      foreach ($intlogs as $item) {
        $inter_num += $item['number'];
      }
      $integral = (new Integral)->field(true)->select();
      $this->assign([
        'integral'=>$integral,
        'user'    =>$user,
        'inter_num' => $inter_num
      ]);
      return $this->fetch();
    }
  }

  //员工详情
  public function show(){
    $id = input('id');
    $list = (new Admin)->field(true)->where('id',$id)->find();
    //部门信息
    $Sectors = (new Sectors)->where('id',$list['sectors_id'])->find();
    $list->sectors = $Sectors['name'];
    //汇报对象
    $list->author = $Sectors['author'];
    //岗位
    $quarters = (new quarters)->where('id',$list['quarters_id'])->find();
    if($quarters){
      $list->quarters = $quarters['name'];
    }else{
      $list->quarters = '暂未分配';
    }
    $hobby = json_decode($list['staff_hobby'],true);
    $staff_skills = json_decode($list['staff_skills'],true);
    //城市
    $citys = (new Citys)->where('id',$list['citys_id'])->find();
    $list->city = $citys['name'];
    //项目
    $project = (new Project)->where(['id'=>['in',$list['project_id']]])->select();
    $list->project = $project;
    //业务
    if (empty($list['firm_business'])) {
      $firm_business = [];
    }else{
      $firm_business = (new Business)->where(['id'=>['in',implode(',',json_decode($list['firm_business'],true))]])->select();
    }
    $list->firm_business = $firm_business;
    $role = (new Role)->where('id',$list['role_id'])->find();
    $list->role_name = $role['title'];

    //账号
    $Medias = (new Medias)->where(['id'=>['in',$list['firm_distribution']]])->select();
    foreach ($Medias as $item) {
      $mediaType = (new Mediatype)->where('id',$item['type_id'])->find();
      $item->typename = $mediaType['typename'];
      $platform = (new Platform)->where('id',$item['platform_id'])->find();
      $item->platform = $platform['name'];
    }
    $this->assign('Medias',$Medias);

    $this->assign('hobby',$hobby);
    $this->assign('staff_skills',$staff_skills);
    $this->assign('admin',$list);
    return $this->fetch();
  }
  //账号详情
  public function medias(){
    $id = input('id');
    $list = (new Admin)->field(true)->where('id',$id)->find();
    $Medias = (new Medias)->where(['id'=>['in',rtrim($list['firm_distribution'],',')]])->select();
    foreach ($Medias as $item) {
      $mediaType = (new Mediatype)->where('id',$item['type_id'])->find();
      $item->typename = $mediaType['typename'];
      $platform = (new Platform)->where('id',$item['platform_id'])->find();
      $item->platform = $platform['name'];
    }
    $this->assign('Medias',$Medias);
    $this->assign('id',$id);
    return $this->fetch();
  }
  //删除分配的账号
  public function mediadel(){
    $id = input('post.id');
    $user_id = input('post.user_id');
    $list = (new Admin)->field(true)->where('id',$user_id)->find();
    $medias = explode(',',$list['firm_distribution']);
    if (in_array($id,$medias)) {
      $key = array_search($id,$medias);
      unset($medias[$key]);
    }
    $firm = implode(",",$medias);
    if((new Admin)->where('id',$user_id)->update(array('firm_distribution'=>$firm))){
      $return = array("msg"=>"删除分配的账号成功！","icon"=>6);
    }else{
      $return = array("msg"=>"删除分配的账号失败！","icon"=>5);
    }
		return json_encode($return);
  }
}
