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

</head>

<body>
<div class="wrap">
<form method="post" action="/index.php/admin_photo/add_handle/" class="ajax_form" name="myform">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">添加图片集</th>
    </tr>
    <tr>
      <td align="right">所属分类：</td>
      <td><select name="cat_id" style="padding:1px 10px 1px 2px;">
	  <?php
	  
		if(is_array($cats)){
			foreach($cats['parent'] as $pkey=>$pval){
			
			?>
			 <option value="<?php echo $pval->cat_id; ?>" <?php echo $selected_catid==$pval->cat_id?'selected':''; ?> ><?php echo $pval->name; ?></option>
				<?php if(is_array($cats['son']) and isset($cats['son'][$pkey])){
				foreach($cats['son'][$pkey] as $skey=>$sonval){
				?>
				 <option value="<?php echo $sonval->cat_id; ?>"  <?php echo $selected_catid==$sonval->cat_id?'selected':''; ?>>&nbsp;||--&nbsp;<?php echo $sonval->name; ?></option>
				<?php 
				if(is_array($cats['son'][$skey]) and isset($cats['son'][$skey]) ){
				foreach($cats['son'][$skey] as $sonsonval){
				?>
				 <option value="<?php echo $sonsonval->cat_id; ?>" <?php echo $selected_catid==$sonsonval->cat_id?'selected':''; ?> >&nbsp;&nbsp;&nbsp;|||--&nbsp;<?php echo $sonsonval->name; ?></option>
				<?php }} 
				}
				}
				?>
			
		
		
			<?php
			}
				
				
		}
	  ?>
	  
	 
       
		
        
        </select> </td>
    </tr>
    <tr>
      <td align="right">标题：</td>
      <td><input type="text" name="title" class="input" dataType="require" title="请输入名称" value="" style="width:360px;" /></td>
    </tr>
    <tr>
      <td align="right">封面图：</td>
      <td><input type="text" name="thumb" class="input" dataType="require" title="请输入名称" value="" style="width:300px;" />
	 
      <iframe frameborder="0" src="/public/upload.php?upname=thumb&forname=myform" width="390" height="35" scrolling="no" align="middle"></iframe>
	  </td>
    </tr>
	
    <tr>
      <td align="right">图片集介绍：</td>
      <td>
	  <textarea name="content1" style="width:700px;height:290px;visibility:hidden;">
	  
	  
	  </textarea>
</td>
    </tr>
	
	<tr>
      <td align="right">图片地址：</td>
      <td style="height:300px;">
		<ul id="xx">
		<?php $ii=16; for($i=1;$i <= $ii;$i++){?>
		<li style="display:block;width:550px;margin:6xp 0;height:35px;padding:16px;">
		<label style="width:39px;text-align:right;display:block;float:left;">图片<?php echo $i; ?></label><span style="width:85%">
		<div style="float:left;">
		<input type="text" name="thumbs<?php echo $i?>" value="" style="width:200px;float:left;">
		</div></span>
		<div style="width:288px;float:left;vertical-align:bottom;background-color:#fff;padding-left:6px;margin-top:-10px;"><iframe frameborder="0" src="/index.php/upload/index/myform/thumbs<?php echo $i; ?>" width="300" height="39" scrolling="no"  align="top"></iframe> </div>
		
		
		 
		  
		
		<div style="clear:both;padding:3px 0"></div>
		<p style="margin:6px 0;">
		<label style="width:39px;text-align:right;display:block;float:left;">简介<?php echo $i; ?></label><span style="width:85%">
		<textarea style="width:360px;float:left;height:50px;" name="t_content[<?php echo $i; ?>]"></textarea>
		</span>
		<label style="width:39px;text-align:right;display:block;float:left;">序号</label><input type="text" size="12" name="sort[<?php echo $i; ?>]" style="width:100px;float:left;" placeholder="从高->低排序">
		</p>
		</li>
		<div style="clear:both;padding:6px 0;border-bottom:1px dashed #ddd;"></div>
		
		<?php }?>
		
	  </ul>
	  
	  
</td>
    </tr>
	
	
	<tr>
      <td align="right">推荐操作：</td>
      <td><input type="checkbox" name="settop" value="1" style="vertical-align: middle;margin-right:3px;padding:0;" ><label>置顶</label>
	  &nbsp;&nbsp;
	  <input type="checkbox" name="index_top"  value="1" style="vertical-align: middle;margin-right:3px;padding:0;"><label>首页头条</label>&nbsp;<font color="#FF0000"></font></td>
    </tr>
	

    <tr>
      <td align="right">阅读数：</td>
      <td><input type="text" name="stats" size="6" class="input" value="<?php echo rand(50,220);?>" />&nbsp;<font color="#FF0000">*&nbsp;前台显示阅读数</font></td>
    </tr>
	
   
    <tr>
      <td align="right">发布状态：</td>
      <td>
       <input type="radio" name="status" value="1" style="vertical-align: middle;margin-right:3px;padding:0;" <?php if($category[0]->shenhe=='1' and $user_group > 1){ echo 'disabled="disabled"';}else{echo 'checked';} ?>><label>显示</label> &nbsp;&nbsp;<input type="radio" name="status" value="0" style="vertical-align: middle;margin-right:3px;padding:0;" <?php if($category[0]->shenhe=='1' and $user_group > 1){ echo 'checked';}else{echo '';} ?> ><label>待审</label>
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

