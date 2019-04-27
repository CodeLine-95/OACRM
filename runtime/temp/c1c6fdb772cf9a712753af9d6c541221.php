<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/user/media.html";i:1552269019;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
<body class="layui-layout-body">
<div class="layui-fluid" class="layui-form">
  <div class="layui-card">
    <div class="layui-tab layui-tab-brief">
        <!-- <crmblok>
        <div class="layui-form">
          <div class="layui-input-inline">
            <select name="type">
              <option value="1">姓名</option>
              <option value="2">工号</option>
              <option value="3">身份证</option>
              <option value="4">员工电话</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <input type="text" name="value" class="layui-input" style="background-color:#eee;border:none;">
          </div>
          <button class="layui-btn layui-btn-normal" type="submit"><i class="layui-icon layui-icon-search"></i>搜索</button>
        </div>
        </crmblok> -->
        <table class="layui-table">
          <thead>
            <tr>
              <th  align="center">账户昵称</th>
              <th  align="center">登陆账号</th>
              <th  align="center">账号类型</th>
              <th  align="center">平台名称</th>
              <th  align="center">绑定手机</th>
              <th  align="center">手机主人</th>
              <th  align="center">绑定微信</th>
              <th  align="center">添加时间</th>
              <!-- <th  align="center">操作</th> -->
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($Medias) || $Medias instanceof \think\Collection || $Medias instanceof \think\Paginator): $i = 0; $__LIST__ = $Medias;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><?php echo $vv['nick']; ?></td>
              <td><?php echo $vv['name']; ?></td>
              <td><?php echo $vv['typename']; ?></td>
              <td><?php echo $vv['platform']; ?></td>
              <td><?php echo $vv['tel']; ?></td>
              <td><?php echo $vv['hostname']; ?></td>
              <td><?php echo $vv['wechat']; ?></td>
              <td><?php echo(date('Y-m-d h:i:s',$vv['create_t']));?></td>
              <!-- <td> -->
              	<!-- <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑账号','<?php echo url('media/update',['id'=>$vv['id']]); ?>')">编辑</button> -->
              	<!-- <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $vv['id']; ?>')">删除</button> -->
              <!-- </td> -->
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
    </div>
    </div>
  </div>
</body>
</html>
