<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/notice/add.html";i:1553938175;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
        <div class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label" for="title">消息标题</label>
            <div class="layui-input-block">
              <input type="text" name="title" id="title" class="layui-input" placeholder="请输入站内信息标题">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label" for="content">消息内容</label>
            <div class="layui-input-block">
              <textarea name="content" id="content" class="layui-textarea" style="resize: none;" placeholder="请输入站内消息内容"></textarea>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label" for="release_id">发布对象</label>
            <div class="layui-input-block">
              <select name="release_id" id="release_id">
                <option value="0">全体员工</option>
                <?php foreach($sectors as $s): ?>
                <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="add">发布</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    layui.use(['form','element'], function(){
      var form = layui.form,element = layui.element;
      form.on('submit(add)', function(data){
        $.ajax({
          type:'POST',
          url:'<?php echo url("notice/add"); ?>',
          data: {
            data:JSON.stringify(data.field)
          },
          success:function (data) {
            var status = JSON.parse(data);
            if (status.icon == 6){
              layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                // window.parent.location.reload();
                location.href="<?php echo url('notice/system'); ?>";
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
