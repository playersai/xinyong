<?php $this->load->view('public/header'); ?>
<h3 class="tt">添加权限菜单 <small>( 标注 <span class="red">*</span> 号为必填项 )</small></h3>

<form method="post" class="theForm">
<table class="form">

	<tr>
		<td class="tl Validform_label"><span class="red">*</span> 名称：</td>
		<td><input type="text" name="name" class="inp" datatype="*" ajaxurl="<?php echo admin_url('purview/check_rulename'); ?>"> <span class="gray">控制器-方法 以'-'分割</span></td>
	</tr>
	<tr>
		<td class="tl Validform_label"><span class="red">*</span> 描述：</td>
		<td><input type="text" name="title" class="inp" datatype="*"> <span class="gray">简单描述</span></td>
	</tr>
	<tr>
		<td class="tl">状态：</td>
		<td>
			<input type="radio" name="status" value="1" checked="checked">开启
			<input type="radio" name="status" value="0">禁用
		</td>
	</tr>
	<tr>
		<td class="tl">是否显示：</td>
		<td>
			<input type="radio" name="show" value="1" checked="checked">显示
			<input type="radio" name="show" value="0">隐藏
			<span class="gray">隐藏后将不在菜单上显示</span>
		</td>
	</tr>
	<tr>
		<td class="tl">排序：</td>
		<td><input type="text" name="sort" class="inp" size="5" value="100" onclick="$(this).select();"> <span class="gray">值越小越排前</span></td>
	</tr>
	<tr>
		<td class="tl">条件：</td>
		<td><input type="text" name="condition" class="inp" style="width:400px"></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="hidden" name="pid" value="<?php echo $pid; ?>">
			<input type="submit" value="保存" class="btn btn_red">
			<input type="button" value="取消" onclick="javascript:history.back(-1);" class="btn">
		</td>
	</tr>

</table>
</form>

<?php $this->load->view('public/footer'); ?>