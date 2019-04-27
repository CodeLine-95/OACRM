<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sales/arrangeedit.html";i:1552293201;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
  .layui-form-select{
    width: 100px;
  }
  .layui-form-selected dl{
    background-color: #eee;
  }
</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">编辑排班销售</div>
          <div class="layui-card-body" pad15>
            <crmblok>
              <div class="layui-form">
                <div class="layui-input-inline">
                  <select name="type">
                    <option value="1">工号</option>
                    <option value="2">姓名</option>
                  </select>
                </div>
                <div class="layui-input-inline">
                  <input type="text" name="value" class="layui-input" style="background-color:#eee;border:none;">
                </div>
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="user_list"><i class="layui-icon layui-icon-search"></i>搜索销售</button>
              </div>
            </crmblok>
            <div class="layui-form">
              <input type="hidden" name="id" value="<?php echo $field['id']; ?>">
              <div class="layui-card" style="width: 100%;" id="tables">
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
                  <tbody id="table_tr">
                    <tr>
                      <td align="center"><input type="radio" name="member" value="<?php echo $user['id']; ?>" checked></td>
                      <td align="center"><?php echo $user['user_name']; ?></td>
                      <td align="center"><?php if($user['staff_sex'] == 1): ?>女<?php else: ?>男<?php endif; ?></td>
                      <td align="center"><?php echo $user['sectors']; ?></td>
                      <td align="center"><?php echo $user['quarters']; ?></td>
                      <td align="center"><?php echo $user['yewu']; ?></td>
                      <td align="center"><?php echo $user['staff_tel']; ?></td>
                      <td align="center"><?php echo $user['shangji']; ?></td>
                      <td align="center"><?php echo $user['create_time']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">负责项目</h3>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_wechat">选择项目</label>
                <div class="layui-input-inline">
                  <select name="project_id" id="project_id" class="layui-input" lay-filter="project_id">
                    <option value="999" <?php if($field['project_id'] == 999): ?>selected<?php endif; ?>>全部项目</option>
                    <?php foreach($projects as $p): ?>
                    <option value="<?php echo $p['id']; ?>" <?php if($field['project_id'] == $p['id']): ?>selected<?php endif; ?>><?php echo $p['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="layui-form-item">
              <label class="layui-form-label" for="staff_hobby">选择业务</label>
              <div class="layui-input-block" id="yewu">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_hobby">状态</label>
              <div class="layui-input-block" id="yewu">
                <input type="radio" name="status" value="1" title="正常" <?php if($field['status'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="0" title="已暂停" <?php if($field['status'] == 0): ?>checked<?php endif; ?>>
              </div>
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
  <script type="text/javascript">
    var areaId = $('#project_id option:selected').val();
    var id = $('input[name=id]').val();
    $.ajax({
      url:"<?php echo url('AjaxAction/yewu'); ?>",
      data:{project_id:areaId,id:id},
      type:'post',
      success:function(data){
        console.log(typeof(data))
        $("#yewu").html(data);
      }
    });
    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      form.on('submit(user_list)',function(data){
        if (data.field.value === '') {
          layer.msg('搜索内容不能为空',{icon: 5,time:3000});
        }else{
          $.post('<?php echo url("AjaxAction/allteam"); ?>',{data:JSON.stringify(data.field)},function(data){
            var data_list = JSON.parse(data);
            var html = '';
            for (var i = 0; i < data_list.length; i++) {
              html += '<tr>';
              html += '<td align="center"><input type="radio" name="member" value="'+data_list[i]['id']+'" checked /></td>';
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
      form.on('select(project_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/yewu'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#yewu").html(data);
            form.render('checkbox');
          }
        });
      });
      //获取多选框value值，拼接成逗号分隔的字符串
      function returnCheckboxItem(name){
        var adIds = "";
        $('input:checkbox[name="'+name+'"]:checked').each(function(i){
            if(0==i){
              adIds = $(this).val();
            }else{
              adIds += (","+$(this).val());
            }
        });
        return adIds;
      }
      form.on('submit(set_website)', function(data){
        // data.field.firm_business = returnCheckboxItem("firm_business");
        data.field.business_list = returnCheckboxItem('business');
        $.ajax({
          type:'POST',
          url:'<?php echo url("sales/arrangeedit"); ?>',
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
