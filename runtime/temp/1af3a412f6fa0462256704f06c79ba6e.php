<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/team/media.html";i:1554868193;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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

</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">分配账号</div>
          <div class="layui-card-body" pad15>
            <crmblok>
              <div class="layui-form">
                <div class="layui-input-inline">
                  <select name="type">
                    <option value="2">姓名</option>
                    <option value="1">工号</option>
                  </select>
                </div>
                <div class="layui-input-inline">
                  <input type="text" name="value" class="layui-input" style="background-color:#eee;border:none;">
                </div>
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="user_list"><i class="layui-icon layui-icon-search"></i>搜索人员</button>
              </div>
            </crmblok>
            <hr style="height:2px;" />
            <div class="layui-form"  lay-filter="">
              <div class="layui-card" style="width: 100%;display:none;" id="tables">
                <div class="layui-form-item layui-form-text">
                  <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">选择员工</h3>
                </div>
                <table class="layui-table">
                  <thead>
                    <tr>
                      <td align="center">选择</td>
                      <td align="center">姓名</td>
                      <td align="center">性别</td>
                      <td align="center">部门</td>
                      <td align="center">岗位</td>
                      <td align="center">职责</td>
                      <td align="center">手机号</td>
                      <td align="center">直属领导</td>
                      <td align="center">入职时间</td>
                    </tr>
                  </thead>
                  <tbody id="table_tr"></tbody>
                </table>
              </div>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">分配账号</h3>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_province">账号类型</label>
                <div class="layui-input-inline">
                  <select class="layui-input" lay-filter="typeid" id="typeid">
                    <?php if(is_array($typelist) || $typelist instanceof \think\Collection || $typelist instanceof \think\Paginator): $i = 0; $__LIST__ = $typelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vv['id']; ?>" ><?php echo $vv['typename']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <label class="layui-form-label" for="memname">账号平台</label>
                <div class="layui-input-inline">
                  <select class="layui-input" lay-filter="memname" id="memname">
                  </select>
                </div>

                <label class="layui-form-label" for="nick">账号昵称</label>
                <div class="layui-input-inline">
                  <select class="layui-input" id="nick">
                  </select>
                </div>

                <button class="layui-btn" onclick="tijiao()"><i class="layui-icon">&#xe608;</i></button>
              </div>
              <div class="layui-card" style="width: 100%;margin-left: 0.5%;">
                <table class="layui-table">
                  <thead>
                    <tr>
                      <td align="center">类型</td>
                      <td align="center">平台</td>
                      <td align="center">昵称</td>
                      <td align="center">登陆地址</tb>
                      <td align="center">账号</td>
                      <td align="center">密码</td>
                      <td align="center">操作</td>
                    </tr>
                  </thead>
                  <tbody id="table">
                  </tbody>
                </table>

              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="set_website">提交</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var Mediatype = $('#typeid option:first').val();
    layui.use(['form'], function(){
      var form = layui.form;
      $.ajax({
        url:"<?php echo url('AjaxAction/seekmem'); ?>",
        data:{id:Mediatype},
        type:'post',
        success:function(data){
          $("#memname").html(data);
          var mediaOne = $('#memname option:first').val();
          $.ajax({
            url:"<?php echo url('AjaxAction/mediaOne'); ?>",
            data:{id:mediaOne},
            type:'post',
            success:function(data){
              $("#nick").html(data);
              form.render('select');
            }
          });
          form.render('select');
        }
      });
    });
    function tijiao(){
      var type_id = $("#typeid").val();
      var platform_id = $("#memname").val();
      var nick_id = $("#nick").val();
      $.ajax({
        url:"<?php echo url('AjaxAction/allmem'); ?>",
        data:{id:nick_id},
        type:"post",
        success:function(data){
          $("#table").append(data);
        }
      });
    }

    function deldel(id){
      $("#del"+id).remove();
    }

    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      form.on('select(typeid)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/seekmem'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#memname").html(data);
            form.render('select');
          }
        });
      });
      form.on('select(memname)',function(data){
        $.ajax({
          url:"<?php echo url('AjaxAction/mediaOne'); ?>",
          data:{id:data.value},
          type:'post',
          success:function(data){
            $("#nick").html(data);
            form.render('select');
          }
        });
      });
      form.on('submit(user_list)',function(data){
        if (data.field.value === '') {
          layer.msg('搜索内容不能为空',{icon: 5,time:3000});
        }else{
          $.post('<?php echo url("AjaxAction/allteam"); ?>',{data:JSON.stringify(data.field)},function(data){
            var data_list = JSON.parse(data);
            var html = '';
            for (var i = 0; i < data_list.length; i++) {
              html += '<tr>';
              html += '<td align="center"><input type="radio" name="member" value="'+data_list[i]['id']+'"></td>';
              html += '<td align="center">'+data_list[i]['user_name']+'</td>';
              if (data_list[i]['staff_sex'] == 1) {
                var sex = '女';
              }else{
                var sex = '男';
              }
              html += '<td align="center">'+sex+'</td>';
              html += '<td align="center">'+data_list[i]['sectors']+'</td>';
              html += '<td align="center">'+data_list[i]['quarters']+'</td>';
              html += '<td align="center">'+data_list[i]['yewu']+'</td>';
              html += '<td align="center">'+data_list[i]['staff_tel']+'</td>';
              html += '<td align="center">'+data_list[i]['shangji']+'</td>';
              html += '<td align="center">'+data_list[i]['create_time']+'</td>';
              html += "</tr>";
            }
            $('#table_tr').html(html);
            $('#tables').css({'display':'block'});
            form.render('radio');
          });
        }
      });
      form.on('submit(set_website)', function(data){
        $.ajax({
          type:'POST',
          url:'<?php echo url("AjaxAction/allotzhang"); ?>',
          data: {
            data:JSON.stringify(data.field)
          },
          success:function (data) {
            var status = JSON.parse(data);
            if (status.icon == 6){
              layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                window.parent.location.reload();
              });
            } else {
              layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                window.location.reload();
              });
            }
          }
        });
        return false;
      });
    });
  </script>
</body>
</html>
