<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
class Cases extends Base
{
  public function casesAction($where=''){
    $cases = db('cases')
      ->alias('c')
      ->join('business b','c.service_id=b.id')
      ->join('industry i','c.trade=i.id')
      ->join('admin a','c.uid=a.id')
      ->where($where)
      ->field('c.*,b.name business,i.name trade,a.user_name user_name')
      ->order('c.create_t','desc')
      ->select();
    $hang = $this->hang();
    $this->assign('cases',$cases);
  }
  /* 全部案例 */
  public function index(){
    $this->casesAction();
    return $this->fetch();
  }
  /* 自营案例 */
  public function autotrophy(){
    $this->casesAction(['c.type_id'=>0]);
    return $this->fetch('index');
  }
  /* 行业案例 */
  public function trade(){
    $this->casesAction(['c.type_id'=>1]);
    return $this->fetch('index');
  }
  /* 案例详情 */
  public function show(){
    $id = input('id');
    $field = db('cases')
      ->alias('c')
      ->join('business b','c.service_id=b.id')
      ->join('industry i','c.trade=i.id')
      ->join('admin a','c.uid=a.id')
      ->where('c.id',$id)
      ->field('c.*,b.name business,i.name trade,a.user_name user_name')
      ->find();
    $hang = $this->hang();
    $this->assign('field',$field);
    return $this->fetch();
  }
  /* 创建案例 */
  public function create(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $post['cooperating_start'] = strtotime($post['cooperating_start']);
      $post['cooperating_end'] = strtotime($post['cooperating_end']);
      $post['citys'] = $post['city-picker'];
      $post['create_t'] = time();
      unset($post['file'],$post['city-picker']);
      $post = array_filter($post);
      $post['uid'] = $this->user['uid'];
      if (db('cases')->insert($post)) {
        $data = [
          'msg'  =>  '创建成功！数据已添加！',
          'icon' => 6
        ];
      }else{
        $data = [
          'msg'  =>  '创建失败！数据未添加！',
          'icon' => 5
        ];
      }
      return json_encode($data);
    }else{
      $hang = $this->hang();
      $services = db('business')->field('id,name')->select();
      $this->assign('services',$services);
      return $this->fetch();
    }
  }
  /* 编辑案例 */
  public function edit(){
    if(request()->isPost()){
      $post = json_decode(input('post.data'),true);
      $post['cooperating_start'] = strtotime($post['cooperating_start']);
      $post['cooperating_end'] = strtotime($post['cooperating_end']);
      $post['citys'] = $post['city-picker'];
      unset($post['file'],$post['city-picker']);
      $post = array_filter($post);
      if (db('cases')->update($post)) {
        $data = [
          'msg'  =>  '编辑成功！数据已更新！',
          'icon' => 6
        ];
      }else{
        $data = [
          'msg'  =>  '编辑失败！数据未更新！',
          'icon' => 5
        ];
      }
      return json_encode($data);
    }else{
      $hang = $this->hang();
      $services = db('business')->field('id,name')->select();
      $this->assign('services',$services);
      $field = db('cases')->where('id',input('id'))->find();
      $this->assign('field',$field);
      return $this->fetch();
    }
  }
  /* 删除 */
  public function del(){
    $id = input('post.id');
    if (db('cases')->delete($id)) {
      $data = ['msg'=>'删除成功','icon'=>6];
    }else{
      $data = ['msg'=>'删除失败','icon'=>5];
    }
    return json_encode($data);
  }
  /* 行业类型 */
  public function hang(){
    $hang = [
        "1" => "政府单位",
    		"2" => "央企|国企",
    		"3"=> "互联网|AI",
    		"4"=> "科技|研发",
    		"5"=> "金融|银行",
    		"6"=> "教育|培训",
    		"7"=> "电商|O2O",
    		"8"=> "数码|家电",
    		"9"=> "汽车|4S店",
    		"10"=> "旅游|景点",
    		"11"=> "医疗|健康",
    		"12"=> "餐饮|美食",
    		"13"=> "酒店|住宿",
    		"14"=> "装修|建材",
    		"15"=> "家居|家纺",
    		"16"=> "房产|物业",
    		"17"=> "农林牧渔",
    		"18"=> "生活|家政",
    		"19"=> "超市|门店",
    		"20"=> "服饰|鞋帽",
    		"21"=> "物流|快递",
    		"22"=> "建筑|设计",
    		"23"=> "交通|运输",
    		"24"=> "体育|娱乐",
    		"25"=> "美容|养生",
    		"26"=> "美妆|护肤",
    		"27"=> "商场|广场",
    		"28"=> "批发|零售",
    		"29"=> "五金|器具",
    		"30"=> "生物|医药",
    		"31"=> "亲子|母婴",
    		"32"=> "茶饮|酒水",
    		"33"=> "图书|音像",
    		"34"=> "蛋糕|烘培",
    		"35"=> "礼品|鲜花",
    		"36"=> "休闲|娱乐",
    		"37"=> "婚庆|摄影",
    		"38"=> "人力|招聘",
    		"39"=> "矿业|能源",
    		"40"=> "咨询|服务",
    		"41"=> "生鲜|果蔬",
    		"42"=> "珠宝|饰品",
    		"43"=> "二手交易",
    		"44"=> "行业平台",
    		"45"=> "机械|制造",
    		"46"=> "公益活动",
      ];
      $this->assign('hang',$hang);
      return $hang;
  }
}
