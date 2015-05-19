  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <span class="active"><?php echo $title; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_content">
    <h1><?php echo $title; ?></h1>
    <div class="content_info">
    <?php if($afrom!=''): ?> 
    	来源：<?php echo $afrom;?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif;?>
    <?php if($addtime!=''): ?> 
    	发布日期：<?php echo $addtime; ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif;?>
    <?php if($author!=''): ?>
    	作者：<?php echo $author;?>
    <?php endif;?>
    </div>
    <?php echo $content; ?>
  </div>
</div>
<!--warper end-->

