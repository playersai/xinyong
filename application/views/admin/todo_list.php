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
      <th colspan="8">
      <div class="relative">[待办事项] 列表</div>
      </th>
    </tr>
	<tr>
      <th colspan="9">
      <div class="search">
        <font>标题：</font>
        <input type="text" name="a_title" maxlength="50" id="a_title" size="25" value="<?php echo $a_title; ?>" class="input" /> 
		<font>发布日期：</font>
        <input  name="a_date" id="a_date" class="Wdate"  type="text" onClick="WdatePicker()" dataType="require" title="请输入发布日期" value="<?php echo   $a_date ?>" style="width:160px;" readonly />  
		<font>录入人：</font>
        <input type="text" name="a_user" maxlength="50" id="a_user" size="25" value="<?php echo $a_user; ?>" class="input" />

        <input type="button" id="btn_search" class="btn_s" value="查 询" />
		<input type="button" id="btn_reset" class="btn_s" value="清 空" />
        <script src="/public/index/js/base64.js" type="text/javascript"></script>
        <script>
	 
          $("#btn_search").click(function() { 
              var base64 = new Base64();
              var queryStr = $('#a_title').val() + "@" + $('#a_date').val() + "@" + $('#a_user').val() ; 
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");   
		      
	          window.location.href="/index.php/admin_todo/index/" + queryStr + "/<?php echo $per_pages ;?>";
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
      <!--td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td-->
      <td>标题</td>
      <td width="102">发布日期</td>
      <td width="62">所属分类</td>
	  <td width="52">录入人</td>
	  <td width="52">阅读数</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $row_item){ ?>
    
    <tr class="datalist">
      <!--td align="center"><input name="id[]" type="checkbox" value="{$vo.id}" class="checkbox" /></td-->
      <td><?php echo htmlspecialchars($row_item->title); ?></td>
      <td align="center"><?php echo date("Y-m-d",$row_item->rel_date); ?></td>
      <td align="center"><?php echo htmlspecialchars($row_item->name); ?></td>
	  <td align="center"><?php echo htmlspecialchars($row_item->add_user); ?></td>
	  <td align="center"><?php echo $row_item->stats; ?></td>
      <td align="center">
      <?php switch($row_item->status)
	  {
		case 0 : echo '<img src="/public/manage/images/status_0.gif" width="14" height="14" alt="启用" title="待审">';break;
		case 1 : echo '<img src="/public/manage/images/status_1.gif" width="14" height="14" alt="启用" title="显示">';break;
	  } ?>
	  </td>
	  <?php $link = ''; ?>
      <?php switch ($row_item->type_id){
			case 2 :
				$link = "/index.php/admin_article";
                break;
            case 3 :
                $link = "/index.php/admin_photo";
                break;
            case 4 :
                $link = "/index.php/admin_vedio";
                break;
            case 5 :
                $link = "/index.php/admin_vote";
                break;
            case 6 :
                $link = "/index.php/admin_feedback";
                break;
            case 7 :
                $link = "/index.php/admin_topic";
                break;
      } ?>
      <td align="center" class="action">
	    <a class="win_normal" href="<?php echo $link.'/edit/'.$row_item->id.'/'.$row_item->cat_id; ?>" title="编辑"><img src="/public/manage/images/edit.gif" alt="编辑" width="16" height="16" /></a>
	    <a class="win_normal" href="<?php echo $link.'/delete/'.$row_item->id; ?>" title="删除" onclick="javascript:return confirm('确定要删除本项目吗？删除后将不能还原！')"><img src="/public/manage/images/delete.gif" alt="删除" width="16" height="16" /></a>
	  </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
  <div class="page fl"> &nbsp;共&nbsp;<?php echo $totalRows; ?>&nbsp;条数据,&nbsp;分&nbsp;<?php echo $totalPages; ?>&nbsp;页显示</div>
    <div class="page fr"><?php echo $pageLink; ?></div>
  </div>
  </form>
</div>
</body>

</html>

