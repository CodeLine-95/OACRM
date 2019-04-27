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
class User extends Base{
  //我的资料
  public function index(){
    $list = (new Admin)->field(true)->where('id',$this->user['uid'])->find();
    //部门信息
    $Sectors = (new Sectors)->where('id',$list['sectors_id'])->find();
    $list->sectors = $Sectors['name'];
    //岗位
    $quarters = (new quarters)->where('id',$list['quarters_id'])->find();
    if($quarters){
      $list->quarters = $quarters['name'];
    }else{
      $list->quarters = '暂未分配';
    }
    $hobby = json_decode($list['staff_hobby'],true);
    $staff_skills = json_decode($list['staff_skills'],true);
    $this->assign('hobby',$hobby);
    $this->assign('staff_skills',$staff_skills);
    $this->assign('admin',$list);
    return $this->fetch();
  }
  //我的部门
  public function sectors(){
    $list = (new Admin)->field(true)->where('id',$this->user['uid'])->find();
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
    //城市
    $citys = (new Citys)->where('id',$list['citys_id'])->find();
    $list->city = $citys['name'];
    //项目
    $project = (new Project)->where(['id'=>['in',$list['project_id']]])->select();
    $list->project = $project;
    //业务
    $firm_business = (new Business)->where(['id'=>['in',implode(',',json_decode($list['firm_business'],true))]])->select();
    $list->firm_business = $firm_business;
    $role = (new Role)->where('id',$list['role_id'])->find();
    $list->role_name = $role['title'];
    $this->assign('admin',$list);
    return $this->fetch();
  }

  //我的账号
  public function media(){
    $list = (new Admin)->field(true)->where('id',$this->user['uid'])->find();
    $Medias = (new Medias)->where(['id'=>['in',$list['firm_distribution']]])->select();
    foreach ($Medias as $item) {
      $mediaType = (new Mediatype)->where('id',$item['type_id'])->find();
      $item->typename = $mediaType['typename'];
      $platform = (new Platform)->where('id',$item['platform_id'])->find();
      $item->platform = $platform['name'];
    }
    $this->assign('Medias',$Medias);
    return $this->fetch();
  }

  //我的打分
  public function scoring(){
    $user = (new Admin)->where('id',$this->user['uid'])->find();
    $intlogs = (new Intlog)->where(['time'=>['>=',newWeek()],'adminid'=>$user['id']])->select();
    $inter_num = 0;
    foreach ($intlogs as $item) {
      $inter_num += $item['number'];
    }
    $integral = (new Integral)->field(true)->select();
    $this->assign([
      'integral'=>$integral,
      'user'    =>$user,
      'inter_num'=>$inter_num
    ]);
    return $this->fetch();
  }
}
