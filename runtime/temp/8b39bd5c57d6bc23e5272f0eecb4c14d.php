<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/service/arrange.html";i:1552040312;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
<body class="layui-layout-body">
<div class="layui-fluid" class="layui-form">
  <div class="layui-card">
    <div class="layui-tab layui-tab-brief">
      <crmblok>
        <div style="position: relative;">
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加排班客服','<?php echo url('service/arrangeadd'); ?>')"><i class="layui-icon">&#xe608;</i>添加排班客服</button>
        </div>
      </crmblok>
      <table class="layui-table">
        <thead>
          <tr>
            <th width="25" align="center">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th align="center">姓名</th>
            <th align="center">起始时间</th>
            <th align="center">负责项目</th>
            <th align="center">负责业务</th>
            <th align="center">今日派单</th>
            <th align="center">本周派单</th>
            <th align="center">本月派单</th>
            <th align="center">本月退单</th>
            <th align="center">累积派单</th>
            <th align="center">累积数据</th>
            <th align="center">状态</th>
            <th align="center">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
          <tr align="center" style="height:300px;"><td colspan="11">暂无排班客服</td></tr>
        <?php else: foreach($list as $l): ?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $l['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $l['user_name']; ?></td>
              <td><?php echo date('Y-m-d',$l['start_time']); ?></td>
              <td><?php echo $l['project']; ?></td>
              <td><?php echo $l['business']; ?></td>
              <td><?php echo $l['todayCount']; ?></td>
              <td><?php echo $l['newWeek']; ?></td>
              <td><?php echo $l['newmonthCount']; ?></td>
              <td><?php echo $l['newmonthBack']; ?></td>
              <td><?php echo $l['dispatch']; ?></td>
              <td><?php echo $l['allCount']; ?></td>
              <td><?php if($l['status'] == 1): ?>正常<?php else: ?>已暂停<?php endif; ?></td>
              <td>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('详情','<?php echo url('service/arrangeshow',['id'=>$l['id']]); ?>')">详情</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑','<?php echo url('service/arrangeedit',['id'=>$l['id']]); ?>')">编辑</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $l['id']; ?>')">删除</button>
                <?php if($l['status'] == 1): ?>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="status(this,'<?php echo $l['id']; ?>')">暂停</button>
                <?php else: ?>
                <button class="layui-btn layui-btn-warm layui-btn-sm" onclick="status(this,'<?php echo $l['id']; ?>')">已暂停</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript">
    //删除
    function del(id){
      layer.confirm("您确定删除该值班客服吗？",function(){
        $.post("<?php echo url('service/arrangedel'); ?>",{id:id},function(data){
          var status = JSON.parse(data);
          layer.msg(status.msg,{icon:status.icon,time:1000},function(){
            window.location.reload();
          });
        });
  		});
    }
    //更新暂停状态
    function status(obj,id){
      var text = $(obj).text();
      if (text == '已暂停') {
        var new_text = '开启';
      }else{
        var new_text = '暂停';
      }
      layer.confirm("您确定"+new_text+"该值班客服吗？",function(){
        $.post("<?php echo url('service/arrangestatus'); ?>",{id:id},function(data){
          var status = JSON.parse(data);
          layer.msg(status.msg,{icon:status.icon,time:1000},function(){
            window.location.reload();
          });
        });
  		});
    }
  </script>
</div>
</body>
</html>
