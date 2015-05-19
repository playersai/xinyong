
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> 
  &gt;&gt; <a href="/index.php/landscape"><?php echo $nav_location[0]->name; ?></a> 
  &gt;&gt;  <span class="active"><?php echo $nav_location[1]->name; ?> </span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_landscape.png" />
      <ul>
        <?php foreach($left_nav as $row_item){ ?>
        <li><a href="/index.php/landscape/view/<?php echo $row_item->cat_id?>" <?php if($row_item->cat_id==$left_nav_selected){ echo 'style="background-color:#0067ad;color:#fff;display: block;"'; }?> ><?php echo $row_item->name;?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
      <ul class="tabs">
	    <?php foreach($right_top_nav as $row_item){ ?>
        <li class="<?php echo $cat_id==$row_item->cat_id ? 'thistab' : ''; ?>"><a href="<?php if($row_item->cat_type_id!=='1'){echo '/index.php/landscape/type'.$row_item->cat_type_id.'/'.$row_item->parent_id.'/'.$row_item->cat_id; }else{ ?>/index.php/landscape/view/<?php echo $row_item->parent_id; ?>/<?php echo $row_item->cat_id; ?><?php }?>"><?php echo $row_item->name; ?></a></li>
		<?php } ?>
      </ul>
      
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con">
          <div class="aboutbf_pic_list">
          <ul>
		    <? foreach($video_rows as $row_item){?>
            <li><a href="/index.php/view/vedio/<?php echo $row_item->vid.'/'.$row_item->cat_id?>" target="_blank"><img src="<?php echo $row_item->thumb_path; ?>" width="180" height="135" border="0"><font><?php echo $row_item->title; ?></font></a></li>
            <?php } ?>  
          </ul>
          </div>
          
          <div class="clear"></div>
          
          <div class="page" style="margin:0 auto;"> 共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示
		  <?php echo $pageLink; ?>
		  </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--warper end-->