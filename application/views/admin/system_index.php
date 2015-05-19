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
	
		if(trim(document.myform.website_url.value)!="") {
			if(!check_isURL(document.myform.website_url.value)){ 
				alert("网站地址输入的URL无效!");
				document.myform.website_url.focus(); 
				return false; 
			}
		}
	
	}
</script>
</head>

<body>
<div class="wrap">
<form name="myform" method="post" action="<?php echo $config['base_url']; ?>admin_system/save_handle" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">系统基本信息设置</th>
    </tr>
   
    <tr>
      <td align="right">网站名称：</td>
      <td><input type="text" name="<?php echo $info[0]->ch_name; ?>" maxlength="30" style="width:360px;" class="input" dataType="require" title="请输入网站名称，输入长度不能多于30个字符" value="<?php echo htmlspecialchars($info[0]->ch_value); ?>" /></td>
    </tr>
    <tr>
      <td align="right">网站地址：</td>
      <td>
	  <input type="text" name="<?php echo $info[1]->ch_name; ?>" maxlength="200" style="width:360px;" class="input" dataType="require" title="请输入网站简介，输入长度不能多于200个字符" value="<?php echo htmlspecialchars($info[1]->ch_value); ?>"  />
       </td>
    </tr>
    <tr>
      <td align="right">网站简介：</td>
      <td><input type="text" name="<?php echo $info[2]->ch_name; ?>"  maxlength="200" style="width:360px;"  class="input" value="<?php echo $info[2]->ch_value; ?>"  dataType="require" title="请输入网站地址，输入长度不能多于200个字符" />  </td>
    </tr>
    <tr>
      <td align="right">站点关闭：</td>
      <td><input type="radio" name="<?php echo $info[3]->ch_name; ?>" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $info[3]->ch_value=='1'?'checked':''; ?> ><label>关闭</label> &nbsp;&nbsp;<input type="radio" name="<?php echo $info[3]->ch_name; ?>" value="0" style="vertical-align: middle;margin-right:3px;" <?php echo $info[3]->ch_value=='0'?'checked':''; ?>><label>开启</label>
	  </td>
    </tr>
      
   
    <tr>
      <td align="right">站点关闭的提示：</td>
      <td>
       <input type="text" name="<?php echo $info[4]->ch_name; ?>" maxlength="200" style="width:360px;" class="input" value="<?php echo htmlspecialchars($info[4]->ch_value); ?>" title="请输入站点关闭提示，输入长度不能多于200个字符" />
        </td>
    </tr>
	 <tr>
      <td align="right">是否灰调网站：</td>
      <td><input type="radio" name="<?php echo $info[5]->ch_name; ?>" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $info[5]->ch_value=='1'?'checked':''; ?>><label>是</label> &nbsp;&nbsp;<input type="radio" name="<?php echo $info[5]->ch_name; ?>" <?php echo $info[5]->ch_value=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;"><label>否</label>
	  </td>
    </tr>
	
    <tr>
      <td align="right"></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" />
		
      </td>
    </tr>
  </table>
</form>
</div>
</body>


</html>

