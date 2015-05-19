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
  
  </div-->
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="8">
      <div class="relative"><?php echo $crows[0]->name; ?>列表
        <div class="buttons">
             <a class="_add blue" href="/index.php/admin_ads/add/<?php echo is_array($crows)?$crows[0]->cat_id:'';?>" title="新增">
                <img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增
            </a>
        </div>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <!--td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td-->
      <td width="52">编号</td>
	  <td>广告介绍</td>
      <td width="102">所属栏目</td>
	  <td width="52">录入人</td>
      <td width="82"> 序 号</td>
	  <td width="102">录入时间</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($arows)){
	
	foreach($arows as $aval){
	?>
    <tr class="datalist">
	<td align="center"><?php echo $aval->ads_id; ?></td>
      <td><?php echo $aval->content; ?></td>
      <td align="center"><?php echo is_array($crows)?$crows[0]->name:'';?></td>
	   
	   <td align="center"><?php echo $aval->add_user;?></td>
	
	   <td align="center"><?php echo $aval->sort; ?></td>
	   <td align="center"><?php echo date("Y-m-d H:i",$aval->addtime);?></td>
      <td align="center"><?php 
	  switch($aval->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="待审或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
	  }
	  ?></td>
      <td align="center" class="action">
	 
	  
		
	  
	   <a class="win_normal" href="/index.php/admin_ads/edit/<?php echo $aval->ads_id; ?>/<?php echo $aval->cat_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
	   
	     <a class="win_normal" href="/index.php/admin_ads/delete/<?php echo $aval->ads_id; ?>/<?php echo $aval->status; ?>/<?php echo $aval->cat_id; ?>" onclick="javascript:return confirm('确定要删除本项目吗？删除后将不能还原！')" ><img src="/public/manage/images/delete.gif" alt="" width="16" height="16" /></a>
	  
	  </td>
    </tr>
    <?php
	}
	} ?>
    </tbody>
  </table>
  <div class="mylist_foot">
  <div class="page fl"><?php if(!empty($pages)){ ?> &nbsp;<?php echo $page_info['nums']; ?>条数据,&nbsp;<?php echo $page_info['now_page']; ?>/<?php echo $page_info['page_nums']; ?><?php } ?></div>
    <div class="page fr"><?php echo isset($pages)?$pages:'...';?></div>
  </div>
  </form>
</div>
</body>



</html>

