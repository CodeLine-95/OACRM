<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/followup/add.html";i:1553770058;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <input type="hidden" name="client_id" value="<?php echo $id; ?>">
          <div class="layui-form-item">
            <label class="layui-form-label" for="projects">状态</label>
            <div class="layui-input-block">
              <select id="projects" name="client_status">
                <?php foreach($kv as $k): ?>
                <option value="<?php echo $k['id']; ?>" <?php if($client['schedule'] == $k['id']): ?>selected<?php endif; ?>><?php echo $k['name']; ?></option>
                <?php endforeach; ?>
                <!-- <option value="1">未知数据</option>
                <option value="2">潜在数据</option>
                <option value="3">精准数据</option>
                <option value="4">意向数据</option>
                <option value="5">已派数据</option>
                <option value="6">洽谈需求</option>
                <option value="7">提交报价</option>
                <option value="8">诊断方案</option>
                <option value="9">竞标投标</option>
                <option value="10">签订合同</option>
                <option value="11">首付款项</option>
                <option value="12">达成合作</option>
                <option value="13">执行方案</option>
                <option value="14">开始执行</option>
                <option value="15">数据汇报</option>
                <option value="16">完成合同</option>
                <option value="17">催收尾款</option>
                <option value="18">合作结案</option> -->
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">待办</label>
            <div class="layui-input-inline" style="position: relative;">
              <input type="text" name="backlog_time" class="layui-input" placeholder="请点击选择时间" id="backlog_time"><i class="layui-icon" style="position: absolute;right: 10px;top: 12px;">&#xe637;</i>
            </div>
            <div class="layui-input-inline">
              <input type="text" name="backlog_title" class="layui-input" placeholder="输入待办事项">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label" for="remarks">备注说明</label>
            <div class="layui-input-block">
              <textarea name="remarks" id="remarks" class="layui-textarea" style="resize: none;" placeholder="备注说明"></textarea>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label" for="remarks">附件</label>
            <div class="layui-input-inline">
              <input type="text" name="upload_file" readonly class="layui-input layui-btn-disabled">
            </div>
            <div class="layui-input-inline">
              <button type="button" class="layui-btn" id="upload_file">上传</button>
            </div>
          </div>

          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="followup_add">提交</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    layui.use(['form','element','laydate','upload'], function(){
      var form = layui.form,element = layui.element,laydate = layui.laydate,upload = layui.upload;
      //日期实例
      laydate.render({
        elem:"#backlog_time",
        type: 'datetime'
      })
      //上传实例
      upload.render({
        elem: '#upload_file',
        url: '<?php echo url("AjaxAction/uploadfile"); ?>',
        accept:"file",
        exts:"zip|rar|7z|pdf",
        auto:true,
        size:51200,
        drag:false,
        before: function(obj) {
          layer.msg('附件上传中...', {icon: 16,shade: 0.01,time: 0})
        },
        done: function(res) {
            layer.close(layer.msg('上传附件成功！'));
            $('input[name=upload_file]').val(res.data);
        }
        ,error: function(){
            layer.msg('上传错误！');
        }
      });
      form.on('submit(followup_add)', function(data){
        $.ajax({
          type:'POST',
          url:'<?php echo url("followup/add"); ?>',
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
