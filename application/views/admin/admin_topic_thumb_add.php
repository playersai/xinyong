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
<form method="post" action="/index.php/admin_topic/add_thumb_handle/<?php
	  echo $ainfo[0]->aid;
	  ?>/<?php
	  echo $ainfo[0]->cat_id;
	  ?>" class="ajax_form" name="myform">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">给专题文章增加图片集</th>
    </tr>
    <tr>
      <td align="right">所属专题文章：</td>
      <td><?php
	  echo $ainfo[0]->title;
	  ?> </td>
    </tr>
    
	
	<tr>
      <td align="right">图片地址：</td>
      <td style="height:300px;">
		<ul id="xx">
		<?php $ii=16; for($i=1;$i <= $ii;$i++){?>
		<li style="display:block;width:550px;margin:6xp 0;height:35px;padding:16px;">
		<label style="width:39px;text-align:right;display:block;float:left;">图片<?php echo $i; ?></label><span style="width:85%">
		<div style="float:left;">
		<input type="text" name="thumbs<?php echo $i?>" value="" style="width:210px;float:left;height:32px;">
		</div></span>
		
		
		
		 
 <div style="width:288px;float:left;vertical-align:middle;background-color:#fff;padding-left:6px;"> <iframe frameborder="0" src="/public/upload.php?upname=thumbs<?php echo $i; ?>&forname=myform" width="360" height="39" scrolling="no" align="middle"></iframe></div>
		  
		
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

