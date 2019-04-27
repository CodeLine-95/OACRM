<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/team/user.html";i:1553077065;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
.layui-form-select,.layui-input{
 width: 100px;
}
.layui-form-item .layui-input-inline{
 width: auto;
}
</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">个人信息</div>
          <div class="layui-form layui-card-body" pad15>
              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_num">工号</label>
                <div class="layui-input-inline">
                  <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                  <input type="text" style="background-color:#dcdcdc;" value="<?php echo $admin['staff_num']; ?>" name="staff_num" id="staff_num" readonly class="layui-input">
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">个人信息</h3>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" for="user_name">姓名</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_name" id="user_name" lay-verify="required" value="<?php echo $admin['user_name']; ?>"  class="layui-input">
                </div>

                <label class="layui-form-label" for="staff_idcard">身份证号</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_idcard" id="staff_idcard" lay-verify="required" value="<?php echo $admin['staff_idcard']; ?>" class="layui-input">
                </div>

                <label class="layui-form-label" for="staff_province">籍贯省份</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_province" id="staff_province" value="<?php echo $admin['staff_province']; ?>" class="layui-input">
                </div>
				      </div>
				      <div class="layui-form-item">
                <label class="layui-form-label" for="home_address">家乡地址</label>
                <div class="layui-input-block">
                  <input type="text" name="home_address" id="home_address" value="<?php echo $admin['home_address']; ?>" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-input-block" style="width:20%;float:left;margin-left:0;">
                  <label class="layui-form-label">性别</label>
                  <div class="layui-input-block">
                    <input type="radio" name="staff_sex" value="0" title="男" <?php if($admin['staff_sex'] == 0): ?>checked<?php endif; ?>>
                    <input type="radio" name="staff_sex" value="1" title="女" <?php if($admin['staff_sex'] == 1): ?>checked<?php endif; ?>>
                  </div>
                </div>
                <div class="layui-input-block" style="float:left;width:70%;">
                  <label class="layui-form-label" for="user_face">头像</label>
                  <div class="layui-input-block">
                    <button type="button" style="float:left;margin-right:1%;" id="user_face" class="layui-btn"><i class="layui-icon">&#xe67c;</i>上传头像</button>
                    <input type="text" style="width:53%;float:left;background-color:#dcdcdc;" readonly name="user_face" id="user_face" class="layui-input" value="<?php echo $admin['user_face']; ?>">
                  </div>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_tel">个人手机</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_tel" id="staff_tel" value="<?php echo $admin['staff_tel']; ?>" class="layui-input">
                </div>

                <label class="layui-form-label" for="staff_wechat">个人微信</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_wechat" id="staff_wechat" value="<?php echo $admin['staff_wechat']; ?>" class="layui-input">
                </div>

                <label class="layui-form-label" for="staff_email">个人邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_email" id="staff_email" value="<?php echo $admin['staff_email']; ?>" class="layui-input">
                </div>
                <label class="layui-form-label" for="staff_qq">个人QQ</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_qq" id="staff_qq" value="<?php echo $admin['staff_qq']; ?>" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_school">毕业院校</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_school" id="staff_school" value="<?php echo $admin['staff_school']; ?>" class="layui-input">
                </div>
    				    <label class="layui-form-label" for="staff_email">大学专业</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_major" id="staff_major" value="<?php echo $admin['staff_major']; ?>" class="layui-input">
                </div>
                <label class="layui-form-label" for="staff_before_firm">上家公司</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_before_firm" id="staff_before_firm" value="<?php echo $admin['staff_before_firm']; ?>" class="layui-input">
                </div>
                <label class="layui-form-label" for="homeoffice">上家职位</label>
                <div class="layui-input-inline">
                  <input type="text" name="homeoffice" id="homeoffice" value="<?php echo $admin['homeoffice']; ?>" class="layui-input">
                </div>
              </div>
			        <div class="layui-form-item">
                <label class="layui-form-label" for="staff_wechat">学历</label>
                <div class="layui-input-inline">
                  <select class="layui-input" name="staff_education">
                    <option value="1" <?php if($admin['staff_education'] == 1): ?> selected <?php endif; ?>>博士</option>
                    <option value="2" <?php if($admin['staff_education'] == 2): ?> selected <?php endif; ?>>硕士</option>
                    <option value="3" <?php if($admin['staff_education'] == 3): ?> selected <?php endif; ?>>研究生</option>
                    <option value="4" <?php if($admin['staff_education'] == 4): ?> selected <?php endif; ?>>本科</option>
                    <option value="5" <?php if($admin['staff_education'] == 5): ?> selected <?php endif; ?>>大专</option>
                    <option value="6" <?php if($admin['staff_education'] == 6): ?> selected <?php endif; ?>>中专</option>
                    <option value="7" <?php if($admin['staff_education'] == 7): ?> selected <?php endif; ?>>高中</option>
                    <option value="8" <?php if($admin['staff_education'] == 8): ?> selected <?php endif; ?>>初中</option>
                    <option value="9" <?php if($admin['staff_education'] == 9): ?> selected <?php endif; ?>>小学</option>
                  </select>
                </div>


                <label class="layui-form-label" for="staff_qq">现居地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="staff_now_address" value="<?php echo $admin['staff_now_address']; ?>" id="staff_now_address" class="layui-input">
                </div>

                <label class="layui-form-label" for="staff_wechat">状态</label>
                <div class="layui-input-inline">
                  <select class="layui-input" name="firm_type">
                    <option value="1"  <?php if($admin['firm_type'] == 1): ?> selected <?php endif; ?>>全职</option>
                    <option value="2"  <?php if($admin['firm_type'] != 1): ?> selected <?php endif; ?>>兼职</option>
                  </select>
                </div>
			        </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_introduce">个人介绍</label>
                <div class="layui-input-block">
                  <textarea name="user_introduce" id="user_introduce" class="layui-textarea"><?php echo $admin['user_introduce']; ?></textarea>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">兴趣爱好</h3>
              </div>
               <div class="layui-form-item">
                <label class="layui-form-label" for="staff_hobby">选择兴趣</label>
                <div class="layui-input-block">
                  <input type="checkbox" name="staff_hobby[]" value="旅游" title="旅游" <?php if(in_array('旅游',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="阅读" title="阅读"  <?php if(in_array('阅读',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="电影" title="电影" <?php if(in_array('电影',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="聚会" title="聚会" <?php if(in_array('聚会',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="唱歌" title="唱歌" <?php if(in_array('唱歌',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="交友" title="交友" <?php if(in_array('交友',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="摄影" title="摄影" <?php if(in_array('摄影',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="球类" title="球类" <?php if(in_array('球类',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="逛街" title="逛街" <?php if(in_array('逛街',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="爬山" title="爬山" <?php if(in_array('爬山',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="宅家" title="宅家" <?php if(in_array('宅家',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="下棋" title="下棋" <?php if(in_array('下棋',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="书画" title="书画" <?php if(in_array('书画',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="荣誉" title="荣誉" <?php if(in_array('荣誉',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="面子" title="面子" <?php if(in_array('面子',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="喝酒" title="喝酒" <?php if(in_array('喝酒',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="喝茶" title="喝茶" <?php if(in_array('喝茶',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="吃货" title="吃货" <?php if(in_array('吃货',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="运动" title="运动" <?php if(in_array('运动',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="美容" title="美容" <?php if(in_array('美容',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="钱财" title="钱财" <?php if(in_array('钱财',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="美女" title="美女" <?php if(in_array('美女',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="收藏" title="收藏" <?php if(in_array('收藏',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="集邮" title="集邮" <?php if(in_array('集邮',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="游戏" title="游戏" <?php if(in_array('游戏',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="瑜伽" title="瑜伽" <?php if(in_array('瑜伽',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="舞蹈" title="舞蹈" <?php if(in_array('舞蹈',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="跑步" title="跑步" <?php if(in_array('跑步',$staff_hobby) == true): ?> checked <?php endif; ?>>
                  <input type="checkbox" name="staff_hobby[]" value="武术" title="武术" <?php if(in_array('武术',$staff_hobby) == true): ?> checked <?php endif; ?>>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">职业规划</h3>
              </div>
              <div class="layui-form-item">
          			<label class="layui-form-label" for="tags">擅长技能</label>
          			<div class="layui-input-block tags" id="tags">
                  <?php if(is_array($staff_skills) || $staff_skills instanceof \think\Collection || $staff_skills instanceof \think\Paginator): $i = 0; $__LIST__ = $staff_skills;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                  <span><em><?php echo $vv; ?></em><button type='button' class='close'>×</button></span>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
          				<input type="text" id="inputTags" class="layui-input" placeholder="回车生成技能标签" autocomplete="off" value="">
          				<input type="hidden" name="staff_skills" value="<?php echo $staff_skills2; ?>">
          			</div>
          		</div>
              <div class="layui-form-item">
          			<label class="layui-form-label" for="staff_direction">发展方向</label>
          			<div class="layui-input-block">
          				<textarea name="staff_direction" id="staff_direction" class="layui-textarea"><?php echo $admin['staff_direction']; ?></textarea>
          			</div>
          		</div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                    <label class="layui-form-label"><button class="layui-btn" lay-submit lay-filter="add">编辑个人信息</button></label>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    layui.config({
      base: '/static/layuiadmin/layui_exts/' //配置 layui 第三方扩展组件存放的基础目录
    }).extend({
        regionSelect: 'inputTags'
    }).use(['inputTags'],function () {
        $ = layui.jquery;
        var inputTags = layui.inputTags;
        var staff_skills = '';
        inputTags.render({
            elem:'#inputTags',//定义输入框input对象
            aldaBtn: true,//是否开启获取所有数据的按钮
            done: function(value){ //回车后的回调
                staff_skills = "<?php echo $staff_skills2; ?>"+value;
                $('input[name=staff_skills]').val(staff_skills);
            }
        });
    });
    layui.use(['form','upload'], function(){
      var form = layui.form,upload = layui.upload;
      //多图上传实例
      upload.render({
        elem: '#user_face',
        url: '<?php echo url("AjaxAction/upload"); ?>',
        accept:"images",
        acceptMime: 'image/*',
        exts:"jpg|png|gif|bmp|jpeg",
        auto:true,
        size:51200,
        drag:false,
        before: function(obj) {
          layer.msg('图片上传中...', {icon: 16,shade: 0.01,time: 0})
        },
        done: function(res) {
            layer.close(layer.msg('上传成功！'));
            $('input[name=user_face]').val(res.data);
            $('input[name=user_face]').css({'display':'block'});
        }
        ,error: function(){
            layer.msg('上传错误！');
        }
      });
          form.verify({
             staff_tel: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！']
            ,staff_email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']
            ,staff_idcard: [/(^\d{15}$)|(^\d{17}(x|X|\d)$)/, '身份证号码不正确']
          });
      form.on('submit(add)', function(data){
        $.ajax({
            type:'POST',
            url:'<?php echo url("team/user"); ?>',
            data: {
                data:JSON.stringify(data.field)
            },
            success:function (data) {
                var status = JSON.parse(data);
                if (status.icon == 6){
                    layer.msg(status.msg,{icon: status.icon,time:1000},function(){
                        window.location.reload();
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
