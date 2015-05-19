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
      <th colspan="2">查看网上投诉详情</th>
    </tr>
	<?php if($user_group=='1' ){ ?>
	<form method="post" action="/index.php/admin_feedback/handle_user/<?php echo $rows->f_c_id; ?>" class="ajax_form" name="user">
	 <tr>
      <td align="right" width="129">指派回复人：</td>
      <td>
	    <select name="handle_user">
	      <?php foreach($user_rows as $urval){ ?>
	      <option value="<?php echo $urval->username; ?>">指派【<?php echo $urval->nickname; ?>】【<?php echo $urval->username; ?>】为回复人</option>
	      <?php } ?>
	    </select>
	    <input type="submit" value="<?php echo isset($rows->handle_user)?"更新指派":'指派';?>" class="buttons" style="width:80px;height:22px;margin-left:5px; ">
	  	&nbsp;<?php if($rows->handle_user) {?>当前已指派【<?php echo $rows->handle_user; ?>】回复<?php }else {?>待超级管理员指派回复人<?php } ?>
	  </td>
    </tr>
	</form>
	
	<?php
	}
	else{
	?>
	 <tr>
      <td align="right" width="129">指派回复人：</td>
      <td> <?php echo isset($rows->handle_user)?'已指派（<strong>'.$rows->handle_user.'</strong>）进行回复':'待指定回复人'; ?>
	  
	 
	  </td>
	  
	  
    </tr>
	<?php
	}
	?>
    <tr>
      <td align="right" width="129">来信类别：</td>
      <td> <?php echo $rows->name; ?></td>
    </tr>
    <tr>
      <td align="right" width="129">诉求主题：</td>
      <td><?php echo htmlspecialchars($rows->title); ?></td>
    </tr>
    
	<tr>
      <td align="right">受理编号：</td>
      <td> <?php echo isset($rows->handle_id)?htmlspecialchars($rows->handle_id):htmlspecialchars($rows->handle_id); ?></td>
    </tr>
    <tr>
      <td align="right">查询密码：</td>
      <td> <?php echo isset($rows->query_password)?htmlspecialchars($rows->query_password):htmlspecialchars($rows->query_password); ?></td>
    </tr>
	<tr>
      <td align="right">用户姓名：</td>
      <td> <?php echo isset($rows->nickname)?htmlspecialchars($rows->nickname):htmlspecialchars($rows->contact_name); ?></td>
    </tr>
	<tr>
      <td align="right">手机号码：</td>
      <td><?php echo $rows->mobile; ?></td>
    </tr>
	
	<tr>
      <td align="right">联系地址：</td>
      <td><?php echo htmlspecialchars($rows->address); ?></td>
    </tr>
	<tr>
      <td align="right">E-mail：</td>
      <td><?php echo $rows->email; ?></td>
    </tr>
	<tr>
      <td align="right">是否公开：</td>
      <td><?php echo $rows->is_show=='1'?'公开':'不公开'; ?></td>
    </tr>
	
    <tr>
      <td align="right">投诉内容：</td>
      <td style="">
	    <textarea name="ct" style="width:700px;height:150px"><?php echo $rows->content; ?></textarea>
	  </td>
    </tr>
	
  </table>
  
  
  <form method="post" action="/index.php/admin_feedback/reply_handle/<?php echo $rows->f_c_id.'/'.$rows->f_id; ?>/<?php echo isset($f_reply[0])?'1':0;?>" class="ajax_form" name="example">
	<table cellspacing="1" class="myform">
	
	<?php if($user_group=='1' || $rows->handle_user==$_SESSION['manage']){ ?>
	<tr>
      <td align="right" width="129">回复投诉：</td>
      <td><textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo isset($f_reply[0]->content)?$f_reply[0]->content:'';?></textarea></td>
    </tr>
    <?php }else{ ?>
	<tr>
      <td align="right" width="129">回复投诉：</td>
      <td>您无权限回复操作!<?php echo isset($rows->handle_user)?'本投诉已指派（<strong>'.$rows->handle_user.'</strong>）进行回复':'待管理员指定回复人'; ?></td>
    </tr>
    <?php } ?>

    <tr>
      <td align="right">当前状态：</td>
      <td><strong>
      <?php switch($rows->status)
	  {
		case '0' : echo '待处理'; break;
		case '1' : echo '已回复'; break;
		case '2' : echo '已办结'; break;
		default: echo '待处理'; break;
	  
	  } ?></strong>&nbsp;( 状态分为以下三种:1.用户提交完投诉为待处理状态；2.指派回复人回复后为，已回复，等待确认管理员确认状态;3.管理员确认后，状态为已办结，正常显示 )
      </td>
    </tr>
    
	<?php if($user_group=='1'){ ?>
    <tr>
      <td align="right">编辑状态：</td>
      <td>
	    <input type="radio" name="status" value="0" style="vertical-align:middle" <?php if($rows->status==0) echo 'checked';?>><label>待处理</label>
	    <input type="radio" name="status" value="1" style="vertical-align:middle" <?php if($rows->status==1) echo 'checked';?>><label>已回复</label>
	    <input type="radio" name="status" value="2" style="vertical-align:middle" <?php if($rows->status==2) echo 'checked';?>><label>已办结</label>
	  </td>
	</tr>
	<?php } ?>
	
    <tr>
      <td align="right"></td>
      <td>
        <?php if($user_group=='1' ){ ?>
        <input type="submit" value="提 交" class="btn ajax_btn" />
		<?php }?>
		
		<?php if($rows->handle_user==$_SESSION['manage'] && $rows->status!='2'){ ?>
		<input type="submit" value="提 交" class="btn ajax_btn" />
		<?php } ?>
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />
      </td>
    </tr>
	</table>
  </form>

</div>
</body>

</html>

