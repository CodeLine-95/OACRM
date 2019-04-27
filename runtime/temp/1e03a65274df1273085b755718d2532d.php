<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/quarters/update.html";i:1552275820;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">编辑岗位</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" wid100 lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">岗位名称</label>
                <div class="layui-input-inline">
                <input type="text" name="name" value="<?php echo $qua['name']; ?>" class="layui-input" placeholder="在此添加岗位名称">
                </div>
                <input type="hidden" name="id" value="<?php echo $qua['id']; ?>">
                <label class="layui-form-label">所属部门</label>
                <div class="layui-input-inline">
                  <select id="sectors_id" name="sectors_id" lay-verify="sectors_id" lay-search lay-filter="sectors_id">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                      <option value="<?php echo $vv['id']; ?>" <?php if($qua['sectors_id'] == $vv['id']): ?> selected <?php endif; ?>><?php echo $vv['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
              </div>
              <div class="layui-input-item">
                <label class="layui-form-label">负责项目</label>
                <div class="layui-input-block" id="project_id">
                </div>
              </div>
              <div class="layui-form" wid100 lay-filter="">
                <div class="layui-form-item layui-form-text">
              <label class="layui-form-label">岗位类型</label>
                <div class="layui-input-inline">
                  <select id="type" name="type" lay-verify="type" lay-search lay-filter="type">
                      <option value="1" <?php if($qua['type'] == 1): ?> selected <?php endif; ?>>全职</option>
                      <option value="0" <?php if($qua['type'] == 0): ?> selected <?php endif; ?>>兼职</option>
                      <option value="2" <?php if($qua['type'] == 2): ?> selected <?php endif; ?>>实习生</option>
                    </select>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">岗位职责</label>
                <div class="layui-input-block">
                  <textarea name="desc" class="layui-textarea" style="resize: none;" placeholder="在此添加岗位职责"><?php echo $qua['desc']; ?></textarea>
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
      $.ajax({
        url:"<?php echo url('AjaxAction/pro'); ?>",
        data:{id:<?php echo $qua['sectors_id'];?>},
        type:'post',
        success:function(data){
          $("#project_id").html(data);
          form.render('checkbox');
        }
      });
    });
    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      form.on('select(sectors_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/pro'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#project_id").html(data);
            form.render('checkbox');
          }
        });
      });
      form.on('submit(set_website)', function(data){
          $.ajax({
              type:'POST',
              url:'<?php echo url("quarters/update"); ?>',
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
