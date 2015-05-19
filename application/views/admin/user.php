<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
<link rel="stylesheet" href="/public/manage/css/style.css" type="text/css" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<!-- <script type="text/javascript" src="/public/manage/js/panel.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/jquery.form.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/ajaxsubmit.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/fun.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/list.js"></script> -->

<script type="text/javascript">
	function selectAll(checkbox) {
		$('input[type=checkbox]').attr('checked', $(checkbox).attr('checked'));
	}
	$(document).ready(function() { 
		$("#delete_arr").click(function() { 
			var delete_arr='';
			
				if(confirm('确定要删除这些项目吗？删除后将不能还原！')){
					$( ".delete_a").each(function(){  
					   if($(this).attr('checked')){
						   delete_arr +=$(this).val()+"-";   
						  }
					}); 
				 if(delete_arr!=''){
						window.location.href="/index.php/admin_user/delete_arr/"+delete_arr;
				   }else{	
					  alert("请选择要删除的项目！");
				   }  
				 
			   }
			 
	 
		});
		
		$("#status_arr_1").click(function() { 
			var status_arr='';
			
				if(confirm('确定要这些项目通过审核吗？')){
					$( ".delete_a").each(function(){  
					   if($(this).attr('checked')){
						   status_arr +=$(this).val()+"-";   
						  }
					}); 
				  if(status_arr!=''){
						window.location.href="/index.php/admin_user/status_arr/"+status_arr+"/1";
				   }else{
					  alert("请选择要审核的项目！");
				   }	
				 
			   }
		   
		});
		$("#status_arr_0").click(function() { 
			var status_arr='';
			
				if(confirm('确定要这些项目待审吗？')){
					$( ".delete_a").each(function(){  
					   if($(this).attr('checked')){
						   status_arr +=$(this).val()+"-";   
						  }
					}); 
			   if(status_arr!=''){	 
				   window.location.href="/index.php/admin_user/status_arr/"+status_arr+"/0";		   
			   }else{
				  alert("请选择要待审的项目！");
			   }	
			   }
		  	   
		});
	});
</script>
</head>

<body>
<div class="wrap">

  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="10">
      <div class="relative">用户列表
        <div class="buttons">
		    <a class="_add blue" href="javascript:void(0);" title="批量审核" id='status_arr_1'>
                <img src="/public/manage/images/add.gif" alt="批量审核" width="16" height="16" /> 批量审核
            </a>
			<a class="_add blue" href="javascript:void(0);" title="批量待审" id='status_arr_0'>
                <img src="/public/manage/images/add.gif" alt="批量待审" width="16" height="16" /> 批量待审
            </a>
		    <a class="_add blue" href="javascript:void(0);" title="批量删除" id='delete_arr'>
                <img src="/public/manage/images/add.gif" alt="批量删除" width="16" height="16" /> 批量删除
            </a>
          <a class="_add blue" href="/index.php/admin_user/add" title="新增用户">
            <img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增用户
          </a>
        </div>
      </div>
      </th>
    </tr>
    <tr>
      <th colspan="10">
      <div class="search">
        <font>用户名：</font>
        <input type="text" name="s_username" maxlength="50" id="s_username" size="25" value="<?php echo $s_username; ?>" class="input" /> 
        <font>真实姓名：</font>
        <input type="text" name="s_nickname" maxlength="50" id="s_nickname" size="25" value="<?php echo $s_nickname; ?>" class="input" /> 
        <font>所属用户组：</font>
        <select name="s_deptcode" id="s_deptcode">
          <option value="">全部</option>
          <?php foreach ($userGroup as $row_item):?>
          <option value="<?php echo $row_item->group_id; ?>" <?php if($row_item->group_id == $s_deptcode) echo 'selected="selected"'?>><?php echo $row_item->name; ?></option>
          <?php endforeach;?>
        </select>
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
              var queryStr = $('#s_username').val() + "@" + $('#s_nickname').val() + "@" + $('#s_deptcode').val() + "@" + $('#s_status').val();
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");      
	          window.location.href="/index.php/admin_user/index/" + queryStr;
          });
        </script>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" onclick="selectAll(this);" id="delete_arr" class="delete_b"/></td>
      <td width="58">编号</td>
      <td width="102">用户名</td>
	  <td width="112">真实姓名</td>
	  <td width="52">所属用户组</td>
	  <td width="112">登录次数</td>
      <td width="112">加入时间</td>
	  <td width="112">最后登录</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $uval){ ?>
    <tr class="datalist">
	  <td align="center"><input type="checkbox" value="<?php echo $lval->link_id;?>" class="delete_a" /></td>
      <td align="center"><?php echo $uval->user_id; ?> </td>
      <td ><?php echo $uval->username; ?></td>
      <td align="center"><?php echo $uval->nickname==''?"未填写":$uval->nickname; ?></td>
	  <td align="center"><?php echo $uval->name; ?></td>
	  <td align="center"><?php echo $uval->login_nums; ?></td>
	  <td align="center"><?php echo date("Y-m-d H:i",$uval->addtime); ?></td>
	  <td align="center"><?php echo date("Y-m-d H:i",$uval->last_login_time); ?></td>
	  <td align="center">
	  <?php switch($uval->status){
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14"  title="锁定">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14"  title="正常">';break;
	  }?></td>
      <td align="center">
	    <a class="win_normal" href="/index.php/admin_user/edit/<?php echo $uval->user_id; ?>" title="编辑用户"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
	    <?php if($uval->status=='1'){?>
	    <a class="win_normal" href="/index.php/admin_user/delete/<?php echo $uval->user_id; ?>/<?php echo $uval->status; ?>" title="锁定用户"><img src="/public/manage/images/delete.gif" alt="锁定用户" width="16" height="16" /></a>
	    <?php }else{?>
	    <a class="win_normal" href="/index.php/admin_user/delete/<?php echo $uval->user_id; ?>/<?php echo $uval->status; ?>" title="解锁用户"><img src="/public/manage/images/auth.gif" alt="解锁用户" width="16" height="16" /></a>
	    <?php }?>
	  </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
  
  <div class="mylist_foot">
    <div class="page fl"> &nbsp;共&nbsp;<?php echo $totalRows; ?>&nbsp;条数据,分&nbsp;<?php echo $totalPages; ?>&nbsp;显示</div>
    <div class="page fr"><?php echo $pageLink ?></div>
  </div>

</div>
</body>




</html>

