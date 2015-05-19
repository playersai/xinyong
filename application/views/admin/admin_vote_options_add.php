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

<script>
	function checkdata(){
		var isAllNull = true;

		$("input[id='option']").each(function(){ 
			title = trim($(this).attr('value'));
			if(title!="") {
				isAllNull = false;
			}
		});

		if(isAllNull){
			alert("请填写需要添加的选项内容！")
			return false;
		}
	}

</script>


</head>

<body>
<div class="wrap">
<form method="post" action="/index.php/admin_vote/add_options_handle/<?php echo $qrows[0]->q_id; ?>" class="ajax_form" name="myform" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
  
    <tr>
      <th colspan="2">[新增]<?php echo htmlspecialchars($qrows[0]->title); ?> 选项</th>
	   
    </tr>
    <tr>
      <td align="right" clospan="1">已有选项：</td><td>
	  <?php foreach($oprows as $opval){ ?>
        <?php echo htmlspecialchars($opval->title); ?><br />
      <?php } ?>
      </td>
    </tr>
	<tr>
      <td align="right">新增选项：</td>
      <td style="height:300px;">
		<ul id="xx">
		<?php $ii=16; for($i=1;$i <= $ii;$i++){?>
		<li style="display:block;width:100%;margin:6xp 0;height:35px;">
		  <label style="width:39px;text-align:right;display:block;float:left;"><?php echo $i; ?></label>
		  <span style="width:80%">
		    <input id="option" type="text" name="options[]" value="" style="width:350px;height:22px;float:left;">
		    <!-- <label style="width:39px;text-align:right;display:block;float:left;">序号</label> -->
		    <!-- <input type="text" size="6" name="sort" maxlength="8" style="height:22px;" value="0" title="请输入序号">&nbsp;&nbsp;<font color="red">按从高到低排列</font> -->
		  </span>
		</li>
		<div style="clear:both"></div>
		
		<?php }?>
		
	  </ul>
	  
	  
</td>
    </tr>
    
	
    <tr>
      <td colspan="2" align="center"> 
        <input type="submit" value="提 交" class="btn ajax_btn" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />

      </td>
    </tr>
	
  </table>
</form>
</div>
</body>


</html>

