
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/landscape">走进板芙</a> &gt;&gt;  
  <span class="active"><?php echo $now_nav1->name; ?> </span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_landscape.png" />
      <ul>
        <?php foreach($left_nav as $row_item){ ?>
        <li><a href="/index.php/landscape/view/<?php echo $row_item->cat_id; ?>" <?php if($row_item->cat_id==$left_nav_selected){ echo 'style="background-color:#0067ad;color:#fff;display: block;"'; }?> ><?php echo $row_item->name;?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
      <ul class="tabs">
	    <?php foreach($right_top_nav as $row_item){ ?>
        <li class="<?php echo $cat_id==$row_item->cat_id ? 'thistab' : ''; ?>">
          <a href="<?php if($row_item->cat_type_id!=='1'){echo '/index.php/landscape/type'.$row_item->cat_type_id.'/'.$row_item->parent_id.'/'.$row_item->cat_id;}else{?>/index.php/landscape/view/<?php echo $row_item->parent_id; ?>/<?php echo $row_item->cat_id; ?><?php }?>"><?php echo $row_item->name; ?></a>
        </li>
	    <?php } ?> 
      </ul>
      
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con">
        <div>
          <?php echo $pagerows->content; ?>
        </div>
        </li>    
      </ul>
      
    </div>
  </div>
</div>
<!--warper end-->