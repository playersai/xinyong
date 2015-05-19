
  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <a href="/index.php/online_services">网上服务</a> &gt;&gt; <a href="/index.php/online_services/service">办事服务</a> &gt;&gt;
    <span class="active"><?php if ($main_id == 20): ?>个人办事<?php elseif ($main_id == 21): ?>企业办事<?php elseif ($main_id == 22): ?>三农服务<?php endif; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_online_services.png" />
      <ul>
        <li><a style="background: #0067ad;color: #FFF;" href="/index.php/online_services/service">办事服务</a></li>
        <li><a href="/index.php/online_services/form">表格下载</a></li>
        <li><a href="/index.php/online_services/state">公共服务</a></li>
        <li><a href="/index.php/online_services/utility">实用查询</a></li>
        <li><a href="/index.php/online_services/legal">执法依据</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="border_box2">
    <div class="service_service_search_bg">
      <div class="service_service_search"> <font>办理事项查询</font> <input id="ipt_query" class="text" name="query" type="text" style="margin-right:10px;" />
          <select id="sel_deptName" name="deptName" class="select">
            <option value="" selected="selected">请选择部门</option>
			<option value="中山市政府办公室">中山市政府办公室</option>
            <option value="发展和改革局">发展和改革局</option>
            <option value="安监局">安全生产监督管理局</option>
            <option value="保密局">保密局</option>
			<option value="编委办">编委办</option>
			<option value="财政局">财政局</option>
			<option value="残联">残联</option>
			<option value="城管执法局">城管执法局</option>
			<option value="档案局">档案局</option>
			<option value="地税局">地税局</option>
			<option value="法制局">法制局</option>
			<option value="工商局">工商局</option>
			<option value="公安边防支队">公安边防支队</option>
			<option value="公安交警支队">公安交警支队</option>
			<option value="公安局">公安局</option>
			<option value="公安消防支队">公安消防支队</option>
			<option value="公共汽车公司">公共汽车公司</option>
			<option value="公路局">公路局</option>
			<option value="供电局">供电局</option>
			<option value="规划局">规划局</option>
			<option value="国税局">国税局</option>
			<option value="国土资源局">国土资源局</option>
			<option value="海事局">海事局</option>
			<option value="海洋与渔业局">海洋与渔业局</option>
			<option value="航道局">航道局</option>
			<option value="红十字会">红十字会</option>
			<option value="环保局">环保局</option>
			<option value="检察院">检察院</option>
			<option value="住房和城乡建设局">住房和城乡建设局</option>
			<option value="交通运输局">交通运输局</option>
			<option value="教育局">教育局</option>
			<option value="经信局">经信局</option>
			<option value="科技局">科技局</option>
			<option value="人力资源和社会保障局">人力资源和社会保障局</option>
			<option value="林业局">林业局</option>
			<option value="旅游局">旅游局</option>
			<option value="民政局">民政局</option>
			<option value="民族宗教事务局">民族宗教事务局</option>
			<option value="农业局">农业局</option>
			<option value="气象局">气象局</option>
			<option value="人口和计划生育局">人口和计划生育局</option> 
			<option value="审改办">审改办</option>
			<option value="食品药品监督管理局">食品药品监督管理局</option>
			<option value="检察院">检察院</option>
			<option value="市投诉中心">市投诉中心</option>
			<option value="水务局">水务局</option>
			<option value="司法局">司法局</option>
			<option value="台湾事务局">台湾事务局</option>
			<option value="体育局">体育局</option>
			<option value="统计局">统计局</option>
			<option value="外经贸局">外经贸局</option>
			<option value="外事局">外事局</option>
			<option value="卫生局">卫生局</option>
			<option value="文化广电新闻出版局">文化广电新闻出版局</option>
			<option value="无管办">无管办</option>
			<option value="无委办">无委办</option>
			<option value="物价局">物价局</option>
			<option value="烟草专卖局">烟草专卖局</option>
			<option value="盐务局">盐务局</option>
			<option value="邮政局">邮政局</option>
			<option value="知识产权局">知识产权局</option>
			<option value="质监局">质监局</option>
			<option value="中山电信">中山电信</option>
			<option value="中山广播电视台">中山广播电视台</option>
			<option value="中山市人民防空办公室">中山市人民防空办公室</option>
			<option value="中山海关">中山海关</option>
			<option value="总工会">总工会</option>
          </select>
          <select id="sel_type" name="type" class="select">
            <option value="0" selected="selected">请选择事项类别</option>
			<option value="1">行政许可</option>
			<option value="2">非行政许可</option>
			<option value="3">服务事项</option>
			<option value="4">查询事项</option>
          </select>
          <input id="btn_search" class="submit" type="button" value="搜索" />  
          <script src="/public/index/js/base64.js" type="text/javascript"></script>
          <script>
              $("#btn_search").click(function() {
                  var base64 = new Base64();
    	          var queryStr = $('#sel_type').val() + "@" + $('#ipt_query').val() + "@" + $('#sel_deptName').val();
	              queryStr = base64.encode(queryStr);  
	              queryStr = queryStr.replace(/\+/g, "-");
	              queryStr = queryStr.replace(/\//g, "_");
	              window.location.href="/index.php/online_services/search/all/" + queryStr;
              });
           </script>
        </div>
      </div>
      <div class="clear"></div>
      <div class="service_service_tab">
        <ul class="tabs5">
          <span>标记为&nbsp;&nbsp;<img src="/public/index/images/get_right.png" align="absmiddle" />&nbsp;&nbsp;的事项已开通网上受理查询结果</span>
          <li<?php if($main_id==20): ?> class="thistab"<?php endif; ?>><a href="/index.php/online_services/service/20">个人办事</a></li>
          <li<?php if($main_id==21): ?> class="thistab"<?php endif; ?>><a href="/index.php/online_services/service/21">企业办事</a></li>
          <li<?php if($main_id==22): ?> class="thistab"<?php endif; ?>><a href="/index.php/online_services/service/22">三农服务</a></li>
        </ul>
        <ul class="tab_conbox5" id="tab_conbox5">
          <li class="tab_con5">
          <?php foreach ($row_main as $row_item): ?>
          <span><a <?php if($row_item->id==$main_subid) echo 'style="color: #cc0000 !important;"'?> href="/index.php/online_services/service/<?php echo $row_item->parentid; ?>/<?php echo $row_item->id; ?>/<?php echo $row_item->defaultid ?>">&gt; <?php echo $row_item->name; ?></a></span>
          <?php endforeach ?>
          </li>
        </ul>
      </div>
      <div class="clear"></div>
      <div class="service_service_list">
        <ul class="tabs8">
          <?php foreach ($row_main_sub as $row_item): ?>
          	<li<?php if($row_item->id==$service_id): ?> class="thistab"<?php endif;?>><a href="/index.php/online_services/service/<?php echo $main_id;?>/<?php echo $row_item->parentid; ?>/<?php echo $row_item->id; ?>"><?php echo $row_item->name;?></a></li>
          <?php endforeach ?>
        </ul>
        <div class="clear"></div>
        <?php foreach ($rows as $row_item): ?>
        <dl>
          <dt>
            <span>[<?php echo $row_item['type']; ?>]</span>
            <?php echo $row_item['name']; ?>
          </dt>
          <dd> 
          	<?php foreach ($row_item['flows'] as $r_item): ?>
          		<?php if ($r_item['name'] == '办事指南'): ?>
          		<a target="_blank" href="/index.php/online_services/view/guide/<?php echo $r_item['iid'];?>"><?php echo $r_item['name'];?></a>
          		<?php elseif ($r_item['name'] == '表格下载'): ?>
          		<a target="_blank" href="http://www.zs.gov.cn/ajax/infoFlowDownload.action?id=<?php echo $r_item['id'];?>"><?php echo $r_item['name'];?></a>
          		<?php else: ?>
          		<a target="_blank" href="<?php echo safeUrl($r_item['link']);?>"><?php echo $r_item['name'];?></a>
          		<?php endif; ?>
          	<?php endforeach ?>
          </dd>
        </dl>
        <?php endforeach ?>
        <div class="clear"></div>
        <div class="page">共
          <span style="color:#f00;"><?php echo $total;?></span>
          条记录，分
          <span style="color:#f00;"><?php echo $pageCount;?></span>
          页显示 <?php echo $pageLink; ?></div>
      </div>
    </div>
  </div>
</div>
<!--warper end-->

