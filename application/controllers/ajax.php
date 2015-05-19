<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function checkYZM()
	{
		$p_yzm = $_POST['f_code'];
		$r_yzm = $_SESSION['captchas'];
		
		if (! $p_yzm || strtoupper($p_yzm) != $r_yzm)
			echo 'false';
		else
			echo 'true';
	}

	public function tousu()
	{
		$page = $_POST['page'];
		$rp = $_POST['rp'];
		
		if (! $page) $page = 1;
		if (! $rp) $rp = 10;
		
		$start = (($page - 1) * $rp);
		
		$this->load->model('index_interactionm', 'iim');
		$ts_rows = $this->iim->get_feedback_content3('status=2', $start, $rp)->result();
		$ts_nums = $this->iim->get_feedback_content3('status=2')->num_rows();
		
		$json_arr['total'] = $ts_nums;
		$json_arr['page'] = $page;
		
		foreach ($ts_rows as $row_item) {
			if ($row_item->status == 2)
				$status = '<font color="#FF0000"><strong>已办结</strong></font>';
			else
				$status = '<font color="#008000"><strong>处理中</strong></font>';
			
			$title = '<a href="/index.php/interaction/view/' . $row_item->f_c_id . '" target="_blank">' . htmlspecialchars($row_item->title) . '</a>';
			
			$rows = array('id' => $row_item->f_c_id,'cell' => array($title,$row_item->name,$row_item->adddate,$status));
			$json_arr['rows'][] = $rows;
		}
		
		$json = json_encode($json_arr);
		$json = preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $json);
		echo $json;
		// echo '{"total":29654,"page":1,"rows":[{"id":null,"cell":["关于房屋租赁税上调的问题","投诉与监督","2014-09-16","已办结"]},{"id":null,"cell":["黄圃镇商业城的占道经营更加恶劣","市长信箱","2014-09-16","处理中"]},{"id":null,"cell":["中山市横栏镇艺枫灯饰有限公司严重违反劳动法","市长信箱","2014-09-16","处理中"]},{"id":null,"cell":["投诉西区星晨广场及缤城物业管理公司和西区安监部门","投诉与监督","2014-09-16","处理中"]},{"id":null,"cell":["中山市数字电视捆绑宽带业务想取消宽带不给我们受理","投诉与监督","2014-09-15","处理中"]},{"id":null,"cell":["阜沙交警支队编号16150执法嚣张","市长信箱","2014-09-15","处理中"]},{"id":null,"cell":["坦洲公安，工商，村委会，都应该体验下河南去种红薯滋味吗（本职工作就做不好，习总年代提倡实干下求发展你们懂多少","投诉与监督","2014-09-15","处理中"]},{"id":null,"cell":["强烈反对在东区嘉惠苑小区内开通齐学路","投诉与监督","2014-09-15","处理中"]},{"id":null,"cell":["银湾南路公交车迟迟未能开通","投诉与监督","2014-09-12","已办结"]},{"id":null,"cell":["考小车牌的不公平","市长信箱","2014-09-11","已办结"]}]}';
	}
}