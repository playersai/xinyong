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
<link rel="stylesheet" href="/public/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="/public/kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="/public/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/public/kindeditor/lang/zh-CN.js"></script>
<script charset="utf-8" src="/public/kindeditor/plugins/code/prettify.js"></script>

<script charset="utf-8" src="/public/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8" src="/public/formvalid/valid.js"></script>

<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : '/public/kindeditor/plugins/code/prettify.css',
			uploadJson : '/public/kindeditor/php/upload_json.php',
			fileManagerJson : '/public/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>

<script language="javascript">
	function checkdata()
	{
		document.myform.name.value = trim(document.myform.name.value);
		if(document.myform.name.value=="") {
			alert("分类名称不能为空!");
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

		if(document.myform.stats.value!="") {
			if(!check_isIntger(document.myform.stats.value) || document.myform.stats.value<0) {
				alert("阅读数必需填写大于或等于0的整数!");
				document.myform.sort.focus();
				return false;
			}
		}
	}

</script>
</head>

<body>
<div class="wrap">
<form method="post" name="myform" action="/index.php/admin_category/edit1_handle/<?php echo $cat['0']->cat_id; ?>" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑分类</th>
    </tr>
    <tr>
      <td align="right">上级分类：</td>
      <td>
        <select name="parent_id">
	    <?php foreach($cats as $fval): ?>
	      <?php if($fval->cat_id != $cat['0']->cat_id ){ ?>
	      <option value="<?php echo $fval->cat_id; ?>" <?php if($fval->cat_type_id!==$category[0]->cat_type_id){ echo 'disabled="disabled"';} ?> <?php echo $cat['0']->parent_id==$fval->cat_id?"selected":''; ?>><?php echo $fval->name; ?></option>
		  <?php foreach($cats_son[$fval->cat_id] as $sonval): ?>
		  <option value="<?php echo $sonval->cat_id; ?>" <?php if($sonval->cat_type_id!==$category[0]->cat_type_id){ echo 'disabled="disabled"';} ?> <?php echo $cat['0']->parent_id==$sonval->cat_id?"selected":''; ?>>&nbsp;&nbsp;|__<?php echo $sonval->name; ?></option>';
		  <?php endforeach; ?>
	      <?php } ?>
	    <?php endforeach;?>
	      <option value="0" <?php echo $cat['0']->parent_id=='0'?"selected":''; ?>>顶级分类</option>
        </select> &nbsp;<!--a href="/index.php/admin_category/">重选分类</a-->
      </td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类名称：</td>
      <td><input type="text" name="name" maxlength="20" class="input" dataType="require" title="请输入分类名称，输入长度不能超过20个字符" value="<?php echo htmlspecialchars($cat['0']->name); ?>" style="width:360px;" /></td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>分类属性：</td>
      <td><select name="cat_type_id" disabled="disabled">
        <?php foreach($cat_type as $ctval){ ?>
          <option value="<?php echo $ctval->id; ?>" <?php echo $ctval->id==$cat['0']->cat_type_id?'selected':"";?>><?php echo $ctval->name; ?></option>
        <?php } ?>
        </select>&nbsp;<font color="red"></font></td>
    </tr>
    
	<tr>
      <td align="right">分类图标：</td>
      <td>
        <input type="text" name="cat_thumb" class="input" dataType="require" title="请输入名称" value="<?php echo $cat['0']->cat_thumb; ?>" style="width:360px;" />
	    <iframe frameborder="0" src="/public/upload.php?upname=cat_thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe> 
	  </td>
    </tr>
	<tr>
      <td align="right">分类简介：</td>
      <td><textarea name="content" style="width:700px;" rows="5"><?php echo htmlspecialchars($cat['0']->content); ?></textarea>  </td>
    </tr>
    <tr>
      <td align="right">分类详情：</td>
      <td>
	    <textarea name="content1" style="width:700px;height:390px;visibility:hidden;"><?php echo $content1; ?></textarea>
      </td>
    </tr>
    <!-- 
	<tr>
      <td align="right">是否作为导航菜单：</td>
      <td><input type="radio" name="is_menu" value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $cat['0']->is_menu=='1'?'checked':''; ?>><label>是</label>
	  &nbsp;&nbsp;
	  <input type="radio" name="is_menu" <?php echo $cat['0']->is_menu=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;"><label>否</label>&nbsp;<font color="#FF0000"></font></td>
    </tr>
     -->
 
    <tr>
      <td align="right">发布日期：</td>
      <td><input  name="rel_date" class="Wdate" type="text" onClick="WdatePicker()" dataType="require" title="请输入发布日期" value="<?php echo $rel_date==0 ? date('Y-m-d',time()) : date('Y-m-d',$rel_date);?>" style="width:300px;" readonly /> </td>
    </tr>
    
	<tr>
      <td align="right">转向连接：</td>
      <td><label>启用</label><input type="checkbox" name="is_redirect" value="1" class="input" style="vertical-align: middle;margin-right:3px;" <?php echo $cat['0']->is_redirect=='1'?'checked':''; ?>>
	  <input type="text" name="redirect_url" size="50" class="input" value="<?php echo $cat['0']->redirect_url; ?>" />&nbsp;<font color="red">可跳转到指定地址（不允许发布内容）,如专题或外站链接</font></td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>排 序：</td>
      <td><input type="text" name="sort" maxlength="8" size="6" class="input" value="<?php echo $cat['0']->sort; ?>" />&nbsp;<font color="red">数值越大越靠前</font></td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>阅读数：</td>
      <td><input type="text" name="stats" maxlength="8" size="6" class="input" value="<?php echo $stats; ?>" /></td>
    </tr>
    
    <!-- 
	<tr>
      <td align="right">是否需要审核：</td>
      <td><input type="radio" name="shenhe" <?php echo $cat['0']->shenhe=='1'?'checked':''; ?> value="1" style="vertical-align: middle;margin-right:3px;"><label>需要</label>
	  &nbsp;&nbsp;
	  <input type="radio" name="shenhe" <?php echo $cat['0']->shenhe=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;"><label>不需要</label>&nbsp;<font color="#FF0000">本设置只对普通管理员生效</font></td>
    </tr>
    -->
    
    <tr>
      <td align="right">发布状态：</td>
      <td>
        <?php if($_SESSION['group_id']=='1'): ?>
        <input type="radio" name="status" <?php echo $cat['0']->status=='1'?'checked':''; ?> value="1" style="vertical-align: middle;margin-right:3px;" ><label>显示</label>
        <input type="radio" name="status" <?php echo $cat['0']->status=='0'?'checked':''; ?> value="0" style="vertical-align: middle;margin-right:3px;" ><label>待审</label>
        <?php else: ?>  
          <?php if($rows->status=='1'): ?>
	      <label>显示</label>
	      <?php else:?>
	      <label>待审</label>
	      <?php endif;?>
	    <font color="red">&nbsp;（待超级管理员审核通过后，当前内容方可显示）</font>
        <?php endif;?>
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

