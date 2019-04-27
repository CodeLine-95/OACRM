<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/user/scoring.html";i:1552386215;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
    <div class="layui-form-item">
      <div class="layui-form-item layui-form-text">
        <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">员工信息</h3>
      </div>
      <label class="layui-form-label">员工工号：</label>
      <div class="layui-input-inline">
        <input type="text" style="border:none" value="<?php echo $user['staff_num']; ?>" name="staff_num" id="staff_num" disabled class="layui-input">
      </div>
      <label class="layui-form-label">员工姓名：</label>
      <div class="layui-input-inline">
        <input type="text" style="border:none" value="<?php echo $user['user_name']; ?>" name="staff_num" id="staff_num" disabled class="layui-input">
      </div>
      <label class="layui-form-label">身份证号：</label>
      <div class="layui-input-inline">
        <input type="text" style="border:none" value="<?php echo $user['staff_idcard']; ?>" name="staff_num" id="staff_num" disabled class="layui-input">
      </div>
      <div class="layui-form-item layui-form-text">
        <h3 style="text-align:center;width: 120px;height: 40px;line-height: 40px;margin: 0 auto;">本周分值计算</h3>
      </div>
      <div class="layui-form-item" style="height:60px;inline-height:60px;color:#ff0000;font-size:26px;text-align:center;">
        <span style="color:#ff0000;"><?php echo $inter_num; ?></span>分
      </div>
    </div>
    <div class="layui-tab layui-tab-brief">
      <div class="layui-form">
        <table class="layui-table">
          <thead>
            <tr>
              <th align="center">积分类型</th>
              <th align="center">分值</th>
              <th align="center">考核项目</th>
              <!-- <th align="center" style="width:100px;">次数</th> -->
              <!-- <th align="center" style="width:40px;">修改项目</th> -->
            </tr>
          </thead>
          <tbody>
            <?php foreach($integral as $l): ?>
              <tr>
                <td><?php echo $l['type']; ?></td>
                <td><?php echo $l['score']; ?></td>
                <td><?php echo $l['desc']; ?></td>
                <!-- <td>
                  <div style="font-size:20px;float:left;line-height:38px;cursor: pointer;" onclick="FN('minus','#num<?php echo $l['id']; ?>');">-</div>
                  <input type="text" name="num<?php echo $l['id']; ?>" value="0" id="num<?php echo $l['id']; ?>" class="layui-input" style="width:60px;float:left;margin:0 10px;"/>
                  <div style="font-size:20px;float:left;line-height:38px;cursor: pointer;" onclick="FN('plus','#num<?php echo $l['id']; ?>');">+</div>
                </td> -->
                <!-- <td><button class="layui-btn layui-btn-normal layui-btn-sm">修改项目</button></td> -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <script type="text/javascript">
      function FN(btnType,obj) {
        if (btnType == 'plus') {
          $(obj).attr('value',parseInt($(obj).val()) + 1)
        } else if (btnType == 'minus') {
          if(parseInt($(obj).val()) !== 0){
            $(obj).attr('value',parseInt($(obj).val()) - 1)
          }else{
            $(obj).attr('value',0)
          }
        }
      }
      </script>
    </div>
  </div>
</div>
<script>
</script>
</body>
</html>
