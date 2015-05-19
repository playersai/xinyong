
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt; 
    <span class="active">投诉详情</span>
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
        <li><a  <?if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;" href="<?php echo $lnnval['url']; ?>" <?php }else{?>href="<?php echo $lnnval['url']; ?>"<?php } ?>><?php echo $lnnval['name']; ?></a></li>
		
		<?php 
		}
		}
		}
		}
		?>
      </ul>
    </div>
    <div class="clear2"></div>
    <a href=""><img src="/public/index/images/online_interview.jpg" /></a> </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="border_box">
      <div class="complaint_online_question">
        <div class="tit">
          <span>来件类别：
          <?php foreach($types as $tyval):?>
		  <?php if($tyval->type_id==$fc_rows->type_id) { 
		  			echo $tyval->name;
				} ?>
		  <?php endforeach;?>		  
		  </span>
          受理编号：<?php echo $fc_rows->handle_id; ?> 
        </div>
        
        <div class="con">
          <h1><?php echo $fc_rows->title; ?></h1>
          <div class="con_text">
           <?php if($fc_rows->status==2 and $fc_rows->is_show=='1') { ?>
		       <?php echo nl2br($fc_rows->content); ?> 
		   <?php } elseif ($fc_rows->is_show=='0'){?>
		       本诉求信息来信者意愿不公开信息！暂时无法查看！如果你是诉求者，请输入受理编号及密码查看处理结果。
		   <?php } else {?>
		       本诉求信息，我们正在处理中。请稍候查看结果！
		   <?php } ?>
          </div>
          <div style="float:right">
            <span>来&nbsp;信&nbsp;人：<?php echo name_replace(htmlspecialchars($fc_rows->contact_name)); ?></span>
            <br />
            <span>来信时间：<?php echo date("Y-m-d",$fc_rows->addtime); ?></span>
          </div>
        </div>
      </div>
      <div class="complaint_online_feedback">
	  <?if(isset($reply_rows) and $fc_rows->status==2 and $fc_rows->is_show==1){?> 
        <div class="tit">问题回复:</div>
        <div class="con">
          <p style="text-indent:24px;; line-height:28px;"><?php echo $reply_rows->content;?></p>
        </div>
      </div>
	  <?php }?>
    </div>
  </div>
</div>
<!--warper end-->
