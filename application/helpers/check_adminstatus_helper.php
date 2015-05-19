<?php
if (! function_exists('check_adminstatus')) {

	function check_adminstatus($exptime)
	{
		if (! isset($_SESSION['manage']) || $_SESSION['exp_time'] - time() < 1) {
			session_destroy();
			$url = '/index.php/admin/';
			// $texts=$yes=='1'?'操作成功!'.$text:'操作失败!&nbsp;'.$text;
			$yesclass = 'no';
			$str = '
			<html><meta charset="utf-8">
			<link href="/public/admin/css/other.css" rel="stylesheet" type="text/css">
			<body>
			<div class="showMsg" style="text-align:center">
				<h5>提示信息</h5>
				<div class="content ' . $yesclass . '" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;max-width:330px">
					您未登录或已超时退出，请登录后重试！
				</div>
			
				<div class="bottom">
					<a href="' . $url . '">如果您的浏览器没有自动跳转，请点击这里</a>
					<!-- <meta http-equiv="refresh" content="6; url=' . $url . '"> -->
				</div>
				
				<script language=javascript>
					if (self != top) {  
						// 在iframe
						setTimeout("window.parent.location=\'' . $url . '\'",5000);
					} else{
						// 不在iframe
						setTimeout("window.location=\'' . $url . '\'",5000);	
					}
      			</script>
			</div>
			</body>
			</html>';
			die($str);
		}
		$exptime = $exptime <= 1 ? 1 : $exptime;
		$_SESSION['exp_time'] = time() + 6000 * $exptime;
	}
}

?>