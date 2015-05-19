<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('myurl','handle_json'));
		$this->load->database();
		$this->load->library('pagination');
		
		$this->page_config['first_link'] = '首页';
		$this->page_config['last_link'] = '尾页';
		$this->page_config['prev_link'] = '上一页';
		$this->page_config['next_link'] = '下一页';
		$this->page_config['cur_tag_open'] = '<span class="page_now">';
		$this->page_config['cur_tag_close'] = '</span>';
		$this->page_config['per_page'] = 10;
	}

	public function index($enStr)
	{
		if ($enStr == NULL) {
			exit();
		}
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middlead' => $middlead,'navs' => $navs,'nav_selected' => 0,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/search/index/' . $enStr . '/';
		
		$queryStr = urlsafe_b64decode($enStr);
		
		$sqlStr = "select aid from (select aid,cat_id,title from ch_articles UNION select id,cat_id,name from ch_apage) t where title like '%$queryStr%'";
		$total_rows = $query = $this->db->query($sqlStr)->num_rows();
		
		$limiyStr = "limit " . ($this->uri->segment(4) != null ? $this->uri->segment(4) : 0) . ',' . $config['per_page'];
		$sqlStr = "select t.*,cat_type_id,parent_id from (select aid,cat_id,title,'' as 'page_url',addtime from ch_articles UNION select id,cat_id,name,page_url,addtime from ch_apage) t ";
		$sqlStr .= " left join ch_category on ch_category.cat_id = t.cat_id ";
		$sqlStr .= " where title like '%$queryStr%'" . $limiyStr;
		$rows = $query = $this->db->query($sqlStr)->result();
		
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['rows'] = $rows;
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		$data['query'] = $queryStr;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/search_list_all');
		$this->load->view('index/footer');
	}
}