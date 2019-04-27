<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/guanjia.jutui.org/public/../application/admin/view/medium/show.html";i:1553079456;s:72:"/home/wwwroot/guanjia.jutui.org/application/admin/view/public/title.html";i:1551945361;}*/ ?>
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
          <div class="layui-card-header">供应商详情</div>
          <div class="layui-card-body" pad15>
            <div class="layui-form">
              <div class="layui-form-item layui-form-text">
                <h2>供应商服务</h2>
              </div>

              <div class="layui-form-item">
                  <label class="layui-form-label">业务类型</label>
                  <div class="layui-input-block">
                    <?php if(is_array($typelist) || $typelist instanceof \think\Collection || $typelist instanceof \think\Paginator): $i = 0; $__LIST__ = $typelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if(in_array($vv['id'],$type_one) == true): ?><?php echo $vv['typename']; endif; endforeach; endif; else: echo "" ;endif; ?>
                  </div>
              </div>

               <div class="layui-form-item">
                <label class="layui-form-label">业务标签</label>
                <div class="layui-input-block" id="html">
                </div>
               </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="market_quotes">市场报价</label>
                <div class="layui-input-inline">
                  <?php echo $field['market_quotes']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_quotes">公司报价</label>
                <div class="layui-input-inline">
                  <?php echo $field['commpany_quotes']; ?>
                  <!-- <input type="text" name="commpany_quotes" value="<?php echo $field['commpany_quotes']; ?>" id="commpany_quotes" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                  <label class="layui-form-label" for="effect_promise">效果承诺</label>
                  <div class="layui-input-block">
                    <?php echo $field['effect_promise']; ?>
                  </div>
                </div>

              <div class="layui-form-item">
                <label class="layui-form-label">公司性质</label>
                <div class="layui-input-block">
                  <?php if($field['nature'] == 1): ?>公司<?php endif; if($field['nature'] == 2): ?>个人<?php endif; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">对接人信息</h2>
              </div>
              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;">第一联系人</h3>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_name">联系人姓名</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_name" value="<?php echo $field['user_name']; ?>" id="user_name" class="layui-input"> -->
                  <?php echo $field['user_name']; ?>
                </div>

                <label class="layui-form-label" for="identity_card">身份证</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="identity_card" value="<?php echo $field['identity_card']; ?>" id="identity_card" class="layui-input"> -->
                  <?php echo $field['identity_card']; ?>
                </div>

                <label class="layui-form-label" for="user_tel">联系人电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_tel" value="<?php echo $field['user_tel']; ?>" id="user_tel" class="layui-input"> -->
                  <?php echo $field['user_tel']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_landline">座机电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_landline" value="<?php echo $field['user_landline']; ?>" id="user_landline" class="layui-input"> -->
                  <?php echo $field['user_landline']; ?>
                </div>

                <label class="layui-form-label" for="user_wechat">联系人微信</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_wechat" value="<?php echo $field['user_wechat']; ?>" id="user_wechat" class="layui-input"> -->
                  <?php echo $field['user_wechat']; ?>
                </div>

                <label class="layui-form-label" for="user_qq">联系人QQ</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_qq" value="<?php echo $field['user_qq']; ?>" id="user_qq" class="layui-input"> -->
                  <?php echo $field['user_qq']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_email">联系人邮箱</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_email" value="<?php echo $field['user_email']; ?>" id="user_email" class="layui-input"> -->
                  <?php echo $field['user_email']; ?>
                </div>

                <label class="layui-form-label" for="user_commpany">所在公司</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_commpany" value="<?php echo $field['user_commpany']; ?>" id="user_commpany" class="layui-input"> -->
                  <?php echo $field['user_commpany']; ?>
                </div>

                <label class="layui-form-label" for="user_sectors">所在部门</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_sectors" value="<?php echo $field['user_sectors']; ?>" id="user_sectors" class="layui-input"> -->
                  <?php echo $field['user_sectors']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_quarters">岗位职称</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_quarters" value="<?php echo $field['user_quarters']; ?>" id="user_quarters" class="layui-input"> -->
                  <?php echo $field['user_quarters']; ?>
                </div>

                <label class="layui-form-label" for="user_province">所在省份</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_province" value="<?php echo $field['user_province']; ?>" id="user_province" class="layui-input"> -->
                  <?php echo $field['user_province']; ?>
                </div>

                <label class="layui-form-label" for="user_city">所在城市</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_city" value="<?php echo $field['user_city']; ?>" id="user_city" class="layui-input"> -->
                  <?php echo $field['user_city']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_address">所在地址</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_address" value="<?php echo $field['user_address']; ?>" id="user_address" class="layui-input"> -->
                  <?php echo $field['user_address']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;">预备联系人</h3>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_name">联系人姓名</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_name" value="<?php echo $field['user_two_name']; ?>" id="user_two_name" class="layui-input"> -->
                  <?php echo $field['user_two_name']; ?>
                </div>

                <label class="layui-form-label" for="user_two_card">身份证</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_card" value="<?php echo $field['user_two_card']; ?>" id="user_two_card" class="layui-input"> -->
                  <?php echo $field['user_two_card']; ?>
                </div>

                <label class="layui-form-label" for="user_two_tel">联系人电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_tel" value="<?php echo $field['user_two_tel']; ?>" id="user_two_tel" class="layui-input"> -->
                  <?php echo $field['user_two_tel']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_landline">座机电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_landline" value="<?php echo $field['user_two_landline']; ?>" id="user_two_landline" class="layui-input"> -->
                  <?php echo $field['user_two_landline']; ?>
                </div>

                <label class="layui-form-label" for="user_two_wechat">联系人微信</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_wechat" value="<?php echo $field['user_two_wechat']; ?>" id="user_two_wechat" class="layui-input"> -->
                  <?php echo $field['user_two_wechat']; ?>
                </div>

                <label class="layui-form-label" for="user_two_qq">联系人QQ</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_qq" value="<?php echo $field['user_two_qq']; ?>" id="user_two_qq" class="layui-input"> -->
                  <?php echo $field['user_two_qq']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_email">联系人邮箱</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_email" value="<?php echo $field['user_two_email']; ?>" id="user_two_email" class="layui-input"> -->
                  <?php echo $field['user_two_email']; ?>
                </div>

                <label class="layui-form-label" for="user_two_sectors">所在部门</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_sectors" value="<?php echo $field['user_two_sectors']; ?>" id="user_two_sectors" class="layui-input"> -->
                  <?php echo $field['user_two_sectors']; ?>
                </div>

                <label class="layui-form-label" for="user_two_quarters">岗位职称</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_quarters" value="<?php echo $field['user_two_quarters']; ?>" id="user_two_quarters" class="layui-input"> -->
                  <?php echo $field['user_two_quarters']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_province">所在省份</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_province" value="<?php echo $field['user_two_province']; ?>" id="user_two_province" class="layui-input"> -->
                  <?php echo $field['user_two_province']; ?>
                </div>

                <label class="layui-form-label" for="user_two_city">所在城市</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_city" value="<?php echo $field['user_two_city']; ?>" id="user_two_city" class="layui-input"> -->
                  <?php echo $field['user_two_city']; ?>
                </div>

                <label class="layui-form-label" for="user_two_address">所在地址</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_two_address" value="<?php echo $field['user_two_address']; ?>" id="user_two_address" class="layui-input"> -->
                  <?php echo $field['user_two_address']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">合作案例信息</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_one_title">合作案例1</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_case_one_title" value="<?php echo $field['user_case_one_title']; ?>" id="user_case_one_title" class="layui-input"> -->
                  <?php echo $field['user_case_one_title']; ?>
                </div>

                <label class="layui-form-label" for="user_case_one_url">参考地址</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="user_case_one_url" value="<?php echo $field['user_case_one_url']; ?>" id="user_case_one_url" class="layui-input"> -->
                  <?php echo $field['user_case_one_url']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_two_title">合作案例2</label>
                <div class="layui-input-inline">
                  <?php echo $field['user_case_two_title']; ?>
                  <!-- <input type="text" name="user_case_two_title" value="<?php echo $field['user_case_two_title']; ?>" id="user_case_two_title" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="user_case_two_url">参考地址</label>
                <div class="layui-input-inline">
                  <?php echo $field['user_case_two_url']; ?>
                  <!-- <input type="text" name="user_case_two_url" value="<?php echo $field['user_case_two_url']; ?>" id="user_case_two_url" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_three_title">合作案例3</label>
                <div class="layui-input-inline">
                  <?php echo $field['user_case_three_title']; ?>
                  <!-- <input type="text" name="user_case_three_title" value="<?php echo $field['user_case_three_title']; ?>" id="user_case_three_title" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="user_case_three_url">参考地址</label>
                <div class="layui-input-inline">
                  <?php echo $field['user_case_three_url']; ?>
                  <!-- <input type="text" name="user_case_three_url" value="<?php echo $field['user_case_three_url']; ?>" id="user_case_three_url" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">行业竞争优势</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="competitor">竞争对手</label>
                <div class="layui-input-block">
                  <?php echo $field['competitor']; ?>
                  <!-- <input type="text" name="competitor" value="<?php echo $field['competitor']; ?>" id="competitor" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="superiority_contrast">优势对比</label>
                <div class="layui-input-block">
                  <?php echo $field['superiority_contrast']; ?>
                  <!-- <textarea name="superiority_contrast" value="<?php echo $field['superiority_contrast']; ?>" id="superiority_contrast" class="layui-textarea" style="resize: none;"></textarea> -->
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">所在单位信息</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_name">公司名称</label>
                <div class="layui-input-inline">
                  <?php echo $field['commpany_name']; ?>
                  <!-- <input type="text" name="commpany_name" value="<?php echo $field['commpany_name']; ?>" id="commpany_name" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="external_brand">对外品牌</label>
                <div class="layui-input-inline">
                  <?php echo $field['external_brand']; ?>
                  <!-- <input type="text" name="external_brand" value="<?php echo $field['external_brand']; ?>" id="external_brand" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="credit_code">信用代码</label>
                <div class="layui-input-inline">
                  <?php echo $field['credit_code']; ?>
                  <!-- <input type="text" name="credit_code" value="<?php echo $field['credit_code']; ?>" id="credit_code" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">企业类型</label>
                <div class="layui-input-inline">
                  <?php if($field['commpany_type'] == 1): ?>国有企业<?php endif; if($field['commpany_type'] == 2): ?>民营企业<?php endif; if($field['commpany_type'] == 3): ?>外资企业<?php endif; if($field['commpany_type'] == 4): ?>民营企业<?php endif; ?>
                </div>

                <label class="layui-form-label" for="registered_capital">注册资金</label>
                <div class="layui-input-inline">
                  <?php echo $field['registered_capital']; ?>
                  <!-- <input type="text" name="registered_capital" value="<?php echo $field['registered_capital']; ?>" id="registered_capital" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="commpany_tel">座机电话</label>
                <div class="layui-input-inline">
                  <?php echo $field['commpany_tel']; ?>
                  <!-- <input type="text" name="commpany_tel" value="<?php echo $field['commpany_tel']; ?>" id="commpany_tel" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_website">公司官网</label>
                <div class="layui-input-inline">
                  <?php echo $field['commpany_website']; ?>
                  <!-- <input type="text" name="commpany_website" value="<?php echo $field['commpany_website']; ?>" id="commpany_website" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="subsidiary_commpany">子母公司</label>
                <div class="layui-input-inline">
                  <?php echo $field['subsidiary_commpany']; ?>
                  <!-- <input type="text" name="subsidiary_commpany" value="<?php echo $field['subsidiary_commpany']; ?>" id="subsidiary_commpany" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="commpany_address">公司地址</label>
                <div class="layui-input-inline">
                  <?php echo $field['commpany_address']; ?>
                  <!-- <input type="text" name="commpany_address" value="<?php echo $field['commpany_address']; ?>" id="commpany_address" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="company_business">公司业务</label>
                <div class="layui-input-block">
                  <!-- <textarea name="company_business" id="company_business" class="layui-textarea" style="resize: none;"><?php echo $field['company_business']; ?></textarea> -->
                  <?php echo $field['company_business']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>所在单位状况</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="annual_turnover">年营业额</label>
                <div class="layui-input-inline">
                <!-- <input type="text" name="annual_turnover" value="<?php echo $field['annual_turnover']; ?>" id="annual_turnover" class="layui-input"> -->
                <?php echo $field['annual_turnover']; ?>
                </div>

                <label class="layui-form-label" for="annual_ratal">年纳税额</label>
                <div class="layui-input-inline">
                <!-- <input type="text" name="annual_ratal" value="<?php echo $field['annual_ratal']; ?>" id="annual_ratal" class="layui-input"> -->
                <?php echo $field['annual_ratal']; ?>
                </div>

                <label class="layui-form-label" for="office_space">办公场地</label>
                <div class="layui-input-inline">
                <!-- <input type="text" name="office_space" value="<?php echo $field['office_space']; ?>" id="office_space" class="layui-input"> -->
                <?php echo $field['office_space']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_num">公司人数</label>
                <div class="layui-input-inline">
                <!-- <input type="text" name="commpany_num" value="<?php echo $field['commpany_num']; ?>" id="commpany_num" class="layui-input"> -->
                <?php echo $field['commpany_num']; ?>
                </div>

                <label class="layui-form-label" for="industry_status">行业地位</label>
                <div class="layui-input-inline">
                <!-- <input type="text" name="industry_status" value="<?php echo $field['industry_status']; ?>" id="industry_status" class="layui-input"> -->
                <?php echo $field['industry_status']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>团队组织架构</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[name1]" value="<?php echo $field['sectors_name'][0]['name']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][0]['name']; ?>
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[num1]" value="<?php echo $field['sectors_name'][0]['num']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][0]['num']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[name2]" value="<?php echo $field['sectors_name'][1]['name']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][1]['name']; ?>
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[num2]" value="<?php echo $field['sectors_name'][1]['num']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][1]['num']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[name3]" value="<?php echo $field['sectors_name'][2]['name']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][2]['name']; ?>
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="sectors_name[num3]" value="<?php echo $field['sectors_name'][2]['num']; ?>" class="layui-input"> -->
                  <?php echo $field['sectors_name'][2]['num']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>所在单位领导</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_name">法人姓名</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="corporation_name" value="<?php echo $field['corporation_name']; ?>" id="corporation_name" class="layui-input"> -->
                  <?php echo $field['corporation_name']; ?>
                </div>

                <label class="layui-form-label" for="directly_under">直属领导</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="directly_under" value="<?php echo $field['directly_under']; ?>" id="directly_under" class="layui-input"> -->
                  <?php echo $field['directly_under']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_identity_card">法人身份证</label>
                <div class="layui-input-inline">
                  <?php echo $field['corporation_identity_card']; ?>
                  <!-- <input type="text" name="corporation_identity_card" value="<?php echo $field['corporation_identity_card']; ?>" id="corporation_identity_card" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="directly_identity_card">高管身份证</label>
                <div class="layui-input-inline">
                <?php echo $field['directly_identity_card']; ?>
                  <!-- <input type="text" name="directly_identity_card" value="<?php echo $field['directly_identity_card']; ?>" id="directly_identity_card" class="layui-input"> -->
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_tel">法人电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="corporation_tel" value="<?php echo $field['corporation_tel']; ?>" id="corporation_tel" class="layui-input"> -->
                  <?php echo $field['corporation_tel']; ?>
                </div>

                <label class="layui-form-label" for="directly_tel">高管电话</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="directly_tel" value="<?php echo $field['directly_tel']; ?>" id="directly_tel" class="layui-input"> -->
                  <?php echo $field['directly_tel']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_wechat">法人微信</label>
                <div class="layui-input-inline">
                  <?php echo $field['corporation_wechat']; ?>
                  <!-- <input type="text" name="corporation_wechat" value="<?php echo $field['corporation_wechat']; ?>" id="corporation_wechat" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="directly_wechat">高管微信</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="directly_wechat" value="<?php echo $field['directly_wechat']; ?>" id="directly_wechat" class="layui-input"> -->
                  <?php echo $field['directly_wechat']; ?>
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_email">法人邮箱</label>
                <div class="layui-input-inline">
                  <?php echo $field['corporation_email']; ?>
                  <!-- <input type="text" name="corporation_email" value="<?php echo $field['corporation_email']; ?>" id="corporation_email" class="layui-input"> -->
                </div>

                <label class="layui-form-label" for="directly_email">高管邮箱</label>
                <div class="layui-input-inline">
                  <!-- <input type="text" name="directly_email" value="<?php echo $field['directly_email']; ?>" id="directly_email" class="layui-input"> -->
                  <?php echo $field['directly_email']; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>相关附件文件</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="attachment">附件文件</label>
                <div class="layui-input-block">
                  <?php if($field['attachment'] == ''): ?>
                  <input type="text" style="width:40%;float:left;display:none;background-color:#dcdcdc;" readonly name="attachment" class="layui-input">
                  <?php else: ?>
                  <input type="text" style="width:40%;float:left;display:block;background-color:#dcdcdc;" value="<?php echo $field['attachment']; ?>" readonly name="attachment" class="layui-input">
                  <?php endif; ?>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">供应商审核信息</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="staff_status">合作状态</label>
                <div class="layui-input-inline">
                  <?php if($field['status'] == 0): ?>审核中<?php endif; if($field['status'] == 3): ?>合作中<?php endif; if($field['status'] == 1): ?>预备中<?php endif; if($field['status'] == 2): ?>暂停中<?php endif; ?>
                </div>
              </div>
              <div class="layui-form-item">
                <input type="hidden" id="xing" value="<?php echo $field['rate']; ?>">
                <label class="layui-form-label" for="rate">星级评分</label>
                <div class="layui-input-block">
                  <div><div id="test4"></div></div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
              layui.use(['rate'],function(){
                var rate = layui.rate;
                //半星效果
                var xing = $("#xing").val();
                rate.render({elem: '#test4',value: xing,half: true,text: false,readonly:true});
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
