<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<link rel="stylesheet" path="/public/manage/css/" type="text/css" id="skinCss" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>
<script type="text/javascript" src="/public/manage/js/artDialog/plugins/iframeTools.js"></script>

<script type="text/javascript" src="/public/formvalid/valid.js"></script>

<script language="javascript">
	function checkdata() {
		if(document.myform.username.value!="") {
			if(!check_isRegisterUserName(document.myform.username.value)){
				alert("用户名必需是以英文字母开头5-20位字符，仅支持英文、数字、“_”、“-”等字符组合!");
				document.myform.username.focus();
				return false;
			}
		}else{
			alert("用户名不能为空!");
			document.myform.username.focus();
			return false;
		}
	
		if(document.myform.password.value!="") {
			var pwd_length = document.myform.password.value.length; 
			if(pwd_length<6 || pwd_length >20){
				alert("密码长度要求为6-20个字符！");
				document.myform.password.focus();
				return false;
			}
		}

		if(document.myform.nickname.value!="") {
			document.myform.nickname.value=clearSpecialChar(document.myform.nickname.value);
		}else{
			alert("真实姓名不能为空!");
			document.myform.nickname.focus();
			return false;
		}
	}
</script>
</head>

<body>
<div class="wrap">
  <form name="myform" method="post" action="/index.php/admin_user/edit_handle/<?php echo $user_info[0]->user_id; ?>" class="ajax_form" onsubmit="return checkdata()">
    <table cellspacing="1" class="myform">
      <tr>
        <th colspan="2">编辑用户</th>
      </tr>
      <tr>
        <td align="right"><font color="#FF0000">*&nbsp;</font>用户名：</td>
        <td><input type="text" name="" style="width:260px;" class="input" maxlength="20" dataType="require" title="用户名不允许修改" value="<?php echo $user_info[0]->username; ?>" readonly /> &nbsp;<font color="#FF0000"></font></td>
      </tr>
      <tr>
        <td align="right">登录密码：</td>
        <td><input type="text" name="password" style="width:260px;" class="input" maxlength="20" dataType="require" title="请输入登录密码，输入长度要求6-20个字符" /> &nbsp;<font color="#FF0000">密码长度：6-20位，不需修改请留空不填</font></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*&nbsp;</font>真实姓名：</td>
        <td><input type="text" name="nickname" style="width:260px;" class="input" maxlength="20" dataType="require" title="请输入真实姓名，输入长度不能多于20个字符" value="<?php echo $user_info[0]->nickname; ?>" /></td>
      </tr>
      <?php if($_SESSION['group_id']=='1'): ?>
      <tr>
        <td align="right"><font color="red">*&nbsp;</font>所属用户组：</td>
        <td><select name="group_id">
            <?php foreach($rows as $row_item){ ?>
            <option value="<?php echo $row_item->group_id; ?>" <?php echo $user_info[0]->group_id==$row_item->group_id?'selected':''; ?>><?php echo $row_item->name; ?></option>
            <?php } ?>
          </select></td>
      </tr>
      <tr>
        <td align="right">锁 定：</td>
        <td><input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;" <?php echo $user_info[0]->status=='0'?'checked':''; ?>>
          <label>是</label>
          &nbsp;&nbsp; <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $user_info[0]->status=='1'?'checked':''; ?>>
          <label>否</label></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td align="right"></td>
        <td><input type="submit" value="提 交" class="btn ajax_btn" /> <!--<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" >--></td>
      </tr>
    </table>
  </form>
</div>
</body>


</html>

