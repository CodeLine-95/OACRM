<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/followup/index.html";i:1556343587;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;s:75:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/timeline.html";i:1550653092;}*/ ?>
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
  .layui-input-inline{
    padding: 7px 0px;
  }
  .layui-form-item .layui-input-inline{
    width: 15%;
  }
</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">客户详情</div>
          <div class="layui-form layui-card-body" pad15>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户信息</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="name">客户名称</label>
              <div class="layui-input-inline">
                <?php echo $client['name']; ?>
              </div>

              <label class="layui-form-label" for="sex">客户性别</label>
              <div class="layui-input-inline">
                <?php if($client['sex'] == 1): ?>
                男
                <?php else: ?>
                女
                <?php endif; ?>
              </div>

              <label class="layui-form-label" for="city">籍贯省份</label>
              <div class="layui-input-inline">
                <?php echo $client['city']; ?>
              </div>

              <label class="layui-form-label" for="phone">客户电话</label>
              <div class="layui-input-inline">
                <?php echo $client['phone']; ?>
              </div>
		        </div>
		        <div class="layui-form-item">
              <label class="layui-form-label" for="wechat">客户微信</label>
              <div class="layui-input-inline">
                <?php echo $client['wechat']; ?>
              </div>

              <label class="layui-form-label" for="qq">客户QQ</label>
              <div class="layui-input-inline">
                <?php echo $client['qq']; ?>
              </div>

              <label class="layui-form-label" for="type">客户类型</label>
              <div class="layui-input-inline">
                <?php switch($client['type']): case "1": ?>私企<?php break; case "2": ?>国企<?php break; case "3": ?>上市<?php break; case "4": ?>个人<?php break; case "5": ?>政府<?php break; endswitch; ?>
              </div>

              <label class="layui-form-label" for="email">客户邮箱</label>
              <div class="layui-input-inline">
                <?php echo $client['email']; ?>
              </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="quarters">岗位职称</label>
                <div class="layui-input-inline">
                  <?php echo $client['quarters']; ?>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">兴趣爱好</h3>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                <?php foreach($interests as $i): ?>
                  <?php echo $i; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">公司信息</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="sitename">公司名称</label>
              <div class="layui-input-inline">
                <?php echo $client['sitename']; ?>
              </div>

              <label class="layui-form-label" for="website">公司官网</label>
              <div class="layui-input-inline">
                <?php echo $client['website']; ?>
              </div>

              <label class="layui-form-label" for="siteaddress">公司地址</label>
              <div class="layui-input-inline">
                <?php echo $client['siteaddress']; ?>
              </div>

              <label class="layui-form-label" for="industry">所属行业</label>
              <div class="layui-input-inline">
                <?php switch($client['industry']): case "1": ?>互联网<?php break; case "2": ?>装修<?php break; case "3": ?>家具<?php break; endswitch; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="brand">主营业务</label>
              <div class="layui-input-inline">
                <?php echo $client['brand']; ?>
              </div>

              <label class="layui-form-label" for="busi">产品品牌</label>
              <div class="layui-input-inline">
                <?php echo $client['busi']; ?>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">需求信息</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="project_id">所属项目</label>
              <div class="layui-input-inline">
                <?php echo $client['project_id']; ?>
              </div>

              <label class="layui-form-label" for="staff_idcard">业务类型</label>
              <div class="layui-input-inline">
                <?php echo $client['business']; ?>
              </div>

              <label class="layui-form-label" for="staff_province">前期状态</label>
              <div class="layui-input-inline">
                <?php if($client['stage'] == 1): ?>
                有
                <?php else: ?>
                无
                <?php endif; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="service">选择服务</label>
              <div class="layui-input-inline" style="width:80%;">
                <?php foreach($service as $s): ?>
                <?php echo $s['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="budget">预算金额</label>
              <div class="layui-input-inline">
                <?php echo $client['budget']; ?>
              </div>

              <label class="layui-form-label" for="makemoney">成交金额</label>
              <div class="layui-input-inline">
                <?php echo $client['makemoney']; ?>
              </div>

              <label class="layui-form-label" for="moneystate">预算说明</label>
              <div class="layui-input-inline">
                <?php switch($client['moneystate']): case "1": ?>全款<?php break; case "2": ?>年付<?php break; case "3": ?>季付<?php break; case "4": ?>月付<?php break; case "5": ?>5:5<?php break; case "6": ?>5:2:3<?php break; endswitch; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="remark">备注说明</label>
              <div class="layui-input-block">
                <textarea name="remark" id="remark" class="layui-textarea" readonly style="resize: none;color:#666;"><?php echo $client['remark']; ?></textarea>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户来源</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="source">渠道</label>
              <div class="layui-input-inline">
                <?php echo $client['ditch_id']; ?>
              </div>
              <label class="layui-form-label" for="sourcelist">来源入口</label>
              <div class="layui-input-inline">
                <?php echo $client['source_id']; ?>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="sourcelist">咨询工具</label>
              <div class="layui-input-inline">
                <?php foreach($client['tools'] as $t): ?>
                  <?php echo $t['entry_name']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <h3 style="text-align:center;width: 80px;height: 40px;line-height: 40px;border-bottom: 2px solid #1E9FFF;margin: 0 auto;">客户状态</h3>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label" for="status">选择状态</label>
              <div class="layui-input-inline">
                <?php echo $client['schedule_name']; ?>
              </div>
            </div>
            <input type="hidden" id="xing" value="<?php echo $client['level']; ?>">
            <div class="layui-form-item">
              <label class="layui-form-label" for="staff_hobby">客户星级</label>
              <div class="layui-input-block">
                <div id="test4"></div>
              </div>
            </div>
          </div>
          <link rel="stylesheet" href="/static/admin/css/timeline.css">
<section id="cd-timeline" class="cd-container">
	<?php foreach($followups as $f): ?>
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-log">
			<i class="layui-icon" style="color:#fff;font-size: 26px;">&#xe60e;</i>
		</div>
		<div class="cd-timeline-content" style="background-color:#f2f2f2;">
			<p>状态：
				<span>
				<?php switch($f['client_status']): case "1": ?>未知数据<?php break; case "2": ?>潜在数据<?php break; case "3": ?>意向数据<?php break; case "4": ?>精准数据<?php break; case "5": ?>已派数据<?php break; case "6": ?>洽谈需求<?php break; case "7": ?>提交报价<?php break; case "8": ?>诊断方案<?php break; case "9": ?>竞标投标<?php break; case "10": ?>签订合同<?php break; case "11": ?>首付款项<?php break; case "12": ?>达成合作<?php break; case "13": ?>执行方案<?php break; case "14": ?>开始执行<?php break; case "15": ?>数据汇报<?php break; case "16": ?>完成合同<?php break; case "17": ?>催收尾款<?php break; case "18": ?>合作结案<?php break; endswitch; ?>
				</span>
			</p>
			<p>备注：<span><?php echo $f['remarks']; ?></span></p>
			<p>人员：<span><?php echo $f['user_name']; ?></span></p>
			<p>附件：
				<?php if($f['upload_file'] == ''): ?>
				<span>暂无</span>
				<?php else: ?>
				<span><a href="<?php echo $f['upload_file']; ?>" style="color:rgb(30, 159, 255);">下载</a></span>
				<?php endif; ?>
			</p>
			<p>待办：<span><?php echo $f['backlog']; ?></span></p>
			<span class="cd-date"><?php echo date('Y-m-d H:i:s',$f['create_t']); ?></span>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-btn">
			<button onclick="alert_open('继续跟进','<?php echo url('followup/add',array('id'=>$client['id'])); ?>')" class="layui-btn cd-btn layui-btn-sm">跟进</button>
		</div>
	</div>
</section>
<script type="text/javascript">
	function alert_open(title,url){
		layer.open({
			type: 2,
			area: ['800px', '400px'],
			fix: false, //不固定
			title: title,
			content: url,
		});
	}

</script>

        </div>
      </div>
    </div>
  </div>
  <div class="layui-fixbar" style="bottom:200px;">
    <li onclick="crm_show('<?php echo $client['name']; ?>-处理','<?php echo url('sales/handle',array('id'=>$client['id'])); ?>',2)" style="background-color:#1E9FFF;font-size: 16px;width:100px;">快速处理</li>
  </div>
  <script>
    function crm_show(title,text,type){
      layer.open({
        type: type,
        area: ['800px', '500px'],
        fix: false, //不固定
        title: title,
        content: text
      });
    }
    layui.use(['form','rate'], function(){
      var rate = layui.rate;
      //半星效果
      var xing = $("#xing").val();
      var xingval = "";
      if(xing=="0.5"){
        var xingval = 0.5;
      }
      if(xing=="1"){
        var xingval = 1;
      }
      if(xing=="1.5"){
        var xingval = 1.5;
      }
      if(xing=="2"){
        var xingval = 2;
      }
      if(xing=="2.5"){
        var xingval = 2.5;
      }
      if(xing=="3"){
        var xingval = 3;
      }
      if(xing=="3.5"){
        var xingval = 3.5;
      }
      if(xing=="4"){
        var xingval = 4;
      }
      if(xing=="4.5"){
        var xingval = 4.5;
      }
      if(xing=="5"){
        var xingval = 5;
      }
      if(xingval==false){
        var xingval = 5;
      };
      rate.render({
        elem: '#test4',value: xingval,half: true,text: false,readonly:true
      });
    });
  </script>
</body>
</html>
