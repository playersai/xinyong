
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> 
  <?php if(isset($nav_location) and is_array($nav_location)){?>
  &gt;&gt; <a href="/index.php/landscape"><?php echo $nav_location[0]->name; ?></a> &gt;&gt;  <span class="active"><?php echo $nav_location[1]->name; ?> </span>
  <?php }  ?>
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
	    <?php foreach($right_top_nav as $row_itme){ ?>
        <li class="<?php echo $cat_id==$row_itme->cat_id?'thistab':''; ?>">
          <a href="<?php if($row_itme->cat_type_id!=='1'){echo '/index.php/landscape/type'.$row_itme->cat_type_id.'/'.$row_itme->parent_id.'/'.$row_itme->cat_id;}else{?>/index.php/landscape/view/<?php echo $row_itme->parent_id; ?>/<?php echo $row_itme->cat_id; ?><?php }?>"><?php echo $row_itme->name; ?></a>
        </li>
	    <?php } ?>       
      </ul>
      
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con"><div class="aboutbf_pic_list">
          <ul>
		  <?php if(isset($thumb_rows)){ ?>
		  <?php foreach($thumb_rows as $thval){ ?>
		     <li><a href="/index.php/view/thumb/<?php echo $thval->photo_id.'/'.$thval->cat_id?>" target="_blank"><img src="<?php echo $thval->first_thumb; ?>" width="180" height="135" border="0"><font><?php echo htmlspecialchars($thval->title); ?></font></a></li>
          <?php } ?>
		  <?php } ?> 
		  </ul>
        </div> 
		
		
		<div class="page"> 共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示
		  
		  <?php echo $pageLink; ?>
		  </div>

        
        </li>
        
      </ul>
    </div>
  </div>
</div>
<!--warper end-->