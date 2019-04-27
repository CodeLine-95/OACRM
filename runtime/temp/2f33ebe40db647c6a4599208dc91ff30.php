<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/operate/orderlist.html";i:1554262238;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;s:73:"/home/wwwroot/guanjia.jutui.org/application/admin/view/operate/cases.html";i:1555926373;}*/ ?>
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
          <?php if((!empty($implement))): switch($implement): case "ibegunnot": ?><!-- <button class='layui-btn' onclick="crm_admin_show('批量派单','<?php echo url('implement'); ?>')">特殊任务订单</button> --><?php break; case "ibegunin": ?><button class='layui-btn' >执行</button><?php break; case "ibegunexit": ?><button class='layui-btn'>结束</button><?php break; endswitch; endif; ?>
          <!-- <button class="layui-btn" onclick="crm_admin_show('批量派单','<?php echo url('sales/addditch'); ?>')">批量派单</button> -->
              <form class="layui-form" method="get" style="display:inline-block;position: absolute;right: 0;">
              <div class="layui-input-inline">
              <input type="text" name="value" value='<?php echo $value; ?>' class="layui-input inputbtn" lay-verify="required"placeholder="请输入姓名/公司/手机/微信" placeholder-color="red" style="border:solid 1px #eee;width:200px;">
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
 <link rel="stylesheet" href="/static/admin/css/icon.css" media="all">
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
      <th align="center" style="width:105px;">跟进时间</th>
      <th align="center" style="width:90px;">姓名</th>
      <th align="center" style="width:70px;">性别</th>
      <th align="center" style="width:70px;">地域</th>
      <th align="center" style="width:125px;">电话</th>
      <th align="center" style="width:95px;">微信号</th>
      <th align="center">业务类型</th>
      <th align="center" style="width:90px;">运营</th>
      <th align="center" style="width:80px;">销售</th>
      <th align="center" style="width:90px;">派发客服</th>
      <th align="center" style="width:90px;">客户状态</th>
      <th align="center" style="width:161px;">客户星级</th>
      <th align="center" style="width:90px;">跟进状态</th>
      <th align="center" style="width:165px;">操作</th>
    </tr>
  </thead>
  <tbody>
  <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
    <tr align="center" style="height:300px;"><td colspan="15">暂无客户</td></tr>
  <?php else: foreach($list as $k=>$l): ?>
      <tr>
        <td>
         <?php echo $l['id']; ?>
        </td>
        <td><?php echo date('Y-m-d',$l['create_t']); ?><br/><?php echo date('H:i:s',$l['create_t']); ?></td>
        <td><?php if($l['last_time'] == 0): ?>暂未跟进<?php else: ?><?php echo date('Y-m-d',$l['last_time']); ?><br/><?php echo date('H:i:s',$l['last_time']); endif; ?></td>
        <td><?php echo $l['name']; ?></td>
        <td>
          <?php echo $l['sex']==1?'男':'女'; ?>
        </td>
        <td><?php echo $l['city']; ?></td>
        <td><?php if($l['phone'] == ''): ?>暂无信息<?php else: ?><span style="color:#8BC34A;"><?php echo str_replace('+86-','',$l['phone']); ?></span><?php endif; ?></td>
        <td><?php if($l['wechat'] == ''): ?>暂无信息<?php else: ?><span style="color:#259B24;"><?php echo $l['wechat']; ?></span><?php endif; ?></td>
        <td><?php echo $l['business']; ?></td>
        <td><span style="color:green;"><?php echo $l['operate_name']; ?></span></td>
        <td><?php if($l['service_id'] == 0): ?>暂未分配<?php else: ?><span style="color:#1E9FFF;"><?php echo $l['service_name']; ?></span><?php endif; ?></td>
        <td><span style="color:#1E9FFF;"><?php echo $l['username']==''?'无或自建':$l['username']; ?></span></td>
        <td><?php echo $l['schedule']==''?'暂无':$l['schedule']; ?> </td>
        <td><input type="hidden" class="xing" value="<?php echo $l['level']; ?>"><div><div id="<?php echo $k; ?>"></div></div></td>
          <td>
       <?php switch($l['order_id']): case "27":case "28": ?><label class="order_name26">未跟进</label><?php break; case "29": ?><label class="order_name27">已跟进</label><?php break; default: ?><label class="order_name<?php echo $l['order_id']; ?>"><?php echo $l['order_name']; ?></label>
        <?php endswitch; ?>
      </td>

        <td> <button onclick="crm_admin_show('<?php echo $l['name']; ?>-跟进','<?php echo url('followup/index',array('id'=>$l['id'])); ?>')" class="layui-btn layui-btn-normal layui-btn-xs">跟进详情</button><br>
          <?php if((!empty($implement))): switch($implement): case "ibegunnot": ?>
              <button class="layui-btn layui-btn-normal layui-btn-xs" onclick="crm_admin_show('批量派单','<?php echo url('implement',array('id'=>$l['id'])); ?>')">创建订单</button><br>
              <button class="layui-btn layui-btn-normal layui-btn-xs" onclick="crm_admin_show('批量派单','<?php echo url('createxionlist',array('id'=>$l['id'])); ?>')">订单列表</button><br>
            <?php break; case "ibegunin": ?><button class="layui-btn layui-btn-normal layui-btn-xs" onclick="crm_admin_show('批量派单','<?php echo url('createxionlist',array('id'=>$l['id'])); ?>')">周期报表</button><br><?php break; case "ibegunexit": ?><div class="layui-btn layui-btn-normal layui-btn-xs" >结束</div><?php break; endswitch; endif; ?>
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
