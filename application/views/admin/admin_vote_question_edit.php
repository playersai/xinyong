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
		document.myform.title.value = trim(document.myform.title.value);
		if(document.myform.title.value==""){
			alert("选项标题不能为空!");
			document.myform.title.focus();
			return false;
		}
	}

</script>

</head>

<body>
<div class="wrap">
<form method="post" action="/index.php/admin_vote/edit_question_handle/<?php echo $rows[0]->q_id; ?>" class="ajax_form" name="myform" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑投票问题</th>
    </tr>
    
    <tr>
      <td align="right">选项标题：</td>
      <td><input type="text" name="title" maxlength="50" class="input" dataType="require" title="请输入选项标题，输入长度不能超过50个字符" value="<?php echo htmlspecialchars($rows[0]->title); ?>" style="width:360px;" /></td>
    </tr>
    
	<tr>
      <td align="right">选项类型：</td>
      <td>
        <input type="radio" name="xx_type" dataType="require"  value="1" style="vertical-align:middle;" <?php if($rows[0]->xx_type=='1') echo 'checked'; ?> /> <label>单选</label>
	    <input type="radio" name="xx_type"  dataType="require" value="2" style="vertical-align:middle;" <?php if($rows[0]->xx_type=='2') echo 'checked'; ?> /> <label>多选</label>
	    <!--input type="radio" name="xx_type"  dataType="require"  value="3" style="vertical-align:middle;" <?php if($rows[0]->xx_type=='3') echo 'checked'; ?> /> <label>文本回复</label> &nbsp;&nbsp;<font color="#FF0000">(*类型选文本回复时无需设置选项)</font-->
	  </td>
    </tr>
	<tr>
      <td align="right">一行显示多少选项：</td>
      <td><select name="colspan">
	  <?php for($i=1;$i<=15;$i++){ ?>
	  <option value="<?php echo $i; ?>" <?php if($i==$rows[0]->colspan) echo 'selected'; ?>><?php echo $i; ?></option>
	  <?php } ?>
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

