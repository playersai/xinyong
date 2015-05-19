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
      <div class="relative">所有专题分类
        <div class="buttons"></div>
      </div>
      </th>
    </tr>
    
    <tr class="mylist_title">
      <td width="108">分类名称</td>
      <td width="398">分类简介</td>
	  <td width="52">分类属性</td>
	  <td width="52">排 序</td>
      <td width="52">状 态</td>
      <td width="122">操 作</td>
    </tr>
    </thead>
    
    <tbody>
    <?php $a= 0; ?>
	<?php foreach($rows['cat2'] as $cat2_item){ ?>
	<?php $a++; ?>
	
    <tr class="datalist <?php echo $a%2==0?"even":"odd"?>">
      <td dataType="require"><strong><?php echo $cat2_item->name; ?></strong></td>
      <td ><?php echo $cat2_item->content; ?></td>
	  <td align="center"><?php echo $cat_type[$cat2_item->cat_type_id]->name; ?></td>
	  <td align="center"><?php echo $cat2_item->sort; ?></td>
      <td align="center">
      <?php switch($cat2_item->status) {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="隐藏或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
	  } ?>
	  </td>
      <td align="center" class="action">
	    <a class="win_normal" href="/index.php/admin_category/add/<?php echo $cat2_item->cat_id; ?>/<?php echo $cat2_item->cat_type_id; ?>" title="添加子分类"><strong>添加分类</strong></a>
	    <a class="win_normal" href="/index.php/admin_category/edit2/<?php echo $cat2_item->cat_id; ?>/<?php echo $cat2_item->cat_type_id; ?>" title="编辑分类"><strong>编辑分类</strong></a>
	  </td>
    </tr>
    
    <?php foreach($rows['cat3'][$cat2_item->cat_id] as $cat3_item){ ?>
	<tr class="datalist <?php echo $a%2==0?"even":"odd"?>">
      <td dataType="require" onclick="editNow({$vo.id},'title','{url f='update'}',this);"  style="padding-left:16px;">||__&nbsp;<?php echo $cat3_item->name; ?></td>
      <td onclick="editNow({$vo.id},'description','{url f='update'}',this);"><?php echo $cat3_item->content; ?></td>
	  <td align="center"><?php echo $cat_type[$cat3_item->cat_type_id]->name; ?></td>
	  <td align="center"><?php echo $cat3_item->sort; ?></td>
      <td align="center">
      <?php switch($cat3_item->status) {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="正常显示隐藏或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
	  } ?>
	  </td>
      <td align="center" class="action">
      <?php if($cat3_item->cat_type_id==7){?>
	    <a href="/index.php/admin_topic/add/<?php echo $cat3_item->cat_id; ?>">添加文章</a>
	    <a href="/index.php/admin_topic/<?php echo $cat3_item->cat_id; ?>/1">文章管理</a>
	  <?php }elseif ($cat3_item->cat_type_id==3){ ?>
	    <a href="/index.php/admin_photo/add/<?php echo $cat3_item->cat_id; ?>">添加图集</a>
	    <a href="/index.php/admin_photo/<?php echo $cat3_item->cat_id; ?>/1">图集管理</a>
	  <?php } ?>
	  </td>
    </tr>
	
	<?php } ?>
    <?php } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="page fr"></div>
  </div>
  </form>
</div>
</body>



</html>

