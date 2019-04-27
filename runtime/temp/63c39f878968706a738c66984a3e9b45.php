<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/operate/createxionnum.html";i:1554262237;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <style>..layui-card{clear:both;}
.layui-card:last-child {
    margin-bottom: 0;
    clear: both;
}
#ispostup{position: relative;}
#ispostup span{position: absolute;right:0;top:0;cursor: pointer;background:#000;color:#fff;padding:5px;}
.layui-card{    border: solid 3px #f7bf03;}
</style>
  <!---->
  <div style="text-align: left;padding:20px;font-size:40px;background: #000;color:#fff">需求文档</div>
  <style>#user div{background:#eee;}</style>
 <div class="layui-fluid" id="user">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">需求内容</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" wid100 lay-filter="">
              <input type="hidden" name="uid" value="">
               <input type="hidden" name="pid" value="">
              <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                  <span class="layui-input" style="line-height:250%;"> <?php echo $vo['title']; ?></span>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">单选框</label>
                  <div class="layui-input-block">
                    <span class="layui-input" style="line-height:250%;"><?php echo $vo['shlote']==0?'长期任务':'短期任务'; ?></span>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">需求内容</label>
                <div class="layui-input-block" >
                <div style="border: solid 2px #f7bf03;padding:10px;border-radius:5px;"><?php echo $vo['content']; ?></div>
                
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                  <input type="text" name="remarks" disabled value="<?php echo $vo['remarks']; ?>" class="layui-input">
                </div>
              </div>

          <div class="layui-form-item">
            <label class="layui-form-label" for="remarks">附件</label>
              <div class="layui-input-inline">
                <input type="text" name="enclosure" readonly value="<?php echo $vo['enclosure']; ?>" class="layui-input layui-btn-disabled">
              </div>
            <div class="layui-input-inline">
              <a href="<?php echo $vo['enclosure']; ?>" class="layui-btn" download>下载</a>
            </div>
          </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                   <?php if((!$userid)): ?>
                  <button onclick="crm_admin_show('详情回复','<?php echo url('replyin',array('id'=>$vo['id'])); ?>')" class="layui-btn layui-btn-normal ">工作内容回复</button>
                  <?php else: ?>
                   <button onclick="autohidden('<?php echo url('replynot',array('id'=>$id)); ?>')" class="layui-btn layui-btn-danger ">结束任务</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!---->
<div style="text-align: left;padding:20px;font-size:40px;background: #000;color:#fff">回复报告列表</div>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
 <?php if(empty($replylist) || (($replylist instanceof \think\Collection || $replylist instanceof \think\Paginator ) && $replylist->isEmpty())): ?>

<div style="text-align: center;padding:100px;background:#eee;">暂无回复报告</div>
  <?php else: if(is_array($replylist) || $replylist instanceof \think\Collection || $replylist instanceof \think\Paginator): $i = 0; $__LIST__ = $replylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div style="padding:5px;background:#f7bf03;border-radius:5px 5px 0 0;"></div>
        <div class="layui-card">
          <div class="layui-card-header">回复列表™==><?php echo $vo['id']; ?></div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" wid100 lay-filter="">
              <input type="hidden" name="uid" value="">
               <input type="hidden" name="pid" value="">
               <div class="layui-form-item">
                <label class="layui-form-label">回复时间</label>
                <div class="layui-input-block">
                  <input type="text" name="remarks" disabled value="<?php echo date('Y-m-d H:i:s',$vo['intime']); ?>" class="layui-input">
                </div>
              </div>


              <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                  <span class="layui-input" style="line-height:250%;"> <?php echo $vo['title']; ?></span>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">任务类型</label>
                  <div class="layui-input-block">
                    <span class="layui-input" style="line-height:250%;"><?php echo $vo['shlote']==0?'长期任务':'短期任务'; ?></span>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">工作内容</label>
                <div class="layui-input-block" >
                <div style="border: solid 1px #eee;padding:10px;border-radius:5px;"> <?php echo $vo['content']; ?></div>
                
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                  <input type="text" name="remarks" disabled value="<?php echo $vo['remarks']; ?>" class="layui-input">
                </div>
              </div>

          <div class="layui-form-item">
            <label class="layui-form-label" for="remarks">附件</label>
              <div class="layui-input-inline"style="padding-left:30px;">
                <input type="text" name="enclosure" readonly value="<?php echo $vo['enclosure']; ?>" class="layui-input layui-btn-disabled">
              </div>
            <div class="layui-input-inline" >
              <a href="<?php echo $vo['enclosure']; ?>" class="layui-btn" download>下载</a>
            </div>
             <div class="layui-input-inline">
              <?php if(($vo['isadopt']==0)): if(($userid)): ?>
                 <button onclick="isadopt('<?php echo url('replyadopt'); ?>',{id:<?php echo $vo['id']; ?>,isadopt:1})" class="layui-btn layui-btn-normal ">通过</button>
                 <button onclick="noadopt('ispostup<?php echo $vo['id']; ?>')" class="layui-btn layui-btn-danger ">未通过</button> 
                 <?php endif; else: if(($vo['isadopt']==1)): ?>
                   <div class="layui-btn layui-btn-normal ">通过审核</div>
                   <?php else: ?>
                   <div class="layui-btn layui-btn-danger ">未通过审核</div>
  
                   <?php endif; endif; ?>
            </div>
          </div>
             <?php if(($vo['isadopt']==2)): ?>
                  
                      <div class="layui-form-item layui-form-text" style="clear:both;background:orangered;border-radius:10px;color:#fff;padding:10px;">
                      <label class="layui-form-label">未通过原因</label>
                      <div class="layui-input-block" >
                         <div style="border: solid 1px #fff;padding:10px;border-radius:5px;"> <?php echo $vo['reason']; ?></div>
                      </div>
                      </div>
                   <?php endif; ?>

 
         <div class="layui-form-item layui-form-text" style="display:none;" id="ispostup<?php echo $vo['id']; ?>" style="position: relative;">
                        <div class="layui-form">
                          <input type="hidden" name="id" value="<?php echo $vo['id']; ?>">
                          <input type="hidden" name="isadopt" value="2">
                          <div class="layui-form-item">
                            <label class="layui-form-label">回复内容</label>
                            <div class="layui-input-block">
                              <textarea class="layui-textarea" name="reason" style="height:300px;resize:none;"></textarea>
                            </div>
                          </div>
                          <div class="layui-form-item" style="padding-left:120px;">
                            <div class="layui-input-inline">
                              <button type="submit" lay-submit lay-filter="add<?php echo $vo['id']; ?>" class="layui-btn layui-btn-danger">确定</button>
                            </div>
                          </div>
                        </div>
  <script type="text/javascript">
                  function noadopt(obj) {
                    $('#' + obj).show();
                  }
                  layui.use(['form', 'element', 'laydate', 'upload', 'layedit'], function() {
                    var form = layui.form,
                      element = layui.element,
                      laydate = layui.laydate,
                      upload = layui.upload,
                      layedit = layui.layedit;
                    form.on('submit(add<?php echo $vo["id"]; ?>)', function(data) {
                      console.log(data.field);
                      $.ajax({
                        type: 'post',
                        url: "<?php echo url('replyadopt'); ?>",
                        data: data.field,
                        dataType:'json',
                        success: function(res) {
                          console.table(res)
                         //layer.msg(res['msg'])
                            //  layer.msg(status.msg, {
                            //   icon: status.icon,
                            //   time: 1000
                            // }, function() {
                            //  // window.parent.location.reload();
                            // });
                        
                          
                        }
                      });
                      return false;
                    });
                  });
                </script>







            </div>
          </div>
        </div>
      </div>
 <?php endforeach; endif; else: echo "" ;endif; ?>
<?php echo $replylist->render(); endif; ?>
    </div>
  </div>
   <script>

function autohidden(url,arr){
  $.ajax({
        url:url,
        type:'post',
        data:arr,
        dataType:'json',
        success:function(res){
        layer.msg(res['msg'])
        window.parent.location.reload();
        } 
      })

}
    function isadopt(url,arr){
       $('#ispostup').hide();
      $.ajax({
        url:url,
        type:'post',
        data:arr,
        dataType:'json',
        success:function(res){
        layer.msg(res['msg'])
        } 
      })
    }



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
      form.on('submit()', function(data){
        data.field.content = layedit.getContent(unexctl);
        $.ajax({
          type:'POST',
          url:'',
          data: {
            data:data.field
          },
          success:function (data) {
            var status = data;
            console.table(status);
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
