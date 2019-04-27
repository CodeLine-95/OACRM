<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/operate/createxionlist.html";i:1554262237;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;s:86:"/home/wwwroot/guanjia.jutui.org/application/admin/view/operate/createxionlistcase.html";i:1554262237;}*/ ?>
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
   .layui-form-select,.layui-input{
    width: 200px;
   }
   .layui-form-item .layui-input-inline{
    width: auto;
   }
   .inputbtn::-webkit-input-placeholder{color:#1E9FFF;}
 </style>
</head>
<body>
<div class="layui-fluid" class="layui-form">
  <div class="layui-card">
    <div class="layui-tab layui-tab-brief">
      <crmblok>
        <div style="position: relative;">
          <button class="layui-btn" >客户列表</button>
         
          
          <!-- <button class="layui-btn" onclick="crm_admin_show('批量派单','<?php echo url('sales/addditch'); ?>')">批量派单</button> -->
              <form class="layui-form" method="get" style="display:none;position: absolute;right: 0;">
              <div class="layui-input-inline">
              <input type="text" name="value" value='<?php echo $value; ?>' class="layui-input inputbtn" lay-verify="required"placeholder="请输入用户名/客户名/标题" placeholder-color="red" style="border:solid 1px #eee;width:200px;">
              </div>
              <button class="layui-btn layui-btn-normal" type="submit"><i class="layui-icon layui-icon-search"></i>搜索</button>
              </form>
        </div>
      </crmblok>
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
   .layui-form-select,.layui-input{
    width: 100px;
   }
   .layui-form-item .layui-input-inline{
    width: auto;
   }
 </style>
</head>
<body>
<div class="layui-fluid" class="layui-form">
  <div class="layui-card">
    <div class="layui-tab layui-tab-brief">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<table class="layui-table">
  <thead>
    <tr>
      <th width="25" align="center">编号</th>
      <th align="center" style="width:105px;">创建时间</th>
    <!--   <th align="center" style="width:105px;">用户</th>
      <th align="center" style="width:105px;">客户名字</th> -->
      <th align="center" style="width:70px;">标题</th>
      <th align="center" style="width:70px;">备注</th>
      <th align="center" style="width:125px;">任务是否为长期</th>  
      <th align="center" style="width:165px;">操作</th>
    </tr>
  </thead>
  <tbody>
  <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
    <tr align="center" style="height:300px;"><td colspan="15">暂无客户</td></tr>
  <?php else: foreach($list as $k=>$l): ?>
      <tr  style="background:#<?php echo $l['isnot']==1?"f2f2f2;cursor:not-allowed;":"fff"; ?>;">
        <td> <?php echo $l['id']; ?> </td>
        <td><?php echo date('Y-m-d',$l['intime']); ?><br/><?php echo date('H:i:s',$l['intime']); ?></td>
      <!--   <td><?php echo $l['uid']; ?></td>
       <td><?php echo $l['pid']; ?></td> -->
       <td><?php echo $l['title']; ?></td>
        <td><?php echo $l['remarks']; ?></td>
         <td><?php echo $l['shlote']==0?'长期':'短期'; ?>任务</td>
        <td>
       
        <?php if(($l['isnot']==1)): ?>
         <div class="layui-btn layui-btn-danger layui-btn-xs" style="cursor:not-allowed;">完成</div> 
         <?php else: ?>
          <button onclick="crm_admin_show('详情','<?php echo url('createxionnum',array('id'=>$l['id'])); ?>')" class="layui-btn layui-btn-normal layui-btn-xs">详情</button>
       <?php endif; ?>
     

       
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </tbody>
</table>
<?php echo $list->render(); ?>
<script type="text/javascript">
  function crm_show(title,text,type){
    layer.open({
      type: type,
      area: ['800px', '500px'],
      fix: false, //不固定
      title: title,
      content: text
    });
  }
  layui.use(['rate'],function(){
    var rate = layui.rate;
    //半星效果
    $('.xing').each(function(i){
      rate.render({elem: '#'+i,value: $(this).val(),half: true,text: false,readonly:true});
    });

  });
  function activation(id){
    layer.confirm("您确定激活该客户吗？",function(){
      $.ajax({
        url:"<?php echo url('sales/activation'); ?>",
        data:{id:id},
        type:'post',
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

      </div>  
    </div>
  </div>
  <script type="text/javascript">
    function del(id){
      layer.confirm("您确定删除该客户吗？",function(){
        $.ajax({
          url:"<?php echo url('sales/delser'); ?>",
          data:{id:id},
          type:'post',
          success:function(data){
            var status = JSON.parse(data);
            layer.msg(status.msg,{icon:status.icon,time:1000},function(){
              window.location.reload();
            });
          }
        });
      });
    }
    function delAll(){
      var datas = tableCheck.getData();
      layer.confirm("确认删除选择的客户吗？",function(){
        $.ajax({
          url:"<?php echo url('sales/delser'); ?>",
          data:{id:datas},
          type:'post',
          success:function(data){
            var status = JSON.parse(data);
            layer.msg(status.msg,{icon:status.icon,time:1000},function(){
              window.location.reload();
            });
          }
        });
      });
    }
    // 批量转单
    function changeorderAll(title,url) {
      var datas = tableCheck.getData();
      if (datas != '') {
        crm_admin_show(title,url+'?id='+datas);
      }else{
        layer.msg('请选择后再操作！！',{icon:5,time:1000});
      }
    }
    // 赋值岗位
    layui.use(['form','element','laydate'], function(){
      var form = layui.form,element = layui.element,laydate = layui.laydate;
      laydate.render({elem: '#test6'});
      // 编辑其他员工信息
      form.on('select(project_id)', function(data) {
      var areaId = data.value;
      $.ajax({
        url:"<?php echo url('AjaxAction/business'); ?>",
        data:{id:areaId},
        type:'post',
        success:function(data){
          $("#business").html(data);
          form.render('select');
        }
      });
    });
    form.on('select(sectors)', function(data) {
      var areaId = data.value;
      $.ajax({
        url:"<?php echo url('AjaxAction/quar'); ?>",
        data:{id:areaId},
        type:'post',
        success:function(data){
          $("#quarters_id").html(data);
          form.render('select');
        }
      });
    });
  });
</script>
</body>
</html>

      </div>
    </div>
  </div>
  <script type="text/javascript">
    function del(id){
      layer.confirm("您确定删除该客户吗？",function(){
        $.ajax({
          url:"<?php echo url('sales/delser'); ?>",
          data:{id:id},
          type:'post',
          success:function(data){
            var status = JSON.parse(data);
            layer.msg(status.msg,{icon:status.icon,time:1000},function(){
              window.location.reload();
            });
          }
        });
      });
    }
    function delAll(){
      var datas = tableCheck.getData();
      layer.confirm("确认删除选择的客户吗？",function(){
        $.ajax({
          url:"<?php echo url('sales/delser'); ?>",
          data:{id:datas},
          type:'post',
          success:function(data){
            var status = JSON.parse(data);
            layer.msg(status.msg,{icon:status.icon,time:1000},function(){
              window.location.reload();
            });
          }
        });
      });
    }
    // 批量转单
    function changeorderAll(title,url) {  
      var datas = tableCheck.getData();
      if (datas != '') {
        crm_admin_show(title,url+'?id='+datas);
      }else{
        layer.msg('请选择后再操作！！',{icon:5,time:1000});
      }
    }
    // 赋值岗位
    layui.use(['form','element','laydate'], function(){
      var form = layui.form,element = layui.element,laydate = layui.laydate;
      laydate.render({elem: '#test6'});
      // 编辑其他员工信息
      form.on('select(project_id)', function(data) {
      var areaId = data.value;
      $.ajax({
        url:"<?php echo url('AjaxAction/business'); ?>",
        data:{id:areaId},
        type:'post',
        success:function(data){
          $("#business").html(data);
          form.render('select');
        }
      });
    });
    form.on('select(sectors)', function(data) {
      var areaId = data.value;
      $.ajax({
        url:"<?php echo url('AjaxAction/quar'); ?>",
        data:{id:areaId},
        type:'post',
        success:function(data){
          $("#quarters_id").html(data);
          form.render('select');
        }
      });
    });
  });
</script>
</body>
</html>
