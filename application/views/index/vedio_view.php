  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> 
  <?php if(is_array($nav_location)){ ?>
  &gt;&gt; <a href="/index.php/landscape"><?php echo $nav_location[0]->name; ?></a> &gt;&gt; <a href="/index.php/category/<?php echo $nav_location[2]->cat_id.'/'.$nav_location[2]->parent_id; ?>"><?php echo $nav_location[2]->name; ?></a> &gt;&gt;
    <span class="active"><?php echo $vedio_row->title; ?></span>
  <?php }  ?>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_content">
    <h1><?php echo $vedio_row->title; ?></h1>
    <div class="content_info">发布日期：<?php echo date("Y-m-d",$vedio_row->rel_date); ?></div>
	<p align="center">
	  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="640" height="480">
	    <param name="movie" value="/public/videoplayer/vcastr22.swf">
	    <param name="quality" value="high">
	    <param name="allowFullScreen" value="true">
	    <param name="FlashVars" value="vcastr_file=<?php echo $vedio_row->video_url; ?>">
	    <embed src="/public/videoplayer/vcastr22.swf" allowfullscreen="true" flashvars="vcastr_file=<?php echo $vedio_row->video_url; ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="640" height="480">
	  </object>
	</p>
	<p><?php echo $vedio_row->content; ?></p>
   </div>
</div>
<!--warper end-->
