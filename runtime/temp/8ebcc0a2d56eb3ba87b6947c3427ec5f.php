<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/media/index.html";i:1552116271;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
        <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加账号','<?php echo url('media/add'); ?>')"><i class="layui-icon">&#xe608;</i>添加账号</button>
      </crmblok>
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
              <th  align="center">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><?php echo $vv['nick']; ?></td>
              <td><?php echo $vv['name']; ?></td>
              <td><?php echo $vv['typename']; ?></td>
              <td><?php echo $vv['platform']; ?></td>
              <td><?php echo $vv['tel']; ?></td>
              <td><?php echo $vv['hostname']; ?></td>
              <td><?php echo $vv['wechat']; ?></td>
              <td><?php echo(date('Y-m-d h:i:s',$vv['create_t']));?></td>
              <td>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑账号','<?php echo url('media/update',['id'=>$vv['id']]); ?>')">编辑</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $vv['id']; ?>')">删除</button>
              </td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <?php echo $list->render(); ?>
    </div>
    </div>
  </div>
  <script>
  	function del(id)
  	{
  		layer.confirm("您确定删除此帐号吗？",function(){
  			$.ajax({
  				url:"<?php echo url('media/del'); ?>",
  				data:{id:id},
  				type:'post',
  				success:function(data)
  				{
  					var status = JSON.parse(data);
  					layer.msg(status.msg,{icon:status.icon,time:1000},function(){
  						window.location.reload();
  					});
  				}
  			});
  		});
  	}
  </script>
</body>
</html>
