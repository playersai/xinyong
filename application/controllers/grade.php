<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Grade extends CI_Controller
{

	public $page_config;

	public $left_navs = array();

	public function __construct()
	{
		parent::__construct();
				
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
		
		$data = array('left_navs_selected' => 38,'left_navs' => $this->left_navs,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url,'types' => $types,'type_selected' => 0);
		$this->load->view('index/header', $data);
		$this->load->view('index/grade_complaint_form');
		$this->load->view('index/footer');
	}

	 
	  
	public function handle()
	{
		/* 我要投诉下的镇长信箱 办事咨询 投诉监督 提交处理 */
		if (isset($_POST)) {
			 
			$this->load->model('index_grade', 'ig');
			$pdata = $this->input->post(NULL, TRUE);
			 
		    unset($pdata['btnSubmit']);
			$pdata['trustworthiness_rank']=implode(',',$pdata['trustworthiness_rank']);
			$pdata['civilized_rank']=implode(',',$pdata['civilized_rank']);
			$pdata['quality_rank']=implode(',',$pdata['quality_rank']);
			$pdata['contract_rank']=implode(',',$pdata['contract_rank']);
			$pdata['services_rank']=implode(',',$pdata['services_rank']);
			$pdata['i_quality_rank']=implode(',',$pdata['i_quality_rank']);
			$pdata['trade_mark_rank']=implode(',',$pdata['trade_mark_rank']);
			$pdata['sincerity_rank']=implode(',',$pdata['sincerity_rank']);
			$pdata['qe_rank']=implode(',',$pdata['qe_rank']);
			$pdata['china_authentication']=implode(',',$pdata['china_authentication']);
			$pdata['example_rank']=implode(',',$pdata['example_rank']);
		 
		 
			/*
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
			*/
			$pdata['addtime'] = time();
		 
			//$pdata['ip'] = $_SERVER['REMOTE_ADDR'];
			//$pdata['f_id'] = $feedback[0]->f_id;
			
			// $handle_id格式：$date(8位) + $type_id(1位) + num(4位) 2014090930001
			//$_num = $this->ig->get_fc_new_handleid_num();
			//$_handle_id = date('Ymd', time()) . $pdata['type_id'] . $_num;
			
			//$pdata['query_password'] = rand(100, 999) . rand(300, 800);
			//$pdata['handle_id'] = $_handle_id;
		 
			$result = $this->ig->do_handle($pdata);
			if ($result) {
				action_message('/index.php/grade/complaint_form', 90, '提交成功！你可以通过企业名字来查询进度！', 1);
			}
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
 
 
}
