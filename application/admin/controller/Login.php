<?php
namespace app\admin\controller;
use app\admin\model\Admin;
use think\Controller;
use app\admin\model\Rule;
use app\admin\model\Agent as Agents;
class Login extends Controller
{
    public function login(){
      return $this->fetch();
    }
    /**
     * @function login_action
     * @return  \jsonRPCServer string
     */
    public function login_action(){
        if (request()->isPost()) {
            $post = json_decode(request()->param()['data'],true);
            if(!captcha_check($post['vercode'])){
                $data = [
                  'msg' => '验证码输入不正确',
                  'icon' => 5
              ];
            }else{
                $res = (new Admin)->where('staff_num',$post['staff_num'])->find();
                if(empty($res)){
                  $data = [
                      'msg' => '账号错误，请重新填写！！！',
                      'icon' => 5
                  ];
                }else{
                  if (cms_pwd_verify($post['user_pwd'],$res['user_pwd'])) {
                    if ($res['user_status'] == 0) {
                      $data = [
                          'msg' => '员工账号冻结或离职！！',
                          'icon' => 5
                      ];
                    }else{
                      $AuthRule = new Rule();
                      $info = $AuthRule->getRoleInfo($res['role_id']);
                      $update = [
                          'last_login' => time(),
                          'user_host'  => request()->ip()
                      ];

                      (new Admin)->where('id',$res['id'])->update($update);
                      $session_user = array(
                          'uid'   => $res['id'],
                          'type'   => 2,
                          'username' => $res['user_name'],
                          'rolename' => $info['title'],
                          'rule'     => $info['rules'],
                          'rulename' => $info['url'],
                      );
                      session('user',$session_user);
                      $data = [
                          'msg'  => '登录成功，正在跳转中.....',
                          'icon'  => 6,
                      ];
                    }
                  }else {
                    $data = [
                        'msg' => '密码错误，请重新填写！！！',
                        'icon' => 5
                    ];
                  }
                }
            }
            return json_encode($data);
        }
    }
}
