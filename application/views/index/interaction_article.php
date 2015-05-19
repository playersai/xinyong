<div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt;
  <?php if(isset($cats) and is_array($cats)){
  unset($cats[0]);
   unset($cats[1]);
  foreach($cats as $caval){
  ?> <?php if($caval->cat_id!==$cats_selected){?>
  <a href="/index.php/category/<?php echo $caval->cat_id.'/'.$caval->cat_type_id; ?>"><?php echo $caval->name ;?></a> &gt;&gt; 
  <?php }else{?><span class="active"><?php echo $caval->name ;?></span>
  <?}?>
  <?php
  }
  }
  ?>
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
    <?php if($news->author!=''): ?>
    	作者：<?php echo htmlspecialchars($news->author); ?>
    <?php endif;?>
    </div>
   <?php echo $news->content; ?>

   </div>
</div>
<!--warper end-->
