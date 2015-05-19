<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_page extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('myurl','handle_json'));
		
		$this->page_config['first_link'] = '首页';
		$this->page_config['last_link'] = '尾页';
		$this->page_config['prev_link'] = '上一页';
		$this->page_config['next_link'] = '下一页';
		$this->page_config['cur_tag_open'] = '<span class="page_now">';
		$this->page_config['cur_tag_close'] = '</span>';
		$this->page_config['per_page'] = 10;
	}

	public function index($id = 0)
	{
		if ($id != 0) {
			
			$this->load->model('index_topicm', 'itm');
			$topic_info = $this->itm->get_topic_by_catid($id);
			if ($topic_info[0]->is_redirect == '1' and ! empty($topic_info[0]->redirect_url)) {
				$url = $topic_info[0]->redirect_url;
				header("location:$url");
				exit();
			}
			
			$topic_nav = $this->itm->get_topic_nav_by_catid($id);
			$data = array('topic_nav' => $topic_nav,'topic_info' => $topic_info[0]);
			
			// 幻灯片图文
			foreach ($topic_nav as $key => $tnval) {
				$catin[] = $tnval->cat_id;
				if ($tnval->cat_type_id == 3) {
					$plist['cat'][] = $tnval->name;
					$plist['thumbs'][] = $this->itm->get_thumbs_by_catid($tnval->cat_id, 10);
				}
				
				if ($tnval->cat_type_id == 7) {
					$list['list_info'] = $tnval;
					if ($key == 0)
						$list['list_topic'] = $this->itm->get_topic($tnval->cat_id, array(0,8));
					else
						$list['list_topic'] = $this->itm->get_topic($tnval->cat_id, array(0,6));
					$lists[] = $list;
				}
			}
			$cat_in = join(',', $catin);
			$topic_thumbs = $this->itm->get_index_thumb_article(6, $cat_in);
			$data['thumbs'] = $topic_thumbs;
			
			// $tthumbs = $this->itm->get_topic_thumbs(10, $cat_in);
			// $data['tthumbs'] = $tthumbs;
			
			$data['html_title'] = $topic_info[0]->name;
			$data['lists'] = $lists;
			$data['pname'] = $plist['cat'][0];
			$data['plist'] = $plist['thumbs'][0];
			
			$this->load->view('index/topic_page', $data);
			$this->load->view('index/topic_footer');
		} else {
			header("location:/index.php/topic_page/lists");
		}
	}

	public function lists()
	{
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		$floatad = $this->igam->get_float_ad(164); // 热点专题漂浮广告 cat=164
		$data = array('topad' => $topad,'floatad' => $floatad[0],'navs' => $navs,'nav_selected' => 5,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->library('pagination');
		$this->load->model('Index_viewm', ivm);
		$result_nums = $this->ivm->get_topic_by_level_nums();
	
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'topic_page/lists/';
		$config['total_rows'] = $result_nums;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['rows'] = $this->ivm->get_topic_by_level($this->uri->segment(3), $config['per_page']);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		// 底部导航
		$this->load->model('index_homem', 'ihm');
		$data['link'] = $this->ihm->get_link('where type_id=0', 6);
		$data['link_1'] = $this->ihm->get_link("where type_id=1");
		$data['link_2'] = $this->ihm->get_link("where type_id=2");
		$data['link_3'] = $this->ihm->get_link("where type_id=3");
		$data['link_4'] = $this->ihm->get_link("where type_id=4");
		$data['link_5'] = $this->ihm->get_link("where type_id=5");
		$data['link_6'] = $this->ihm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/topic_page_index');
		$this->load->view('index/footer_nav');
	}

	public function cat($id = 0, $per_pages = null)
	{ 
		if ($id != 0) {
			$this->load->library('pagination');
			$this->load->model('index_homem', 'ihm');
			$this->load->model('index_topicm', 'itm');
			
			$topic_info = $this->itm->get_topic_by_son_catid($id);
			$topic_nav = $this->itm->get_topic_nav_by_catid($topic_info[0]->cat_id);
			$data = array('topic_nav' => $topic_nav,'topic_info' => $topic_info[0],'nav_selected' => $id);
			$data['html_title'] = $topic_info[0]->name;
			
			$cat_type = $this->ihm->get_cat_by_catid($id);
			$cat_type = $cat_type[0]->cat_type_id;
			
			$config = $this->page_config;
			$config['uri_segment'] = 3;
			$config['base_url'] = $this->config->item("base_url") . 'topic_page/' . $id . '/';
			
			switch ($cat_type) {
				case 3:
					$this->load->model('index_landscapem', 'ilm');
					$config['total_rows'] = $this->ilm->get_photos_by_catid($id);
					
					$limit = $this->uri->segment(3) != null ? $this->uri->segment(3) : 0;
					$offset = $config['per_page'];
					$data['rows'] = $this->ilm->get_photos($id, array($limit,$offset));
					
					$this->pagination->initialize($config);
					
					$data['totalRows'] = $config['total_rows'];
					$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
					$data['pageLink'] = $this->pagination->create_links();
					
					$this->load->view('index/topic_header', $data);
					$this->load->view('index/topic_page_list_thumb');
					$this->load->view('index/topic_footer');
					break;
				
				case 7:
					
					$config['total_rows'] = $this->itm->get_article_nums($id);
					
					$limit = $this->uri->segment(3) != null ? $this->uri->segment(3) : 0;
					$offset = $config['per_page'];
					$data['rows'] = $this->itm->get_topic($id, array($limit,$offset));
					
					$this->pagination->initialize($config);
					
					$data['totalRows'] = $config['total_rows'];
					$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
					$data['pageLink'] = $this->pagination->create_links();
					
					$this->load->view('index/topic_header', $data);
					$this->load->view('index/topic_page_list');
					$this->load->view('index/topic_footer');
					break;
			}
		}
	}

	public function view($aid, $cat_id)
	{
		if ($aid != 0 && ! empty($cat_id)) {
			$this->load->model('index_topicm', 'itm');
			$topic_info = $this->itm->get_topic_by_son_catid($cat_id);
			$topic_nav = $this->itm->get_topic_nav_by_catid($topic_info[0]->cat_id);
			$arows = $this->itm->get_article_by_aid($aid);
			
			$data = array('arows' => $arows[0],'topic_nav' => $topic_nav,'topic_info' => $topic_info[0],'nav_selected' => $cat_id);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_topic($aid); // 阅读数 + 1
			
			$this->load->view('index/topic_header', $data);
			$this->load->view('index/topic_page_view');
			$this->load->view('index/topic_footer');
		}
	}

	public function thumb($photo_id, $cat_id)
	{
		if ($photo_id != null) {
			$this->load->model('index_topicm', 'itm');
			
			$topic_info = $this->itm->get_topic_by_son_catid($cat_id);
			$topic_nav = $this->itm->get_topic_nav_by_catid($topic_info[0]->cat_id);
			$data = array('topic_nav' => $topic_nav,'topic_info' => $topic_info[0],'nav_selected' => $cat_id);
			
			$this->load->model('index_viewm', 'ivm');
			$rows = $this->ivm->get_photo_by_photoid($photo_id);
			$data['photo_info'] = $rows['photo'][0];
			$data['thumb_rows'] = $rows['p_thumb'];
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_photo($photo_id); // 阅读数 + 1
			
			$this->load->view('index/topic_header', $data);
			$this->load->view('index/topic_page_view_thumb');
			$this->load->view('index/topic_footer');
		}
	}
}
