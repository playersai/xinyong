<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<!-- <script type="text/javascript" src="/public/manage/js/panel.js"></script>
<script type="text/javascript" src="/public/manage/js/jquery.form.js"></script>
<script type="text/javascript" src="/public/manage/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="/public/manage/js/fun.js"></script>
<script type="text/javascript" src="/public/manage/js/list.js"></script> -->


</head>

<body>
<div class="wrap">
	<form name="link_list" action="" method="post" id="form_data_list">
	<table cellspacing="1" class="mylist">
		<thead>
		<tr>
			<th colspan="9">
			<div class="relative">用户组列表
				<div class="buttons">
					<a class="_add blue" href="<?php echo admin_url('admin_user_group/add'); ?>" title="新增用户组"><img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增用户组</a>
				</div>
			</div>
			</th>
		</tr>
	  <tr>
      <th colspan="9">
      <div class="search">
        <font>用户组：</font>
        <input type="text" name="user_group" maxlength="50" id="user_group" size="25" value="<?php echo $user_group; ?>" class="input" /> 
         
        <font>状态：</font>
        <select name="s_status" id="s_status">
          <option value="" <?php if($s_status == '-1') echo 'selected="selected"'?>>全部</option>
           <option value="1" <?php if($s_status == '1') echo 'selected="selected"'?>>正常</option> 
           <option value="0" <?php if($s_status == '0') echo 'selected="selected"'?>>锁定</option> 
        </select>
        <input type="button" id="btn_search" class="btn_s" value="查 询" />
        <script src="/public/index/js/base64.js" type="text/javascript"></script>
        <script>
	 
          $("#btn_search").click(function() { 
              var base64 = new Base64();
              var queryStr = $('#user_group').val() + "@" + $('#s_status').val() ;
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");   
		  
	          window.location.href="/index.php/admin_user_group/index/" + queryStr;
          });
	 
        </script>
      </div>
      </th>
    </tr>
		<tr class="mylist_title">
			<td width="58">编号</td>
			<td width="200">用户组名称</td>
			<td>组描述</td>
			<td width="52">状 态</td>
			<td width="102">操 作</td>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($rows)): ?>
		<?php foreach ($rows as $uval): ?>
		<tr class="datalist">
			<td align="center"><?php echo $uval->group_id; ?> </td>
			<td ><?php echo $uval->name; ?></td>
			<td ><?php echo $uval->description; ?></td>
			<td align="center">
				<?php 
					switch($uval->status)
					{
						case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14"  title="锁定">';break;
						case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14"  title="正常">';break;
					}
				?>
			</td>
			<td align="center">
				<a class="win_normal" href="<?php echo admin_url('purview/access/'.$uval->group_id); ?>" title="分配权限"><img src="/public/manage/images/auth.gif" alt="分配权限" width="16" height="16" /></a>
				<a class="win_normal" href="<?php echo admin_url('admin_user_group/edit/'.$uval->group_id); ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
				<a class="win_normal" href="<?php echo admin_url('admin_user_group/delete/'.$uval->group_id); ?>" title="删除"><img src="/public/manage/images/delete.gif" alt="删除"  width="16" height="16" onclick="javascript:return confirm('确定要删除吗？删除后将不能还原！')" /></a>
			</td>
		</tr>
		<?php endforeach ?>
		<?php endif ?>
		</tbody>
	</table>
	</form>
</div>
</body>




</html>

