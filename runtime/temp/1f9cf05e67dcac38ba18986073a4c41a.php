<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sales/handle.html";i:1553928987;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-form layui-card-body" style="height:400px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div style="height:100px;"></div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="schedule">处理状态</label>
                <div class="layui-input-block">
                  <select class="layui-input" id="schedule" name="schedule">
                    <option value="23">退回</option>
                    <option value="25">作废</option>
                  </select>
                </div>
              </div>
              <div style="height:100px;"></div>
              <div class="layui-form-item" style="text-align:center;">
                <button class="layui-btn" lay-submit lay-filter="schedule_status">确定处理</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    layui.use(['form'], function(){
      var form = layui.form;
      form.on('submit(schedule_status)', function(data){
          $.ajax({
            type:'POST',
            url:'<?php echo url("sales/handle"); ?>',
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
