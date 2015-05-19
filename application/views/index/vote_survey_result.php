  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/interaction">交流互动</a> &gt;&gt;  
    <span class="active">调查结果</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_interaction.png" />
      <ul>
        <?php foreach($left_navs as $lnkey=>$lnval){ ?>
	    <?php foreach($lnval as $lnnkey=>$lnnval){ ?>
        <li><a <?if($lnnkey==$left_navs_selected){?>style="background: #0067ad;color: #FFF;" href="<?php echo $lnnval['url']; ?>" <?php }else{?>href="<?php echo $lnnval['url']; ?>"<?php } ?>><?php echo $lnnval['name']; ?></a></li>
		<?php } ?>
		<?php } ?>
      </ul>
    </div>
    <div class="clear2"></div>
    <a href="/index.php/interaction/type1/148/"><img src="/public/index/images/online_interview.jpg" /></a> </div>
  <!--left_side end-->
<div class="right_side">
  <div class="border_box">
    <h1><?php echo $votes->title; ?></h1>
    <div class="content_info">开始时间：<?php echo date("Y-m-d",$votes->start_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;结束时间：<?php echo date("Y-m-d",$votes->exp_time); ?> </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <caption>
      调查结果<br />
      <p style="width:99%;border-bottom:1px dashed #ddd; margin:10px 0;"></p>
      </caption>
      <?php if(isset($question_op) and is_array($question_op)){
	$i=0;
	$xxtype[1]='单选';
	$xxtype[2]='多选';
	$xxtype[3]='文本回复';
	$color_arr=array('#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB','#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB','#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB');	  
	foreach($question_op['qt'] as $qtkey=>$qtval){ ?>
  <tr>
    <th height="50" colspan="2" align="left" scope="col"><?php echo htmlspecialchars($qtval->title); ?><span style="font-weight:300;font-size:12px;"> (<?php echo $xxtype[$qtval->xx_type]; ?>)</span></th>
  </tr>
	 <?php
	 if($qtval->xx_type==3){
			  foreach($question_op['op'][$qtkey] as $opkey=>$opval){
			  ?>
  <tr>
    <td width="60%" height="30" align="left">共有多少条回复</td>
    <td width="40%" height="30"></td>
  </tr>
			  
			  <?php
			  }
			  }else{
	  if(isset($question_op['op'][$qtkey])){
	   foreach($question_op['op'][$qtkey] as $opkey=>$opval){
	   $i++;
	  ?>
  <tr>
    <td width="80%" height="30" align="left">&nbsp;&nbsp;<?php echo htmlspecialchars($opval->title);?></td>
	<?php $baifenbi=$op_sam[$opval->q_id][$opval->op_id]/$q_sam[$opval->q_id] * 100 ;?>
    <td width="20%" height="30"><?php if($baifenbi>1){?><div style="background-color:<?php echo $color_arr[$i-1]; ?>; width:<?php echo $baifenbi *2 ;?>px; height:10px; float:left"></div><?php }?><font style=" line-height:10px; padding:0 10px">
<?php echo sprintf("%.2f",$baifenbi) ;?>%(<?php if(empty($op_sam[$opval->q_id][$opval->op_id])){echo 0 ;}else{ echo $op_sam[$opval->q_id][$opval->op_id];}?> 票)</font></td>
  </tr>
  
  <?php
	}
	}
	}
		
	}
	}
  
  ?>
  


</table>
	<p>&nbsp;</p>
	<p align="center">
  	  <input type="button" value="返&nbsp;&nbsp;回" class="submit2" onclick="javascript:location.href='/index.php/interaction/vote/<?php echo $vote_id;?>/<?php echo $cats_selected;?>'"> 
	</p>
  </div>
</div>
</div>