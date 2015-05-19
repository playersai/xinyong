<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="cnt">
  <div id="welcome">
    <div id="welcome_bg">
      <div id="welcome_bg_l">
        <div id="welcome_bg_r">
          <table width="100%" border="0" height="130" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><p class="welcome_name">板芙政府网网站管理系统</p>
                恭喜，登录成功！欢迎您：
                <span class="f_blue"><?php echo $_SESSION['manage']; ?></span>
                ，板芙政府网管理系统正式开始为您服务！今天是：<SCRIPT language=JavaScript>
	<!--
	var y=new Date();
	var gy=y.getFullYear();
	var day=new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	document.write(y.getFullYear()+"年"+(y.getMonth()+1)+"月"+y.getDate()+"日 "+day[y.getDay()]);
	// -->
	              </SCRIPT></td>
              <td align="right" valign="bottom">&nbsp;</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#ffffff">
      <tr>
        <td width="50%" valign="top"><?php if($_SESSION['group_id']=='1'): ?>
          <div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">待办事项</td>
                    <td align="right"><a href="/index.php/admin_todo/"><img src="/public/admin/image/more.jpg" alt="更多" width="34" height="11" /></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r">
                  <ul>
                    <?php foreach($rows_dbxs as $row_item):?>
                    <?php $link = ''; ?>
                    <?php switch ($row_item->type_id){
                  								case 2 :
                  									$link = "/index.php/admin_article/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  								case 3 :
                  									$link = "/index.php/admin_photo/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  								case 4 :
                  									$link = "/index.php/admin_vedio/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  								case 5 :
                  									$link = "/index.php/admin_vote/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  								case 6 :
                  									$link = "/index.php/admin_feedback/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  								case 7 :
                  									$link = "/index.php/admin_topic/edit/$row_item->id/$row_item->cat_id";
                  									break;
                  							} ?>
                    <li class="welcome_list">
                    <span class="f_gray"><?php echo date("Y-m-d H:i",$row_item->addtime); ?></span>
                    <img src="/public/admin/image/arrow.gif" width="8" />&nbsp;&nbsp;[ 待审 ]&nbsp;&nbsp; <a href='<?php echo $link ?>'><?php  if(mb_strlen($row_item->title)>30) {echo mb_substr($row_item->title,0,30)."...";}else{echo $row_item->title;} ?> </a></li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php else: ?>
          <div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">系统信息</td>
                    <td align="right">欢迎使用：信灵网络科技网站管理系统！</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r"> 信灵网络科技网站管理系统 是国内领先的网站内容管理系统。尊敬的用户您正在使用的是政府版。<br />
                  系统版本：政府版 V3.0 <br />
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">企业招聘</td>
                    <td align="right"><a href="/index.php/admin_article/113/1"><img src="/public/admin/image/more.jpg" alt="更多" width="34" height="11" /></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r">
                  <ul>
                    <?php foreach($qyzp_rows as $row_item):?>
                    <li class="welcome_list">
                    <span class="f_gray"><?php echo date("Y-m-d H:i",$row_item->addtime); ?></span>
                    <img src="/public/admin/image/arrow.gif" width="8" />&nbsp;&nbsp;[ 待审 ]&nbsp;&nbsp;<a href='/index.php/admin_article/edit/<?php echo $row_item->aid; ?>/<?php echo $row_item->cat_id; ?>'><?php  if(mb_strlen($row_item->title)>30) {echo mb_substr($row_item->title,0,30)."...";}else{echo $row_item->title;} ?></a> </li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
		  <div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">网上征集</td>
                    <td align="right"><a href="/index.php/admin_feedback/37/1"><img src="/public/admin/image/more.jpg" alt="更多" width="34" height="11" /></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r">
                  <ul>
                    <?php foreach($ofc_rows as $row_item):?>
                    <li class="welcome_list">
                    <span class="f_gray"><?php echo date("Y-m-d H:i",$row_item->addtime); ?></span>
                    <img src="/public/admin/image/arrow.gif" width="8" />&nbsp;&nbsp;[ 待审 ]&nbsp;&nbsp;<a href='/index.php/admin_feedback/result_edit/<?php echo $row_item->f_c_id; ?>/<?php echo $row_item->type_id;?>'><?php  if(mb_strlen($row_item->title)>30) {echo mb_substr($row_item->f_title,0,30)."...";}else{if(empty($row_item->f_title)){echo "无标题";}else{echo $row_item->f_title;}} ?></a> </li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
            </div>
          </div></td>
        <td width="50%" valign="top"><div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">网上诉求</td>
                    <td align="right"><a href="/index.php/admin_feedback/result_list/1/1"><img src="/public/admin/image/more.jpg" alt="更多" width="34" height="11" /></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r">
                  <ul>
                    <?php foreach ($fc_rows as $fcval):?>
                    <li class="welcome_list">
                    <span class="f_gray"><?php echo date("Y-m-d H:i",$fcval->addtime); ?></span>
                    <img src="/public/admin/image/arrow.gif" width="8" />&nbsp;&nbsp;[ 待处理 ]&nbsp;&nbsp;<a href='/index.php/admin_feedback/result_edit/<?php echo $fcval->f_c_id; ?>/<?php echo $fcval->f_id; ?>'><?php  if(mb_strlen($fcval->title)>30) {echo mb_substr($fcval->title,0,30)."...";}else{ if(empty($fcval->title)){echo "无标题" ;}else {echo $fcval->title;} } ?></a> </li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="portlet">
            <div class="welcome_title_bg">
              <div class="welcome_title">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="welcome_c_title">
                  <tr>
                    <td class="welcome_title_w">个人求职</td>
                    <td align="right"><a href="/index.php/admin_article/114/1"><img src="/public/admin/image/more.jpg" alt="更多" width="34" height="11" /></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="welcome_c_bg">
              <div class="welcome_c_bg_l">
                <div class="welcome_c_bg_r">
                  <ul>
                    <?php foreach ($grqz_rows as $grval):?>
                    <li class="welcome_list">
                    <span class="f_gray"><?php echo date("Y-m-d H:i",$grval->addtime); ?></span>
                    <img src="/public/admin/image/arrow.gif" width="8" />&nbsp;&nbsp;[ 待审 ]&nbsp;&nbsp;<a href='/index.php/admin_article/edit/<?php echo $grval->aid; ?>/<?php echo $grval->cat_id; ?>'><?php  if(mb_strlen($grval->title)>30) {echo mb_substr($grval->title,0,30)."...";}else{echo $grval->title;} ?> </a> </li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
            </div>
          </div></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
