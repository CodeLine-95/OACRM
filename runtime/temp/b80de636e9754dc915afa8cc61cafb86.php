<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sectors/index.html";i:1552027534;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
   .layui-unselect{
     background-color: #eee;
   }
   .layui-form-selected dl{
     background-color: #eee;
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
            <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加部门','<?php echo url('sectors/add'); ?>')"><i class="layui-icon">&#xe608;</i>添加部门</button>
            <form class="layui-form" method="post" style="display:inline-block;position: absolute;right: 0;">
              <div class="layui-input-inline">
                <select name="type">
                  <option value="1" <?php if($data['type'] == 1 || empty($data['type']) == true): ?> selected <?php endif; ?>>部门名称</option>
                  <option value="2" <?php if($data['type'] == 2): ?> selected <?php endif; ?>>负责项目</option>
                  <option value="3" <?php if($data['type'] == 3): ?> selected <?php endif; ?>>部门负责人</option>
                  <option value="4" <?php if($data['type'] == 4): ?> selected <?php endif; ?>>负责人电话</option>
                  <option value="5" <?php if($data['type'] == 5): ?> selected <?php endif; ?>>负责城市</option>
                  <option value="6" <?php if($data['type'] == 6): ?> selected <?php endif; ?>>部门状态</option>
                  <option value="7" <?php if($data['type'] == 7): ?> selected <?php endif; ?>>备注说明</option>
                </select>
              </div>
              <div class="layui-input-inline">
                <input type="text" name="value" class="layui-input" value="<?php echo $data['value']; ?>" style="background-color:#eee;border:none;">
              </div>
              <button class="layui-btn layui-btn-normal" type="submit"><i class="layui-icon layui-icon-search"></i>搜索</button>
            </form>
          </div>
        </crmblok>
        <table class="layui-table">
          <thead>
            <tr>
              <th width="25" align="center">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th  align="center">部门名称</th>
              <th  align="center">所属项目</th>
              <th  align="center">负责业务</th>
              <th  align="center">项目负责人</th>
              <th  align="center">负责人电话</th>
              <th  align="center">负责城市</th>
              <th  align="center">部门职责</th>
              <th  align="center">部门状态</th>
              <th  align="center">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
              <tr align="center" style="height:500px;"><td colspan="10">暂无项目</td></tr>
          <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                  <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vv['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $vv['name']; ?></td>
              <td><?php echo $vv['project']; ?></td>
              <td><?php if(is_array($vv['bubu']) || $vv['bubu'] instanceof \think\Collection || $vv['bubu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['bubu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$haha): $mod = ($i % 2 );++$i;?><?php echo $haha; ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?></td>
              <td><?php echo $vv['author']; ?></td>
              <td><?php echo $vv['tel']; ?></td>
              <td><?php echo $vv['city']; ?></td>
              <td><button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('部门详情','<?php echo url('sectors/show',array('id'=>$vv['id'])); ?>')">见详情</button></td>
              <td><?php if($vv['status'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
              <td>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑部门','<?php echo url('sectors/update',array('id'=>$vv['id'])); ?>')"><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $vv['id']; ?>')"><i class="layui-icon"></i></button>
              </td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; endif; ?>
          </tbody>
        </table>
    </div>
    </div>
  </div>
  <script>
  	function del(id)
  	{
  		layer.confirm("您确定删除此部门吗？",function(){
  			$.ajax({
  				url:"<?php echo url('sectors/del'); ?>",
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
    function delAll()
    {
      var datas = tableCheck.getData();
      layer.confirm("确认删除这些规则吗？",function(){
        $.ajax({
          url:"<?php echo url('integral/del'); ?>",
          data:{id:datas},
          type:'get',
          success:function(data){
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
