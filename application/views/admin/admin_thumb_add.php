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
    <form method="post" action="/index.php/admin_photo/add_thumbs/<?php echo $rows->photo_id; ?>/<?php echo $rows->cat_id; ?>/<?php echo $rows->status; ?>" class="ajax_form" name="myform">
      <table cellspacing="1" class="myform">
          <tr>
            <th colspan="2"><?php echo $rows->title; ?> 增加图片</th>
          </tr>
          
          <tr>
            <td align="right">已传图片：</td>
            <td>
              <?php if(isset($thumbs) and is_array($thumbs)){ ?>
	          <?php foreach($thumbs as $tval){ ?>
              <dl style="width:150px;float:left;margin:10px;border:#ddd dashed 1px;text-align:center">
                <dd><img src="<?php echo $tval->thumb_path; ?>" style="width:120px;height:120px;padding-top:6px;"></dd>
                <dt style="padding-top:6px;"> 
                  <a class="win_normal" href="/index.php/admin_photo/edit_thumb/<?php echo $tval->thumb_id; ?>/<?php echo $tval->photo_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a> 
                  <a class="win_normal" href="/index.php/admin_photo/delete_thumb/<?php echo $tval->thumb_id; ?>/<?php echo $tval->photo_id; ?>" onclick="javascript:return confirm('确定要删除本图片吗？删除后将不能还原！')" title="删除"><img src="/public/manage/images/delete.gif" alt="删除" width="16" height="16" /></a>
                </dt>
              </dl>
              <?php } ?> 
		      <?php } ?>
	        </td>
          </tr>
          
          <tr>
            <td align="right">上传新图：</td>
            <td style="height:300px;">
              <ul id="xx">
              <?php for($i=1; $i<=16; $i++){?>
              <li style="display:block;width:550px;margin:6xp 0;height:35px;padding:16px;">
                <label style="width:39px;text-align:right;display:block;float:left;">图片<?php echo $i; ?></label>
                <span style="width:85%">
		          <div style="float:left;">
		            <input type="text" name="thumbs<?php echo $i; ?>" value="" style="width:210px;float:left;">
		          </div>
                </span>
                
                <div style="width:288px;float:left;vertical-align:middle;background-color:#fff;padding-left:6px;">
                  <iframe frameborder="0" src="/public/upload.php?upname=thumbs<?php echo $i; ?>&forname=myform" width="360" height="39" scrolling="no" align="middle"></iframe>
                </div>
                
                <div style="clear:both;padding:3px 0"></div>
                  <p style="margin:6px 0;">
                    <label style="width:39px;text-align:right;display:block;float:left;">简介<?php echo $i; ?></label>
                    <span style="width:85%">
		              <textarea style="width:360px;float:left;height:50px;" name="t_content[<?php echo $i; ?>]"></textarea>
		            </span>
                    <label style="width:39px;text-align:right;display:block;float:left;">序号</label>
                    <input type="text" size="12" name="sort[<?php echo $i; ?>]" style="width:100px;float:left;" placeholder="从高->低排序"> 
                  </p>
			      <div style="clear:both;padding:3px 0"></div>
				   <p style="margin:6px 0;">
					<label style="width:50px;text-align:right;display:block;float:left;">友情链接</label>
					<input type="text" size="60" name="f_link[<?php echo $i; ?>]" style="float:left;">
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
              <input type="submit" name="submit" value="提 交" class="btn ajax_btn" /> 
              <input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />
            </td>
          </tr>
          
      </table>
    </form>
  </div>
</body>
</html>
