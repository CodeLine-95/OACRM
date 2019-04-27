<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/backlog/index.html";i:1554863078;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;s:79:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/backlog-list.html";i:1554964215;}*/ ?>
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
   .layui-table tbody tr:hover{
     background-color: #fff;
   }
 </style>
</head>
<body>
<div class="layui-fluid" class="layui-form">
  <div class="layui-card">
    <div class="layui-tab layui-tab-brief">
      <crmblok>
  <div style="position: relative;">
    <button class="layui-btn layui-btn-normal" onclick="alert_open('添加待办','<?php echo url('backlog/add'); ?>')"><i class="layui-icon">&#xe608;</i>添加待办</button>
    <div style="display:inline-block;">
      <form class="layui-form" method="post">
        <div class="layui-input-inline">
          <input type="text" name="value" class="layui-input" lay-verify="required" style="background-color:#eee;border:none;">
        </div>
        <button class="layui-btn layui-btn-normal" type="submit"><i class="layui-icon layui-icon-search"></i>搜索</button>
      </form>
    </div>
    <div style="display:inline-block;position: absolute;right: 0;">
      <label class="layui-form-label" style="width:400px;color:#259B24;">今日待办事项<?php echo $todaycount; ?>件，本周待办事项<?php echo $weekcount; ?>件，本月待办事项<?php echo $monthcount; ?>件</label>
      <label class="layui-form-label">共有：<?php echo count($backlogs); ?>条</label>
    </div>
  </div>
</crmblok>
<table class="layui-table">
  <thead>
    <tr>
      <th align="center" style="width:150px;">创建时间</th>
      <th align="center" style="width:150px;">待办时间</th>
      <th align="center" style="width:150px;">执行时间</th>
      <th align="center">待办事项</th>
      <th align="center" style="width:50px;">待办人</th>
      <th align="center" style="width:50px;">创建人</th>
      <th align="center" style="width:50px;">状态</th>
      <th align="center" style="width:130px;">操作</th>
    </tr>
  </thead>
  <tbody>
  <?php if(empty($backlogs) || (($backlogs instanceof \think\Collection || $backlogs instanceof \think\Paginator ) && $backlogs->isEmpty())): ?>
    <tr><td colspan="8" align="center">暂无待办</td></tr>
  <?php else: if(is_array($backlogs) || $backlogs instanceof \think\Collection || $backlogs instanceof \think\Paginator): $i = 0; $__LIST__ = $backlogs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo date('Y-m-d H:i:s',$b['creates_time']); ?></td>
      <td><?php echo date('Y-m-d H:i:s',$b['backlog_time']); ?></td>
      <td>
        <?php if($b['execute_time'] != 0): if(($b['execute_time'] < time()) AND ($b['backlog_status'] != 1)): ?>
            <label style="color:#ff0000;"><?php echo date('Y-m-d H:i:s',$b['execute_time']); ?></label>
          <?php else: ?>
            <?php echo date('Y-m-d H:i:s',$b['execute_time']); endif; endif; ?>
      </td>
      <td>
        <?php if($b['read_status'] == 1): ?>
        <a href="javascript:void(0)" onclick="content('<?php echo $b['backlog_title']; ?>','<?php echo $b['backlog_content']; ?>','<?php echo $b['id']; ?>')" style="color:#757272;"><?php echo $b['backlog_title']; ?></a>&nbsp;&nbsp;&nbsp;[&nbsp;已读&nbsp;]
        <?php else: ?>
        <a href="javascript:void(0)" onclick="content('<?php echo $b['backlog_title']; ?>','<?php echo $b['backlog_content']; ?>','<?php echo $b['id']; ?>')" style="color:#1E9FFF;"><?php echo $b['backlog_title']; ?></a>&nbsp;&nbsp;&nbsp;[&nbsp;未读&nbsp;]
        <?php endif; ?>
      </td>
      <td><?php echo $b['client_name']; ?></td>
      <td><?php echo $b['user_name']; ?></td>
      <td>
        <?php switch($b['backlog_status']): case "0": ?><span style="color:#1E9FFF;">未执行</span><?php break; case "1": ?><span style="color:#259B24;">已执行</span><?php break; case "2": ?><span style="color:#FF0000;">已超时</span><?php break; case "3": ?><span style="color:#757272;">不执行</span><?php break; endswitch; ?>
      </td>
      <td>
        <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="alert_open('处理','<?php echo url('backlog/handle',array('id'=>$b['id'])); ?>')">处理</button>
        <?php if($b['client_id'] != 0): ?>
        <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('<?php echo $b['client_name']; ?>详情','<?php echo url('followup/index',array('id'=>$b['client_id'])); ?>')">客户详情</button>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; endif; else: echo "" ;endif; endif; ?>
  </tbody>
</table>
<script type="text/javascript">
  function alert_open(title,url){
    layer.open({
      type: 2,
      area: ['800px', '400px'],
      fix: false, //不固定
      title: title,
      content: url,
    });
  }
  function content(obj,url,id){
    $.post("<?php echo url('AjaxAction/backlogStatus'); ?>",{id:id},function(data){
      layer.open({
        type: 0,
        btn:false,
        area: ['300px', '150px'],
        shadeClose: true, //开启遮罩关闭
        content: '</br>&nbsp;&nbsp;&nbsp;'+url,
        cancel:function(index,layero){
          layer.close(index);
          location.reload();
        }
      });
    });
  }
</script>

    </div>
  </div>
</div>
</body>
</html>
