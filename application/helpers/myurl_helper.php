<?php
// 提取URL中文并转码
function safeUrl($url, $outCharset = 'gbk')
{
	if (preg_match_all('~[\x{4e00}-\x{9fa5}]+~u', $url, $array)) {
		foreach ($array[0] as $arr) {
			$arr_encode = urlencode(iconv('utf-8', $outCharset, $arr));
			$url = str_replace($arr, $arr_encode, $url);
		}
	}
	return $url;
}

function urlsafe_b64encode($string)
{
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='), array('-','_',''), $data);
    return $data;
}
// url base64解码
function urlsafe_b64decode($string)
{
    $data = str_replace(array('-','_'), array('+','/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}
