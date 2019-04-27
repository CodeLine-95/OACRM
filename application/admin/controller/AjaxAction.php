<?php
namespace app\admin\controller;
use think\Controller;
use think\Cache;
use app\admin\model\Admin;
use app\admin\model\Rule;
use app\admin\model\Business as BusinessModel;
use app\admin\model\Quarters as Quarterse;
use app\admin\model\Project as ProjectModel;
use app\admin\model\Sectors as Sectorse;
use app\admin\model\Business;
use app\admin\model\Ditchlist as Ditchlists;
use app\admin\model\Media as Medias;
use app\admin\model\Mediatype;
use app\admin\model\Server as ServerModel;
use app\admin\model\Platform;
use app\admin\model\Siteyewu;
use app\admin\model\Backlog as BacklogNodel;
use app\admin\model\Industry as inModel;
use app\admin\model\IndustryCate as inCateModel;
use app\admin\model\Tools as ToolsModel;
use app\admin\model\Sitetype;
class AjaxAction extends Controller{
  // public function _initialize(){
  //   $this->user = session('user');
  //   $user = $this->user;
  //   if(!$user['uid']||!$user['username']){
  //     $this->redirect('login/login');
  //   }else{
  //     $this->assign('user',session('user'));
  //   }
  // }
  // 退出登陆
  public function logout(){
    session('user',NULL);
    $data = [
      'msg' => '退出成功！！！',
      'icon' => 6
    ];
    return json_encode($data);
  }
  /**
   * 获得一级菜单的所有子菜单
   * @param $id  一级菜单的id编号
   * @return string
   */
  public function getChildMenu(){
    $parent_id = input('id');
    $user = session('user');
    $childMenus = (new Rule)->getChildMenu($parent_id,$user['rule']);
    $str = "";
    foreach ($childMenus as $cm){
      $str .= '<li class="layui-nav-item">';
      if (!isset($cm['url'])) {
        $str .= '<a href="javascript:;" lay-tips="'.$cm['name'].'" lay-direction="2">
          <i class="layui-icon '.$cm['icon'].'"></i>
          <cite>'.$cm['name'].'</cite>
        </a>';
      }else{
        $str .= '<a lay-href="'.$cm['url'].'" lay-tips="'.$cm['name'].'" lay-direction="2">
          <i class="layui-icon '.$cm['icon'].'"></i>
          <cite>'.$cm['name'].'</cite>
        </a>';
      }
      if(!empty($cm['child'])){
        $str .= '<dl class="layui-nav-child">';
        foreach($cm['child'] as $cd){
          $str .= '<dd><a lay-href="'.$cd['url'].'" >
            <i class="layui-icon '.$cd['icon'].'"></i>
            <cite>'.$cd['name'].'</cite>
          </a>
        </dd>';
        }
        $str .= '</dl>';
      }
    }
    if(empty($str)){
    $str="<script>alert('您没有操作权限')</script>";
    }
    return $str;
  }
  /**
   * 上传图片的提交实例
   * @param $id  文件提交信息
   * @return string
   */
  public function upload(){
    $file = request()->file('file');//获取文件信息
    $path = 'uploads';//文件目录
    //创建文件夹
    if(!is_dir($path)){
      mkdir($path, 0755, true);
    }
    $info = $file->move($path);//保存在目录文件下
    if ($info && $info->getPathname()) {
      $data = [
        'status' => 1,
        'data' =>  '/'.$info->getPathname(),
      ];
      return json_encode($data);
    } else {
      return json_encode($file->getError());
    }
  }
  /**
   * 上传文件的提交实例
   * @param $id  文件提交信息
   * @return string
   */
  public function uploadfile(){
    $file = request()->file('file');//获取文件信息
    $path = 'uploads/files';//文件目录
    //创建文件夹
    if(!is_dir($path)){
      mkdir($path, 0755, true);
    }
    $info = $file->move($path);//保存在目录文件下
    if ($info && $info->getPathname()) {
      $data = [
        'status' => 1,
        'data' =>  '/'.$info->getPathname(),
      ];
      return json_encode($data);
    } else {
      return json_encode($file->getError());
    }
  }
  /**
   * 字节转换兆
   * @param $Bytes
   * @return string
   */
  public function getFileSize($Bytes){
    $p = 0;
    $format='bytes';
    if($Bytes>0 && $Bytes<1024){
      $p = 0;
      return number_format($Bytes).' '.$format;
    }
    if($Bytes>=1024 && $Bytes<pow(1024, 2)){
      $p = 1;
      $format = 'KB';
    }
    if ($Bytes>=pow(1024, 2) && $Bytes<pow(1024, 3)) {
      $p = 2;
      $format = 'MB';
    }
    if ($Bytes>=pow(1024, 3) && $Bytes<pow(1024, 4)) {
      $p = 3;
      $format = 'GB';
    }
    if ($Bytes>=pow(1024, 4) && $Bytes<pow(1024, 5)) {
      $p = 3;
      $format = 'TB';
    }
    $Bytes /= pow(1024, $p);

    return number_format($Bytes, 3).' '.$format;
  }
  // 清除缓存
  public function delruntime(){
    $this->clear_sys_cache();
    $this->clear_temp_ahce();
    $this->clear_log_chache();
    return 1;
  }
  public function clear_sys_cache() {
    Cache::clear();
    return true;
  }
  // 清除模版缓存 不删除 temp目录
  public function clear_temp_ahce() {
    array_map( 'unlink', glob( TEMP_PATH.DS.'.php' ) );
    return true;
  }
  // 清除日志缓存 不删出log目录
  public function clear_log_chache() {
    $path = glob( LOG_PATH.'/' );
    foreach ($path as $item) {
      array_map( 'unlink', glob( $item.DS.'.' ) );
      rmdir( $item );
    }
    return true;
  }
  // 修改密码
  public function password(){
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

  // 查询对应业务
	public function yewu(){
		$id = input('post.id');
		$bus =  (new Business)->where('project_id',$id)->select();
		$html = "";
		foreach ($bus as $key => $value) {
			$html.="<input type='checkbox' name='business' value='".$value['id']."' title='".$value['name']."'>";
		}
		return $html;
	}
  //多选项目查询对应的所有业务
  public function yewuall(){
		$post = input('post.');
		$bus =  (new Business)->where(['project_id'=>['in',$post['project_id']]])->select();
    $html = "";
    foreach ($bus as $key => $value) {
      if (isset($post['business_id'])) {
        $bussarray = explode(',',$post['business_id']);
        if (in_array($value['id'],$bussarray)) {
          $html.="<input type='checkbox' checked name='business' value='".$value['id']."' title='".$value['name']."'>";
        }else{
          $html.="<input type='checkbox' name='business' value='".$value['id']."' title='".$value['name']."'>";
        }
      }else{
        $html.="<input type='checkbox' name='business' value='".$value['id']."' title='".$value['name']."'>";
      }
    }
		return $html;
	}

  // 选择业务
  public function teamYewu(){
    $data = input('post.id');
    if($data=="999"){
      $html = "<input type='checkbox' name='firm_business' value='99999' title='全部业务' checked >";
    }else{
      $list = (new Business)->where('project_id',$data)->select();
      $html="";
      foreach ($list as $key => $value) {
        $html.="<input type='checkbox' name='firm_business' value='".$value['id']."' title='".$value['name']."'    {if condition='in_array(".$value['id'].","."$"."firm_business) eq true'} checked {"."/"."if}>";
      }
    }
    return $html;
  }

  //订单业务ajax
  public function orderYewu(){
    $project_id = input('post.project_id');
    $html="";
    if($project_id=="999"){
      $html .= "<input type='checkbox' name='firm_business' value='99999' title='全部业务' checked>";
    }else{
      $id = input('post.id');
      $list = (new Business)->where('project_id',$project_id)->select();
      $business = (new DutyModel)->where('id',$id)->find();
      $bussarray = explode(',',$business['business_list']);
      foreach ($list as $key => $value) {
        if (in_array($value['id'],$bussarray)) {
          $check = 'checked';
        }else{
          $check = '';
        }
        $html.="<input type='checkbox' name='firm_business' value='".$value['id']."' title='".$value['name']."' ".$check.">";
      }
    }
    return $html;
  }

  // 查询对应项目
	public function pro(){
		$id = input('post.id');
		$sec =  (new Sectorse)->where('id',$id)->find();
		$arr = explode(",",$sec['projects']);
		foreach ($arr as $key => $value) {
			$list[] = (new ProjectModel)->where('id',$value)->find();
		}
		$html = "";
		foreach ($list as $key => $value) {
      if(in_array($value['id'],$arr)){
        $check = 'checked';
      }else {
        $check = '';
      }
			// $html.="<option value='".$value['id']."'>".$value['name']."</option>";
      $html .= '<input type="checkbox" name="projects" '.$check.' title="'.$value['name'].'" value="'.$value['id'].'">';
		}
		return $html;
	}
	// 查询部门对应岗位
	public function quar(){
		$id = input('post.id');
		$data = input('post.');
		if(empty($data['quarters_id'])){
			$quarters_id="";
		}else{
			$quarters_id = $data['quarters_id'];
		}
		$list =  (new Quarterse)->where('sectors_id',$id)->select();
		$html = "";
		foreach ($list as $key => $value) {
			if($quarters_id==$value['id']){
				$html.="<option value='".$value['id']."' selected>".$value['name']."</option>";
			}else{
				$html.="<option value='".$value['id']."'>".$value['name']."</option>";
			}
		}
		return $html;
	}

  //搜索员工
  public function allteam(){
    $post = json_decode(input('post.data'),true);
    if($post['type'] == 1){
      $users = (new Admin)->field(true)->where(['staff_num'=>['like','%'.$post['value'].'%']])->select();
    }else{
      $users = (new Admin)->field(true)->where(['user_name'=>['like','%'.$post['value'].'%']])->select();
    }
    foreach ($users as $item) {
      // 部门
      $sectors = (new Sectorse)->where('id',$item['sectors_id'])->find();
      // 岗位
      $quarters = (new Quarterse)->where('id',$item['quarters_id'])->find();
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
      if(!empty($item['firm_report'])){
        $lingdao = (new Admin)->where('id',$item['firm_report'])->find();
        $item->shangji = $lingdao['user_name'];
      }else{
        $item->shangji = "暂无上级";
      }
      if ($sectors) {
        $item->sectors=$sectors['name'];
      }else{
        $item->sectors='暂无部门';
      }
      if ($quarters) {
        $item->quarters=$quarters['name'];
      }else{
        $item->quarters='暂无岗位';
      }
      if($yewu == ''){
        $item->yewu='暂无职责';
      }else{
        $item->yewu=$yewu;
      }
    }
    return json_encode($users);
  }

  // 选择服务
  public function service(){
    $data = input('post.id');
    $html = "";
    if ($data != 'all') {
      $busi = (new ServerModel)->where('business_id',$data)->select();
      $service = input('post.service');
      // $list = json_decode($busi['firm_service'],true);
      if(!empty($service)){
        $service = explode(",", $service);
        foreach ($busi as $key => $value) {
          if(!empty($value)){
            if(in_array($value['id'],$service)==true){
              $html.="<input type='checkbox' name='service' title='".$value['name']."' value='".$value['id']."' checked>";
            }else{
              $html.="<input type='checkbox' name='service' title='".$value['name']."' value='".$value['id']."'>";
            }
          }
        }
      }else{
        foreach ($busi as $key => $value) {
          $html.="<input type='checkbox' name='service' title='".$value['name']."' value='".$value['id']."'>";
        }
      }
    }else{
      $html.= "暂无服务";
    }
    return $html;
  }

  // 选择来源入口
  public function source(){
    $data = input('post.id');
    $list = (new Ditchlists)->where('typeid',$data)->select();
    $html = "";
    $source_id = input('post.source_id');
    foreach ($list as $key => $value) {
      if (!empty($source_id)) {
        if ($source_id == $value['id']) {
          $check = 'selected';
        }else{
          $check = '';
        }
        $html.="<option value='".$value['id']."' ".$check.">".$value['name']."</option>";
      }else{
        $html.="<option value='".$value['id']."'>".$value['name']."</option>";
      }
    }
    return $html;
  }

  // 选择咨询工具入口
  public function Tools(){
    $data = input('post.id');
    $list = (new ToolsModel)->where('ditchlist_id',$data)->select();
    $html = "";
    $tools_ids = explode(',',input('post.tools_ids'));
    foreach ($list as $key => $value) {
      if (!empty($tools_ids)) {
        if (in_array($value['id'],$tools_ids)) {
          $check = 'checked';
        }else{
          $check = '';
        }
        $html .= '<input type="checkbox" name="tools_ids" title="'.$value['entry_name'].'" value="'.$value['id'].'" '.$check.'>';
      }else{
        $html .= '<input type="checkbox" name="tools_ids" title="'.$value['entry_name'].'" value="'.$value['id'].'">';
      }
    }
    return $html;
  }

  // 选择业务2
  public function business(){
    $data = input('post.id');
    $list = (new Business)->where('project_id',$data)->select();
    $business = input('post.business');
    $html="";
    if (!empty($list)) {
      foreach ($list as $key => $value) {
        if(!empty($business)){
          if($business==$value['id']){
            $html.="<option value='".$value['id']."' selected>".$value['name']."</option>";
          }else{
            $html.="<option value='".$value['id']."'>".$value['name']."</option>";
          }
        }else{
          $html.="<option value='".$value['id']."'>".$value['name']."</option>";
        }
      }
    }else{
      $html.="<option value='all'>暂无业务</option>";
    }
    return $html;
  }

  // 部门人员筛选
  public function mems(){
   $data = input('post.id');
   $firm_report = input('post.firm_report');
   $list = (new Admin)->where('sectors_id',$data)->select();
   $html="";
   if(empty($list)){
    $html.="<option value='0'>暂无人员</option>";
   }else{
     foreach ($list as $key => $value) {
       if($firm_report == $value['id']){
         $html.="<option value='".$value['id']."' selected>".$value['user_name']."</option>";
       }else{
         $html.="<option value='".$value['id']."'>".$value['user_name']."</option>";
       }
     }
   }
   return $html;
  }

  // 提交编辑
  public function editsectors(){
   $data = json_decode(input('post.data'),true);
   $data['id'] = $data['member'];
   unset($data['member']);
   $i=0;
   $path = array();
   foreach ($data as $key => $value) {
      if(strpos($key,"firm_answer")!== false){
       $path[$i] = $value;
       unset($data[$key]);
       $i++;
      }
   }
   $data['firm_answer'] = json_encode($path);
   $ii=0;
   $path1 = array();
   foreach ($data as $key => $value) {
     if(strpos($key,"firm_business")!== false){
       $path1[$ii] = $value;
       unset($data[$key]);
       $ii++;
     }
   }
   $data['firm_hiredate']=strtotime($data['firm_hiredate']);
   $data['firm_leavedate']=strtotime($data['firm_leavedate']);
   $data['firm_business'] = json_encode($path1);
   if($data['staff_status'] == 2){
     $data['user_status'] = 0;
   }
    $re = (new Admin)->update($data);
    if($re){
     $return=array("msg"=>"分配部门成功","icon"=>6);
    }else{
     $return=array("msg"=>"分配部门失败","icon"=>5);
    }
    return json_encode($return);
  }

  // 搜索账号平台
  public function seekmem(){
    $id = input('post.id');
    $list = (new platform)->where('type_id',$id)->select();
    $html="";
    if(!empty($list)){
     foreach ($list as $key => $value) {
      $html.="<option value='".$value['id']."' >".$value['name']."</option>";
     }
    }
    return $html;
  }
  //搜索账号昵称
  public function mediaOne(){
    $id = input('post.id');
    $list = (new Medias)->where('platform_id',$id)->select();
    $html="";
    if(!empty($list)){
     foreach ($list as $key => $value) {
      $html.="<option value='".$value['id']."'>".$value['nick']."</option>";
     }
    }
    return $html;
  }
  // 所搜全部账号
  public function allmem(){
    $data=input('post.');
    $mem = (new Medias)->where($data)->select();
    $html="";
    foreach ($mem as $key => $one) {
      $typename = (new Mediatype)->where('id',$one['type_id'])->find();
      $platform = (new platform)->where('id',$one['platform_id'])->find();
      $html.="<tr id='del".$one['id']."'><td align='center'><input type='hidden' name='mem[".$one['id']."]' value='".$one['id']."'>".$typename['typename']."</td><td align='center'>".$platform['name']."</td><td align='center'>".$one['nick']."</td><td align='center'>".$one['loginsite']."</tb><td align='center'>".$one['name']."</td><td align='center'>".$one['pass']."</td><td align='center'><button class='layui-btn layui-btn-normal layui-btn-sm' onclick='deldel(".$one['id'].")'>删除</button></td></tr>";
    }
    return $html;
  }
  // 处理分配账号信息
  public function allotzhang(){
    $data = json_decode(input('post.data'),true);
    $mem = array();
    foreach ($data as $key => $value) {
      if(strpos($key,"mem[")!== false){
        $mem[] = $value;
        unset($data[$key]);
      }
    }
    $dist = implode(",",$mem);
    $firm_distribution = (new Admin)->where('id',$data['member'])->find();
    if (empty($firm_distribution['firm_distribution'])) {
      $firm = $dist;
    }else{
      $firms =  $dist.','.$firm_distribution['firm_distribution'];
      $firm_arr = explode(',',$firms);
      $firm_arr = array_unique($firm_arr);
      $firm = implode(",",$firm_arr);
    }
    if((new Admin)->where('id',$data['member'])->update(array('firm_distribution'=>$firm))){
      $return = array("msg"=>"账号分配成功","icon"=>6);
    }else{
      $return = array("msg"=>"账号分配失败","icon"=>5);
    }
    return json_encode($return);
  }

  // 编辑个人信息
  public function updateuser(){
    $data = json_decode(input('post.dataarr'),true);
    $data['id'] = $data['memberid'];
    unset($data['memberid']);
    if($data['updatetype']==1){
      $staff_hobby = explode(",",$data['staff_hobby']);
      $arr = array();
      foreach ($staff_hobby as $key => $value) {
        $arr[] = $value;
      }
      $data['staff_hobby'] = json_encode($arr);
    }elseif($data['updatetype']==2){
      $staff_skills = explode(",",$data['staff_skills']);
      $arr = array();
      foreach ($staff_skills as $key => $value) {
        if(!empty($value)){
          $arr[] = $value;
        }
      }
      $arr = array_unique($arr);
      $data['staff_skills'] = json_encode($arr);
    }elseif($data['updatetype']==3){

    }elseif($data['updatetype']==4){
      $firm_business = explode(",",$data['firm_business']);
      $arr = array();
      foreach ($firm_business as $key => $value) {
        if(!empty($value)){
          $arr[] = $value;
        }
      }
      $arr = array_unique($arr);
      $data['firm_business'] = json_encode($arr);
      $data['firm_hiredate']=strtotime($data['firm_hiredate']);
    }elseif($data['updatetype']==5) {
      if($data['firm_leavedate']=="1971-01-22"){
        $data['firm_leavedate']="";
      }else{
        $data['firm_leavedate']=strtotime($data['firm_leavedate']);
      }
      $firm_answer = explode(",",$data['firm_answer']);
      $arr = array();
      foreach ($firm_answer as $key => $value) {
        if(!empty($value)){
          $arr[] = $value;
        }
      }
      $arr = array_unique($arr);
      $data['firm_answer'] = json_encode($arr);
    }elseif($data['updatetype']==6){

    }
    unset($data['updatetype']);
    $re = (new Admin)->update($data);
    if($re){
      $return = array("msg"=>"员工信息更改成功","icon"=>6);
    }else{
      $return = array("msg"=>"员工信息更改失败","icon"=>5);
    }
    return json_encode($return);
  }

  //咨询工具ajax
  public function toolsAction(){
    $post = input('post.');
    $ditchlist = (new Ditchlists)->where('typeid',$post['ditch_id'])->select();
    $ditch_option = '';
    if ($ditchlist) {
      foreach ($ditchlist as $item) {
        if(isset($post['ditchlist_id'])){
          if ($post['ditchlist_id'] == $item['id']) {
            $check = 'selected';
          }else{
            $check = '';
          }
          $ditch_option .= '<option value="'.$item['id'].'" '.$check.'>'.$item['name'].'</option>';
        }else{
          $ditch_option .= '<option value="'.$item['id'].'" >'.$item['name'].'</option>';
        }
      }
    }else{
      $ditch_option .= '<option value="0">暂无来源</option>';
    }
    $ditch_str = '<select class="layui-input" name="ditchlist_id" id="ditchlist_id">'.$ditch_option.'</select>';
    return $ditch_str;
  }
  //业务设置ajax
  public function serverAction(){
    $post = input('post.');

  }
  //账号平台ajax
  public function platformAction(){
    $post = input('post.');
    $platform = (new Platform)->where('type_id',$post['type_id'])->select();
    $platform_option = '';
    if ($platform) {
      foreach ($platform as $item) {
        if(isset($post['platform_id'])){
          if ($post['platform_id'] == $item['id']) {
            $check = 'selected';
          }else{
            $check = '';
          }
          $platform_option .= '<option value="'.$item['id'].'" '.$check.'>'.$item['name'].'</option>';
        }else{
          $platform_option .= '<option value="'.$item['id'].'" >'.$item['name'].'</option>';
        }
      }
    }else{
      $platform_option .= '<option value="0">暂无平台</option>';
    }
    $platform_str = '<select class="layui-input" name="platform_id">'.$platform_option.'</select>';
    return $platform_str;
  }

  //供应商业务标签ajax
	public function lookyewu(){
		$id = input('post.id');
    $yewuType = (new Sitetype)->where(['id'=>['in',$id]])->order('id','asc')->select();
    $html="";
    foreach ($yewuType as $key => $type) {
      $yewu = (new Siteyewu)->where(['typeid'=>$type['id']])->order('id','asc')->select();
  		if(!empty($yewu)){
        $html .= '<div class="layui-form-item"><label>'.$type['typename'].'</label><div>';

  			foreach ($yewu as $key => $value) {
  				$html.="<input type='checkbox' name='yewuneirong' title='".$value['name']."' value='".$value['id']."'>";
  			}
        $html .= '</div></div>';
  		}
    }

		return $html;
	}

  //待办事项阅读状态
  public function backlogStatus(){
    $id = input('id');
    if ((new BacklogNodel)->where('id',$id)->update(['read_status'=>1])) {
      return array('icon'=>6);
    }else{
      return array('icon'=>5);
    }
  }

  //行业ajax请求方法
  public function industryAction(){
    $id = input('post.id');
    $inCateModel = new inCateModel();
    $inModel = new inModel();
    $field = $inModel->where('id',$id)->find();
    $catelist = $inCateModel->field(true)->select();
    if ($field['id'] == 0) {
      $html = '<option value="0" selected>请选择</option>';
    }else{
      $html = '<option value="0">请选择</option>';
    }
    foreach ($catelist as $cate) {
      $html .= '<optgroup label="'.$cate['name'].'">';
      $industry = $inModel->where('cate_id',$cate['id'])->select();
      foreach ($industry as $in) {
        if ($field['id'] == $in['id']) {
          $selected = 'selected';
        }else{
          $selected = '';
        }
        $html .= '<option value="'.$in['id'].'" '.$selected.'>'.$in['name'].'</option>';
      }
      $html .= '</optgroup>';
    }
    return $html;
  }

  //通知
  public function noticestatus(){
    $id = input('id');
    if (db('notice')->where('id',$id)->update(['read_id'=>1])) {
      return array('icon'=>6);
    }else{
      return array('icon'=>5);
    }
  }
}
