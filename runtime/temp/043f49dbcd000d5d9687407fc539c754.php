<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/user/sectors.html";i:1552128648;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
</style>
<style>
  .layui-form-label {
    float: left;
    display: block;
    padding: 9px 15px;
    width: 80px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
}
.layui-card-body {
    position: relative;
    padding: 10px 15px;
    line-height: 38px;
}
</style>
<style>
   /* 这段样式只是用于演示 */
   #component-anim .layui-card-body{padding: 15px;}

   #component-anim .component-anim-demo{margin-bottom: 50px; font-size: 0;}
   #component-anim .component-anim-demo li{display: inline;font-size: 14px; text-align: center;}
   #component-anim .component-anim-demo li .layui-icon{display: inline-block; font-size: 36px;}

   #component-anim .component-anim-demo li .fontclass{display: none;}
   #component-anim .component-anim-demo li .name{color: #c2c2c2;}
   #component-anim .component-anim-demo li:hover{background-color: #f2f2f2; color: #000;}

   #component-anim .component-anim-demo li{width: 222px;}
   #component-anim .component-anim-demo .layui-anim{width: 150px; height: 200px; line-height: 150px; margin: 0 auto 10px; text-align: center; background-color: #d2d2d2; cursor: pointer; color:red;}
 </style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">我的部门信息</div>
          <div class="layui-form layui-card-body layui-fluid" id="component-anim" pad15>
            <div class="layui-form-item layui-form-text">
              <h3 style="width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">部门信息</h3>
            </div>
            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">所属部门</label>
                <div class="layui-input-inline">
                  <?php echo $admin['sectors']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label">员工岗位</label>
                <div class="layui-input-inline">
                  <?php echo $admin['quarters']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label">入职时间</label>
                <div class="layui-input-inline">
                  <?php echo date('Y-m-d',$admin['firm_hiredate']); ?>
                </div>
              </div>
			      </div>
            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">负责城市</label>
                <div class="layui-input-inline">
                  <?php echo $admin['city']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">公司邮箱</label>
                <div class="layui-input-inline">
                  <?php echo $admin['firm_email']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">员工级别</label>
                <div class="layui-input-inline">
                  <?php if($admin['firm_rank'] == 1): ?> P1
                    <?php elseif($admin['firm_rank'] == 2): ?> P2
                    <?php elseif($admin['firm_rank'] == 3): ?> P3
                    <?php elseif($admin['firm_rank'] == 4): ?> P4
                    <?php elseif($admin['firm_rank'] == 5): ?> P5
                    <?php elseif($admin['firm_rank'] == 6): ?> P6
                    <?php elseif($admin['firm_rank'] == 7): ?> P7
                    <?php elseif($admin['firm_rank'] == 8): ?> P8
                    <?php elseif($admin['firm_rank'] == 9): ?> P9
                    <?php else: ?> 暂未评定
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">负责项目</label>
              <div class="layui-input-block">
                <?php foreach($admin['project'] as $p): ?>
                <?php echo $p['name']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">负责业务</label>
              <div class="layui-input-block">
                <?php foreach($admin['firm_business'] as $p): ?>
                <?php echo $p['name']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">汇报对象</h3>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">选择部门</label>
                <div class="layui-input-inline">
                  <?php echo $admin['sectors']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">选择对象</label>
                <div class="layui-input-inline">
                  <?php echo $admin['author']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">员工状态</h3>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">员工类型</label>
                <div class="layui-input-inline">
                  <?php if($admin['firm_type'] == 1): ?>
                  全职
                  <?php else: ?>
                  兼职
                  <?php endif; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">在职阶段</label>
                <div class="layui-input-inline">
                  <?php if($admin['firm_incumbency'] == 1): ?>实习期
                  <?php elseif($admin['firm_incumbency'] == 2): ?>试用期
                  <?php elseif($admin['firm_incumbency'] == 3): ?>已转正
                  <?php endif; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">员工状态</label>
                <div class="layui-input-inline">
                  <?php if($admin['staff_status'] == 1): ?>在职
                  <?php elseif($admin['staff_status'] == 2): ?>离职
                  <?php else: ?>休假
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">权限分配</h3>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">角色权限</label>
              <div class="layui-input-block">
                <?php echo $admin['role_name']; ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
