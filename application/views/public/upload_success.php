<html>
<head>
<title>Upload Form</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<script>alert('图片上传成功');</script>

									
<script type ="text/javascript">

window.parent.document.<?php echo isset($f_name)?$f_name:'myform'; ?>.<?php echo isset($i_name)?$i_name:'thumb'; ?>.value='/public/<?php echo $upload_data['file_name'];?>';
location.href="http://cms.com/index.php/upload/index/<?php echo $f_name; ?>/<?php echo $i_name; ?>";
	
 </script>

</body>
</html>