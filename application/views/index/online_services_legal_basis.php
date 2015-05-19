  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <a href="/index.php/online_services">网上服务</a> &gt;&gt;
    <span class="active">执法依据</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_online_services.png" />
      <ul>
        <li><a href="/index.php/online_services/service">办事服务</a></li>
        <li><a href="/index.php/online_services/form">表格下载</a></li>
        <li><a href="/index.php/online_services/state">公共服务</a></li>
        <li><a href="/index.php/online_services/utility">实用查询</a></li>
        <li><a style="background: #0067ad;color: #FFF;" href="/index.php/online_services/legal">执法依据</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
   <script type="text/javascript">
	$(document).ready(function() {
		jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
			$(tabtit).find("li").bind(shijian,function(){
				$(this).addClass("thistab").siblings("li").removeClass("thistab"); 
				var activeindex = $(tabtit).find("li").index(this);
				$(tab_conbox).children().eq(activeindex).show().siblings().hide();
				return false;
			});
		};
		/*调用方法如下：*/		
		$.jqtab("#tabs3","#tab_conbox3","click");
	});
	</script>
  <div class="right_side"> 
    <div class="legal_basis_box">
      <ul class="legal_basis_tabs" id="tabs3">
      	<?php foreach ($row_zfyj as $row_item): ?>
      	<li<?php if($catid==$row_item->cat_id): ?> class="thistab"<?php endif; ?>><a href="#"><?php echo $row_item->name;?></a></li>
      	<?php endforeach;?>
      </ul>
      <ul class="legal_basis_conbox" id="tab_conbox3">
        <?php foreach ($row_zfyj as $row_item): ?>
        <li<?php if($catid==$row_item->cat_id): ?> style="display: list-item;"<?php else: ?> style="display: none;"<?php endif; ?>>
        <div class="tit"><?php echo $row_item->name; ?></div>
        <div class="con">
          <p><?php echo $row_item->content; ?></p>
        </div>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
</div>
<!--warper end-->
