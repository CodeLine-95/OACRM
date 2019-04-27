<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/notice/noticeall.html";i:1554964007;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
    .layui-table tbody tr:hover {
      background-color: #fff;
    }

    .layui-form-select {
      width: 100px;
    }
  </style>
</head>

<body>
  <div class="layui-fluid" class="layui-form">
    <div class="layui-card">
      <div class="layui-row layui-col-space5">
        <?php if(empty($noticeall) || (($noticeall instanceof \think\Collection || $noticeall instanceof \think\Paginator ) && $noticeall->isEmpty())): ?>
        <div class="layui-col-md12" style="border-bottom:1px solid #eeeeee;text-align:center;padding: 10px;line-height:40px;">
          暂无待办消息
        </div>
        <?php else: foreach($noticeall as $s): ?>
        <div class="layui-col-md12" style="border-bottom:1px solid #eeeeee;">
          <div class="layui-col-md1" style="text-align: right;line-height:60px;">
            <?php if($s['read_id'] != 1): ?>
            <cite><span class="layui-badge-dot"></span></cite>
            <?php endif; ?>
            <i class="layui-icon layui-icon-notice"></i>
            <?php if($s['typeid'] == 2): ?>
            【派单消息】
            <?php elseif($s['typeid'] == 3): ?>
            【待办消息】
            <?php elseif($s['typeid'] == 1): ?>
            【系统消息】
            <?php endif; ?>
          </div>
          <div class="layui-col-md11">
            <div class="layui-col-md6" style="padding: 10px;line-height:40px;text-align: left;">
              <?php if($s['typeid'] == 2): ?><?php echo str_replace('给您','给(<span style="color:#1E9FFF">'.$s['user_name'].'</span>)',$s['title']); else: ?><?php echo $s['title']; endif; ?>
            </div>
            <div class="layui-col-md4" style="padding: 10px;line-height:40px;text-align: center;">
              <?php if($s['read_id'] == 1): ?>
              <a href="javascript:void(0)" onclick="content('<?php echo $s['title']; ?>','<?php echo $s['content']; ?>','<?php echo $s['id']; ?>')" style="color:#1E9FFF;">查看</a><span>&nbsp;&nbsp;&nbsp;[&nbsp;已读&nbsp;]</span>
              <?php else: ?>
              <a href="javascript:void(0)" onclick="content('<?php echo $s['title']; ?>','<?php echo $s['content']; ?>','<?php echo $s['id']; ?>')" style="color:#1E9FFF;">查看</a><span style="color:red;">&nbsp;&nbsp;&nbsp;[&nbsp;未读&nbsp;]</span>
              <?php endif; ?>
            </div>
            <div class="layui-col-md2" style="padding: 10px;line-height:40px;text-align: center;">
              <?php echo date('Y-m-d H:i:s',$s['create_t']); ?>
            </div>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
    <script type="text/javascript">
      function content(obj, url, id) {
        $.post("<?php echo url('AjaxAction/noticestatus'); ?>", {
          id: id
        }, function(data) {
          layer.open({
            type: 0,
            btn: false,
            area: ['500px', '300px'],
            shadeClose: true, //开启遮罩关闭
            content: '</br>&nbsp;&nbsp;&nbsp;' + url,
            cancel: function(index, layero) {
              layer.close(index);
              location.reload();
            }
          });
        });
      }
    </script>
  </div>
</body>

</html>
