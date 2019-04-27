<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/user/index.html";i:1552126263;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">我的基本信息</div>
          <div class="layui-form layui-card-body layui-fluid" id="component-anim" pad15>
            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_num">员工工号</label>
              <div class="layui-input-inline">
                <?php echo $admin['staff_num']; ?>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">个人信息</h3>
            </div>
            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="user_name">员工姓名</label>
                <div class="layui-input-inline">
                  <?php echo $admin['user_name']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_idcard">身份证号</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_idcard']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_tel">个人手机</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_tel']; ?>
                </div>
              </div>
			      </div>
            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_email">个人邮箱</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_email']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_wechat">个人微信</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_wechat']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_qq">个人QQ</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_qq']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_province">籍贯省份</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_province']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_email">大学专业</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_major']; ?>
                </div>
              </div>

              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="home_address">家乡地址</label>
                <div class="layui-input-block">
                  <?php echo $admin['home_address']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_school">毕业院校</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_school']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_wechat">文化程度</label>
                <div class="layui-input-inline">
                  <?php if($admin['staff_education'] == 1): ?> 博士 <?php endif; if($admin['staff_education'] == 2): ?> 硕士 <?php endif; if($admin['staff_education'] == 3): ?> 研究生 <?php endif; if($admin['staff_education'] == 4): ?> 本科 <?php endif; if($admin['staff_education'] == 5): ?> 大专 <?php endif; if($admin['staff_education'] == 6): ?> 中专 <?php endif; if($admin['staff_education'] == 7): ?> 高中 <?php endif; if($admin['staff_education'] == 8): ?> 初中 <?php endif; if($admin['staff_education'] == 9): ?> 小学 <?php endif; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label" for="staff_qq">现居地址</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_now_address']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label" for="user_introduce">个人介绍</label>
              <div class="layui-input-block">
                <?php echo $admin['user_introduce']; ?>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_qq">员工头像</label>
              <div class="layui-input-inline">
                <img src="<?php echo $admin['user_face']; ?>" alt="<?php echo $admin['user_name']; ?>">
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">紧急联系人</h3>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">人员姓名</label>
                <div class="layui-input-inline">
                  <?php echo $admin['exigency']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">人员关系</label>
                <div class="layui-input-inline">
                  <?php echo $admin['exigencyabout']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">紧急电话</label>
                <div class="layui-input-inline">
                  <?php echo $admin['exigencytel']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">联系地址</label>
                <div class="layui-input-inline">
                  <?php echo $admin['exigencyaddress']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">职业背景</h3>
            </div>

            <div class="layui-form-item">
              <div style="width:33%;float:left;">
                <label class="layui-form-label">上家公司</label>
                <div class="layui-input-inline">
                  <?php echo $admin['staff_before_firm']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">所属部门</label>
                <div class="layui-input-inline">
                  <?php echo $admin['sectors']; ?>
                </div>
              </div>
              <div style="width:33%;float:left;">
                <label class="layui-form-label">公司职位</label>
                <div class="layui-input-inline">
                  <?php echo $admin['quarters']; ?>
                </div>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">个人爱好</label>
              <div class="layui-input-block">
                <?php foreach($hobby as $h): ?>
                <span style="color:blue;"><?php echo $h; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">职业规划</h3>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">专业技能</label>
              <div class="layui-input-block">
                <?php foreach($staff_skills as $s): ?>
                <span style="color:blue;"><?php echo $s; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">发展方向</label>
              <div class="layui-input-block">
                <?php echo $admin['staff_direction']; ?>
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
              <h3 style="width: 90px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">电子附件</h3>
            </div>

            <div class="layui-form-item">
              <div style="width:25%;float:left;">
                <!-- <label class="layui-form-label">身份证正面</label> -->
                <div class="layui-input-inline">
                  <?php if($admin['frontcard'] == ''): ?>
                  <div class="">

                  </div>
                  <?php else: ?>
                  <img src="<?php echo $admin['frontcard']; ?>">
                  <?php endif; ?>
                </div>
              </div>
              <div style="width:25%;float:left;">
                <!-- <label class="layui-form-label">身份证反面</label> -->
                <div class="layui-input-inline">
                  <?php if($admin['versocard'] == ''): else: ?>
                  <img src="<?php echo $admin['versocard']; ?>">
                  <?php endif; ?>
                </div>
              </div>
              <div style="width:25%;float:left;">
                <!-- <label class="layui-form-label">毕业证书</label> -->
                <div class="layui-input-inline">
                  <?php if($admin['dimission'] == ''): else: ?>
                  <img src="<?php echo $admin['dimission']; ?>">
                  <?php endif; ?>
                </div>
              </div>
              <div style="width:25%;float:left;">
                <!-- <label class="layui-form-label">离职证明</label> -->
                <div class="layui-input-inline">
                  <?php if($admin['dimission'] == ''): else: ?>
                  <img src="<?php echo $admin['dimission']; ?>">
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
