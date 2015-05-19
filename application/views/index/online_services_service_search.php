  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="">网上服务</a> &gt;&gt; <a href="">办事服务</a> &gt;&gt;
    <span class="active">个人服务</span>
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
        <div class="service_service_search"> 
          <font>办理事项查询</font> <input id="ipt_query" class="text" name="query" type="text" value="<?php echo htmlspecialchars($query);?>" style="margin-right:10px;" />
          <select id="sel_deptName" name="deptName" class="select">
            <option value="" <?php if($deptName=='') echo 'selected="selected"'; ?>>请选择部门</option>
			<option value="中山市政府办公室" <?php if($deptName=='中山市政府办公室') echo 'selected="selected"'; ?>>中山市政府办公室</option>
            <option value="发展和改革局" <?php if($deptName=='发展和改革局') echo 'selected="selected"'; ?>>发展和改革局</option>
            <option value="安监局" <?php if($deptName=='安监局') echo 'selected="selected"'; ?>>安全生产监督管理局</option>
            <option value="保密局" <?php if($deptName=='保密局') echo 'selected="selected"'; ?>>保密局</option>
			<option value="编委办" <?php if($deptName=='编委办') echo 'selected="selected"'; ?>>编委办</option>
			<option value="财政局" <?php if($deptName=='财政局') echo 'selected="selected"'; ?>>财政局</option>
			<option value="残联" <?php if($deptName=='残联') echo 'selected="selected"'; ?>>残联</option>
			<option value="城管执法局" <?php if($deptName=='城管执法局') echo 'selected="selected"'; ?>>城管执法局</option>
			<option value="档案局" <?php if($deptName=='档案局') echo 'selected="selected"'; ?>>档案局</option>
			<option value="地税局" <?php if($deptName=='地税局') echo 'selected="selected"'; ?>>地税局</option>
			<option value="法制局" <?php if($deptName=='法制局') echo 'selected="selected"'; ?>>法制局</option>
			<option value="工商局" <?php if($deptName=='工商局') echo 'selected="selected"'; ?>>工商局</option>
			<option value="公安边防支队" <?php if($deptName=='公安边防支队') echo 'selected="selected"'; ?>>公安边防支队</option>
			<option value="公安交警支队" <?php if($deptName=='公安交警支队') echo 'selected="selected"'; ?>>公安交警支队</option>
			<option value="公安局" <?php if($deptName=='公安局') echo 'selected="selected"'; ?>>公安局</option>
			<option value="公安消防支队" <?php if($deptName=='公安消防支队') echo 'selected="selected"'; ?>>公安消防支队</option>
			<option value="公共汽车公司" <?php if($deptName=='公共汽车公司') echo 'selected="selected"'; ?>>公共汽车公司</option>
			<option value="公路局" <?php if($deptName=='公路局') echo 'selected="selected"'; ?>>公路局</option>
			<option value="供电局" <?php if($deptName=='供电局') echo 'selected="selected"'; ?>>供电局</option>
			<option value="规划局" <?php if($deptName=='规划局') echo 'selected="selected"'; ?>>规划局</option>
			<option value="国税局" <?php if($deptName=='国税局') echo 'selected="selected"'; ?>>国税局</option>
			<option value="国土资源局" <?php if($deptName=='国土资源局') echo 'selected="selected"'; ?>>国土资源局</option>
			<option value="海事局" <?php if($deptName=='海事局') echo 'selected="selected"'; ?>>海事局</option>
			<option value="海洋与渔业局" <?php if($deptName=='海洋与渔业局') echo 'selected="selected"'; ?>>海洋与渔业局</option>
			<option value="航道局" <?php if($deptName=='航道局') echo 'selected="selected"'; ?>>航道局</option>
			<option value="红十字会" <?php if($deptName=='红十字会') echo 'selected="selected"'; ?>>红十字会</option>
			<option value="环保局" <?php if($deptName=='环保局') echo 'selected="selected"'; ?>>环保局</option>
			<option value="检察院" <?php if($deptName=='检察院') echo 'selected="selected"'; ?>>检察院</option>
			<option value="住房和城乡建设局" <?php if($deptName=='住房和城乡建设局') echo 'selected="selected"'; ?>>住房和城乡建设局</option>
			<option value="交通运输局" <?php if($deptName=='交通运输局') echo 'selected="selected"'; ?>>交通运输局</option>
			<option value="教育局" <?php if($deptName=='教育局') echo 'selected="selected"'; ?>>教育局</option>
			<option value="经信局" <?php if($deptName=='经信局') echo 'selected="selected"'; ?>>经信局</option>
			<option value="科技局" <?php if($deptName=='科技局') echo 'selected="selected"'; ?>>科技局</option>
			<option value="人力资源和社会保障局" <?php if($deptName=='人力资源和社会保障局') echo 'selected="selected"'; ?>>人力资源和社会保障局</option>
			<option value="林业局" <?php if($deptName=='林业局') echo 'selected="selected"'; ?>>林业局</option>
			<option value="旅游局" <?php if($deptName=='旅游局') echo 'selected="selected"'; ?>>旅游局</option>
			<option value="民政局" <?php if($deptName=='民政局') echo 'selected="selected"'; ?>>民政局</option>
			<option value="民族宗教事务局" <?php if($deptName=='民族宗教事务局') echo 'selected="selected"'; ?>>民族宗教事务局</option>
			<option value="农业局" <?php if($deptName=='农业局') echo 'selected="selected"'; ?>>农业局</option>
			<option value="气象局" <?php if($deptName=='气象局') echo 'selected="selected"'; ?>>气象局</option>
			<option value="人口和计划生育局" <?php if($deptName=='人口和计划生育局') echo 'selected="selected"'; ?>>人口和计划生育局</option> 
			<option value="审改办" <?php if($deptName=='审改办') echo 'selected="selected"'; ?>>审改办</option>
			<option value="食品药品监督管理局" <?php if($deptName=='食品药品监督管理局') echo 'selected="selected"'; ?>>食品药品监督管理局</option>
			<option value="检察院" <?php if($deptName=='检察院') echo 'selected="selected"'; ?>>检察院</option>
			<option value="市投诉中心" <?php if($deptName=='市投诉中心') echo 'selected="selected"'; ?>>市投诉中心</option>
			<option value="水务局" <?php if($deptName=='水务局') echo 'selected="selected"'; ?>>水务局</option>
			<option value="司法局" <?php if($deptName=='司法局') echo 'selected="selected"'; ?>>司法局</option>
			<option value="台湾事务局" <?php if($deptName=='台湾事务局') echo 'selected="selected"'; ?>>台湾事务局</option>
			<option value="体育局" <?php if($deptName=='体育局') echo 'selected="selected"'; ?>>体育局</option>
			<option value="统计局" <?php if($deptName=='统计局') echo 'selected="selected"'; ?>>统计局</option>
			<option value="外经贸局" <?php if($deptName=='外经贸局') echo 'selected="selected"'; ?>>外经贸局</option>
			<option value="外事局" <?php if($deptName=='外事局') echo 'selected="selected"'; ?>>外事局</option>
			<option value="卫生局" <?php if($deptName=='卫生局') echo 'selected="selected"'; ?>>卫生局</option>
			<option value="文化广电新闻出版局" <?php if($deptName=='文化广电新闻出版局') echo 'selected="selected"'; ?>>文化广电新闻出版局</option>
			<option value="无管办" <?php if($deptName=='无管办') echo 'selected="selected"'; ?>>无管办</option>
			<option value="无委办" <?php if($deptName=='无委办') echo 'selected="selected"'; ?>>无委办</option>
			<option value="物价局" <?php if($deptName=='物价局') echo 'selected="selected"'; ?>>物价局</option>
			<option value="烟草专卖局" <?php if($deptName=='烟草专卖局') echo 'selected="selected"'; ?>>烟草专卖局</option>
			<option value="盐务局" <?php if($deptName=='盐务局') echo 'selected="selected"'; ?>>盐务局</option>
			<option value="邮政局" <?php if($deptName=='邮政局') echo 'selected="selected"'; ?>>邮政局</option>
			<option value="知识产权局" <?php if($deptName=='知识产权局') echo 'selected="selected"'; ?>>知识产权局</option>
			<option value="质监局" <?php if($deptName=='质监局') echo 'selected="selected"'; ?>>质监局</option>
			<option value="中山电信" <?php if($deptName=='中山电信') echo 'selected="selected"'; ?>>中山电信</option>
			<option value="中山广播电视台" <?php if($deptName=='中山广播电视台') echo 'selected="selected"'; ?>>中山广播电视台</option>
			<option value="中山市人民防空办公室" <?php if($deptName=='中山市人民防空办公室') echo 'selected="selected"'; ?>>中山市人民防空办公室</option>
			<option value="中山海关" <?php if($deptName=='中山海关') echo 'selected="selected"'; ?>>中山海关</option>
			<option value="总工会" <?php if($deptName=='总工会') echo 'selected="selected"'; ?>>总工会</option>
          </select>
          <select id="sel_type" name="type" class="select">
            <option value="0" <?php if($type==0) echo 'selected="selected"';?>>请选择事项类别</option>
			<option value="1" <?php if($type==1) echo 'selected="selected"';?>>行政许可</option>
			<option value="2" <?php if($type==2) echo 'selected="selected"';?>>非行政许可</option>
			<option value="3" <?php if($type==3) echo 'selected="selected"';?>>服务事项</option>
			<option value="4" <?php if($type==4) echo 'selected="selected"';?>>查询事项</option>
          </select>
          <input id="btn_search" class="submit" type="button" value="搜索" /> 
          <script type="text/javascript" src="/public/index/js/base64.js"></script>
          <script type="text/javascript" src="/public/formvalid/valid.js"></script>
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
        <ul class="tabs5" id="tabs5">
<!--           <li><a href="">查询结果</a></li> -->
          <span>标记为&nbsp;&nbsp;<img src="/public/index/images/get_right.png" align="absmiddle" />&nbsp;&nbsp;的事项已开通网上受理查询结果</span>
        </ul>
      </div>
<!--       <div class="clear"></div> -->
      

      <div class="service_service_list">
<!--         <ul class="tabs8" id="tabs8"> -->
<!--           <li><a href="">个人服务</a></li> -->
<!--           <li><a href="">企业服务</a></li> -->
<!--           <li><a href="">三农服务</a></li> -->
<!--         </ul> -->
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
          		<a href="/index.php/online_services/view/guide/<?php echo $r_item['iid'];?>"><?php echo $r_item['name'];?></a>
          		<?php elseif ($r_item['name'] == '表格下载'): ?>
          		<a href="http://www.zs.gov.cn/ajax/infoFlowDownload.action?id=<?php echo $r_item['id'];?>"><?php echo $r_item['name'];?></a>
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
