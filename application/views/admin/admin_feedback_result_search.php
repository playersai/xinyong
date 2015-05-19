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
<!-- <script type="text/javascript" src="/public/manage/js/panel.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/jquery.form.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/ajaxsubmit.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/fun.js"></script> -->
<!-- <script type="text/javascript" src="/public/manage/js/list.js"></script> -->

</head>

<body>
<div class="wrap">

  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="5">
        <div class="relative">[网上诉求] 列表</div>
      </th>
    </tr>
    <tr>
      <th colspan="5">
        <div class="search">
          <font>关键字：</font>
          <input type="text" name="keywords" maxlength="50" id="keywords" size="52" value="<?php echo htmlspecialchars($keywords); ?>" class="input" />
          <font>状态：</font>
          <select name="search_status" id="search_status">
	        <option value="9">全部</option>
            <option value="0" <?php echo $status=='0'?'selected':"";?>>待处理</option>
	        <option value="1" <?php echo $status=='1'?'selected':"";?>>已回复</option>
	        <option value="2" <?php echo $status=='2'?'selected':"";?>>已办结</option>
          </select>
	      <font>分类</font>
	      <select name="search_type" id="search_type">
            <option value="0" >全部</option>
            <option value="1" <?php echo $type_id=='1'?'selected':"";?>> 投诉监督</option>
	        <option value="2" <?php echo $type_id=='2'?'selected':"";?>> 办事咨询</option>
	        <option value="3" <?php echo $type_id=='3'?'selected':"";?>> 镇长信箱</option>
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
      </th>
    </tr>
    <tr class="mylist_title">
      <!--td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td-->
      <td>标题</td>
      <td width="62">所属分类</td>
	  <td width="102">投诉时间</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(count($rows)>0){ ?>
    <?php foreach($rows as $row_item){ ?>
    <tr class="datalist">
      <!--td align="center"><input name="id[]" type="checkbox" value="{$vo.id}" class="checkbox" /></td-->
      <td><?php echo isset($row_item->title)?htmlspecialchars($row_item->title):htmlspecialchars($row_item->content); ?></td>
      <td align="center"><?php echo $row_item->name;?></td>
      <td align="center"><?php echo date("Y-m-d H:i",$row_item->addtime);?></td>
      <td align="center">
      <?php switch($row_item->status){
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="待处理状态">';break;
		case 1 : echo '<img src="/public/manage/images/info.gif" width="14" height="14" alt="启用" title="已回复，等待管理员确认">';break;
		case 2 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="已办结，正常显示">';break;
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
    <?php }else{ ?>
      <td align="center" colspan="5">暂无数据</td>
    <?php } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
  <div class="page fl">&nbsp;共&nbsp;<?php echo $totalRows; ?>&nbsp;条数据,分&nbsp;<?php echo $totalPages; ?>&nbsp;页显示</div>
    <div class="page fr"><?php echo $pageLink; ?></div>
  </div>
  </form>
</div>
</body>



</html>

