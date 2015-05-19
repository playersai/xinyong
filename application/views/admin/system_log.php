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
      <th colspan="5">
      <div class="relative">系统日志
        <div class="buttons">
          
        </div>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <!--td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td-->
      <td width="58">日志编号</td>
      <td>日志内容</td>
	  <td width="100">操作用户</td>
	  <td width="110">操作时间</td>
      <td width="102">操作IP</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $sval){ ?>
    <tr class="datalist">
      <!--td align="center"><input name="link_id[]" type="checkbox" value="<?php echo $sval->link_id; ?>" class="checkbox" /></td-->
      <td align="center"><?php echo $sval->log_id; ?> </td>
      <td ><?php echo $sval->content; ?></td>
	  <td align="center"><?php echo $sval->add_user; ?></td>	
	  <td align="center"><?php echo date("Y-m-d H:i",$sval->addtime); ?></td>   
      <td align="center"><?php echo $sval->ip; ?></td>
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

