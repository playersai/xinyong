<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件上传</title>
<style>

html,body,form{margin:0;padding:0;}
input { height:26px; line-height:14px; border:#CCCCCC 1px solid; background-color:#FFF; margin:0px; padding:2px 2px 3px 3px;;font-size:12px;border:1px solid #BDC5CA;}
input:hover {
  border: 1px solid #6ad;
}
#file{background-color:#FFF;}
input.bg{background:url("button_bg.gif"); height:25px;background-color:#39e; padding:5px;border:1px solid #39e;border-radius:3px;color:#fff;}

</style>
<body style="margin:0px;padding:0;">
<?php if(!empty($error)){ ?>
<script>alert('<?php echo strip_tags($error); ?>');location.href="/index.php/upload/index/<?php echo isset($f_name)?$f_name:'myform'; ?>/<?php echo isset($i_name)?$i_name:'thumb'; ?>";</script>
<?php } ?>
<div style="margin-top:-6px;background-color:#fff;width:100%;height:30px;display:block;">
<form action="http://cms.com/index.php/upload/do_upload/<?php echo isset($f_name)?$f_name:'myform'; ?>/<?php echo isset($i_name)?$i_name:'thumb'; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php //echo form_open_multipart('upload/do_upload');?>
<input type="file" name="userfile" id="file" style="width:213px;overflow:hidden;float:left;margin-right:6px;" />
<input type="submit" value="上传" class="bg"/>
</form>
</div></body>
</html>