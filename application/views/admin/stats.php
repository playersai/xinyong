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

</head>

<body>
<div class="wrap">

  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="6"><div class="relative">信息发布统计列表</div></th>
    </tr>
    
    <tr>
      <th colspan="6">
      <div class="search">
        <font>用户名称：</font>
        <input type="text" name="s_username" maxlength="50" id="s_username" size="25" value="<?php echo $s_username?>" class="input" /> 
        <font>所属部门：</font>
        <select name="s_dept" id="s_dept">
          <option value="">全部</option>
          <?php foreach ($userGroup as $row_item):?>
          <option value="<?php echo $row_item->group_id; ?>" <?php if($row_item->group_id == $s_deptcode) echo 'selected="selected"'?>><?php echo $row_item->name; ?></option>
          <?php endforeach;?>
        </select>
        <input type="button" id="btn_search" class="btn_s" value="查 询" />
        <script src="/public/index/js/base64.js" type="text/javascript"></script>
        <script>
          $("#btn_search").click(function() {
              var base64 = new Base64();
              var queryStr = $('#s_username').val() + "@" + $('#s_dept').val();
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");      
	          window.location.href="/index.php/admin_system/stats/" + queryStr;
          });
        </script>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
	  <td width="32">序号</td>
      <td width="90">用户帐号</td>
      <td width="90">用户名称</td>
      <td width="90">所属部门</td>
	  <td>栏目</td>
	  <td width="90">发布数量</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $key=>$row_item){ ?>
    <tr class="datalist">
	  <td align="center"><?php echo $key + 1; ?></td>
      <td align="center"><?php echo $row_item->add_user; ?></td>
      <td align="center"><?php echo $row_item->nickname; ?></td>
      <td align="center"><?php echo $row_item->dept; ?></td>
      <td><?php echo $row_item->name1; ?> &gt;&gt; <?php echo $row_item->name2; ?> &gt;&gt; <?php echo $row_item->name3; ?></td>
      <td align="center"><?php echo $row_item->count_id; ?></td>
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

