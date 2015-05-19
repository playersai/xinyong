<?php
if(! function_exists('action_message')){
	function action_message($url=null,$time=5,$text=null,$yes=1){
		$url=$url!=null?$url:'/';
		//$texts=$yes=='1'?'操作成功!'.$text:'操作失败!&nbsp;'.$text;
		$yesclass=$yes=='1'?'ok':'no';
		$str='<html><meta charset="utf-8">
<link href="/public/admin/css/other.css" rel="stylesheet" type="text/css"><body><div class="showMsg" style="text-align:center;background-color:#f1f1f1;"><h5>提示信息</h5>
			<div class="content '.$yesclass.'" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;max-width:330px">
			'.htmlspecialchars($text).'	</div><div class="bottom">页面自动 <a id="href" href="'.$url.'">跳转</a> 等待时间： <b id="wait">'.$time.'</b></a>
			</div></div><script type="text/javascript">
(function(){
var wait = document.getElementById(\'wait\'),href = document.getElementById(\'href\').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
		</body></html>';
		
		die($str);
	
	}



}





?>