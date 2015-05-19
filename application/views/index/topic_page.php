
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $html_title; ?><</title>
<link href="/public/index/css/css.css" rel="stylesheet" type="text/css" media="screen" />
<link href="/public/index/css/css_index.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/public/index/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.litenav.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.scrollbox.js"></script>


<style type="text/css">
.button4{width:16px; height:16px;line-height:16px;background:url(imageszhong/twolist004.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
.sousuo{padding-top:-105px; width:980px; height:32px;  margin:0px; background: url(imageszhong/搜索.gif) no-repeat 0 center;}
.topimg{ margin:0px auto; width:1000px; height:176px; background: url(imageszhong/xintop.jpg) no-repeat 0 center; background-color:#FFFFFF;}
.nav{  width:980px; height:40px; line-height:40px; padding-top:127px;}
.nav ul{ padding-left:25px;}
.nav ul li{ float:left; padding:0 7px;font-size:14px; font-weight:bold; display:inline;}
.nav ul li a{ color:#fbf0f0;}
.nav span{ float:right; padding-right:30px;}
.nav span a{ color:#ffffff; text-align:right;}
.nav span a:hover{ color:#fbf0f0;}
.suu2{ height:100px; padding:10px 5px 5px 10px;}
.suu2 li{ float:left; width:320px; background: url(imageszhong/biaoji.jpg) no-repeat 0 center; padding-left:12px; height:23px;}
.searchthree{ line-height:22px; height:27px; font-size:10px; }
.text33{width:140px; height:14px; border:1px #d1cecb solid;}
.button33{width:42px; height:22px;line-height:16px;background:url(imageszhong/登陆.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
.button22{width:42px; height:22px;line-height:16px;background:url(imageszhong/注册.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
.button44{width:42px; height:22px;line-height:16px;background:url(imageszhong/查询.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}

.navBar {
	margin: 0px auto; width: 1000px; height: 40px; color: rgb(255, 255, 255); line-height: 40px; font-family: "Microsoft YaHei"; font-size: 15px; font-weight: bold;
}
.navBar ul {
	
}
.navBar ul li {
	float: left;
}
.navBar ul li a {
	background: url(imageszhong/nav-li-bg.png) no-repeat 0px 0px; padding: 0px 8px; color: rgb(255, 255, 255); display: block;
}
.navBar ul li a:hover {
	background: rgb(235, 34, 39);
}
.navBar ul li a.none {
	background: none;
}
</style>


<script language=Javascript> 
  function time(){
    //获得显示时间的div
    t_div = document.getElementById('showtime');
   var now=new Date()
    //替换div内容 
   t_div.innerHTML = "中国中小商业企业协会 | "+now.getFullYear()
    +"年"+(now.getMonth()+1)+"月"+now.getDate()
    +"日"+now.getHours()+"时"+now.getMinutes()
    +"分"+now.getSeconds()+"秒";
    //等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
   setTimeout(time,1000);
  }
</script>

</head>

<body onload="time();">


  






  <DIV id="header">
<DIV class="topBar">

<div style="float:left; " >
<A href="http://www.sasac.gov.cn/n1180/n20240/n2454922/2923718.html" 
target="_blank" > 国务院国资委主管</A><FONT> | </FONT><A href="" 
target="_blank" >www.zxsx.org</A><FONT> 
</FONT>
</div>
<div style="float:right;" id="showtime">
   
</div>

</DIV>
<DIV class="logoBar">
<!--<DIV class="logo"><IMG  alt="" src="imageszhong/logo.gif"></DIV>
<DIV class="text"><IMG  alt="" src="imageszhong/2014022810035113.gif"></DIV>-->


  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="1000" height="115">
          <param name="movie" value="imageszhong/信用专委会.swf" />
		     <param name="wmode" value="transparent" />
          <param name="quality" value="high" />
          <embed src="imageszhong/信用专委会.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="1000" height="115"></embed>
</object>





</DIV>




<DIV class="navBar">
<UL>
      <li><a href="/index.php/topic_page/index/<?php echo $topic_info->cat_id;?>"><span>专题首页</span></a></li>
	  <?php foreach($topic_nav as $tnval):?>
      <li <?php if($nav_selected==$tnval->cat_id) echo 'class="topic_nav_li"';?>><a href="/index.php/topic_page/<?php echo $tnval->cat_id; ?>"><span><?php echo $tnval->name; ?></span></a></li>
	  <?php endforeach;?>
  </UL></DIV>
  
  
  </DIV>