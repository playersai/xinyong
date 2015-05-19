
  <div class="breadcrumb">您所在的位置：<span class="active">搜索结果</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_list">
    <div class="news_list2">
      <ul class="tab_conbox">
      <div class="search_info">找到&nbsp;<span style="color:#f00;"><?php echo $srows->handle_id; ?></span>&nbsp;相关信息&nbsp;&nbsp;共<span style="color:#f00;"><?php echo count($srows); ?></span>条</div>
        <div class="clear"></div>
       <div class="complaint_online_question">
        <div class="tit">
          <span>来件类别：镇长信箱</span>
          受理编号：<?php echo $srows->handle_id; ?> </div>
        <div class="con">
          <h1><?php echo $srows->title; ?></h1>
          <div class="con_text">
           		   <?php echo $srows->content; ?>
		             </div>
          <div style="float:right">
            <span>来&nbsp;&nbsp;信&nbsp;&nbsp;人：<?php echo $srows->contact_name; ?>			
			</span>
            <br>
            <span>来信时间：<?php echo $srows->adddate; ?></span>
          </div>
        </div>
      </div>
	  
	   <div class="complaint_online_feedback">
	 <?if(isset($reply_rows) and $fc_rows->status==2 and $fc_rows->is_show==1){?> 
	 <p style="margin:20px 0;">处理结果</P>
        <div class="tit">问题回复:</div>
        <div class="con">
          <p style="text-indent:24px;; line-height:28px;"> <?php echo $reply_rows->content; ?></p>
        </div>
      </div>
	  <?php }else{
	  echo '<h3>您的诉求信息，我们正在处理中。请稍候查看！</h3>';
	  
	  }?>
    </div>
	   
        <div class="clear"></div>
       
        </li>
      </ul>
    </div>
  </div>
</div>
<!--warper end-->
