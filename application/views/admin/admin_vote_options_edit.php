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

<script charset="utf-8" src="/public/formvalid/valid.js"></script>

<script language="javascript">
	function checkdata() {
		var isChecked = true;

		$("input[id='option']").each(function(){ 
			title = trim($(this).attr('value'));
			if(title=="") {
				alert("选项内容不能为空！"); 
				isChecked = false;
			}
		});
		
		$("input[id='sort']").each(function(){ 
			sort = $(this).attr('value');
			if(!check_isIntger(sort) || sort < 0) {
				alert("序号必需填写大于或等于0的整数，“" + sort + "”不是有效值，请重新输入！"); 
				isChecked = false;
			}
		});
		
		if(!isChecked){
			return false;
		}
	}
</script>

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
<form name="myform" method="post" action="/index.php/admin_vote/edit_options_handle/<?php echo $qrows[0]->q_id; ?>" class="ajax_form" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
  
    <tr>
      <th colspan="2">[编辑] &nbsp;<?php echo htmlspecialchars($qrows[0]->title); ?></th>
    </tr>
    
	<?php foreach($oprows as $opval){ ?>
    <tr>
      <td width="50%" align="right">
        选项内容
        <input id="option" type="text" name="op[<?php echo $opval->op_id; ?>]" maxlength="50" class="input" value="<?php echo htmlspecialchars($opval->title); ?>" title="输入长度不能超过50个字符" style="width:390px;">
      </td>
      <td align="left">
        序号
        <input id="sort" type="text" name="sort[<?php echo $opval->op_id; ?>]" maxlength="8" size="6" value="<?php echo $opval->sort; ?>">&nbsp;
        <font color="red">按序号从高到低排列</font>
      </td>
    </tr>
	<?php } ?>
    
    <tr>
      <td colspan="2" align="center"> 
        <input type="submit" value="提 交" class="btn ajax_btn" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.back()" />

      </td>
    </tr>
	
  </table>
</form>
</div>
</body>


</html>

