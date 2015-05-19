<?php
if(! function_exists('name_replace')){
	function name_replace($name, $charset = 'UTF8') {
		if(!function_exists('mb_substr')) {
			exit('需要开启 mb_string 支持');
		}
		$result = '';
		$strlen = mb_strlen($name, $charset);
		if($strlen>2) {
			return mb_substr($name, 0, 1, $charset).str_repeat('*',$strlen-2).mb_substr($name, -1, 1, $charset);
		} else {
			return mb_substr($name, 0, 1, $charset).str_repeat('*',$strlen-1);
		}
	}


}





?>