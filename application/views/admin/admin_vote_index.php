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
<!--<script type="text/javascript" src="/public/manage/js/panel.js"></script>
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
						window.location.href="/index.php/admin_vote/delete_arr/"+delete_arr;
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
						window.location.href="/index.php/admin_vote/status_arr/"+status_arr+"/1";
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
				   window.location.href="/index.php/admin_vote/status_arr/"+status_arr+"/0";		   
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
  <form action="{url do='search'}" method="post">
     角色名称：
     <input type="text" name="search_where[title][like]" size="12" value="{$search_where.title.like}" class="input" />
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
      <th colspan="11">
      <div class="relative">[<?php echo $crows[0]->name;?>] 列表
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
             <a class="_add blue" href="/index.php/admin_vote/add/<?php echo $crows[0]->cat_id; ?>" title="新增">
                <img src="/public/manage/images/add.gif" alt="新增" width="16" height="16" /> 新增
            </a>
        </div>
      </div>
      </th>
    </tr>
		<tr>
      <th colspan="11">
      <div class="search">
        <font>标题：</font>
        <input type="text" name="a_title" maxlength="50" id="a_title" size="25" value="<?php echo $a_title; ?>" class="input" /> 
		<font>发布日期：</font>
        <input  name="a_date" id="a_date" class="Wdate"  type="text" onClick="WdatePicker()" dataType="require" title="请输入发布日期" value="<?php echo   $a_date ?>" style="width:160px;" readonly />  
		<font>录入人：</font>
        <input type="text" name="a_user" maxlength="50" id="a_user" size="25" value="<?php echo $a_user; ?>" class="input" />
	 
         
        <font>状态：</font>
        <select name="a_status" id="a_status">
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
              var queryStr = $('#a_title').val() + "@" + $('#a_date').val() + "@" + $('#a_user').val() + "@" + $('#a_status').val(); 
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");   
		      
	          window.location.href="/index.php/admin_vote/index/<?php echo $id.'/' ;?>" + queryStr + "/<?php echo $per_pages ;?>";
          });
		   $("#btn_reset").click(function() { 
               $('#a_title').val(''); 
			   $('#a_date').val('');
			   $('#a_user').val('');
			   $("#a_status option[value='1']").attr("selected", false);
			   $("#a_status option[value='0']").attr("selected", false);
			 
			  
          });
	    
        </script>

      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" onclick="selectAll(this);" id="delete_arr" class="delete_b"/></td>
      <td>标题</td>
      <td width="102">发布日期</td>
      <td width="62">所属栏目</td>
	  <td width="52">录入人</td>
	  <td width="52">排 序</td>
	  <td width="52">阅读数</td>
	  <td width="52">问题数</td>
      <td width="52">状 态</td>
      <td width="152">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($arows as $aval){ ?>
    <tr class="datalist">
      <td align="center"><input type="checkbox" value="<?php echo   $aval->vote_id; ?>" class="delete_a" /></td>
      <td><?php echo htmlspecialchars($aval->title); ?><?if($aval->settop==1) echo '<font color="red">[置顶]</font>';?><?if($aval->index_top==1) echo '<font color="red">&nbsp;[首页头条]</font>';?></td>
      <td align="center"><?php echo date("Y-m-d",$aval->rel_date); ?></td>
      <td align="center"><?php echo $crows[0]->name; ?></td> 
	  <td align="center"><?php echo $aval->add_user; ?></td>
	  <td align="center"><?php echo $aval->sort; ?></td>
	  <td align="center"><?php echo $aval->stats; ?></td>
	  <td align="center"><?php echo $aval->nums; ?></td>
      <td align="center"><?php 
	  switch($aval->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="待审或已删除">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="正常显示">';break;
	  }
	  ?></td>
      <td align="center" class="action">
	    <a class="win_normal" href="/index.php/admin_vote/stats/<?php echo $aval->vote_id; ?>/<?php echo $aval->cat_id; ?>"><img src="/public/manage/images/stats.gif" width="14" height="14" title="查看调查结果"></a>
	    <a class="win_normal" href="/index.php/admin_vote/show/<?php echo $aval->vote_id; ?>/<?php echo $aval->cat_id; ?>"><img src="/public/manage/images/view.gif" width="16" height="16" title="查看调查问题选项"></a>
	    <a class="win_normal" href="/index.php/admin_vote/add_question/<?php echo $aval->vote_id; ?>/<?php echo $aval->cat_id; ?>"><img src="/public/manage/images/add.gif" width="16" height="16" title="添加调查问题选项"></a>
	    <a class="win_normal" href="/index.php/admin_vote/edit/<?php echo $aval->vote_id; ?>/<?php echo $aval->cat_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
	    <a class="win_normal" href="/index.php/admin_vote/delete/<?php echo $aval->vote_id; ?>" onclick="javascript:return confirm('确定要删除本调查项目吗？其子选项及问题也将被删除且不能还原！')" title="删除"><img src="/public/manage/images/delete.gif" alt="<?php echo $aval->status=='0'?'还原':'删除'; ?>" width="16" height="16" /></a>
	  </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
  <div class="page fl"> &nbsp;<?php if(!empty($pages)){ echo $page_info['nums']; ?>条数据,&nbsp;<?php echo $page_info['now_page']; ?>/<?php echo $page_info['page_nums']; ?> <?php } ?></div>
    <div class="page fr"><?php echo isset($pages)?$pages:'';?></div>
  </div>
  </form>
</div>
</body>



</html>

