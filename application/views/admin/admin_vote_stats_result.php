<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<link rel="stylesheet" path="/public/manage/css/" type="text/css" id="skinCss" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>
<link rel="stylesheet" href="/public/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/public/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/public/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/public/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="/public/kindeditor/plugins/code/prettify.js"></script>
	

</head>

<body>
<div class="wrap">
<form method="post" action="/index.php/admin_vote/add_handle/" class="ajax_form" name="myform" onsubmit="return checkdata()">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="1">查看调查结果</th>
    </tr>
    <tr>
      <td style="padding:30px 13px;"> <p align="center"><input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" /> <br><br></p>
	  <table class="myform">
	  <tbody>
	  <?php $i=0; $color_arr=array('#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB','#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB','#E74C3C','#E67E22','#F1C40F','#1ABC9C','#2ECC71','#9B59B6','#3498DB'); ?>	
	  <?php if(isset($vote_rows['qt']) and is_array($vote_rows['qt'])){ ?>
	    <?php foreach($vote_rows['qt'] as $qtkey=>$qtval){ ?>
	    <tr>
          <th height="50" colspan="2" align="left" scope="col" bgcolor="#ffffff"><?php echo htmlspecialchars($qtval->title); ?><span style="font-weihght:300;font-size:12px;"> (<?php echo $qtval->xx_type=='1'?'单选':'多选'; ?>)</span></th>
        </tr>
	    <?php foreach($vote_rows['op'][$qtkey] as $opval){ $i++; ?>
	    <tr>
          <td width="60%" height="30" align="left">&nbsp;&nbsp;<?php echo htmlspecialchars($opval->title); ?></td>
	      <?php $baifenbi=$op_sam[$opval->q_id][$opval->op_id]/$q_sam[$opval->q_id] * 100 ;?>
          <td width="40%" height="30">
            <?php if($baifenbi>1){ ?>
            <div style="background-color:<?php echo $color_arr[$i-1]; ?>; width:<?php echo $baifenbi *2 ;?>px; height:10px; float:left"></div>
            <?php } ?>
            <font style=" line-height:10px; padding:0 10px"><?php echo sprintf("%.2f",$baifenbi) ;?>%(<?php if(empty($op_sam[$opval->q_id][$opval->op_id])){echo 0 ;}else{ echo $op_sam[$opval->q_id][$opval->op_id] ;}?> 票)</font>
          </td>
       </tr>
	  <?php } ?>
	  <?php } ?>
	  <?php }else{ ?>
	  <p>本调查未设定问题及选项。请先添加问题及选项<br ><br /><br ><br /></p>
	  <?php } ?>
	  
	  </tbody>
	  </table>
	  </td>
	  
    </tr>
  </table>
</form>
</div>
</body>

</html>

