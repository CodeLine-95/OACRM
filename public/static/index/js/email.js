 $(document).ready(function(){
		function isChinaName(name) {
			 var pattern = /^[\u4E00-\u9FA5]{1,6}$/;
			 return pattern.test(name);
		}
		// 验证手机号
		function isPhoneNo(phone) { 
			 var pattern = /^1[34578]\d{9}$/; 
			 return pattern.test(phone); 
		}
        $('#send_message').click(function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var name = $('#exampleInputName').val();
            var city = $('#exampleInputCity').val();
            var tel = $('#exampleInputTel').val();
            var company = $('#exampleInputCompany').val();
            var need = $('#exampleInputNeed').val();
            var pro = $("#exampleInputProject option:selected").val();
            $("#mail_success").text("");
			$("#mail_fail").text("");
         	if(name.length == 0){
	         	var error = true;
	         	$('#exampleInputName').addClass("validation");
				$('#mail_fail').append('姓名不能为空！！');
				$('#mail_fail').css('display','block');
         	}else{
                $('#exampleInputName').removeClass("validation");
                
            }
            if(city.length == 0){
                var error = true;
                $('#mail_fail').append('城市不能为空！！');
				$('#mail_fail').css('display','block');
                $('#exampleInputCity').addClass("validation");
                
            }else{
	            if(isChinaName(city)){
		            $('#exampleInputCity').removeClass("validation");
	            }else{
		            var error = true;
		            $('#mail_fail').append('城市只能为中文！！');
					$('#mail_fail').css('display','block');
	                $('#exampleInputCity').addClass("validation");
	            }
                
            }
            if(tel.length == 0){
                var error = true;
                $('#mail_fail').append('电话不能为空！！');
				$('#mail_fail').css('display','block');
                $('#exampleInputTel').addClass("validation");
            }else{
	            if(isPhoneNo(tel)){
		            $('#exampleInputTel').removeClass("validation");
	            }else{
		            var error = true;
		            $('#mail_fail').append('电话格式不对！！');
					$('#mail_fail').css('display','block');
	                $('#exampleInputTel').addClass("validation");
	            }
                
            }
            if(company.length == 0){
                var error = true;
                $('#mail_fail').append('公司不能为空！！');
				$('#mail_fail').css('display','block');
                $('#exampleInputCompany').addClass("validation");
            }else{
                $('#exampleInputCompany').removeClass("validation");
            }
/*
            if(need.length == 0){
	            var error = true;
	            $('#mail_fail').append('需求不能为空！！');
				$('#mail_fail').css('display','block');
	            $('#exampleInputNeed').addClass('validation');
            }else{
	            $('#exampleInputNeed').removeClass('validation');
            }
*/
            
            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send_message').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
				/* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.ajax({
	                url:"index/index/agentAction",
	                type:"POST",
	                data:{
		                agent_name:name,
		                agent_city:city,
		                agent_tel:tel,
		                agent_company:company,
		                agent_project:pro,
		                agent_need:need
	                },
	                success:function(data){
		                if(data.icon == 6){
			                $('#mail_success').append(data.msg);
			                $('#mail_success').css('display','block');
			                setTimeout(function () { Location.href = Location.href; }, 1000);
		                }else{
			                $('#mail_fail').append(data.msg);
			                $('#mail_fail').css('display','block');
			                setTimeout(function () { Location.href = Location.href; }, 1000);
		                }
		                
	                }
                });
            }
        });    
    });