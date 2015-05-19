<div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/landscape">走进板芙</a> &gt;&gt;
  <?php if($nav_location[2]->cat_type_id!==1){ ?>
  <a href="/index.php/landscape/type<?php echo $nav_location[2]->cat_type_id; ?>/<?php echo $nav_location[2]->parent_id; ?>/<?php echo $nav_location[2]->cat_id; ?>"><?php echo $nav_location[2]->name; ?></a> &gt;&gt;
  <?php }else{ ?>
  <a href="/index.php/landscape/view/<?php echo $nav_location[2]->parent_id; ?>"><?php echo $nav_location[2]->name; ?></a> &gt;&gt; 
  <?php } ?>
  <span class="active"><?php echo htmlspecialchars($news->title); ?></span> 
</div>

  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_content">
    <h1><?php echo htmlspecialchars($news->title); ?></h1>
    <div class="content_info">
    <?php if($news->afrom != ''): ?>
		来源：<?php echo htmlspecialchars($news->afrom); ?> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php endif; ?>
	<?php if($news->rel_date != ''): ?>
    	发布日期：<?php echo date("Y-m-d",$news->rel_date); ?> &nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif; ?>
    <?php if($news->author != ''): ?>
    	作者：<?php echo htmlspecialchars($news->author); ?>
    <?php endif;?>
    </div>
   <?php echo $news->content; ?>
   </div>
</div>
<!--warper end-->
