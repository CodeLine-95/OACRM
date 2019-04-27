<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/power/poweradd.html";i:1554185489;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;s:73:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/footer.html";i:1547024714;}*/ ?>
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
          <div class="layui-card-header">添加规则</div>
          <div class="layui-card-body" pad15>
            <form class="layui-form" method="post">
              <div class="layui-form-item">
                <label for="cate" class="layui-form-label">上级</label>
                <div class="layui-input-inline">
                  <select id="cate" name="pid" class="valid">
                    <option value="0" selected>顶级</option>
                    <?php foreach($rules as $rule): ?>
                    <option value="<?php echo $rule['id']; ?>"><?php echo $rule['_name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="title">规则名称</label>
                <div class="layui-input-block">
                  <input type="text" id="title" name="name" lay-verify="required" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="url">规则节点</label>
                <div class="layui-input-block">
                  <input name="url" style="width: 50%;" id="url" type="text" lay-verify="required" autocomplete="off" class="layui-input layui-input-inline">
                  <span style="line-height: 38px;color:red;"><i class="layui-icon" style="font-size:14px;margin-right: 5px;">&#xe702;</i>如：admin/user/adduser (一级节点添加“#”即可)</span>
                </div>
              </div>

              <div class="layui-form-item">
                <label for="sort" class="layui-form-label">菜单排序</label>
                <div class="layui-input-block">
                  <input type="text" id="sort" name="sort" value="0" autocomplete="off" class="layui-input layui-input-inline">
                </div>
              </div>

              <div class="layui-form-item">
                <label for="iconPicker" class="layui-form-label">字体图标</label>
                <div class="layui-input-block">
                  <input type="text" id="iconPicker" name="icon" value="layui-icon-star-fill" lay-filter="iconPicker" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label for="status" class="layui-form-label">规则状态</label>
                <div class="layui-input-block">
                  <input type="radio" name="status" value="1" title="正常" checked>
                  <input type="radio" name="status" value="0" title="停用">
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="poweradd">添加规则</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  layui.config({
    base: '/static/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use('index');
</script>
  <script type="text/javascript">
    layui.config({
      base: '/static/layuiadmin/layui_exts/' //配置 layui 第三方扩展组件存放的基础目录
    }).extend({
      regionSelect: 'iconPicker'
    }).use(['iconPicker'], function() {
      $ = layui.jquery;
      var iconPicker = layui.iconPicker;
      iconPicker.render({
        // 选择器，推荐使用input
        elem: '#iconPicker',
        // 数据类型：fontClass/unicode，推荐使用fontClass
        type: 'fontClass',
        // 是否开启搜索：true/false
        search: true,
        // 点击回调
        click: function(data) {
          console.log(data.icon);
          $('input[name=icon]').val(data.icon);
        }
      });
      iconPicker.checkIcon('iconPicker', 'layui-icon-star-fill');
    });
    layui.use(['form'], function() {
      var form = layui.form;
      form.on('submit(poweradd)', function(data) {
        $.ajax({
          url: "<?php echo url('power/poweradd'); ?>",
          type: 'POST',
          data: {
            data: JSON.stringify(data.field)
          },
          success: function(data) {
            var message = JSON.parse(data);
            if (message.icon == 6) {
              layer.msg(message.msg, {
                icon: message.icon,
                time: 1000
              }, function() {
                window.parent.location.reload();
              });
            } else {
              layer.msg(message.msg, {
                icon: message.icon,
                time: 1000
              });
            }
          }
        });
        return false;
      })
    });
  </script>
</body>

</html>