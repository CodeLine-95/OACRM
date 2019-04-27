<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/cases/show.html";i:1555396039;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
    #component-anim .layui-card-body {
      padding: 15px;
    }

    #component-anim .component-anim-demo {
      margin-bottom: 50px;
      font-size: 0;
    }

    #component-anim .component-anim-demo li {
      display: inline;
      font-size: 14px;
      text-align: center;
    }

    #component-anim .component-anim-demo li .layui-icon {
      display: inline-block;
      font-size: 36px;
    }

    #component-anim .component-anim-demo li .fontclass {
      display: none;
    }

    #component-anim .component-anim-demo li .name {
      color: #c2c2c2;
    }

    #component-anim .component-anim-demo li:hover {
      background-color: #f2f2f2;
      color: #000;
    }

    #component-anim .component-anim-demo li {
      width: 222px;
    }

    #component-anim .component-anim-demo .layui-anim {
      width: 150px;
      height: 200px;
      line-height: 150px;
      margin: 0 auto 10px;
      text-align: center;
      background-color: #d2d2d2;
      cursor: pointer;
      color: red;
    }
  </style>
</head>

<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">案例详情</div>
          <div class="layui-form layui-card-body">
            <div class="layui-form-item">
              <input type="hidden" name="id" value="<?php echo $field['id']; ?>">
              <label class="layui-form-label" for="brand">品牌名称</label>
              <div class="layui-input-block">
                <?php echo $field['brand']; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="commpany">公司名称</label>
              <div class="layui-input-block">
                <?php echo $field['commpany']; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="website">公司官网</label>
              <div class="layui-input-block">
                <?php echo $field['website']; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="trade">所属行业</label>
              <div class="layui-input-block">
                <?php echo $field['trade']; ?>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="citys">所属城市</label>
                <div class="layui-input-block">
                  <?php echo $field['citys']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="entrance">参考入口</label>
                <div class="layui-input-block">
                  <?php echo $field['entrance']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="description">公司简介</label>
                <div class="layui-input-block">
                  <?php echo $field['description']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="brand_logo">品牌LOGO</label>
                <div class="layui-input-block">
                  <div class="layui-col-md12">
                    <img src="<?php echo $field['brand_logo']; ?>" alt="<?php echo $field['commpany']; ?>" style="max-width:100px;">
                  </div>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="service_id">服务类型</label>
                <div class="layui-input-block">
                  <?php echo $field['business']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="content">服务内容</label>
                <div class="layui-input-block">
                  <?php echo $field['content']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="symptom">售前症状</label>
                <div class="layui-input-block">
                  <?php echo $field['symptom']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="title">案例标题</label>
                <div class="layui-input-block">
                  <?php echo $field['title']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="effect">服务效果</label>
                <div class="layui-input-block">
                  <?php echo $field['effect']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="cooperating_start">合作时间</label>
                <div class="layui-input-block">
                  <?php echo date('Y-m-d H:i:s',$field['cooperating_start']); ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="cooperating_end">结束时间</label>
                <div class="layui-input-block">
                  <?php echo date('Y-m-d H:i:s',$field['cooperating_end']); ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="cooperating">合作状态</label>
                <div class="layui-input-block">
                  <?php if($field['cooperating'] == 0): ?>准备期<?php endif; if($field['cooperating'] == 1): ?>合作中<?php endif; if($field['cooperating'] == 2): ?>已完成<?php endif; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="type_id">案例类型</label>
                <div class="layui-input-block">
                  <?php if($field['cooperating'] == 0): ?>自营案例<?php endif; if($field['cooperating'] == 1): ?>行业案例<?php endif; if($field['cooperating'] == 2): ?>其他案例<?php endif; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="remarks">备注说明</label>
                <div class="layui-input-block">
                  <?php echo $field['remarks']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="source">案例来源</label>
                <div class="layui-input-block">
                  <?php echo $field['source']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="show">案例详情</label>
                <div class="layui-input-block">
                  <?php echo $field['show']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="author">执行人员</label>
                <div class="layui-input-block">
                  <?php echo $field['author']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="author">添加人员</label>
                <div class="layui-input-block">
                  <?php echo $field['user_name']; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="author">创建时间</label>
                <div class="layui-input-block">
                  <?php echo date('Y-m-d H:i:s',$field['create_t']); ?>
                </div>
              </div>
              <!-- <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="edit">修改案例</button>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script type="text/javascript">
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
        var editIndex = layedit.build('show', {
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
        //提交
        form.on('submit(edit)', function(data) {
          data.field.show = layedit.getContent(editIndex);
          $.ajax({
            type: 'POST',
            url: '<?php echo url("edit"); ?>',
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
                  location.href = "<?php echo url('cases/index'); ?>";
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
        });
      });
    </script> -->
</body>

</html>
