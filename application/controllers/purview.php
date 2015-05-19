<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Purview extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function group()
	{
		check_purview("purview-group");
		$data['groups'] = $this->db->get('auth_group')->result_array();
		$this->load->view('purview/group_index', $data);
	}

	public function group_add()
	{
		check_adminstatus(100);
		check_purview("purview-group_add");
		if (IS_POST) {
			$post = $this->input->post(NULL, TRUE);
			$this->db->insert('auth_group', $post);
			show_msg('添加成功', admin_url('purview/group'));
		} else {
			$this->load->view('purview/group_add');
		}
	}

	public function group_edit($id = FALSE)
	{
		check_purview("purview-group_edit");
		if (IS_POST) {
			$data = array();
			$post = $this->input->post(NULL, TRUE);
			
			$data = array('title' => $post['title'],'status' => $post['status']);
			
			$this->db->where('id', $post['id']);
			$this->db->update('auth_group', $data);
			
			show_msg('编辑成功', admin_url('purview/group'));
		} else {
			if (! $id) show_msg('非法操作', admin_url('purview/group'));
			$this->db->where('id', $id);
			$data['group'] = $this->db->get('auth_group')->row_array();
			$this->load->view('purview/group_edit', $data);
		}
	}

	public function group_del($id = FALSE)
	{
		check_purview("purview-group_del");
		if ($id) {
			$this->db->delete('auth_group', array('id' => $id));
			show_msg('删除成功', admin_url('purview/group'));
		} else {
			show_msg('删除失败', admin_url('purview/group'));
		}
	}

	public function check_groupname()
	{
		$this->db->where('title', trim($_POST['param']));
		$group = $this->db->get('auth_group')->row_array();
		if (! empty($group)) {
			$return['status'] = 'n';
			$return['info'] = '会员组名称已经存在';
		} else {
			$return['status'] = 'y';
			$return['info'] = '验证通过';
		}
		exit(json_encode($return));
	}

	public function access($gid = FALSE)
	{
		check_adminstatus(100);
		$this->db->select('id, name, title, pid, status');
		$this->db->order_by('sort', 'desc');
		$rules = $this->db->get('auth_rule')->result_array();
		
		$this->db->select('rules');
		$this->db->where('group_id', $gid);
		$group_rules = $this->db->get('user_group')->row_array();
		$data = array('group_rules' => explode(',', $group_rules['rules']),'rules' => rule_merge($rules),'gid' => $gid);
		
		$this->load->view('admin/rule_index', $data);
	}

	public function access_save()
	{
		$post = $this->input->post(NULL, TRUE);
		
		$data = array('rules' => implode(',', $post['access']));
		$this->db->where('group_id', $post['gid']);
		$this->db->update('user_group', $data);
		action_message(admin_url('admin_user_group'), 3, '分配权限成功', 1);
	}

	public function check_rulename()
	{
		$this->db->where('name', trim($_POST['param']));
		$rule = $this->db->get('auth_rule')->row_array();
		if (! empty($rule)) {
			$return['status'] = 'n';
			$return['info'] = '名称已经存在';
		} else {
			$return['status'] = 'y';
			$return['info'] = '验证通过';
		}
		exit(json_encode($return));
	}

	public function rule_add($pid = 0)
	{
		check_purview("purview-rule_add");
		if (IS_POST) {
			$post = $this->input->post(NULL, true);
			
			$this->db->insert('auth_rule', $post);
			
			show_msg('添加成功', admin_url('purview/rule'));
		} else {
			$data['pid'] = $pid;
			$this->load->view('purview/rule_add', $data);
		}
	}

	public function rule_edit($id = FALSE)
	{
		check_purview("purview-rule_edit");
		if (IS_POST) {
			$data = array();
			$post = $this->input->post(NULL, TRUE);
			$data = array('name' => $post['name'],'title' => $post['title'],'sort' => $post['sort'],'status' => $post['status'],'condition' => $post['condition']);
			$this->db->where('id', $post['id']);
			$this->db->update('auth_rule', $data);
			
			show_msg('编辑成功', admin_url('purview/rule'));
		} else {
			if (! $id) show_msg('非法操作', admin_url('rule'));
			$this->db->where('id', $id);
			$data['rule'] = $this->db->get('auth_rule')->row_array();
			$this->load->view('purview/rule_edit', $data);
		}
	}
}