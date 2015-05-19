
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt; <span class="active">我要投诉</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_interaction.png" />
      <ul>
        <?php
	  if(isset($left_navs)){
	
	  foreach($left_navs as $lnkey=>$lnval){
	  
	  if(is_array($lnval)){
	  foreach($lnval as $lnnkey=>$lnnval){
	  ?>
        <li><a  <?if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;";<?php }else{?>href="<?php echo $lnnval['url']; ?>"<?php } ?>><?php echo $lnnval['name']; ?></a></li>
		
		<?php 
		}
		}
		}
		}
		?>
      </ul>
    </div>
    <div class="clear2"></div>
    <a href="/index.php/interaction/type1/148/"><img src="/public/index/images/online_interview.jpg" /></a> </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="border_box">
      <div class="alert_box">
        <p>您可对中山市板芙镇管理及服务方面的问题进行投诉、咨询，亦可选择镇长信箱对中山市板芙镇的发展和工作提出建议。<br>
          网上诉求的办理流程为：<br>
          1、填写提交网上诉求内容并获得受理编号与查询密码；<br>
          2、系统自动转有关部门调查处理；<br>
          3、用户可适时根据受理编号与查询密码查询处理情况。</p>
        <p>请您正确填写所有信息，并留下真实的联系方式。对留下真实姓名和联系方式的问题，我们将优先处理，重点反馈；对于填写信息模糊、且未留下联系方式的来件，我们将不予受理。</p>
      </div>
      <div class="complaint_online_page">
<script charset="utf-8" src="/public/formvalid/valid.js"></script>
<script language="javascript">
	function checkdata()
	{
		document.myform.title.value = trim(document.myform.title.value);
		if(document.myform.title.value=="") {
			alert("诉求主题不能为空!");
			document.myform.title.focus();
			return false;
		}

		document.myform.content.value = trim(document.myform.content.value);
		if(document.myform.content.value=="") {
			alert("反映内容不能为空!");
			document.myform.content.focus();
			return false;
		}

		document.myform.contact_name.value = trim(document.myform.contact_name.value);
		if(document.myform.contact_name.value=="") {
			alert("用户姓名不能为空!");
			document.myform.contact_name.focus();
			return false;
		}

		if(document.myform.mobile.value!="") {
			var mobile = document.myform.mobile.value;
			if(!check_isMoblieNum(mobile)) {
				alert("请输入正确的手机号码！");
				document.myform.mobile.focus();
				return false;
			}
		}else{
			alert("手机号码不能为空!");
			document.myform.mobile.focus();
			return false;
		}

		if(document.myform.email.value!="") {
			var email = document.myform.email.value;
			if(!check_isEmail(email)) {
				alert("请输入正确的E-mail地址！");
				document.myform.email.focus();
				return false;
			}
		}

		document.myform.f_code.value = trim(document.myform.f_code.value);
		if(document.myform.f_code.value=="") {
			alert("验证码不能为空！");
			document.myform.f_code.focus();
			return false;
		}

		var yzm = document.myform.f_code.value;
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
      <form name="myform" action="/index.php/interaction/handle" method="post">  
        <dl>
          <dt>来信类别：</dt>
          <dd>
            <select name="type_id" class="select">
			  <?php foreach($types as $tkey=>$tval){ ?>
              <option value="<?php echo $tval->type_id; ?>" <?php if($tkey==$type_selected){ echo 'selected="selected"'; }?>><?php echo $tval->name; ?></option>
			  <?php } ?>
            </select>
          </dd>
        </dl>
        <dl>
          <dt><em class="asterisk">*</em>诉求主题：</dt>
          <dd> <input type="text" name="title" maxlength="50" id="title" size="58" datatype="Require" title="请输入诉求主题，输入长度不能超过50个字符" class="text" style="width:500px;"></dd>
        </dl>
        <dl>
          <dt><em class="asterisk">*</em>反映内容：</dt>
          <dd>
            <textarea id="content" name="content" rows="8" cols="120" class="textarea" title="请输入反映内容"></textarea>
          </dd>
        </dl>
        <dl>
          <dt><em class="asterisk">*</em>用户姓名：</dt>
          <dd> <input type="text" name="contact_name" maxlength="20" id="name" datatype="Require" title="请输入用户姓名，输入长度不能超过20个字符" class="text" style="width:200px;" > </dd>
        </dl>
        <dl>
          <dt><em class="asterisk">*</em>手机号码：</dt>
          <dd> <input type="text" name="mobile" maxlength="11" id="contact" datatype="Number" title="请输入手机号码" class="text"style="width:200px;" > </dd>
        </dl>
        <dl>
          <dt>联系地址：</dt>
          <dd> <input type="text" name="address" maxlength="50" id="addr" size="58" title="请输入联系地址，输入长度不能超过50个字符" class="text" style="width:200px;"> </dd>
        </dl>
        <dl>
          <dt>E-mail：</dt>
          <dd> <input type="text" name="email" id="email" size="" require="false" datatype="Email" title="请输入E-mail地址" class="text" style="width:200px;"> </dd>
        </dl>
        <dl>
          <dt>是否公开：</dt>
          <dd>
            <select name="is_show" class="select">
              <option value="1">公开</option>
              <option value="0">不公开</option>
            </select>
          </dd>
        </dl>
        <dl>
          <dt>验证码：</dt>
          <dd> 
            <input name="f_code" maxlength="4" type="text" id="f_code"  class="text" style=" float:left;" size="8" title="请输入验证码"> 
            <img id="img_code" class="f_code" title="看不清楚？点击图片刷新" src="/public/ValidateCode.php" onclick="this.src='/public/ValidateCode.php?'+new Date().getTime()" />
            <span style="display:inline-block; line-height:22px;">看不清楚？点击图片刷新</span>
          </dd>
        </dl>
        <div style="height:20px;"></div>
        <dl>
          <dt></dt>
          <dd> 
            <input type="button"  value="提&nbsp;&nbsp;交" class="submit1" onclick="checkdata()">
            <input type="reset" value="重&nbsp;&nbsp;置" class="submit2">
          </dd>
        </dl>
		
		</form>
      </div>
    </div>
  </div>
</div>
<!--warper end-->
