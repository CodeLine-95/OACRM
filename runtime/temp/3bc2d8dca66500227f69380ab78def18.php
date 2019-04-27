<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/operate/implement.html";i:1554262238;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">创建需求</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" wid100 lay-filter="">
              <?php if((!empty($cid))): ?>
              <input type="hidden" name="cid" value="<?php echo $cid; ?>">
              <?php endif; ?>
              <input type="hidden" name="uid" value="">
              <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                  <input type="text" name="title" value="" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">单选框</label>
                  <div class="layui-input-block">
                  <input type="radio" name="shlote" value="0" title="长期任务" checked>
                  <input type="radio" name="shlote" value="1" title="短期任务" >
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">需求内容</label>
                <div class="layui-input-block">
                 <textarea id="demo" style="display: none;"></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                  <input type="text" name="remarks" value="" class="layui-input">
                </div>
              </div>

          <div class="layui-form-item">
            <label class="layui-form-label" for="remarks">附件</label>
            <div class="layui-input-inline">
              <input type="text" name="enclosure" readonly class="layui-input layui-btn-disabled">
            </div>

            <div class="layui-input-inline">
              <button type="button" class="layui-btn" id="upload_file">上传</button>
            </div>
          </div>
                    <div class="layui-form-item">
                    <label class="layui-form-label" for="remarks">人员</label>
                    <div class="layui-input-inline">
                            <select class="layui-input" name="pid">
                              <?php if(is_array($username) || $username instanceof \think\Collection || $username instanceof \think\Paginator): $i = 0; $__LIST__ = $username;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['user_name']; ?>--职位:<?php echo $vo['homeoffice']; ?>--部门:<?php echo $vo['name']; ?></option>
                              <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                    </div>
                    </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="set_website">确认保存</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <script>
    layui.use(['form','element','laydate','upload','layedit'], function(){
      var form = layui.form,element = layui.element,laydate = layui.laydate,upload = layui.upload,layedit=layui.layedit;

      var  unexctl=layedit.build('demo',{tool: ['strong' //加粗
                    ,'italic' //斜体
                    ,'underline' //下划线
                    ,'del' //删除线
                    ,'|' //分割线
                    ,'left' //左对齐
                    ,'center' //居中对齐
                    ,'right' //右对齐
                    ,'link' //超链接
                    ,'unlink' //清除链接
                    ,'face' //表情
                  ]})

      //日期实例
      laydate.render({
        elem:"#backlog_time",
        type: 'datetime'
      })
      //上传实例
      upload.render({
        elem: '#upload_file',
        url: '<?php echo url("AjaxAction/uploadfile"); ?>',
        accept:"file",
        auto:true,
        size:102400,
        drag:false,
        before: function(obj) {
          layer.msg('附件上传中...', {icon: 16,shade: 0.01,time: 0})
        },
        done: function(res) {
            layer.close(layer.msg('上传附件成功！'));
            $('input[name=enclosure]').val(res.data);
        }
        ,error: function(){
            layer.msg('上传错误！');
        }
      });
      form.on('submit(set_website)', function(data){
        data.field.content = layedit.getContent(unexctl);
        $.ajax({
          type:'POST',
          url:'',
          data: {
            data:data.field
          },
          dataType:'json',
          success:function (data) {
            console.log(data)
            if(data['code']==200){
                layer.msg(data['msg']);
                window.parent.location.reload();
            }else{
               layer.msg(data['msg']);
               // window.parent.location.reload();
            }
            // if (status.icon == 6){
            //   layer.msg(status.msg,{icon: status.icon,time:1000},function(){
            //     window.parent.location.reload();
            //   });
            // } else {
            //   layer.msg(status.msg,{icon: status.icon,time:1000},function(){
            //     window.location.reload();
            // });
            // }
          }
        });
        return false;
      });
    });
  </script>
</body>
</html>
