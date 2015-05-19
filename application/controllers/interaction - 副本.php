<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Interaction extends CI_Controller
{

	public $page_config;

	public $left_navs = array();

	public function __construct()
	{
		parent::__construct();
		$this->left_navs = $this->get_left_nav();
		
		$this->page_config['first_link'] = '首页';
		$this->page_config['last_link'] = '尾页';
		$this->page_config['prev_link'] = '上一页';
		$this->page_config['next_link'] = '下一页';
		$this->page_config['cur_tag_open'] = '<span class="page_now">';
		$this->page_config['cur_tag_close'] = '</span>';
		$this->page_config['per_page'] = 10;
	}

	public function index($queryStr = null, $per_pages = null)
	{
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		$floatad = $this->igam->get_float_ad(162); // 交流互动漂浮广告 cat=162
		                                           
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'floatad' => $floatad[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->library('pagination');
		$this->load->helper(array('myurl','handle_json'));
		$this->load->model('index_interactionm', 'iim');
		$this->load->model('index_homem', 'ihm');
		
		if ($queryStr == null) $queryStr = 'QDA=';
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		$keyword = $queryArr[0];
		$type_id = $queryArr[1];
		
		$data['keyword'] = $keyword;
		$data['type_id'] = $type_id;
		
		$_where = "title like '%" . $keyword . "%' and status=2";
		if ($type_id != 0) $_where .= " and ch_feedback_content.type_id=" . $type_id;
		$_rownum = $this->iim->get_feedback_content3($_where)->num_rows();
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'interaction/index/' . $queryStr . '/';
		$config['total_rows'] = $_rownum;
		$config['uri_segment'] = 4;
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$fcrows = $this->iim->get_feedback_content3($_where, $config['per_page'], $this->uri->segment(4))
			->result();
		$data['fcrows'] = $fcrows;
		
		$fbrows = $this->iim->get_feedback_by_catid_limit(37, 8); // 网上征集列表
		$data['fbrows'] = $fbrows;
		
		$vtrows = $this->iim->get_vote_by_catid_limit(105, 8); // 网上调查列表
		$data['vtrows'] = $vtrows;
		
		$cjwt_rows = $this->ihm->get_article_by_catid(129, 4); // 常见问题
		$data['cjwt_rows'] = $cjwt_rows;
		
		// 底部导航
		$data['link'] = $this->ihm->get_link("where type_id=0", 6);
		$data['link_1'] = $this->ihm->get_link("where type_id=1");
		$data['link_2'] = $this->ihm->get_link("where type_id=2");
		$data['link_3'] = $this->ihm->get_link("where type_id=3");
		$data['link_4'] = $this->ihm->get_link("where type_id=4");
		$data['link_5'] = $this->ihm->get_link("where type_id=5");
		$data['link_6'] = $this->ihm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction');
		$this->load->view('index/footer_nav');
	}

	public function complaint_form()
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		                                                           
		// 广告调取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		/* 获取反馈属性(镇长信箱, 投诉监督, 办事咨询) */
		$this->load->model('index_interactionm', 'iim');
		$types = $this->iim->get_feedback_type();
		
		$data = array('left_navs_selected' => 38,'left_navs' => $this->left_navs,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'types' => $types,'type_selected' => 0);
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_complaint_form');
		$this->load->view('index/footer');
	}

	public function Mayor_mail()
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		/* 获取反馈属性(镇长信箱,投诉监督,办事咨询) */
		$this->load->model('index_interactionm', 'iim');
		$types = $this->iim->get_feedback_type();
		
		$data = array('left_navs_selected' => 38,'left_navs' => $this->left_navs,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'types' => $types,'type_selected' => 2);
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_complaint_form');
		$this->load->view('index/footer');
	}

	public function Consulting_work()
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		/* 获取反馈属性(镇长信箱,投诉监督,办事咨询) */
		$this->load->model('index_interactionm', 'iim');
		$types = $this->iim->get_feedback_type();
		
		$data = array('left_navs_selected' => 38,'left_navs' => $this->left_navs,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'types' => $types,'type_selected' => 1);
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_complaint_form');
		$this->load->view('index/footer');
	}

	public function handle()
	{
		/* 我要投诉下的镇长信箱 办事咨询 投诉监督 提交处理 */
		if (isset($_POST)) {
			
			$this->load->model('index_interactionm', 'iim');
			$pdata = $this->input->post(NULL, TRUE);
			
			$feedback = $this->iim->get_feedback_by_catid(38); /* 获取预设的我要投诉下feedback-id */
			
			if (strtoupper($this->input->post('f_code')) !== $_SESSION['captchas']) {
				action_message("javascript:history.back(-1);", 3, '验证码错误！请重新输入', 0);
				exit();
			} else {
				unset($pdata['f_code']);
			}
			
			if (empty($_POST['title'])) {
				action_message('javascript:history.back(-1);', 6, '诉求主题不能为空，请重新输入！', 0);
				exit();
			}
			
			if (empty($_POST['content'])) {
				action_message('javascript:history.back(-1);', 6, '投诉内容不能为空，请重新输入！', 0);
				exit();
			}
			
			if (empty($_POST['contact_name'])) {
				action_message('javascript:history.back(-1);', 6, '用户姓名不能为空，请重新输入！', 0);
				exit();
			}
			
			if (empty($_POST['mobile'])) {
				action_message('javascript:history.back(-1);', 6, '手机号码不能为空，请重新输入！', 0);
				exit();
			}
			
			$pdata['addtime'] = time();
			$pdata['adddate'] = date("Y-m-d", time());
			$pdata['ip'] = $_SERVER['REMOTE_ADDR'];
			$pdata['f_id'] = $feedback[0]->f_id;
			
			// $handle_id格式：$date(8位) + $type_id(1位) + num(4位) 2014090930001
			$_num = $this->iim->get_fc_new_handleid_num();
			$_handle_id = date('Ymd', time()) . $pdata['type_id'] . $_num;
			
			$pdata['query_password'] = rand(100, 999) . rand(300, 800);
			$pdata['handle_id'] = $_handle_id;
			
			$result = $this->iim->do_handle($pdata);
			if ($result) {
				action_message('/index.php/interaction', 90, '提交成功！您的受理编号是' . $_handle_id . ',查询密码为' . $pdata['query_password'] . '。请您妥善保存，以便查询进度', 1);
			}
		}
	}

	public function view($f_c_id)
	{
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$this->load->model('Index_interactionm', 'iim');
		$fc_rows = $this->iim->get_fb_content_by_fcid2($f_c_id);
		
		if (! isset($fc_rows[0])) {
			action_message('/index.php/interaction', 30, '你查看的信息正在处理中(信息不可见)或已删除，请稍后在重试。谢谢！', 0);
		}
		
		$this->load->model('index_interactionm', 'iim');
		$types = $this->iim->get_feedback_type();
		$reply_rows = $this->iim->get_feedback_reply_by_fcid($f_c_id);
		
		$data = array('reply_rows' => $reply_rows[0],'left_navs_selected' => 38,'left_navs' => $this->left_navs,'types' => $types,'fc_rows' => $fc_rows[0],'topad' => $topad,'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url);
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_view');
		$this->load->view('index/footer');
	}

	public function search($backurl = null)
	{
		$pdata = $this->input->post(NULL, true);
		// var_dump($pdata);
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		
		/* 广告调取end */
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		$this->load->model('index_interactionm', 'iim');
		if (! empty($pdata['handle_id']) and ! empty($pdata['password'])) {
			$_where = "handle_id='" . $pdata['handle_id'] . "' and query_password='" . $pdata['password'] . "'";
			$_limit = 20;
			$result = $this->iim->do_search_handle($_where, $_limit);
			if ($result) {
				$data = array('topad' => $topad,'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'srows' => $result[0]);
				$this->load->view('index/header', $data);
				$this->load->view('index/interaction_search_list');
				$this->load->view('index/footer');
			} else {
				if ($backurl == 'index') {
					action_message('/index.php', 5, '根据您输入的受理编号【' . $pdata['handle_id'] . '】查询密码【' . $pdata['password'] . '】未查询到结果！', 0);
				} else {
					action_message('/index.php/interaction', 5, '根据您输入的受理编号【' . $pdata['handle_id'] . '】查询密码【' . $pdata['password'] . '】未查询到结果！', 0);
				}
				exit();
			}
		} else if (! empty($pdata['keyword'])) {
			$_where = "title like '%" . $pdata['keyword'] . "%' ";
			$_limit = 20;
			$result = $this->iim->do_search_handle($_where, $_limit);
			if ($result) {
				$data = array('topad' => $topad,'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'srows' => $result[0]);
				$this->load->view('index/header', $data);
				$this->load->view('index/interaction_search_list');
				$this->load->view('index/footer');
			}
		} else {
			if ($backurl == 'index') {
				action_message('/index.php', 5, '请输入受理编号和查询密码进行查询！', 0);
			} else {
				action_message('/index.php/interaction', 5, '请输入受理编号和查询密码或者输入关键词进行查询！', 0);
			}
		}
	}

	public function complaint_list($queryStr = null, $per_pages = null)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('left_navs_selected' => 23,'left_navs' => $this->left_navs,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->library('pagination');
		$this->load->helper(array('myurl','handle_json'));
		$this->load->model('index_interactionm', 'iim');
		$this->load->model('index_homem', 'ihm');
		
		if ($queryStr == null) $queryStr = 'QDA=';
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		$keyword = $queryArr[0];
		$type_id = $queryArr[1];
		
		$data['keyword'] = $keyword;
		$data['type_id'] = $type_id;
		
		$_where = "title like '%" . $keyword . "%' and status=2";
		if ($type_id != 0) $_where .= " and ch_feedback_content.type_id=" . $type_id;
		$_rownum = $this->iim->get_feedback_content3($_where)->num_rows();
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'interaction/complaint_list/' . $queryStr . '/';
		$config['total_rows'] = $_rownum;
		$config['uri_segment'] = 4;
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$fcrows = $this->iim->get_feedback_content3($_where, $config['per_page'], $this->uri->segment(4))
			->result();
		$data['fcrows'] = $fcrows;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_complaint_list');
		$this->load->view('index/footer');
	}

	public function type1($cat_id = 0)
	{
		if ($cat_id != 0) {
			/* 广告调取 */
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			
			/* 广告调取end */
			$this->load->model('index_interactionm', 'iim');
			$fcnums = $this->iim->get_vote_nums_by_catid($cat_id);
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			
			$navs_url = $this->config->item("nav_url");
			$this->load->model('Index_landscapem', 'ilm');
			
			$rows = $this->ilm->get_apage($cat_id);
			
			$data = array('prows' => $rows['a'][0],'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'fcrows' => $fcrows,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'pages' => $pdata['pages'],'page_info' => $pdata['page_info'],'base_url' => $pdata['config']['base_url']);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_page($cat_id); // 阅读数 + 1
			
			$this->load->view('index/header', $data);
			$this->load->view('index/interaction_cat_list1');
			$this->load->view('index/footer');
		}
	}

	public function type5($cat_id, $parent_id = null, $per_pages = null)
	{
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		
		/* 广告调取end */
		$this->load->model('index_interactionm', 'iim');
		$fcnums = $this->iim->get_vote_nums_by_catid($cat_id);
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'interaction/type5/' . $cat_id . '/' . $parent_id . '/';
		$config['total_rows'] = $fcnums;
		$config['uri_segment'] = 5;
		$config['last_link'] = $this->page_config['last_link'];
		$config['cur_tag_open'] = '<span class="page_now">';
		$config['cur_tag_close'] = '</span>';
		$config['prev_link'] = '上一页';
		$config['next_link'] = "下一页";
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['interaction_list'];
		$this->pagination->initialize($config);
		$pagenums = ceil($fcnums / $configs['interaction_list']);
		$_page = $get_pages < $configs['interaction'] ? 0 : $get_pages;
		$pdata['pages'] = $this->pagination->create_links();
		$pdata['page_info'] = array('nums' => $fcnums,'page_nums' => $pagenums,'now_page' => $_page / $configs['interaction_list'] + 1);
		$pdata['config']['base_url'] = $this->config->item("base_url");
		$limit0 = $this->uri->segment(5, 0);
		$limit0 = $limit0 < $config['per_page'] ? 0 : $limit0;
		
		$limitstr = $limit0 . "," . $config['per_page'];
		/* 分页类 end */
		
		$vote_rows = $this->iim->get_vote_by_catid_limit($cat_id, $limitstr);
		
		$this->load->model('index_landscapem', 'ilm');
		$now_nav2 = $this->ilm->get_category_by_catid($cat_id);
		
		$data = array('now_nav2' => $now_nav2[0],'fbrows' => $vote_rows,'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'fcrows' => $fcrows,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'pages' => $pdata['pages'],'page_info' => $pdata['page_info'],'base_url' => $pdata['config']['base_url']);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_cat_list5');
		$this->load->view('index/footer');
	}

	public function type6($cat_id, $parent_id = null, $per_pages = null)
	{
		if ($cat_id == 38 || empty($cat_id)) header('location:/index.php/interaction/complaint_list');
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$this->load->model('index_interactionm', 'iim');
		$fcnums = $this->iim->get_fb_nums_by_catid($cat_id);
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'interaction/type6/' . $cat_id . '/' . $parent_id . '/';
		$config['total_rows'] = $fcnums;
		$config['uri_segment'] = 5;
		$config['last_link'] = $this->page_config['last_link'];
		$config['cur_tag_open'] = '<span class="page_now">';
		$config['cur_tag_close'] = '</span>';
		$config['prev_link'] = '上一页';
		$config['next_link'] = "下一页";
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['interaction_list'];
		$this->pagination->initialize($config);
		$pagenums = ceil($fcnums / $configs['interaction_list']);
		$_page = $get_pages < $configs['interaction'] ? 0 : $get_pages;
		$pdata['pages'] = $this->pagination->create_links();
		$pdata['page_info'] = array('nums' => $fcnums,'page_nums' => $pagenums,'now_page' => $_page / $configs['interaction_list'] + 1);
		$pdata['config']['base_url'] = $this->config->item("base_url");
		
		$limit0 = $this->uri->segment(5, 0);
		$limit0 = $limit0 < $config['per_page'] ? 0 : $limit0;
		
		$limitstr = $limit0 . "," . $config['per_page'];
		
		/* 分页类 end */
		
		$this->load->model('index_landscapem', 'ilm');
		$now_nav2 = $this->ilm->get_category_by_catid($cat_id);
		
		$fbrows = $this->iim->get_feedback_by_catid_limit($cat_id, $limitstr);
		
		$data = array('now_nav2' => $now_nav2[0],'fbrows' => $fbrows,'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'fcrows' => $fcrows,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'pages' => $pdata['pages'],'page_info' => $pdata['page_info'],'base_url' => $pdata['config']['base_url']);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_cat_list6');
		$this->load->view('index/footer');
	}

	public function type2($cat_id, $parent_id = null, $per_pages = null)
	{
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		/* 广告调取end */
		$this->load->model('index_interactionm', 'iim');
		$fcnums = $this->iim->get_article_nums_by_catid($cat_id);
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'interaction/type2/' . $cat_id . '/' . $parent_id . '/';
		$config['total_rows'] = $fcnums;
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['cur_tag_open'] = '<span class="page_now">';
		$config['cur_tag_close'] = '</span>';
		$config['prev_link'] = '上一页';
		$config['next_link'] = "下一页";
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['interaction_article'];
		$this->pagination->initialize($config);
		$pagenums = ceil($fcnums / $configs['interaction_article']);
		$_page = $get_pages < $configs['interaction'] ? 0 : $get_pages;
		$pdata['pages'] = $this->pagination->create_links();
		$pdata['page_info'] = array('nums' => $fcnums,'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		$pdata['config']['base_url'] = $this->config->item("base_url");
		
		$limit0 = $this->uri->segment(5, 0);
		$limit0 = $limit0 < $config['per_page'] ? 0 : $limit0;
		
		$limitstr = $limit0 . "," . $config['per_page'];
		
		/* 分页类 end */
		
		$this->load->model('index_landscapem', 'ilm');
		$now_nav2 = $this->ilm->get_category_by_catid($cat_id);
		$fbrows = $this->iim->get_article_by_catid_limit($cat_id, $limitstr);
		
		$data = array('now_nav2' => $now_nav2[0],'fbrows' => $fbrows,'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'fcrows' => $fcrows,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url,'pages' => $pdata['pages'],'page_info' => $pdata['page_info'],'base_url' => $pdata['config']['base_url']);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/interaction_cat_list2');
		$this->load->view('index/footer');
	}

	public function vote($vote_id, $cat_id)
	{
		if ($vote_id !== 0) {
			/* 广告调取 */
			$this->load->model('index_get_adsm', 'igam');
			
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			/* 广告调取end */
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			
			$this->load->model('index_viewm', 'ivm');
			$vote_rows = $this->ivm->get_vote_question_option_by_catid($vote_id);
			$votes = $this->ivm->get_vote_by_vid($vote_id, $cat_id);
			if (! $votes['votes']) {
				action_message("/index.php", 3, '当前页面不存在，正在为您跳转到首页！', 0);
			}
			
			$this->load->model('index_landscapem', 'ilm');
			$now_nav2 = $this->ilm->get_category_by_catid($cat_id);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_vote($vote_id); // 阅读数 + 1
			
			$data = array('now_nav2' => $now_nav2[0],'vote_id' => $vote_id,'question' => $vote_rows,'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'votes' => $votes['votes'][0],'cats' => $votes['cats'],'cats_selected' => $cat_id,'nav_selected' => 4,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$this->load->view('index/header', $data);
			$this->load->view('index/vote_survey_content');
			$this->load->view('index/footer');
		}
	}

	public function vote_result($vote_id, $cat_id)
	{
		if ($vote_id !== 0) {
			// 广告调取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$data = array('left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'cats_selected' => $cat_id,'nav_selected' => 4,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$this->load->model('index_interactionm', 'iim');
			$stats = $this->iim->get_vote_stats_by_voteid($vote_id);
			$data['q_sam'] = $stats['qnums'];
			$data['op_sam'] = $stats['opnums'];
			
			$this->load->model('index_viewm', 'ivm');
			$vote_rows = $this->ivm->get_vote_question_option_by_catid($vote_id);
			$votes = $this->ivm->get_vote_by_vid($vote_id, $cat_id);
			$data['vote_id'] = $vote_id;
			$data['question_op'] = $vote_rows;
			$data['votes'] = $votes['votes'][0];
			$data['cats'] = $votes['cats'];
			
			$this->load->view('index/header', $data);
			$this->load->view('index/vote_survey_result');
			$this->load->view('index/footer');
		}
	}

	public function article($id = 0, $cat_id)
	{
		/* 新闻详情页 */
		if ($id !== 0) {
			/* 广告调取 */
			$this->load->model('index_get_adsm', 'igam');
			
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			/* 广告调取end */
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			
			$this->load->model('index_viewm', 'ivm');
			$news = $this->ivm->get_article_by_aid($id, $cat_id);
			$data = array('news' => $news['news'][0],'cats' => $news['cats'],'thumbs' => $news['thumbs'],'cats_selected' => $cat_id,'nav_selected' => 4,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_act($id); // 阅读数 + 1
			
			$this->load->view('index/header', $data);
			$this->load->view('index/interaction_article');
			$this->load->view('index/footer');
		}
	}

	public function feedback($id = 0, $cat_id, $per_pages = null)
	{
		/* 新闻详情页 */
		if ($id !== 0) {
			/* 广告调取 */
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			/* 广告调取end */
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$this->load->model('index_viewm', 'ivm');
			
			$fcnums = $this->ivm->get_feedback_content_nums_by_fid(array('f_id' => $id,'status' => 2));
			/* 引入分页类 */
			$get_pages = $per_pages !== null ? intval($per_pages) : 1;
			$this->load->library('pagination');
			$config['uri_segment'] = 5;
			$config['base_url'] = $this->config->item("base_url") . 'interaction/feedback/' . $id . '/' . $cat_id . '/';
			$config['total_rows'] = $fcnums;
			$config['last_link'] = "尾页";
			$config['cur_tag_open'] = '<span class="page_now">';
			$config['cur_tag_close'] = '</span>';
			$config['prev_link'] = '上一页';
			$config['next_link'] = "下一页";
			$configs = $this->config->item("page_size"); // 获取配置文件分页数
			$config['per_page'] = $configs['interaction_feedback_content'];
			$this->pagination->initialize($config);
			$pagenums = ceil($fcnums / $configs['interaction_feedback_content']);
			$_page = $get_pages < $configs['interaction_feedback_content'] ? 0 : $get_pages;
			$pdata['pages'] = $this->pagination->create_links();
			$pdata['page_info'] = array('nums' => $fcnums,'page_nums' => $pagenums,'now_page' => $_page / $configs['interaction_feedback_content'] + 1);
			$pdata['config']['base_url'] = $this->config->item("base_url");
			
			$limit0 = $this->uri->segment(5, 0);
			$limit0 = $limit0 < $config['per_page'] ? 0 : $limit0;
			$limitstr = $limit0 . "," . $config['per_page'];
			
			/* 分页类 end */
			$this->load->model('index_landscapem', 'ilm');
			$now_nav2 = $this->ilm->get_category_by_catid($cat_id);
			
			$fcrows = $this->ivm->get_feedback_content_by_fid($id, $limitstr);
			$feedback = $this->ivm->get_feedback_by_fid($id, $cat_id);
			
			if (! $feedback['feedback']) {
				action_message("/index.php", 3, '当前页面不存在，正在为您跳转到首页！', 0);
			}
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_feedback($id); // 阅读数 + 1
			
			$data = array('now_nav2' => $now_nav2[0],'page_info' => $pdata['page_info'],'fc_rows' => $fcrows,'pages' => $pdata['pages'],'fv_rows' => $feedback['fvrows'],'left_navs_selected' => $cat_id,'left_navs' => $this->left_navs,'feedback' => $feedback['feedback'][0],'cats' => $feedback['cats'],'cats_selected' => $cat_id,'nav_selected' => 4,'topad' => $topad,'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$this->load->view('index/header', $data);
			$this->load->view('index/interaction_feedback');
			$this->load->view('index/footer');
			// $this->output->cache(2);
		}
	}

	public function vote_handle($vote_id, $cat_id)
	{
		if ($vote_id) {
	        //验证码检验
		    if (strtoupper($this->input->post('yzm')) == $_SESSION['captchas']) {
				$pdata = $this->input->post(NULL, TRUE);
				
				// if (isset($pdata['type2'])) {
				// $type2arr = array_flip($pdata['type2']);
				// }
				
				// if (! isset($pdata['type1'])) {
				// action_message("javascript:history.back(-1);", 5, '单选选项未选择，请检查后重试！错误代码:1', 0);
				// }
				
				// if (count($pdata['type1']) != count($_POST['type1str'])) {
				// action_message("javascript:history.back(-1);", 5, '单选选项未选择，请检查后重试！错误代码:2', 0);
				// }
				
				// if (isset($pdata['type1']) and is_array($pdata['type1'])) {
				// foreach ($pdata['type1'] as $opkey => $opval) {
				// if ($opval == '' || empty($opval)) action_message("javascript:history.back(-1);", 5, '单选选项未勾选，请检查后重试！错误代码:3', 0);
				// }
				// }
				
				// // 对比type2str 与 $type2arr，求差集
				// $type2cj = array_diff_key($pdata['type2str'], $type2arr);
				// if (! empty($pdata['type2str']) and ! isset($pdata['type2'])) {
				// action_message("javascript:history.back(-1);", 5, '多选选项未选择，请检查后重试！错误代码:4', 0);
				// }
				
				// if (is_array($type2cj) and ! empty($type2cj)) {
				// action_message("javascript:history.back(-1);", 5, '多选选项未选择，请检查后重试！错误代码:5', 0);
				// }
				
				// if (isset($pdata['type2']) and is_array($pdata['type2'])) {
				// foreach ($pdata['type2'] as $opkey => $opval2) {
				// if ($opval2 == '' || empty($opval2)) action_message("javascript:history.back(-1);", 5, '仍有选项未勾选，请检查后重试', 0);
				// }
				// }
				
				$this->load->model('index_interactionm', 'iim');
				$result_voteid = $this->iim->get_vote_by_voteid($vote_id);
				
				if (empty($result_voteid[0]) || ! isset($result_voteid)) {
					action_message("/", 5, '非法传递参数，请联系管理员！', 0);
				}
				
				if ($result_voteid[0]->start_time > time()) {
					action_message("/", 5, '网上调查活动还没有开始，请稍后重试！', 0);
				}
				
				if ($result_voteid[0]->exp_time < time()) {
					action_message("/", 5, '网上调查活动已经结束了，请参与其他调查项目！', 0);
				}
				
				$vote_ip = $_SERVER['REMOTE_ADDR'];
				$vote_time = time();
				
				$user_result = $this->iim->check_vote_user("ip='$vote_ip' and vote_id='$vote_id' and ($vote_time - addtime)< 60*60*24 ");
				if ($user_result) {
					action_message('/index.php/interaction/type5/105/22/1', 5, '您已经投过票了，一天内同一IP只能投票一次，请稍候重试！', 0);
				}
				
				$udata['vote_id'] = $vote_id;
				$udata['ip'] = $vote_ip;
				$udata['addtime'] = $vote_time;
				$udata['name'] = "vote" . rand(10000, 20000) . 'user';
				$user_id = $this->iim->add_vote_user($udata);
				
				if ($user_id) {
					$sdata['user_id'] = $user_id;
					$sdata2['user_id'] = $user_id;
					$sdata3['user_id'] = $user_id;
					/* 单选入库数据统计表 */
					if (isset($pdata['type1']) and is_array($pdata['type1'])) {
						foreach ($pdata['type1'] as $opkey => $opval) {
							if ($opval != '') {
								$sdata['vote_id'] = $vote_id;
								$sdata['q_id'] = $opkey;
								$sdata['op_id'] = $opval;
								$result = $this->iim->do_add_vote_stats_handle($sdata);
							}
						}
					}
					
					if(count($pdata['type1'])==0&&count($pdata['type2'])>10){
						action_message("/index.php/interaction/vote/" . $vote_id . '/' . $cat_id, 3, '您已超出每次10个选项的最大选择量，请慎重投票。', 0);
					}
					if (isset($pdata['type2']) and is_array($pdata['type2'])) {
						foreach ($pdata['type2'] as $opkey2 => $opval2) {
							if ($opval2 != '') {
								$sdata2['vote_id'] = $vote_id;
								$sdata2['op_id'] = $opkey2; 
								$sdata2['q_id'] = $opval2;
								$result = $this->iim->do_add_vote_stats_handle($sdata2);
							}
						}
					}
					
					if (isset($pdata['type3']) and is_array($pdata['type3'])) {
						foreach ($pdata['type3'] as $opkey3 => $opval3) {
							$sdata3['vote_id'] = $vote_id;
							$sdata3['user_id'] = $user_id;
							$sdata3['q_id'] = $opkey3;
							$sdata3['content'] = empty($opval3) ? NULL : $opval3;
							$result = $this->iim->do_add_vote_ch_vote_type3_stats_handle($sdata3);
						}
					}
				}
				
				if ($result) {
					action_message("/index.php/interaction/vote_result/" . $vote_id . '/' . $cat_id, 5, '提交成功,稍后将跳转至投票结果页', 1);
				} else {
					action_message("/index.php/interaction/vote/" . $vote_id . '/' . $cat_id, 3, '操作失败', 0);
				}
			}  
		}
	}
    
		public function vote_handle_dateCode()
	{
	    //验证码检验
	      
		    if (strtoupper($this->input->post('yzm')) == $_SESSION['captchas']) {
			    echo json_encode(0,true);
			    exit;
			} else {
				echo json_encode(1,true);
			    exit;
			}	
	}
	public function feedback_handle($f_id, $cat_id)
	{
		if (! empty($f_id)) {
			$pdata = $this->input->post(NULL, TRUE);
			
			if (empty($_POST['f_code']) || strtoupper($_POST['f_code']) != $_SESSION['captchas']) {
				action_message('javascript:history.back(-1);', 6, '验证码输入错误，请重新输入验证码！', 0);
			}
			
			unset($pdata['f_code']);
			$this->load->model('index_viewm', 'ivm');
			$feedback = $this->ivm->get_feedback_by_fid($f_id, $cat_id);
			$fvs = $feedback['fvrows'];
			
			foreach ($fvs as $fvval) {
				if (empty($pdata[$fvval->vkey])) {
					action_message('javascript:history.back(-1);', 6, $fvval->value . '不能为空，请重新输入验证码！', 0);
				}
			}
			
			$pdata['f_id'] = $f_id;
			$pdata['addtime'] = time();
			$pdata['ip'] = $_SERVER['REMOTE_ADDR'];
			$pdata['adddate'] = date("Y-m-d", time());
			$this->load->model('index_interactionm', 'iim');
			$result = $this->iim->do_feedback_handle($pdata);
			if ($result) {
				action_message("/index.php/interaction/feedback/" . $f_id . '/' . $cat_id, 10, '提交成功，待管理员审核后显示', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function get_left_nav()
	{
		$this->load->model('admincategorym', 'acm');
		$crows = $this->acm->get_cat_by_parent_id2(10);
		if (is_array($crows['cat2'])) {
			foreach ($crows['cat2'] as $ppval) {
				$menu_arr['parent'][$ppval->cat_id] = $ppval->name;
			}
		}
		
		foreach ($crows['cat3'] as $c3key => $c3val) {
			
			foreach ($c3val as $ssval) {
				if ($ssval->is_menu == 1) {
					if ($ssval->is_redirect == 1 && ! empty($ssval->redirect_url)) {
						$url = $ssval->redirect_url . '" target="_blank"';
					} elseif ($ssval->status == 1) {
						// $url='/index.php/category/'.$ssval->cat_type_id.'/'.$ssval->cat_id.'/'.$ssval->parent_id.'/'.$ssval->level.'/1';
						$url = '/index.php/interaction/type' . $ssval->cat_type_id . '/' . $ssval->cat_id . '/' . $ssval->parent_id . '/1';
					}
					$menu_arr['son'][$c3key][$ssval->cat_id] = array('name' => $ssval->name,'url' => $url,cat_id => $ssval->cat_id);
				}
			}
		}
		
		return $menu_arr['son'];
	}
}
