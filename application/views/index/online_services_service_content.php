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
    <div class="border_box">
      <h1><?php echo $title;?></h1>
      <div class="content_info service_info"> 
      <?php foreach ($links as $row_item): ?> 
        <?php if($row_item['name']=='办事指南'): ?>
          <a><?php echo $row_item['name'];?></a>
        <?php else:?>
          <a target="_blank" href="<?php echo $row_item['url'];?>"><?php echo $row_item['name'];?></a>
        <?php endif;?>
      <?php endforeach;?>
      </div>
      <div class="service_service_con">
      <?php if($is_tab==0): ?>
        <?php echo $content;?>
      <?php else: ?>
        <ul class="tabs2" id="tabs2">
          <?php foreach ($tab_menu as $row_item): ?>
          <li><a href="#"><?php echo $row_item; ?></a></li>
          <?php endforeach;?>
        </ul>
        <ul class="tab_conbox2" id="tab_conbox2">
          <?php foreach ($tab_main as $row_item): ?>
          <li class="tab_con2"><?php echo $row_item; ?></li>
		  <?php endforeach;?>
        </ul>
      <?php endif;?>
      </div>
    </div>
  </div>
</div>
<!--warper end-->