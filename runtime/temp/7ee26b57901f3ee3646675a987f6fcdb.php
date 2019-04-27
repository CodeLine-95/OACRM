<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/home/wwwroot/guanjia.jutui.org/public/../application/index/view/index/supplier.html";i:1555670184;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>巨推管家</title>
  <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
  <script src="/static/admin/js/jquery.min.js"></script>
  <script src="/static/layuiadmin/layui/layui.js"></script>
  <script src="/static/admin/js/admin.js"></script>
  <style type="text/css">
    #biaoti-wenzi>p {
        font-size: 16px;
        color: #101010;
        text-align: center;
        height: 30px;
        line-height: 30px;
        margin-top: 10px;
    }
    #liucheng {
        width: 1000px;
        margin: 30px auto;
        height: 222px;
    }

    #liucheng>img {
        width: 100%;
        height: 100%;
    }
    #lianxi {
        width: 1200px;
        margin: 30px auto;
    }

    #lianxi>h2 {
        font-size: 30px;
        color: #101010;
        height: 50px;
        line-height: 50px;
        text-align: center;
    }
  </style>
</head>
<body style="background:#fff;width:1280px;margin:0 auto;">
  <div id="biaoti-wenzi" style="width:1200px;margin:30px auto;text-align: center;">
      <h1 style="color:brown;height: 70px;line-height: 70px;">北京巨推科技有限公司</h1>
      <b style="width:70px;height:7px;background:brown;display: inline-block;margin-top: 10px;"></b>
      <p style="margin-top:30px;">北京巨推科技有限公司（代运营业务）</p>
      <p>是一家专门为传统企业提供一站式电子商务运营方案的NLP电子商务服务商，</p>
      <p>秉持“一切都是为了销售额”的经营理念，</p>
      <p>致力于帮助更多的传统企业了解电子商务，涉足电子商务，</p>
      <p>拓展互联网销售渠道，实现销售额的快速提升。 艾斯时代的服务内容主要包括：</p>
      <p>电商渠道规划、品牌定位、视觉规划、运营策划、数据分析、客户服务等整体托管服务。</p>
      <p>业务范围覆盖女装、化妆品、3C数码、美食特产、家具建材等诸多领域，</p>
      <p>为客户提供全网营销策略：天猫，京东，淘宝，拼多多等主流电商平台运营服务 ，</p>
      <p>公司同仁均为当今电商流人群80和90后新起之秀，团队成员均拥有7年以上电商行业工作经验；</p>
      <p>现已建立了强大的电子商务服务体系及精英运营团队。</p>
  </div>
  <div id="lianxi">
      <h2 style="color: red;">通过以下方式联系我们</h2>
  </div>
  <div>
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <!-- <div class="layui-card-header">添加供应商</div> -->
          <div class="layui-card-body" pad15>
            <div class="layui-form">
              <div class="layui-form-item layui-form-text">
                <h2 style="text-align:center;height:40px;">供应商服务</h2>
              </div>

              <div class="layui-form-item">
                  <label class="layui-form-label">业务类型</label>
                  <div class="layui-input-block" id="typename"></div>
              </div>

               <div class="layui-form-item">
                <label class="layui-form-label">业务标签</label>
                <div class="layui-input-block" id="html"></div>
               </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="market_quotes">市场报价</label>
                <div class="layui-input-inline">
                  <input type="text" name="market_quotes" id="market_quotes" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_quotes">公司报价</label>
                <div class="layui-input-inline">
                  <input type="text" name="commpany_quotes" id="commpany_quotes" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                  <label class="layui-form-label" for="effect_promise">效果承诺</label>
                  <div class="layui-input-block">
                    <textarea name="effect_promise" id="effect_promise" class="layui-textarea" style="resize: none;"></textarea>
                  </div>
                </div>

              <div class="layui-form-item">
                <label class="layui-form-label">公司性质</label>
                <div class="layui-input-block">
                  <input type="radio" name="nature" class="layui-input" title="公司" value="1" checked>
                  <input type="radio" name="nature" class="layui-input" title="个人" value="2">
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
                  <input type="text" name="user_name" id="user_name" class="layui-input">
                </div>

                <label class="layui-form-label" for="identity_card">身份证</label>
                <div class="layui-input-inline">
                  <input type="text" name="identity_card" id="identity_card" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_tel">联系人电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_tel" id="user_tel" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_landline">座机电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_landline" id="user_landline" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_wechat">联系人微信</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_wechat" id="user_wechat" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_qq">联系人QQ</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_qq" id="user_qq" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_email">联系人邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_email" id="user_email" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_commpany">所在公司</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_commpany" id="user_commpany" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_sectors">所在部门</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_sectors" id="user_sectors" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_quarters">岗位职称</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_quarters" id="user_quarters" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_province">所在省份</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_province" id="user_province" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_city">所在城市</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_city" id="user_city" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_address">所在地址</label>
                <div class="layui-input-block">
                  <input type="text" name="user_address" id="user_address" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h3 style="text-align:center;">预备联系人</h3>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_name">联系人姓名</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_name" id="user_two_name" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_card">身份证</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_card" id="user_two_card" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_tel">联系人电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_tel" id="user_two_tel" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_landline">座机电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_landline" id="user_two_landline" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_wechat">联系人微信</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_wechat" id="user_two_wechat" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_qq">联系人QQ</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_qq" id="user_two_qq" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_email">联系人邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_email" id="user_two_email" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_sectors">所在部门</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_sectors" id="user_two_sectors" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_quarters">岗位职称</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_quarters" id="user_two_quarters" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_two_province">所在省份</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_province" id="user_two_province" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_city">所在城市</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_city" id="user_two_city" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_two_address">所在地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_two_address" id="user_two_address" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">合作案例信息</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_one_title">合作案例1</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_one_title" id="user_case_one_title" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_case_one_url">参考地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_one_url" id="user_case_one_url" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_two_title">合作案例2</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_two_title" id="user_case_two_title" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_case_two_url">参考地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_two_url" id="user_case_two_url" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="user_case_three_title">合作案例3</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_three_title" id="user_case_three_title" class="layui-input">
                </div>

                <label class="layui-form-label" for="user_case_three_url">参考地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_case_three_url" id="user_case_three_url" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">行业竞争优势</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="competitor">竞争对手</label>
                <div class="layui-input-block">
                  <input type="text" name="competitor" id="competitor" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="superiority_contrast">优势对比</label>
                <div class="layui-input-block">
                  <textarea name="superiority_contrast" id="superiority_contrast" class="layui-textarea" style="resize: none;"></textarea>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2 style="">所在单位信息</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_name">公司名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="commpany_name" id="commpany_name" class="layui-input">
                </div>

                <label class="layui-form-label" for="external_brand">对外品牌</label>
                <div class="layui-input-inline">
                  <input type="text" name="external_brand" id="external_brand" class="layui-input">
                </div>

                <label class="layui-form-label" for="credit_code">信用代码</label>
                <div class="layui-input-inline">
                  <input type="text" name="credit_code" id="credit_code" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">企业类型</label>
                <div class="layui-input-inline">
                  <select class="layui-input" name="commpany_type">
                    <option value="1">国有企业</option>
                    <option value="2">民营企业</option>
                    <option value="3">外资企业</option>
                    <option value="4">民营企业</option>
                  </select>
                </div>

                <label class="layui-form-label" for="registered_capital">注册资金</label>
                <div class="layui-input-inline">
                  <input type="text" name="registered_capital" id="registered_capital" class="layui-input">
                </div>

                <label class="layui-form-label" for="commpany_tel">座机电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="commpany_tel" id="commpany_tel" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_website">公司官网</label>
                <div class="layui-input-inline">
                  <input type="text" name="commpany_website" id="commpany_website" class="layui-input">
                </div>

                <label class="layui-form-label" for="subsidiary_commpany">子母公司</label>
                <div class="layui-input-inline">
                  <input type="text" name="subsidiary_commpany" id="subsidiary_commpany" class="layui-input">
                </div>

                <label class="layui-form-label" for="commpany_address">公司地址</label>
                <div class="layui-input-inline">
                  <input type="text" name="commpany_address" id="commpany_address" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="company_business">公司业务</label>
                <div class="layui-input-block">
                  <textarea name="company_business" id="company_business" class="layui-textarea" style="resize: none;"></textarea>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>所在单位状况</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="annual_turnover">年营业额</label>
                <div class="layui-input-inline">
                <input type="text" name="annual_turnover" id="annual_turnover" class="layui-input">
                </div>

                <label class="layui-form-label" for="annual_ratal">年纳税额</label>
                <div class="layui-input-inline">
                <input type="text" name="annual_ratal" id="annual_ratal" class="layui-input">
                </div>

                <label class="layui-form-label" for="office_space">办公场地</label>
                <div class="layui-input-inline">
                <input type="text" name="office_space" id="office_space" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="commpany_num">公司人数</label>
                <div class="layui-input-inline">
                <input type="text" name="commpany_num" id="commpany_num" class="layui-input">
                </div>

                <label class="layui-form-label" for="industry_status">行业地位</label>
                <div class="layui-input-inline">
                <input type="text" name="industry_status" id="industry_status" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>团队组织架构</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[name1]" class="layui-input">
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[num1]" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[name2]" class="layui-input">
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[num2]" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[name3]" class="layui-input">
                </div>

                <label class="layui-form-label">部门人数</label>
                <div class="layui-input-inline">
                  <input type="text" name="sectors_name[num3]" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>所在单位领导</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_name">法人姓名</label>
                <div class="layui-input-inline">
                  <input type="text" name="corporation_name" id="corporation_name" class="layui-input">
                </div>

                <label class="layui-form-label" for="directly_under">直属领导</label>
                <div class="layui-input-inline">
                  <input type="text" name="directly_under" id="directly_under" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_identity_card">法人身份证</label>
                <div class="layui-input-inline">
                  <input type="text" name="corporation_identity_card" id="corporation_identity_card" class="layui-input">
                </div>

                <label class="layui-form-label" for="directly_identity_card">高管身份证</label>
                <div class="layui-input-inline">
                  <input type="text" name="directly_identity_card" id="directly_identity_card" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_tel">法人电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="corporation_tel" id="corporation_tel" class="layui-input">
                </div>

                <label class="layui-form-label" for="directly_tel">高管电话</label>
                <div class="layui-input-inline">
                  <input type="text" name="directly_tel" id="directly_tel" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_wechat">法人微信</label>
                <div class="layui-input-inline">
                  <input type="text" name="corporation_wechat" id="corporation_wechat" class="layui-input">
                </div>

                <label class="layui-form-label" for="directly_wechat">高管微信</label>
                <div class="layui-input-inline">
                  <input type="text" name="directly_wechat" id="directly_wechat" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="corporation_email">法人邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="corporation_email" id="corporation_email" class="layui-input">
                </div>

                <label class="layui-form-label" for="directly_email">高管邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="directly_email" id="directly_email" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <h2>相关附件文件</h2>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" for="attachment">附件文件</label>
                <div class="layui-input-block">
                  <button type="button" style="float:left;margin-right:1%;" id="attachment" class="layui-btn"><i class="layui-icon">&#xe67c;</i>上传</button>
                  <input type="text" style="width:40%;float:left;display:none;background-color:#dcdcdc;" readonly name="attachment" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="add">添加</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $.get("<?php echo url('index/addIndex'); ?>",{},function(data){
      data = JSON.parse(data);
      data_list = data.data;
      var list_str = '';
      for(var i=0;i<data_list.length;i++){
        console.log(data_list[i]);
        list_str += '<input type="checkbox" name="yewuleixing" lay-filter="yewuleixing" title="'+data_list[i]['typename']+'" value="'+data_list[i]['id']+'">';
      }
      $('#typename').html(list_str);
      layui.use(['form'], function(){
        var form = layui.form;
        form.render('checkbox');
      });
    });
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
    layui.use(['form','element','laydate','rate','upload'], function(){
      var form = layui.form,element = layui.element,laydate = layui.laydate,upload = layui.upload;
      var arr = [];
      //监听checkbox
      form.on('checkbox(yewuleixing)',function(data){
        if (data.elem.checked === true) {
          arr.push(data.elem.value);
        }else{
          arr.remove(data.elem.value);
        }
        var project_ids = arr.join(",");
        $.post("<?php echo url('admin/AjaxAction/lookyewu'); ?>",{id:project_ids},function(data){
          $('#html').html(data);
          form.render('checkbox');
        });
      });
      //多图上传实例
      upload.render({
        elem: '#attachment',
        url: '<?php echo url("admin/AjaxAction/upload"); ?>',
        accept:"file",
        auto:true,
        size:51200,
        drag:false,
        before: function(obj) {
          layer.msg('图片上传中...', {icon: 16,shade: 0.01,time: 0})
        },
        done: function(res) {
            layer.close(layer.msg('上传成功！'));
            $('input[name=attachment]').val(res.data);
            $('input[name=attachment]').css({'display':'block'});
        }
        ,error: function(){
            layer.msg('上传错误！');
        }
      });

      form.on('submit(add)', function(data){
        data.field.type_id = checkedItem('yewuleixing');
        data.field.yewu_id = checkedItem('yewuneirong');
        $.ajax({
            type:'POST',
            url:'<?php echo url("index/addAction"); ?>',
            data: {
                data:data.field
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
