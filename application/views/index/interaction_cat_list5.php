
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt; 
  <span class="active"><?php echo $now_nav2->name; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_interaction.png" />
      <ul>
	  <?php
	  if(isset($left_navs)){
	
	  foreach($left_navs as $lnkey=>$lnval){
	  
	  if(is_array($lnval)){
	  foreach($lnval as $lnnkey=>$lnnval){
	  ?>
        <li><a <?if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;" href="<?php echo $lnnval['url']; ?>"<?php }else{?>href="<?php echo $lnnval['url']; ?>"<?php } ?>><?php echo $lnnval['name']; ?></a></li>
		
		<?php 
		}
		}
		}
		}
		?>
       
      </ul>
    </div>
    <div class="clear2"></div>
    <a href="/index.php/interaction/type1/148/"><img src="/public/index/images/online_interview.jpg" /></a> </div>
  <!--left_side end-->
 <div class="right_side">
    <div class="news_list2">
      <ul class="tab_conbox">
        <li class="tab_con">
        <?php foreach($fbrows as $fbval){ ?>
        <span><font><?php echo date("Y-m-d",$fbval->addtime);?></font><a href="/index.php/interaction/vote/<?php echo $fbval->vote_id.'/'.$fbval->cat_id; ?>" target="_blank"><?php echo htmlspecialchars($fbval->title);?></a></span>
		<?php } ?>
        <div class="clear"></div>
        <div class="page">
		 
      共<span style="color:#f00;"><?php echo $page_info['nums']; ?></span>条记录，分<span style="color:#f00;"><?php echo $page_info['page_nums']; ?></span>页显示
      <?php echo $pages; ?>
		</div>
        </li>
      </ul>
    </div>
  </div>
</div>

