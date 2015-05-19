<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Landscape extends CI_Controller
{

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

	public function index($id = 0)
	{
		$this->load->model('index_landscapem', 'ilm');
		$this->load->model('index_get_adsm', 'igam');
		
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1);
		$floatad = $this->igam->get_float_ad(163); // 山水板芙漂浮广告 cat=163
		$data = array('topad' => $topad,'middle_ad' => $middlead[0],'floatad' => $floatad[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		// 图解板芙 幻灯6张
		$tjbf = $this->ilm->get_photos_thumb_by_catid(64, 6);
		$data['tjbf'] = $tjbf;
		
		$cats = $this->ilm->get_apage_category_2_index();
		$data['cats'] = $cats;
		
		$bfrows = $this->ilm->get_category_by_catid(11);
		$data['bfrows'] = $bfrows[0];
		
		// 底部导航
		$this->load->model('index_homem', 'ihm');
		$data['link'] = $this->ihm->get_link("where type_id=0", 6);
		$data['link_1'] = $this->ihm->get_link("where type_id=1");
		$data['link_2'] = $this->ihm->get_link("where type_id=2");
		$data['link_3'] = $this->ihm->get_link("where type_id=3");
		$data['link_4'] = $this->ihm->get_link("where type_id=4");
		$data['link_5'] = $this->ihm->get_link("where type_id=5");
		$data['link_6'] = $this->ihm->get_link("where type_id=6");
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape');
		$this->load->view('index/footer_nav');
	}

	public function view($parent_id = 0, $cat_id = 0)
	{
		$this->load->model('Index_landscapem', 'ilm');
		$this->load->model('index_get_adsm', 'igam');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1);
		
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		$data = array('nav_r_selected' => $cat_id,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$left_nav = $this->ilm->get_left_nav();
		$data['left_nav'] = $left_nav;
		$data['left_nav_selected'] = $parent_id;
		
		$right_top_nav = $this->ilm->get_right_top_nav($parent_id);
		$data['right_top_nav'] = $right_top_nav;
		
		if ($cat_id == 0) {
			$cat_id = $right_top_nav[0]->cat_id;
		}
		$data['cat_id'] = $cat_id;
		
		$left_nav_info = $this->ilm->get_category_by_catid($parent_id);
		$right_top_nav_info = $this->ilm->get_category_by_catid($cat_id);
		
		$data['now_nav1'] = $left_nav_info[0];
		$data['now_nav2'] = $right_top_nav_info[0];
		
		if ($right_top_nav_info[0]->cat_type_id != '1') {
			header("location:/index.php/landscape/type" . $right_top_nav_info[0]->cat_type_id . '/' . $right_top_nav_info[0]->parent_id . '/' . $right_top_nav_info[0]->cat_id);
			exit();
		}
		
		$rows = $this->ilm->get_apage($cat_id);
		$data['pagerows'] = $rows['a'][0];
		$data['page_nav_r'] = $rows['cat'];
		
		$this->load->model('model_stats', 'm_stats');
		$this->m_stats->stats_addonce_page($cat_id); // 阅读数 + 1
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape_view');
		$this->load->view('index/footer');
	}

	public function type2($parent_id, $cat_id, $cur_page = 0)
	{
		$this->load->library('pagination');
		$this->load->model('Index_landscapem', 'ilm');
		
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1);
		
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		$data = array('nav_r_selected' => $cat_id,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$left_nav = $this->ilm->get_left_nav();
		$data['left_nav'] = $left_nav;
		$data['left_nav_selected'] = $parent_id;
		
		$right_top_nav = $this->ilm->get_right_top_nav($parent_id);
		$data['right_top_nav'] = $right_top_nav;
		
		if ($cat_id == 0) {
			$cat_id = $right_top_nav[0]->cat_id;
		}
		$data['cat_id'] = $cat_id;
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'landscape/type2/' . $parent_id . '/' . $cat_id . '/';
		$config['total_rows'] = $this->ilm->get_article_nums_by_catid($cat_id);
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$this->load->model('index_viewm', 'ivm');
		$fbrows = $this->ivm->get_article_by_catid($cat_id, $cur_page . ',' . $config['per_page']);
		$data['fbrows'] = $fbrows;
		
		$nav_location = $this->ivm->get_nav_locaiton($cat_id);
		$data['nav_location'] = $nav_location;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape_type2');
		$this->load->view('index/footer');
	}

	public function type2add($act = 1)
	{
		$action = $act == '1' ? 1 : 2;
		
		$this->load->model('index_get_adsm', 'igam');
		$this->load->model('index_landscapem', 'ilm');
		
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		$data = array('topad' => $topad,'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$left_nav = $this->ilm->get_apage_category_2_view();
		$data['left_nav'] = $left_nav[0];
		$data['left_nav2'] = $left_nav[1];
		$data['left_nav_selected'] = 48;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape_type2_add' . $action);
		$this->load->view('index/footer');
	}

	public function type3($parent_id, $cat_id, $cur_page = 0)
	{
		$this->load->library('pagination');
		$this->load->model('index_landscapem', 'ilm');
		
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1);
		
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		$data = array('nav_r_selected' => $cat_id,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$left_nav = $this->ilm->get_left_nav();
		$data['left_nav'] = $left_nav;
		$data['left_nav_selected'] = $parent_id;
		
		$right_top_nav = $this->ilm->get_right_top_nav($parent_id);
		$data['right_top_nav'] = $right_top_nav;
		
		if ($cat_id == 0) {
			$cat_id = $right_top_nav[0]->cat_id;
		}
		$data['cat_id'] = $cat_id;
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'landscape/type3/' . $parent_id . '/' . $cat_id . '/';
		$config['total_rows'] = $this->ilm->get_photos_by_catid($cat_id);
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$thumb_rows = $this->ilm->get_photos($cat_id, array($cur_page,$config['per_page']));
		$data['thumb_rows'] = $thumb_rows;
		
		$this->load->model('index_viewm', 'ivm');
		$nav_location = $this->ivm->get_nav_locaiton($cat_id);
		$data['nav_location'] = $nav_location;
		// $data = array('page_info' => $pdata['page_info'],'pages' => $pdata['pages'],'left_nav' => $left_nav[0],'left_nav2' => $left_nav[1],'left_nav_selected' => $parent_id,'pagerows' => $rows['a'][0],'page_nav_r' => $rows['cat']);
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape_view_thumb');
		$this->load->view('index/footer');
	}

	public function type4($parent_id, $cat_id, $cur_page = 0)
	{
		$this->load->library('pagination');
		$this->load->model('index_landscapem', 'ilm');
		
		$this->load->model('index_get_adsm', 'igam');
		$topad = $this->igam->get_ads_by_catid('cat_id=28', 10);
		$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1);
		
		$navs = $this->config->item("nav");
		$en_navs = $this->config->item("en_nav");
		$navs_url = $this->config->item("nav_url");
		$data = array('nav_r_selected' => $cat_id,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'nav_selected' => 2,'en_navs' => $en_navs,'navs_url' => $navs_url);
		
		$left_nav = $this->ilm->get_left_nav();
		$data['left_nav'] = $left_nav;
		$data['left_nav_selected'] = $parent_id;
		
		$right_top_nav = $this->ilm->get_right_top_nav($parent_id);
		$data['right_top_nav'] = $right_top_nav;
		
		if ($cat_id == 0) {
			$cat_id = $right_top_nav[0]->cat_id;
		}
		$data['cat_id'] = $cat_id;
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . 'landscape/type4/' . $parent_id . '/' . $cat_id . '/';
		$config['total_rows'] = $this->ilm->get_vedio_thumb_nums_by_catid($cat_id);
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$vedio_rows = $this->ilm->get_vedio_thumb_by_catid($cat_id, $cur_page . ',' . $config['per_page']);
		$data['video_rows'] = $vedio_rows;
		
		$this->load->model('index_viewm', 'ivm');
		$nav_location = $this->ivm->get_nav_locaiton($cat_id);
		$data['nav_location'] = $nav_location;
		
		$this->load->view('index/header', $data);
		$this->load->view('index/landscape_vedio_thumb');
		$this->load->view('index/footer');
	}

	public function type2add_handle($act = 1)
	{
		$this->load->model('Index_landscapem', 'ilm');
		$pdata = $this->input->post(NULL,FALSE);
		 
		if (empty($_POST['f_code']) || strtoupper($_POST['f_code']) != $_SESSION['captchas']) {
			action_message('javascript:history.back(-1);', 6, '验证码不能为空或输入错误，请重新填入！', 0);
		} else {
			unset($pdata['f_code']);
		}
		
		if ($act == 1) {
			
			$str1 = '<div class="company_tit">公司简介：</div>
                     <div class="company_info">
                       <div class="company_info_con">' . htmlentities($pdata['description']) . '</div>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td>
                       	     <strong>联系人：</strong>&nbsp;&nbsp;' . htmlentities($pdata['contact1']) . '<br /><br />
                             <strong>联系电话：</strong>&nbsp;&nbsp;' . htmlentities($pdata['tel']) . '<br /><br />
                             <strong>联系地址：</strong>&nbsp;&nbsp;' . htmlentities($pdata['address']) . '
                           </td>
                         </tr>
                       </table>
                     </div><div class="recruit_tit">招聘信息：</div>';
			
			foreach ($pdata['jobs'] as $jkey => $jobval) {
				
				$str2 .= '<div class="recruit_info">
						    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
						        <td>
						          <strong>招聘职位：</strong>' . htmlentities($jobval) . '<br /><br />
                                  <strong>招聘人数：</strong>' . htmlentities($pdata['zprs'][$jkey]) . '人<br /><br /> 
                                  <strong>学历要求：</strong>' . htmlentities($pdata['xlyq'][$jkey]) . '<br /><br />
                                  <strong>职位要求：</strong>' . htmlentities($pdata['zyyq'][$jkey]) . '</td>
                              </tr>
                            </table>
                          </div>';
			}
			
			$data['cat_id'] = 113;
			$data['addtime'] = time();
			$data['rel_date'] = time();
			$data['title'] = $pdata['company'] . '招聘';
			$data['content'] = "'" . $str1 . $str2 . "'";
			
			$ist = $this->ilm->do_type2add_handle($data);
			if ($ist) {
				action_message("/index.php/landscape/type2/" . $data['cat_id'] . "/2/1", 10, '提交成功,待审核后显示', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
		
		if ($act == 2) {
			$pdata = $this->input->post(NULL, TRUE);
			$str = '<div class="company_info">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>应聘意向：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['qzhyx']) . '<br /><br />
		  <strong>姓名：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['name']) . '<br />
            <br />
            <strong>学历：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['xueli']) . '<br />
            <br />
			 <strong>联系电话：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['tel']) . '<br />
            <br /> <strong>Email：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['email']) . '<br />
            <br />
            <strong>联系地址：</strong>&nbsp;&nbsp;' . htmlspecialchars($pdata['address']) . '</td>
			 
        </tr>
		<tr> <td> <br /><strong>自我介绍：</strong> <br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . htmlspecialchars($pdata['content']) . '
		</td>
		 </tr>
      </table>
    </div>';
			
			$data['cat_id'] = 114;
			$data['addtime'] = time();
			$data['title'] = "求职: " . $pdata['qzhyx'];
			$data['content'] = "'" . $str . "'";
			$this->load->model('Index_landscapem', 'ilm');
			$ist = $this->ilm->do_type2add_handle($data);
			if ($ist) {
				action_message("/index.php/landscape/type2/" . $data['cat_id'] . "/2/1", 10, '提交成功,待审核后显示', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function article($id = 0, $cat_id)
	{
		/* 新闻详情页 */
		if ($id !== 0) {
			
			$this->load->model('index_get_adsm', 'igam');
			$this->load->model('index_viewm', 'ivm');
			
			/* 广告调取 */
			$topad = $this->igam->get_ads_by_catid('cat_id=28', 10); // 首页顶部广告
			$middlead = $this->igam->get_ads_by_catid('cat_id=42', 1); // 中间广告
			
			$navs = $this->config->item("nav"); // 导航条名称
			$en_navs = $this->config->item("en_nav"); // 导航条名称
			$navs_url = $this->config->item("nav_url");
			$nav_location = $this->ivm->get_nav_locaiton($cat_id);
			$data = array('nav_location' => $nav_location,'cats_selected' => $cat_id,'nav_selected' => 2,'topad' => $topad,'middle_ad' => $middlead[0],'navs' => $navs,'en_navs' => $en_navs,'navs_url' => $navs_url);
			
			$news = $this->ivm->get_article_by_aid($id, $cat_id);
			$data['news'] = $news['news'][0];
			$data['cats'] = $news['cats'];
			$data['thumbs'] = $news['thumbs'];
			
			$data['cat_id'] = $cat_id;
			
			$this->load->model('model_stats', 'm_stats');
			$this->m_stats->stats_addonce_act($id); // 阅读数 + 1
			
			$this->load->view('index/header', $data);
			$this->load->view('index/landscape_article');
			$this->load->view('index/footer');
		}
	}
}
