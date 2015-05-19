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
<script type="text/javascript" charset="utf-8" src="/public/formvalid/valid.js"></script>
<script language="javascript">
	function checkdata() {
		if(document.myform.link.value!="") {
			var url = document.myform.link.value;
			if(!check_isURL(url)){ 
				alert("广告链接地址输入的URL无效，填写的路径必需以 http:// 开头！");
				document.myform.link.focus(); 
				return false; 
			}
		}

		document.myform.thumb.value = trim(document.myform.thumb.value);	
		if(document.myform.thumb.value!="") {
			var url = document.myform.thumb.value;
			if(!check_isRelativePath(url) && !check_isURL(url)) {
				alert("广告图片填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
				document.myform.thumb.focus();
				return false;
			}
		}
		
		if(document.myform.sort.value!="") {
			if(!check_isIntger(document.myform.sort.value) || document.myform.sort.value<0) {
				alert("序号必需填写大于或等于0的整数!");
				document.myform.sort.focus();
				return false;
			}
		}
	}
</script>
</head>

<body>
<div class="wrap">
<form method="post" name="myform" action="/index.php/admin_ads/add_handle/<?php echo $selected_catid; ?>" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">添加广告</th>
    </tr>
    <tr>
      <td align="right">广告所属分类：</td>
      <td>
        <select name="cat_id">
	    <?php foreach($cats['parent'] as $pkey=>$pval){ ?>
		  <option value="<?php echo $pval->cat_id; ?>"  disabled="disabled"><?php echo $pval->name; ?></option>
		  <?php foreach($cats['son'][$pval->cat_id] as $skey=>$sonval){ ?>
		  <option value="<?php echo $sonval->cat_id; ?>" disabled="disabled"  <?php echo $selected_catid==$sonval->cat_id?'selected':''; ?>>&nbsp;&nbsp;||--&nbsp;<?php echo $sonval->name; ?></option>
		    <?php foreach($cats['sonson'][$sonval->cat_id] as $sonsonval){ ?>
			<option value="<?php echo $sonsonval->cat_id; ?>" <?php if($sonsonval->cat_type_id!==$category[0]->cat_type_id){ echo 'disabled="disabled"';} ?>  <?php echo $selected_catid==$sonsonval->cat_id?'selected':''; ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|||--&nbsp;<?php echo $sonsonval->name; ?></option>
			<?php } ?>
		  <?php } ?>
		<?php } ?>
        </select> 
      </td>
    </tr>
    
    <tr>
      <td align="right">广告链接地址：</td>
      <td>
        <input type="text" name="link" maxlength="255" class="input" dataType="require" title="广告链接地址,输入长度不能超过255个字符" value="" style="width:360px;" />
      </td>
    </tr>
    
	 <tr>
      <td align="right">广告图片：</td>
      <td>
        <input type="text" name="thumb" maxlength="255" class="input" dataType="require" title="请上传广告图片或输入广告图片地址，输入长度不能超过255个字符" value="" style="width:300px;float:left;" />
        <iframe frameborder="0" src="/public/upload.php?upname=thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
      </td>
    </tr>
	
    <tr>
      <td align="right">广告介绍：</td>
      <td>
	    <textarea name="content" maxlength="200" cols="65" rows="8" title="请输入广告介绍，输入长度不能超过200个字符"></textarea>
	  </td>
    </tr>

	<tr>
      <td align="right"><font color="red">*&nbsp;</font>序号：</td>
      <td>
        <input type="text" name="sort" maxlength="8" value="0" size="8" >
	    <font color="red">数值越大越靠前</font>
      </td>
    </tr>

    <tr>
      <td align="right">发布状态：</td>
      <td>
        <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" <?php if($category[0]->shenhe=='1' and $user_group > 1){ echo 'disabled="disabled"';}else{echo 'checked';} ?>><label>显示</label> &nbsp;&nbsp;<input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;" <?php if($category[0]->shenhe=='1' and $user_group > 1){ echo 'checked';}else{echo '';} ?> ><label>待审</label>
	    <?php if($category[0]->shenhe=='1' and $user_group > 1){?> &nbsp;<font color="#FF0000">*&nbsp;本分类下文章需要超级管理员审核后显示</font><?php }?>
      </td>
    </tr>
    <tr>
      <td align="right"></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />

      </td>
    </tr>
	
  </table>
</form>
</div>
</body>


</html>

