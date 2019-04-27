<?php
/**
 * 文件路径： \application\index\job\sendActivationTel.php
 * 这是一个消费者类，用于处理 sendActivationTel 队列中的任务
 */
namespace app\admin\controller\job;
use think\queue\Job;
use think\Db;
use think\Exception;
class sendActivationTel {
  /**
   * fire方法是消息队列默认调用的方法
   * @param Job            $job      当前的任务对象
   * @param array|mixed    $data     发布任务时自定义的数据
   */
  public function fire(Job $job,$data){
    $isJobDone = $this->sendTel($data);
    if ($isJobDone) {
      //如果任务执行成功，记得删除任务
      print ("<warn>任务执行成功,,已经删除!" . "</warn>\n");
      // $job->delete();
    }else{
      print ("<warn>任务执行失败!" . "</warn>\n");
      if ($job->attempts() > 3) {
        //通过这个方法可以检查这个任务已经重试了几次了
        print ("<warn>删除任务!" . "</warn>\n");
        // $job->delete();
      }else{
        $job->release(); //重发任务
        print ("<info>重新执行!第" . $job->attempts() . "次重新执行!</info>\n");
      }
    }
  }
  /**
   * 根据消息中的数据进行实际的业务处理
   * @param array|mixed  $data    发布任务时自定义的数据
   * @return boolean              任务执行的结果
   */
  private function sendTel($data) {
    $options = config('queue');
    $todayStart = strtotime(date('Y-m-d'.'00:00:00',time()));
    $connect = Db::connect($options['dsn']);
    $users = $connect->name('admin')->field('id,user_name,firm_tel')->where(['id'=>['neq',1]])->select();
    foreach ($users as $key => $user_one) {
      $backlogs_count = $connect->name('backlog')->where(['user_id'=>$user_one['id'],'backlog_time'=>['>=',$todayStart],'tel_status'=>0,'backlog_status'=>['not in','1,3']])->count();
      $notice = [
        'title'=>'您好，您将在今天'.$backlogs_count.'条待办事项需要紧急办理，抓紧时间去处理吧！',
        'content'=>'您好，您将在今天'.$backlogs_count.'条待办事项需要紧急办理，抓紧时间去处理吧！',
        'typeid'=>3,
        'user_id'=>$user_one['id'],
        'create_t'=>time()
      ];
      $connect->name('notice')->insert($notice);
      $message_content = '【待办提醒】'.$user_one['user_name'].'，您今天有'.$backlogs_count.'条待办事项还未处理。请尽快登录巨推管家查看并处理。';
      $mess = $this->message($message_content,$user_one['firm_tel']);
      if ($mess['returnstatus'] == 'Success') {
        return true;
      }else{
        return false;
      }
    }
  }

  /**
  * 短信消息提醒
  * @param $content 签名+姓名+发送的内容
  * @param $tel   发送的手机号
  * @return $ress  解析成数组的返回值
  */
  public function message($content,$tel){
    //发送短信
    $userid = '6488';
    $account = 'a10503';
    $password = '112233';
    $action = 'send';
    $sendTime= '';
    $extno= '';
    $send_api = 'http://dx1.xitx.cn:8888/sms.aspx?action='.$action.'&userid='.$userid.'&account='.$account.'&password='.$password.'&mobile='.$tel.'&content='.$content.'&sendTime='.$sendTime.'&extno='.$extno;
    $res = $this->crm_curl_get($send_api);
    $xmls = new \SimpleXMLElement($res);
    $ress = $this->parseXml($xmls);
    return $ress;
  }

  /**
   * curl get 请求
   * @param $url
   * @return mixed
   */
  public function crm_curl_get($url,$code=false){
  	$url = urldecode($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $content = curl_exec($ch);
    if($content === false){
      return 'Curl error: ' . curl_error($ch);
  	}else{
  		$httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      if ($code) {
          return $httpcode;
      }else{
          return $content;
      }
  	}
  }

  /**
  * 解析xml格式数据
  */
  public function parseXml($xmls){
    $array = [];
    $xmls = $xmls;
    foreach ($xmls as $key => $xml) {
	    $count = count($xml);
      if ($count == 0) {
          $res = (string) $xml;
      } else {
          $res = parseXml($xml);
      }
      $array[$key] = $res;
    }
    return $array;
  }
}
