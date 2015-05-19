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

</head>

<body>
<div class="wrap">
<form name="myform" method="post" action="/index.php/admin_article/edit_thumb/<?php echo $rows->thumb_id; ?>" class="ajax_form" >
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑图片</th>
    </tr>
    
    <tr>
      <td align="right">图片：</td>
      <td><img src="<?php echo $rows->thumb_path; ?>" style="padding:6px;border:2px #fff solid;width:230px;"></td>
    </tr>
    
	
    <tr>
      <td align="right">图片介绍：</td>
      <td><textarea name="content" style="width:500px;height:59px;"><?php echo htmlspecialchars($rows->content); ?></textarea></td>
    </tr>

	<tr>
      <td align="right">序号：</td>
      <td>
	  <input name="thumb_id" value="<?php echo $rows->thumb_id; ?>" type="hidden">
	  <input type="text" name="sort" size="6" value="<?php echo $rows->sort; ?>" > <font color="red">数值越大越靠前</font>
	  </td>
    </tr>

    <tr>
      <td align="right"></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" name="submit" />
		<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />
      </td>
    </tr>
	
  </table>
</form>
</div>
</body>


</html>

