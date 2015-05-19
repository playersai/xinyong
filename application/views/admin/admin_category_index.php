<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<link rel="stylesheet" path="/public/manage/css/" type="text/css" id="skinCss" />
<link rel="stylesheet" path="/public/manage/js/artDialog/skins/" type="text/css" id="artDialogCss" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>
<script type="text/javascript" src="/public/manage/js/jquery.form.js"></script>
<script type="text/javascript" src="/public/manage/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="/public/manage/js/fun.js"></script>
<script type="text/javascript" src="/public/manage/js/list.js"></script>

</head>

<body>
<div class="wrap">
  <!--div class="search">
  <form action="{url do='search'}" method="post">
     分类名称：
     <input type="text" name="search_where[title][like]" size="12" value="" class="input" />
     状态：
    <select name="search_where[status][eq]">
     {:myselect('请选择,启用:1,锁定:0',$search_where.status.eq)}
    </select>
    <input type="submit" class="btn_s" value="查 询" />
  </form>
  </div-->
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="6">
      <div class="relative">所有分类列表
        <div class="buttons">
            <a class="_add blue" href="/index.php/admin_category/add" title="新增顶级分类">
                <img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增顶级分类
            </a>
        </div>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      
      <td width="108">分类名称</td>
      <td width="298">分类简介</td>
	   <td width="52">分类属性</td>
	  <td width="52">排 序</td>
      <td width="52">状 态</td>
      <td width="122">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($cat)){
	$a=0;
	
	foreach($cat as $catval){
	$a++;
	?>
    <tr class="datalist <?php echo $a%2==0?"even":"odd"?>">
      <td dataType="require"><strong><?php echo htmlspecialchars($catval->name); ?></strong></td>
      <td style="width:398px;table-layout: fixed;word-break: break-all;word-wrap: break-word"><?php echo htmlspecialchars($catval->content); ?></td>
	  <td align="center"><?php 
	 echo $cat_type[$catval->cat_type_id]->name;
	  ?></td>
	  <td align="center"><?php 
	 echo $catval->sort;
	  ?></td>
      <td align="center"><?php 
	  switch($catval->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="正常显示隐藏或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
		
	  }
	  ?></td>
      <td align="center" class="action">
	    
	  
	  <a class="win_normal" href="/index.php/admin_category/add/<?php echo $catval->cat_id; ?>/<?php echo $catval->cat_type_id; ?>" title="添加子分类"><img src="/public/manage/images/add.gif" alt="添加子分类" width="16" height="16" /></a>
	  <a class="win_normal" href="/index.php/admin_category/edit<?php echo $catval->cat_type_id=='1'?'1':'2'; ?>/<?php echo $catval->cat_id; ?>" title="编辑分类"><img src="/public/manage/images/edit.gif" alt="编辑分类" width="16" height="16" /></a>
	  
	  <a class="win_normal" href="/index.php/admin_category/delete/<?php echo $catval->cat_id; ?>/<?php echo $catval->status; ?>" title="<?php echo $catval->status=='0'?'还原分类':'删除分类'; ?>" onclick="javascript:return confirm('确定要删除本分类吗？确认后所属分类文章也将被删除，且不能还原！请谨慎操作')"><img src="/public/manage/images/delete.gif" alt="<?php echo $catval->status=='0'?'还原分类':'删除分类'; ?>" width="16" height="16" /></a>
	  </td>
    </tr>
	
		<?php
		if(@is_array($son[$catval->cat_id])){
		foreach($son[$catval->cat_id] as $sonval){
		
		?><tr class="datalist <?php echo $a%2==0?"even":"odd"?>">
      <td  style="padding-left:16px;">||__&nbsp;<?php echo $sonval->name; ?></td>
      <td style="width:398px;table-layout: fixed;word-break: break-all;word-wrap: break-word" ><?php echo $sonval->content; ?></td>
	  
	  <td align="center"><?php 
	  
	 echo $cat_type[$sonval->cat_type_id]->name;
	  ?></td>
	  <td align="center"><?php 
	 echo $sonval->sort;
	  ?></td>
      <td align="center"><?php 
	  switch($sonval->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="正常显示隐藏或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
	  }
	  ?></td>
      <td align="center" class="action">
	 
	  <a class="win_normal" href="/index.php/admin_category/add/<?php echo $sonval->cat_id; ?>/<?php echo $sonval->cat_type_id; ?>" title="添加子分类"><img src="/public/manage/images/add.gif" alt="添加子分类" width="16" height="16" /></a>
	  <a class="win_normal" href="/index.php/admin_category/edit<?php echo $sonval->cat_type_id=='1'?1:'2'; ?>/<?php echo $sonval->cat_id; ?>" title="编辑分类"><img src="/public/manage/images/edit.gif" alt="编辑分类" width="16" height="16" /></a>
	  
	  <a class="win_normal" href="/index.php/admin_category/delete/<?php echo $sonval->cat_id; ?>/<?php echo $sonval->status; ?>" title="<?php echo $sonval->status=='0'?'还原分类':'删除分类'; ?>" onclick="javascript:return confirm('确定要删除本分类吗？确认后所属分类文章也将被删除，且不能还原！请谨慎操作')"><img src="/public/manage/images/delete.gif" alt="删除分类" width="16" height="16" /></a>
	  
	  </td>
    </tr>
	
	<?php if(@is_array($son_son[$sonval->cat_id])){
	foreach($son_son[$sonval->cat_id] as $sonsonval){
	?>
		
		<tr class="datalist <?php echo $a%2==0?"even":"odd"?>">
      <td dataType="require" onclick="editNow({$vo.id},'title','{url f='update'}',this);"  style="padding-left:36px;">|||__&nbsp;<?php echo $sonsonval->name; ?></td>
      <td style="width:398px;table-layout: fixed;word-break: break-all;word-wrap: break-word"><?php echo $sonsonval->content; ?></td>
	 <td align="center"><?php 
	 echo $cat_type[$sonsonval->cat_type_id]->name;
	  ?></td>
	 <td align="center"><?php 
	 echo $sonsonval->sort;
	 
	  ?></td>
      <td align="center"><?php 
	  switch($sonsonval->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="正常显示隐藏或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
		}
	  ?></td>
      <td align="center" class="action">
		<?php if($sonsonval->cat_type_id!=='1'){?>
			<a href="/index.php/<?php echo $cat_type[$sonsonval->cat_type_id]->controllers;?>/add/<?php echo $sonsonval->cat_id; ?>" title="添加内容"><img src="/public/manage/images/add_bg.gif" title="添加内容" alt="添加内容" width="16" height="16" /></a>
		<?php }else{?>
			<a class="win_normal">&nbsp;&nbsp;</a>
		<?php } ?>
		<a class="win_normal" href="/index.php/admin_category/edit<?php echo $sonsonval->cat_type_id=='1'?1:'2'; ?>/<?php echo $sonsonval->cat_id; ?>" title="编辑分类"><img src="/public/manage/images/edit.gif" alt="编辑分类" width="16" height="16" /></a>
		<a class="win_normal" href="/index.php/admin_category/delete/<?php echo $sonsonval->cat_id; ?>/<?php echo $sonsonval->status; ?>" title="<?php echo $sonsonval->status=='0'?'还原分类':'删除分类'; ?>" onclick="javascript:return confirm('确定要删除本分类吗？确认后所属分类文章也将被删除，且不能还原！请谨慎操作')"><img src="/public/manage/images/delete.gif" alt="删除分类" width="16" height="16" /></a>
		</td>
		</tr>
	<?php 
	}
	}
	?>
	
	
  


	
	<?php
	}
	}
	?>
	
    <?php }
	
	}?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="page fr"></div>
  </div>
  </form>
</div>
</body>



</html>

