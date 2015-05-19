<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_vote extends CI_Controller
{

	public function index($id = 0,$queryStr = NULL, $per_pages = null)
	{
		check_purview("admin_vote-" . $id);
		check_adminstatus(100);
		
		if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
 
		$a_title = $queryArr[0];
		$a_date2=$queryArr[1];
		$a_date = strtotime($queryArr[1]);
		$a_user = $queryArr[2];
		$a_status = $queryArr[3];
		if ($id !== '0') {
			
			$this->load->model("admincategorym", 'amc');
			$crows = $this->amc->get_category($id);
			
			$this->load->model('admin_votem', 'avm');
			$article_nums = $this->avm->get_vote_nums($id,$a_title,$a_date,$a_user,$a_status);
		}
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_vote/index/' . $id . '/'.$queryStr . '/';
		$config['total_rows'] = $article_nums;
		$config['uri_segment'] = 5;//页码参数在第几个变量
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['article'];
		$this->pagination->initialize($config);
		$pagenums = ceil($article_nums / $configs['article']);
		$_page = $get_pages < $configs['article'] ? 0 : $get_pages;
		$data['pages'] = $this->pagination->create_links();
		$data['page_info'] = array('nums' => $article_nums,'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		$data['config']['base_url'] = $this->config->item("base_url");
		
		$limit0 = $_page;
		$limitarr = array($limit0,$config['per_page']);
		
		$arows = $this->avm->get_vote($id, $limitarr,$a_title,$a_date,$a_user,$a_status);
		$data['crows'] = $crows;
		$data['arows'] = $arows;
		$data['id'] = $id;
		$data['per_pages'] = $per_pages;
		$data['a_title'] = $a_title;
		$data['a_date'] = $a_date2;
		$data['a_user'] = $a_user;
		$data['a_status'] = $a_status;
		// print_r($data);die;
		$this->load->view('admin/admin_vote_index', $data);
	}

	public function add($id = null)
	{
		check_adminstatus(100);
		
		if (isset($id) and $id !== NULL) {
			$cat_id = intval($id);
			$this->load->model('admincategorym', 'amc');
			$cats = $this->amc->get_cat_by_level(array(1,2,3));
			if (is_array($cats) and isset($cats[1][0])) {
				$data['cats']['parent'] = $cats[1][0];
				$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
				$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
			}
			
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$data['user_group'] = $_SESSION['group_id'];
		$data['selected_catid'] = $id;
		$this->load->view('admin/admin_vote_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
	    if(is_int(intval($data['cat_id']))==false||is_int(intval($data['status']))==false||is_int(intval($data['stats']))==false||is_int(intval($data['settop']))==false||is_int(intval($data['settop']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}		
		$data['start_time'] = strtotime($data['start_time']);
		$data['exp_time'] = strtotime($data['exp_time']);
		
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		$data['rel_date'] = strtotime($data['rel_date']);
		
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$this->load->model('admin_votem', 'avm');
		$ist = $this->avm->do_add_handle($data);
		if ($ist) {
			action_message("/index.php/admin_vote/" . $data['cat_id'], 3, '添加成功', 1);
		} else {
			action_message("/index.php/admin_vote/index/", 3, '添加失败', 0);
		}
	}

	public function edit($aid, $cat_id)
	{
		check_adminstatus(100);
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
			$cats = $this->amc->get_cat_by_level(array(1,2,3));
			if (is_array($cats) and isset($cats[1][0])) {
				$data['cats']['parent'] = $cats[1][0];
				
				$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
				$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
			}
		}
		// $parent=$this->amc->get_category_by_cat_type_id(5);
		
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		$this->load->model('admin_votem', 'avm');
		$rows = $this->avm->get_vote_by_voteid($aid);
		$data['rows'] = $rows[0];
		$data['selected_catid'] = $cat_id;
		// $data['cats']=$parent;
		$data['user_group'] = $_SESSION['group_id'];
		$this->load->view('admin/admin_vote_edit', $data);
	}

	public function edit_handle($vote_id, $cat_id, $status)
	{
		check_adminstatus(100);
		$this->load->model("admin_articlem", 'aam');
		if (! isset($vote_id)) {
			action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		}
		if ($cat_id != $_POST['cat_id']) {
			// 当新传入的分类不等于原分类ID 执行更新分类统计
			$this->aam->do_update_category_nums(array('cat_id' => $cat_id), 0);
			$this->aam->do_update_category_nums(array('cat_id' => intval($_POST['cat_id'])), 1);
			if ($status == '0' and $status == $this->input->post('status')) {
				$this->aam->do_update_category_daishennums(array('cat_id' => $cat_id), 0);
				$this->aam->do_update_category_daishennums(array('cat_id' => intval($_POST['cat_id'])), 1);
			}
		}
		if ($status != $this->input->post('status')) {
			switch ($status) {
				case 0:
					$this->aam->do_update_category_daishennums(array('cat_id' => $cat_id), 0);
					break;
				case 1:
					$this->aam->do_update_category_daishennums(array('cat_id' => intval($_POST['cat_id'])), 1);
					break;
			}
		}
		$data = $this->input->post(NULL, TRUE);
		$data['settop'] = isset($data['settop']) ? '1' : '0';
		$data['index_top'] = isset($data['index_top']) ? '1' : '0';
		
		$data['start_time'] = strtotime($this->input->post('start_time'));
		$data['exp_time'] = strtotime($this->input->post('exp_time'));
		$data['rel_date'] = strtotime($data['rel_date']);
		
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$this->load->model('admin_votem', 'avm');
		$result = $this->avm->do_edit_handle($data, $vote_id);
		
		if ($result) {
			action_message("/index.php/admin_vote/" . $cat_id . '/1', 3, '编辑成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function show($vote_id = null, $cat_id = null, $q_id = null)
	{
		$this->load->model('admin_votem', 'avm');
		if (isset($_POST['submit']) and $q_id != null) {
			$qdata = array('title' => $this->input->post('title'));
			$qwhere = array('q_id' => $q_id);
			$result = $this->avm->do_edit_question_handle($qdata, $qwhere);
			if ($result) {
				// echo "<script>alert('更新成功！');</script>";
				action_message("javascript:history.back(-1);", 3, "更新成功", 1);
			} else {
				// echo "<script>alert('更新失败！');</script>";
				action_message("javascript:history.back(-1);", 3, "更新失败", 0);
			}
		}
		
		if ($vote_id != null) {
			$vote_rows = $this->avm->get_vote_by_voteid($vote_id);
			$q_op_rows = $this->avm->get_question_options_by_vid($vote_id);
			$data = array('vote' => $vote_rows[0],'q_options' => $q_op_rows);
			$this->load->view('admin/admin_vote_show', $data);
		}
	}

	public function edit_question($q_id = null)
	/*问题编辑高级模式*/
	{
		$this->load->model('admin_votem', 'avm');
		if ($q_id !== null) {
			$data['rows'] = $this->avm->get_question_by_qid($q_id);
			$this->load->view('admin/admin_vote_question_edit', $data);
		}
	}

	public function edit_question_handle($q_id = null)
	{
		/* 编辑问题数据处理 */
		$this->load->model('admin_votem', 'avm');
		if ($q_id !== null) {
			$pdata = $this->input->post(null, true);
			$qwhere = array('q_id' => $q_id);
			$result = $this->avm->do_edit_question_handle($pdata, $qwhere);
			if ($result) {
				// header("location:/index.php/admin_vote/edit_question/" . $q_id);
				action_message("javascript:history.back(-1);", 3, "操作成功", 1);
			}
		}
	}

	public function delete($id = NULL)
	{
		check_adminstatus(100);
		
		$this->load->model('admin_votem', 'avm');
		
		$result = $this->avm->do_delete_handle($id);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function add_question($vote_id, $cat_id)
	{
		check_adminstatus(13);
		if ($vote_id !== '0' and isset($cat_id)) {
			
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$data['user_group'] = $_SESSION['group_id'];
		$data['vl_id'] = $vote_id;
		$this->load->view('admin/admin_vote_question_add', $data);
	}

	public function add_question_handle($id = 0)
	{
		if ($id !== '0') {
			$pdata = $this->input->post(NULL, TRUE);
			if(is_int(intval($data['vote_type']))==false||is_int(intval($data['vote_type']))==false){
				action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
			}			
			$dataq['vote_id'] = $id;
			$dataq['xx_type'] = $pdata['vote_type'];
			$dataq['title'] = $pdata['title'];
			$dataq['colspan'] = $pdata['colspan'];
			
			$this->load->model('admin_votem', 'avm');
			$q_id = $this->avm->do_add_question_handle($dataq);
			if ($dataq['xx_type'] == 3) {
				$datao = array('q_id' => $q_id,'title' => NULL);
				$result = $this->avm->do_add_options_handle($datao);
			} else {
				if (is_array($pdata['options'])) {
					foreach ($pdata['options'] as $oval) {
						if ($oval !== '') {
							$datao = array('q_id' => $q_id,'title' => $oval);
							$result = $this->avm->do_add_options_handle($datao);
						}
					}
				}
			}
			if ($result) {
				action_message("javascript:history.back(-1);", 3, '操作成功', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function add_options($q_id = null)
	{
		$this->load->model('admin_votem', 'avm');
		if ($q_id != null) {
			$qs = $this->avm->get_question_by_qid($q_id);
			$ops = $this->avm->get_options_by_qid($q_id);
			$data = array('qrows' => $qs,'oprows' => $ops);
			$this->load->view('admin/admin_vote_options_add', $data);
		}
	}

	public function add_options_handle($qid)
	{
		if (isset($qid)) {
			$data = $this->input->post(NULL, TRUE);
			if(is_int(intval($data['sort']))==false){
				action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
			}	
			$this->load->model('admin_votem', 'avm');
			
			foreach ($data['options'] as $okey => $oval) {
				$sort = isset($data['sort'][$okey]) ? $data['sort'][$okey] : 0;
				if ($oval !== '') {
					$datao = array('q_id' => $qid,'title' => $oval,'sort' => $sort);
					$result = $this->avm->do_add_options_handle($datao);
				}
			}
			
			if ($result) {
				// action_message("/index.php/admin_vote/add_options/" . $qid, 3, '操作成功！', 1);
				action_message("javascript:history.back(-1);", 3, '操作成功！', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '请填写新增选项！', 0);
			}
		}
	}

	public function edit_options($q_id = null)
	{
		$this->load->model('admin_votem', 'avm');
		if ($q_id != null) {
			$qs = $this->avm->get_question_by_qid($q_id);
			$ops = $this->avm->get_options_by_qid($q_id);
			$data = array('qrows' => $qs,'oprows' => $ops);
			$this->load->view('admin/admin_vote_options_edit', $data);
		}
	}

	public function edit_options_handle($q_id = null)
	{
		$this->load->model('admin_votem', 'avm');
		if ($q_id != null) {
			
			$data = $this->input->post(NULL, TRUE);
			
			if (is_array($data['op'])) {
				foreach ($data['op'] as $okey => $oval) {
					$where = array('op_id' => $okey);
					$dataw = array('title' => $oval,'sort' => $data['sort'][$okey]);
					
					$result = $this->avm->do_edit_options_handle($dataw, $where);
				}
				
				if ($result) {
					action_message("javascript:history.back(-1);", 3, '操作成功', 1);
				} else {
					action_message("javascript:history.back(-1);", 3, '操作失败', 0);
				}
			}
		}
	}

	public function del_question($vote_id = null, $q_id)
	{
		if (isset($q_id)) {
			$this->load->model('admin_votem', 'avm');
			$result = $this->avm->do_del_question($q_id, $vote_id);
			if ($result) {
				action_message("/index.php/admin_vote/show/" . $vote_id, 3, '操作成功', 1);
			}
		}
	}

	public function del_options($vote_id = null, $cat_id = null, $q_id = null)
	{
		$data = $this->input->post(NULL, TRUE);
		
		if ($data) {
			$this->load->model('admin_votem', 'avm');
			if (array_key_exists('type1', $data)) {
				foreach ($data['type1'] as $pkey => $pval) {
					$this->avm->do_del_options($pval);
				}
			} else {
				foreach ($data['type2'] as $pkey => $pval) {
					$this->avm->do_del_options($pkey);
				}
			}
			action_message("/index.php/admin_vote/show/" . $vote_id . '/' . $cat_id, 3, '删除成功', 1);
		} else {
			action_message("/index.php/admin_vote/show/" . $vote_id . '/' . $cat_id, 3, '删除失败，请选择需要删除的选项！', 0);
		}
	}

	public function stats($vote_id, $cat_id = null)
	{
		$this->load->model('index_interactionm', 'iim');
		$stats = $this->iim->get_vote_stats_by_voteid($vote_id);
		$this->load->model('index_viewm', 'ivm');
		$vote_rows = $this->ivm->get_vote_question_option_by_catid($vote_id);
		$data = array('q_sam' => $stats['qnums'],'op_sam' => $stats['opnums'],'vote_rows' => $vote_rows);
		
		$this->load->view('admin/admin_vote_stats_result', $data);
	}
	public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('vote_id',$id,'ch_vote_list');
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "删除成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
	
		public function status_arr($id = NULL,$status)
	{ 
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_update_arr('vote_id',$id,'ch_vote_list',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
	
}

/* Location: ./application/controllers/admin_vote.php */