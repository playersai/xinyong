<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index($cat_id = 0, $parent_id)
	{
		if ($cat_id !== 0) {
			switch ($cat_id) {
				case 54:
					header("location:/index.php/landscape/type4/53/54");
					break;
				case 64:
					header("location:/index.php/landscape/type3/3/64");
					break;
				case 134:
					header("location:/index.php/landscape/type3/48/134");
					break;
			}
		} else {
			header("location:/index.php");
		}
	}
}
