
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/landscape">走进板芙</a> &gt;&gt;
    <span class="active">投资板芙</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_landscape.png" />
      <ul>
		<?php foreach($left_nav as $row_item){?>
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
        <li class="<?php echo $cat_id==$row_item->cat_id ? 'thistab' : ''; ?>"><a href="<?php if($row_item->cat_type_id!=='1'){echo '/index.php/landscape/type'.$row_item->cat_type_id.'/'.$row_item->parent_id.'/'.$row_item->cat_id;?><?php }else{ ?>/index.php/landscape/view/<?php echo $row_item->parent_id; ?>/<?php echo $row_item->cat_id; ?><?php }?>"><?php echo $row_item->name; ?></a></li>
		<?php } ?>
      </ul>
      
      <ul class="tab_conbox" id="tab_conbox">
	
        <li class="tab_con">
		  <?php if($cat_id==113 || $cat_id==114){?>
		  <p style="float:right;"><a href="/index.php/landscape/type2add/<?php echo $cat_id==113?1:2; ?>" class="recruit_apply_btn" target="_blank">发布信息</a></p>
		  <?php } ?>
		  
		  <?php foreach($fbrows as $row_item){ ?>
		  <span><font><?php echo date("Y-m-d",$row_item->rel_date);?></font><a href=<?php if($row_item->is_redirect==1){ echo $row_item->redirect_url;}else{ echo '/index.php/landscape/article/'.$row_item->aid .'/'.$row_item->cat_id; }?>   target="_blank"><?php echo htmlspecialchars($row_item->title);?></a></span>
		  <?php } ?>
		    	        	
          <div class="clear"></div>
          <div class="page"> 共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示
		  <?php echo $pageLink; ?>
		  </div>
        </li>
        
      </ul>
    </div>
  </div>
</div>
<!--warper end-->
