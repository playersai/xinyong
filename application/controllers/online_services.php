<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Online_services extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('myurl','handle_json'));
	}

	public function index()
	{
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		$floatad = $this->igam->get_float_ad(161); // 网上服务漂浮广告 cat=161
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'floatad' => $floatad[0],'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_online_services', 'm_os');
		$data['row_grfw'] = $this->m_oi->get_openList_by_parentid(20);
		$data['row_qyfw'] = $this->m_oi->get_openList_by_parentid(21);
		$data['row_snfw'] = $this->m_oi->get_openList_by_parentid(22);
		
		// 表格下载
		$link = $this->m_oi->get_openJsonLink_by_id(4)->link;
		$data['row_0'] = get_jsons($link, 'rows', 6);
		
		// 执法依据
		$data['row_zfyj'] = $this->m_os->get_category_by_parentid(86, 16);
		
		// 查询汇总（先保留，目前模板做成静态）
		/*
		 * $results = $this->m_oi->get_openList_by_parentid(1); foreach ($results as $result) { switch ($result->name) { case '公众教育': $data['row_1'] = get_jsons($result->link, 'list', $result->rownum); break; case '医疗卫生': $data['row_2'] = get_jsons($result->link, 'list', $result->rownum); break; case '社会保险': $data['row_3'] = get_jsons($result->link, 'list', $result->rownum); break; case '交通出行': $data['row_4'] = get_jsons($result->link, 'list', $result->rownum); break; case '公用事业': $data['row_5'] = get_jsons($result->link, 'list', $result->rownum); break; case '价格收费': $data['row_6'] = get_jsons($result->link, 'list', $result->rownum); break; case '公积金房产': $data['row_7'] = get_jsons($result->link, 'list', $result->rownum); break; case '气象水文': $data['row_8'] = get_jsons($result->link, 'list', $result->rownum); break; case '财税金融': $data['row_9'] = get_jsons($result->link, 'list', $result->rownum); break; case '公安司法': $data['row_10'] = get_jsons($result->link, 'list', $result->rownum); break; } }
		 */
		
		// 底部导航
		$this->load->model('index_homem', 'ahm');
		$data['link'] = $this->ahm->get_link("where type_id=0", 6);
		$data['link_1'] = $this->ahm->get_link("where type_id=1");
		$data['link_2'] = $this->ahm->get_link("where type_id=2");
		$data['link_3'] = $this->ahm->get_link("where type_id=3");
		$data['link_4'] = $this->ahm->get_link("where type_id=4");
		$data['link_5'] = $this->ahm->get_link("where type_id=5");
		$data['link_6'] = $this->ahm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services');
		$this->load->view('index/footer_nav');
	}

	public function legal($catid = null)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->model('model_online_services', 'm_os');
		$data['row_zfyj'] = $this->m_os->get_legal_apage(20);
		$data['catid'] = ($catid == null) ? $data['row_zfyj'][0]->cat_id : $catid;
		
		$this->load->model('model_stats', 'm_stats');
		$this->m_stats->stats_addonce_page($catid); // 阅读数 + 1
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_legal_basis');
		$this->load->view('index/footer');
	}

	public function utility()
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->database();
		$query = $this->db->get_where('ch_openinfo_set', array('type' => 'json','link <>' => '','parent' => '实用查询'));
		foreach ($query->result() as $result) {
			switch ($result->name) {
				case '公众教育':
					$data['row_1'] = get_jsonAll($result->link, 'list');
					break;
				case '医疗卫生':
					$data['row_2'] = get_jsonAll($result->link, 'list');
					break;
				case '社会保险':
					$data['row_3'] = get_jsonAll($result->link, 'list');
					break;
				case '交通出行':
					$data['row_4'] = get_jsonAll($result->link, 'list');
					break;
				case '公用事业':
					$data['row_5'] = get_jsonAll($result->link, 'list');
					break;
				case '价格收费':
					$data['row_6'] = get_jsonAll($result->link, 'list');
					break;
				case '公积金房产':
					$data['row_7'] = get_jsonAll($result->link, 'list');
					break;
				case '气象水文':
					$data['row_8'] = get_jsonAll($result->link, 'list');
					break;
				case '财税金融':
					$data['row_9'] = get_jsonAll($result->link, 'list');
					break;
				case '公安司法':
					$data['row_10'] = get_jsonAll($result->link, 'list');
					break;
			}
		}
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_utility_query');
		$this->load->view('index/footer');
	}

	public function form($curPage = 1)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$curPage = intval($curPage);
		$query = $this->db->get_where('ch_openinfo_set', array('name' => '表格下载','type' => 'json','link <>' => ''));
		$result = $query->result();
		$json = get_json_pageList($result[0]->link, 'rows', $curPage, 15);  
		$data['rows'] = $json['rows'];  
		$data['total'] = $json['total'];
		$data['pageCount'] = $json['pageCount'];
		
		$baseUrl = $this->config->item("base_url") . 'online_services/form/';
		$data['pageLink'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_form_list');
		$this->load->view('index/footer');
	}

	public function service($main_id = 20, $main_subid = NULL, $service_id = NULL, $curPage = 1)
	{
		$main_id = intval($main_id);
		$service_id = intval($service_id);
		
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_online_services', 'm_os');
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		if ($main_id >= 20 && $main_id <= 22) {
			$main_subid = ($main_subid == NULL) ? intval($this->m_oi->get_openDefaultid_by_id($main_id)->defaultid) : $main_subid;
			$service_id = ($service_id == NULL) ? intval($this->m_oi->get_openDefaultid_by_id($main_subid)->defaultid) : $service_id;
		}
		
		$data['main_id'] = $main_id;
		$data['main_subid'] = $main_subid;
		$data['service_id'] = $service_id;
		$data['row_main'] = $this->m_oi->get_openList_by_parentid($main_id);
		$data['row_main_sub'] = $this->m_oi->get_openList_by_parentid($main_subid);
		
		$link = $this->m_oi->get_openJsonLink_by_id($service_id)->link;
		$json = get_json_pageList($link, 'list', $curPage, 5);
		
		$data['rows'] = $json['rows'];
		$data['total'] = $json['total'];
		$data['pageCount'] = $json['pageCount'];
		
		$baseUrl = $this->config->item("base_url") . 'online_services/service/' . $main_id . '/' . $main_subid . '/' . $service_id . '/';
		$data['pageLink'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_service_list');
		$this->load->view('index/footer');
	}

	public function state($mainid = 23, $serviceid = NULL, $curPage = 1)
	{
		$mainid = intval($mainid);
		$serviceid = intval($serviceid);
		
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_online_services', 'm_os');
		
		if ($mainid >= 23 && $mainid <= 34 && $serviceid == NULL) {
			$serviceid = intval($this->m_oi->get_openDefaultid_by_id($mainid)->defaultid);
		}
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$data['mainid'] = $mainid;
		$data['serviceid'] = $serviceid;
		if ($mainid == 26) {
			$data['service_name'] = '招商引资';
		} else if ($mainid == 34) {
			$data['service_name'] = '电子地图';
		} else {
			$data['service_name'] = $this->m_oi->get_openinfo_by_id($serviceid)->name;
		}
		
		$data['row_service'] = $this->m_oi->get_openList_by_parentid($mainid);
		
		$link = $this->m_oi->get_openJsonLink_by_id($serviceid)->link;
		$json = get_json_pageList($link, 'list', $curPage, 10);
		$data['rows'] = $json['rows'];
		$data['total'] = $json['total'];
		$data['pageCount'] = $json['pageCount'];
		
		$baseUrl = $this->config->item("base_url") . 'online_services/service/' . $mainid . '/' . $serviceid . '/';
		$data['pageLink'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_public_service_list');
		$this->load->view('index/footer');
	}

	public function view($showType, $id)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		if ($showType == 'guide') {
			$pageURL = 'http://www.zs.gov.cn/main/services/content/index.action?id=' . $id;
			include 'application/libraries/phpQuery.php';
			phpQuery::newDocumentFile($pageURL);
			
			// 获取标题
			$title = pq('#open_show2')->find('h6')->text();
			
			// 获取链接
			$links = pq('.bszn')->find('a');
			foreach ($links as $link) {
				$row_link['name'] = pq($link)->text();
				$row_link['url'] = safeUrl(pq($link)->attr('href'), 'gbk');
				if (substr($row_link['url'], 0, 1) == '/') {
					$row_link['url'] = 'http://www.zs.gov.cn' . $row_link['url'];
				}
				$row_links[] = $row_link;
			}
			$data['title'] = $title;
			$data['links'] = $row_links;
			
			// 检查是否存在tab分页
			if (pq('.tabs0.clearfix')->html()) {
				$menus = pq('.menubox3')->find('li');
				foreach ($menus as $menu) {
					$tab_menu[] = pq($menu)->text();
				}
				
				$mains = pq('.mainbox3')->find('ul');
				foreach ($mains as $main) {
					$main = pq($main)->html();
					
					if (strpos($main, '<a href="/')) {
						$main = str_replace('<a href="/', '<a href="http://www.zs.gov.cn/', $main);
					}
					
					if (strpos($main, 'src="/')) {
						$main = str_replace('src="/', 'src="http://www.zs.gov.cn/', $main);
					}
					
					$tab_main[] = iconv('gbk', 'utf-8', $main);
				}
				
				$data['is_tab'] = 1;
				$data['tab_menu'] = $tab_menu;
				$data['tab_main'] = $tab_main;
			} else {
				$content = pq('#bubugao2')->html();
				$content = iconv('gbk', 'utf-8', $content);
				
				$data['is_tab'] = 0;
				$data['content'] = $content;
			}
		}
		$this->load->view('index/header', $data);
		$this->load->view('index/online_services_service_content');
		$this->load->view('index/footer');
	}

	public function search($searchType, $queryStr = NULL, $curPage = 1)
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 3,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		if ($queryStr == null) $queryStr = 'MEBA';
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		
		$type = $queryArr[0];
		$query = $queryArr[1];
		$deptName = $queryArr[2];
		
		$data['type'] = $type;
		$data['query'] = $query;
		$data['deptName'] = $deptName;
		
		$query = urlencode(urlencode($queryArr[1]));
		$deptName = urlencode(urlencode($queryArr[2]));
		
		if ($searchType == 'all') {
			$link = 'http://www.zs.gov.cn/ajax/servicePage.action?type=' . $type . '&query=' . $query . '&deptName=' . $deptName . '&dirId=0&curPage=' . $curPage . '&pageSize=5&timestamp=1408674047758';
			$json = get_json_pageList($link, 'list', $curPage, 10);
		} else {
			$link = 'http://www.zs.gov.cn/ajax/serviceFlowList.action?query=' . $query . '&deptName=&curPage=' . $curPage . '&pageSize=19&timestamp=1408956179772&type=0&dirId=0';
			$json = get_json_pageList($link, 'rows', $curPage, 10);
		}
		
		$data['rows'] = $json['rows'];
		$data['total'] = $json['total'];
		$data['pageCount'] = $json['pageCount'];
		
		$baseUrl = $this->config->item("base_url") . 'online_services/search/' . $searchType . '/' . $queryStr . '/';
		$data['pageLink'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		
		$this->load->view('index/header', $data);
		if ($searchType == 'all')
			$this->load->view('index/online_services_service_search');
		else
			$this->load->view('index/search_list');
		$this->load->view('index/footer');
	}
}
