<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/team/sectors.html";i:1553854930;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
<body onload="firstlist()">
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">分配部门</div>
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
              <button class="layui-btn layui-btn-normal" lay-submit lay-filter="user_list"><i class="layui-icon layui-icon-search"></i>搜索人员</button>
            </div>
          </crmblok>
        <div class="layui-form">
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

          <div class="layui-form layui-card-body" pad15>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">公司信息</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="user_name">所属部门</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="sectors_id" lay-filter="sectors_id" id="sectors_id">
                  <?php if(is_array($sectors) || $sectors instanceof \think\Collection || $sectors instanceof \think\Paginator): $i = 0; $__LIST__ = $sectors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                      <option value="<?php echo $vv['id']; ?>" <?php if($member['sectors_id'] == $vv['id']): ?> selected="" <?php endif; ?>><?php echo $vv['name']; ?></option>
                      <?php else: ?>
                      <option value="<?php echo $vv['id']; ?>"><?php echo $vv['name']; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>

               <label class="layui-form-label" for="staff_idcard">员工岗位</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="quarters_id" lay-filter="quarters_id" id="quarters_id">

                </select>
              </div>

              <label class="layui-form-label" for="user_name">入职时间</label>
              <div class="layui-input-inline">
                <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                <input type="text" name="firm_hiredate" class="layui-input" id="test1" value="<?php echo date('Y-m-d',$member['firm_hiredate']); ?>" placeholder="请选择入职时间">
                <?php else: ?>
                <input type="text" name="firm_hiredate" class="layui-input" id="test1" placeholder="请选择入职时间">
                <?php endif; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="user_name">负责城市</label>
              <div class="layui-input-inline">
              	<select class="layui-input" name="citys_id" lay-filter="citys_id" id="citys_id">
                  <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                      <option value="<?php echo $vv['id']; ?>" <?php if($member['citys_id'] == $vv['id']): ?> selected="" <?php endif; ?>><?php echo $vv['name']; ?></option>
                      <?php else: ?>
                      <option value="<?php echo $vv['id']; ?>"><?php echo $vv['name']; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>

              <label class="layui-form-label" for="staff_idcard">公司手机</label>
              <div class="layui-input-inline">
                <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                 <input type="text" name="firm_tel" id="firm_tel" class="layui-input" value="<?php echo $member['firm_tel']; ?>">
                <?php else: ?>
                 <input type="text" name="firm_tel" id="firm_tel" class="layui-input">
                <?php endif; ?>
              </div>

              <label class="layui-form-label" for="staff_province">公司微信</label>
              <div class="layui-input-inline">
                <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                <input type="text" name="firm_wechat" id="firm_wechat" class="layui-input" value="<?php echo $member['firm_wechat']; ?>">
                <?php else: ?>
                <input type="text" name="firm_wechat" id="firm_wechat" class="layui-input">
                <?php endif; ?>
              </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="user_name">公司QQ</label>
                <div class="layui-input-inline">
                  <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                    <input type="text" name="firm_qq" id="firm_qq" class="layui-input" value="<?php echo $member['firm_qq']; ?>">
                  <?php else: ?>
                    <input type="text" name="firm_qq" id="firm_qq" class="layui-input">
                  <?php endif; ?>
                </div>

                <label class="layui-form-label" for="staff_idcard">公司邮箱</label>
                <div class="layui-input-inline">
                  <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                    <input type="text" name="firm_email" id="firm_email" class="layui-input" value="<?php echo $member['firm_email']; ?>">
                  <?php else: ?>
                    <input type="text" name="firm_email" id="firm_email" class="layui-input">
                  <?php endif; ?>
                </div>

                <label class="layui-form-label" for="staff_province">员工级别</label>
                <div class="layui-input-inline">
                  <select class="layui-input" name="firm_rank" lay-filter="firm_rank" id="firm_rank">
                    <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                    <option value="1" <?php if($member['firm_rank'] == 1): ?> selected <?php endif; ?>>P1</option>
                    <option value="2" <?php if($member['firm_rank'] == 2): ?> selected <?php endif; ?>>P2</option>
                    <option value="3" <?php if($member['firm_rank'] == 3): ?> selected <?php endif; ?>>P3</option>
                    <option value="4" <?php if($member['firm_rank'] == 4): ?> selected <?php endif; ?>>P4</option>
                    <option value="5" <?php if($member['firm_rank'] == 5): ?> selected <?php endif; ?>>P5</option>
                    <option value="6" <?php if($member['firm_rank'] == 6): ?> selected <?php endif; ?>>P6</option>
                    <option value="7" <?php if($member['firm_rank'] == 7): ?> selected <?php endif; ?>>P7</option>
                    <option value="8" <?php if($member['firm_rank'] == 8): ?> selected <?php endif; ?>>P8</option>
                    <option value="9" <?php if($member['firm_rank'] == 9): ?> selected <?php endif; ?>>P9</option>
                    <option value="10" <?php if($member['firm_rank'] == 10): ?> selected <?php endif; ?>>P10</option>
                    <?php else: ?>
                    <option value="1">P1</option>
                    <option value="2">P2</option>
                    <option value="3">P3</option>
                    <option value="4">P4</option>
                    <option value="5">P5</option>
                    <option value="6">P6</option>
                    <option value="7">P7</option>
                    <option value="8">P8</option>
                    <option value="9">P9</option>
                    <option value="10">P10</option>
                    <?php endif; ?>
                  </select>
                </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_province">负责项目</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="project_id" lay-filter="project_id" id="project_id">
                  <option value="999">全部项目</option>
                    <?php if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                      <option value="<?php echo $vv['id']; ?>" <?php if($member['project_id'] == $vv['id']): ?> selected="" <?php endif; ?>><?php echo $vv['name']; ?></option>
                      <?php else: ?>
                      <option value="<?php echo $vv['id']; ?>"><?php echo $vv['name']; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">负责业务</label>
              <div class="layui-input-block" id="yewu">
                  <input type='checkbox' name='firm_business[]' value='99999' title='全部业务'  lay-verify='firm_business|required'>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">汇报对象</h3>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_idcard">选择部门</label>
              <div class="layui-input-inline">
                  <select class="layui-input"  lay-search lay-filter="choose" id="choose">
                  <?php if(is_array($sectors) || $sectors instanceof \think\Collection || $sectors instanceof \think\Paginator): $i = 0; $__LIST__ = $sectors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vv['id']; ?>" <?php if($member['bumen'] == $vv['id']): ?> selected <?php endif; ?>><?php echo $vv['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>

              <label class="layui-form-label" for="staff_province">选择对象</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="firm_report" lay-search lay-filter="firm_report" id="firm_report">

                </select>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">员工状态</h3>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label" for="user_name">员工类型</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="firm_type" lay-verify="firm_type|required">
                  <option value="1" <?php if($member['firm_type'] == 1): ?> selected="" <?php endif; ?>>全职</option>
                  <option value="2" <?php if($member['firm_type'] == 2): ?> selected="" <?php endif; ?>>兼职</option>
                </select>
              </div>

              <label class="layui-form-label" for="staff_idcard">在职阶段</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="firm_incumbency" lay-verify="firm_incumbency|required">
                  <option value="1" <?php if($member['firm_incumbency'] == 1): ?> selected="" <?php endif; ?>>实习期</option>
                  <option value="2" <?php if($member['firm_incumbency'] == 2): ?> selected="" <?php endif; ?>>试用期</option>
                  <option value="3" <?php if($member['firm_incumbency'] == 3): ?> selected="" <?php endif; ?>>已转正</option>
                </select>
              </div>

              <label class="layui-form-label" for="staff_province">员工状态</label>
              <div class="layui-input-inline">
                <select class="layui-input" name="staff_status" lay-filter="staff_status" id="staff_status">
                  <option value="1" <?php if($member['staff_status'] == 1): ?> selected="" <?php endif; ?>>在职</option>
                  <option value="3" <?php if($member['staff_status'] == 3): ?> selected="" <?php endif; ?>>休假</option>
                  <option value="2" <?php if($member['staff_status'] == 2): ?> selected="" <?php endif; ?>>离职</option>
                </select>
              </div>
            </div>
            <div  class="hahaha layui-form-item" <?php if($member['staff_status'] != 2): ?> style="display: none;"<?php endif; ?>>
              <label class="layui-form-label" for="staff_idcard">离职时间</label>
              <div class="layui-input-inline">
                <?php if(!(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty()))): ?>
                <input type="text" name="firm_leavedate" class="layui-input" id="test2" value="<?php echo date('Y-m-d',$member['firm_leavedate']); ?>" placeholder="请选择离职时间">
                <?php else: ?>
                 <input type="text" name="firm_leavedate" class="layui-input" id="test2"  placeholder="请选择离职时间">
                <?php endif; ?>
              </div>
            </div>
            <div class="hahaha layui-form-item" <?php if($member['staff_status'] != 3): ?> style="display: none;"<?php endif; ?>>
              <label class="layui-form-label">离职原因</label>
              <div class="layui-input-block">
                <input type="checkbox" name="firm_answer[]" value="薪资问题" title="薪资问题" <?php if(in_array('薪资问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="公司福利" title="公司福利"  <?php if(in_array('公司福利',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="公司制度" title="公司制度"  <?php if(in_array('公司制度',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="老板问题" title="老板问题"  <?php if(in_array('老板问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="上级问题" title="上级问题"  <?php if(in_array('上级问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="公司环境" title="公司环境"  <?php if(in_array('公司环境',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="家庭因素" title="家庭因素"  <?php if(in_array('家庭因素',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="加班问题" title="加班问题"  <?php if(in_array('加班问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="上班时长" title="上班时长"  <?php if(in_array('上班时长',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="距离问题" title="距离问题"  <?php if(in_array('距离问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="调岗问题" title="调岗问题"  <?php if(in_array('调岗问题',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="发展方向" title="发展方向"  <?php if(in_array('发展方向',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="同事矛盾" title="同事矛盾"  <?php if(in_array('同事矛盾',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="绩效考核" title="绩效考核"  <?php if(in_array('绩效考核',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="入学深造" title="入学深造"  <?php if(in_array('入学深造',$firm_answer) == true): ?> checked="" <?php endif; ?>>
                <input type="checkbox" name="firm_answer[]" value="独立创业" title="独立创业"  <?php if(in_array('独立创业',$firm_answer) == true): ?> checked="" <?php endif; ?>>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">员工权限</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="role_id">分配权限</label>
              <div class="layui-form-block">
                <?php foreach($roles as $r): ?>
                <input type="radio" name="role_id" value="<?php echo $r['id']; ?>" title="<?php echo $r['title']; ?>">
                <?php endforeach; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                  <label class="layui-form-label"><button class="layui-btn" lay-submit lay-filter="add">点击提交</button></label>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  	function firstlist()
  	{
        if("<?php echo $member['sectors_id']; ?>"!=false){
          if("<?php echo $member['quarters_id']; ?>"!=false){
            var quarters_id = "<?php echo $member['quarters_id']; ?>";
          }else{
            var quarters_id = "";
          }
          var areaId = $("#sectors_id ").val();
          layui.use(['form','element'], function(){
            var form = layui.form,
            element = layui.element;
              $.ajax({
                url:"<?php echo url('AjaxAction/quar'); ?>",
                data:{id:areaId,quarters_id:quarters_id},
                type:'post',
                success:function(data){
                  $("#quarters_id").html(data);
                  form.render('select');
                }
            });
          });
        }else{
          $("#sectors_id option:first").prop("selected", 'selected');
          var areaId = $("#sectors_id option:first").val();
          layui.use(['form','element'], function(){
            var form = layui.form,
            element = layui.element;
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
        }

        if("<?php echo $member['bumen']; ?>"!=false){
            var areaId = "<?php echo $member['bumen']; ?>";
            var firm_report = "<?php echo $member['firm_report']; ?>"
            $.ajax({
              url:"<?php echo url('AjaxAction/mems'); ?>",
              data:{id:areaId,firm_report:firm_report},
              type:'post',
              success:function(data){
                $("#firm_report").html(data);
                form.render('select');
              }
            });
        }


	  	var yewuid = $("#project_id option:first").val();
	  	layui.use(['form','element'], function(){
	      var form = layui.form,
	      element = layui.element;
	        $.ajax({
	          url:"<?php echo url('AjaxAction/teamYewu'); ?>",
	          data:{id:yewuid},
	          type:'post',
	          success:function(data){
	            $("#yewu").html(data);
	            form.render('checkbox');
	          }
	      });
	  	});
  	}
    layui.use(['form','element','laydate'], function(){
      var form = layui.form;
      var laydate = layui.laydate;
      element = layui.element;

      laydate.render({
  	    elem: '#test1'
  	  });

  	  laydate.render({
  	    elem: '#test2'
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

      form.on('select(sectors_id)', function(data) {
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

      form.on('select(staff_status)', function(data) {
        if (data.value != 2) {
          $(".hahaha").css('display','none');
          $(".hahaha").attr('display','none');
        }else{
          $(".hahaha").css('display','block');
          $(".hahaha").attr('display','block');
        }
      });

      form.on('select(choose)', function(data) {
        var areaId = data.value;
        if("<?php echo $member['firm_report']; ?>"!=false){
          var firm_report = "<?php echo $member['firm_report']; ?>"
        }else{
          var firm_report = "";
        }
        $.ajax({
          url:"<?php echo url('AjaxAction/mems'); ?>",
          data:{id:areaId,firm_report:firm_report},
          type:'post',
          success:function(data){
            $("#firm_report").html(data);
            form.render('select');
          }
        });
      });

      form.on('select(project_id)', function(data) {
        var areaId = data.value;
        $.ajax({
          url:"<?php echo url('AjaxAction/teamYewu'); ?>",
          data:{id:areaId},
          type:'post',
          success:function(data){
            $("#yewu").html(data);
            form.render('checkbox');
          }
        });
      });
      form.on('submit(add)', function(data){
        if (!data.field.role_id) {
          layer.msg('请分配权限',{icon:5,time:1000});
        }else{
          $.ajax({
              type:'POST',
              url:'<?php echo url("AjaxAction/editsectors"); ?>',
              data: {
                  data:JSON.stringify(data.field)
              },
              success:function (data) {
                  var status = JSON.parse(data);
                  if (status.icon == 6){
                      layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                          window.location.reload();
                      });
                  } else {
                      layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                          window.location.reload();
                      });
                  }
              }
          });
          return false;
        }
      });
    });
  </script>
</body>
</html>
