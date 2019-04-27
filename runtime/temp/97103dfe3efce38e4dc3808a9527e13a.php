<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sales/arrangeshow.html";i:1553930245;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
   .layui-form-select{
    width: 100px;
   }
 </style>
</head>
<body>
<div class="layui-fluid">
  <div class="layui-card" style="padding:20px;">
    <div class="layui-tab layui-tab-brief">
      <div class="layui-form-item" style="text-align:center;">
        <label style="font-weight: bold;">销售：<?php echo $user['user_name']; ?></label>
      </div>
      <div class="layui-form-item" style="text-align:center;">
        <label style="font-weight: bold;">起始时间：<?php echo $user['starttime']; ?></label>
      </div>
      <label style="font-weight: bold;">近期数据概况</label>
      <table class="layui-table">
        <thead>
          <tr>
            <th align="center">日期</th>
            <th align="center">未跟进客户</th>
            <th align="center">已跟进客户</th>
            <th align="center">已退单客户</th>
            <th align="center">已报价客户</th>
            <th align="center">已发方案客户</th>
            <th align="center">已发合同客户</th>
            <th align="center">已合作客户</th>
            <th align="center">已付款客户</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($user['count'] as $c): ?>
          <tr>
            <td><?php echo $c['date']; ?></td>
            <td><?php echo $c['failure_followup']; ?></td>
            <td><?php echo $c['followup']; ?></td>
            <td><?php echo $c['retreat']; ?></td>
            <td><?php echo $c['quote']; ?></td>
            <td><?php echo $c['plan']; ?></td>
            <td><?php echo $c['pact']; ?></td>
            <td><?php echo $c['cooperate']; ?></td>
            <td><?php echo $c['payment']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <br/><br/><br/>
      <label style="font-weight: bold;">近期数据详情</label>
      <table class="layui-table">
        <thead>
          <tr>
            <th align="center">日期</th>
            <th align="center">未跟进客户</th>
            <th align="center">已跟进客户</th>
            <th align="center">已退单客户</th>
            <th align="center">已报价客户</th>
            <th align="center">已发方案客户</th>
            <th align="center">已发合同客户</th>
            <th align="center">已合作客户</th>
            <th align="center">已付款客户</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($user['count'] as $c): ?>
          <tr>
            <td><?php echo $c['date']; ?></td>
            <td><?php echo $c['failure_followup']; ?></td>
            <td><?php echo $c['followup']; ?></td>
            <td><?php echo $c['retreat']; ?></td>
            <td><?php echo $c['quote']; ?></td>
            <td><?php echo $c['plan']; ?></td>
            <td><?php echo $c['pact']; ?></td>
            <td><?php echo $c['cooperate']; ?></td>
            <td><?php echo $c['payment']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
