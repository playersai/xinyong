<?php

class Admincategorym extends CI_Model
{

	public $cate_type = array();

	function __construct()
	{
		$this->load->database();
		
		$this->cate_type = array('1' => 'admin_category-edit1-','2' => 'admin_article-','3' => 'admin_photo-','4' => 'admin_vedio-','5' => 'admin_vote-','6' => 'admin_feedback-','7' => 'admin_topic-','8' => 'admin_ads-');
		
		parent::__construct();
	}

	public function get_cat_type()
	{
		$this->db->order_by('sort', "desc");
		$query = $this->db->get('ch_category_type');
		return $result = $query->result();
	}

	public function get_cat_type_array($id = 0)
	{
		if ($id == '0') {
			$this->db->order_by('sort', "desc");
			$query = $this->db->get('ch_category_type');
			$result = $query->result();
		} else {
			$this->db->order_by('sort', "desc");
			$query = $this->db->get_where('ch_category_type', array('id' => $id));
			
			$result = $query->result();
		}
		foreach ($result as $val) {
			$arr[$val->id] = $val;
		}
		return $arr;
	}

	public function get_category($id = 0, $level = 1)
	{
		if ($id == '0') {
			$this->db->order_by("sort desc,cat_id asc");
			$query = $this->db->get_where('ch_category', array('level' => $level));
		} else {
			$query = $this->db->get_where('ch_category', array('cat_id' => $id));
		}
		return $result = $query->result();
	}

	public function get_category_by_type()
	{
		/* --按分类属性排序数组-- */
		$query = $this->db->get('ch_category');
		$rows = $query->result();
		
		if ($rows) {
			foreach ($rows as $val) {
				$result[$val->cat_type_id][] = $val;
			}
		}
		return $result;
	}

	public function get_category_level($arr, $cat_type = 0)
	{
		/* --按分类级别排序数组，1为顶级分类-- */
		foreach ($arr as $val) {
			$level[$val] = $this->get_category($id = 0, $val);
		}
		
		$levels = array();
		
		foreach ($level as $key => $vval) {
			foreach ($vval as $vvval) {
				if ($cat_type == '0') {
					$levels[$key][$vvval->parent_id][] = $vvval;
				} else {
					if ($cat_type == $vvval->cat_type_id) {
						$levels[$key][$vvval->parent_id][] = $vvval;
					}
				}
			}
		}
		return $levels;
	}

	public function get_category_by_cat_type_id($type_id)
	{
		// 获取分类BY分类属性ID 
		$this->db->order_by("sort desc");
		$rows = $this->db->get_where('ch_category', array('cat_type_id' => $type_id))->result();
		
		if ($rows) {
			foreach ($rows as $row_item) {
				if ($row_item->parent_id == '0') {
					$crow['parent'][$row_item->cat_id] = $row_item;
				} else {
					$crow['son'][$row_item->parent_id][$row_item->cat_id] = $row_item;
				}
			}
			
			return is_array($crow) ? $crow : false;
		}
	}

	public function get_cat_by_parent_id($parent_id)
	{
		/* 根据一级cat_id 获取 二三级子分类,应用模块 后台菜单(admin_menu) */
		$this->db->order_by('sort desc');
		$cat2 = $this->db->get_where('ch_category', array('parent_id' => $parent_id))->result();
		
		foreach ($cat2 as $cat2val) {
			$cat3[$cat2val->cat_id] = $this->get_son_by_catid($cat2val->cat_id);
		}
		
		return array('cat2' => $cat2,'cat3' => $cat3);
	}

	public function get_cat_by_parent_id2($parent_id)
	{
		
		/* 根据一级cat_id 获取 二三级子分类,应用模块 后台菜单(admin_menu) */
		$cat2 = array();
		$cat3 = array();
		$this->db->order_by('sort desc');
		$cat2 = $this->db->get_where('ch_category', array('parent_id' => $parent_id,'status' => 1))->result();
		if (isset($cat2)) {
			foreach ($cat2 as $cat2val) {
				
				$cat3[$cat2val->cat_id] = $this->get_son_by_catid($cat2val->cat_id);
			}
		}
		
		return array('cat2' => $cat2,'cat3' => $cat3);
	}

	public function get_cat_by_level($arr)
	{
		/* --按分类级别排序数组，1为顶级分类-- */
		foreach ($arr as $val) {
			$level[$val] = $this->get_category($id = 0, $val);
		}
		
		$levels = array();
		
		// print_r($level);
		foreach ($level as $key => $vval) {
			foreach ($vval as $vvval) {
				
				$levels[$key][$vvval->parent_id][] = $vvval;
			}
		}
		
		return $levels;
	}

	public function get_apage($cid)
	{
		if (! empty($cid)) {
			$query = $this->db->get_where('ch_apage', array('cat_id' => $cid));
			return $result = $query->result();
		}
	}

	public function do_add_category($data)
	{
		/* =====添加分类===== */
		if (is_array($data) and isset($data['cat_type_id'])) {
			
			$this->db->where("id", $data['cat_type_id']);
			$this->db->set("nums", 'nums+1', FALSE);
			$result = $this->db->update('ch_category_type');
			
			$this->db->insert('ch_category', $data);
			$data['cat_id'] = $this->db->insert_id();
			
			$this->auto_add_category($data);
			
			$adata = array('name' => $this->cate_type[$data['cat_type_id']] . $data['cat_id'],'title' => $data['name'],'pid' => $this->get_auth_rule_pid($data['parent_id']),'cid' => $data['cat_id'],'status' => $data['status'],'sort' => $data['sort']);
			$this->db->insert('auth_rule', $adata);
			
			return $result;
		}
	}
	
	// 获取PID kenny add
	public function get_auth_rule_pid($pid = 0)
	{
		if (! $pid) return 0;
		$this->db->from('category as c');
		$this->db->join('auth_rule as a', 'a.cid = c.cat_id', 'left');
		$this->db->where('c.cat_id', $pid);
		$result = $this->db->get()->row_array();
		return $result['id'];
	}

	public function auto_add_category($data)
	{
		/* 添加分类后自动按属性添加对应数据表 */
		if (is_array($data)) {
			
			switch ($data['cat_type_id']) {
				case 1:
					$datas = array('cat_id' => $data['cat_id'],'name' => $data['name'],'content' => $data['content'],'addtime' => $data['addtime'],'add_user' => $data['add_user']);
					return $this->db->insert('ch_apage', $datas);
					
					break;
			}
		}
	}

	public function do_edit1_handle($apage, $cate, $cat_id)
	{
		/* 单页编辑处理 */
		$this->db->where("cat_id", $cat_id);
		$this->db->update('ch_apage', $apage);
		
		$this->db->where("cat_id", $cat_id);
		return $this->db->update('ch_category', $cate);
	}

	public function do_edit_handle($cate, $cat_id)
	{
		/* （非单页）分类编辑处理 */
		$this->db->where("cat_id", $cat_id);
		$this->db->update('ch_category', $cate);
		
		$adata = array('title' => $cate['name'],'pid' => $this->get_auth_rule_pid($cate['parent_id']),'status' => $cate['status'],'sort' => $cate['sort']);
		$this->db->where("cid", $cat_id);
		return $this->db->update('auth_rule', $adata);
	}

	public function get_level_by_catid($cid)
	{
		$this->db->where(array('cat_id' => $cid));
		return $this->db->get('ch_category')->result();
	}

	public function get_son_by_catid($cid)
	{
		/* 获取子类 */
		$this->db->order_by('sort desc');
		$this->db->where(array('parent_id' => $cid));
		return $this->db->get('ch_category')->result();
	}

	public function do_update_category_nums($cat_id, $status, $act = null)
	{
		if ($act == '0') {
			if ($status == '0') {
				$this->db->set('daishen_nums', 'daishen_nums-1', false);
			}
			$this->db->set('nums', 'nums-1', false);
			$this->db->where(array("cat_id" => $cat_id));
			return $this->db->update('ch_category');
		}
		
		if ($act == '1') {
			if ($status == '0') {
				$this->db->set('daishen_nums', 'daishen_nums+1', false);
			}
			$this->db->set('nums', 'nums+1', false);
			$this->db->where(array("cat_id" => $cat_id));
			return $this->db->update('ch_category');
		}
	}

	public function do_delete_handle($cid)
	{
		$this->db->where(array('cid' => $cid));
		$this->db->delete('auth_rule');
		
		$this->db->where(array('cat_id' => $cid));
		return $this->db->delete('ch_category');
	}

	public function do_delete_by_where($table, $cid)
	{
		$this->db->where(array('cat_id' => $cid));
		return $this->db->delete($table);
	}

	public function get_nav_locaiton($cat_id)
	{
		/* 根据cat_id获取当前导航位置 */
		$catq = $this->db->query("select * from `ch_category` where cat_id in(select parent_id  FROM `ch_category` where 
			cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id))  union  select * from `ch_category` 
			where cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id) union  select * from `ch_category` where cat_id=$cat_id");
		return $cats = $catq->result();
	}
}
	