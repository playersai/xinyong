
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt; 
  <span class="active"><?php echo isset($left_navs[$left_navs_selected][0]['name'])?$left_navs[$left_navs_selected][0]['name']:$prows->name; ?></span>
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
        <li><a  <?if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;" href="<?php echo $lnnval['url']; ?>"<?php }else{?>href="<?php echo $lnnval['url']; ?>"<?php } ?>><?php echo $lnnval['name']; ?></a></li>
		
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
		
		<?php
		echo $prows->content;
		?>
        
        </li>
      </ul>
    </div>
  </div>
</div>

