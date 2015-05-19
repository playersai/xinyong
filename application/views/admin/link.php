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
<script type="text/javascript" src="/public/manage/js/list.js"></script>-->
<script charset="utf-8" src="/public/My97DatePicker/WdatePicker.js"></script>
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
						window.location.href="/index.php/admin_link/delete_arr/"+delete_arr;
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
						window.location.href="/index.php/admin_link/status_arr/"+status_arr+"/1";
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
				   window.location.href="/index.php/admin_link/status_arr/"+status_arr+"/0";		   
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
  <!--div class="search">
  <form name="search" action="{url do='search'}" method="post">
     网站名称：
     <input type="text" name="website_name" size="12" value="" class="input" />
    
    <input type="submit" class="btn_s" value="查 询" />
  </form>
  </div-->
  <form name="link_list" action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="9">
      <div class="relative">友情链接列表
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
            <a class="_add blue" href="<?php echo $config['base_url']?>admin_link/add" title="新增友情链接">
                <img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增友情链接
            </a>
        </div>
      </div>
      </th>
    </tr>
		<tr>
      <th colspan="9">
      <div class="search">
        <font>网站名称：</font>
        <input type="text" name="website_name" maxlength="50" id="website_name" size="25" value="<?php echo $website_name; ?>" class="input" /> 
 
        <font>链接分类：</font>
        <select name="type_id" id="type_id">
			<option value="" <?php if($type_id == '-1') echo 'selected="selected"'?>>全部</option>
			<option value="0" <?php if($type_id == '0') echo 'selected="selected"'?>>默认</option> 
			<option value="1" <?php if($type_id == '1') echo 'selected="selected"'?>>国家部委网站</option> 
			<option value="2" <?php if($type_id == '2') echo 'selected="selected"'?>>省级政府网站</option> 
			<option value="3" <?php if($type_id == '3') echo 'selected="selected"'?>>省内地市政府网站</option> 
			<option value="4" <?php if($type_id == '4') echo 'selected="selected"'?>>中山各镇区网站</option> 
			<option value="5" <?php if($type_id == '5') echo 'selected="selected"'?>>中山各镇区网站</option> 
			<option value="6" <?php if($type_id == '6') echo 'selected="selected"'?>>社会团体网站</option> 
        </select>
         
        <font>状态：</font>
        <select name="l_status" id="l_status">
          <option value="" <?php if($a_status == '-1') echo 'selected="selected"'?>>全部</option>
           <option value="1" <?php if($a_status == '1') echo 'selected="selected"'?>>正常</option> 
           <option value="0" <?php if($a_status == '0') echo 'selected="selected"'?>>锁定</option> 
        </select>
		
        <input type="button" id="btn_search" class="btn_s" value="查 询" />
		<input type="button" id="btn_reset" class="btn_s" value="清 空" />
        <script src="/public/index/js/base64.js" type="text/javascript"></script>
        <script>
	 
          $("#btn_search").click(function() {  
              var base64 = new Base64();
              var queryStr = $('#website_name').val()  + "@" + $('#type_id').val() + "@" + $('#l_status').val(); 
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");   
			  var pages="";
		      if(pages!='QEBA'){
			     pages_str="/<?php echo $per_pages ;?>";
			  }else{
			     pages_str="";
			  }
	          window.location.href="/index.php/admin_link/index/"+ queryStr+""+pages_str ;
          });
		   $("#btn_reset").click(function() { 
               $('#website_name').val(''); 
			   $('#add_user').val('');
			   $("#l_status option[value='1']").attr("selected", false);
			   $("#l_status option[value='0']").attr("selected", false);
			   $("#type_id option").attr("selected", false);
		 
			  
          });
	 
        </script>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" onclick="selectAll(this);" id="delete_arr" class="delete_b"/></td>
      <td width="120">网站名称</td>
      <td>网站简介</td>
      <td width="120">链接分类</td>
	  <td width="100">添加时间</td>
	  <td width="52">排 序</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($links as $lval){?>
    <tr class="datalist">
      <td align="center"><input type="checkbox" value="<?php echo $lval->link_id;?>" class="delete_a" /></td>
      <td align="center" dataType="require"><?php echo htmlspecialchars($lval->website_name); ?> </td>
      <td ><?php echo htmlspecialchars($lval->description); ?></td>
      <td align="center"><?php switch($lval->type_id){
		case 0 : echo '默认';break;
		case 1 : echo '国家部委网站';break;
		case 2 : echo '省级政府网站';break;
		case 3 : echo '省内地市政府网站';break;
		case 4 : echo '市政府机构网站';break;
		case 5 : echo '中山各镇区网站';break;
		case 6 : echo '社会团体网站';break;
	  } ?></td>
      <td align="center"><?php echo date("Y-m-d",$lval->addtime); ?></td><td align="center"><?php echo $lval->sort; ?></td>
	  <td align="center">
	  <?php switch($lval->status){
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14"  title="待审核">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14"  title="通过审核">';break;
	  } ?></td>
	   
      <td align="center" class="action">
	  <a class="win_normal" href="<?php echo $lval->url; ?>" target=_blank title="查看链接网页"><img src="/public/manage/images/view.gif" border=0></a>
	  <a class="win_normal" href="<?php echo $config['base_url']; ?>admin_link/edit/<?php echo $lval->link_id; ?>" title="编辑链接"><img src="/public/manage/images/edit.gif" alt="编辑分类" width="16" height="16" /></a>
	  <?php if($lval->status=='1'){?>
	  <a class="win_normal" href="<?php echo $config['base_url']; ?>admin_link/delete/<?php echo $lval->link_id; ?>/<?php echo $lval->status; ?>" title="修改状态为待审核"><img src="/public/manage/images/delete.gif" alt="改为待审核状态" width="16" height="16" /></a>
	  
	  <?php }else{?>
	   <a class="win_normal" href="<?php echo $config['base_url']; ?>admin_link/delete/<?php echo $lval->link_id; ?>/<?php echo $lval->status; ?>" title="修改状态为通过审核"><img src="/public/manage/images/auth.gif" alt="授权" width="16" height="16" /></a>
	  <?php }?>
	  
	  
	  </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
  <div class="page fl"> &nbsp;<?php echo $page_info['nums']; ?>条数据,&nbsp;<?php echo $page_info['now_page']; ?>/<?php echo $page_info['page_nums']; ?></div>
    <div class="page fr"><?php echo $pages ?></div>
  </div>
  </form>
</div>
</body>




</html>

