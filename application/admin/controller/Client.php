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
class Client extends Base
{
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
  // 今日订单
 	public function todayorder(){
    $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
    $where = [
      'update_t'=>['>',$todayStart],
      'service_id'=>$this->user['uid'],
      'order_id'=>['neq',25]
    ];
    $this->assign('list',$this->orderAction($where));
    return $this->fetch();
 	}
}
