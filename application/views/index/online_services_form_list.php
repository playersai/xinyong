
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/open_goverment">网上服务</a> &gt;&gt; 
  	<span class="active">表格下载</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_opengovement.png" />
      <ul>
        <li><a href="/index.php/online_services/service">办事服务</a></li>
        <li><a style="background: #0067ad;color: #FFF;" href="/index.php/online_services/form">表格下载</a></li>
        <li><a href="/index.php/online_services/state">公共服务</a></li>
        <li><a href="/index.php/online_services/utility">实用查询</a></li>
        <li><a href="/index.php/online_services/legal">执法依据</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con">
        <?php foreach ($rows as $row_item): ?>
        <span><font><?php echo $row_item['dept']; ?></font><a href="http://www.zs.gov.cn/ajax/infoFlowDownload.action?id=<?php echo $row_item['id']; ?>"><?php echo $row_item['name']; ?></a></span>
        <?php endforeach ?>
        <div class="clear"></div>
       	<div class="page">共<span style="color:#f00;"><?php echo $total; ?></span>条记录，分<span style="color:#f00;"><?php echo $pageCount; ?></span>页显示 <?php echo $pageLink; ?></div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--warper end-->
