<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/cases/create.html";i:1555467165;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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

  <script src="/static/layuiadmin/layui_exts/city-picker/city-picker.data.js"></script>
  <link href="/static/layuiadmin/layui_exts/city-picker/city-picker.css" rel="stylesheet" />
</head>

<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">添加案例</div>
          <div class="layui-form layui-card-body">
            <div class="layui-form-item">
              <label class="layui-form-label" for="brand">品牌名称</label>
              <div class="layui-input-block">
                <input type="text" name="brand" id="brand" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="commpany">公司名称</label>
              <div class="layui-input-block">
                <input type="text" name="commpany" id="commpany" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="website">公司官网</label>
              <div class="layui-input-block">
                <input type="text" name="website" id="website" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="trade">所属行业</label>
              <div class="layui-input-block">
                <select class="layui-input" name="trade" id="trade">

                </select>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="citys">所属城市</label>
              <div class="layui-input-block">
                <input type="text" autocomplete="on" class="layui-input" id="city-picker" name="city-picker" readonly="readonly" data-toggle="city-picker" placeholder="请选择">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="entrance">参考入口</label>
              <div class="layui-input-block">
                <input type="text" name="entrance" id="entrance" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="description">公司简介</label>
              <div class="layui-input-block">
                <textarea name="description" id="description" style="display: none;" class="layui-textarea"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="brand_logo">品牌LOGO</label>
              <div class="layui-input-block">
                <div class="layui-col-md12">
                  <div class="layui-col-md11">
                    <input type="text" style="background-color:#ededed;" readonly name="brand_logo" class="layui-input" value="">
                  </div>
                  <div class="layui-col-md1">
                    <button type="button" style="width:100%;" id="brand_logo" class="layui-btn">
                      <i class="layui-icon">&#xe67c;</i>上传LOGO
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="service_id">服务类型</label>
              <div class="layui-input-block">
                <select class="layui-input" name="service_id" id="service_id">
                  <?php foreach($services as $s): ?>
                  <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="content">服务内容</label>
              <div class="layui-input-block">
                <textarea name="content" id="content" class="layui-textarea"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="symptom">售前症状</label>
              <div class="layui-input-block">
                <input type="text" name="symptom" id="symptom" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="title">案例标题</label>
              <div class="layui-input-block">
                <input type="text" name="title" id="title" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="effect">服务效果</label>
              <div class="layui-input-block">
                <input type="text" name="effect" id="effect" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-col-md12">
                <div class="layui-col-md6">
                  <label class="layui-form-label" for="cooperating_start">合作时间</label>
                  <div class="layui-input-block">
                    <input type="text" name="cooperating_start" id="cooperating_start" class="layui-input">
                  </div>
                </div>
                <div class="layui-col-md6">
                  <label class="layui-form-label" for="cooperating_end">结束时间</label>
                  <div class="layui-input-block">
                    <input type="text" name="cooperating_end" id="cooperating_end" class="layui-input">
                  </div>
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="cooperating">合作状态</label>
              <div class="layui-input-block">
                <select class="layui-input" name="cooperating" id="cooperating">
                  <option value="0">准备期</option>
                  <option value="1">合作中</option>
                  <option value="2">已完成</option>
                </select>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="type_id">案例类型</label>
              <div class="layui-input-block">
                <select class="layui-input" name="type_id" id="type_id">
                  <option value="0">自营案例</option>
                  <option value="1">行业案例</option>
                  <option value="2">其他案例</option>
                </select>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="remarks">备注说明</label>
              <div class="layui-input-block">
                <textarea name="remarks" id="remarks" class="layui-textarea"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="source">案例来源</label>
              <div class="layui-input-block">
                <input type="text" name="source" id="source" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="show">案例详情</label>
              <div class="layui-input-block">
                <textarea name="show" id="show" style="display: none;" class="layui-textarea"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="author">执行人员</label>
              <div class="layui-input-block">
                <input type="text" name="author" id="author" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="create">添加案例</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $.post("<?php echo url('ajax_action/industryaction'); ?>", {}, function(data) {
      $('#trade').html(data);
      layui.use(['form'], function() {
        var form = layui.form;
        form.render('select');
      });
    });
    layui.config({
      base: '/static/layuiadmin/layui_exts/' //静态资源所在路径
    }).extend({
      citypicker: 'city-picker/city-picker' // {/}的意思即代表采用自有路径，即不跟随 base 路径
    }).use(['citypicker'], function() {
      var $ = layui.$,
        cityPicker = layui.citypicker;
      var currentPicker = new cityPicker("#city-picker", {
        provincename: "provinceId",
        cityname: "cityId",
        districtname: "districtId",
        level: 'districtId', // 级别
      });
    });
    layui.use(['form', 'upload', 'layedit', 'laydate'], function() {
      var form = layui.form,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate;
      laydate.render({
        elem: '#cooperating_start',
        type: 'datetime'
      });
      laydate.render({
        elem: '#cooperating_end',
        type: 'datetime'
      });
      upload.render({
        elem: '#brand_logo',
        url: '<?php echo url("AjaxAction/upload"); ?>',
        accept: "images",
        acceptMime: 'image/*',
        exts: "jpg|png|gif|bmp|jpeg",
        auto: true,
        size: 51200,
        drag: false,
        before: function(obj) {
          layer.msg('图片上传中...', {
            icon: 16,
            shade: 0.01,
            time: 0
          })
        },
        done: function(res) {
          layer.close(layer.msg('上传成功！'));
          $('input[name=brand_logo]').val(res.data);
        },
        error: function() {
          layer.msg('上传错误！');
        }
      });
      //创建一个编辑器
      var description = layedit.build('description', {
        tool: [
          'strong' //加粗
          , 'italic' //斜体
          , 'underline' //下划线
          , 'del' //删除线
          , '|' //分割线
          , 'left' //左对齐
          , 'center' //居中对齐
          , 'right' //右对齐
          , 'link' //超链接
          , 'unlink' //清除链接
          , 'face' //表情
          // , 'image' //插入图片
          // , 'help' //帮助
        ]
      });
      //创建一个编辑器
      var show = layedit.build('show', {
        tool: [
          'strong' //加粗
          , 'italic' //斜体
          , 'underline' //下划线
          , 'del' //删除线
          , '|' //分割线
          , 'left' //左对齐
          , 'center' //居中对齐
          , 'right' //右对齐
          , 'link' //超链接
          , 'unlink' //清除链接
          , 'face' //表情
          // , 'image' //插入图片
          // , 'help' //帮助
        ]
      });;
      //提交
      form.on('submit(create)', function(data) {
        data.field.description = layedit.getContent(description);
        data.field.show = layedit.getContent(show);
        if(data.field.trade == 0){
          layer.msg('请选择行业！！', {
            icon: 5,
            time: 1000
          });
        }else{
          $.ajax({
            type: 'POST',
            url: '<?php echo url("create"); ?>',
            data: {
              data: JSON.stringify(data.field)
            },
            success: function(data) {
              var status = JSON.parse(data);
              if (status.icon == 6) {
                layer.msg(status.msg, {
                  icon: status.icon,
                  time: 1000
                }, function() {
                  // location.href = "<?php echo url('cases/index'); ?>";
                  window.parent.location.reload();
                });
              } else {
                layer.msg(status.msg, {
                  icon: status.icon,
                  time: 1000
                }, function() {
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
