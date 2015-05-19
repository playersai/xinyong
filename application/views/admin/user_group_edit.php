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
		if(document.myform.name.value=="") {
			alert("用户组名不能为空!");
			document.myform.name.focus();
			return false;
		}
		return true;
	}
</script>
</head>

<body>
<div class="wrap">
<form name="myform" method="post" action="<?php echo admin_url('admin_user_group/edit_handle/'.$group_info['group_id']); ?>" class="ajax_form">
  <table cellspacing="1" class="myform">
	<tr>
	  <th colspan="2">编辑用户组</th>
	</tr>
	<tr>
	  <td align="right"><font color="#FF0000">*&nbsp;</font>用户组名称：</td>
	  <td>
		<input type="text" name="name" style="width:260px;" class="input" maxlength="20" dataType="require" title="请输入用户名，输入长度要求5-20个字符" value="<?php echo $group_info['name']; ?>" /> 
		<font color="#FF0000"></font>
	  </td>
	</tr>
	<tr>
	  <td align="right">组描述：</td>
	  <td>
		<input type="text" name="description" style="width:260px;" class="input" maxlength="20" dataType="require" title="请输入组描述" value="<?php echo $group_info['description']; ?>" /> 
		<font color="#FF0000">用户组的简单描述</font>
	  </td>
	</tr>
	<tr>
	  <td align="right">状态：</td>
	  <td>
			<input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $group_info['status'] =='1'?'checked':''; ?>><label>开启</label>
			<input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;" <?php echo $group_info['status']=='0'?'checked':''; ?>><label>禁用</label>
		</td>
	</tr>
	<tr>
	  <td align="right"></td>
	  <td>
		<input type="submit" value="提 交" class="btn ajax_btn" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" >
	  </td>
	</tr>
  </table>
</form>
</div>
</body>


</html>

