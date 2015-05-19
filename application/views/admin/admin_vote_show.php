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
	

</head>

<body>
<div class="wrap">

  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2"><?php echo isset($vote->title)?$vote->title:''; ?>&nbsp;[<a class="win_normal" href="/index.php/admin_vote/edit/<?php echo isset($vote->vote_id)?$vote->vote_id:''; ?>/<?php echo isset($vote->cat_id)?$vote->cat_id:''; ?>" title="编辑">编辑</a>]</th>
    </tr>
    <?php if(is_array($q_options) && isset($q_options[1])){
	foreach($q_options[0] as $qval){
	?>
    <tr>
      <td align="right">选项标题：<br>当前选项：</td>
      <td>
      <form style="height:30px;" action="/index.php/admin_vote/show/<?php echo $vote->vote_id.'/'.$vote->cat_id.'/'.$qval->q_id;?>" method="post">
        <div style="width:550px;float:left;">
			<input type="text" name="title" maxlength="50" class="input" dataType="require" title="请输入标题，输入长度不能超过50个字符" value="<?php echo htmlspecialchars($qval->title); ?>" style="width:450px;" />
	 	</div>
	 	<div>
	  		<input type="submit" name="submit" value="更新" class="btn "  />
	  		<input type="button" name="del" onclick="javascript:if(confirm('确定要删除选项标题吗？删除选项标题其子选项也将被删除且不能还原！')){location.href='/index.php/admin_vote/del_question/<?php echo $vote->vote_id; ?>/<?php echo $qval->q_id; ?>';}" value="删除" class="btn "  />
	  		<input type="button" value="高级编辑" class="btn" onclick="javascript:location.href='/index.php/admin_vote/edit_question/<?php echo $qval->q_id; ?>';"  />
	  	</div>
	  </form> 
	  <p style="padding-top:6px;">
	  
	  <div style="width:544px;float:left;padding-left:6px;">
	  <form action="/index.php/admin_vote/del_options/<?php echo $vote->vote_id.'/'.$vote->cat_id.'/'.$qval->q_id;?>" method="post">
		<?php foreach($q_options[1][$qval->q_id] as $opval){ ?>
		  <?php if($qval->xx_type=='1'){ ?>
		  <input type="radio" name="type1[<?php echo $opval->q_id?>]" value="<?php echo $opval->op_id?>" style="vertical-align: middle;margin-right:3px;border:none;padding:0;"><label><?php echo htmlspecialchars($opval->title); ?></label>
		  <?php } ?>
		
		  <?php if($qval->xx_type=='2'){ ?>
		  <input type="checkbox" name="type2[<?php echo $opval->op_id?>]" value="<?php echo $opval->q_id?>" style="vertical-align: middle;margin-right:3px;border:none;padding:0;"><label><?php echo htmlspecialchars($opval->title); ?></label>
		  <?php } ?>
		<?php } ?>
		</div><div style="width:260px;float:left;">
		 <input type="submit" value="删除选中" class="btn ajax_btn" onClick="return confirm('确定要删除所选选项吗？删除后将不能还原！')" />
		 <input type="button" value="新增选项" class="btn" onclick="javascript:location.href='/index.php/admin_vote/add_options/<?php echo $qval->q_id; ?>';"/>
		 <input type="button" value="高级编辑" class="btn" onclick="javascript:location.href='/index.php/admin_vote/edit_options/<?php echo $qval->q_id; ?>';"/></div>
		 </form>
	  
	  </p>
	  
	  
	  
	  </td>
    </tr>
	
	<?php
	}
	}
	
	if(!isset($q_options) || empty($q_options[0])){
	?>
    <tr>
      <td align="right" width="168">标题:<br/>问题:</td>
      <td>暂无问题及选项</td></tr>
	<?php }?>
	
    <tr>
      <td align="right"></td>
      <td>
        
		<input type="button" value="返 回" class="btn ajax_btn" onclick="location.href='/index.php/admin_vote/index/<?php echo $vote->cat_id;?>/1';" />

      </td>
    </tr>
	
  </table>

</div>
</body>


</html>

