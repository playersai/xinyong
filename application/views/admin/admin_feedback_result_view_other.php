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

  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">查看网上征集详情(<?php echo $rows->f_title ;?>)</th>
    </tr>

	<tr>
      <td align="right"  width="129">姓名：</td>
      <td> <?php echo isset($rows->nickname)?htmlspecialchars($rows->nickname):htmlspecialchars($rows->contact_name); ?></td>
    </tr>
    
	<!-- 
	<tr>
      <td align="right"  width="129">手机号码：</td>
      <td><?php echo $rows->mobile; ?></td>
    </tr> 
	
	<tr>
      <td align="right">联系地址：</td>
      <td><?php echo $rows->address; ?></td>
    </tr>
    
	<tr>
      <td align="right">E-mail：</td>
      <td><?php echo $rows->email; ?></td>
    </tr>
    
	<tr>
      <td align="right">是否公开：</td>
      <td><?php echo $rows->is_show=='1'?'公开':'不公开'; ?></td>
    </tr>
    -->
	
    <tr>
      <td align="right" valign="top">征集内容：</td>
      <td align="left" valign="top" style="">
        <textarea name="ct" style="width:700px;height:220px;padding:0;" readonly><?php echo $rows->content; ?></textarea>
      </td>
    </tr>
  </table>
 
  <form name="example" method="post" action="/index.php/admin_feedback/reply_handle/<?php echo $rows->f_c_id.'/'.$rows->f_id; ?>/<?php echo isset($f_reply[0])?'1':0;?>" class="ajax_form" >
  <table cellspacing="1" class="myform">
    <tr>
      <td align="right" width="129">当前状态：</td>
      <td>
	      <strong>
	      <?php
		  switch($rows->status)
		  {
			case '0' : echo '待审核'; break;
			case '2' : echo '已审核，正常显示'; break;
			default: echo '待审核'; break;
		  } ?>
		  </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
      </td>
    </tr>
	
    <tr>
      <td align="right">将状态更改为</td>
      <td>
	  <input type="radio" name="status" value="0" style="vertical-align:middle;padding:0px;" <?php if($rows->status==0) echo 'checked';?>><label>待审核</label>
	  <input type="radio" name="status" value="2" style="vertical-align:middle;padding:0px;" <?php if($rows->status==2) echo 'checked';?>><label>已审核，正常显示</label>
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

