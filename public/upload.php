<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
 //var_dump($_SERVER);
 $ua=$_SERVER["HTTP_REFERER"]; if(!$ua){exit('No direct script access allowed');}
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件上传</title>
<style>
* {
	margin: 0px;
	padding: 0px;
}

input {
	height: 22px;
	line-height: 22px;
	border: #CCCCCC 1px solid \9;/*mark*/
	background-color: #FFF;
	margin: 0px;
	padding:0 3px;
	font-size: 12px;
	/*border: 1px solid #BDC5CA;*//*mark*/
	float:left;/*mark*/
}

input:hover {
	/*border: 1px solid #6ad;*//*mark*/
	background-color:#eee;
}

input.bg {
/* 	background: url("button_bg.gif"); */
	height: 22px;/*mark*/
	padding: 0 9px;/*mark*/
	line-height:22px\9;
	background-color: #39e;
	color: #fff;
	border-radius: 4px;
	border: 1px #fff solid;
}
</style>
</head>
<body>
	<form action="?act=save&upname=<?php echo $_GET['upname'];?>&forname=<?php echo $_GET['forname'];?>&editortype=<?php echo $_GET['editortype'];?>&editorname=<?php echo $_GET['editorname'];?>" method="post" enctype="multipart/form-data">
		<input type="file" name="file" id="file" value="选择上传的图片" />&nbsp;<input type="submit" name="button" id="button" value="上传" class="bg" />
	</form>

<?php  
if (isset($_GET['act']) && $_GET['act'] == 'save') {

	function my_setfilename()
	{
		$gettime = explode(' ', microtime());
		$string = 'abcdefghijklmnopgrstuvwxyz0123456789';
		$rand = '';
		for ($x = 0; $x < 10; $x ++)
			$rand .= substr($string, mt_rand(0, strlen($string) - 1), 1);
		return date("ymdHis") . substr($gettime[0], 2, 6) . $rand;
	}
	$savePath = "./attached/thumb/" . date("Ymd");
	if (! file_exists($savePath)) {
		mkdir($savePath);
	}
	$savePath = "./attached/thumb/" . date("Ymd") . '/';
	
	if (function_exists("date_default_timezone_set")) {
		date_default_timezone_set("Hongkong");
	}
	$pic = date("Ymd") . my_setfilename();
	$str = $pic;
	if ($_FILES['file']['name'] != "") {
		$tmp_file = $_FILES['file']['tmp_name'];
		$file_types = explode(".", $_FILES['file']['name']);
		$file_type = $file_types[count($file_types) - 1];
		$file_size = $_FILES['file']['size'];
		
		if (intval($file_size) == 0) {
			echo "<script>alert('上传的图片文件不能大于2MB，请重新上传！');history.go(-1);</script>";
			exit();
		}
		
		if (strtolower($file_type) != "jpg" & strtolower($file_type) != "gif" & strtolower($file_type) != "bmp" & strtolower($file_type) != "png") {
			// echo "格式错误请重新上传<a href=# onclick=history.go(-1);>[返回]</a>";
			echo "<script>alert('上传格式错误，图片格式仅支持JPG、PNG、GIF、BMP，请重新上传！');history.go(-1);</script>";
			exit();
		}
		
		$file_name = $str . "." . $file_type;
		if (! copy($tmp_file, $savePath . $file_name)) {
			$meg = $file_name . "上传错误请重试！";
			echo "<script>alert('图片上传失败！');history.go(-1);</script>";
		} else {
			$meg = $file_name;
			$savePath = str_replace("../../", "/", $savePath);
			echo "<script>alert('图片上传成功！');</script>";
			$return_path = $savePath . $meg;
			?>			
	<script type="text/javascript">
		window.parent.document.<?php echo $_GET['forname'];?>.<?php echo $_GET['upname'];?>.value='/public<?php echo substr($return_path,1,strlen($return_path)-1);?>';
		location.href="upload.php?upname=<?php echo $_GET['upname'];?>&forname=<?php echo $_GET['forname'];?>&editortype=<?php echo $_GET['editortype'];?>&editorname=<?php echo $_GET['editorname'];?>";	
		history.go(-1);
	</script>
<?PHP
		}
	} else {
		// echo "<font color=red>请选择需要上传的文件<a href=# onclick=history.go(-1);>[返回]</a></font>";
		echo "<script>alert('请选择需要上传的文件!');history.go(-1);</script>";
		exit();
	}
}
?>
</body>
</html>
