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
	function checkdata() {
		document.myform.title.value = trim(document.myform.title.value);
		if(document.myform.title.value==""){
			alert("文章标题不能为空!");
			document.myform.title.focus();
			return false;
		}

		document.myform.thumb.value = trim(document.myform.thumb.value);	
		if(document.myform.thumb.value!="") {
			var url = document.myform.thumb.value;
			if(!check_isRelativePath(url) && !check_isURL(url)) {
				alert("缩略图填写的路径无效，填写的路径必需以 http:// 或 / 开头！");
				document.myform.thumb.focus();
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
				document.myform.stats.focus();
				return false;
			}
		}
	}

</script>
</head>

<body>
<div class="wrap">
<form method="post" name="myform" action="/index.php/admin_article/edit_handle/<?php echo $rows->aid.'/'.$rows->cat_id.'/'.$rows->status; ?>" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑文章</th>
    </tr>
    <tr>
      <td align="right">所属分类：</td>
      <td>
      <select name="cat_id">
	  <?php foreach($cats['parent'] as $pkey=>$pval){ ?>
			 <option value="<?php echo $pval->cat_id; ?>" <?php echo $selected_catid==$pval->cat_id?'selected':''; ?> disabled="disabled"><?php echo $pval->name; ?></option>
				<?php if(is_array($cats['son']) and isset($cats['son'][$pval->cat_id])){
				foreach($cats['son'][$pval->cat_id] as $skey=>$sonval){
				?>
				 <option value="<?php echo $sonval->cat_id; ?>" disabled="disabled"  <?php echo $selected_catid==$sonval->cat_id?'selected':''; ?>>&nbsp;&nbsp;||--&nbsp;<?php echo $sonval->name; ?></option>
				<?php 
				if(is_array($cats['sonson'][$sonval->cat_id]) and isset($cats['sonson'][$sonval->cat_id]) ){
				foreach($cats['sonson'][$sonval->cat_id] as $sonsonval){
				?>
				 <option value="<?php echo $sonsonval->cat_id; ?>" <?php if($sonsonval->cat_type_id!==$category[0]->cat_type_id){ echo 'disabled="disabled"';} ?>  <?php echo $selected_catid==$sonsonval->cat_id?'selected':''; ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|||--&nbsp;<?php echo $sonsonval->name; ?></option>
				<?php }} 
				}
				}
				?>
			
	  <?php } ?>
	  </select> 
	  </td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>文章标题：</td>
      <td><input type="text" name="title" class="input" maxlength="50" dataType="require" title="请输入文章标题，输入长度不能超过50个字符" value="<?php echo htmlspecialchars($rows->title); ?>" style="width:360px;" /></td>
    </tr>
    
    <tr>
      <td align="right">发布日期：</td>
      <td><input  name="rel_date" class="Wdate" type="text" onClick="WdatePicker()" dataType="require" title="请输入发布日期" value="<?php echo date('Y-m-d',$rows->rel_date);?>" style="width:360px;" readonly /> </td>
    </tr>
            
	<tr>
      <td align="right">来源：</td>
      <td><input type="text" name="afrom" class="input" maxlength="30" dataType="require" title="请输入来源，输入长度不能超过20个字符" value="<?php echo htmlspecialchars($rows->afrom); ?>" style="width:360px;" /> </td>
    </tr>
    
	<tr>
      <td align="right">作者：</td>
      <td><input type="text" name="author" class="input" maxlength="30" dataType="require" title="请输入作者，输入长度不能超过20个字符" value="<?php echo htmlspecialchars($rows->author); ?>" style="width:360px;" /> </td>
    </tr>
    
    <tr>
      <td align="right">缩略图：</td>
      <td>
        <input type="text" name="thumb" class="input" dataType="require" title="请上传缩略图或输入缩略图地址" value="<?php echo $rows->thumb; ?>" style="width:360px; float:left;" />  
        <iframe frameborder="0" src="/public/upload.php?upname=thumb&forname=myform" width="390" height="22" scrolling="no" align="middle"></iframe>
      </td>
    </tr>
    
    <tr>
      <td align="right">文章详情：</td>
      <td>
	    <textarea name="content1" style="width:700px;height:390px;visibility:hidden;">
	    <?php echo $rows->content; ?>
	    </textarea>
	  </td>
    </tr>
    
    <?php if($rows->cat_id==5):?>
	<tr>
      <td align="right">推荐操作：</td>
      <td>
      	<!-- <input type="checkbox" name="settop" value="1" <?php echo $rows->settop=='1'?'checked':''; ?> style="vertical-align: middle;margin-right:3px;" ><label>置顶</label>
	  	&nbsp;&nbsp; -->
	  	<input type="checkbox" name="index_top"  value="1" style="vertical-align: middle;margin-right:3px;" <?php echo $rows->index_top=='1'?'checked':''; ?>><label>首页头条</label>&nbsp;<font color="#FF0000"></font>
	  </td>
    </tr>
    <?php endif; ?>
	
	<tr>
      <td align="right">转向连接：</td>
      <td>
        <input type="checkbox" name="is_redirect" value="1" <?php echo $rows->is_redirect=='1'?'checked':''; ?> class="input" style="vertical-align: middle;margin-right:3px;" ><label>启用</label>
	    <input type="text" name="redirect_url" size="50" class="input" value="<?php echo $rows->redirect_url; ?>" title="请输入转向连接URL地址"/>&nbsp;<font color="#FF0000">启用后将直接跳转到指定地址（发布内容不显示）</font>
	  </td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>排序：</td>
      <td><input type="text" name="sort" size="6" class="input" maxlength="8" value="<?php echo $rows->sort; ?>" /></td>
    </tr>
    
    <tr>
      <td align="right"><font color="red">*&nbsp;</font>阅读数：</td>
      <td><input type="text" name="stats" size="6" class="input" maxlength="8" value="<?php echo $rows->stats; ?>" /></td>
    </tr>
	
    <tr>
      <td align="right">发布状态：</td>
      <td>
        <?php if($_SESSION['group_id']=='1'): ?>
        <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;" <?php if($rows->status=='1'){ echo 'checked';}  ?>><label>显示</label> 
        <input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;" <?php if($rows->status=='0'){ echo 'checked';}  ?>><label>待审</label>
	    <?php else:?>
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

