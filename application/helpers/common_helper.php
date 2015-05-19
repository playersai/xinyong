<?php

function test($value = 'test ok', $exit = TRUE)
{
	if (is_array($value) || is_object($value)) {
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	} else {
		var_dump($value);
	}
	if ($exit) exit();
}

function admin_url($uri = '')
{
	$CI = & get_instance();
	return $CI->config->site_url($uri);
}

function rule_merge($rules, $checked = null, $pid = 0)
{
	if (! is_array($rules)) return false;
	
	$arr = array();
	foreach ($rules as $v) {
		$data['id'] = $v['id'];
		$data['pId'] = $v['pid'];
		$data['name'] = $v['title'];
		$data['status'] = $v['status'];
		
		if (is_array($checked)) {
			$data['checked'] = in_array($v['id'], $checked) ? 1 : 0;
		}
		
		if ($v['pid'] == $pid) {
			if ($v['pid'] != 0 && $checked == null) {
				$data['url'] = admin_url(str_replace('-', '/', $v['name']));
				$data['target'] = 'main';
			} else {
				$data['open'] = true;
			}
			$data['children'] = rule_merge($rules, $checked, $v['id']);
			$arr[] = $data;
		}
	}
	
	return $arr;
}

function check_purview($name, $isbtn = false)
{
	$CI = & get_instance();
	$CI->load->library('Auth');
	if ($_SESSION['user_id'] == 1) return true; // 网站始创人不限制
	if (! $CI->auth->check($name, $_SESSION['user_id'])) {
		if ($isbtn) {
			return false;
		} else {
			exit('您没有权限操作');
		}
	} else {
		return true;
	}
}
