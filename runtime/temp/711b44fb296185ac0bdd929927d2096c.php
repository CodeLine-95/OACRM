<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sales/changeorderall.html";i:1552977690;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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

<style media="screen">
  .layui-form-select{
    width: 100px;
  }
  .layui-form-selected dl{
    background-color: #eee;
  }
</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">批量转单</div>
          <div class="layui-card-body" pad15>
            <div class="layui-form">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="layui-card" style="width: 100%;">
                <div class="layui-form-item layui-form-text">
                  <h3 style="text-align:center;width: 150px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">选择转单人员</h3>
                </div>
                <table class="layui-table">
                  <thead>
                    <tr>
                      <td align="center">选择</td>
                      <td align="center">姓名</td>
                      <td align="center">性别</td>
                      <td align="center">部门</td>
                      <td align="center">岗位</td>
                      <td align="center">职责</td>
                      <td align="center">手机号</td>
                      <td align="center">直属领导</td>
                      <td align="center">入职时间</td>
                    </tr>
                  </thead>
                  <tbody id="table_tr">
                    <?php foreach($users as $user): ?>
                    <tr>
                      <td align="center"><input type="radio" name="service_id_new" value="<?php echo $user['id']; ?>"></td>
                      <td align="center"><?php echo $user['user_name']; ?></td>
                      <td align="center"><?php if($user['staff_sex'] == 1): ?>女<?php else: ?>男<?php endif; ?></td>
                      <td align="center"><?php echo $user['sectors']; ?></td>
                      <td align="center"><?php echo $user['quarters']; ?></td>
                      <td align="center"><?php echo $user['yewu']; ?></td>
                      <td align="center"><?php echo $user['staff_tel']; ?></td>
                      <td align="center"><?php echo $user['shangji']; ?></td>
                      <td align="center"><?php echo $user['create_time']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="set_website">开始转单</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      form.on('submit(set_website)', function(data){
        if(!data.field.service_id_new){
          layer.msg('请选择转单人员',{icon: 5,time:1000});
        }else {
          data.field.id = $('input[name=id]').val();
          $.ajax({
            type:'POST',
            url:'<?php echo url("sales/changeorderall"); ?>',
            data: {
              data:JSON.stringify(data.field)
            },
            success:function (data) {
              var status = JSON.parse(data);
              if (status.icon == 6){
                layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                  window.parent.location.reload();
                });
              }else {
                layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                  window.location.reload();
                });
              }
            }
          });
        }
        return false;
      });
    });
  </script>
</body>
</html>
