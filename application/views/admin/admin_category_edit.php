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
function checkdata()
{		
	document.myform.name.value = trim(document.myform.name.value);
	if(document.myform.name.value!="") {
		document.myform.name.value=clearSpecialChar(document.myform.name.value);
	}else{
		alert("分类名称不能为空！");
		document.myform.name.focus();
		return false;
	}

	document.myform.cat_thumb.value = trim(document.myform.cat_thumb.value);	
	if(document.myform.cat_thumb.value!="") {
		var url = document.myform.cat_thumb.value;
		if(!check_isRelativePath(url) && !check_isURL(url)) {
			alert("分类图标填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
			document.myform.cat_thumb.focus();
			return false;
		}
	}
	
	<?php if($select_type_id=='7'){?>
	document.myform.banner_thumb.value = trim(document.myform.banner_thumb.value);	
	if(document.myform.banner_thumb.value!="") {
		var url = document.myform.banner_thumb.value;
		if(!check_isRelativePath(url) && !check_isURL(url)) {
			alert("头部BANANE大图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
			document.myform.banner_thumb.focus();
			return false;
		}
	}

	if(document.myform.topic_ad1.value!="") {
		var url = document.myform.topic_ad1.value;
		if(!check_isRelativePath(url) && !check_isURL(url)) {
			alert("中间右侧广告图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
			document.myform.topic_ad1.focus();
			return false;
		}
	}

	if(document.myform.topic_ad1_link.value!="") {
		var url = document.myform.topic_ad1_link.value;
		if(!check_isURL(url)){ 
			alert("中间右侧广告链接地址输入的URL无效，填写的路径必需以 http:// 开头!");
			document.myform.topic_ad1_link.focus(); 
			return false; 
		}
	}

	if(document.myform.topic_ad2.value!="") {
		var url = document.myform.topic_ad2.value;
		if(!check_isRelativePath(url) && !check_isURL(url)) {
			alert("中间通栏广告图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
			document.myform.topic_ad2.focus();
			return false;
		}
	}

	if(document.myform.topic_ad2_link.value!="") {
		var url = document.myform.topic_ad2_link.value;
		if(!check_isURL(url)){ 
			alert("中间通栏广告链接地址输入的URL无效!");
			document.myform.topic_ad2_link.focus(); 
			return false; 
		}
	}
	<?php }?>

	<?php if($select_type_id=='8'){ ?>
	if(document.myform.is_float_ad.checked) {
		var url = document.myform.float_ad.value;
		if(!check_isRelativePath(url) && !check_isURL(url)) {
			alert("漂浮广告图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
			document.myform.float_ad.focus(); 
			return false; 
		}
	}

	if(document.myform.is_float_ad.checked) {
		var url = document.myform.float_ad_link.value;
		if(!check_isURL(url)){ 
			alert("漂浮广告链接输入的的URL无效，填写的路径必需以 http:// 开头！");
			document.myform.float_ad_link.focus(); 
			return false; 
		}
	}
	<?php } ?>
	
	if(document.myform.is_redirect.checked) {
		var url = document.myform.redirect_url.value;
		if(!check_isURL(url)){ 
			alert("转向连接输入的URL无效!");
			document.myform.redirect_url.focus(); 
			return false; 
		}
	}

	if(document.myform.sort.value!="") {
		if(!check_isIntger(document.myform.sort.value) || document.myform.sort.value<0) {
			alert("排序必需填写大于或等于0的整数!");
			document.myform.sort.focus();
			return false;
		}
	}
}
</script>
</head>

<body>
<div class="wrap">
<form method="post" name="myform" action="/index.php/admin_category/edit_handle/<?php echo $cat['0']->cat_id;?>" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑分类</th>
    </tr>
    <tr>
      <td align="right">上级分类：</td>
      <td>
      <select name="parent_id">
	  <?php foreach($cats as $fval){ ?>
	    <?php if($fval->cat_id != $cat['0']->cat_id ){ ?>
		<option value="<?php echo $fval->cat_id; ?>" <?php echo $cat['0']->parent_id==$fval->cat_id?"selected":''; ?>><?php echo $fval->name; ?></option>
		<?php foreach($cats_son[$fval->cat_id] as $sonval){ ?>
		<option value="<?php echo $sonval->cat_id; ?>" <?php echo $cat['0']->parent_id==$sonval->cat_id?"selected":''; ?>>&nbsp;&nbsp;|__<?php echo $sonval->name; ?></option>';
		<?php } ?>
		<?php }	?>
	  <?php } ?>
	    <option value="0" <?php echo $cat['0']->parent_id=='0'?"selected":''; ?>>顶级分类</option>
	  </select><!--&nbsp;<a href="/index.php/admin_category/">重选分类</a>-->
	  </td>
    </tr>
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类名称：</td>
      <td><input type="text" name="name" maxlength="20" size="25" class="input" dataType="require" title="请输入分类名称，长度不能超过20个字符" value="<?php echo $cat['0']->name; ?>" /></td>
    </tr>
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类属性：</td>
      <td><select name="cat_type_id" disabled="disabled">
         <?php foreach($cat_type as $ctval){ ?>
          <option value="<?php echo $ctval->id; ?>" <?php echo $ctval->id==$cat['0']->cat_type_id?'selected':"";?>><?php echo $ctval->name; ?></option>
         <?php } ?>
        </select>&nbsp;<font color="red">选定后将不能进行修改，请慎重选择</font></td>
    </tr>
	
	<tr>
      <td align="right">分类图标：
      <?php if($select_type_id=='7'){?>	<br ><small style="color:red;font-size:10px;">(建议尺寸228*100px)<?php }?></td>
      <td>
        <input type="text" name="cat_thumb" class="input" dataType="require" title="请上传分类图标或输入分类图标地址" value="<?php echo $cat['0']->cat_thumb; ?>" style="width:300px;" />
        <iframe frameborder="0" src="/public/upload.php?upname=cat_thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
      </td>
    </tr>
    
	<?php if($select_type_id=='7'){?>	
	<tr>
      <td align="right">头部BANANE大图：<br ><small style="color:red;font-size:10px;">(建议尺寸1140*240px)</small></td>
      <td>
        <input type="text" name="banner_thumb" class="input" dataType="require" title="请上传头部BANANE大图或输入头部BANANE大图地址" value="<?php echo $cat['0']->banner_thumb; ?>" style="width:300px;" />
      	<iframe frameborder="0" src="/public/upload.php?upname=banner_thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
      </td>
    </tr>
	<tr>
      <td align="right">中间右侧广告图： <br >
	    <small style="color:red;font-size:10px;">(建议尺寸390*265px)</small></td>
      <td>
        <input type="text" name="topic_ad1" class="input" dataType="require" title="请上传中间右侧广告图或输入中间右侧广告图地址" value="<?php echo $cat['0']->topic_ad1; ?>" style="width:300px;" />
        <iframe frameborder="0" src="/public/upload.php?upname=topic_ad1&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
	  </td>
    </tr>
	<tr>
      <td align="right">中间右侧广告链接地址：</td>
	  <td><input type="text" name="topic_ad1_link" class="input" dataType="require" title="请输入中间右侧广告链接地址" value="<?php echo $cat['0']->topic_ad1_link; ?>" style="width:606px;" /></td>
	</tr>
	<tr>
      <td align="right">中间通栏广告图：<br >
	    <small style="color:red;font-size:10px;">(建议尺寸1140*80px)</small></td>
      <td>
        <input type="text" name="topic_ad2" class="input" dataType="require" title="请上传中间通栏广告图或输入中间通栏广告图地址" value="<?php echo $cat['0']->topic_ad2; ?>" style="width:300px;" />
        <iframe frameborder="0" src="/public/upload.php?upname=topic_ad2&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
      </td>
    </tr>
	<tr>
      <td align="right">中间通栏广告链接地址：</td>
	  <td>
	    <input type="text" name="topic_ad2_link" class="input" dataType="require" title="请输入中间通栏广告链接地址" value="<?php echo $cat['0']->topic_ad2_link; ?>" style="width:606px;" />
	  </td>
	</tr>
	<?php } ?>
	
    <tr>
      <td align="right">分类简介：</td>
      <td><textarea name="content" maxlength="200" cols="58" rows="5" title="请输入分类简介，输入长度不能超过200个字符"><?php echo $cat['0']->content; ?></textarea>  </td>
    </tr>
    
    <?php if($select_type_id=='8'){?>	
    <tr>
      <td align="right">漂浮广告启用：</td>
      <td>
        <label style="float:left;">启用</label><input type="checkbox" name="is_float_ad" value="1" class="input" style="vertical-align: middle;margin-right:3px; float:left;" <?php echo $cat['0']->is_float_ad=='1'?'checked':''; ?>>
        &nbsp;<font color="red">取消勾选，则漂浮广告不在页面显示</font>
      </td>
    </tr>

    <tr>
      <td align="right">漂浮广告图：</td>
      <td>
        <input type="text" name="float_ad" class="input" dataType="require" title="请上传漂浮广告图或输入漂浮广告图地址" value="<?php echo $cat['0']->float_ad; ?>" style="width:300px;" />
        <iframe frameborder="0" src="/public/upload.php?upname=float_ad&forname=myform" width="390" height="28" scrolling="no" align="middle"></iframe> 
      </td>
    </tr>
    
    <tr>
      <td align="right">漂浮广告链接：</td>
      <td>
        <input type="text" name="float_ad_link" class="input" dataType="require" title="请上输入漂浮广告链接地址" value="<?php echo $cat['0']->float_ad_link; ?>" style="width:300px;" />
      </td>
    </tr>
    <?php } ?>
    
	<tr>
      <td align="right">是否作为导航菜单：</td>
      <td><input type="radio" name="is_menu" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $cat['0']->is_menu=='1'?'checked':''; ?>><label>是</label>
	  &nbsp;&nbsp;
	  <input type="radio" name="is_menu" <?php echo $cat['0']->is_menu=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;"><label>否</label>&nbsp;<font color="#FF0000"></font></td>
    </tr>
	
	<tr>
      <td align="right">转向连接：</td>
      <td>
        <label style="float:left;">启用</label><input type="checkbox" name="is_redirect" value="1" class="input" style="vertical-align: middle;margin-right:3px; float:left;" <?php echo $cat['0']->is_redirect=='1'?'checked':''; ?>>
	    <input type="text" name="redirect_url" size="50" class="input" style="float:left;" value="<?php echo $cat['0']->redirect_url; ?>" title="请输入转向连接"/>&nbsp;<font color="red">可跳转到指定地址（不允许发布内容），如专题或外站链接</font>
	  </td>
    </tr>

    <tr>
      <td align="right"><font color="red">*&nbsp;</font>排 序：</td>
      <td><input type="text" name="sort" size="6" class="input" value="<?php echo $cat['0']->sort; ?>" />&nbsp;<font color="#FF0000">数值越大越靠前</font></td>
    </tr>
     <tr>
      <td align="right">是否需要审核：</td>
      <td>
        <input type="radio" name="shenhe" <?php echo $cat['0']->shenhe=='1'?'checked':''; ?> value="1" style="vertical-align: middle;margin-right:3px;"><label>需要</label>
	    &nbsp;&nbsp;
	    <input type="radio" name="shenhe" <?php echo $cat['0']->shenhe=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;"><label>不需要</label>&nbsp;
	  </td>
    </tr>
   
    <tr>
      <td align="right">状 态：</td>
      <td>
       <input type="radio" name="status" <?php echo $cat['0']->status=='1'?'checked':''; ?> value="1" style="vertical-align: middle;margin-right:3px;" ><label>显示</label> &nbsp;&nbsp;<input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;" <?php echo $cat['0']->status=='0'?'checked':''; ?>><label>隐藏</label>
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

