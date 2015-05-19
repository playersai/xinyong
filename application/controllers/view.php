<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($id = 0, $cat_id)
	{
		if ($id !== 0) {
			$this->load->model('index_viewm', 'ivm');
			$this->ivm->get_article_by_aid();
			
			$this->load->view('index/header');
			$this->load->view('index/news');
			$this->load->view('index/footer');
		}
	}

	public function news($id = 0, $cat_id)
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
			$data = array('news' => $news['news'][0],'cats' => $news['cats'],'thumbs' => $news['thumbs'],'cats_selected' => $cat_id,'nav_selected' => 8,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			// print_r($data);
			$this->load->view('index/header', $data);
			$this->load->view('index/news');
			$this->load->view('index/footer');
			// $this->output->cache(2);
		}
	}

	public function thumb($id = 0, $cat_id)
	{
		/* 图集详情页 */
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
			$thumbs_row = $this->ivm->get_photo_by_photoid($id);
			$nav_location = $this->ivm->get_nav_locaiton($cat_id);
			
			$data = array('photo_info' => $thumbs_row['photo'][0],'thumb_rows' => $thumbs_row['p_thumb'],'cats_selected' => $cat_id,'nav_selected' => 2,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url,'nav_location' => $nav_location);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_photo($id); // 阅读数 + 1
			
			$this->load->view('index/header', $data);
			$this->load->view('index/thumb_view');
			$this->load->view('index/footer');
		}
	}

	public function vedio($id = 0, $cat_id)
	{
		/* 视频详情页 */
		if ($id !== 0) {
			// 广告调取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			
			$this->load->model('index_viewm', 'ivm');
			$vedio_row = $this->ivm->get_vedio_by_vid($id);
			$nav_location = $this->ivm->get_nav_locaiton($cat_id);
			
			$data = array('vedio_row' => $vedio_row[0],'cats_selected' => $cat_id,'nav_selected' => 4,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url,'nav_location' => $nav_location);
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_video($id); // 阅读数 + 1
			
			$this->load->view('index/header', $data);
			$this->load->view('index/vedio_view');
			$this->load->view('index/footer');
		}
	}

	public function vote($vote_id = 0, $cat_id)
	{
		/* 调查详情页 */
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
			$votes = $this->ivm->get_vote_by_vid($vote_id, $cat_id);
			$data = array('votes' => $votes['votes'][0],'cats' => $votes['cats'],'cats_selected' => $cat_id,'nav_selected' => 8,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$this->load->view('index/header', $data);
			$this->load->view('index/vote_survey_content');
			$this->load->view('index/footer');
		}
	}

	public function page($catid)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => - 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->model('model_open_goverment', 'm_og');
		$rows = $this->m_og->get_apage_by_catid($catid);
		if ($rows) {
			$data['category_id'] = 'page';
			$data['title'] = $rows[0]->name;
			$data['content'] = $rows[0]->content;
			$data['addtime'] = date("Y-m-d", $rows[0]->addtime);
			$this->load->view('index/header', $data);
			$this->load->view('index/page');
			$this->load->view('index/footer');
		}
	}
}
