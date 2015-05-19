  <?php header('Cache-control: private, must-revalidate');?>
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="">走进板芙</a> &gt;&gt;
    <span class="active">投资板芙</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_landscape.png" />
      <ul>
       <?php if(isset($left_nav) and is_array($left_nav))
	  {
		  foreach($left_nav as $lnval){
	  ?>
        <li><a href="/index.php/landscape/view/<?php echo $left_nav2[$lnval->cat_id][0]->cat_id.'/'.$lnval->cat_id?>" <?php if($lnval->cat_id==$left_nav_selected){ echo 'style="background-color:#0067ad;color:#fff;display: block;"'; }?> ><?php echo $lnval->name;?></a></li>
        <?php
		  }
	  }
		?>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
      <ul class="tabs">
        <li onfocus=""><a href="/index.php/landscape/type2add/2">个人求职</a></li>
        <li class="thistab"><a href="/index.php/landscape/type2add/1">企业招聘</a></li>
      </ul>
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con">
        <script charset="utf-8" src="/public/formvalid/valid.js"></script>
        <script type="text/javascript">
			function checkdata(){							
				document.myform.company.value = trim(document.myform.company.value);
				if(document.myform.company.value=="") {
					alert("公司名称不能为空！");
					document.myform.company.focus();
					return false;
				}

				document.myform.content.value = trim(document.myform.content.value);
				if(document.myform.content.value=="") {
					alert("公司简介不能为空！");
					document.myform.content.focus();
					return false;
				}

				//document.myform.content.value = trim(document.myform.contact.value);
				if(document.myform.contact1.value=="") {
					alert("联系人不能为空！");
					document.myform.contact1.focus();
					return false;
				}

				if(document.myform.tel.value=="") {
					alert("联系电话不能为空！");
					document.myform.tel.focus();
					return false;
				}else{
					var phone = document.myform.tel.value;
					if(!check_isMoblieNum(phone) && !check_isOfficeNum(phone)){
						alert("请输入正确的手机或固话号码！\r\n手机格式：13800000000\r\n固话格式：0760-12345678");
						document.myform.tel.focus();
						return false;
					}
				}

			 

				jobsIsNull = false;
				$("input[name='jobs[]']").each(function(){ 
					jobs = trim($(this).attr('value'));
					if(jobs=="") {
						alert("招聘职位不能为空！")
						jobsIsNull = true;
						return false;
					}
				});
				if(jobsIsNull) return false;

				zprsIsNull=false;
				$("input[name='zprs[]']").each(function(){ 
					zprs = trim($(this).attr('value'));
					if(!check_isIntger(zprs) || zprs < 0) {
					    alert("招聘人数必需填写大于或等于0的整数!");
					    zprsIsNull = true;
						return false;
					}
				});
				if(zprsIsNull){ return false;}

				zyyqIsNull=false;
				$("textarea[name='zyyq[]']").each(function(){ 
					zyyq = trim($(this).val());
					if(zyyq=="") {
					    alert("职位要求不能为空！");
					    zyyqIsNull = true;
						return false;
					}
				});
				if(zyyqIsNull){ return false;}

				document.myform.f_code.value = trim(document.myform.f_code.value);
				if(document.myform.f_code.value=="") {
					alert("验证码不能为空！");
					document.myform.f_code.focus();
					return false;
				}

				var yzm = document.myform.f_code.value;
				var status = true;
				$.ajax({
					url: '/index.php/ajax/checkYZM',
					type: 'POST',
					data:{f_code:yzm},
					dataType: 'text',
					timeout: 2000,
					error: function(){
						alert('连接超时，请稍后再次尝试！');
					},
					success: function(result){
						if(result=="true"){
							$("form").submit();
						}else{
							alert("验证码验证错误，请重新填写验证码！");
							$("#img_code").attr("src","/public/ValidateCode.php?"+new Date().getTime()); 
						}
					}
				});
			}
		</script>
		<form name="myform" action="/index.php/landscape/type2add_handle/1" method="post">
        <div class="inve_recruit">
          <div class="tit">公司信息
            <span style="font-size:12px; font-weight:normal; color:#F00;">（请正确填写公司信息）</span>
          </div>
          <div class="con">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="80" height="40" align="right"><i class="asterisk">*</i>公司名称：</td>
                <td height="40" colspan="3"><input type="text" name="company" id=""  class="text" /></td>
              </tr>
              <tr>
                <td width="80" height="130" align="right" valign="top"><i class="asterisk">*</i>公司简介：</td>
                <td height="130" colspan="3"><textarea id="content" name="description" rows="8" cols="120" class="textarea"></textarea></td>
              </tr>
              <tr>
                <td width="80" height="40" align="right"><i class="asterisk">*</i>联系人：</td>
                <td width="272"><input type="text" name="contact1" id=""  class="text" /></td>
                <td width="80" align="right"><i class="asterisk">*</i>联系电话：</td>
                <td><input type="text" name="tel" id=""  class="text" /></td>
              </tr>
              <tr>
                <td width="80" height="40" align="right">联系地址：</td>
                <td colspan="3"><input type="text" name="address" id=""  class="text"  style="width:500px;" /></td>
              </tr>
            </table>
          </div>
          
          <div class="tit"><div class="add_recruit"><input type="button" value="增加信息+" class="add_recruit_btn"></div>招聘信息
            <span style="font-size:12px; font-weight:normal; color:#F00;">（请正确填写招聘信息）</span>
          </div>
          
		  <script type="text/javascript">
			  $(document).ready(function(){	
			      $(".shanchu").click(function(){
				      if ($(".con_add").size() > 1) { 
					      $(this).parent().remove(); 
					  } else {
					      alert("至少保留1条招聘信息！") 
					  } 
				  });
					
				  $(".add_recruit_btn").click(function(){
				      $(".add_recruit_list").append($(".con_add:first").clone(true));
				  });			
			  });
		  </script>
    
          <div class="add_recruit_list">
            <div class="con_add">
              <span class="shanchu"></span>
              <div class="con">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="80" height="40" align="right"><i class="asterisk">*</i>招聘职位：</td>
                    <td><input type="text" name="jobs[]" id="jobs" class="text" /> </td>
                  </tr>
                  <tr>
                    <td width="80" height="40" align="right"><i class="asterisk">*</i>招聘人数：</td>
                    <td colspan="3"><input type="text" name="zprs[]" id="zprs"  class="text" /> </td>
                  </tr>
				  <tr>
                    <td width="80" height="40" align="right">学历要求：</td>
                    <td colspan="3"><input type="text" name="xlyq[]" id=""  class="text"  style="width:500px;" /></td>
                  </tr>
                  <tr>
                    <td width="80" height="130" align="right" valign="top"><i class="asterisk">*</i>职位要求：</td>
                    <td height="130" colspan="3"><textarea name="zyyq[]" id="content2" rows="8" cols="120" class="textarea"></textarea></td>                      
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="40" align="right"><i class="asterisk">*</i>验证码：</td>
              <td colspan="3">
                <input id="f_code" name="f_code" maxlength="4" type="text"  class="text" style=" float:left;" size="8" msg="请检查验证码"> 
                <img id="img_code" class="f_code" title="看不清楚？点击图片刷新" src="/public/ValidateCode.php" onclick="this.src='/public/ValidateCode.php?'+new Date().getTime()">
              </td>
            </tr>
          </table>
          <div style="text-align:center; margin:20px 0;">
            <input type="button" value="发&nbsp;&nbsp;布" class="submit1" onclick="checkdata()">
            <input type="button" value="返&nbsp;&nbsp;回" class="submit2" onclick="history.go(-1)"></div>
        </div>
		</form>
        </li>
       
      </ul>
    </div>
  </div>
</div>
<!--warper end-->
