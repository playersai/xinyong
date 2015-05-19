
  <div class="clear"></div>
  
 <div class="full_content" style="margin-top:12px;">
    <h1><?php echo $arows->title; ?></h1>
    <div class="content_info">
    <?php if($arows->afrom != ''): ?>
		来源：<?php echo htmlspecialchars($arows->afrom); ?> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php endif; ?>
	<?php if($arows->rel_date != ''): ?>
    	发布日期：<?php echo date("Y-m-d",$arows->rel_date); ?> &nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif; ?>
    <?php if($arows->author!=''): ?>
    	作者：<?php echo htmlspecialchars($arows->author); ?>
    <?php endif;?>
    </div>
	<?php echo $arows->content; ?>
 </div>
  
