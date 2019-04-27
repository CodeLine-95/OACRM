<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/media/update.html";i:1555579953;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">编辑账号</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" wid100 lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">帐号昵称</label>
                <div class="layui-input-block">
                  <input type="hidden" name="id" value="<?php echo $media['id']; ?>">
                  <input type="text" name="nick" value="<?php echo $media['nick']; ?>" class="layui-input" placeholder="在此添加账号昵称">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">登陆账号</label>
                <div class="layui-input-block">
                  <input type="text" name="name" value="<?php echo $media['name']; ?>" class="layui-input" placeholder="在此添加登陆账号">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">登陆密码</label>
                <div class="layui-input-block">
                  <input type="text" name="pass" value="<?php echo $media['pass']; ?>" class="layui-input" placeholder="在此添加登陆密码">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" id="type_id">账号类型</label>
                <div class="layui-input-block">
                  <select class="layui-input" name="type_id" id="type_id" lay-filter="type_id">
                    <?php foreach($typelist as $k=>$list): ?>
                      <option value="<?php echo $list['id']; ?>" <?php if($media['type_id'] == $list['id']): ?>selected<?php endif; ?>><?php echo $list['typename']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="layui-form-item">
                <input type="hidden" name="platform" value="<?php echo $media['platform_id']; ?>">
                <label class="layui-form-label" for="platform_id">选择平台</label>
                <div class="layui-input-block" id="platform_id">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">首页网址</label>
                <div class="layui-input-block">
                  <input type="text" name="website" value="<?php echo $media['website']; ?>" class="layui-input" placeholder="在此添加首页网址">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">登陆链接</label>
                <div class="layui-input-block">
                  <input type="text" name="loginsite" value="<?php echo $media['loginsite']; ?>" class="layui-input" placeholder="在此添加登陆链接">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">绑定手机</label>
                <div class="layui-input-block">
                  <input type="text" name="tel" value="<?php echo $media['tel']; ?>" class="layui-input" placeholder="在此添加绑定手机">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">手机主人</label>
                <div class="layui-input-block">
                  <input type="text" name="hostname" value="<?php echo $media['hostname']; ?>" class="layui-input" placeholder="在此添加手机主人">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">绑定身份证</label>
                <div class="layui-input-block">
                  <input type="text" name="idcard" value="<?php echo $media['idcard']; ?>" class="layui-input" placeholder="在此添加绑定身份证">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">身份证姓名</label>
                <div class="layui-input-block">
                  <input type="text" name="idcard_name" value="<?php echo $media['idcard_name']; ?>" class="layui-input" placeholder="在此添加身份证姓名">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">绑定微信</label>
                <div class="layui-input-block">
                  <input type="text" name="wechat" value="<?php echo $media['wechat']; ?>" class="layui-input" placeholder="在此添加绑定微信">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">微信主人</label>
                <div class="layui-input-block">
                  <input type="text" name="wechat_name" value="<?php echo $media['wechat_name']; ?>" class="layui-input" placeholder="在此添加微信主人">
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注说明</label>
                <div class="layui-input-block">
                  <textarea name="remark" class="layui-textarea" style="resize: none;" placeholder="在此添加备注说明"><?php echo $media['remark']; ?></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="set_website">提交</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      form.on('select(type_id)',function(data){
        var platform_id = $("input[name=platform]").val();
        $.post("<?php echo url('AjaxAction/platformAction'); ?>",{type_id:data.value,platform_id:platform_id},function(data){
          $('#platform_id').html(data);
          form.render('select');
        });
      });
      form.on('submit(set_website)', function(data){
          $.ajax({
              type:'POST',
              url:'<?php echo url("media/update"); ?>',
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
  </script>
</body>
</html>
