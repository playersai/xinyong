<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>
<script type="text/javascript" src="/public/manage/js/jquery.form.js"></script>
<script type="text/javascript" src="/public/manage/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="/public/manage/js/fun.js"></script>
<script type="text/javascript" src="/public/manage/js/list.js"></script>
<script type="text/javascript">
$(function () {
	$('input[level=1]').click(function(){
		var inputs = $(this).parents('.datalist').find('input');
		$(this).attr('checked') ? inputs.attr('checked', true) : inputs.attr('checked', false);
	});
	$('input[level=2]').click(function(){
		var inputs = $(this).parents('li').find('input');
		$(this).attr('checked') ? inputs.attr('checked', true) : inputs.attr('checked', false);
		if ( $(this).parents('.datalist').find('input[level=2][checked]').length )
		{
			$(this).parents('.datalist').find('input[level=1]').attr('checked', true);
		} else {
			$(this).parents('.datalist').find('input[level=1]').attr('checked', false);
		}
	});
	$('input[level=3]').click(function(){
		if ( $(this).parents('li').find('input[level=3][checked]').length )
		{
			$(this).parents('li').find('input[level=2]').attr('checked', true);
			$(this).parents('.datalist').find('input[level=1]').attr('checked', true);
		} else {
			$(this).parents('li').find('input[level=2]').attr('checked', false);
			if ( $(this).parents('.datalist').find('input[level=2][checked]').length )
			{
				$(this).parents('.datalist').find('input[level=1]').attr('checked', true);
			} else {
				$(this).parents('.datalist').find('input[level=1]').attr('checked', false);
			}
		}
	});
});
</script>
</head>

<body>
<div class="wrap">
	<form name="link_list" action="<?php echo admin_url('purview/access_save'); ?>" method="post" id="form_data_list">
	<table cellspacing="1" class="myform">
		<thead>
		<tr>
			<th colspan="2">
			<div class="relative">权限菜单列表
				
			</div>
			</th>
		</tr>
		<tr class="mylist_title">
			<td width="120">菜单名称</td>
			<td>子菜单列表</td>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($rules)): ?>
		<?php foreach ($rules as $level1): ?>
		<tr class="datalist">
			<td align="center"><input type="checkbox" level="1" name="access[]" value="<?php echo $level1['id'] ?>" <?php if(in_array($level1['id'], $group_rules)): ?>checked="checked"<?php endif ?> /><label style="line-height:22px; padding:0 10px 0 2px;"><strong><?php echo htmlspecialchars($level1['name']); ?></strong></label></td>
			<td>
				<ul>
				<?php foreach ($level1['children'] as $level2): ?>
					<li style="line-height:30px;"><input type="checkbox" level="2" name="access[]" value="<?php echo $level2['id'] ?>" <?php if(in_array($level2['id'], $group_rules)): ?>checked="checked"<?php endif ?> /><label style="line-height:22px; padding:0 10px 0 2px;"><strong><?php echo htmlspecialchars($level2['name']); ?></strong></label>
						<?php foreach ($level2['children'] as $level3): ?>
							<input type="checkbox" level="3" name="access[]" value="<?php echo $level3['id'] ?>" <?php if(in_array($level3['id'], $group_rules)): ?>checked="checked"<?php endif ?> /><label style="line-height:22px; padding:0 10px 0 2px;"><font color="#999"><?php echo htmlspecialchars($level3['name']); ?></font></label>
						<?php endforeach ?>
					</li>
                    <div style="clear:both">
				<?php endforeach ?>
				</ul>
			</td>
		</tr>
		<?php endforeach ?>
		<?php endif ?>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="gid" value="<?php echo $gid; ?>" />
				<input type="submit" value="提 交" class="btn ajax_btn" />
				<input type="button" value="返 回" class="btn ajax_btn" onclick="history.go(-1)" />
			</td>
		</tr>
		</tbody>
	</table>
	</form>
</div>

</body>
</html>
