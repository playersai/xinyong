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
						window.location.href="/index.php/admin_feedback/delete_arr2/"+delete_arr;
				   }else{	
					  alert("请选择要删除的项目！");
				   }  
				 
			   }
			 
	 
		});
		
		$("#status_arr_1").click(function() { 
			var status_arr='';
			
				if(confirm('确定要这些项目显示吗？')){
					$( ".delete_a").each(function(){  
					   if($(this).attr('checked')){
						   status_arr +=$(this).val()+"-";   
						  }
					}); 
				  if(status_arr!=''){
						window.location.href="/index.php/admin_feedback/status_arr2/"+status_arr+"/1";
				   }else{
					  alert("请选择要显示的项目！");
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
				   window.location.href="/index.php/admin_feedback/status_arr2/"+status_arr+"/0";		   
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
          <th colspan="6"> <div class="relative">[<?php echo htmlspecialchars($cat[0]->title); ?>] 列表
		  <div class="buttons">
		   <a class="_add blue" href="javascript:void(0);" title="批量显示" id='status_arr_1'>
                <img src="/public/manage/images/add.gif" alt="批量显示" width="16" height="16" /> 批量显示
            </a>
			<a class="_add blue" href="javascript:void(0);" title="批量待审" id='status_arr_0'>
                <img src="/public/manage/images/add.gif" alt="批量待审" width="16" height="16" /> 批量待审
            </a>
		    <a class="_add blue" href="javascript:void(0);" title="批量删除" id='delete_arr'>
                <img src="/public/manage/images/add.gif" alt="批量删除" width="16" height="16" /> 批量删除
            </a>
       
        </div>
		</div>
        </th>
        </tr>        
        <tr>
          <th colspan="6">
            <?php if($f_id=='1'){ ?>
  			<div class="search">
     			<font>关键字：</font> 
     			<input type="text" name="keywords" maxlength="50" id="keywords" size="52" value="" class="input" /> 状态：
      			<select name="search_status" id="search_status">
        		  <option value="9">全部</option>
        		  <option value="0">待处理</option>
        		  <option value="1">已回复</option>
        		  <option value="2">已办结</option>
                </select>
                <font>分类：</font>
                <select name="search_type" id="search_type">
                  <option value="0">全部</option>
                  <option value="1"> 投诉监督</option>
                  <option value="2"> 办事咨询</option>
                  <option value="3"> 镇长信箱</option>
                </select>
                <input type="button" id="btn_search" class="btn_s" value="查 询" />
			    <script src="/public/index/js/base64.js" type="text/javascript"></script> 
			    <script>
			    $("#btn_search").click(function() {
			      var base64 = new Base64();
			      var queryStr = $('#keywords').val() + "@" + $('#search_status').val() + "@" + $('#search_type').val();
				  queryStr = base64.encode(queryStr);  
				  queryStr = queryStr.replace(/\+/g, "-");
				  queryStr = queryStr.replace(/\//g, "_");
				  window.location.href="/index.php/admin_feedback/result_search/" + queryStr;
			    });
			  </script> 
			  </div>
			  <?php } ?>
          </th>
        </tr>
        <tr class="mylist_title"> 
           <td width="28"><input type="checkbox" onclick="selectAll(this);" id="delete_arr" class="delete_b"/></td>
          <?php if($f_id=='1'){ ?>
          <td>标题</td>
          <td width="62">所属分类</td>
          <td width="120">投诉时间</td>
          <?php }else{ ?>
          <td>我要说</td>
          <td width="150">姓名</td>
          <td width="120">发表时间</td>
          <?php }?>
          <td width="52">状 态</td>
          <td width="102">操 作</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rows as $row_item){ ?>
        <tr class="datalist"> 
         <td align="center"><input type="checkbox" value="<?php echo  $row_item->f_c_id; ?>" class="delete_a" /></td>
          <td><?php echo isset($row_item->title)?htmlspecialchars($row_item->title):htmlspecialchars($row_item->content); ?></td>
          <?php if($f_id=='1'){ ?>
          <td align="center"><?php echo htmlspecialchars($row_item->name);?></td>
          <?php }else{ ?>
          <td align="center"><?php echo htmlspecialchars($row_item->nickname);?></td>
          <?php }?>
          <td align="center"><?php echo date("Y-m-d H:i",$row_item->addtime);?></td>
          <td align="center">
          <?php switch($row_item->status){ 
			case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" title="待处理">';break;
			case 1 : echo '<img src="/public/manage/images/info.gif" width="14" height="14" title="已回复">';break;
			case 2 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" title="已办结">';break;
		  } ?>
	      </td>
          <td align="center" class="action">
            <a class="win_normal" href="/index.php/admin_feedback/result_edit/<?php echo $row_item->f_c_id; ?>/<?php echo $row_item->f_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
            <?php if($_SESSION['group_id']=='1'){ ?>
            <a class="win_normal" href="/index.php/admin_feedback/result_delete/<?php echo $row_item->f_c_id; ?>" onclick="javascript:return confirm('确定要删除本项目吗？删除后将不能还原！')" title="删除"><img src="/public/manage/images/delete.gif" alt="<?php echo $row_item->status=='0'?'还原':'删除'; ?>" width="16" height="16" /></a>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="mylist_foot">
      <div class="page fl">&nbsp;<?php echo $totalRows; ?>条数据</div>
      <div class="page fr"><?php echo $pageLink;?></div>
    </div>

</div>
</body>
</html>

