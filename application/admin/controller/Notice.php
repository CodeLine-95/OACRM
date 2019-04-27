<?php
namespace app\admin\controller;
use app\admin\controller\base\Base;
class Notice extends Base
{
  //全部消息
  public function noticeall(){
    $noticeall = db('notice')->order('create_t','desc')->select();
    foreach ($noticeall as $k=>$n) {
      $user = db('admin')->where('id',$n['user_id'])->find();
      if ($user) {
        $noticeall[$k]['user_name'] = $user['user_name'];
      }else{
        $noticeall[$k]['user_name'] = '';
      }
    }
    $this->assign('noticeall',$noticeall);
    return $this->fetch();
  }
  //派单消息
  public function dispatch(){
    if ($this->user['uid'] == 1) {
      $dispatch = db('notice')->alias('n')->join('admin a','n.user_id = a.id')->field('n.*,a.user_name')->where(['n.typeid'=>2])->order('n.create_t','desc')->select();
    }else{
      $dispatch = db('notice')->alias('n')->join('admin a','n.user_id = a.id')->field('n.*,a.user_name')->where(['n.typeid'=>2,'n.user_id'=>$this->user['uid']])->order('n.create_t','desc')->select();
    }
    $this->assign('user_id',$this->user['uid']);
    $this->assign('dispatch',$dispatch);
    return $this->fetch();
  }
  //待办消息
  public function backlog(){
    $backlog = db('notice')->where('typeid',3)->order('create_t','desc')->select();
    $this->assign('backlog',$backlog);
    return $this->fetch();
  }
  //系统消息
  public function system(){
    $system = db('notice')->where('typeid',1)->order('create_t','desc')->select();
    $this->assign('system',$system);
    return $this->fetch();
  }
  //发布消息
  public function add(){
    if (request()->isPost()) {
      $post = json_decode(input('post.data'),true);
      $post['typeid'] = 1;
      $post['create_t'] = time();
      // if ($post['release_id'] != 0) {
      //   $sectors = db('admin')->where('sectors_id',$post['release_id'])->select();
      //   foreach ($sectors as $s) {
      //     db('notice')->insert($post)
      //   }
      // }
      if (db('notice')->insert($post)) {
        $data = ['msg'=>'发布成功！','icon'=>6];
      }else{
        $data = ['msg'=>'发布失败！','icon'=>5];
      }
      return json_encode($data);
    }else {
      $sectors = db('sectors')->select();
      $this->assign('sectors',$sectors);
      return $this->fetch();
    }
  }
}
