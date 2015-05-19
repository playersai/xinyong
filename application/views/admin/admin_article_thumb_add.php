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
<form name="myform" method="post" action="/index.php/admin_article/add_thumb_handle/<?php echo $acticle_info[0]->aid; ?>/<?php echo $acticle_info[0]->cat_id; ?>" class="ajax_form" >
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">给文章增加图片集</th>
    </tr>
    
    <tr>
      <td align="right">所属文章：</td>
      <td><?php echo htmlspecialchars($acticle_info[0]->title);?> 
	  </td>
    </tr>
    
    <tr>
      <td align="right">已传图片：</td>
      <td>
        <?php if(isset($rows_thumbs) and is_array($rows_thumbs)){ ?>
	    <?php foreach($rows_thumbs as $tval){ ?>
        <dl style="width:150px;float:left;margin:10px;border:#ddd dashed 1px;text-align:center">
          <dd><img src="<?php echo $tval->thumb_path; ?>" style="width:120px;height:120px;padding-top:6px;"></dd>
          <dt style="padding-top:6px;"> 
            <a class="win_normal" href="/index.php/admin_article/edit_thumb/<?php echo $tval->thumb_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a> 
            <a class="win_normal" href="/index.php/admin_article/delete_thumb/<?php echo $tval->thumb_id; ?>" onclick="javascript:return confirm('确定要删除本图片吗？删除后将不能还原！')" title="删除"><img src="/public/manage/images/delete.gif" alt="删除" width="16" height="16" /></a>
          </dt>
        </dl>
        <?php } ?>
		<?php } ?>
	  </td>
    </tr>
    
	<tr>
      <td align="right">图片地址：</td>
      <td style="height:300px;"><p style="color:red">建议每张图片尺寸大于640 X 480</p>
		<ul id="xx">
		<?php for($i=1; $i<=16; $i++){ ?>
		<li style="display:block;width:550px;margin:6xp 0;height:35px;padding:16px;">
		<label style="width:39px;text-align:right;display:block;float:left;">图片<?php echo $i; ?></label>
		<span style="width:85%">
		  <div style="float:left;">
		    <input type="text" name="thumb_path<?php echo $i;?>" value="" style="width:210px;float:left;">
		  </div>
		</span>
		
		<div style="width:288px;float:left;vertical-align:middle;background-color:#fff;padding-left:6px;"> <iframe frameborder="0" src="/public/upload.php?upname=thumb_path<?php echo $i; ?>&forname=myform" width="360" height="39" scrolling="no" align="middle"></iframe></div>
		  
		<div style="clear:both;padding:3px 0"></div>
		<p style="margin:6px 0;">
		<label style="width:39px;text-align:right;display:block;float:left;">简介<?php echo $i; ?></label><span style="width:85%">
		<textarea style="width:360px;float:left;height:50px;" name="t_content[<?php echo $i; ?>]"></textarea>
		</span>
		<label style="width:39px;text-align:right;display:block;float:left;">序号</label><input type="text" size="12" name="sort[<?php echo $i; ?>]" style="width:100px;float:left;" placeholder="从高->低排序">
		</p>
		</li>
		<div style="clear:both;padding:6px 0;border-bottom:1px dashed #ddd;"></div>
		<?php } ?>
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

