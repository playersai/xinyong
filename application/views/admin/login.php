<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>中山市板芙镇政府网站管理系统－广东信灵网络科技发展有限公司</title>
<meta http-equiv="X-UA-Compatible" content="IE=8" />

<link href="/public/admin/css/login.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/public/index/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">        
function changeTip(th){
    var passText = document.getElementById('txtPassword');
    var pass = document.getElementById('Password');
    if(th.id == 'Password'){
        if(th.value == '' || th.value.length == 0 ){
            passText.style.display='';
            pass.style.display='none';
        }
    }else{
        passText.style.display='none';
        pass.style.display='';
        pass.focus();
    }
}

function init(){ 
	var ctrl=document.getElementById("LoginName");
	ctrl.focus(); 
}

function valid(){
	var LoginName = document.getElementById("LoginName").value;
	var Password = document.getElementById("Password").value;
	var verify = document.getElementById("Check").value;
	
	if(LoginName=="" || LoginName=="请输入用户名"){
		alert("用户名不能为空！");
		document.getElementById("LoginName").focus();
		return false;
	}
	
	if(Password=="" || Password=="请输入密码"){
		alert("密码不能为空！");
		document.getElementById("Password").focus();
		return false;
	}
	
	if(verify=="" || verify=="输入验证码"){
		alert("验证码不能为空！");
		document.getElementById("Check").focus();
		return false;
	}
	return true;
}
</script>
</head>
<body id="login" scroll="no" onload="init()">
	<form name="form1" method="post" action="/index.php/admin/login_handle" id="form1">
		<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMTY3NzU1MDA4ZGSCjn+WAMucPvDZMCui6moWqZP3CmaN/H0Gg3jKDVWknw==" />

		<div id="container">

			<div id="content">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><input name="username" type="text" id="LoginName" class="inputbox" value="请输入用户名" onblur="if (this.value ==''){this.value='请输入用户名'}" onfocus="if (this.value =='请输入用户名'){this.value =''}" /></td>
					</tr>
					<tr>
						<td>
						<input type="text" id="txtPassword" onfocus="changeTip(this);" class="inputbox" value="请输入密码"/>
						<input name="password" type="password" id="Password" style="display:none;" onblur="changeTip(this);" class="inputbox" value=""/>
						</td>
					</tr>
					<tr>
						<td style="padding-left: 0px">
							<table style="width: 100%; height: 50px">
								<tr>
									<td style="padding-left: 4px; width: 130px"><input name="yzm" type="text" maxlength="4" id="Check" class="inputbox checkbox" value="输入验证码" onblur="if (this.value ==''){this.value='输入验证码'}" onfocus="if (this.value =='输入验证码'){this.value =''}" /></td>
									<td style="padding-left: 4px;"><img title="看不清楚？点击图片刷新" src="/public/ValidateCode.php" onclick="this.src='/public/ValidateCode.php?'+new Date().getTime()" style="width: 67px; vertical-align: middle" /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tfoot>
						<tr>
							<td>
								<table style="width: 100%; height: 50px">
									<tr>
										<td style="padding-left: 0px; width: 252px"><input type="submit" name="btnLogin" value="" id="btnLogin" class="btnLogin" onclick ="return valid();" /></td>
									</tr>
								</table>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</form>
</body>

</html>

