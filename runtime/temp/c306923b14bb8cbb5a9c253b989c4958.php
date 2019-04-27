<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/service/updateorder.html";i:1554969007;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>巨推管家</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>
<style media="screen">
  .layui-form-checked[lay-skin="primary"] i{
    border-color:#1E9FFF;
    background-color:#1E9FFF;
    color:#fff;
  }
  .layui-form-checkbox[lay-skin="primary"]:hover i {
    border-color:#1E9FFF;
    color:#fff;
  }
  .layui-form-radio > i:hover, .layui-form-radioed > i {
      color: #1E9FFF;
  }
</style>

</head>
<body onload="last()">
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">编辑订单</div>
          <div class="layui-form layui-card-body" pad15>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户信息</h3>
              </div>
              <!-- <div class="layui-col-md12"></div> -->
              <div class="layui-form-item">
                <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
                <div class="layui-col-md12">
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="name">客户名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="name" id="name" lay-verify="name|required" class="layui-input" placeholder="请在此输入客户姓名" value="<?php echo $client['name']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="sex">客户性别</label>
                    <div class="layui-input-block">
                      <select class="layui-input" name="sex" lay-verify="sex|required">
                          <option value="1" <?php if($client['sex'] == 1): ?> selected <?php endif; ?>>男</option>
                          <option value="2" <?php if($client['sex'] == 2): ?> selected <?php endif; ?>>女</option>
                      </select>
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="phone">客户电话</label>
                    <div class="layui-input-block">
                      <input type="text" name="phone" id="phone" lay-verify="required" class="layui-input" placeholder="请在此输入客户电话" value="<?php echo $client['phone']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="type">客户类型</label>
                    <div class="layui-input-block">
                      <select class="layui-input" name="type" >
                          <option value="1" <?php if($client['type'] == 1): ?> selected <?php endif; ?>>私企</option>
                          <option value="2" <?php if($client['type'] == 2): ?> selected <?php endif; ?>>国企</option>
                          <option value="3" <?php if($client['type'] == 3): ?> selected <?php endif; ?>>上市</option>
                          <option value="4" <?php if($client['type'] == 4): ?> selected <?php endif; ?>>个人</option>
                          <option value="5" <?php if($client['type'] == 5): ?> selected <?php endif; ?>>政府</option>
                      </select>
                    </div>
                  </div>
                </div>
				      </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="city-picker">所属城市</label>
                <div class="layui-input-block">
                  <input type="text" autocomplete="on" class="layui-input" id="city-picker" name="city" value="<?php echo $client['city']; ?>" readonly="readonly" data-toggle="city-picker" placeholder="请选择">
                </div>
              </div>
			        <div class="layui-form-item">
                <div class="layui-col-md12">
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="wechat">客户微信</label>
                    <div class="layui-input-block">
                      <input type="text" name="wechat" id="wechat" class="layui-input" placeholder="请在此输入客户微信"  value="<?php echo $client['wechat']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="qq">客户QQ</label>
                    <div class="layui-input-block">
                      <input type="text" name="qq" id="qq" class="layui-input" placeholder="请在此输入客户QQ" value="<?php if($client['qq'] != 0): ?><?php echo $client['qq']; endif; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="email">客户邮箱</label>
                    <div class="layui-input-block">
                      <input type="text" name="email" id="email"  class="layui-input" placeholder="请在此输入客户邮箱" value="<?php echo $client['email']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="quarters">岗位职称</label>
                    <div class="layui-input-block">
                      <input type="text" name="quarters" id="quarters" class="layui-input" placeholder="请在此输入岗位职称" value="<?php echo $client['quarters']; ?>">
                    </div>
                  </div>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">结束时间</label>
                <div class="layui-input-block">
                  <input type="text" name="end_time" id="endtime" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">兴趣爱好</h3>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="interests">选择兴趣</label>
                <div class="layui-input-block">
                  <input type="checkbox" name="interests" value="旅游" title="旅游" <?php if(in_array('旅游',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="阅读" title="阅读" <?php if(in_array('阅读',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="电影" title="电影" <?php if(in_array('电影',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="聚会" title="聚会" <?php if(in_array('聚会',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="唱歌" title="唱歌" <?php if(in_array('唱歌',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="交友" title="交友" <?php if(in_array('交友',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="摄影" title="摄影" <?php if(in_array('摄影',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="球类" title="球类" <?php if(in_array('球类',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="逛街" title="逛街" <?php if(in_array('逛街',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="爬山" title="爬山" <?php if(in_array('爬山',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="宅家" title="宅家" <?php if(in_array('宅家',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="下棋" title="下棋" <?php if(in_array('下棋',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="书画" title="书画" <?php if(in_array('书画',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="荣誉" title="荣誉" <?php if(in_array('荣誉',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="面子" title="面子" <?php if(in_array('面子',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="喝酒" title="喝酒" <?php if(in_array('喝酒',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="喝茶" title="喝茶" <?php if(in_array('喝茶',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="吃货" title="吃货" <?php if(in_array('吃货',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="运动" title="运动" <?php if(in_array('运动',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="美容" title="美容" <?php if(in_array('美容',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="钱财" title="钱财" <?php if(in_array('钱财',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="美女" title="美女" <?php if(in_array('美女',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="收藏" title="收藏" <?php if(in_array('收藏',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="集邮" title="集邮" <?php if(in_array('集邮',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="游戏" title="游戏" <?php if(in_array('游戏',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="瑜伽" title="瑜伽" <?php if(in_array('瑜伽',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="舞蹈" title="舞蹈" <?php if(in_array('舞蹈',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="跑步" title="跑步" <?php if(in_array('跑步',$interests) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="interests" value="武术" title="武术" <?php if(in_array('武术',$interests) == true): ?> checked <?php endif; ?>>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">公司信息</h3>
              </div>

              <div class="layui-form-item">
                <div class="layui-col-md12">
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="sitename">公司名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="sitename" id="sitename" class="layui-input" placeholder="请在此输入公司名称" value="<?php echo $client['sitename']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="website">公司官网</label>
                    <div class="layui-input-block">
                      <input type="text" name="website" id="website" class="layui-input" placeholder="请在此输入公司官网" value="<?php echo $client['website']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="siteaddress">公司地址</label>
                    <div class="layui-input-block">
                      <input type="text" name="siteaddress" id="siteaddress" class="layui-input" placeholder="请在此输入公司地址" value="<?php echo $client['siteaddress']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="industry">所属行业</label>
                    <div class="layui-input-block">
                      <input type="hidden" id="industry_id" value="<?php echo $client['industry']; ?>">
                       <select class="layui-input" name="industry" id="industry">
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-col-md12">
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="brand">主营业务</label>
                    <div class="layui-input-block">
                      <input type="text" name="brand" id="brand" class="layui-input" placeholder="请在此输入主营业务" value="<?php echo $client['brand']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="busi">产品品牌</label>
                    <div class="layui-input-block">
                      <input type="text" name="busi" id="busi" class="layui-input" placeholder="请输入产品品牌" value="<?php echo $client['busi']; ?>">
                    </div>
                  </div>
                </div>
              </div>
                <!--  <div class="layui-col-md12">
                  <div class="layui-col-md3">

                  </div>
                  <div class="layui-col-md3">

                  </div>
                </div>-->
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">需求信息</h3>
              </div>
              <div class="layui-form-item">
                <div class="layui-col-md12">
                    <div class="layui-col-md3">
                      <label class="layui-form-label" for="project_id">所属项目</label>
                      <div class="layui-input-inline">
                        <select class="layui-input" name="project_id" id="project_id" lay-filter="project_id">
                          <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vv['id']; ?>" <?php if($client['project_id'] == $vv['id']): ?> selected <?php endif; ?>><?php echo $vv['name']; ?></option>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                      </div>
                    </div>
                    <div class="layui-col-md3">
                      <input type="hidden" id="business2" value="<?php echo $client['business']; ?>">

                      <label class="layui-form-label" for="staff_idcard">业务类型</label>
                      <div class="layui-input-inline">
                        <select class="layui-input" name="business" id="business" lay-filter="business">
                        </select>
                      </div>
                    </div>
                    <div class="layui-col-md3">
                      <label class="layui-form-label" for="staff_province">前期状态</label>
                      <div class="layui-input-inline">
                        <select class="layui-input" name="stage">
                            <option value="1" <?php if($client['stage'] == 1): ?> selected <?php endif; ?>>有</option>
                            <option value="0" <?php if($client['stage'] == 0): ?> selected <?php endif; ?>>无</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="layui-form-item">
                <input type="hidden" id="service2" value="<?php echo $client['service']; ?>">
                <label class="layui-form-label" for="service">选择服务</label>
                <div class="layui-input-block" id="service">
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-col-md12">
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="budget">预算金额</label>
                    <div class="layui-input-block">
                      <input type="text" name="budget" id="budget" class="layui-input" placeholder="请在此输入预算金额" value="<?php echo $client['budget']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="makemoney">成交金额</label>
                    <div class="layui-input-block">
                      <input type="text" name="makemoney" id="makemoney" class="layui-input" placeholder="请在此输入成交金额"  value="<?php echo $client['makemoney']; ?>">
                    </div>
                  </div>
                  <div class="layui-col-md3">
                    <label class="layui-form-label" for="moneystate">预算说明</label>
                    <div class="layui-input-block">
                     <select class="layui-input" name="moneystate">
                          <option value="1" <?php if($client['moneystate'] == 1): ?> selected <?php endif; ?>>全款</option>
                          <option value="2" <?php if($client['moneystate'] == 2): ?> selected <?php endif; ?>>年付</option>
                          <option value="3" <?php if($client['moneystate'] == 3): ?> selected <?php endif; ?>>季付</option>
                          <option value="4" <?php if($client['moneystate'] == 4): ?> selected <?php endif; ?>>月付</option>
                          <option value="5" <?php if($client['moneystate'] == 5): ?> selected <?php endif; ?>>5:5</option>
                          <option value="6" <?php if($client['moneystate'] == 6): ?> selected <?php endif; ?>>5:2:3</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="remark">备注说明</label>
                <div class="layui-input-block">
                  <textarea name="remark" id="remark" class="layui-textarea"><?php echo $client['remark']; ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户来源</h3>
              </div>

             <div class="layui-form-item">
               <div class="layui-col-md12">
                 <div class="layui-col-md3">
                   <label class="layui-form-label" for="ditch_id">渠道</label>
                   <div class="layui-input-block">
                     <select class="layui-input" id="ditch_id" name="ditch_id" lay-filter="ditch_id">
                       <?php if(is_array($typelist) || $typelist instanceof \think\Collection || $typelist instanceof \think\Paginator): $i = 0; $__LIST__ = $typelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                       <option value="<?php echo $vv['id']; ?>" <?php if($client['ditch_id'] == $vv['id']): ?> selected <?php endif; ?>><?php echo $vv['typename']; ?></option>
                       <?php endforeach; endif; else: echo "" ;endif; ?>
                     </select>
                   </div>
                 </div>
                 <div class="layui-col-md3">
                   <label class="layui-form-label" for="source_id">来源入口</label>
                   <input type="hidden" id="source_ids" value="<?php echo $client['source_id']; ?>">
                   <div class="layui-input-block">
                     <select class="layui-input" id="source_id" name="source_id" lay-filter="source_id">
                     </select>
                   </div>
                 </div>
               </div>
            </div>
            <div class="layui-form-item">
              <input type="hidden" id="tools_id" value="<?php echo $client['tools_ids']; ?>">
              <label class="layui-form-label" for="tools_ids">咨询工具</label>
              <div class="layui-input-block" id="tools_ids">
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户状态</h3>
            </div>

            <div class="layui-form-item">
              <div class="layui-col-md12">
                <div class="layui-col-md3">
                  <label class="layui-form-label" for="schedule">选择状态</label>
                  <div class="layui-input-block">
                    <select class="layui-input" name="schedule" id="schedule">
                      <?php foreach($kv as $k): ?>
                      <option value="<?php echo $k['id']; ?>" <?php if($client['schedule'] == $k['id']): ?>selected<?php endif; ?>><?php echo $k['name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="xing" value="<?php echo $client['level']; ?>">
            <div class="layui-form-item">
                <label class="layui-form-label" for="staff_hobby">客户星级</label>
                <div class="layui-input-block">
                  <div><div id="test4"></div></div>
                </div>
              </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                  <label class="layui-form-label"><button class="layui-btn" lay-submit lay-filter="add">点击提交</button></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/static/layuiadmin/layui_exts/city-picker/city-picker.data.js"></script>
  <link href="/static/layuiadmin/layui_exts/city-picker/city-picker.css" rel="stylesheet" />
  <script>
    //行业ajax请求
    var industry_id = $('#industry_id').val();
    $.post("<?php echo url('AjaxAction/industryAction'); ?>",{id:industry_id},function(data){
      $('#industry').html(data);
      layui.use(['form'], function(){
        var form = layui.form;
        form.render('select');
      });
    });
    //来源三级联动
    var ditch_id = $('#ditch_id').val();
    var source_ids = $('#source_ids').val();
    $.post("<?php echo url('AjaxAction/source'); ?>",{id:ditch_id,source_id:source_ids},function(data){
      $('#source_id').html(data);
      layui.use(['form'], function(){
        var form = layui.form;
        form.render('select');
        var tools_id = $('#tools_id').val();
        $.post("<?php echo url('AjaxAction/Tools'); ?>",{id:source_ids,tools_ids:tools_id},function(data){
          $('#tools_ids').html(data);
          layui.use(['form'], function(){
            var form = layui.form;
            form.render('checkbox');
          });
        });
      });
    });
    layui.config({
      base: '/static/layuiadmin/layui_exts/' //静态资源所在路径
    }).extend({
      citypicker: 'city-picker/city-picker' // {/}的意思即代表采用自有路径，即不跟随 base 路径
    }).use(['citypicker'], function() {
      var $ = layui.$,
        cityPicker = layui.citypicker;
      var currentPicker = new cityPicker("#city-picker", {
        provincename: "provinceId",
        cityname: "cityId",
        districtname: "districtId",
        level: 'districtId', // 级别
      });
    });
    layui.use(['form','upload','rate'], function(){
      var form = layui.form,upload = layui.upload;var rate = layui.rate;
      //半星效果
      var xing = $("#xing").val();
      var xingval = "";
      if(xing=="0.5"){
        var xingval = 0.5;
      }
      if(xing=="1"){
        var xingval = 1;
      }
      if(xing=="1.5"){
        var xingval = 1.5;
      }
      if(xing=="2"){
        var xingval = 2;
      }
      if(xing=="2.5"){
        var xingval = 2.5;
      }
      if(xing=="3"){
        var xingval = 3;
      }
      if(xing=="3.5"){
        var xingval = 3.5;
      }
      if(xing=="4"){
        var xingval = 4;
      }
      if(xing=="4.5"){
        var xingval = 4.5;
      }
      if(xing=="5"){
        var xingval = 5;
      }
      if(xingval==false){
        var xingval = 5;
      };
      rate.render({
        elem: '#test4'
        ,value: xingval
        ,half: true
        ,text: true
      });

      form.on('select(project_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/business'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#business").html(data);
            form.render('select');
          }
        });
      });

      //渠道下拉联动
      form.on('select(ditch_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/source'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#source_id").html(data);
            form.render('select');
          }
        });
      });
      //渠道下拉联动
      form.on('select(source_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/Tools'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#tools_ids").html(data);
            form.render('checkbox');
          }
        });
      });
      form.on('select(business)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/service'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#service").html(data);
            form.render('checkbox');
          }
        });
      });

      form.on('submit(add)', function(data){
        var level = $("#test4").children("span").html();
        data.field.level      = level.substr(0,level.length-1);
        data.field.interests  = returnCheckboxItem("interests");
        data.field.tools_ids = returnCheckboxItem("tools_ids");
        data.field.service    = returnCheckboxItem("service");
        $.ajax({
            type:'POST',
            url:'<?php echo url("service/updateorder"); ?>',
            data: {
              data:JSON.stringify(data.field)
            },
            success:function (data) {
              var status = JSON.parse(data);
              if (status.icon == 6){
                layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                  window.parent.location.reload();
                });
              } else {
                layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                  window.location.reload();
                });
              }
            }
        });
        return false;
      });
    });
    //页面加载默认一个三级联动
    function last(){
      //一级联动
      var yewuid = $("#project_id option:first").val();
      layui.use(['form','element'], function(){
        var form = layui.form,element = layui.element;
        $.ajax({
          url:"<?php echo url('AjaxAction/business'); ?>",
          data:{id:yewuid},
          type:'post',
          success:function(data){
            $("#business").html(data);
            //二级联动
            var business = $("#business option:first").val();
            var service_id = $('#service2').val();
            console.log(service_id);
            $.ajax({
              url:"<?php echo url('AjaxAction/service'); ?>",
              data:{id:business,service:service_id},
              type:'post',
              success:function(data){
                if(data == '暂无服务'){
                  $("#services").css({'display':'none'});
                }else{
                  $("#services").css({'display':'block'});
                  $("#service").html(data);
                }
                form.render('checkbox');
              }
            });
            form.render('select');
          }
        });
      });
    }
    function returnCheckboxItem(name){
      var adIds = "";
      $('input:checkbox[name="'+name+'"]:checked').each(function(i){
        if(0==i){
            adIds = $(this).val();
        }else{
            adIds += (","+$(this).val());
        }
      });
      return adIds
    }
  </script>
</body>
</html>
