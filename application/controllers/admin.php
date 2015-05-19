<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public $cat_types;

	function __construct()
	{
		parent::__construct();
		$this->cat_types = $this->get_types();
	}

	function get_types()
	{
		$this->load->model('admincategorym', 'acm');
		return $this->cat_types = $this->acm->get_cat_type_array();
	}

	public function index()
	{
		// $this->load->helper('captcha');
		// $rword = rand(1000, 9999);
		// $_SESSION['captcha'] = $rword;
		// $rfonts = './public/verify/ttfs/' . rand(2, 5) . '.ttf';
		// $vals = array('word' => $rword,'img_path' => './public/captcha/','img_url' => 'http://cms.com/public/captcha/','font_path' => $rfonts,'img_width' => 100,'img_height' => 30,'expiration' => 7200);
		
		// $data['cap'] = create_captcha($vals);
		$this->load->view('admin/login');
	}

	public function login_handle()
	{
		if (isset($_POST)) {
			
			if (strtoupper($this->input->post('yzm')) == $_SESSION['captchas']) {
				if (empty($_POST['username'])) {
					action_message('/index.php/admin/index', 3, '用户名不能为空，请重新输入!', 0);
					exit();
				}
				
				if (empty($_POST['password'])) {
					action_message('/index.php/admin/index', 3, '密码不能为空，请重新输入!', 0);
					exit();
				}
				
				$this->load->database();
				$this->load->model('adminsystemm', 'asm');
				$this->load->model('admin_system_logm', 'aslm');
				
				$data = $this->input->post(NULL, true);
				$query = $this->db->get_where('ch_user', array('status' => 1,'username' => $data['username'],'password' => md5($data['password'])));
				$row = $query->result();
				if ($row) {
					$_SESSION['manage'] = $row[0]->username;
					$_SESSION['user_id'] = $row[0]->user_id;
					$_SESSION['group_id'] = $row[0]->group_id;
					
					$user_group = $this->asm->get_user_group_by_groupid($row[0]->group_id);
					$_SESSION['group_name'] = $user_group[0]->name;
					
					$_SESSION['exp_time'] = time() + 60 * 100; // 过期时间为 N 分钟
					
					$login_ip = $_SERVER['REMOTE_ADDR'];
					$login_num = $row['0']->login_nums + 1;
					
					$system_log_data = array('ip' => $login_ip,'addtime' => time(),'content' => '登录成功','add_user' => $data['username'],'action' => 1); // ip,addtime,content,add_user,action
					$this->aslm->do_add_system_log($system_log_data);
					
					$this->db->where(array('username' => $data['username'],'password' => md5($data['password'])));
					$this->db->update('ch_user', array('last_login_time' => time(),'login_nums' => $login_num,'last_login_ip' => $login_ip));
					action_message('./main/', 3, '登录成功!', 1);
				} else {
					action_message('/index.php/admin/index', 3, '用户名或密码错误!', 0);
				}
			} else {
				action_message('/index.php/admin/index', 3, '验证码输入错误!', 0);
			}
		}
	}

	public function main()
	{
		check_adminstatus(100);
		
		$menu_arr['parent'][0] = '待办项目';
		if ($_SESSION['group_id'] == '1') {
			$menu_arr['son'][0][] = array('name' => '待办事项','url' => '/index.php/admin_todo');
		}
		$menu_arr['son'][0][] = array('name' => '网上诉求','url' => '/index.php/admin_feedback/result_list/38/1');
		$menu_arr['son'][0][] = array('name' => '企业招聘','url' => '/index.php/admin_article/113/1');
		$menu_arr['son'][0][] = array('name' => '个人求职','url' => '/index.php/admin_article/114/1');
		$menu_arr['son'][0][] = array('name' => '网上征集','url' => '/index.php/admin_feedback/37/1');
		
		if ($_SESSION['group_id'] == '1') {
			$menu_arr['parent'][1] = '其它项目';
			$menu_arr['son'][1][] = array('name' => '广告管理','url' => '/index.php/admin_category_type/index/8/');
			// $menu_arr['son'][1][] = array('name' => '专题管理','url' => '/index.php/admin_category_type/index/7/');
			// $menu_arr['son'][2][] = array('name' => '底部栏目','url' => '/index.php/admin_category_type/index/6/');
		}
		
		$this->load->view('admin/home', $menu_arr);
	}

	public function main2()
	{
		check_adminstatus(100);
		$menu_arr['parent'] = array('分 类','内 容','系 统','专 题','个人中心');
		
		$menu_arr['son'][0][] = array('name' => '分类管理','url' => '/index.php/admin_category/');
		$menu_arr['son'][0][] = array('name' => '添加分类','url' => '/index.php/admin_category/add');
		// $menu_arr['son'][0][]=array('name'=>'分类属性管理','url'=>'/index.php/admin_category/');
		// $menu_arr['son'][0][]=array('name'=>'添加分类属性','url'=>'/index.php/admin_category/add');
		
		$menu_arr['son'][2][] = array('name' => '基本设置','url' => '/index.php/admin_system/');
		$menu_arr['son'][2][] = array('name' => '用户管理','url' => '/index.php/admin_user/');
		$menu_arr['son'][2][] = array('name' => '友情连接','url' => '/index.php/admin_link/');
		// $menu_arr['son'][2][]=array('name'=>'网站导航','url'=>'/index.php/admin_category/add');
		// $menu_arr['son'][2][]=array('name'=>'广告管理','url'=>'/index.php/admin_category/add');
		$menu_arr['son'][2][] = array('name' => '系统日志','url' => '/index.php/admin_system/log');
		$menu_arr['son'][2][] = array('name' => '系统统计','url' => '/index.php/admin_system/stats');
		
		$menu_arr['son'][3][] = array('name' => '专题管理','url' => '/index.php/admin_category/');
		$menu_arr['son'][3][] = array('name' => '添加专题','url' => '/index.php/admin_category/add');
		
		$menu_arr['son'][4][] = array('name' => '我的文档','url' => '/index.php/admin_category/add');
		$this->load->model('admincategorym', 'acm');
		$rows = $this->acm->get_cat_type_array();
		foreach ($rows as $val) {
			$menu_arr['son'][1][] = array('name' => $val->name,'url' => '/index.php/admin_category_type/index/' . $val->id);
		}
		// print_r($rows);
		
		$this->load->view('admin/home2', $menu_arr);
	}

	public function menu($id = 0)
	{
		switch ($id) {
			case 1:
				$this->load->model('admincategorym', 'acm');
				$crows = $this->acm->get_cat_by_parent_id(1);
				
				foreach ($crows['cat2'] as $ppval) {
					$menu_arr['parent'][$ppval->cat_id] = $ppval->name;
				}
				
				foreach ($crows['cat3'] as $c3key => $c3val) {
					
					foreach ($c3val as $ssval) {
						$url = '/index.php/' . $this->cat_types[$ssval->cat_type_id]->controllers . '/' . $ssval->cat_id . '/1';
						// $url = str_replace('//', '/', $url);
						$menu_arr['son'][$c3key][] = array('name' => $ssval->name,'url' => $url);
					}
				}
				
				break;
			
			case 2:
				$this->load->model('admincategorym', 'acm');
				$crows = $this->acm->get_cat_by_parent_id(85);
				
				foreach ($crows['cat2'] as $ppval) {
					$menu_arr['parent'][$ppval->cat_id] = $ppval->name;
				}
				
				foreach ($crows['cat3'] as $c3key => $c3val) {
					
					foreach ($c3val as $ssval) {
						$url = '/index.php/' . $this->cat_types[$ssval->cat_type_id]->controllers . '/' . $ssval->cat_id . '/1';
						// $url = str_replace('//', '/', $url);
						$menu_arr['son'][$c3key][] = array('name' => $ssval->name,'url' => $url);
					}
				}
				
				break;
			
			case 3:
				$this->load->model('admincategorym', 'acm');
				$crows = $this->acm->get_cat_by_parent_id(10);
				
				foreach ($crows['cat2'] as $ppval) {
					$menu_arr['parent'][$ppval->cat_id] = $ppval->name;
				}
				
				foreach ($crows['cat3'] as $c3key => $c3val) {
					
					foreach ($c3val as $ssval) {
						$menu_arr['son'][$c3key][] = array('name' => $ssval->name,'url' => '/index.php/' . $this->cat_types[$ssval->cat_type_id]->controllers . '/' . $ssval->cat_id . '/1');
					}
				}
				
				break;
			
			case 4:
				
				$this->load->model('admincategorym', 'acm');
				$crows = $this->acm->get_cat_by_parent_id(2);
				
				foreach ($crows['cat2'] as $ppval) {
					$menu_arr['parent'][$ppval->cat_id] = $ppval->name;
				}
				
				foreach ($crows['cat3'] as $c3key => $c3val) {
					
					foreach ($c3val as $ssval) {
						$menu_arr['son'][$c3key][] = array('name' => $ssval->name,'url' => '/index.php/' . $this->cat_types[$ssval->cat_type_id]->controllers . '/' . $ssval->cat_id . '/1');
					}
				}
				
				break;
			
			case 5:
				// 后台顶部 热点专题左侧菜单
				$menu_arr['parent'] = array(0 => '专题栏目');
				$menu_arr['son'][0][] = array('name' => '全部专题','url' => '/index.php/admin_category_type/topics');
				$menu_arr['son'][0][] = array('name' => '新增专题','url' => '/index.php/admin_category/add/30/7');
				
				$this->load->model('admincategorym', 'acm');
				$data = $this->acm->get_cat_by_parent_id(30);
				
				foreach ($data['cat2'] as $pkey => $pval) {
					$menu_arr['parent'][$pval->cat_id] = $pval->name;
					$menu_arr['son'][$pval->cat_id][] = array('name' => '【新增子栏目】','url' => '/index.php/admin_category/add/' . $pval->cat_id . '/7');
				}
				
				foreach ($data['cat3'] as $skey => $sval) {
					foreach ($sval as $ssval) {
						$url = '/index.php/' . $this->cat_types[$ssval->cat_type_id]->controllers . '/' . $ssval->cat_id . '/1';
						$menu_arr['son'][$skey][] = array('name' => $ssval->name,'url' => $url);
					}
				}
				
				break;
			
			case 6:
				$menu_arr['parent'] = array(2 => '系 统 设 置');
				$menu_arr['son'][2][] = array('name' => '基本设置','url' => '/index.php/admin_system/');
				$menu_arr['son'][2][] = array('name' => '用户管理','url' => '/index.php/admin_user/');
				$menu_arr['son'][2][] = array('name' => '用户组管理','url' => '/index.php/admin_user_group');
				$menu_arr['son'][2][] = array('name' => '友情链接','url' => '/index.php/admin_link/');
				$menu_arr['son'][2][] = array('name' => '系统日志','url' => '/index.php/admin_system/log');
				$menu_arr['son'][2][] = array('name' => '系统统计','url' => '/index.php/admin_system/stats');
				$menu_arr['son'][2][] = array('name' => '分类管理','url' => '/index.php/admin_category/');
				break;
		}
		
		$this->load->view('admin/menu', $menu_arr);
	}

	public function welcome()
	{
		check_adminstatus(13);
		$this->load->model('adminsystemm', 'asm');
		$this->load->model('admin_articlem', 'aam');
		$this->load->model("Admin_feedbackm", 'afm');
		
		$data['rows_dbxs'] = $this->asm->get_toDoList(5);
		$data['qyzp_rows'] = $this->aam->get_article_by_where("cat_id='113' and status=0 ", array(0 => 0,1 => 5));
		$data['grqz_rows'] = $this->aam->get_article_by_where("cat_id='114' and status=0 ", array(0 => 0,1 => 5));
		
		if ($_SESSION['group_id'] == '1') {
			$user = "NULL";
			$where = " status=0 ";
		} else {
			$user = $_SESSION['manage'];
			$where = " status=0 and handle_user='" . $user . "'";
		}
		
		$data['fc_rows'] = $this->afm->get_fc_by_handle_user($where, 5);
		//网上征集
		$data['ofc_rows'] = $this->afm->get_feedback_content3('0,5');
	 
		$this->load->view("admin/welcome", $data);
	}

	public function logout()
	{
		if (isset($_SESSION['manage'])) {
			$_tm = time();
			$_ip = $_SERVER['REMOTE_ADDR'];
			$this->load->model('admin_system_logm', 'aslm');
			$system_log_data = array('ip' => $_ip,'addtime' => $_tm,'content' => '退出成功','add_user' => $_SESSION['manage'],'action' => 0); // ip,addtime,content,add_user,action
			$this->aslm->do_add_system_log($system_log_data);
			$_SESSION['manage'] = NULL;
			session_destroy();
			
			action_message('../', 3, '安全退出成功!', 1);
		} else {
			header("location:/index.php/admin/");
		}
	}
}
