<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sales/arrange.html";i:1556164875;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加排班销售','<?php echo url('sales/arrangeadd'); ?>')"><i class="layui-icon">&#xe608;</i>添加排班销售</button>
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
            <th align="center">未跟进</th>
            <th align="center">已跟进</th>
            <th align="center">已退单</th>
            <th align="center">已报价</th>
            <th align="center">已发方案</th>
            <th align="center">已发合同</th>
            <th align="center">已合作</th>
            <th align="center">已付款</th>
            <th align="center">累计数据</th>
            <th align="center">状态</th>
            <th align="center">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
          <tr align="center" style="height:300px;"><td colspan="11">暂无排班销售</td></tr>
        <?php else: foreach($list as $l): ?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $l['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $l['user_name']; ?></td>
              <td><?php echo date('Y-m-d',$l['start_time']); ?></td>
              <td><?php echo $l['project']; ?></td>
              <td><?php echo $l['business']; ?></td>
              <td><?php echo $l['failure_followup']; ?></td>
              <td><?php echo $l['followup']; ?></td>
              <td><?php echo $l['retreat']; ?></td>
              <td><?php echo $l['quote']; ?></td>
              <td><?php echo $l['plan']; ?></td>
              <td><?php echo $l['pact']; ?></td>
              <td><?php echo $l['cooperate']; ?></td>
              <td><?php echo $l['payment']; ?></td>
              <td><?php echo $l['allCount']; ?></td>
              <td><?php if($l['status'] == 1): ?>正常<?php else: ?>已暂停<?php endif; ?></td>
              <td>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('详情','<?php echo url('sales/arrangeshow',['id'=>$l['id']]); ?>')">详情</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑','<?php echo url('sales/arrangeedit',['id'=>$l['id']]); ?>')">编辑</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $l['id']; ?>')">删除</button>
                <?php if($l['status'] == 1): ?>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="status(this,'<?php echo $l['id']; ?>')">暂停</button>
                <?php else: ?>
                <button class="layui-btn layui-btn-warm layui-btn-sm" onclick="status(this,'<?php echo $l['id']; ?>')">已暂停</button>
                <?php endif; ?>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('排版客户列表','<?php echo url('sales/arrangeorder',['id'=>$l['user_id']]); ?>')">客户列表</button>
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
      layer.confirm("您确定删除该值班销售吗？",function(){
        $.post("<?php echo url('sales/arrangedel'); ?>",{id:id},function(data){
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
      layer.confirm("您确定"+new_text+"该值班销售吗？",function(){
        $.post("<?php echo url('sales/arrangestatus'); ?>",{id:id},function(data){
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
