<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/cases/index.html";i:1555466698;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
  <div class="layui-fluid" class="layui-form">
    <div class="layui-card">
      <div class="layui-tab layui-tab-brief">
        <crmblok>
          <div style="position: relative;">
            <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加','<?php echo url('cases/create'); ?>')"><i class="layui-icon">&#xe608;</i>添加案例</button>
          </div>
        </crmblok>
        <table class="layui-table">
          <thead>
            <tr>
              <th align="center">创建时间</th>
              <th align="center">案例品牌</th>
              <th align="center">LOGO</th>
              <th align="center">所属行业</th>
              <th align="center">服务类型</th>
              <th align="center">地域</th>
              <th align="center">负责人</th>
              <th align="center">添加人</th>
              <th align="center">合作时间</th>
              <th align="center">案例类型</th>
              <th align="center">合作状态</th>
              <th align="center">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($cases) || (($cases instanceof \think\Collection || $cases instanceof \think\Paginator ) && $cases->isEmpty())): ?>
            <tr align="center" style="height:500px;">
              <td colspan="11">暂无案例</td>
            </tr>
            <?php else: foreach($cases as $s): ?>
            <tr>
              <td><?php echo date('Y-m-d H:i:s',$s['create_t']); ?></td>
              <td><?php echo $s['brand']; ?></td>
              <td><?php if($s['brand_logo'] == ''): ?><img src="/static/admin/img/default.png" alt="<?php echo $s['commpany']; ?>" style="height:100px;"><?php else: ?><img src="<?php echo $s['brand_logo']; ?>" alt="<?php echo $s['commpany']; ?>" style="height:100px;"><?php endif; ?></td>
              <td><?php echo $s['trade']; ?></td>
              <td><?php echo $s['business']; ?></td>
              <td><?php echo $s['citys']; ?></td>
              <td><?php echo $s['author']; ?></td>
              <td><?php echo $s['user_name']; ?></td>
              <td><?php echo date('Y-m-d H:i:s',$s['cooperating_start']); ?></td>
              <td>
                <?php switch($s['type_id']): case "0": ?><span style="color:#757272;">自营案例</span><?php break; case "1": ?><span style="color:#E51C23;">行业案例</span><?php break; case "2": ?><span style="color:#FF9800;">其他案例</span><?php break; endswitch; ?>
              </td>
              <td>
                <?php switch($s['cooperating']): case "0": ?><span style="color:#757272;">准备中</span><?php break; case "1": ?><span style="color:#1E9FFF;">合作中</span><?php break; case "2": ?><span style="color:#FF9800;">已结束</span><?php break; endswitch; ?>
              </td>
              <td>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('详情','<?php echo url('cases/show',['id'=>$s['id']]); ?>')">详情</button>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑','<?php echo url('cases/edit',['id'=>$s['id']]); ?>')">编辑</button>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $s['id']; ?>')">删除</button>
              </td>
            </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function del(id) {
      layer.confirm("您确定删除该案例吗？", function() {
        $.ajax({
          url: "<?php echo url('cases/del'); ?>",
          data: {
            id: id
          },
          type: 'post',
          success: function(data) {
            var status = JSON.parse(data);
            layer.msg(status.msg, {
              icon: status.icon,
              time: 1000
            }, function() {
              window.location.reload();
            });
          }
        });
      });
    }
  </script>
</body>

</html>
