<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/medium/index.html";i:1553079399;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
            <button class="layui-btn layui-btn-normal" onclick="crm_admin_show('添加供应商','<?php echo url('medium/add'); ?>')"><i class="layui-icon">&#xe608;</i>添加供应商</button>
          </div>
        </crmblok>
        <table class="layui-table">
          <thead>
            <tr>
              <th width="25" align="center">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th align="center" style="width:80px;">联系人</th>
              <th align="center" style="width:200px;">公司品牌</th>
              <th align="center" style="width:80px;">城市</th>
              <th align="center" style="width:120px;">联系电话</th>
              <th align="center" style="width:105px;">联系微信</th>
              <th align="center">业务类型</th>
              <th align="center" style="width:100px;">合作状态</th>
              <th align="center" style="width:130px;">星级</th>
              <th align="center" style="width:160px;">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
            <tr align="center" style="height:300px;"><td colspan="10">暂无供应商</td></tr>
          <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                  <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vv['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $vv['user_name']; ?></td>
              <td><?php echo $vv['external_brand']; ?></td>
              <td><?php echo $vv['user_city']; ?></td>
              <td><?php echo $vv['user_tel']; ?></td>
              <td><?php echo $vv['user_wechat']; ?></td>
              <td>
                <?php foreach($vv['typeList'] as $v): ?>
                <?php echo $v['typename']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </td>
              <td>
                <?php switch($vv['status']): case "0": ?>审核中<?php break; case "1": ?>预备中<?php break; case "2": ?>暂停中<?php break; case "3": ?>合作中<?php break; endswitch; ?>
              </td>
              <td><input type="hidden" id="xing" value="<?php echo $vv['rate']; ?>"><div><div id="test4"></div></div></td>
              <td>
                <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('详情','<?php echo url('medium/show',['id'=>$vv['id']]); ?>')">详情</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="crm_admin_show('编辑','<?php echo url('medium/update',['id'=>$vv['id']]); ?>')">编辑</button>
              	<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="del('<?php echo $vv['id']; ?>')">删除</button>
              </td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; endif; ?>
          </tbody>
        </table>
    </div>
    </div>
  </div>
  <script>
    layui.use(['rate'],function(){
      var rate = layui.rate;
      //半星效果
      var xing = $("#xing").val();
      rate.render({elem: '#test4',value: xing,half: true,text: false,readonly:true});
    });
  	function del(id)
  	{
  		layer.confirm("您确定删除该供应商吗？",function(){
  			$.ajax({
  				url:"<?php echo url('medium/del'); ?>",
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
      layer.confirm("确认删除选中的供应商吗？",function(){
        $.ajax({
          url:"<?php echo url('medium/del'); ?>",
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
