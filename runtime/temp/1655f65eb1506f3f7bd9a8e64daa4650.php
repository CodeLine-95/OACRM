<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/sectors/update.html";i:1552027359;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">编辑部门</div>
          <div class="layui-card-body" pad15>
            <div class="layui-form">
              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                <input type="text" name="name" value="<?php echo $sec['name']; ?>" class="layui-input">
                </div>

                <label class="layui-form-label">负责城市</label>
                <div class="layui-input-inline">
                  <select name="city">
                    <option value="0" <?php if($sec['city'] == 0): ?> selected <?php endif; ?>>全国</option>
                  <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vv['id']; ?>" <?php if($sec['city'] == $vv['id']): ?> selected <?php endif; ?>><?php echo $vv['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $sec['id']; ?>">

              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">负责项目</label>
                <div class="layui-input-block">
                  <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" <?php if(in_array(($vv['id']), is_array($sec['projects'])?$sec['projects']:explode(',',$sec['projects']))): ?>checked<?php endif; ?> name="projects" lay-filter="filter" title="<?php echo $vv['name']; ?>" value="<?php echo $vv['id']; ?>">
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
              </div>
              <input type="hidden" name="business" value="<?php echo $sec['business']; ?>">
              <div class="layui-form-item">
                <label class="layui-form-label" for="business">负责业务</label>
                <div class="layui-input-block" id="business">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">部门负责人</label>
                <div class="layui-input-inline">
                <input type="text" name="author" value="<?php echo $sec['author']; ?>" class="layui-input">
                </div>

                <label class="layui-form-label">负责人电话</label>
                <div class="layui-input-inline">
                <input type="text" name="tel" value="<?php echo $sec['tel']; ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">备注说明</label>
                <div class="layui-input-block">
                  <textarea name="desc" class="layui-textarea" style="resize: none;"><?php echo $sec['desc']; ?></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">部门状态</label>
                <div class="layui-input-block">
                  <input type="radio" name="status" value="1" title="开启" <?php if($sec['status'] == 1): ?> checked="" <?php endif; ?> >
                  <input type="radio" name="status" value="0" title="关闭" <?php if($sec['status'] == 0): ?> checked="" <?php endif; ?>>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="set_website">提交</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    //数组删除某一项元素
    Array.prototype.remove = function(val) {
      var index = this.indexOf(val);
      if (index > -1) {
        this.splice(index, 1);
      }
    };
    function checkedItem(name){
      var arr = new Array();
      $("input:checkbox[name="+name+"]:checked").each(function(i){
         arr[i] = $(this).val();
       });
       return arr.join(",");//将数组合并成字符串
    }
    //页面加载获取的业务
    var checkedStr = checkedItem('projects');
    var business_id = $('input[name=business]').val();
    $.post("<?php echo url('AjaxAction/yewuall'); ?>",{project_id:checkedStr,business_id:business_id},function(data){
      $('#business').html(data);
      layui.use(['form','element'], function(){
        var form = layui.form;
        element = layui.element;
        form.render('checkbox');
      });
    });
    layui.use(['form','element'], function(){
      var form = layui.form;
      element = layui.element;
      var arr = [];
      //监听checkbox
      form.on('checkbox(filter)',function(data){
        if (data.elem.checked === true) {
          arr.push(data.elem.value);
        }else{
          arr.remove(data.elem.value);
        }
        var project_ids = arr.join(",");
        $.post("<?php echo url('AjaxAction/yewuall'); ?>",{project_id:project_ids},function(data){
          $('#business').html(data);
          form.render('checkbox');
        });
      });
      form.on('submit(set_website)', function(data){
        data.field.projects = checkedItem('projects');
        data.field.business = checkedItem('business');
        $.ajax({
            type:'POST',
            url:'<?php echo url("sectors/update"); ?>',
            data: {
                data:JSON.stringify(data.field)
            },
            success:function (data) {
                var status = JSON.parse(data);
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
