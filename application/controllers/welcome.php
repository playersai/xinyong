<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index($id = 0)
	{
		$this->load->helper(array('myurl','handle_json'));
		$this->load->model('model_open_goverment', 'm_og');
		$this->load->model('model_openinfo', 'm_oi');
		$this->load->model('index_homem', 'ahm');
		
		// 导航读取
		$navs = $this->config->item("nav"); // 导航条名称
		$en_navs = $this->config->item("en_nav"); // 导航条名称
		$navs_url = $this->config->item("nav_url");
		$data = array('navs' => $navs,'nav_selected' => 0,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		// 广告读取
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
		$bottomad1 = $this->igam->get_ads_by_catid('cat_id=116', 4); // 底部概况
		$bottomad2 = $this->igam->get_ads_by_catid('cat_id=117', 4); // 底部宜居
		$bottomad3 = $this->igam->get_ads_by_catid('cat_id=118', 4); // 底部旅游
		$bottomad4 = $this->igam->get_ads_by_catid('cat_id=119', 4); // 底部投资
		$ad135 = $this->igam->get_ads_by_catid('cat_id=135', 1); // 通栏广告
		$floatad = $this->igam->get_float_ad(27); // 首页漂浮广告 cat=27
		$data['topad'] = $topad;
		$data['middle_ad'] = $middlead[0];
		$data['bottomad1'] = $bottomad1;
		$data['bottomad2'] = $bottomad2;
		$data['bottomad3'] = $bottomad3;
		$data['bottomad4'] = $bottomad4;
		$data['ad135'] = $ad135[0];
		$data['floatad'] = $floatad[0];
		
		// 中山要闻
		$link = $this->m_oi->get_openJsonLink_by_id(101)->link;
		$data['zsyw'] = get_jsons($link, 'rows', 7);
		
		// 政策文件
		// $data['zfwj'] = $this->m_og->get_acticle_by_catid(69, 7);
		$link_zcwj = $this->m_oi->get_openJsonLink_by_id(103)->link;
		$data['zcwj'] = get_jsons($link_zcwj, 'rows', 7);
		
		// 规划计划
		// $data['ghjh'] = $this->m_og->get_acticle_by_catid(71, 7);
		$link_fzjh = $this->m_oi->get_openJsonLink_by_id(104)->link;
		$data['fzjh'] = get_jsons($link_fzjh, 'rows', 7);
		
		// 人事信息
		// $data['rsxx'] = $this->m_og->get_acticle_by_catid(70, 7);
		$link_rsxx = $this->m_oi->get_openJsonLink_by_id(468)->link;
		$data['rsxx'] = get_jsons($link_rsxx, 'rows', 7);
		
		// 统计数据
		$link_tjsj = $this->m_oi->get_openJsonLink_by_id(105)->link;
		$data['tjsj'] = get_jsons($link_tjsj, 'rows', 7);
		
		// 招标采购
		$tender = $this->ahm->get_index_article('cat_id=183 and status=1', 7);
		$data['tender']=$tender;
		
		// 市级通知
		// $data['sjtz'] = $this->m_og->get_acticle_by_catid(66, 8);
		$link_sjtz = $this->m_oi->get_openJsonLink_by_id(102)->link;
		$data['sjtz'] = get_jsons($link_sjtz, 'rows', 8);
		
		// 首页头条
		$index_top = $this->ahm->get_index_top('ch_articles', 'cat_id=5', 1);
		$data['index_top'] = $index_top[0];
		
		// 新闻、部门动态
		$bf_news = $this->ahm->get_index_article('cat_id=5 and status=1', 7);
		$file_news = $this->ahm->get_index_article('cat_id=216 and status=1', 6);
		$company_news = $this->ahm->get_index_article('cat_id=9 and status=1', 6);
		$Acompany_news = $this->ahm->get_index_article('cat_id=217 and status=1', 6);
		$AAcompany_news = $this->ahm->get_index_article('cat_id=218 and status=1', 6);
		$AAAcompany_news = $this->ahm->get_index_article('cat_id=219 and status=1', 6);
		$area_news = $this->ahm->get_index_article('cat_id=221 and status=1', 6);
		$success_news = $this->ahm->get_index_article('cat_id=223 and status=1', 6);
		$profession_news = $this->ahm->get_index_article('cat_id=224 and status=1', 6);
		$gundong_news = $this->ahm->get_index_article('cat_id=227 and status=1', 6);
		$data['bf_news'] = $bf_news;
		$data['file_news'] = $file_news;
		$data['company_news'] = $company_news;
		$data['Acompany_news'] = $Acompany_news;
		$data['AAcompany_news'] = $AAcompany_news;
        $data['AAAcompany_news'] = $AAAcompany_news;
        $data['area_news'] = $area_news;
        $data['success_news'] = $success_news;
        $data['profession_news'] = $profession_news;
        $data['gundong_news'] = $gundong_news;		
		
		// 企业招聘、个人求职
		$qyzp_news = $this->ahm->get_index_article('cat_id=113 ', 6);
		$grqzh_news = $this->ahm->get_index_article('cat_id=114 ', 6);
		$data['qyzp_news'] = $qyzp_news;
		$data['grqzh_news'] = $grqzh_news;
		
		// 网上调查、网上征集
		$vote_rows = $this->ahm->get_vote_by_catid('105', 4);
		$feedback_rows = $this->ahm->get_feedback_by_catid('37', 4);
		$data['vote_rows'] = $vote_rows;
		$data['feedback_rows'] = $feedback_rows;
		
		// 热点专题
		$topic_rows = $this->ahm->get_index_topic(5);
		$data['topic_rows'] = $topic_rows;
		
		// 投诉列表
		// $this->load->model('index_interactionm', 'iim');
		// $fbc_rows = $this->iim->get_feedback_content2(1, array(0,10));
		
		// 首页左侧幻灯片图文
		$thumbs = $this->ahm->get_index_thumb_article(6);
		$data['thumbs'] = $thumbs;
		
		// 底部山水栏目简介
		$bt_page1 = $this->ahm->get_cat_by_catid(11);
		$bt_page2 = $this->ahm->get_cat_by_catid(20);
		$bt_page3 = $this->ahm->get_cat_by_catid(53);
		$bt_page4 = $this->ahm->get_cat_by_catid(48);
		$data['bt_page1'] = $bt_page1[0];
		$data['bt_page2'] = $bt_page2[0];
		$data['bt_page3'] = $bt_page3[0];
		$data['bt_page4'] = $bt_page4[0];
		
		// 底部导航
		$data['link'] = $this->ahm->get_link("where type_id=0", 6);
		$data['link_1'] = $this->ahm->get_link("where type_id=1");
		$data['link_2'] = $this->ahm->get_link("where type_id=2");
		$data['link_3'] = $this->ahm->get_link("where type_id=3");
		$data['link_4'] = $this->ahm->get_link("where type_id=4");
		$data['link_5'] = $this->ahm->get_link("where type_id=5");
		$data['link_6'] = $this->ahm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/index');
		$this->load->view('index/footer_nav');
	}
}

/* End of file weome.php */
/* Location: ./application/controllers/welcome.php */