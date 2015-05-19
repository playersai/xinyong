<?php $this->load->view('public/header'); ?>
<h3 class="tt">添加权限菜单 <small>( 标注 <span class="red">*</span> 号为必填项 )</small></h3>

<form method="post" class="theForm" actioin="<?php echo admin_url('purview/rule_add'); ?>">
<table class="form">

	<tr>
		<td class="tl Validform_label"><span class="red">*</span> 名称：</td>
		<td><input type="text" name="name" class="inp" datatype="*" value="<?php echo $rule['name']; ?>"> <span class="gray">控制器-方法 以'-'分割</span></td>
	</tr>
	<tr>
		<td class="tl Validform_label"><span class="red">*</span> 描述：</td>
		<td><input type="text" name="title" class="inp" datatype="*" value="<?php echo $rule['title']; ?>"> <span class="gray">简单描述</span></td>
	</tr>
	<tr>
		<td class="tl">状态：</td>
		<td>
			<input type="radio" name="status" value="1" <?php if($rule['status'] == 1): ?> checked="checked"<?php endif;?>>开启
			<input type="radio" name="status" value="0" <?php if($rule['status'] == 0): ?> checked="checked"<?php endif;?>>禁用
		</td>
	</tr>
	<tr>
		<td class="tl">排序：</td>
		<td><input type="text" name="sort" class="inp" size="5" value="<?php echo $rule['sort'] ?>" onclick="$(this).select();"> <span class="gray">值越小越排前</span></td>
	</tr>
	<tr>
		<td class="tl">条件：</td>
		<td><input type="text" name="condition" value="<?php echo $rule['condition'] ?>" class="inp" style="width:400px"></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="hidden" name="id" value="<?php echo $rule['id']; ?>">
			<input type="submit" value="保存" class="btn btn_red">
			<input type="button" value="取消" onclick="javascript:history.back(-1);" class="btn">
		</td>
	</tr>

</table>
</form>

<?php $this->load->view('public/footer'); ?>