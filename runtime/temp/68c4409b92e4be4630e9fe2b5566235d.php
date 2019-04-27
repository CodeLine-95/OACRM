<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/quarters/show.html";i:1552029674;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">岗位详情</div>
          <div class="layui-card-body" pad15>
            <div class="layui-form layui-card-body layui-fluid" id="component-anim" pad15>
                <div class="layui-form-item">
                  <label class="layui-form-label">岗位名称</label>
                  <div class="layui-input-inline">
                    <?php echo $qua['name']; ?>
                  </div>

                  <label class="layui-form-label">所属部门</label>
                  <div class="layui-input-inline">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if($qua['sectors_id'] == $vv['id']): ?> <?php echo $vv['name']; endif; endforeach; endif; else: echo "" ;endif; ?>
                  </div>

                  <label class="layui-form-label">负责项目</label>
                  <div class="layui-input-inline">
                    <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if($qua['project_id'] == $vv['id']): ?> <?php echo $vv['name']; endif; endforeach; endif; else: echo "" ;endif; ?>
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label" for="type">岗位类型</label>
                  <div class="layui-input-inline">
                    <?php if($qua['type'] == 1): ?> 全职 <?php endif; if($qua['type'] == 0): ?> 兼职 <?php endif; if($qua['type'] == 2): ?> 实习生 <?php endif; ?>
                  </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <label class="layui-form-label">岗位职责</label>
                  <div class="layui-input-block">
                    <?php echo $qua['desc']; ?>
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
