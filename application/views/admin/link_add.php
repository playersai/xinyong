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
<script charset="utf-8" src="/public/formvalid/valid.js"></script>
<script language="javascript">
	function checkdata() {
		document.myform.website_name.value = trim(document.myform.website_name.value);
		if(document.myform.website_name.value=="") {
			alert("网站名称不能为空!");
			document.myform.website_name.focus();
			return false;
		}

		document.myform.url.value = trim(document.myform.url.value);
		var url = document.myform.url.value;
		if(!check_isURL(url)){ 
			alert("网址输入的URL无效!");
			document.myform.url.focus(); 
			return false; 
		}

		document.myform.logo.value = trim(document.myform.logo.value);
		if(document.myform.logo.value!="") {
			var logo = document.myform.logo.value;
			if(!check_isRelativePath(logo) && !check_isURL(logo)) {
				alert("网站LOGO填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
				document.myform.logo.focus();
				return false;
			}
		}

		if(!check_isIntger(document.myform.sort.value) || document.myform.sort.value<0) {
			alert("排序必需填写大于或等于0的整数!");
			document.myform.sort.focus();
			return false;
		}
	}
</script>
</head>

<body>
<div class="wrap">
<form method="post" action="<?php echo $config['base_url']; ?>admin_link/add_handle" class="ajax_form" name="myform" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">新增友情链接</th>
    </tr>
    <tr>
      <td align="right">链接分类：</td>
      <td>
      	<select name="type_id">
      	  <option value="0" selected>友情链接(默认)</option>
      	  <option value="1">国家部委网站</option>
      	  <option value="2">省级政府网站</option>
      	  <option value="3">省内地市政府网站</option>
      	  <option value="4">市政府机构网站</option>
      	  <option value="5">中山各镇区网站</option>
      	  <option value="6">社会团体网站</option>
      	</select>
      </td>
    </tr>
    <tr>
      <td align="right"><font color="#FF0000">*&nbsp;</font>网站名称：</td>
      <td>
        <input type="text" name="website_name" maxlength="30" style="width:360px;" class="input" dataType="require" title="请输入网站名称" />
      </td>
    </tr>
    <tr>
      <td align="right"><font color="#FF0000">*&nbsp;</font>网 址：</td>
      <td>
	    <input type="text" name="url" maxlength="255" style="width:360px;" class="input" value="http://" dataType="require" title="请输入网址" />
      </td>
    </tr>
	
	<tr>
      <td align="right">网站LOGO：</td>
      <td>
	    <input type="text" name="logo" maxlength="255" style="width:360px;"  class="input" value="" dataType="require" title="请输入网站logo" />
	    <iframe frameborder="0" src="/public/upload.php?upname=logo&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe>
      </td>
    </tr>
    <tr>
      <td align="right">网站简介：</td>
      <td><textarea name="description" maxlength="200" cols="58" rows="5"></textarea>  </td>
    </tr>
    <tr>
      <td align="right"><font color="#FF0000">*&nbsp;</font>排 序：</td>
      <td><input type="text" name="sort" maxlength="8" size="6" class="input" value="0" />&nbsp;<font color="#FF0000">数值越大越靠前</font></td>
    </tr>
      
   
    <tr>
      <td align="right">状 态：</td>
      <td>
       <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" checked><label>通过审核</label> &nbsp;&nbsp;<input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;"><label>待审核</label>
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

