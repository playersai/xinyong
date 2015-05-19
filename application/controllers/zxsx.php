<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Zxsx extends CI_Controller
{

	public $page_config;

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

	public function index()
	{
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_zxsx', 'm_og');
		$this->load->model('index_topicm', 'itm');
		$this->load->model('index_homem', 'ahm');
		
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		$floatad = $this->igam->get_float_ad(160); // 政务公开漂浮广告 cat=160
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'floatad' => $floatad[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		// 首页左侧幻灯片图文
		$thumbs = $this->ahm->get_index_thumb_article(6);
		$data['thumbs'] = $thumbs;
		
		// 中山要闻
		$link = $this->m_oi->get_openJsonLink_by_id(101)->link;
		$data['row_zsyw'] = get_jsons($link, 'rows', 8);
		
		// 板芙新闻、部门动态、媒体聚焦
		$data['news_bfxw'] = $this->ahm->get_index_article('cat_id=5 and index_top=0', 8);
		$data['news_bmdt'] = $this->ahm->get_index_article('cat_id=6 and index_top=0', 8);
		$data['news_mtjj'] = $this->ahm->get_index_article('cat_id=7 and index_top=0', 8);
		
		// 通知公告（9）
		$data['row_tzgg'] = $this->m_og->get_acticle_by_catid(9, 5);
		
		// 人事信息（cat_id：70）（json：468）
		// $data['row_rsxx'] = $this->m_og->get_acticle_by_catid(70, 5);
		$link_rsxx = $this->m_oi->get_openJsonLink_by_id(468)->link;
		$data['row_rsxx'] = get_jsons($link_rsxx, 'rows', 5);
		
		// 政策文件（cat_id：69）（json：103）
		// $data['row_zcwj'] = $this->m_og->get_acticle_by_catid(69, 5);
		$link_zcwj = $this->m_oi->get_openJsonLink_by_id(103)->link;
		$data['row_zcwj'] = get_jsons($link_zcwj, 'rows', 5);
		
		// 规划计划（cat_id：71）（json：104）
		// $data['row_fzjh'] = $this->m_og->get_acticle_by_catid(71, 5);
		$link_fzjh = $this->m_oi->get_openJsonLink_by_id(469)->link;
		$data['row_fzjh'] = get_jsons($link_fzjh, 'rows', 5);
		
		// 统计数据（cat_id：73）（json：105）
		// $data['row_tjsj'] = $this->m_og->get_acticle_by_catid(73, 5);
		$link_tjsj = $this->m_oi->get_openJsonLink_by_id(105)->link;
		$data['row_tjsj'] = get_jsons($link_tjsj, 'rows', 5);
		
		// 招商引资（cat_id：74）（json：106）
		// $data['row_zsyz'] = $this->m_og->get_acticle_by_catid(74, 5);
		$link_zsyz = $this->m_oi->get_openJsonLink_by_id(106)->link;
		$data['row_zsyz'] = get_jsons($link_zsyz, 'rows', 5);
		
		// 招标公示（cat_id：183）
		$data['row_zbgs'] = $this->m_og->get_acticle_by_catid(183, 5);
		
		// 重大项目（75）
		$data['row_zdxm'] = $this->m_og->get_acticle_by_catid(75, 5);
		
		// 财政信息（cat_id：76）（json：108）
		// $data['row_czxx'] = $this->m_og->get_acticle_by_catid(76, 5);
		$link_czxx = $this->m_oi->get_openJsonLink_by_id(108)->link;
		$data['row_czxx'] = get_jsons($link_czxx, 'rows', 5);
		
		// 热点专题
		$topic_rows = $this->ahm->get_index_topic(8);
		$data['row_rdzt'] = $topic_rows;
		
		// 底部导航
		$data['link'] = $this->ahm->get_link("where type_id=0", 6);
		$data['link_1'] = $this->ahm->get_link("where type_id=1");
		$data['link_2'] = $this->ahm->get_link("where type_id=2");
		$data['link_3'] = $this->ahm->get_link("where type_id=3");
		$data['link_4'] = $this->ahm->get_link("where type_id=4");
		$data['link_5'] = $this->ahm->get_link("where type_id=5");
		$data['link_6'] = $this->ahm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/open_goverment');
		$this->load->view('index/footer_nav');
	}

	public function lists($catid = NULL, $curPage = 1)
	{
		$this->load->library('pagination');
		$this->load->model('model_zxsx', 'm_og');
		$this->load->model('model_openinfo', 'm_oi');
		
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		                                                           
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$curPage = intval($curPage);
		$data['listType']="";
		$arr_catid = array('zcwj','rsxx','zsyz','fzjh','zfwork','tjsj','czxx','gkzn','gkbg','gkgd','sqgk');
		if (in_array($catid, $arr_catid)) {
			if ($catid == 'zcwj') {
				$data['categoryName'] = '政策文件';
				$link = $this->m_oi->get_openJsonLink_by_id(103)->link;
			} else if ($catid == 'rsxx') {
				$data['categoryName'] = '人事信息';
				$link = $this->m_oi->get_openJsonLink_by_id(468)->link;
			} else if ($catid == 'zsyz') {
				$data['categoryName'] = '招商引资';
				$link = $this->m_oi->get_openJsonLink_by_id(106)->link;
			} else if ($catid == 'fzjh') {
			    $data['listType']='1';
				$data['categoryName'] = '规划计划';
				$link = $this->m_oi->get_openJsonLink_by_id(469)->link;
			} else if ($catid == 'zfwork') {
			    $data['listType']='2';
				$data['categoryName'] = '政府工作报告';
				$link = $this->m_oi->get_openJsonLink_by_id(470)->link;
			} else if ($catid == 'tjsj') {
				$data['categoryName'] = '统计数据';
				$link = $this->m_oi->get_openJsonLink_by_id(105)->link;
			} else if ($catid == 'czxx') {
				$data['categoryName'] = '财政信息';
				$link = $this->m_oi->get_openJsonLink_by_id(108)->link;
			} else if ($catid == 'gkzn') {
				$data['categoryName'] = '信息公开指南';
				$link = $this->m_oi->get_openJsonLink_by_id(109)->link;
			} else if ($catid == 'gkbg') {
				$data['categoryName'] = '公开年度报告';
				$link = $this->m_oi->get_openJsonLink_by_id(111)->link;
			} else if ($catid == 'sqgk') {
				header("location:/index.php/open_goverment/view/sqgk");
				exit();
			} else if ($catid == 'gkgd') {
				header("location:/index.php/open_goverment/view/gkgd");
				exit();
			}
			
			$json = get_json_pageList($link, 'rows', $curPage, $this->page_config['per_page']);
			
			$data['isJsonData'] = true;
			$data['catid'] = $catid;
			
			$data['rows'] = $json['rows'];
			$data['totalRows'] = $json['total'];
			$data['totalPages'] = $json['pageCount'];
		 
			$baseUrl = $this->config->item("base_url") . 'open_goverment/lists/'.$catid.'/';
			$data['link'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		} else {
			$catid = intval($catid);
			if ($catid == 0) {
				action_message("/index.php", 3, '您访问的页面不存在！', 0);
				exit();
			}
			
			$config = $this->page_config;
			$config['base_url'] = $this->config->item("base_url") . '/open_goverment/lists/' . $catid . '/';
			$config['total_rows'] = $this->m_og->get_article_count($catid);
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			
			$data['isJsonData'] = false;
			$data['catid'] = $catid;
			$category = $this->m_og->get_category_by_catid($catid);
			$data['categoryName'] = $category[0]->name;
			$data['rows'] = $this->m_og->get_article_limitPage($catid, $config['per_page'], $this->uri->segment(4));
			$data['totalRows'] = $config['total_rows'];
			$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
			$data['link'] = $this->pagination->create_links();
			
		}
		$this->load->view('index/header', $data);
		$this->load->view('index/open_goverment_list');
		$this->load->view('index/footer');
	}

	public function nlists($listType = 'news', $catid = NULL, $curPage = 1)
	{ 
		$this->load->library('pagination');
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_zxsx', 'm_og');
	 
			// 广告读取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);

		if ($listType == 'news' && $catid == NULL) {
			$catid = 5;
		}
 	    if ($listType == 'rsxx' && $catid == NULL) {
			$catid = 225;
		}
		if ($listType == 'notice' && $catid == NULL) {
			$catid = 9;
		}
		
		if ($listType == 'tender' && $catid == NULL) {
			$catid = 183;
		}
		if ($listType == 'qzqd' && $catid == NULL) {
			$catid = 237;
		}
		$here="header";
		if ($catid == 'zsyw') {
			$curPage = intval($curPage);
			$link = $this->m_oi->get_openJsonLink_by_id(101)->link;
			$json = get_json_pageList($link, 'rows', $curPage, $this->page_config['per_page']);
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$data['categoryName'] = '中山要闻';
			$data['rows'] = $json['rows'];
			$data['totalRows'] = $json['total'];
			$data['totalPages'] = $json['pageCount'];
			
			$baseUrl = $this->config->item("base_url") . 'open_goverment/nlists/news/zsyw/';
			$data['link'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		} else if ($catid == 'sjtz') {
			$curPage = intval($curPage);
			$link = $this->m_oi->get_openJsonLink_by_id(102)->link;
			$json = get_json_pageList($link, 'rows', $curPage, $this->page_config['per_page']);
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$data['categoryName'] = '市级通知';
			$data['rows'] = $json['rows'];
			$data['totalRows'] = $json['total'];
			$data['totalPages'] = $json['pageCount'];
			
			$baseUrl = $this->config->item("base_url") . 'open_goverment/nlists/notice/sjtz/';
			$data['link'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		} else if ($catid == 'rsrm') {
			$curPage = intval($curPage);
			$link = $this->m_oi->get_openJsonLink_by_id(468)->link;
			$json = get_json_pageList($link, 'rows', $curPage, $this->page_config['per_page']);
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$data['categoryName'] = '人事任免';
			$data['rows'] = $json['rows'];
			$data['totalRows'] = $json['total'];
			$data['totalPages'] = $json['pageCount'];
			
			$baseUrl = $this->config->item("base_url") . 'open_goverment/nlists/rsxx/rsrm/';
			$data['link'] = get_json_createLink($baseUrl, $curPage, $json['pageCount'], 3);
		}else if ($catid == 'zfgkbg') {
	 
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$data['categoryName'] = '依申请公开';
			$here="header3";
		 
		}else if ($catid == 'zfyjx') {
	 
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$data['categoryName'] = '信息公开意见箱';
		    $here="header4";
		}else {
			$config = $this->page_config;
			$config['base_url'] = $this->config->item("base_url") . '/open_goverment/nlists/' . $listType . '/' . $catid . '/'; // $this->config->item("base_url") . 'open_goverment/' . $catid . '/';
			$config['total_rows'] = $this->m_og->get_article_count($catid);
			$config['uri_segment'] = 5;
			$this->pagination->initialize($config);
			
			$data['catid'] = $catid;
			$data['listType'] = $listType;
			$category = $this->m_og->get_category_by_catid($catid);
			
			$data['categoryName'] = $category[0]->name;
			$data['rows'] = $this->m_og->get_article_limitPage($catid, $config['per_page'], $this->uri->segment(5));
			$data['totalRows'] = $config['total_rows'];
			$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
			$data['link'] = $this->pagination->create_links();
		}
		
		$this->load->view('index/'.$here, $data);
		$this->load->view('index/open_goverment_news_list');
		$this->load->view('index/footer');
	}
	public function zwgk()
	{
				// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		$data['categoryName'] = '政务公开目录';
	    $this->load->view('index/header2', $data);
		$this->load->view('index/open_goverment_zwgk');
		$this->load->view('index/footer');
	}

	public function video($catid = 147)
	{
		$this->load->library('pagination');
		$this->load->model('model_zxsx', 'm_og');
		
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		// $config['use_page_numbers'] = TRUE;
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/open_goverment/video/';
		$config['total_rows'] = $this->m_og->get_video_count($catid);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		// $category = $this->m_og->get_category_by_catid($catid);
		// $data['category'] = $category[0];
		$data['rows'] = $this->m_og->get_video_limitPage($catid, $config['per_page'], $this->uri->segment(4));
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['link'] = $this->pagination->create_links();
		
		$this->load->view('index/header', $data);
		$this->load->view('index/open_goverment_video_list');
		$this->load->view('index/footer');
	}

	public function organize()
	{
		/* 广告调取 */
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		/* 广告调取end */
		
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$this->load->model('model_zxsx', 'm_og');
		$lists = $this->m_og->get_category_by_parentid(150);
		foreach ($lists as $list) {
			$li['listName'] = $list->name;
			$li['rows'] = $this->m_og->get_acticle_by_catid($list->cat_id);
			$orgList[] = $li;
		}
		
		$data['lists'] = $orgList;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/open_goverment_organize_list');
		$this->load->view('index/footer');
	}

	public function view($showType, $aid)
	{
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		                                                           
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		if ($showType == 'article') {
			$aid = intval($aid);
			$this->load->model('model_zxsx', 'm_og');
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_act($aid); // 阅读数 + 1
			
			$rows = $this->m_og->get_acticle_by_aid($aid);
			if ($rows) {
				// 获取文章对应的专题图片集
				$rows_thumbs = $this->m_og->get_acticle_thumb_by_aid($aid);
				$data['rows_thumbs'] = $rows_thumbs;
				
				$category = $this->m_og->get_category_by_catid($rows[0]->cat_id);
				$data['category_id'] = $category[0]->cat_id;
				$data['category_name'] = $category[0]->name;
				$data['title'] = $rows[0]->title;
				$data['content'] = $rows[0]->content;
				$data['afrom'] = $rows[0]->afrom;
				$data['addtime'] = $rows[0]->rel_date != 0 ? date("Y-m-d", $rows[0]->rel_date) : date("Y-m-d", $rows[0]->addtime);
				$data['author'] = $rows[0]->author;
			} else {
				action_message("/index.php", 3, '页面不存在！', 0);
				exit();
			}
		} else if ($showType == 'page') {
			$catid = intval($aid);
			$this->load->model('model_zxsx', 'm_og');
			$this->load->model('model_stats', 'm_stats');
			
			$this->m_stats->stats_addonce_page($aid); // 阅读数 + 1
			$rows = $this->m_og->get_apage_by_catid($catid);
			if ($rows) {
				$data['category_id'] = 'page';
				$data['title'] = $rows[0]->name;
				$data['content'] = $rows[0]->content;
				$data['addtime'] = $rows[0]->rel_date != 0 ? date("Y-m-d", $rows[0]->rel_date) : date("Y-m-d", $rows[0]->addtime);
			} else {
				action_message("/index.php", 3, '页面不存在！', 0);
				exit();
			}
		}  
		$this->load->view('index/header', $data);
		$this->load->view('index/open_goverment_content');
		$this->load->view('index/footer');
	}

	public function getPageContent($pageURL)
	{
		include 'application/libraries/phpQuery.php';
		
		phpQuery::newDocumentFile($pageURL);
		$pageContent['title'] = pq('#open_show')->find('h2')->text();
		
		$content = pq('.sc')->html();
		$pageContent['content'] = iconv('gbk', 'utf-8', $content);
		
		// 处理链接、附件链接指向
		if (strpos($pageContent['content'], '<a href="/')) {
			$pageContent['content'] = str_replace('<a href="/', '<a href="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		if (strpos($pageContent['content'], 'src="/')) {
			$pageContent['content'] = str_replace('src="/', 'src="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		$addtime = pq('.ly.clearfix')->html();
		$pageContent['info'] = iconv('gbk', 'utf-8', $addtime);
		return $pageContent;
	}

	public function getPage_gkgd($pageURL)
	{
		include 'application/libraries/phpQuery.php';
		
		phpQuery::newDocumentFile($pageURL);
		$pageContent['title'] = pq('#main_right')->find('h2')->text();
		
		$content = pq('.showcontent')->html();
		$pageContent['content'] = iconv('gbk', 'utf-8', $content);
		
		// 处理链接、附件链接指向
		if (strpos($pageContent['content'], '<a href="/')) {
			$pageContent['content'] = str_replace('<a href="/', '<a href="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		if (strpos($pageContent['content'], 'src="/')) {
			$pageContent['content'] = str_replace('src="/', 'src="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		return $pageContent;
	}

	public function getPage_sqgk($pageURL)
	{
		//var_dump($pageURL);
		include 'application/libraries/phpQuery.php';
		
		phpQuery::newDocumentFile($pageURL);
		$pageContent['title'] = pq('#main_right')->find('h2')->text();
		
		$content = pq('.ico')->html();
		//var_dump($content);
		$pageContent['content'] = iconv('gbk', 'utf-8', $content);
		
		// 处理链接、附件链接指向
		if (strpos($pageContent['content'], '<a href="/')) {
			$pageContent['content'] = str_replace('<a href="/', '<a href="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		if (strpos($pageContent['content'], 'src="/')) {
			$pageContent['content'] = str_replace('src="/', 'src="http://www.zs.gov.cn/', $pageContent['content']);
		}
		
		return $pageContent;
	}
	public function about(){
	    
	    $this->load->library('pagination');
	    // 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('navs' => $navs,'nav_selected' => 1,'en_navs' => $en_navs,'navs_url' => $navs_url);
	   	$this->load->model('model_zxsx', 'mog');
		$topad = $this->mog->get_guanyu(); //关于协会
	    $data['about']=$topad;
		
	    $this->load->view('index/header',  $data);
		$this->load->view('index/about');
		$this->load->view('index/footer');
	}
	
	public function dynamic($curPage = 1 ,$catid =226)
	{ 
		$this->load->library('pagination');
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_zxsx', 'm_og');
	 
			// 广告读取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
           
		   $curPage = intval($curPage);
	    	$config = $this->page_config;
			$config['base_url'] = $this->config->item("base_url") . '/zxsx/dynamic/'; // $this->config->item("base_url") . 'open_goverment/' . $catid . '/';
			$config['total_rows'] = $this->m_og->get_article_count($catid);
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			
			$data['catid'] = $catid;
			 
			$category = $this->m_og->get_category_by_catid($catid);
		 
			$data['categoryName'] = $category[0]->name;
			$data['rows'] = $this->m_og->get_article_limitPage($catid, $config['per_page'], $this->uri->segment(3));
			$data['totalRows'] = $config['total_rows'];
			$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
			$data['howPages'] =$curPage==1?1: (ceil($curPage / $config['per_page'])+1);
			$data['link'] = $this->pagination->create_links();
            $data['num']=count($data['rows']) ;
			 
		$this->load->view('index/header', $data);
		$this->load->view('index/dynamic');
		$this->load->view('index/footer');
	}
	public function xinyong($curPage = 1 ,$catid =5)
	{ 
		$this->load->library('pagination');
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_zxsx', 'm_og');
	 
			// 广告读取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
           
		   $curPage = intval($curPage);
	    	$config = $this->page_config;
			$config['base_url'] = $this->config->item("base_url") . '/zxsx/dynamic/'; // $this->config->item("base_url") . 'open_goverment/' . $catid . '/';
			$config['total_rows'] = $this->m_og->get_article_count($catid);
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			
			$data['catid'] = $catid;
			 
			$category = $this->m_og->get_category_by_catid($catid);
		 
			$data['categoryName'] = $category[0]->name;
			$data['rows'] = $this->m_og->get_article_limitPage($catid, $config['per_page'], $this->uri->segment(3));
			$data['totalRows'] = $config['total_rows'];
			$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
			$data['howPages'] =$curPage==1?1: (ceil($curPage / $config['per_page'])+1);
			$data['link'] = $this->pagination->create_links();
            $data['num']=count($data['rows']) ;
			 
		$this->load->view('index/header', $data);
		$this->load->view('index/xinyong_news');
		$this->load->view('index/footer');
	}
	
    public function area($curPage = 1 ,$catid =221)
	{ 
		$this->load->library('pagination');
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('model_zxsx', 'm_og');
	 
			// 广告读取
			$this->load->model('index_get_adsm', 'igam');
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$data = array('topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 4,'en_navs' => $en_navs,'navs_url' => $navs_url);
           
		   $curPage = intval($curPage);
	    	$config = $this->page_config;
			$config['base_url'] = $this->config->item("base_url") . '/zxsx/dynamic/'; // $this->config->item("base_url") . 'open_goverment/' . $catid . '/';
			$config['total_rows'] = $this->m_og->get_article_count($catid);
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			
			$data['catid'] = $catid;
			 
			$category = $this->m_og->get_category_by_catid($catid);
		 
			$data['categoryName'] = $category[0]->name;
			$data['rows'] = $this->m_og->get_article_limitPage($catid, $config['per_page'], $this->uri->segment(3));
			$data['totalRows'] = $config['total_rows'];
			$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
			$data['howPages'] =$curPage==1?1: (ceil($curPage / $config['per_page'])+1);
			$data['link'] = $this->pagination->create_links();
            $data['num']=count($data['rows']) ;
			 
		$this->load->view('index/header', $data);
		$this->load->view('index/area_news');
		$this->load->view('index/footer');
	}
}
