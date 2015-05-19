
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
      <li class="thistab"><a href="/index.php/landscape/type2add/2">个人求职</a></li>
      <li><a href="/index.php/landscape/type2add/1">企业招聘</a></li>
    </ul>
    <ul class="tab_conbox" id="tab_conbox">
      <li class="tab_con">
      <div class="inve_apply">
        <div class="tit">个人信息
          <span style="font-size:12px; font-weight:normal; color:#F00;">（请正确填写个人信息）</span>
        </div>
        <div class="con">
        <script charset="utf-8" src="/public/formvalid/valid.js"></script>
        <script type="text/javascript">
			function checkdata(){
				document.myform.name.value = trim(document.myform.name.value);
				if(document.myform.name.value=="") {
					alert("姓名不能为空！");
					document.myform.name.focus();
					return false;
				}

				document.myform.xueli.value = trim(document.myform.xueli.value);
				if(document.myform.xueli.value=="") {
					alert("学历不能为空！");
					document.myform.xueli.focus();
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

				if(document.myform.email.value!="") {
					if(!check_isEmail(document.myform.email.value)){
						alert("请输入正确的E-mail地址！");
						document.myform.email.focus();
						return false;
					}
				}

				document.myform.content.value = trim(document.myform.content.value);
				if(document.myform.content.value=="") {
					alert("自我简介不能为空！");
					document.myform.content.focus();
					return false;
				}

				document.myform.qzhyx.value = trim(document.myform.qzhyx.value);
				if(document.myform.qzhyx.value=="") {
					alert("意向职位不能为空！");
					document.myform.qzhyx.focus();
					return false;
				}

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
        <form name="myform" action="/index.php/landscape/type2add_handle/2" method="post" >
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80" height="40" align="right">姓名：</td>
              <td width="271"><input type="text" name="name" maxlength="20" id="" class="text" /> <i class="asterisk">*</i></td>
              <td width="80" align="right">学历：</td>
              <td><input type="text" name="xueli" id=""  class="text" /> <i class="asterisk">*</i></td>
            </tr>
            <tr>
              <td width="80" height="40" align="right">联系电话：</td>
              <td width="271"><input type="text" name="tel" id=""  class="text" /> <i class="asterisk">*</i></td>
              <td width="80" align="right">E-mail：</td>
              <td><input type="text" name="email" id=""  class="text" /></td>
            </tr>
            <tr>
              <td width="80" height="40" align="right">联系地址：</td>
              <td height="40" colspan="3"><input type="text" name="address" id=""  class="text"  style="width:500px;" /></td>
            </tr>
            <tr>
              <td width="80" height="130" align="right" valign="top">自我简介：</td>
              <td height="130" colspan="3"><textarea id="content" name="content" rows="8" cols="120" class="textarea"></textarea>
                <i class="asterisk">*</i></td>
            </tr>
          </table>
          </div>
          <div class="tit">应聘意向</div>
          <div class="con">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="80" height="40" align="right">意向职位：</td>
                <td colspan="3"><input type="text" name="qzhyx" id=""  class="text" /> <i class="asterisk">*</i></td>
              </tr>
            </table>
          </div>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="40" align="right">验证码：</td>
              <td width="80"><input name="f_code" maxlength="4" type="text" id="f_code"  class="text" size="8" msg="请检查验证码"></td>
              <td><img id="img_code" class="f_code" title="看不清楚？点击图片刷新" src="/public/ValidateCode.php" onclick="this.src='/public/ValidateCode.php?'+new Date().getTime()"></td>
            </tr>
          </table>
          <div style="text-align:center; margin:20px 0;">
            <input type="button" value="发&nbsp;&nbsp;布" class="submit1" onclick="checkdata()">
            <input type="button" value="返&nbsp;&nbsp;回" class="submit2" onclick="history.go(-1)">
          </div>
        </form>
      </div>
      </li>
    </ul>
  </div>
</div>
</div>
<!--warper end--> 
